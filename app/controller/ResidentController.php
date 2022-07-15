<?php

namespace App\Controller;
use App\Model\ResidentModel;
use App\Model\LogModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class ResidentController extends BaseController {

    public $module = 16;
    public $action_add = 1;
    public $action_update = 2;
    public $action_delete = 3;
    public $action_read = 4;
    public $auth = [];

    public function __construct() {
        $this->auth = json_decode(auth_user());
    }

    public function all() {
        $model = new ResidentModel;
        $show_fields = [ 
            'image', 'first_name', 'middle_name', 'last_name', 'national_id', 'birth_date', 
            'voter_status', 'person_disability_id', 'status'
        ];
        $show_fields = Helper::appendTable('residents', $show_fields);
        $show_fields[] = 'residents.id as resident_id';
        $show_fields[] = 'genders.name as gender';
        $show_fields[] = 'person_disabilities.name as person_disability';
        $join_tables = [
            [ "LEFT", "genders", "residents.gender_id", "genders.id"],
            [ "LEFT", "person_disabilities", "residents.person_disability_id", "person_disabilities.id"],
        ];

        $residents = $model->selects($show_fields, $join_tables);
        $result = [];

        foreach($residents as $index => $resident) {
            $status_badge =  $resident['status'] == "Active" ? "secondary" : "default";
            $voter_status_badge =  $resident['voter_status'] == "Active" ? "secondary" : "default";
            $pwd_status =  strtolower($resident['person_disability']) == "none" ? "default" : "secondary";
            $pwd = strtolower($resident['person_disability']) == "none" ? "NO" : "YES";

            $name = $resident['first_name'] . ' '.$resident['middle_name'][0].'. '.$resident['last_name'];
            $avatar_status = $resident['status'] == "Active" ? "avatar-online" : "avatar-offline";
            $url =  Helper::imageUrl($resident['image']);

            array_push($result, [
                'index' => $index + 1,
                'image' => '
                    <div class="avatar '.$avatar_status.'">
                        <img src="'.$url.'" alt="'.$name.'" class="avatar-img rounded-circle">
                    </div>
                ',
                'name' => $name,
                'national_id' => $resident['national_id'],
                'age' =>  Helper::age($resident['birth_date']),
                'gender' => $resident['gender'],
                'voter_status' => '<span class="badge badge-'.$voter_status_badge.'">'.strtoupper($resident['voter_status']).'</span>',
                'pwd' => '<span class="badge badge-'.$pwd_status.'">'.$pwd.'</span>',
                'status' => '<span class="badge badge-'.$status_badge.'">'.strtoupper($resident['status']).'</span>',
                'action' => '
                    <button type="button" class="btn btn-icon btn-round btn-info btn-show"  data-id="'.$resident['resident_id'].'" data-toggle="tooltip" data-placement="top" title="View record">
                        <i class="fas fa-search"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$resident['resident_id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$resident['resident_id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
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
        $resident = new ResidentModel;
        $data = isset($request->q) ? [ 'first_name' => $request->q, 'middle_name' => $request->q , 'last_name' => $request->q  ] : [];
        $fields = ['id', "concat(first_name,' ', middle_name, ' ', last_name) as text"];
        $residents = $resident->search($fields, [], $data);

        return [
            "success" => true,
            "message" => "success",
            "data" => $residents
        ];
    }

    public function store($request) {
        $file = Helper::uploadImage($request->image_to_upload);
        $resident = new ResidentModel;
        $data = Helper::unsets((array) $request, ['module', 'action', 'csrf_token', 'profileimg', 'image', 'image_to_upload']);
        $data['birth_date'] = Helper::dateParser($data['birth_date']); 
        $data['created_by'] = $this->auth->id;
        $data['image'] = isset($request->image_to_upload) & $request->image_to_upload != null ? $file : null;
        $resident_id =  $resident->lastInsertId($data);

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $resident_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success"
        ];
    }

    public function show($request) {
        $model = new ResidentModel;
        $show_fields = [ 
            'image', 'first_name', 'middle_name', 'last_name', 'national_id', 'voter_status', 'birth_date',
            'email', 'contact_no',  'street_building_house', 'weight', 'height', 'monthly_income', 'skills', 'total_household_member',
            'land_ownerships', 'house_ownerships', 'water_usages', 'lighting_facilities', 'status',
            'civil_status_id', 'person_disability_id', 'gender_id', 'position_id', 'citizenship_id',
            'baranggay_id', 'purok_id', 'blood_type_id', 'educational_attainment_id'
        ];

        $show_fields = Helper::appendTable('residents', $show_fields);
        $show_fields[] = 'residents.id as resident_id';
        $show_fields[] = 'civil_statuses.name as civil_status';
        $show_fields[] = 'person_disabilities.name as person_disability';
        $show_fields[] = 'genders.name as gender';
        $show_fields[] = 'occupations.name as position';
        $show_fields[] = 'citizenships.name as citizenship';
        $show_fields[] = 'baranggays.name as baranggay';
        $show_fields[] = 'puroks.name as purok';
        $show_fields[] = 'blood_types.name as blood_type';
        $show_fields[] = 'educational_attainments.name as educational_attainment';

        $join_tables = [
            [ "LEFT", "civil_statuses", "residents.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "person_disabilities", "residents.person_disability_id", "person_disabilities.id"],
            [ "LEFT", "genders", "residents.gender_id", "genders.id"],
            [ "LEFT", "occupations", "residents.position_id", "occupations.id"],
            [ "LEFT", "citizenships", "residents.citizenship_id", "citizenships.id"],
            [ "LEFT", "baranggays", "residents.baranggay_id", "baranggays.id"],
            [ "LEFT", "puroks", "residents.purok_id", "puroks.id"],
            [ "LEFT", "blood_types", "residents.blood_type_id", "blood_types.id"],
            [ "LEFT", "educational_attainments", "residents.educational_attainment_id", "educational_attainments.id"],
        ];
        $wheres = [[ 'table' => 'residents', 'key' => 'id', 'value' => $request->id ]];
        $resident = $model->select($show_fields, $join_tables,  $wheres);

        $resident['id'] = $resident['resident_id'];
        $resident['birth_date'] = Helper::dateParserShow($resident['birth_date']);
        $resident['monthly_income'] = number_format($resident['monthly_income'], 2);
        $resident['image_profile']  =  Helper::imageUrl($resident['image']);
        $resident['civil_status_id'] = [
            "id" => $resident['civil_status_id'],
            "text" => $resident['civil_status'],
        ];
        $resident['person_disability_id'] = [
            "id" => $resident['person_disability_id'],
            "text" => $resident['person_disability'],
        ];
        $resident['gender_id'] = [
            "id" => $resident['gender_id'],
            "text" => $resident['gender'],
        ];
        $resident['position_id'] = [
            "id" => $resident['position_id'],
            "text" => $resident['position'],
        ];
        $resident['citizenship_id'] = [
            "id" => $resident['citizenship_id'],
            "text" => $resident['citizenship'],
        ];
        $resident['baranggay_id'] = [
            "id" => $resident['baranggay_id'],
            "text" => $resident['baranggay'],
        ];
        $resident['purok_id'] = [
            "id" => $resident['purok_id'],
            "text" => $resident['purok'],
        ];
        $resident['blood_type_id'] = [
            "id" => $resident['blood_type_id'],
            "text" => $resident['blood_type'],
        ];
        $resident['educational_attainment_id'] = [
            "id" => $resident['educational_attainment_id'],
            "text" => $resident['educational_attainment'],
        ];

        return [
            "success" => true,
            "message" => "success",
            "data" => $resident
        ];
    }

    public function profile($request) {
        $model = new ResidentModel;
        $show_fields = [ 
            'image', 'first_name', 'middle_name', 'last_name', 'national_id', 'voter_status', 'birth_date',
            'email', 'contact_no',  'street_building_house', 'weight', 'height', 'monthly_income', 'skills', 'total_household_member',
            'land_ownerships', 'house_ownerships', 'water_usages', 'lighting_facilities', 'status', 'created_at', 
            'updated_at', 'updated_by', 'created_by',
            'civil_status_id', 'person_disability_id', 'gender_id', 'position_id', 'citizenship_id',
            'baranggay_id', 'purok_id', 'blood_type_id', 'educational_attainment_id'
        ];
        $show_fields = Helper::appendTable('residents', $show_fields);
        $show_fields[] = 'residents.id as resident_id';
        $show_fields[] = 'civil_statuses.name as civil_status';
        $show_fields[] = 'person_disabilities.name as person_disability';
        $show_fields[] = 'genders.name as gender';
        $show_fields[] = 'occupations.name as position';
        $show_fields[] = 'citizenships.name as citizenship';
        $show_fields[] = 'baranggays.name as baranggay';
        $show_fields[] = 'puroks.name as purok';
        $show_fields[] = 'blood_types.name as blood_type';
        $show_fields[] = 'educational_attainments.name as educational_attainment';

        $show_fields[] = 'creator.suffix as creator_suffix';
        $show_fields[] = 'creator.first_name as creator_first_name';
        $show_fields[] = 'creator.middle_name as creator_middle_name';
        $show_fields[] = 'creator.last_name as creator_last_name';

        $show_fields[] = 'updator.suffix as updator_suffix';
        $show_fields[] = 'updator.first_name as updator_first_name';
        $show_fields[] = 'updator.middle_name as updator_middle_name';
        $show_fields[] = 'updator.last_name as updator_last_name';

        $join_tables = [
            [ "LEFT", "civil_statuses", "residents.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "person_disabilities", "residents.person_disability_id", "person_disabilities.id"],
            [ "LEFT", "genders", "residents.gender_id", "genders.id"],
            [ "LEFT", "occupations", "residents.position_id", "occupations.id"],
            [ "LEFT", "citizenships", "residents.citizenship_id", "citizenships.id"],
            [ "LEFT", "baranggays", "residents.baranggay_id", "baranggays.id"],
            [ "LEFT", "puroks", "residents.purok_id", "puroks.id"],
            [ "LEFT", "blood_types", "residents.blood_type_id", "blood_types.id"],
            [ "LEFT", "educational_attainments", "residents.educational_attainment_id", "educational_attainments.id"],

            [ "LEFT", "users as creator_user", "residents.created_by", "creator_user.id"],
            [ "LEFT", "health_officials as creator", "creator_user.health_official_id", "creator.id"],
            [ "LEFT", "users as updator_user", "residents.updated_by", "updator_user.id"],
            [ "LEFT", "health_officials as updator", "updator_user.health_official_id", "updator.id"], 
        ];
        $wheres = [[ 'table' => 'residents', 'key' => 'id', 'value' => $request->id ]];
        $resident = $model->select($show_fields, $join_tables,  $wheres);

        $resident['id'] = $resident['resident_id'];
        $resident['age'] = Helper::age($resident['birth_date']);
        $resident['birth_date'] = Helper::dateParserProfile($resident['birth_date']);
        $resident['created_at'] = Helper::humanDate('M d, Y h:i A', $resident['created_at']);
        $resident['updated_at'] = Helper::humanDate('M d, Y h:i A', $resident['updated_at']);
        $resident['image_profile']  =  Helper::imageUrl($resident['image']);
        $resident['address']  =  $resident['street_building_house'].', '.$resident['purok']. ', '.$resident['baranggay'];
        $resident['fullname'] = $resident['first_name'] . ' '.$resident['middle_name'].' '.$resident['last_name'];
        $resident['monthly_income'] = number_format($resident['monthly_income'], 2);
        $resident['land_ownerships'] = implode(', ', explode(',', $resident['land_ownerships']));
        $resident['house_ownerships'] = implode(', ', explode(',', $resident['house_ownerships']));
        $resident['water_usages'] = implode(', ', explode(',', $resident['land_ownerships']));
        $resident['lighting_facilities'] = implode(', ', explode(',', $resident['lighting_facilities']));

        $creator_suffix = in_array($resident['creator_suffix'], ['', null]) ? '' : ', '.$resident['creator_suffix'];
        $creator_name = $resident['creator_first_name'] . ' '.$resident['creator_middle_name'][0].'. '.$resident['creator_last_name'].$creator_suffix;
        $resident['created_by'] = $creator_name;

        $updator_suffix = in_array($resident['updator_suffix'], ['', null]) ? '' : ', '.$resident['updator_suffix'];
        $updator_name = $resident['updator_first_name'] . ' '.$resident['updator_middle_name'][0].'. '.$resident['updator_last_name'].$updator_suffix;
        $resident['updated_by'] = $updator_name;
        $resident['updated_by'] = isset($resident['updated_by']) ?  $updator_name : '';

        return [
            "success" => true,
            "message" => "success",
            "data" => $resident
        ];
    }

    public function update($request) {
        $file = '';

        if($request->image_to_upload != '') {
            $file = Helper::uploadImage($request->image_to_upload);
        }

        $resident = new ResidentModel;
        $data = Helper::unsets((array) $request,  ['module', 'action', 'csrf_token', 'profileimg', 'image', 'image_to_upload']);
        $data['birth_date'] = Helper::dateParser($data['birth_date']); 
        $data['updated_by'] =  $this->auth->id;
        $data['updated_at'] = date('Y-m-d H:i:s');

        if($request->image_to_upload != '') {
            $data['image'] = $file;
        }
        else {
            unset($data['image']);
        }

        if($resident->update($data)) {

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
        $resident = new ResidentModel;
        $data = [
            'id' => $request->id,
            'status' => 'Inactive',
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($resident->remove($data)) {
            
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