<?php

namespace App\Controller\Settings;
use App\Model\Settings\SignatureModel;
use App\Model\HealthOfficialModel;
use App\Model\LogModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class SignatureController extends BaseController {

    public $module = 26;
    public $action_add = 1;
    public $action_update = 2;
    public $action_delete = 3;
    public $action_read = 4;
    public $auth = [];

    public function __construct() {
        $this->auth = json_decode(auth_user());
    }

    public function all() {
        $model = new SignatureModel;
        $show_fields = [ 
            'type', 'name', 'si_signature_type', 'si_signature', 'si_position', 'sanitary_inspector_id', 
            'cho_signature_type', 'cho_signature', 'cho_position', 'city_health_officer_id', 'updated_at'
        ];
        $show_fields = Helper::appendTable('signatures', $show_fields);
        $show_fields[] = 'signatures.id as signature_id';
        $show_fields[] = 'si.image as si_image';
        $show_fields[] = 'si.status as si_status';
        $show_fields[] = 'si.suffix as si_suffix';
        $show_fields[] = 'si.first_name as si_first_name';
        $show_fields[] = 'si.middle_name as si_middle_name';
        $show_fields[] = 'si.last_name as si_last_name';

        $show_fields[] = 'cho.image as cho_image';
        $show_fields[] = 'cho.status as cho_status';
        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';

        $join_tables = [
            [ "LEFT", "health_officials as si", "signatures.sanitary_inspector_id", "si.id"],
            [ "LEFT", "health_officials as cho", "signatures.city_health_officer_id", "cho.id"],
        ];

        $signatures = $model->selects($show_fields, $join_tables);
        $result = [];

        foreach($signatures as $index => $signature) {
            $signature_names = [];
            $signature_images = [];

            if(!in_array($signature['sanitary_inspector_id'], ['', null])) {+
                $si_image_url =  Helper::imageUrl($signature['si_image']);
                $si_image_avatar_status = $signature['si_status'] == "Active" ? "avatar-online" : "avatar-offline";
                $si_suffix = in_array($signature['si_suffix'], ['', null]) ? '' : ', '.$signature['si_suffix'];
                $si_name = $signature['si_first_name'] . ' '.$signature['si_middle_name'][0].'. '.$signature['si_last_name'].$si_suffix;
                $si_avatar = '
                    <div class="avatar '.$si_image_avatar_status.'">
                        <img src="'.$si_image_url.'" alt="'.$si_name.'" class="avatar-img rounded-circle border-white">
                    </div>
                ';

                array_push($signature_names, $si_name);
                array_push($signature_images, $si_avatar);
            }

            if(!in_array($signature['city_health_officer_id'], ['', null])) {
                $cho_image_url =  Helper::imageUrl($signature['cho_image']);
                $cho_image_avatar_status = $signature['cho_status'] == "Active" ? "avatar-online" : "avatar-offline";
                $cho_suffix = in_array($signature['cho_suffix'], ['', null]) ? '' : ', '.$signature['cho_suffix'];
                $cho_name = $signature['cho_first_name'] . ' '.$signature['cho_middle_name'][0].'. '.$signature['cho_last_name'].$cho_suffix;
                $cho_avatar = '
                    <div class="avatar '.$cho_image_avatar_status.'">
                        <img src="'.$cho_image_url.'" alt="'.$cho_name.'" class="avatar-img rounded-circle border-white">
                    </div>
                ';
                
                array_push($signature_names, $cho_name);
                array_push($signature_images, $cho_avatar);
            }

            array_push($result, [
                'index' => $index + 1,
                'images' =>  '<div class="avatar-group">'.implode('', $signature_images).'</div>',
                'signatures' => implode(' & ', $signature_names),
                'name' => $signature['name'],
                'type' => $signature['type'],
                'updated_at' => $signature['updated_at'] != NULL ? date('M d, Y h:i A', strtotime($signature['updated_at'])) : '',
                'action' => '
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$signature['signature_id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                '
            ]);
        }

        return [
            "success" => true,
            "message" => "success",
            "data" => $result
        ];
    }

    public function show($request) {
        $model = new SignatureModel;
        $show_fields = [ 
            'type', 'name', 'si_signature_type', 'si_signature', 'si_position', 'sanitary_inspector_id', 
            'cho_signature_type', 'cho_signature', 'cho_position', 'city_health_officer_id', 'updated_at'
        ];
        $show_fields = Helper::appendTable('signatures', $show_fields);
        $show_fields[] = 'signatures.id as signature_id';
        $show_fields[] = 'si.image as si_image';
        $show_fields[] = 'si.status as si_status';
        $show_fields[] = 'si.suffix as si_suffix';
        $show_fields[] = 'si.first_name as si_first_name';
        $show_fields[] = 'si.middle_name as si_middle_name';
        $show_fields[] = 'si.last_name as si_last_name';

        $show_fields[] = 'cho.image as cho_image';
        $show_fields[] = 'cho.status as cho_status';
        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';

        $join_tables = [
            [ "LEFT", "health_officials as si", "signatures.sanitary_inspector_id", "si.id"],
            [ "LEFT", "health_officials as cho", "signatures.city_health_officer_id", "cho.id"],
        ];

        $wheres = [[ 'table' => 'signatures', 'key' => 'id', 'value' => $request->id ]];
        $signature = $model->select($show_fields, $join_tables,  $wheres);

        $si_suffix = in_array($signature['si_suffix'], ['', null]) ? '' : ', '.$signature['si_suffix'];
        $si_name = $signature['si_first_name'] . ' '.$signature['si_middle_name'][0].'. '.$signature['si_last_name'].$si_suffix;
        $cho_suffix = in_array($signature['cho_suffix'], ['', null]) ? '' : ', '.$signature['cho_suffix'];
        $cho_name = $signature['cho_first_name'] . ' '.$signature['cho_middle_name'][0].'. '.$signature['cho_last_name'].$cho_suffix;

        $data =  [
            'si_position' => $signature['si_position'],
            'cho_position' => $signature['cho_position'],
            'sanitary_inspector_id' => [
                'id' => $signature['sanitary_inspector_id'],
                'text' => $si_name
            ],
            'city_health_officer_id' => [
                'id' => $signature['city_health_officer_id'],
                'text' => $cho_name
            ]
        ];

        return [
            "success" => true,
            "message" => "success",
            "data" => $data
        ];
    }

    public function update($request) {
        $signature = new SignatureModel;
        $data = Helper::unsets((array) $request, ['module', 'action', 'csrf_token']);
        $data['updated_by'] = $this->auth->id;
        $data['updated_at'] = date('Y-m-d H:i:s');

        if($signature->update($data)) {

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

    public function healthOfficial($request) {
        $show_fields = ['position_id'];
        $show_fields = Helper::appendTable('health_officials', $show_fields);
        $show_fields[] = 'health_officials.id as health_official_id';
        $show_fields[] = 'occupations.name as position';

        $join_tables = [
            [ "LEFT", "occupations", "health_officials.position_id", "occupations.id"],
           
        ];
        $wheres = [[ 'table' => 'health_officials', 'key' => 'id', 'value' => $request->id ]];

        $model = new HealthOfficialModel;
        $health_official = $model->select($show_fields, $join_tables,  $wheres);
        

        return [
            "success" => true,
            "message" => "success",
            "data" => $health_official
        ];
    }

}
?>