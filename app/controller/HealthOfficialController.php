<?php

namespace App\Controller;
use App\Model\HealthOfficialModel;
use App\Model\ComplaintModel;
use App\Model\LogModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class HealthOfficialController extends BaseController {
    public $admin_id = 1;
    public $module = 17;
    public $action_add = 1;
    public $action_update = 2;
    public $action_delete = 3;
    public $action_read = 4;
    public $auth = [];

    public function __construct() {
        $this->auth = json_decode(auth_user());
    }

    public function all() {
        $model = new HealthOfficialModel;
        $show_fields = [ 
            'image', 'first_name', 'middle_name', 'last_name', 'position_id', 'gender_id', 'contact_no', 'status', 'suffix'
        ];
        $show_fields = Helper::appendTable('health_officials', $show_fields);
        $show_fields[] = 'health_officials.id as health_official_id';
        $show_fields[] = 'occupations.name as position';
        $show_fields[] = 'genders.name as gender';
        $join_tables = [
            [ "LEFT", "occupations", "health_officials.position_id", "occupations.id"],
            [ "LEFT", "genders", "health_officials.gender_id", "genders.id"],
        ];

        $health_officials = $model->selects($show_fields, $join_tables);
        $result = [];

        foreach($health_officials as $index => $health_official) {

            $badge =  ($this->admin_id == $health_official['health_official_id']) ? "primary" : (($health_official['status'] == "Active") ?  'secondary' : "default");

            $suffix = ($health_official['suffix'] == '' || $health_official['suffix'] == null) ? '' : ', '.$health_official['suffix'];
            $name = $health_official['first_name'] . ' '.$health_official['middle_name'][0].'. '.$health_official['last_name'].' '.$suffix;
            $avatar_status = $health_official['status'] == ($this->admin_id == $health_official['health_official_id']) ? "avatar-away" : (($health_official['status'] == "Active") ?  'avatar-online' : "avatar-offline"); 
            $url =  Helper::imageUrl($health_official['image']);

            $actions = '';
            
            if($this->admin_id !== $health_official['health_official_id']) {
                $actions = '
                    <button type="button" class="btn btn-icon btn-round btn-info btn-show"  data-id="'.$health_official['health_official_id'].'" data-toggle="tooltip" data-placement="top" title="View record">
                        <i class="fas fa-search"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$health_official['health_official_id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$health_official['health_official_id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                ';
            }
                
            array_push($result, [
                'index' => $index + 1,
                'image' => '
                    <div class="avatar '.$avatar_status.'">
                        <img src="'.$url.'" alt="'.$name.'" class="avatar-img rounded-circle">
                    </div>
                ',
                'name' => $name,
                'position' => $health_official['position'],
                'gender' => $health_official['gender'],
                'contact_no' => $health_official['contact_no'],
                'status' => '<span class="badge badge-'.$badge.'">'.strtoupper($health_official['status']).'</span>',
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
        $health_official = new HealthOfficialModel;
        $data = isset($request->q) ? [ 'first_name' => $request->q, 'middle_name' => $request->q , 'last_name' => $request->q  ] : [];
        $fields = ['id', 'first_name', 'middle_name', 'last_name', 'suffix'];
        $health_officials = $health_official->search($fields, [], $data);
        $result = [];

        foreach($health_officials as $health_official) {
            $suffix = ($health_official['suffix'] == '' || $health_official['suffix'] == null) ? '' : ', '.$health_official['suffix'];

            array_push($result, [
                'id' => $health_official['id'],
                'text' => $health_official['first_name'] . ' '.$health_official['middle_name'][0].'. '.$health_official['last_name'].' '.$suffix,
            ]);
        }

        return [
            "success" => true,
            "message" => "success",
            "data" => $result
        ];
    }
    
    public function store($request) {
        $file = Helper::uploadImage($request->image_to_upload);
        $health_official = new HealthOfficialModel;
        $data = Helper::unsets((array) $request, ['module', 'action', 'csrf_token', 'profileimg', 'image', 'image_to_upload']);
        $data['birth_date'] = Helper::dateParser($data['birth_date']); 
        $data['created_by'] = $this->auth->id;
        $data['image'] = isset($request->image_to_upload) & $request->image_to_upload != null ? $file : null;
        $health_official_id =  $health_official->lastInsertId($data);

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $health_official_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success"
        ];
    }

    public function show($request) {
        $model = new HealthOfficialModel;
        $show_fields = [ 
            'image', 'first_name', 'middle_name', 'last_name', 'position_id', 'gender_id', 'contact_no', 'license_no',
            'civil_status_id', 'purok_id', 'baranggay_id', 'status', 'email', 'birth_date', 'suffix', 'street_building_house'
        ];
        $show_fields = Helper::appendTable('health_officials', $show_fields);
        $show_fields[] = 'health_officials.id as health_official_id';
        $show_fields[] = 'occupations.name as position';
        $show_fields[] = 'genders.name as gender';
        $show_fields[] = 'civil_statuses.name as civil_status';
        $show_fields[] = 'baranggays.name as baranggay';
        $show_fields[] = 'puroks.name as purok';

        $join_tables = [
            [ "LEFT", "occupations", "health_officials.position_id", "occupations.id"],
            [ "LEFT", "genders", "health_officials.gender_id", "genders.id"],
            [ "LEFT", "civil_statuses", "health_officials.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "baranggays", "health_officials.baranggay_id", "baranggays.id"],
            [ "LEFT", "puroks", "health_officials.purok_id", "puroks.id"],
        ];
        $wheres = [[ 'table' => 'health_officials', 'key' => 'id', 'value' => $request->id ]];
        $health_official = $model->select($show_fields, $join_tables,  $wheres);

        $health_official['id'] = $health_official['health_official_id'];
        $health_official['birth_date'] = date('m/d/Y', strtotime($health_official['birth_date']));
        $health_official['image_profile']  =  Helper::imageUrl($health_official['image']);
        $health_official['position_id'] = [
            "id" => $health_official['position_id'],
            "text" => $health_official['position'],
        ];
        $health_official['gender_id'] = [
            "id" => $health_official['gender_id'],
            "text" => $health_official['gender'],
        ];
        $health_official['civil_status_id'] = [
            "id" => $health_official['civil_status_id'],
            "text" => $health_official['civil_status'],
        ];
        $health_official['purok_id'] = [
            "id" => $health_official['purok_id'],
            "text" => $health_official['purok'],
        ];
        $health_official['baranggay_id'] = [
            "id" => $health_official['baranggay_id'],
            "text" => $health_official['baranggay'],
        ];

        return [
            "success" => true,
            "message" => "success",
            "data" => $health_official
        ];
    }

    public function profile($request) {
        // CASE HANDLE COMPLAINT
        $model = new HealthOfficialModel;
        $show_fields = [ 
            'image', 'first_name', 'middle_name', 'last_name', 'position_id', 'gender_id', 'contact_no', 'civil_status_id', 'purok_id',
             'baranggay_id', 'status', 'email', 'birth_date', 'created_at', 'updated_at', 'updated_by', 'created_by', 'license_no'
        ];
        $show_fields = Helper::appendTable('health_officials', $show_fields);
        $show_fields[] = 'health_officials.id as health_official_id';
        $show_fields[] = 'TIMESTAMPDIFF(YEAR, health_officials.birth_date, CURDATE()) as age';
        
        $show_fields[] = 'occupations.name as position';
        $show_fields[] = 'genders.name as gender';
        $show_fields[] = 'civil_statuses.name as civil_status';
        $show_fields[] = 'baranggays.name as baranggay';
        $show_fields[] = 'puroks.name as purok';

        $show_fields[] = 'creator.suffix as creator_suffix';
        $show_fields[] = 'creator.first_name as creator_first_name';
        $show_fields[] = 'creator.middle_name as creator_middle_name';
        $show_fields[] = 'creator.last_name as creator_last_name';

        $show_fields[] = 'updator.suffix as updator_suffix';
        $show_fields[] = 'updator.first_name as updator_first_name';
        $show_fields[] = 'updator.middle_name as updator_middle_name';
        $show_fields[] = 'updator.last_name as updator_last_name';

        $join_tables = [
            [ "LEFT", "occupations", "health_officials.position_id", "occupations.id"],
            [ "LEFT", "genders", "health_officials.gender_id", "genders.id"],
            [ "LEFT", "civil_statuses", "health_officials.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "baranggays", "health_officials.baranggay_id", "baranggays.id"],
            [ "LEFT", "puroks", "health_officials.purok_id", "puroks.id"],

            [ "LEFT", "users as creator_user", "health_officials.created_by", "creator_user.id"],
            [ "LEFT", "health_officials as creator", "creator_user.health_official_id", "creator.id"],
            [ "LEFT", "users as updator_user", "health_officials.updated_by", "updator_user.id"],
            [ "LEFT", "health_officials as updator", "updator_user.health_official_id", "updator.id"],
        ];
        $wheres = [[ 'table' => 'health_officials', 'key' => 'id', 'value' => $request->id ]];
        $health_official = $model->select($show_fields, $join_tables,  $wheres);

        $health_official['birth_date'] = Helper::humanDate('M d, Y', $health_official['birth_date']);
        $health_official['created_at'] = Helper::humanDate('M d, Y h:i A', $health_official['created_at']);
        $health_official['updated_at'] = Helper::humanDate('M d, Y h:i A', $health_official['updated_at']);
        $health_official['image_profile']  =  Helper::imageUrl($health_official['image']);
        $health_official['address']  = $health_official['purok']. ', '.$health_official['baranggay'];
        $health_official['fullname'] = $health_official['first_name'] . ' '.$health_official['middle_name'].' '.$health_official['last_name'];
        $creator_suffix = in_array($health_official['creator_suffix'], ['', null]) ? '' : ', '.$health_official['creator_suffix'];
        $creator_name = $health_official['creator_first_name'] . ' '.$health_official['creator_middle_name'][0].'. '.$health_official['creator_last_name'].$creator_suffix;
        $health_official['created_by'] = $creator_name;

        $updator_suffix = in_array($health_official['updator_suffix'], ['', null]) ? '' : ', '.$health_official['updator_suffix'];
        $updator_name = $health_official['updator_first_name'] . ' '.$health_official['updator_middle_name'][0].'. '.$health_official['updator_last_name'].$updator_suffix;
        $health_official['updated_by'] = isset($health_official['updated_by']) ?  $updator_name : '';
        // START COMPLAINTS
        $show_fields = [ 
            'complainant_id', 'respondent_id', 'person_involved_id', 'complaint_type_id', 'complaint_status_id', 'action_taken',
            'date_reported'
        ];
        $show_fields = Helper::appendTable('complaints', $show_fields);
        $show_fields[] = 'complaints.id as complaint_id';
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';
        $show_fields[] = 'tbl_person_involved.first_name as pi_first_name';
        $show_fields[] = 'tbl_person_involved.middle_name as pi_middle_name';
        $show_fields[] = 'tbl_person_involved.last_name as pi_last_name';
        $show_fields[] = 'complaint_statuses.name as complaint_status';
        $show_fields[] = 'complaint_types.name as complaint_type';

        $join_tables = [
            [ "LEFT", "residents", "complaints.complainant_id", "residents.id"],
            [ "LEFT", "residents as tbl_person_involved", "complaints.person_involved_id", "tbl_person_involved.id"],
            [ "LEFT", "complaint_types", "complaints.complaint_type_id", "complaint_types.id"],
            [ "LEFT", "complaint_statuses", "complaints.complaint_status_id", "complaint_statuses.id"],
        ];
        $wheres = [[ 'table' => 'complaints', 'key' => 'respondent_id', 'value' => $request->id ]];

        $complaint = new ComplaintModel;
        $complaints = $complaint->selects($show_fields, $join_tables, $wheres);
        $complaints_result = [];

        foreach($complaints as $index => $complaint) {
            $complainant = $complaint['r_first_name'] . ' '.$complaint['r_middle_name'][0].' '.$complaint['r_last_name'];
            $person_involved = $complaint['pi_first_name'] . ' '.$complaint['pi_middle_name'][0].' '.$complaint['pi_last_name'];

            array_push($complaints_result, [
                'index' =>  $index + 1,
                'complainant' => $complainant,
                'person_involved' => $person_involved,
                'action_taken' => $complaint['action_taken'],
                'date_reported' => Helper::humanDate('M d, Y', $complaint['date_reported']),
                'status' =>  $complaint['complaint_status'],
            ]);
        }
        // END COMPLAINTS

        return [
            "success" => true,
            "message" => "success",
            "data" => [
                "profile" => $health_official,
                "case_handles" => $complaints_result,
            ],
        ];
    }

    public function update($request) {
        $file = '';

        if($request->image_to_upload != '') {
            $file = Helper::uploadImage($request->image_to_upload);
        }

        $health_official = new HealthOfficialModel;
        $data = Helper::unsets((array) $request,  ['module', 'action', 'csrf_token', 'profileimg', 'image', 'image_to_upload']);
        $data['birth_date'] = Helper::dateParser($data['birth_date']); 
        $data['updated_by'] = $this->auth->id;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if($request->image_to_upload != '') {
            $data['image'] = $file;
        }
        else {
            unset($data['image']);
        }

        if($health_official->update($data)) {

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
        date_default_timezone_set('Asia/Manila');
        $health_official = new HealthOfficialModel;
        $data = [
            'id' => $request->id,
            'status' => 'Inactive',
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($health_official->remove($data)) {

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