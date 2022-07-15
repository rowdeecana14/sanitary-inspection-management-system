<?php

namespace App\Controller\Settings;
use App\Model\Settings\FeeModel;
use App\Model\LogModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class FeeController extends BaseController {

    public $module = 27;
    public $action_add = 1;
    public $action_update = 2;
    public $action_delete = 3;
    public $action_read = 4;
    public $auth = [];

    public function __construct() {
        $this->auth = json_decode(auth_user());
    }

    public function all() {
        $model = new FeeModel;
        $fees = $model->all();
        $result = [];

        foreach($fees as $index => $fee) {
            $action = '
                <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$fee['id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                    <i class="fas fa-edit"></i>
                </button>
            ';
            
            array_push($result, [
                'index' => $index + 1,
                'name' => $fee['name'],
                'type' => $fee['type'],
                'amount' =>  number_format($fee['amount'], 2) ,
                'updated_at' => $fee['updated_at'] != NULL ? date('M d, Y h:i A', strtotime($fee['updated_at'])) : '',
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
        $model = new FeeModel;
        $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        $fields = ['id', 'name as text'];
        $fees = $model->search($fields, [], $data);

        return [
            "success" => true,
            "message" => "success",
            "data" => $fees
        ];
    }
    
    public function show($request) {
        $model = new FeeModel;
        $fee = $model->show(['id' => $request->id]);

        return [
            "success" => true,
            "message" => "success",
            "data" => $fee
        ];
    }

    public function update($request) {
        $fee = new FeeModel;

        $data = [
            'id' => $request->id,
            'amount' => $request->amount,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if($fee->update($data)) {

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