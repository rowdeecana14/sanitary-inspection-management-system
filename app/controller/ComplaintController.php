<?php

namespace App\Controller;
use App\Model\ComplaintModel;
use App\Model\LogModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class ComplaintController extends BaseController {

    public $module = 19;
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
            'complainant_id', 'respondent_id', 'person_involved_id', 'complaint_type_id', 'complaint_status_id', 
        ];
        $show_fields = Helper::appendTable('complaints', $show_fields);
        $show_fields[] = 'complaints.id as complaint_id';
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';
        $show_fields[] = 'tbl_person_involved.first_name as pi_first_name';
        $show_fields[] = 'tbl_person_involved.middle_name as pi_middle_name';
        $show_fields[] = 'tbl_person_involved.last_name as pi_last_name';
        $show_fields[] = 'health_officials.first_name as h_first_name';
        $show_fields[] = 'health_officials.middle_name as h_middle_name';
        $show_fields[] = 'health_officials.last_name as h_last_name';
        $show_fields[] = 'complaint_statuses.name as complaint_status';
        $show_fields[] = 'complaint_types.name as complaint_type';

        $join_tables = [
            [ "LEFT", "residents", "complaints.complainant_id", "residents.id"],
            [ "LEFT", "residents as tbl_person_involved", "complaints.person_involved_id", "tbl_person_involved.id"],
            [ "LEFT", "health_officials", "complaints.respondent_id", "health_officials.id"],
            [ "LEFT", "complaint_types", "complaints.complaint_type_id", "complaint_types.id"],
            [ "LEFT", "complaint_statuses", "complaints.complaint_status_id", "complaint_statuses.id"],
        ];

        $model = new ComplaintModel;
        $complaints = $model->selects($show_fields, $join_tables);
        $result = [];
  
        foreach($complaints as $index => $complaint) {
            $complainant = $complaint['r_first_name'] . ' '.$complaint['r_middle_name'][0].'. '.$complaint['r_last_name'];
            $person_involved = $complaint['pi_first_name'] . ' '.$complaint['pi_middle_name'][0].'. '.$complaint['pi_last_name'];
            $respondent = $complaint['h_first_name'] . ' '.$complaint['h_middle_name'][0].'. '.$complaint['h_last_name'];

            array_push($result, [
                'index' => $index + 1,
                'complainant' => $complainant,
                'respondent' => $respondent,
                'person_involved' =>  $person_involved,
                'complaint_type' => $complaint['complaint_type'],
                'complaint_status' => $complaint['complaint_status'],
                'action' => ' 
                    <button type="button" class="btn btn-icon btn-round btn-info btn-view"  data-id="'.$complaint['complaint_id'].'"  data-toggle="tooltip" data-placement="top" title="View record">
                        <i class="fas fa-search"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$complaint['complaint_id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$complaint['complaint_id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
                        <i class="fas fa-trash-alt"></i>
                    </button>'
            ]);
        }

        return [
            "success" => true,
            "message" => "success",
            "data" => $result
        ];
    }

    public function select2($request) {
        // $model = new ComplaintModel;
        // $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        // $fields = ['id', 'name as text'];
        // $complaint = $model->search($fields, [], $data);

        // return [
        //     "success" => true,
        //     "message" => "success",
        //     "data" => $complaint
        // ];
    }
    
    public function store($request) {
        $complaint = new ComplaintModel;
        $data = Helper::unsets((array) $request, ['module', 'action', 'csrf_token']);
        $data['date_incident'] = date('Y-m-d', strtotime($data['date_incident']));
        $data['date_reported'] = date('Y-m-d', strtotime($data['date_reported']));
        $data['created_by'] = $this->auth->id;
        $complaint_id =  $complaint->lastInsertId($data);

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $complaint_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success"
        ];
    }

    public function show($request) {
        $show_fields = [ 
            'complainant_id', 'respondent_id', 'person_involved_id', 'complaint_type_id', 'complaint_status_id', 
            'date_incident', 'date_reported', 'statement', 'incident_address', 'action_taken'
        ];
        $show_fields = Helper::appendTable('complaints', $show_fields);
        $show_fields[] = 'complaints.id as complaint_id';
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';
        $show_fields[] = 'tbl_person_involved.first_name as pi_first_name';
        $show_fields[] = 'tbl_person_involved.middle_name as pi_middle_name';
        $show_fields[] = 'tbl_person_involved.last_name as pi_last_name';
        $show_fields[] = 'health_officials.first_name as h_first_name';
        $show_fields[] = 'health_officials.middle_name as h_middle_name';
        $show_fields[] = 'health_officials.last_name as h_last_name';
        $show_fields[] = 'complaint_statuses.name as complaint_status';
        $show_fields[] = 'complaint_types.name as complaint_type';

        $join_tables = [
            [ "LEFT", "residents", "complaints.complainant_id", "residents.id"],
            [ "LEFT", "residents as tbl_person_involved", "complaints.person_involved_id", "tbl_person_involved.id"],
            [ "LEFT", "health_officials", "complaints.respondent_id", "health_officials.id"],
            [ "LEFT", "complaint_types", "complaints.complaint_type_id", "complaint_types.id"],
            [ "LEFT", "complaint_statuses", "complaints.complaint_status_id", "complaint_statuses.id"],
        ];

        $model = new ComplaintModel;
        $wheres = [[ 'table' => 'complaints', 'key' => 'id', 'value' => $request->id ]];
        $complaint = $model->select($show_fields, $join_tables,  $wheres);
        $complaint['date_incident'] =  Helper::humanDate('m/d/Y', $complaint['date_incident']);
        $complaint['date_reported'] =  Helper::humanDate('m/d/Y', $complaint['date_reported']);

        $complainant = $complaint['r_first_name'] . ' '.$complaint['r_middle_name'].' '.$complaint['r_last_name'];
        $person_involved = $complaint['pi_first_name'] . ' '.$complaint['pi_middle_name'].' '.$complaint['pi_last_name'];
        $respondent = $complaint['h_first_name'] . ' '.$complaint['h_middle_name'].' '.$complaint['h_last_name'];

        $complaint['complainant_id'] = [
            "id" => $complaint['complainant_id'],
            "text" => $complainant
        ];
        $complaint['person_involved_id'] = [
            "id" => $complaint['person_involved_id'],
            "text" => $person_involved
        ];
        $complaint['respondent_id'] = [
            "id" => $complaint['respondent_id'],
            "text" => $respondent
        ];
        $complaint['complaint_type_id'] = [
            "id" => $complaint['complaint_type_id'],
            "text" => $complaint['complaint_type']
        ];

        return [
            "success" => true,
            "message" => "success",
            "data" => $complaint
        ];
    }

    public function update($request) {
        $complaint = new ComplaintModel;
        $data = Helper::unsets((array) $request,  ['module', 'action', 'csrf_token']);
        $data['date_incident'] = date('Y-m-d', strtotime($data['date_incident']));
        $data['date_reported'] = date('Y-m-d', strtotime($data['date_reported']));
        $data['updated_by'] = $this->auth->id;
        $data['updated_at'] = date('Y-m-d H:i:s');

        if($complaint->update($data)) {

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
        $complaint = new ComplaintModel;
        $data = [
            'id' => $request->id,
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($complaint->remove($data)) {

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