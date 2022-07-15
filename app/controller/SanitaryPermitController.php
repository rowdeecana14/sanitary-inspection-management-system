<?php

namespace App\Controller;
use App\Model\PaymentModel;
use App\Model\SanitaryPermitModel;
use App\Model\SanitaryPermitSignatureModel;
use App\Model\SanitaryPermitInspectionModel;
use App\Model\SanitaryPermitInspectionChecklistModel;
use App\Model\LogModel;
use App\Model\Settings\FeeModel;
use App\Model\Settings\SanitaryChecklistAssignModel;
use App\Model\Settings\SanitaryChecklistModel;
use App\Model\Settings\SignatureModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class SanitaryPermitController extends BaseController {
    
    public $fee_id = 1;
    public $signature_id = 1;
    public $sanitary_checklist_id = 1;
    public $module = 20;
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
            'permit_no', 'issued_at', 'expired_at', 'company_id', 'payment_id', 
        ];
        $show_fields = Helper::appendTable('sanitary_permits', $show_fields);
        $show_fields[] = 'sanitary_permits.id as sanitary_permit_id';
        $show_fields[] = 'companies.name as company';
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';
        $show_fields[] = 'sanitary_permit_inspections.is_passed';

        $join_tables = [
            [ "LEFT", "companies", "sanitary_permits.company_id", "companies.id"],
            [ "LEFT", "payments", "sanitary_permits.payment_id", "payments.id"],
            [ "LEFT", "sanitary_permit_inspections", "sanitary_permits.id", "sanitary_permit_inspections.sanitary_permit_id"],
        ];

        $model = new SanitaryPermitModel;
        $sanitary_permits = $model->selects($show_fields, $join_tables);
        $result = [];

        foreach($sanitary_permits as $index => $sanitary_permit) {
            $actions = '
                    <button type="button" class="btn btn-icon btn-round btn-secondary" disabled>
                        <i class="fas fa-print"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$sanitary_permit['sanitary_permit_id'].'" data-toggle="tooltip" data-placement="top" title="Re-inspect" >
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$sanitary_permit['sanitary_permit_id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
                        <i class="fas fa-trash-alt"></i>
                    </button>';

            if($sanitary_permit['is_passed'] == 1) {
                $actions = '
                    <button type="button" class="btn btn-icon btn-round btn-secondary btn-print"  data-id="'.$sanitary_permit['sanitary_permit_id'].'"  data-toggle="tooltip" data-placement="top" title="Print permit">
                        <i class="fas fa-print"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$sanitary_permit['sanitary_permit_id'].'" data-toggle="tooltip" data-placement="top" title="Re-inspect">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$sanitary_permit['sanitary_permit_id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
                        <i class="fas fa-trash-alt"></i>
                    </button>';
            }
           
            array_push($result, [
                'index' => $index + 1,
                'permit_no' => str_pad($sanitary_permit['permit_no'], 6, "0", STR_PAD_LEFT),
                'company' => $sanitary_permit['company'],
                'issued_at' => Helper::humanDate('M d, Y', $sanitary_permit['issued_at']),
                'expired_at' => Helper::humanDate('M d, Y', $sanitary_permit['expired_at']),
                'or_no' => $sanitary_permit['or_no'],
                'amount' => number_format($sanitary_permit['amount'], 2) ,
                'paid_at' => Helper::humanDate('M d, Y', $sanitary_permit['paid_at']),
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
        // $model = new SanitaryPermitModel;
        // $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        // $fields = ['id', 'name as text'];
        // $sanitary_permit = $model->search($fields, [], $data);

        // return [
        //     "success" => true,
        //     "message" => "success",
        //     "data" => $sanitary_permit
        // ];
    }
    
    public function store($request) {
        $signatures = $this->getSignatures();

        $sanitary_permit = new SanitaryPermitModel;
        $last_row = $sanitary_permit->getLastRow();
        $permit_no = isset($last_row['permit_no']) ? (int) $last_row['permit_no'] + 1  : 1;

        $sanitary_permit_signature = new SanitaryPermitSignatureModel;
        $sanitary_permit_signature_id = $sanitary_permit_signature->lastInsertId([
            'sanitary_inspector_id' => $signatures['sanitary_inspector_id']['id'],
            'sanitary_inspector_position' => $signatures['si_position'],
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

        $sanitary_permit = new SanitaryPermitModel;
        $sanitary_permit_data = [
            'permit_no' => $permit_no,
            'issued_at' => Helper::humanDate('Y-m-d', $request->issued_at),
            'expired_at' => Helper::humanDate('Y-m-d', $request->expired_at),
            'company_id' => $request->company_id,
            'payment_id' => $payment_id,
            'sanitary_permit_signature_id' => $sanitary_permit_signature_id,
            'created_by' => $this->auth->id
        ];
        $sanitary_permit_id =  $sanitary_permit->lastInsertId($sanitary_permit_data);

        $evaluation = $this->evaluateInspection($request->checklists);
        $sp_inspection_data = [
            'sanitary_permit_id' => $sanitary_permit_id,
            'rate' => $evaluation['rate'],
            'is_passed' => $evaluation['is_passed'],
            'created_by' => $this->auth->id
        ];
        $sp_inspection = new SanitaryPermitInspectionModel;
        $sp_inspection->lastInsertId($sp_inspection_data);

        $sp_inspection_checklist = new SanitaryPermitInspectionChecklistModel;

        if(is_array($request->checklists)) {
            foreach($request->checklists as $checklist) {
                $sp_inspection_checklist_data = [
                    'sanitary_permit_id' => $sanitary_permit_id,
                    'checklist_id' => $checklist,
                    'created_by' => $this->auth->id
                ];
                $sp_inspection_checklist->lastInsertId($sp_inspection_checklist_data);
            }
        }
        else {
            $sp_inspection_checklist_data = [
                'sanitary_permit_id' => $sanitary_permit_id,
                'checklist_id' => $request->checklists,
                'created_by' => $this->auth->id
            ];
            $sp_inspection_checklist->lastInsertId($sp_inspection_checklist_data);
        }

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $sanitary_permit_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success"
        ];
    }

    public function show($request) {
        $model = new SanitaryPermitModel;
        $show_fields = [ 
            'issued_at', 'expired_at', 'company_id', 'payment_id', 'sanitary_permit_signature_id'
        ];
        $show_fields = Helper::appendTable('sanitary_permits', $show_fields);
        $show_fields[] = 'sanitary_permits.id as sanitary_permit_id';
        $show_fields[] = 'companies.name as company';
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';

        $show_fields[] = 'si.suffix as si_suffix';
        $show_fields[] = 'si.first_name as si_first_name';
        $show_fields[] = 'si.middle_name as si_middle_name';
        $show_fields[] = 'si.last_name as si_last_name';
        $show_fields[] = 'sanitary_permit_signatures.sanitary_inspector_id';
        $show_fields[] = 'sanitary_permit_signatures.sanitary_inspector_position as si_position';

        $show_fields[] = 'cho.status as cho_status';
        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';
        $show_fields[] = 'sanitary_permit_signatures.city_health_officer_id';
        $show_fields[] = 'sanitary_permit_signatures.city_health_officer_position as cho_position';
        
        $join_tables = [
            [ "LEFT", "companies", "sanitary_permits.company_id", "companies.id"],
            [ "LEFT", "payments", "sanitary_permits.payment_id", "payments.id"],
            [ "LEFT", "sanitary_permit_signatures", "sanitary_permits.sanitary_permit_signature_id", "sanitary_permit_signatures.id"],
            [ "LEFT", "health_officials as si", "sanitary_permit_signatures.sanitary_inspector_id", "si.id"],
            [ "LEFT", "health_officials as cho", "sanitary_permit_signatures.city_health_officer_id", "cho.id"],
        ];
        $wheres = [[ 'table' => 'sanitary_permits', 'key' => 'id', 'value' => $request->id ]];

        $sanitary_permit = $model->select($show_fields, $join_tables,  $wheres);
        $sanitary_permit['issued_at'] =  Helper::humanDate('m/d/Y', $sanitary_permit['issued_at']);
        $sanitary_permit['expired_at'] = Helper::humanDate('m/d/Y', $sanitary_permit['expired_at']);
        $sanitary_permit['amount'] = number_format($sanitary_permit['amount'], 2);
        $sanitary_permit['paid_at'] = Helper::humanDate('m/d/Y', $sanitary_permit['paid_at']);
        $sanitary_permit['issued_at'] =  Helper::humanDate('m/d/Y', $sanitary_permit['issued_at']);

        $si_suffix = in_array($sanitary_permit['si_suffix'], ['', null]) ? '' : ', '.$sanitary_permit['si_suffix'];
        $si_name = $sanitary_permit['si_first_name'] . ' '.$sanitary_permit['si_middle_name'][0].'. '.$sanitary_permit['si_last_name'].$si_suffix;
        $cho_suffix = in_array($sanitary_permit['cho_suffix'], ['', null]) ? '' : ', '.$sanitary_permit['cho_suffix'];
        $cho_name = $sanitary_permit['cho_first_name'] . ' '.$sanitary_permit['cho_middle_name'][0].'. '.$sanitary_permit['cho_last_name'].$cho_suffix;

        $sanitary_permit['sanitary_inspector_id'] = [
            "id" => $sanitary_permit['sanitary_inspector_id'],
            "text" => $si_name,
        ];
        $sanitary_permit['city_health_officer_id'] = [
            "id" => $sanitary_permit['city_health_officer_id'],
            "text" => $cho_name,
        ];
        $sanitary_permit['company_id'] = [
            "id" => $sanitary_permit['company_id'],
            "text" => $sanitary_permit['company'],
        ];
        
        return [
            "success" => true,
            "message" => "success",
            "data" => [
                "sanitary_permit" => $sanitary_permit,
                'signatures' => $this->getSignatures(),
                "fees" => $this->getFees(),
                "checklists" => $this->getChecklist(),
                "inspection_checklists" => $this->getSPInspectionChecklist($request->id),
                "sanitary_checklists" => $this->getSanitaryChecklist(),
            ]
        ];
    }

    public function update($request) {

        $sanitary_permit = $this->getSanitaryPermit($request->id);
        $sanitary_permit_signature = new SanitaryPermitSignatureModel;
        $sanitary_permit_signature->update([
            'city_health_officer_id' => $request->city_health_officer_id,
            'city_health_officer_position' => $request->cho_position,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s'),
            'id' => $sanitary_permit['sanitary_permit_signature_id']
        ]);

        $model = new SanitaryPermitModel;
        $sanitary_permit = $model->show(['id' => $request->id]);
        $payment_id = $sanitary_permit['payment_id'];

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

        $sanitary_permit = new SanitaryPermitModel;
        $sanitary_permit_data = [
            'id' => $request->id,
            'issued_at' => Helper::humanDate('Y-m-d', $request->issued_at),
            'expired_at' => Helper::humanDate('Y-m-d', $request->expired_at),
            'company_id' => $request->company_id,
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if(!$sanitary_permit->update($sanitary_permit_data)) {
            return [
                "success" => false,
                "message" => "error"
            ];
        }

        $evaluation = $this->evaluateInspection($request->checklists);
        $sp_inspection = $this->getSPInspection($request->id);
        $sp_inspection_data = [
            'id' => $sp_inspection['id'],
            'rate' => $evaluation['rate'],
            'is_passed' => $evaluation['is_passed'],
            'updated_by' => $this->auth->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $sp_inspection = new SanitaryPermitInspectionModel;
        $sp_inspection->update($sp_inspection_data);

        $sp_inspection_checklist = new SanitaryPermitInspectionChecklistModel;
        $wheres = [
            [ 'table' => 'sanitary_permit_inspection_checklists', 'key' => 'sanitary_permit_id', 'value' => $request->id],
        ];
        $sp_inspection_checklist->delete($wheres);

        if(is_array($request->checklists)) {
            foreach($request->checklists as $checklist) {
                $sp_inspection_checklist_data_update = [
                    'sanitary_permit_id' => $request->id,
                    'checklist_id' => $checklist,
                    'created_by' => $this->auth->id
                ];
                
                $sp_inspection_checklist->lastInsertId($sp_inspection_checklist_data_update);
            }
        }
        else {
            $sp_inspection_checklist_data = [
                'sanitary_permit_id' =>  $request->id,
                'checklist_id' => $request->checklists,
                'created_by' => $this->auth->id
            ];
            $sp_inspection_checklist->lastInsertId($sp_inspection_checklist_data);
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
        $sanitary_permit = new SanitaryPermitModel;
        $data = [
            'id' => $request->id,
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($sanitary_permit->remove($data)) {

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
        $model = new SanitaryPermitModel;
        $show_fields = [ 
           'permit_no', 'issued_at', 'expired_at', 'company_id', 'payment_id', 'sanitary_permit_signature_id',
        ];
        $show_fields = Helper::appendTable('sanitary_permits', $show_fields);
        
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';
        $show_fields[] = 'companies.name as company';
        $show_fields[] = 'companies.address as address';
        $show_fields[] = 'establishments.name as establishment';
        $show_fields[] = 'si.suffix as si_suffix';
        $show_fields[] = 'si.first_name as si_first_name';
        $show_fields[] = 'si.middle_name as si_middle_name';
        $show_fields[] = 'si.last_name as si_last_name';
        $show_fields[] = 'sanitary_permit_signatures.sanitary_inspector_id';
        $show_fields[] = 'sanitary_permit_signatures.sanitary_inspector_position as si_position';

        $show_fields[] = 'cho.status as cho_status';
        $show_fields[] = 'cho.suffix as cho_suffix';
        $show_fields[] = 'cho.first_name as cho_first_name';
        $show_fields[] = 'cho.middle_name as cho_middle_name';
        $show_fields[] = 'cho.last_name as cho_last_name';
        $show_fields[] = 'sanitary_permit_signatures.city_health_officer_id';
        $show_fields[] = 'sanitary_permit_signatures.city_health_officer_position as cho_position';
        $show_fields[] = 'sanitary_permit_inspections.is_passed';

        $join_tables = [
            [ "LEFT", "companies", "sanitary_permits.company_id", "companies.id"],
            [ "LEFT", "establishments", "companies.establishment_id", "establishments.id"],
            [ "LEFT", "sanitary_permit_signatures", "sanitary_permits.sanitary_permit_signature_id", "sanitary_permit_signatures.id"],
            [ "LEFT", "health_officials as si", "sanitary_permit_signatures.sanitary_inspector_id", "si.id"],
            [ "LEFT", "health_officials as cho", "sanitary_permit_signatures.city_health_officer_id", "cho.id"],
            [ "LEFT", "payments", "sanitary_permits.payment_id", "payments.id"],
            [ "LEFT", "sanitary_permit_inspections", "sanitary_permits.id", "sanitary_permit_inspections.sanitary_permit_id"],
        ];
        $wheres = [[ 'table' => 'sanitary_permits', 'key' => 'id', 'value' => $request->id ]];
        
        $sanitary_permit = $model->select($show_fields, $join_tables,  $wheres);

        $si_suffix = in_array($sanitary_permit['si_suffix'], ['', null]) ? '' : ', '.$sanitary_permit['si_suffix'];
        $si_name = $sanitary_permit['si_first_name'] . ' '.$sanitary_permit['si_middle_name'][0].'. '.$sanitary_permit['si_last_name'].$si_suffix;
        $cho_suffix = in_array($sanitary_permit['cho_suffix'], ['', null]) ? '' : ', '.$sanitary_permit['cho_suffix'];
        $cho_name = $sanitary_permit['cho_first_name'] . ' '.$sanitary_permit['cho_middle_name'][0].'. '.$sanitary_permit['cho_last_name'].$cho_suffix;

        $data = [
            'permit_no' => str_pad($sanitary_permit['permit_no'], 6, "0", STR_PAD_LEFT),
            'company' => strtoupper($sanitary_permit['company']),
            'establishment' => strtoupper($sanitary_permit['establishment']),
            'address' => strtoupper($sanitary_permit['address']),
            'issued_at' =>  Helper::humanDate('F d, Y', Helper::humanDate('m/d/Y', $sanitary_permit['issued_at'])),
            'expired_at' =>  Helper::humanDate('F d, Y', Helper::humanDate('m/d/Y', $sanitary_permit['expired_at'])),
            'amount' =>   number_format($sanitary_permit['amount'], 2),
            'si_name' => strtoupper($si_name),
            'cho_name' => strtoupper($cho_name),
            'si_position' => strtoupper($sanitary_permit['si_position']),
            'cho_position' => strtoupper($sanitary_permit['cho_position']),
            'or_no' =>  $sanitary_permit['or_no'],
            'amount' =>  $sanitary_permit['amount'],
            'paid_at' =>   Helper::humanDate('Y-d-m', Helper::humanDate('m/d/Y', $sanitary_permit['paid_at'])),
            'is_passed' =>  $sanitary_permit['is_passed']
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

    public function getSanitaryPermit($sanitary_id) {
        $model = new SanitaryPermitModel;
        $show_fields = [ 'id', 'sanitary_permit_signature_id' ];
        $wheres = [[ 'table' => 'sanitary_permits', 'key' => 'id', 'value' => $sanitary_id ]];
        $sanitary_permit = $model->select($show_fields, [],  $wheres);

        return $sanitary_permit;
    }

    public function getFees() {
        $model = new FeeModel;
        $show_fields = [ 'amount' ];
        $show_fields = Helper::appendTable('fees', $show_fields);
        $wheres = [[ 'table' => 'fees', 'key' => 'id', 'value' => $this->fee_id ]];

        return  $model->select($show_fields, [],  $wheres);
    }

    public function getChecklist() {
        $show_fields = [ 'sanitary_checklist_id', 'checklist_id' ];
        $show_fields = Helper::appendTable('sanitary_checklist_assigns', $show_fields);
        $show_fields[] = 'checklists.description as checklist';
        $join_tables = [
            [ "LEFT", "checklists", "sanitary_checklist_assigns.checklist_id", "checklists.id"],
        ];
        $wheres = [
            [ 'table' => 'sanitary_checklist_assigns', 'key' => 'sanitary_checklist_id', 'value' => $this->sanitary_checklist_id,]
        ];
        $model = new SanitaryChecklistAssignModel;
        $sanitary_checklist_assigns = $model->selects($show_fields, $join_tables,  $wheres);

       return $sanitary_checklist_assigns;
    }

    public function getSanitaryChecklist() {
        $show_fields = [
            'satisfaction_from', 'satisfaction_to', 'very_satisfaction_from', 'very_satisfaction_to',
            'excelent_from', 'excelent_to', 'module_id'
        ];
        $show_fields = Helper::appendTable('sanitary_checklists', $show_fields);
        $wheres = [
            [ 'table' => 'sanitary_checklists', 'key' => 'module_id', 'value' => $this->module],
        ];
        $model = new SanitaryChecklistModel;
        $sanitary_checklists = $model->select($show_fields, [],  $wheres);

        return $sanitary_checklists;
    }

    public function create() {
        return [
            "success" => true,
            "message" => "success",
            "data" => [
                'signatures' => $this->getSignatures(),
                "fees" => $this->getFees(),
                "checklists" => $this->getChecklist(),
                "sanitary_checklists" => $this->getSanitaryChecklist(),
            ]
        ];
    }

    public function evaluateInspection($checklist_selected) {
        $sanitary_checklist = $this->getSanitaryChecklist();
        $count_checklist = is_array($checklist_selected) ? count($checklist_selected) : 1;
        $total = count($this->getChecklist());
        $rate = ((int) $count_checklist / (int) $total) * 100;

        return [
            'rate' => $rate,
            'is_passed' => $rate >= $sanitary_checklist['satisfaction_from'] ? 1 : 0
        ];
    }


    public function getSPInspection($permit_id) {
        $show_fields = [
            'id', 'sanitary_permit_id', 'rate', 'is_passed',
        ];
        $show_fields = Helper::appendTable('sanitary_permit_inspections', $show_fields);
        $wheres = [
            [ 'table' => 'sanitary_permit_inspections', 'key' => 'sanitary_permit_id', 'value' => $permit_id],
        ];
        $model = new SanitaryPermitInspectionModel;
        $sp_inspection = $model->select($show_fields, [],  $wheres);

        return $sp_inspection;
    }

    public function getSPInspectionChecklist($permit_id) {
        $show_fields = [
            'id', 'checklist_id'
        ];
        $show_fields = Helper::appendTable('sanitary_permit_inspection_checklists', $show_fields);
        $wheres = [
            [ 'table' => 'sanitary_permit_inspection_checklists', 'key' => 'sanitary_permit_id', 'value' => $permit_id],
        ];
        $model = new SanitaryPermitInspectionChecklistModel;
        $sp_inspection_checklists = $model->selects($show_fields, [],  $wheres);

        return $sp_inspection_checklists;
    }
}
?>