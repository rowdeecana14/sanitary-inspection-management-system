<?php

namespace App\Controller\Settings;
use App\Model\Settings\CemeteryModel;
use App\Model\LogModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class CemeteryController extends BaseController {

    public $module = 14;
    public $action_add = 1;
    public $action_update = 2;
    public $action_delete = 3;
    public $action_read = 4;
    public $auth = [];

    public function __construct() {
        $this->auth = json_decode(auth_user());
    }

    public function all() {
        $model = new CemeteryModel;
        $cemeteries = $model->all();
        $result = [];

        foreach($cemeteries as $index => $cemetery) {
            $badge =  $cemetery['status'] == "Active" ? "secondary" : "default";
            
            array_push($result, [
                'index' => $index + 1,
                'name' => $cemetery['name'],
                'address' => $cemetery['address'],
                'created_at' => date('M d, Y h:i A', strtotime($cemetery['created_at'])),
                'updated_at' => $cemetery['updated_at'] != NULL ? date('M d, Y h:i A', strtotime($cemetery['updated_at'])) : '',
                'status' => '<span class="badge badge-'.$badge.'">'.strtoupper($cemetery['status']).'</span>',
                'action' => ' 
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$cemetery['id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$cemetery['id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
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
        $model = new CemeteryModel;
        $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        $fields = ['id', 'name as text'];
        $cemeteries = $model->search($fields, [], $data);

        return [
            "success" => true,
            "message" => "success",
            "data" => $cemeteries
        ];
    }
    
    public function store($request) {
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'created_by' => $this->auth->id
        ];
        $cemetery = new CemeteryModel;
        $cemetery_id =  $cemetery->lastInsertId($data);

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $cemetery_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success"
        ];
    }

    public function show($request) {
        $model = new CemeteryModel;
        $cemetery = $model->show(['id' => $request->id]);

        return [
            "success" => true,
            "message" => "success",
            "data" => $cemetery
        ];
    }

    public function update($request) {
        $cemetery = new CemeteryModel;

        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'address' => $request->address,
            'status' => $request->status,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if($cemetery->update($data)) {

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
        $cemetery = new CemeteryModel;
        $data = [
            'id' => $request->id,
            'status' => 'Inactive',
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($cemetery->remove($data)) {

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