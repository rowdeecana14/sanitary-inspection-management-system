<?php

namespace App\Controller;
use App\Model\PaymentModel;
use App\Model\ResidentModel;
use App\Model\LogModel;
use App\Model\MedicalCertificateSignatureModel;
use App\Model\MedicalCertificateModel;
use App\Model\Settings\SignatureModel;
use App\Model\Settings\FeeModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class MedicalCerticateController extends BaseController {

    public $signature_id = 4;
    public $fee_id = 3;
    public $module = 23;
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
            'fit_for', 'blood_pressure', 'issued_at', 'resident_id', 'payment_id', 
        ];

        $show_fields = Helper::appendTable('medical_certificates', $show_fields);
        $show_fields[] = 'medical_certificates.id as medical_certificate_id';
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';

        $join_tables = [
            [ "LEFT", "residents", "medical_certificates.resident_id", "residents.id"],
            [ "LEFT", "payments", "medical_certificates.payment_id", "payments.id"],
        ];

        $model = new MedicalCertificateModel;
        $medical_certificates = $model->selects($show_fields, $join_tables);
        $result = [];

        foreach($medical_certificates as $index => $medical_certificate) {
            $resident = $medical_certificate['r_first_name'] . ' '.$medical_certificate['r_middle_name'][0].' '.$medical_certificate['r_last_name'];
            
            array_push($result, [
                'index' => $index + 1,
                'resident' => $resident,
                'fit_for' => $medical_certificate['fit_for'],
                'issued_at' => Helper::humanDate('M d, Y', $medical_certificate['issued_at']),
                'or_no' => $medical_certificate['or_no'],
                'amount' => number_format($medical_certificate['amount'], 2) ,
                'paid_at' => Helper::humanDate('M d, Y', $medical_certificate['paid_at']),
                'action' => ' 
                    <button type="button" class="btn btn-icon btn-round btn-secondary btn-print"  data-id="'.$medical_certificate['medical_certificate_id'].'"  data-toggle="tooltip" data-placement="top" title="Print permit">
                        <i class="fas fa-print"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$medical_certificate['medical_certificate_id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$medical_certificate['medical_certificate_id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
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
            'baranggay_id', 'purok_id',
        ];

        $show_fields = Helper::appendTable('residents', $show_fields);
        $show_fields[] = 'residents.id as resident_id';
        $show_fields[] = 'civil_statuses.name as civil_status';
        $show_fields[] = 'genders.name as gender';
        $show_fields[] = 'baranggays.name as baranggay';
        $show_fields[] = 'puroks.name as purok';

        $join_tables = [
            [ "LEFT", "civil_statuses", "residents.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "genders", "residents.gender_id", "genders.id"],
            [ "LEFT", "baranggays", "residents.baranggay_id", "baranggays.id"],
            [ "LEFT", "puroks", "residents.purok_id", "puroks.id"],
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
            ]
        ];

        return [
            "success" => true,
            "message" => "success",
            "data" => $data
        ];
    }

    public function select2($request) {
        // $model = new MedicalCertificateModel;
        // $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        // $fields = ['id', 'name as text'];
        // $medical_certificate = $model->search($fields, [], $data);

        // return [
        //     "success" => true,
        //     "message" => "success",
        //     "data" => $medical_certificate
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

        $wheres = [[ 'table' => 'signatures', 'key' => 'id', 'value' => $this->signature_id ]];
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

    public function getFees() {
        $model = new FeeModel;
        $show_fields = [ 'amount' ];
        $show_fields = Helper::appendTable('fees', $show_fields);
        $wheres = [[ 'table' => 'fees', 'key' => 'id', 'value' => $this->fee_id ]];

        return  $model->select($show_fields, [],  $wheres);
    }

    public function create() {
        return [
            "success" => true,
            "message" => "success",
            "data" => [
                'signatures' => $this->getSignatures(),
                "fees" => $this->getFees()
            ]
        ];
    }
    
    public function store($request) {
        $signatures = $this->getSignatures();

        $medical_certificate_signature = new MedicalCertificateSignatureModel;
        $medical_certificate_signature_id = $medical_certificate_signature->lastInsertId([
            'city_health_officer_id' => $signatures['city_health_officer_id']['id'],
            'city_health_officer_position' => $signatures['cho_position'],
            'created_by' => $this->auth->id
        ]);

        $payment = new PaymentModel;
        $payment_id = $payment->lastInsertId([
            'or_no' => $request->or_no,
            'amount' => $request->amount,
            'paid_at' =>Helper::humanDate('Y-m-d', $request->paid_at)
        ]);

        $medical_certificate = new MedicalCertificateModel;
        $medical_certificate_data = [
            'issued_at' => Helper::humanDate('Y-m-d', $request->issued_at),
            'fit_for' => $request->fit_for,
            'age' => $request->age,
            'blood_pressure' => $request->blood_pressure,
            'weight' => $request->weight,
            'height' => $request->height,
            'street_building_house' => $request->street_building_house,
            'purok_id' => $request->purok_id,
            'baranggay_id' => $request->baranggay_id,
            'civil_status_id' => $request->civil_status_id,
            'gender_id' => $request->gender_id,
            'resident_id' => $request->resident_id,
            'payment_id' => $payment_id,
            'created_by' => $this->auth->id,
            'medical_certificate_signature_id' => $medical_certificate_signature_id
        ];
        $medical_certificate_id =  $medical_certificate->lastInsertId($medical_certificate_data);

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $medical_certificate_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success",
            "data" => [
                'id' => $medical_certificate_id
            ]
        ];
    }

    public function show($request) {
        $model = new MedicalCertificateModel;
        $show_fields = [ 
            'fit_for', 'blood_pressure', 'issued_at', 'resident_id', 'medical_officer_id', 'payment_id', 
            'height', 'weight', 'age', 'street_building_house', 'purok_id', 'baranggay_id', 'gender_id', 'civil_status_id'
        ];
        $show_fields = Helper::appendTable('medical_certificates', $show_fields);
        $show_fields[] = 'medical_certificates.id as medical_certificate_id';
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';
        $show_fields[] = 'civil_statuses.name as civil_status';
        $show_fields[] = 'genders.name as gender';
        $show_fields[] = 'baranggays.name as baranggay';
        $show_fields[] = 'puroks.name as purok';

        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';

        $show_fields[] = 'cho.status as cho_status';
        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';
        $show_fields[] = 'medical_certificate_signatures.city_health_officer_id';
        $show_fields[] = 'medical_certificate_signatures.city_health_officer_position as cho_position';

        $join_tables = [
            [ "LEFT", "residents", "medical_certificates.resident_id", "residents.id"],
            [ "LEFT", "civil_statuses", "residents.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "genders", "residents.gender_id", "genders.id"],
            [ "LEFT", "baranggays", "residents.baranggay_id", "baranggays.id"],
            [ "LEFT", "puroks", "residents.purok_id", "puroks.id"],
            [ "LEFT", "payments", "medical_certificates.payment_id", "payments.id"],
            [ "LEFT", "medical_certificate_signatures", "medical_certificates.medical_certificate_signature_id", "medical_certificate_signatures.id"],
            [ "LEFT", "health_officials as cho", "medical_certificate_signatures.city_health_officer_id", "cho.id"],
        ];
        $wheres = [[ 'table' => 'medical_certificates', 'key' => 'id', 'value' => $request->id ]];
        

        $medical_certificate = $model->select($show_fields, $join_tables,  $wheres);
        $medical_certificate['issued_at'] =  Helper::humanDate('m/d/Y', $medical_certificate['issued_at']);
        $medical_certificate['amount'] = number_format($medical_certificate['amount'], 2);
        $medical_certificate['paid_at'] = Helper::humanDate('m/d/Y', $medical_certificate['paid_at']);
        $resident = $medical_certificate['r_first_name'] . ' '.$medical_certificate['r_middle_name'][0].' '.$medical_certificate['r_last_name'];

        $cho_suffix = in_array($medical_certificate['cho_suffix'], ['', null]) ? '' : ', '.$medical_certificate['cho_suffix'];
        $cho_name = $medical_certificate['cho_first_name'] . ' '.$medical_certificate['cho_middle_name'][0].'. '.$medical_certificate['cho_last_name'].$cho_suffix;

        $medical_certificate['resident_id'] = [
            "id" => $medical_certificate['resident_id'],
            "text" => $resident,
        ];
        $medical_certificate['purok_id'] = [
            "id" => $medical_certificate['purok_id'],
            "text" => $medical_certificate['purok'],
        ];
        $medical_certificate['baranggay_id'] = [
            "id" => $medical_certificate['baranggay_id'],
            "text" => $medical_certificate['baranggay'],
        ];
        $medical_certificate['gender_id'] = [
            "id" => $medical_certificate['gender_id'],
            "text" => $medical_certificate['gender'],
        ];
        $medical_certificate['civil_status_id'] = [
            "id" => $medical_certificate['civil_status_id'],
            "text" => $medical_certificate['civil_status'],
        ];
        $medical_certificate['city_health_officer_id'] = [
            "id" => $medical_certificate['city_health_officer_id'],
            "text" => $cho_name,
        ];

        return [
            "success" => true,
            "message" => "success",
            "data" => $medical_certificate
        ];
    }

    public function geMedicalCertificate($medical_certificate_id) {
        $model = new MedicalCertificateModel;
        $show_fields = [ 'id', 'medical_certificate_signature_id' ];
        $wheres = [[ 'table' => 'medical_certificates', 'key' => 'id', 'value' => $medical_certificate_id ]];
        $health_certificate = $model->select($show_fields, [],  $wheres);

        return $health_certificate;
    }

    public function update($request) {

        $medical_certificate = $this->geMedicalCertificate($request->id);
        $medical_certificate_signature = new MedicalCertificateSignatureModel;
        $medical_certificate_signature->update([
            'city_health_officer_id' => $request->city_health_officer_id,
            'city_health_officer_position' => $request->cho_position,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s'),
            'id' => $medical_certificate['medical_certificate_signature_id']
        ]);

        $model = new MedicalCertificateModel;
        $medical_certificate = $model->show(['id' => $request->id]);
        $payment_id = $medical_certificate['payment_id'];

        $payment = new PaymentModel;
        $payment_data = [
            'id' => $payment_id,
            'or_no' => $request->or_no,
            'amount' => $request->amount,
            'paid_at' => Helper::humanDate('Y-m-d', $request->paid_at)
        ];
       $payment->update($payment_data);

        $medical_certificate = new MedicalCertificateModel;
        $medical_certificate_data = [
            'id' => $request->id,
            'fit_for' => $request->fit_for,
            'blood_pressure' => $request->blood_pressure,
            'age' => $request->age,
            'blood_pressure' => $request->blood_pressure,
            'weight' => $request->weight,
            'height' => $request->height,
            'street_building_house' => $request->street_building_house,
            'purok_id' => $request->purok_id,
            'baranggay_id' => $request->baranggay_id,
            'civil_status_id' => $request->civil_status_id,
            'gender_id' => $request->gender_id,
            'resident_id' => $request->resident_id,
            'issued_at' => Helper::humanDate('Y-m-d', $request->issued_at),
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if(!$medical_certificate->update($medical_certificate_data)) {
            return [
                "success" => false,
                "message" => "error"
            ];
        }

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
        $medical_certificate = new MedicalCertificateModel;
        $data = [
            'id' => $request->id,
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($medical_certificate->remove($data)) {
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
        $model = new MedicalCertificateModel;
        $show_fields = [ 
           'issued_at', 'resident_id', 'age', 'street_building_house', 'baranggay_id', 'purok_id', 'fit_for', 'weight',
           'blood_pressure', 'height'
        ];
        $show_fields = Helper::appendTable('medical_certificates', $show_fields);
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';
        $show_fields[] = 'baranggays.name as baranggay';
        $show_fields[] = 'puroks.name as purok';
        $show_fields[] = 'civil_statuses.name as civil_status';

        $show_fields[] = 'cho.status as cho_status';
        $show_fields[] = 'cho.status as cho_license_no';
        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';
        $show_fields[] = 'medical_certificate_signatures.city_health_officer_id';
        $show_fields[] = 'medical_certificate_signatures.city_health_officer_position as cho_position';

        $join_tables = [
            [ "LEFT", "residents", "medical_certificates.resident_id", "residents.id"],
            [ "LEFT", "civil_statuses", "residents.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "baranggays", "residents.baranggay_id", "baranggays.id"],
            [ "LEFT", "puroks", "residents.purok_id", "puroks.id"],
            [ "LEFT", "payments", "medical_certificates.payment_id", "payments.id"],
            [ "LEFT", "medical_certificate_signatures", "medical_certificates.medical_certificate_signature_id", "medical_certificate_signatures.id"],
            [ "LEFT", "health_officials as cho", "medical_certificate_signatures.city_health_officer_id", "cho.id"],
        ];
        $wheres = [[ 'table' => 'medical_certificates', 'key' => 'id', 'value' => $request->id ]];
        
        $heath_certificate = $model->select($show_fields, $join_tables,  $wheres);
        $resident = $heath_certificate['r_first_name'] . ' '.$heath_certificate['r_middle_name'][0].'. '.$heath_certificate['r_last_name'];
        $address  = $heath_certificate['street_building_house'].', '.$heath_certificate['purok']. ', '.$heath_certificate['baranggay'];

        $cho_suffix = in_array($heath_certificate['cho_suffix'], ['', null]) ? '' : ', '.$heath_certificate['cho_suffix'];
        $cho_name = $heath_certificate['cho_first_name'] . ' '.$heath_certificate['cho_middle_name'][0].'. '.$heath_certificate['cho_last_name'].$cho_suffix;

        $data = [
            'name' => strtoupper($resident),
            'age' => $heath_certificate['age'],
            'civil_status' => strtolower($heath_certificate['civil_status']),
            'address' => $address,
            'blood_pressure' =>  $heath_certificate['blood_pressure'],
            'height' =>  $heath_certificate['height'],
            'weight' =>  $heath_certificate['weight'],
            'fit_for' =>  $heath_certificate['fit_for'],
            'or_no' =>  $heath_certificate['or_no'],
            'amount' =>  $heath_certificate['amount'],
            'paid_at' =>  Helper::humanDate('m/d/Y', $heath_certificate['paid_at']),
            'cho_name' => strtoupper($cho_name),
            'cho_position' => strtoupper($heath_certificate['cho_position']),
            'cho_license_no' => $heath_certificate['cho_license_no'],
            'month_and_year' =>  Helper::humanDate('F, Y', $heath_certificate['issued_at']),
            'day' =>  Helper::humanDate('d', $heath_certificate['issued_at']),
        ];
        
        return [
            "success" => true,
            "message" => "success",
            "data" => $data
        ];
    }
}
?>