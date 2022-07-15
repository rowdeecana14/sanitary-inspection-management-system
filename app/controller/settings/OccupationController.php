<?php

namespace App\Controller\Settings;
use App\Model\Settings\OccupationModel;
use App\Model\LogModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class OccupationController extends BaseController {
    public $module = 8;
    public $action_add = 1;
    public $action_update = 2;
    public $action_delete = 3;
    public $action_read = 4;
    public $auth = [];

    public function __construct() {
        $this->auth = json_decode(auth_user());
    }

    public function all() {
        $model = new OccupationModel;
        $occupations = $model->all();
        $result = [];

        foreach($occupations as $index => $occupation) {
            $badge =  $occupation['status'] == "Active" ? "secondary" : "default";
            
            array_push($result, [
                'index' => $index + 1,
                'name' => $occupation['name'],
                'created_at' => date('M d, Y h:i A', strtotime($occupation['created_at'])),
                'updated_at' => $occupation['updated_at'] != NULL ? date('M d, Y h:i A', strtotime($occupation['updated_at'])) : '',
                'status' => '<span class="badge badge-'.$badge.'">'.strtoupper($occupation['status']).'</span>',
                'action' => ' 
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$occupation['id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$occupation['id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
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
        $model = new OccupationModel;
        $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        $fields = ['id', 'name as text'];
        $occupations = $model->search($fields, [], $data);

        return [
            "success" => true,
            "message" => "success",
            "data" => $occupations
        ];

        return [
            "success" => true,
            "message" => "error"
        ];
    }
    
    public function store($request) {
        $occupation = new OccupationModel;
        $data = [
            'name' => $request->name,
            'created_by' => $this->auth->id
        ];

        $occupation_id =  $occupation->lastInsertId($data);
        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $occupation_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success"
        ];
    }

    public function show($request) {
        $model = new OccupationModel;
        $occupation = $model->show(['id' => $request->id]);

        return [
            "success" => true,
            "message" => "success",
            "data" => $occupation
        ];
    }

    public function update($request) {
        $occupation = new OccupationModel;

        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'status' => $request->status,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if($occupation->update($data)) {

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
        $occupation = new OccupationModel;
        $data = [
            'id' => $request->id,
            'status' => 'Inactive',
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($occupation->remove($data)) {

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