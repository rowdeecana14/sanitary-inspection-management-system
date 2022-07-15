<?php

namespace App\Controller\Settings;
use App\Model\Settings\ComplaintTypeModel;
use App\Model\LogModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class ComplaintTypeController extends BaseController {

    public $module = 4;
    public $action_add = 1;
    public $action_update = 2;
    public $action_delete = 3;
    public $action_read = 4;
    public $auth = [];

    public function __construct() {
        $this->auth = json_decode(auth_user());
    }

    public function all() {
        $model = new ComplaintTypeModel;
        $complaint_types = $model->all();
        $result = [];

        foreach($complaint_types as $index => $complaint_type) {
            $badge =  $complaint_type['status'] == "Active" ? "secondary" : "default";
            
            array_push($result, [
                'index' => $index + 1,
                'name' => $complaint_type['name'],
                'created_at' => date('M d, Y h:i A', strtotime($complaint_type['created_at'])),
                'updated_at' => $complaint_type['updated_at'] != NULL ? date('M d, Y h:i A', strtotime($complaint_type['updated_at'])) : '',
                'status' => '<span class="badge badge-'.$badge.'">'.strtoupper($complaint_type['status']).'</span>',
                'action' => ' 
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$complaint_type['id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$complaint_type['id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
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
        $model = new ComplaintTypeModel;
        $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        $fields = ['id', 'name as text'];
        $complaint_types = $model->search($fields, [], $data);

        return [
            "success" => true,
            "message" => "success",
            "data" => $complaint_types
        ];
    }
    
    public function store($request) {
        $complaint_type = new ComplaintTypeModel;
        $data = [
            'name' => $request->name,
            'created_by' => $this->auth->id
        ];

        $complaint_type_id =  $complaint_type->lastInsertId($data);
        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $complaint_type_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success"
        ];
    }

    public function show($request) {
        $model = new ComplaintTypeModel;
        $complaint_type = $model->show(['id' => $request->id]);

        return [
            "success" => true,
            "message" => "success",
            "data" => $complaint_type
        ];
    }

    public function update($request) {
        $complaint_type = new ComplaintTypeModel;

        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'status' => $request->status,
            'updated_by' =>  $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if($complaint_type->update($data)) {

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
        $complaint_type = new ComplaintTypeModel;
        $data = [
            'id' => $request->id,
            'status' => 'Inactive',
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($complaint_type->remove($data)) {

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