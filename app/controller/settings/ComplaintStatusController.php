<?php

namespace App\Controller\Settings;
use App\Model\Settings\ComplaintStatusModel;
use App\Model\LogModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class ComplaintStatusController extends BaseController {

    public $module = 5;
    public $action_add = 1;
    public $action_update = 2;
    public $action_delete = 3;
    public $action_read = 4;
    public $auth = [];

    public function __construct() {
        $this->auth = json_decode(auth_user());
    }

    public function all() {
        $model = new ComplaintStatusModel;
        $complaint_statuses = $model->all();
        $result = [];

        foreach($complaint_statuses as $index => $complaint_status) {
            $badge =  "";
            $action = '
                <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$complaint_status['id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$complaint_status['id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
                    <i class="fas fa-trash-alt"></i>
                </button>
            ';

            if( $complaint_status['status'] == "Default") {
                $action = '';
                $badge =  "info";
            }
            else if( $complaint_status['status'] == "Active") {
                $badge = "secondary";
            }
            else {
                $badge = "default";
            }
            
            array_push($result, [
                'index' => $index + 1,
                'name' => $complaint_status['name'],
                'created_at' => date('M d, Y h:i A', strtotime($complaint_status['created_at'])),
                'updated_at' => $complaint_status['updated_at'] != NULL ? date('M d, Y h:i A', strtotime($complaint_status['updated_at'])) : '',
                'status' => '<span class="badge badge-'.$badge.'">'.strtoupper($complaint_status['status']).'</span>',
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
        $model = new ComplaintStatusModel;
        $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        $fields = ['id', 'name as text'];
        $complaint_statuses = $model->search($fields, [], $data);

        return [
            "success" => true,
            "message" => "success",
            "data" => $complaint_statuses
        ];
    }
    
    public function store($request) {
        $complaint_status = new ComplaintStatusModel;
        $data = [
            'name' => $request->name,
            'created_by' => $this->auth->id
        ];

        $complaint_status_id =  $complaint_status->lastInsertId($data);
        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $complaint_status_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success"
        ];
    }

    public function show($request) {
        $model = new ComplaintStatusModel;
        $complaint_status = $model->show(['id' => $request->id]);

        return [
            "success" => true,
            "message" => "success",
            "data" => $complaint_status
        ];
    }

    public function update($request) {
        $complaint_status = new ComplaintStatusModel;

        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'status' => $request->status,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if($complaint_status->update($data)) {

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
        $complaint_status = new ComplaintStatusModel;
        $data = [
            'id' => $request->id,
            'status' => 'Inactive',
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($complaint_status->remove($data)) {

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