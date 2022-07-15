<?php

namespace App\Controller\Settings;
use App\Model\Settings\ChecklistModel;
use App\Model\LogModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class ChecklistController extends BaseController {

    public $module = 28;
    public $action_add = 1;
    public $action_update = 2;
    public $action_delete = 3;
    public $action_read = 4;
    public $auth = [];

    public function __construct() {
        $this->auth = json_decode(auth_user());
    }

    public function all() {
        $model = new ChecklistModel;
        $checklists = $model->all();
        $result = [];

        foreach($checklists as $index => $checklist) {
            $badge =  $checklist['status'] == "Active" ? "secondary" : "default";
            $action = '
                <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$checklist['id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$checklist['id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
                        <i class="fas fa-trash-alt"></i>
                    </button>
            ';
            
            array_push($result, [
                'index' => $index + 1,
                'description' => $checklist['description'],
                // 'passing_rate' => $checklist['passing_rate']. ' %',
                'created_at' => date('M d, Y h:i A', strtotime($checklist['created_at'])),
                'updated_at' => $checklist['updated_at'] != NULL ? date('M d, Y h:i A', strtotime($checklist['updated_at'])) : '',
                'status' => '<span class="badge badge-'.$badge.'">'.strtoupper($checklist['status']).'</span>',
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
        $model = new ChecklistModel;
        $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        $fields = ['id', 'name as text'];
        $checklists = $model->search($fields, [], $data);

        return [
            "success" => true,
            "message" => "success",
            "data" => $checklists
        ];
    }

    public function store($request) {
        $data = [
            'description' => $request->description,
            // 'passing_rate' => $request->passing_rate,
            'created_by' => $this->auth->id
        ];
        $checklist = new ChecklistModel;
        $checklist_id =  $checklist->lastInsertId($data);

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $checklist_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success"
        ];
    }
    
    public function show($request) {
        $model = new ChecklistModel;
        $checklist = $model->show(['id' => $request->id]);

        return [
            "success" => true,
            "message" => "success",
            "data" => $checklist
        ];
    }

    public function update($request) {
        $checklist = new ChecklistModel;

        $data = [
            'id' => $request->id,
            'description' => $request->description,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if($checklist->update($data)) {

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

    public function remove($request) {
        $checklist = new ChecklistModel;
        $data = [
            'id' => $request->id,
            'status' => 'Inactive',
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($checklist->remove($data)) {

            $log = new LogModel;
            $log->store([
                'requests' => json_encode($request),
                'ip' => Helper::getUserIP(),
                'module_id' => $this->module,
                'action_id' => $this->action_delete,
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