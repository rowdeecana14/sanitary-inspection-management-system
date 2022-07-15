<?php

namespace App\Controller;
use App\Model\PaymentModel;
use App\Model\ResidentModel;
use App\Model\LogModel;
use App\Model\ExhumationCertificateModel;
use App\Model\ExhumationCerticateSignatureModel;
use App\Model\Settings\SignatureModel;
use App\Model\Settings\FeeModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class ExhumationCertificateController extends BaseController {

    public $fee_id = 4;
    public $signature_id = 5;
    public $module = 24;
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
            'resident_id', 'name_of_deceased', 'relationship_id',  'payment_id', 'issued_at'
        ];

        $show_fields = Helper::appendTable('exhumation_certificates', $show_fields);
        $show_fields[] = 'exhumation_certificates.id as exhumation_certificate_id';
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';
        $show_fields[] = 'relationships.name as relationship';

        $join_tables = [
            [ "LEFT", "residents", "exhumation_certificates.resident_id", "residents.id"],
            [ "LEFT", "payments", "exhumation_certificates.payment_id", "payments.id"],
            [ "LEFT", "relationships", "exhumation_certificates.relationship_id", "relationships.id"],
        ];

        $model = new ExhumationCertificateModel;
        $exhumation_certificates = $model->selects($show_fields, $join_tables);
        $result = [];

        foreach($exhumation_certificates as $index => $exhumation_certificate) {
            $resident = $exhumation_certificate['r_first_name'] . ' '.$exhumation_certificate['r_middle_name'][0].' '.$exhumation_certificate['r_last_name'];
            
            array_push($result, [
                'index' => $index + 1,
                'resident' => $resident,
                'name_of_deceased' => $exhumation_certificate['name_of_deceased'],
                'relationship' => $exhumation_certificate['relationship'],
                'issued_at' => Helper::humanDate('M d, Y', $exhumation_certificate['issued_at']),
                'or_no' => $exhumation_certificate['or_no'],
                'amount' => number_format($exhumation_certificate['amount'], 2) ,
                'paid_at' => Helper::humanDate('M d, Y', $exhumation_certificate['paid_at']),
                'action' => ' 
                    <button type="button" class="btn btn-icon btn-round btn-secondary btn-print"  data-id="'.$exhumation_certificate['exhumation_certificate_id'].'"  data-toggle="tooltip" data-placement="top" title="Print permit">
                        <i class="fas fa-print"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$exhumation_certificate['exhumation_certificate_id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$exhumation_certificate['exhumation_certificate_id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
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
        // $model = new ExhumationCertificateModel;
        // $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        // $fields = ['id', 'name as text'];
        // $exhumation_certificate = $model->search($fields, [], $data);

        // return [
        //     "success" => true,
        //     "message" => "success",
        //     "data" => $exhumation_certificate
        // ];
    }
    
    public function store($request) {
        $signatures = $this->getSignatures();

        $exhumation_certificate_signature = new ExhumationCerticateSignatureModel;
        $exhumation_certificate_signature_id = $exhumation_certificate_signature->lastInsertId([
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

        $exhumation_certificate = new ExhumationCertificateModel;
        $exhumation_certificate_data = [
            'resident_id' => $request->resident_id,
            'issued_at' => Helper::humanDate('Y-m-d', $request->issued_at),
            'name_of_deceased' => $request->name_of_deceased,
            'relationship_id' => $request->relationship_id,
            'civil_status_id' => $request->civil_status_id,
            'citizenship_id' => $request->citizenship_id,
            'cause_of_death' => $request->cause_of_death,
            'death_at' => Helper::humanDate('Y-m-d', $request->death_at),
            'exhumation_certificate_signature_id' => $exhumation_certificate_signature_id,
            'payment_id' => $payment_id,
            'created_by' => $this->auth->id
        ];
        $exhumation_certificate_id =  $exhumation_certificate->lastInsertId($exhumation_certificate_data);

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $exhumation_certificate_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success",
            "data" => [
                'id' => $exhumation_certificate_id
            ]
        ];
    }

    public function show($request) {
        $model = new ExhumationCertificateModel;
        $show_fields = [ 
            'resident_id', 'name_of_deceased', 'relationship_id',  'payment_id', 'issued_at', 'exhumation_certificate_signature_id', 'civil_status_id',
            'citizenship_id', 'cause_of_death', 'death_at',
        ];

        $show_fields = Helper::appendTable('exhumation_certificates', $show_fields);
        $show_fields[] = 'exhumation_certificates.id as exhumation_certificate_id';
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';
        $show_fields[] = 'relationships.name as relationship';
        $show_fields[] = 'civil_statuses.name as civil_status';
        $show_fields[] = 'citizenships.name as citizenship';

        $show_fields[] = 'cho.status as cho_status';
        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';
        $show_fields[] = 'exhumation_certificate_signatures.city_health_officer_id';
        $show_fields[] = 'exhumation_certificate_signatures.city_health_officer_position as cho_position';

        $join_tables = [
            [ "LEFT", "residents", "exhumation_certificates.resident_id", "residents.id"],
            [ "LEFT", "payments", "exhumation_certificates.payment_id", "payments.id"],
            [ "LEFT", "relationships", "exhumation_certificates.relationship_id", "relationships.id"],
            [ "LEFT", "civil_statuses", "exhumation_certificates.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "citizenships", "exhumation_certificates.citizenship_id", "citizenships.id"],

            [ "LEFT", "exhumation_certificate_signatures", "exhumation_certificates.exhumation_certificate_signature_id", "exhumation_certificate_signatures.id"],
            [ "LEFT", "health_officials as cho", "exhumation_certificate_signatures.city_health_officer_id", "cho.id"],
        ];
        $wheres = [[ 'table' => 'exhumation_certificates', 'key' => 'id', 'value' => $request->id ]];
        
        $exhumation_certificate = $model->select($show_fields, $join_tables,  $wheres);
        $exhumation_certificate['issued_at'] =  Helper::humanDate('m/d/Y', $exhumation_certificate['issued_at']);
        $exhumation_certificate['death_at'] =  Helper::humanDate('m/d/Y', $exhumation_certificate['death_at']);
        $exhumation_certificate['amount'] = number_format($exhumation_certificate['amount'], 2);
        $exhumation_certificate['paid_at'] = Helper::humanDate('m/d/Y', $exhumation_certificate['paid_at']);
        $resident = $exhumation_certificate['r_first_name'] . ' '.$exhumation_certificate['r_middle_name'][0].' '.$exhumation_certificate['r_last_name'];
        $cho_suffix = in_array($exhumation_certificate['cho_suffix'], ['', null]) ? '' : ', '.$exhumation_certificate['cho_suffix'];
        $cho_name = $exhumation_certificate['cho_first_name'] . ' '.$exhumation_certificate['cho_middle_name'][0].'. '.$exhumation_certificate['cho_last_name'].$cho_suffix;

        $exhumation_certificate['resident_id'] = [
            "id" => $exhumation_certificate['resident_id'],
            "text" => $resident,
        ];
        $exhumation_certificate['civil_status_id'] = [
            "id" => $exhumation_certificate['civil_status_id'],
            "text" => $exhumation_certificate['civil_status'],
        ];
        $exhumation_certificate['relationship_id'] = [
            "id" => $exhumation_certificate['relationship_id'],
            "text" => $exhumation_certificate['relationship'],
        ];
        $exhumation_certificate['citizenship_id'] = [
            "id" => $exhumation_certificate['citizenship_id'],
            "text" => $exhumation_certificate['citizenship'],
        ];
        $exhumation_certificate['city_health_officer_id'] = [
            "id" => $exhumation_certificate['city_health_officer_id'],
            "text" => $cho_name,
        ];

        return [
            "success" => true,
            "message" => "success",
            "data" => $exhumation_certificate
        ];
    }

    public function update($request) {
        $exhumation_certificate = $this->getExhumationCertificate($request->id);
        $exhumation_certificate_signature = new ExhumationCerticateSignatureModel;
        $exhumation_certificate_signature->update([
            'city_health_officer_id' => $request->city_health_officer_id,
            'city_health_officer_position' => $request->cho_position,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s'),
            'id' => $exhumation_certificate['exhumation_certificate_signature_id']
        ]);

        $model = new ExhumationCertificateModel;
        $exhumation_certificate = $model->show(['id' => $request->id]);
        $payment_id = $exhumation_certificate['payment_id'];

        $payment = new PaymentModel;
        $payment_data = [
            'id' => $payment_id,
            'or_no' => $request->or_no,
            'amount' => $request->amount,
            'paid_at' => Helper::humanDate('Y-m-d', $request->paid_at)
        ];

        if(!$payment->update($payment_data)) {
            return [
                "success" => false,
                "message" => "error"
            ];
        }

        $exhumation_certificate = new ExhumationCertificateModel;
        $exhumation_certificate_data = [
            'id' => $request->id,
            'resident_id' => $request->resident_id,
            'issued_at' => Helper::humanDate('Y-m-d', $request->issued_at),
            'death_at' => Helper::humanDate('Y-m-d', $request->death_at),
            'name_of_deceased' => $request->name_of_deceased,
            'relationship_id' => $request->relationship_id,
            'civil_status_id' => $request->civil_status_id,
            'citizenship_id' => $request->citizenship_id,
            'cause_of_death' => $request->cause_of_death,
            'payment_id' => $payment_id,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if(!$exhumation_certificate->update($exhumation_certificate_data)) {
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
        $exhumation_certificate = new ExhumationCertificateModel;
        $data = [
            'id' => $request->id,
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($exhumation_certificate->remove($data)) {

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
        $model = new ExhumationCertificateModel;
        $show_fields = [ 
            'resident_id', 'name_of_deceased', 'relationship_id',  'payment_id', 'issued_at', 'exhumation_certificate_signature_id', 'civil_status_id',
            'citizenship_id', 'cause_of_death', 'death_at',
        ];

        $show_fields = Helper::appendTable('exhumation_certificates', $show_fields);
        $show_fields[] = 'exhumation_certificates.id as exhumation_certificate_id';
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';
        $show_fields[] = 'relationships.name as relationship';
        $show_fields[] = 'civil_statuses.name as civil_status';
        $show_fields[] = 'citizenships.name as citizenship';
        $show_fields[] = 'baranggays.name as baranggay';
        $show_fields[] = 'puroks.name as purok';
        $show_fields[] = 'residents.street_building_house';

        $show_fields[] = 'cho.status as cho_status';
        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';
        $show_fields[] = 'cho.license_no as cho_license_no';
        $show_fields[] = 'exhumation_certificate_signatures.city_health_officer_id';
        $show_fields[] = 'exhumation_certificate_signatures.city_health_officer_position as cho_position';

        $join_tables = [
            [ "LEFT", "residents", "exhumation_certificates.resident_id", "residents.id"],
            [ "LEFT", "baranggays", "residents.baranggay_id", "baranggays.id"],
            [ "LEFT", "puroks", "residents.purok_id", "puroks.id"],
            [ "LEFT", "payments", "exhumation_certificates.payment_id", "payments.id"],
            [ "LEFT", "relationships", "exhumation_certificates.relationship_id", "relationships.id"],
            [ "LEFT", "civil_statuses", "exhumation_certificates.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "citizenships", "exhumation_certificates.citizenship_id", "citizenships.id"],
            [ "LEFT", "exhumation_certificate_signatures", "exhumation_certificates.exhumation_certificate_signature_id", "exhumation_certificate_signatures.id"],
            [ "LEFT", "health_officials as cho", "exhumation_certificate_signatures.city_health_officer_id", "cho.id"],
        ];
        $wheres = [[ 'table' => 'exhumation_certificates', 'key' => 'id', 'value' => $request->id ]];

        $exhumation_certificate = $model->select($show_fields, $join_tables,  $wheres);
        $exhumation_certificate['issued_at'] =  Helper::humanDate('m/d/Y', $exhumation_certificate['issued_at']);
        $exhumation_certificate['death_at'] =  Helper::humanDate('m/d/Y', $exhumation_certificate['death_at']);
        $exhumation_certificate['amount'] = number_format($exhumation_certificate['amount'], 2);
        $exhumation_certificate['paid_at'] = Helper::humanDate('m/d/Y', $exhumation_certificate['paid_at']);
        $resident = $exhumation_certificate['r_first_name'] . ' '.$exhumation_certificate['r_middle_name'][0].'. '.$exhumation_certificate['r_last_name'];
        $address =  $exhumation_certificate['street_building_house'].', '.$exhumation_certificate['purok']. ', '.$exhumation_certificate['baranggay'];
        $cho_suffix = in_array($exhumation_certificate['cho_suffix'], ['', null]) ? '' : ', '.$exhumation_certificate['cho_suffix'];
        $cho_name = $exhumation_certificate['cho_first_name'] . ' '.$exhumation_certificate['cho_middle_name'][0].'. '.$exhumation_certificate['cho_last_name'].$cho_suffix;

        $day =  Helper::humanDate('jS', $exhumation_certificate['issued_at']);
        $month =  Helper::humanDate('F', $exhumation_certificate['issued_at']);
        $year =  Helper::humanDate('Y', $exhumation_certificate['issued_at']);
        $issued_at = $day.' day of '.strtoupper($month).' '.$year;
        $month_day =  $day.' day of '.strtoupper($month);

        $data = [
            'resident' => strtoupper($resident),
            'name_of_deceased' => strtoupper($exhumation_certificate['name_of_deceased']),
            'relationship' => ucwords($exhumation_certificate['relationship']),
            'civil_status' => strtolower($exhumation_certificate['civil_status']),
            'citizenship' => ucwords($exhumation_certificate['citizenship']),
            'death_at' =>  strtoupper(Helper::humanDate('d F Y', $exhumation_certificate['death_at'])),
            'cause_of_death' => $exhumation_certificate['cause_of_death'],
            'address' => strtoupper($address),
            'cho_name' => strtoupper($cho_name),
            'cho_license_no' => $exhumation_certificate['cho_license_no'],
            'cho_position' => strtoupper($exhumation_certificate['cho_position']),
            'or_no' =>  $exhumation_certificate['or_no'],
            'amount' =>  $exhumation_certificate['amount'],
            'paid_at' =>  Helper::humanDate('m/d/Y', $exhumation_certificate['paid_at']),
            'issued_at' => $issued_at,
            'month_day' => $month_day,
        ];
        
        return [
            "success" => true,
            "message" => "success",
            "data" => $data
        ];
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

    public function getExhumationCertificate($exhumation_id) {
        $model = new ExhumationCertificateModel;
        $show_fields = [ 'id', 'exhumation_certificate_signature_id' ];
        $wheres = [[ 'table' => 'exhumation_certificates', 'key' => 'id', 'value' => $exhumation_id ]];
        $exhumation_certificate = $model->select($show_fields, [],  $wheres);

        return $exhumation_certificate;
    }
}
?>