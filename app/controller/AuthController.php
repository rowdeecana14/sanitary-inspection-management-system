<?php

namespace App\Controller;
use App\Model\LogModel;
use App\Model\Settings\UserModel;
use App\Helper\Helper;

class AuthController extends BaseController {

    public $module = 1;
    public $action_login = 6;
    public $action_logout = 7;

    public function login($request) {
        $model = new UserModel();
        $user = $model->login($request->username);

        if(!$user) {
            return [
                "success" => false,
                "message" => "Username not exist.",
            ];
        }
        
        if($user['deleted_at'] != null) {
            return [
                "success" => false,
                "message" => "Account deleted.",
            ];
        }

        if($user['status'] != 'Active') {
            return [
                "success" => false,
                "message" => "Account deactivated.",
            ];
        }
        
        if(!password_verify($request->password, $user['password'])){
            return [
                "success" => false,
                "message" => "Incorrect password.",
            ];
        }

        $_SESSION['SIMS_AUTH_USER'] = json_encode([
            'id' => $user['id'],
            'username' => $user['username'],
            'image' => Helper::imageUrl($user['image']),
            'name' =>  $user['first_name']. " ".$user['middle_name'][0].". ".$user['last_name'],
            'fname' => ucwords($user['first_name']),
            'position' => $user['position']
        ]);

        $_SESSION['SIMS_LOGIN_DATE'] = date('Y-m-d');
        $_SESSION['SIMS_LOGIN_COUNT'] = 1;

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_login,
            'record_id' => 0,
            'user_id' => $user['id']
        ]);

        return [
            "success" => true,
            "message" => "Login",
        ];
    }

    public function logout($request) {
        $auth = json_decode(auth_user());
        
        unset($_SESSION["SIMS_AUTH_USER"]); 
        unset($_SESSION["SIMS_LOGIN_DATE"]);
        unset($_SESSION["SIMS_LOGIN_COUNT"]);

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_logout,
            'record_id' => 0,
            'user_id' => $auth->id
        ]);

        return [
            "success" => true,
            "message" => "Logout",
        ];
    }
}
?>