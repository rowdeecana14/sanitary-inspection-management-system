<?php

namespace App\Controller\Settings;
use App\Model\Settings\UserModel;
use App\Model\HealthOfficialModel;
use App\Model\LogModel;
use App\Helper\Helper;
use App\Controller\BaseController;

class UserController extends BaseController {

    public $admin_id = 1;
    public $module = 1;
    public $action_add = 1;
    public $action_update = 2;
    public $action_delete = 3;
    public $action_read = 4;
    public $action_update_profile = 8;
    public $action_update_account = 9;
    public $auth = [];

    public function __construct() {
        $this->auth = json_decode(auth_user());
    }

    public function all() {
        $show_fields = [ 
            'health_official_id', 'status', 'username', 
        ];
        $show_fields = Helper::appendTable('users', $show_fields);
        $show_fields[] = 'users.id as user_id';
        $show_fields[] = 'health_officials.status as h_status';
        $show_fields[] = 'health_officials.first_name as h_first_name';
        $show_fields[] = 'health_officials.middle_name as h_middle_name';
        $show_fields[] = 'health_officials.last_name as h_last_name';
        $show_fields[] = 'health_officials.image as image';
        $show_fields[] = 'occupations.name as position';

        $join_tables = [
            [ "LEFT", "health_officials", "users.health_official_id", "health_officials.id"],
            [ "LEFT", "occupations", "health_officials.position_id", "occupations.id"],

        ];
        $model = new UserModel;
        $users = $model->selects($show_fields, $join_tables);
        $result = [];

        foreach($users as $index => $user) {
            $url =  Helper::imageUrl($user['image']);
            $badge =  $user['status'] == "Active" ? "secondary" : "default";
            $badge =  ($this->admin_id == $user['health_official_id']) ? "primary" : (($user['h_status'] == "Active") ?  'secondary' : "default");
            $health_official = $user['h_first_name'] . ' '.$user['h_middle_name'][0].'. '.$user['h_last_name'];
            $avatar_status = ($this->admin_id == $user['health_official_id']) ? "avatar-away" : (($user['status'] == "Active") ?  'avatar-online' : "avatar-offline");  
            
            $actions = '';

            if($this->admin_id != $user['health_official_id']) {
                $actions = '
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$user['user_id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$user['user_id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                ';
            }
           

            array_push($result, [
                'index' => $index + 1,
                'image' =>  '
                    <div class="avatar '.$avatar_status.'">
                    <img src="'.$url.'" alt="'.$health_official.'" class="avatar-img rounded-circle">
                    </div>',
                'name' => $health_official,
                'position' => $user['position'],
                'username' => $user['username'],
                'status' => '<span class="badge badge-'.$badge.'">'.strtoupper($user['status']).'</span>',
                'action' => $actions
            ]);
        }

        return [
            "success" => true,
            "message" => "success",
            "data" => $result
        ];
    }

    public function select2($request) {
        $model = new UserModel;
        $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        $fields = ['id', 'name as text'];
        $users = $model->search($fields, [], $data);

        return [
            "success" => true,
            "message" => "success",
            "data" => $users
        ];
    }
    
    public function store($request) {
        $data = Helper::unsets((array) $request, ['module', 'action', 'csrf_token', 'confirm_password']);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['created_by'] = $this->auth->id;

        $user = new UserModel;
        $user_id =  $user->lastInsertId($data);

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $user_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success"
        ];
    }

    public function show($request) {
        $show_fields = [ 
            'health_official_id', 'status', 'username', 
        ];
        $show_fields = Helper::appendTable('users', $show_fields);
        $show_fields[] = 'users.id as user_id';
        $show_fields[] = 'health_officials.first_name as h_first_name';
        $show_fields[] = 'health_officials.middle_name as h_middle_name';
        $show_fields[] = 'health_officials.last_name as h_last_name';
        $show_fields[] = 'health_officials.image as image';
        $show_fields[] = 'occupations.name as position';

        $join_tables = [
            [ "LEFT", "health_officials", "users.health_official_id", "health_officials.id"],
            [ "LEFT", "occupations", "health_officials.position_id", "occupations.id"],

        ];
        $model = new UserModel;
        $wheres = [[ 'table' => 'users', 'key' => 'id', 'value' => $request->id ]];
        $user = $model->select($show_fields, $join_tables,  $wheres);

        return [
            "success" => true,
            "message" => "success",
            "data" => [
                'id' =>  $user['user_id'],
                'status' => $user['status'],
                'username' => $user['username'],
                'health_official_id' => [
                    "id" => $user['health_official_id'],
                    "text" => $user['h_first_name'] . ' '.$user['h_middle_name'].' '.$user['h_last_name']
                ]
            ]
        ];
    }

    public function update($request) {
        $data = Helper::unsets((array) $request, ['module', 'action', 'csrf_token', 'confirm_password']);

        if($data['password'] == '') {
            unset($data['data']);
        }
        else {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $data['updated_by'] = $this->auth->id;
        $data['updated_at'] = date('Y-m-d H:i:s');

        $user = new UserModel;

        if($user->update($data)) {
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
        $user = new UserModel;
        $data = [
            'id' => $request->id,
            'status' => 'Inactive',
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($user->remove($data)) {
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

    public function updateProfile($request) {
        $file = '';

        if($request->image_to_upload != '') {
            $file = Helper::uploadImage($request->image_to_upload);

            $health_official = new HealthOfficialModel;
            $health_official->update([
                'id' => $this->auth->id,
                'image' => $file
            ]);

            unset($_SESSION["SIMS_AUTH_USER"]); 

            $_SESSION['SIMS_AUTH_USER'] = json_encode([
                'id' => $this->auth->id,
                'image' => Helper::imageUrl($file),
                'name' =>  $this->auth->name,
                'fname' => $this->auth->fname,
                'position' => $this->auth->position,
            ]);

            $log = new LogModel;
            $log->store([
                'requests' => json_encode($request),
                'ip' => Helper::getUserIP(),
                'module_id' => $this->module,
                'action_id' => $this->action_update_profile,
                'record_id' => $this->auth->id,
                'user_id' => $this->auth->id
            ]);
            
            return [
                "success" => true,
                "message" => "success"
            ];

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

    public function updateAccount($request) {
        $model = new UserModel;
        $user = $model->show([ "id" => $this->auth->id ]);
        $data = [
            "id" => $this->auth->id,
            "username" => $request->username,
            "password" => password_hash($request->password, PASSWORD_DEFAULT)
        ];

        if(!password_verify($request->current_password, $user['password'])){
            return [
                "success" => false,
                "message" => "Incorrect current password.",
            ];
        }

        $user = new UserModel;

        if($user->update($data)) {
            $log = new LogModel;
            $log->store([
                'requests' => json_encode($request),
                'ip' => Helper::getUserIP(),
                'module_id' => $this->module,
                'action_id' => $this->action_update_account,
                'record_id' => $this->auth->id,
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