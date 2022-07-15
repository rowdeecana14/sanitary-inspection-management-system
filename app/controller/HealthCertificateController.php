<?php

namespace App\Controller;
use App\Model\ResidentModel;
use App\Model\HealthCertificateModel;
use App\Model\HealthCertificateSignatureModel;
use App\Model\LogModel;
use App\Model\Settings\SignatureModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class HealthCertificateController extends BaseController {

    public $health_certificate_signature_id = 3;
    public $module = 22;
    public $action_add = 1;
    public $action_update = 2;
    public $action_delete = 3;
    public $action_read = 4;
    public $auth = [];

    public function __construct() {
        $this->auth = json_decode(auth_user());
    }

    public function all() {
        $show_fields = [ 
            'issued_at', 'resident_id', 'occupation_id', 'place_of_work', 'age', 'gender_id', 'register_no'
        ];

        $show_fields = Helper::appendTable('health_certificates', $show_fields);
        $show_fields[] = 'health_certificates.id as heath_certificate_id';
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';
        $show_fields[] = 'occupations.name as occupation';
        $show_fields[] = 'genders.name as gender';

        $join_tables = [
            [ "LEFT", "residents", "health_certificates.resident_id", "residents.id"],
            [ "LEFT", "occupations", "health_certificates.occupation_id", "occupations.id"],
            [ "LEFT", "genders", "health_certificates.gender_id", "genders.id"],

        ];

        $model = new HealthCertificateModel;
        $health_certificates = $model->selects($show_fields, $join_tables);
        $result = [];

        foreach($health_certificates as $index => $heath_certificate) {
            $resident = $heath_certificate['r_first_name'] . ' '.$heath_certificate['r_middle_name'][0].' '.$heath_certificate['r_last_name'];
            
            array_push($result, [
                'index' => $index + 1,
                'register_no' => str_pad($heath_certificate['register_no'], 6, "0", STR_PAD_LEFT),
                'resident' => $resident,
                'age' => $heath_certificate['age'],
                'gender' => $heath_certificate['gender'],
                'occupation' => $heath_certificate['occupation'],
                'place_of_work' => $heath_certificate['place_of_work'],
                'issued_at' => Helper::humanDate('M d, Y', $heath_certificate['issued_at']),
                'action' => ' 
                    <button type="button" class="btn btn-icon btn-round btn-secondary btn-print"  data-id="'.$heath_certificate['heath_certificate_id'].'"  data-toggle="tooltip" data-placement="top" title="Print Certificate">
                        <i class="fas fa-print"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$heath_certificate['heath_certificate_id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$heath_certificate['heath_certificate_id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
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

    public function resident($request) {
        $model = new ResidentModel;
        $show_fields = [ 
            'birth_date', 'street_building_house', 'height', "weight", 'civil_status_id', 'gender_id', 'position_id',
            'baranggay_id', 'purok_id', 'position_id'
        ];

        $show_fields = Helper::appendTable('residents', $show_fields);
        $show_fields[] = 'residents.id as resident_id';
        $show_fields[] = 'civil_statuses.name as civil_status';
        $show_fields[] = 'genders.name as gender';
        $show_fields[] = 'baranggays.name as baranggay';
        $show_fields[] = 'puroks.name as purok';
        $show_fields[] = 'occupations.name as occupation';

        $join_tables = [
            [ "LEFT", "civil_statuses", "residents.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "genders", "residents.gender_id", "genders.id"],
            [ "LEFT", "baranggays", "residents.baranggay_id", "baranggays.id"],
            [ "LEFT", "puroks", "residents.purok_id", "puroks.id"],
            [ "LEFT", "occupations", "residents.position_id", "occupations.id"],
        ];
        $wheres = [[ 'table' => 'residents', 'key' => 'id', 'value' => $request->id ]];
        $resident = $model->select($show_fields, $join_tables,  $wheres);
        $data = [
            "height" =>  $resident['height'],
            "weight" =>  $resident['weight'],
            "street_building_house" => $resident['street_building_house'],
            "age" => Helper::age($resident['birth_date']),
            "civil_status_id" => [
                "id" => $resident['civil_status_id'],
                "text" => $resident['civil_status'],
            ],
            "gender_id" => [
                "id" => $resident['gender_id'],
                "text" => $resident['gender'],
            ],
            "baranggay_id" => [
                "id" => $resident['baranggay_id'],
                "text" => $resident['baranggay'],
            ],
            "purok_id" =>  [
                "id" => $resident['purok_id'],
                "text" => $resident['purok'],
            ],
            "occupation_id" =>  [
                "id" => $resident['position_id'],
                "text" => $resident['occupation'],
            ]
        ];

        return [
            "success" => true,
            "message" => "success",
            "data" => $data
        ];
    }

    public function select2($request) {
        // $model = new HealthCertificateModel;
        // $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        // $fields = ['id', 'name as text'];
        // $heath_certificate = $model->search($fields, [], $data);

        // return [
        //     "success" => true,
        //     "message" => "success",
        //     "data" => $heath_certificate
        // ];
    }

    public function getSignatures() {
        $signature_model = new SignatureModel;
        $show_fields = [ 
            'si_position', 'sanitary_inspector_id', 'cho_position', 'city_health_officer_id'
        ];
        $show_fields = Helper::appendTable('signatures', $show_fields);
        $show_fields[] = 'signatures.id as signature_id';
        $show_fields[] = 'si.suffix as si_suffix';
        $show_fields[] = 'si.first_name as si_first_name';
        $show_fields[] = 'si.middle_name as si_middle_name';
        $show_fields[] = 'si.last_name as si_last_name';

        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';

        $join_tables = [
            [ "LEFT", "health_officials as si", "signatures.sanitary_inspector_id", "si.id"],
            [ "LEFT", "health_officials as cho", "signatures.city_health_officer_id", "cho.id"],
        ];

        $wheres = [[ 'table' => 'signatures', 'key' => 'id', 'value' => $this->health_certificate_signature_id ]];
        $signature = $signature_model->select($show_fields, $join_tables,  $wheres);

        $si_suffix = in_array($signature['si_suffix'], ['', null]) ? '' : ', '.$signature['si_suffix'];
        $si_name = $signature['si_first_name'] . ' '.$signature['si_middle_name'][0].'. '.$signature['si_last_name'].$si_suffix;
        $cho_suffix = in_array($signature['cho_suffix'], ['', null]) ? '' : ', '.$signature['cho_suffix'];
        $cho_name = $signature['cho_first_name'] . ' '.$signature['cho_middle_name'][0].'. '.$signature['cho_last_name'].$cho_suffix;

        return  [
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
    }
    
    public function store($request) {
        $signatures = $this->getSignatures();
        $health_certificate_signature = new HealthCertificateSignatureModel;
        $health_certificate_signature_id = $health_certificate_signature->lastInsertId([
            'sanitary_inspector_id' => $signatures['sanitary_inspector_id']['id'],
            'sanitary_inspector_position' => $signatures['si_position'],
            'city_health_officer_id' => $signatures['city_health_officer_id']['id'],
            'city_health_officer_position' => $signatures['cho_position'],
            'created_by' => $this->auth->id
        ]);

        $heath_certificate = new HealthCertificateModel;
        $last_row = $heath_certificate->getLastRow();
        $register_no = isset($last_row['register_no']) ? (int) $last_row['register_no'] + 1  : 1;

        $data = Helper::unsets((array) $request, [
            'module', 'action', 'csrf_token', 'sanitary_inspector_id', 'sanitary_inspector_id', 
            'cho_position', 'city_health_officer_id', 'si_position'
        ]);
        $data['issued_at'] = date('Y-m-d', strtotime($data['issued_at']));
        $data['health_certificate_signature_id'] = $health_certificate_signature_id;
        $data['register_no'] = $register_no;
        $data['created_by'] = $this->auth->id;
        $heath_certificate_id =  $heath_certificate->lastInsertId($data);

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $heath_certificate_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success",
            "data" => [
                'id' => $heath_certificate_id,
            ]
        ];
    }

    public function show($request) {
        $model = new HealthCertificateModel;
        $show_fields = [ 
           'issued_at', 'resident_id', 'age', 'occupation_id', 'place_of_work',
           'street_building_house', 'purok_id', 'baranggay_id', 'gender_id', 'civil_status_id'
        ];
        $show_fields = Helper::appendTable('health_certificates', $show_fields);
        $show_fields[] = 'health_certificates.id as heath_certificate_id';
        $show_fields[] = 'civil_statuses.name as civil_status';
        $show_fields[] = 'genders.name as gender';
        $show_fields[] = 'baranggays.name as baranggay';
        $show_fields[] = 'puroks.name as purok';
        $show_fields[] = 'occupations.name as occupation';

        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';

        $show_fields[] = 'si.suffix as si_suffix';
        $show_fields[] = 'si.first_name as si_first_name';
        $show_fields[] = 'si.middle_name as si_middle_name';
        $show_fields[] = 'si.last_name as si_last_name';
        $show_fields[] = 'health_certificate_signatures.sanitary_inspector_id';
        $show_fields[] = 'health_certificate_signatures.sanitary_inspector_position as si_position';

        $show_fields[] = 'cho.status as cho_status';
        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';
        $show_fields[] = 'health_certificate_signatures.city_health_officer_id';
        $show_fields[] = 'health_certificate_signatures.city_health_officer_position as cho_position';

        $join_tables = [
            [ "LEFT", "residents", "health_certificates.resident_id", "residents.id"],
            [ "LEFT", "civil_statuses", "health_certificates.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "genders", "health_certificates.gender_id", "genders.id"],
            [ "LEFT", "baranggays", "health_certificates.baranggay_id", "baranggays.id"],
            [ "LEFT", "puroks", "health_certificates.purok_id", "puroks.id"],
            [ "LEFT", "occupations", "health_certificates.occupation_id", "occupations.id"],
            [ "LEFT", "health_certificate_signatures", "health_certificates.health_certificate_signature_id", "health_certificate_signatures.id"],
            [ "LEFT", "health_officials as si", "health_certificate_signatures.sanitary_inspector_id", "si.id"],
            [ "LEFT", "health_officials as cho", "health_certificate_signatures.city_health_officer_id", "cho.id"],
        ];
        $wheres = [[ 'table' => 'health_certificates', 'key' => 'id', 'value' => $request->id ]];
        
        $heath_certificate = $model->select($show_fields, $join_tables,  $wheres);
        $heath_certificate['issued_at'] =  Helper::humanDate('m/d/Y', $heath_certificate['issued_at']);
        $resident = $heath_certificate['r_first_name'] . ' '.$heath_certificate['r_middle_name'][0].' '.$heath_certificate['r_last_name'];

        $si_suffix = in_array($heath_certificate['si_suffix'], ['', null]) ? '' : ', '.$heath_certificate['si_suffix'];
        $si_name = $heath_certificate['si_first_name'] . ' '.$heath_certificate['si_middle_name'][0].'. '.$heath_certificate['si_last_name'].$si_suffix;
        $cho_suffix = in_array($heath_certificate['cho_suffix'], ['', null]) ? '' : ', '.$heath_certificate['cho_suffix'];
        $cho_name = $heath_certificate['cho_first_name'] . ' '.$heath_certificate['cho_middle_name'][0].'. '.$heath_certificate['cho_last_name'].$cho_suffix;

        $heath_certificate['resident_id'] = [
            "id" => $heath_certificate['resident_id'],
            "text" => $resident,
        ];
        $heath_certificate['purok_id'] = [
            "id" => $heath_certificate['purok_id'],
            "text" => $heath_certificate['purok'],
        ];
        $heath_certificate['baranggay_id'] = [
            "id" => $heath_certificate['baranggay_id'],
            "text" => $heath_certificate['baranggay'],
        ];
        $heath_certificate['gender_id'] = [
            "id" => $heath_certificate['gender_id'],
            "text" => $heath_certificate['gender'],
        ];
        $heath_certificate['civil_status_id'] = [
            "id" => $heath_certificate['civil_status_id'],
            "text" => $heath_certificate['civil_status'],
        ];
        $heath_certificate['occupation_id'] = [
            "id" => $heath_certificate['occupation_id'],
            "text" => $heath_certificate['occupation'],
        ];
        $heath_certificate['sanitary_inspector_id'] = [
            "id" => $heath_certificate['sanitary_inspector_id'],
            "text" => $si_name,
        ];
        $heath_certificate['city_health_officer_id'] = [
            "id" => $heath_certificate['city_health_officer_id'],
            "text" => $cho_name,
        ];

        return [
            "success" => true,
            "message" => "success",
            "data" => $heath_certificate
        ];
    }

    public function getHealthCertificate($health_certificate_id) {
        $model = new HealthCertificateModel;
        $show_fields = [ 'id', 'health_certificate_signature_id' ];
        $wheres = [[ 'table' => 'health_certificates', 'key' => 'id', 'value' => $health_certificate_id ]];
        $health_certificate = $model->select($show_fields, [],  $wheres);

        return $health_certificate;
    }

    public function update($request) {
        $health_certificate = $this->getHealthCertificate($request->id);
        $health_certificate_signature = new HealthCertificateSignatureModel;
        $health_certificate_signature->update([
            'sanitary_inspector_id' => $request->sanitary_inspector_id,
            'sanitary_inspector_position' => $request->si_position,
            'city_health_officer_id' => $request->city_health_officer_id,
            'city_health_officer_position' => $request->cho_position,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s'),
            'id' => $health_certificate['health_certificate_signature_id']
        ]);

        $heath_certificate = new HealthCertificateModel;
        $heath_certificate_data = Helper::unsets((array) $request, [
            'module', 'action', 'csrf_token', 'sanitary_inspector_id', 'cho_position',
            'city_health_officer_id', 'si_position'
        ]);
        $heath_certificate_data['issued_at'] = date('Y-m-d', strtotime($request->issued_at));
        $heath_certificate_data['updated_by'] = $this->auth->id;
        $heath_certificate_data['updated_at'] = date('Y-m-d H:i:s');
        $heath_certificate->update($heath_certificate_data);

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

    public function remove($request) {
        $heath_certificate = new HealthCertificateModel;
        $data = [
            'id' => $request->id,
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($heath_certificate->remove($data)) {

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

    public function prints($request) {
        $model = new HealthCertificateModel;
        $show_fields = [ 
           'issued_at', 'resident_id', 'age', 'occupation_id', 'place_of_work',
           'gender_id', 'civil_status_id', 'register_no'
        ];
        $show_fields = Helper::appendTable('health_certificates', $show_fields);
        
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';
        $show_fields[] = 'residents.image as r_image';
        $show_fields[] = 'occupations.name as r_occupation';
        $show_fields[] = 'genders.name as r_gender';
        $show_fields[] = 'citizenships.name as r_citizenship';

        $show_fields[] = 'si.suffix as si_suffix';
        $show_fields[] = 'si.first_name as si_first_name';
        $show_fields[] = 'si.middle_name as si_middle_name';
        $show_fields[] = 'si.last_name as si_last_name';
        $show_fields[] = 'health_certificate_signatures.sanitary_inspector_id';
        $show_fields[] = 'health_certificate_signatures.sanitary_inspector_position as si_position';

        $show_fields[] = 'cho.status as cho_status';
        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';
        $show_fields[] = 'health_certificate_signatures.city_health_officer_id';
        $show_fields[] = 'health_certificate_signatures.city_health_officer_position as cho_position';

        $join_tables = [
            [ "LEFT", "residents", "health_certificates.resident_id", "residents.id"],
            [ "LEFT", "occupations", "health_certificates.occupation_id", "occupations.id"],
            [ "LEFT", "genders", "health_certificates.gender_id", "genders.id"],
            [ "LEFT", "citizenships", "residents.citizenship_id", "citizenships.id"],
            [ "LEFT", "health_certificate_signatures", "health_certificates.health_certificate_signature_id", "health_certificate_signatures.id"],
            [ "LEFT", "health_officials as si", "health_certificate_signatures.sanitary_inspector_id", "si.id"],
            [ "LEFT", "health_officials as cho", "health_certificate_signatures.city_health_officer_id", "cho.id"],
        ];
        $wheres = [[ 'table' => 'health_certificates', 'key' => 'id', 'value' => $request->id ]];
        
        $heath_certificate = $model->select($show_fields, $join_tables,  $wheres);
        $resident = $heath_certificate['r_first_name'] . ' '.$heath_certificate['r_middle_name'][0].'. '.$heath_certificate['r_last_name'];

        $si_suffix = in_array($heath_certificate['si_suffix'], ['', null]) ? '' : ', '.$heath_certificate['si_suffix'];
        $si_name = $heath_certificate['si_first_name'] . ' '.$heath_certificate['si_middle_name'][0].'. '.$heath_certificate['si_last_name'].$si_suffix;
        $cho_suffix = in_array($heath_certificate['cho_suffix'], ['', null]) ? '' : ', '.$heath_certificate['cho_suffix'];
        $cho_name = $heath_certificate['cho_first_name'] . ' '.$heath_certificate['cho_middle_name'][0].'. '.$heath_certificate['cho_last_name'].$cho_suffix;

        $data = [
            'register_no' => str_pad($heath_certificate['register_no'], 6, "0", STR_PAD_LEFT),
            'image' => Helper::imageUrl($heath_certificate['r_image']),
            'name' => strtoupper($resident),
            'occupation' => strtoupper($heath_certificate['r_occupation']),
            'age' => $heath_certificate['age'],
            'gender' => strtoupper($heath_certificate['r_gender'][0]),
            'citizenship' => strtoupper($heath_certificate['r_citizenship']),
            'place_of_work' => strtoupper($heath_certificate['place_of_work']),
            'si_name' => strtoupper($si_name),
            'cho_name' => strtoupper($cho_name),
            'si_position' => strtoupper($heath_certificate['si_position']),
            'cho_position' => strtoupper($heath_certificate['cho_position']),
        ];
        return [
            "success" => true,
            "message" => "success",
            "data" => $data
        ];
    }
}
?>