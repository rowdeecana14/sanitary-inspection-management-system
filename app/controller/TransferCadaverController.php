<?php

namespace App\Controller;
use App\Model\PaymentModel;
use App\Model\LogModel;
use App\Model\TransferCadaverModel;
use App\Model\TransferCadaverSignatureModel;
use App\Model\Settings\SignatureModel;
use App\Model\Settings\FeeModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class TransferCadaverController extends BaseController {

    public $fee_id = 5;
    public $signature_id = 6;
    public $module = 25;
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

        $show_fields = Helper::appendTable('transfer_cadavers', $show_fields);
        $show_fields[] = 'transfer_cadavers.id as transfer_cadaver_id';
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';
        $show_fields[] = 'relationships.name as relationship';

        $join_tables = [
            [ "LEFT", "residents", "transfer_cadavers.resident_id", "residents.id"],
            [ "LEFT", "payments", "transfer_cadavers.payment_id", "payments.id"],
            [ "LEFT", "relationships", "transfer_cadavers.relationship_id", "relationships.id"],
        ];

        $model = new TransferCadaverModel;
        $transfer_cadavers = $model->selects($show_fields, $join_tables);
        $result = [];

        foreach($transfer_cadavers as $index => $transfer_cadaver) {
            $resident = $transfer_cadaver['r_first_name'] . ' '.$transfer_cadaver['r_middle_name'][0].'. '.$transfer_cadaver['r_last_name'];
            
            array_push($result, [
                'index' => $index + 1,
                'resident' => $resident,
                'name_of_deceased' => $transfer_cadaver['name_of_deceased'],
                'relationship' => $transfer_cadaver['relationship'],
                'issued_at' => Helper::humanDate('M d, Y', $transfer_cadaver['issued_at']),
                'or_no' => $transfer_cadaver['or_no'],
                'amount' => number_format($transfer_cadaver['amount'], 2) ,
                'paid_at' => Helper::humanDate('M d, Y', $transfer_cadaver['paid_at']),
                'action' => ' 
                    <button type="button" class="btn btn-icon btn-round btn-secondary btn-print"  data-id="'.$transfer_cadaver['transfer_cadaver_id'].'"  data-toggle="tooltip" data-placement="top" title="Print permit">
                        <i class="fas fa-print"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$transfer_cadaver['transfer_cadaver_id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$transfer_cadaver['transfer_cadaver_id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
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

        $transfer_cadaver_signature = new TransferCadaverSignatureModel;
        $transfer_cadaver_signature_id = $transfer_cadaver_signature->lastInsertId([
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

        $transfer_cadaver = new TransferCadaverModel;
        $transfer_cadaver_data = [
            'name_of_deceased' => $request->name_of_deceased,
            'cause_of_death' => $request->cause_of_death,
            'place_of_death' => $request->place_of_death,
            'death_at' => Helper::humanDate('Y-m-d', $request->death_at),
            'issued_at' => Helper::humanDate('Y-m-d', $request->issued_at),
            'relationship_id' => $request->relationship_id,
            'civil_status_id' => $request->civil_status_id,
            'citizenship_id' => $request->citizenship_id,
            'cemetery_id' => $request->cemetery_id,
            'physician_id' => $request->physician_id,
            'transfer_cadaver_signature_id' => $transfer_cadaver_signature_id,
            'resident_id' => $request->resident_id,
            'payment_id' => $payment_id,
            'created_by' => $this->auth->id,
        ];
        $transfer_cadaver_id =  $transfer_cadaver->lastInsertId($transfer_cadaver_data);

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $transfer_cadaver_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success",
            "data" => [
                'id' => $transfer_cadaver_id
            ]
        ];
    }

    public function getTransferCadaverPermit($transfer_cadaver_id) {
        $model = new TransferCadaverModel;
        $show_fields = [ 'id', 'transfer_cadaver_signature_id' ];
        $wheres = [[ 'table' => 'transfer_cadavers', 'key' => 'id', 'value' => $transfer_cadaver_id ]];
        $transfer_cadaver= $model->select($show_fields, [],  $wheres);

        return $transfer_cadaver;
    }

    public function show($request) {
        $model = new TransferCadaverModel;
        $show_fields = [ 
            'resident_id', 'name_of_deceased', 'cause_of_death', 'place_of_death', 'death_at', 'issued_at', 'place_of_death',
            'relationship_id', 'civil_status_id', 'citizenship_id', 'cemetery_id', 'physician_id',
             'payment_id'
        ];

        $show_fields = Helper::appendTable('transfer_cadavers', $show_fields);
        $show_fields[] = 'transfer_cadavers.id as transfer_cadaver_id';
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';

        $show_fields[] = 'physicians.first_name as p_first_name';
        $show_fields[] = 'physicians.middle_name as p_middle_name';
        $show_fields[] = 'physicians.last_name as p_last_name';
        $show_fields[] = 'physicians.suffix as p_suffix';

        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';
        $show_fields[] = 'transfer_cadaver_signatures.city_health_officer_id';
        $show_fields[] = 'transfer_cadaver_signatures.city_health_officer_position as cho_position';

        $show_fields[] = 'relationships.name as relationship';
        $show_fields[] = 'civil_statuses.name as civil_status';
        $show_fields[] = 'citizenships.name as citizenship';
        $show_fields[] = 'cemeteries.name as cemetery';

        $join_tables = [
            [ "LEFT", "residents", "transfer_cadavers.resident_id", "residents.id"],
            [ "LEFT", "payments", "transfer_cadavers.payment_id", "payments.id"],
            [ "LEFT", "health_officials AS physicians", "transfer_cadavers.physician_id", "physicians.id"],
            [ "LEFT", "transfer_cadaver_signatures", "transfer_cadavers.transfer_cadaver_signature_id", "transfer_cadaver_signatures.id"],


            [ "LEFT", "health_officials as cho", "transfer_cadaver_signatures.city_health_officer_id", "cho.id"],
            [ "LEFT", "relationships", "transfer_cadavers.relationship_id", "relationships.id"],
            [ "LEFT", "civil_statuses", "transfer_cadavers.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "citizenships", "transfer_cadavers.citizenship_id", "citizenships.id"],
            [ "LEFT", "cemeteries", "transfer_cadavers.cemetery_id", "cemeteries.id"],
        ];
        $wheres = [[ 'table' => 'transfer_cadavers', 'key' => 'id', 'value' => $request->id ]];
        
        $transfer_cadaver = $model->select($show_fields, $join_tables,  $wheres);
        $transfer_cadaver['issued_at'] =  Helper::humanDate('m/d/Y', $transfer_cadaver['issued_at']);
        $transfer_cadaver['death_at'] =  Helper::humanDate('m/d/Y', $transfer_cadaver['death_at']);
        $transfer_cadaver['amount'] = number_format($transfer_cadaver['amount'], 2);
        $transfer_cadaver['paid_at'] = Helper::humanDate('m/d/Y', $transfer_cadaver['paid_at']);

        $cho_suffix = in_array($transfer_cadaver['cho_suffix'], ['', null]) ? '' : ', '.$transfer_cadaver['cho_suffix'];
        $cho_name = $transfer_cadaver['cho_first_name'] . ' '.$transfer_cadaver['cho_middle_name'][0].'. '.$transfer_cadaver['cho_last_name'].$cho_suffix;

        $physician_suffix = ($transfer_cadaver['p_suffix'] == '' || $transfer_cadaver['p_suffix'] == null) ? '' : ', '.$transfer_cadaver['p_suffix'];
        $resident = $transfer_cadaver['r_first_name'] . ' '.$transfer_cadaver['r_middle_name'][0].' '.$transfer_cadaver['r_last_name'];
        $physician = $transfer_cadaver['p_first_name'] . ' '.$transfer_cadaver['p_middle_name'][0].' '.$transfer_cadaver['p_last_name'].$physician_suffix;;

        $transfer_cadaver['resident_id'] = [
            "id" => $transfer_cadaver['resident_id'],
            "text" => $resident,
        ];
        $transfer_cadaver['physician_id'] = [
            "id" => $transfer_cadaver['physician_id'],
            "text" => $physician,
        ];
        $transfer_cadaver['civil_status_id'] = [
            "id" => $transfer_cadaver['civil_status_id'],
            "text" => $transfer_cadaver['civil_status'],
        ];
        $transfer_cadaver['relationship_id'] = [
            "id" => $transfer_cadaver['relationship_id'],
            "text" => $transfer_cadaver['relationship'],
        ];
        $transfer_cadaver['citizenship_id'] = [
            "id" => $transfer_cadaver['citizenship_id'],
            "text" => $transfer_cadaver['citizenship'],
        ];
        $transfer_cadaver['cemetery_id'] = [
            "id" => $transfer_cadaver['cemetery_id'],
            "text" => $transfer_cadaver['cemetery'],
        ];
        $transfer_cadaver['city_health_officer_id'] = [
            "id" => $transfer_cadaver['city_health_officer_id'],
            "text" => $cho_name,
        ];
        return [
            "success" => true,
            "message" => "success",
            "data" => $transfer_cadaver
        ];
    }

    public function update($request) {

        $transfer_cadaver = $this->getTransferCadaverPermit($request->id);
        $transfer_cadaver_signature = new TransferCadaverSignatureModel;
        $transfer_cadaver_signature->update([
            'city_health_officer_id' => $request->city_health_officer_id,
            'city_health_officer_position' => $request->cho_position,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s'),
            'id' => $transfer_cadaver['transfer_cadaver_signature_id']
        ]);

        $model = new TransferCadaverModel;
        $transfer_cadaver = $model->show(['id' => $request->id]);
        $payment_id = $transfer_cadaver['payment_id'];

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

        $transfer_cadaver = new TransferCadaverModel;
        $transfer_cadaver_data = [
            'id' => $request->id,
            'name_of_deceased' => $request->name_of_deceased,
            'cause_of_death' => $request->cause_of_death,
            'place_of_death' => $request->place_of_death,
            'death_at' => Helper::humanDate('Y-m-d', $request->death_at),
            'issued_at' => Helper::humanDate('Y-m-d', $request->issued_at),
            'relationship_id' => $request->relationship_id,
            'civil_status_id' => $request->civil_status_id,
            'citizenship_id' => $request->citizenship_id,
            'cemetery_id' => $request->cemetery_id,
            'physician_id' => $request->physician_id,
            'resident_id' => $request->resident_id,
            'payment_id' => $payment_id,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if(!$transfer_cadaver->update($transfer_cadaver_data)) {
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
        $transfer_cadaver = new TransferCadaverModel;
        $data = [
            'id' => $request->id,
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($transfer_cadaver->remove($data)) {

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
        $model = new TransferCadaverModel;
        $show_fields = [ 
           'name_of_deceased', 'cause_of_death', 'place_of_death', 'death_at', 'issued_at', 
        ];
        $show_fields = Helper::appendTable('transfer_cadavers', $show_fields);
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';
        $show_fields[] = 'residents.first_name as r_first_name';
        $show_fields[] = 'residents.middle_name as r_middle_name';
        $show_fields[] = 'residents.last_name as r_last_name';
        $show_fields[] = 'civil_statuses.name as civil_status';
        $show_fields[] = 'relationships.name as relationship';
        $show_fields[] = 'citizenships.name as citizenship';
        $show_fields[] = 'cemeteries.name as cemetery';
        $show_fields[] = 'cemeteries.address as cemetery_address';

        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';
        $show_fields[] = 'transfer_cadaver_signatures.city_health_officer_id';
        $show_fields[] = 'transfer_cadaver_signatures.city_health_officer_position as cho_position';

        $show_fields[] = 'physician.suffix as physician_suffix';
        $show_fields[] = 'physician.first_name as physician_first_name';
        $show_fields[] = 'physician.middle_name as physician_middle_name';
        $show_fields[] = 'physician.last_name as physician_last_name';

        $join_tables = [
            [ "LEFT", "residents", "transfer_cadavers.resident_id", "residents.id"],
            [ "LEFT", "civil_statuses", "transfer_cadavers.civil_status_id", "civil_statuses.id"],
            [ "LEFT", "relationships", "transfer_cadavers.relationship_id", "relationships.id"],
            [ "LEFT", "citizenships", "transfer_cadavers.citizenship_id", "citizenships.id"],
            [ "LEFT", "cemeteries", "transfer_cadavers.cemetery_id", "cemeteries.id"],
            [ "LEFT", "payments", "transfer_cadavers.payment_id", "payments.id"],
            [ "LEFT", "transfer_cadaver_signatures", "transfer_cadavers.transfer_cadaver_signature_id", "transfer_cadaver_signatures.id"],
            [ "LEFT", "health_officials as cho", "transfer_cadaver_signatures.city_health_officer_id", "cho.id"],

            [ "LEFT", "health_officials as physician", "transfer_cadavers.physician_id", "physician.id"],

        ];
        $wheres = [[ 'table' => 'transfer_cadavers', 'key' => 'id', 'value' => $request->id ]];
        
        $transfer_cadaver = $model->select($show_fields, $join_tables,  $wheres);
        $resident = $transfer_cadaver['r_first_name'] . ' '.$transfer_cadaver['r_middle_name'][0].'. '.$transfer_cadaver['r_last_name'];

        $cho_suffix = in_array($transfer_cadaver['cho_suffix'], ['', null]) ? '' : ', '.$transfer_cadaver['cho_suffix'];
        $cho_name = $transfer_cadaver['cho_first_name'] . ' '.$transfer_cadaver['cho_middle_name'][0].'. '.$transfer_cadaver['cho_last_name'].$cho_suffix;

        $physician_suffix = in_array($transfer_cadaver['physician_suffix'], ['', null]) ? '' : ', '.$transfer_cadaver['physician_suffix'];
        $physician_name = $transfer_cadaver['physician_first_name'] . ' '.$transfer_cadaver['physician_middle_name'][0].'. '.$transfer_cadaver['physician_last_name'].$physician_suffix;

        $data = [
            'resident' => strtoupper($resident),
            'name_of_deceased' => strtoupper($transfer_cadaver['name_of_deceased']),
            'relationship' => ucwords($transfer_cadaver['relationship']),
            'civil_status' => strtoupper($transfer_cadaver['civil_status']),
            'citizenship' => strtoupper($transfer_cadaver['citizenship']),
            'death_at' =>  Helper::humanDate('F d, Y', $transfer_cadaver['death_at']),
            'place_of_death' => $transfer_cadaver['place_of_death'],
            'cause_of_death' => $transfer_cadaver['cause_of_death'],
            'physician' => strtoupper($physician_name),
            'cho_name' => strtoupper($cho_name),
            'cho_position' => strtoupper($transfer_cadaver['cho_position']),
            'cho_position' => strtoupper($transfer_cadaver['cho_position']),
            'cemetery' =>  ucwords($transfer_cadaver['cemetery']),
            'cemetery_address' =>  ucwords($transfer_cadaver['cemetery_address']),
            'or_no' =>  $transfer_cadaver['or_no'],
            'amount' =>  $transfer_cadaver['amount'],
            'paid_at' =>  Helper::humanDate('m/d/Y', $transfer_cadaver['paid_at']),
        ];
        
        return [
            "success" => true,
            "message" => "success",
            "data" => $data
        ];
    }
}
?>