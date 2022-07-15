<?php

namespace App\Controller\Settings;
use App\Model\Settings\SanitaryChecklistModel;
use App\Model\Settings\SanitaryChecklistAssignModel;
use App\Model\Settings\ChecklistModel;
use App\Model\LogModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class SanitaryChecklistController extends BaseController {

    public $module = 29;
    public $action_add = 1;
    public $action_update = 2;
    public $action_delete = 3;
    public $action_read = 4;
    public $auth = [];

    public function __construct() {
        $this->auth = json_decode(auth_user());
    }

    public function all() {
        $show_fields = [ 
            'satisfaction_from', 'satisfaction_to', 'very_satisfaction_from', 'very_satisfaction_to', 'excelent_from', 
            'excelent_to', 'module_id', 'updated_at'
        ];

        $show_fields = Helper::appendTable('sanitary_checklists', $show_fields);
        $show_fields[] = 'sanitary_checklists.id as sanitary_checklist_id';
        $show_fields[] = 'modules.name as module';

        $join_tables = [
            [ "LEFT", "modules", "sanitary_checklists.module_id", "modules.id"],
        ];

        $model = new SanitaryChecklistModel;
        $sanitary_checklists = $model->selects($show_fields, $join_tables);
        $result = [];

        foreach($sanitary_checklists as $index => $sanitary_checklist) {
            $action = '
                 <button type="button" class="btn btn-icon btn-round btn-info btn-show"  data-id="'.$sanitary_checklist['sanitary_checklist_id'].'"  data-toggle="tooltip" data-placement="top" title="View record">
                        <i class="fas fa-search"></i>
                    </button>
                <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$sanitary_checklist['sanitary_checklist_id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                    <i class="fas fa-edit"></i>
                </button>
            ';
            
            array_push($result, [
                'index' => $index + 1,
                'name' => ucwords($sanitary_checklist['module']),
                'satistfaction' => $sanitary_checklist['satisfaction_from'].'-'.$sanitary_checklist['satisfaction_to'].' %',
                'very_satisfaction' => $sanitary_checklist['very_satisfaction_from'].'-'.$sanitary_checklist['very_satisfaction_to'].' %',
                'excelent' => $sanitary_checklist['excelent_from'].'-'.$sanitary_checklist['excelent_to'].' %',
                'updated_at' => $sanitary_checklist['updated_at'] != NULL ? date('M d, Y h:i A', strtotime($sanitary_checklist['updated_at'])) : '',
                'action' => $action
            ]);
        }

        return [
            "success" => true,
            "message" => "success",
            "data" => $result
        ];
    }

    public function select2($request) {
        return [
            "success" => true,
            "message" => "success",
            "data" => [ ]
        ];
    }
    
    public function show($request) {
        $model = new SanitaryChecklistModel;
        $sanitary_checklist = $model->show(['id' => $request->id]);

        $show_fields = [ 'sanitary_checklist_id', 'checklist_id' ];
        $show_fields = Helper::appendTable('sanitary_checklist_assigns', $show_fields);
        $show_fields[] = 'checklists.description as checklist';
        $join_tables = [
            [ "LEFT", "checklists", "sanitary_checklist_assigns.checklist_id", "checklists.id"],
        ];
        $wheres = [
            [ 'table' => 'sanitary_checklist_assigns', 'key' => 'sanitary_checklist_id', 'value' => $sanitary_checklist['id']],
        ];
        $model = new SanitaryChecklistAssignModel;
        $sanitary_checklist_assigns = $model->selects($show_fields, $join_tables,  $wheres);

        $model = new ChecklistModel;
        $checklists = $model->all();

        return [
            "success" => true,
            "message" => "success",
            "data" => [
                'sanitary_checklist' => $sanitary_checklist,
                'checklist_assigns' => $sanitary_checklist_assigns,
                'checklists' => $checklists
            ]
        ];
    }

    public function update($request) {
        $sanitary_checklist = new SanitaryChecklistModel;
        $data = [
            'id' => $request->id,
            'satisfaction_from' => $request->satisfaction_from,
            'satisfaction_to' => $request->satisfaction_to,
            'very_satisfaction_from' => $request->very_satisfaction_from,
            'very_satisfaction_to' => $request->very_satisfaction_to,
            'excelent_from' => $request->excelent_from,
            'excelent_to' => $request->excelent_to,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $sanitary_checklist_assigns = new SanitaryChecklistAssignModel;
        $wheres = [
            [ 'table' => 'sanitary_checklist_assigns', 'key' => 'sanitary_checklist_id', 'value' => $request->id],
        ];
        $sanitary_checklist_assigns->delete($wheres);

        if(isset($request->checklists)){
            if(is_array($request->checklists)) {
                foreach($request->checklists as $checklist) {
                    $sanitary_checklist_assigns->store([
                        'sanitary_checklist_id' => $request->id,
                        'checklist_id' => $checklist,
                        'created_by' => $this->auth->id
                    ]);
                }
            }
            else {
                $sanitary_checklist_assigns->store([
                    'sanitary_checklist_id' => $request->id,
                    'checklist_id' => $request->checklists,
                    'created_by' => $this->auth->id
                ]);
            }
        }

        if($sanitary_checklist->update($data)) {

            $log = new LogModel;
            $log->store([
                'requests' => json_encode($request),
                'ip' => Helper::getUserIP(),
                'module_id' => $this->module,
                'action_id' => $this->action_update,
                'record_id' => $request->id,
                'user_id' => $this->auth->id
            ]);

            return [
                "success" => true,
                "message" => "success"
            ];
        }

        return [
            "success" => false,
            "message" => "error"
        ];
    }
}
?>