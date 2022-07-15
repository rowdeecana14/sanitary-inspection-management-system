<?php

namespace App\Controller;
use App\Model\SanitaryPermitModel;
use App\Model\BusinessPermitModel;
use App\Model\CompanyModel;
use App\Model\LogModel;
use App\Controller\BaseController;
use App\Helper\Helper;

class CompanyController extends BaseController {

    public $module = 18;
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
            'name', 'establishment_id', 'owner', 'contact_no', 'email',  'address', 'status',
        ];
        $show_fields = Helper::appendTable('companies', $show_fields);
        $show_fields[] = 'companies.id as company_id';
        $show_fields[] = 'establishments.name as establishment';
        $join_tables = [
            [ "LEFT", "establishments", "companies.establishment_id", "establishments.id"],
        ];
        $model = new CompanyModel;
        $companies = $model->selects($show_fields, $join_tables);
        $result = [];

        foreach($companies as $index => $company) {
            $badge =  $company['status'] == "Active" ? "secondary" : "default";
            array_push($result, [
                'index' => $index + 1,
                'name' => $company['name'],
                'establishment' => $company['establishment'],
                'owner' => $company['owner'],
                'contact_no' => $company['contact_no'],
                'status' => '<span class="badge badge-'.$badge.'">'.strtoupper($company['status']).'</span>',
                'action' => '
                    <button type="button" class="btn btn-icon btn-round btn-info btn-show"  data-id="'.$company['company_id'].'" data-toggle="tooltip" data-placement="top" title="View record">
                        <i class="fas fa-search"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-warning btn-edit" data-id="'.$company['company_id'].'" data-toggle="tooltip" data-placement="top" title="Edit record">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-delete" data-id="'.$company['company_id'].'" data-toggle="tooltip" data-placement="top" title="Delete record">
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
        $company = new CompanyModel;
        $data = isset($request->q) ? [ 'name' => $request->q ] : [];
        $fields = ['id', 'name as text'];
        $companies = $company->search($fields, [], $data);

        return [
            "success" => true,
            "message" => "success",
            "data" => $companies
        ];
    }
    
    public function store($request) {
        $company = new CompanyModel;
        $data = Helper::unsets((array) $request, ['module', 'action', 'csrf_token']);
        $data['created_by'] = $this->auth->id;
        $company_id =  $company->lastInsertId($data);

        $log = new LogModel;
        $log->store([
            'requests' => json_encode($request),
            'ip' => Helper::getUserIP(),
            'module_id' => $this->module,
            'action_id' => $this->action_add,
            'record_id' => $company_id,
            'user_id' => $this->auth->id
        ]);

        return [
            "success" => true,
            "message" => "success"
        ];
    }

    public function show($request) {
        $model = new CompanyModel;
        $show_fields = [ 
            'name', 'establishment_id', 'owner', 'contact_no', 'email',  'address', 'status',
        ];
        $show_fields = Helper::appendTable('companies', $show_fields);
        $show_fields[] = 'companies.id as company_id';
        $show_fields[] = 'establishments.name as establishment';
        $join_tables = [
            [ "LEFT", "establishments", "companies.establishment_id", "establishments.id"],
        ];
        $model = new CompanyModel;
        $wheres = [[ 'table' => 'companies', 'key' => 'id', 'value' => $request->id ]];
        $company = $model->select($show_fields, $join_tables,  $wheres);

        $company['id'] = $company['company_id'];
        $company['establishment_id'] = [
            "id" => $company['establishment_id'],
            "text" => $company['establishment'],
        ];

        return [
            "success" => true,
            "message" => "success",
            "data" => $company
        ];
    }

    public function profile($request) {
        // START COMPANIES
        $show_fields = [ 
            'name', 'establishment_id', 'owner', 'contact_no', 'email', 'address', 'status',
            'created_by', 'updated_by', 'created_at', 'updated_at'
        ];
        $show_fields = Helper::appendTable('companies', $show_fields);
        $show_fields[] = 'creator.suffix as creator_suffix';
        $show_fields[] = 'creator.first_name as creator_first_name';
        $show_fields[] = 'creator.middle_name as creator_middle_name';
        $show_fields[] = 'creator.last_name as creator_last_name';

        $show_fields[] = 'updator.suffix as updator_suffix';
        $show_fields[] = 'updator.first_name as updator_first_name';
        $show_fields[] = 'updator.middle_name as updator_middle_name';
        $show_fields[] = 'updator.last_name as updator_last_name';
        $show_fields[] = 'establishments.name as establishment';

        $join_tables = [
            [ "LEFT", "establishments", "companies.establishment_id", "establishments.id"],
            [ "LEFT", "users as creator_user", "companies.created_by", "creator_user.id"],
            [ "LEFT", "health_officials as creator", "creator_user.health_official_id", "creator.id"],
            [ "LEFT", "users as updator_user", "companies.updated_by", "updator_user.id"],
            [ "LEFT", "health_officials as updator", "updator_user.health_official_id", "updator.id"],
        ];
        $wheres = [[ 'table' => 'companies', 'key' => 'id', 'value' => $request->id ]];

        $model = new CompanyModel;
        $company = $model->select($show_fields, $join_tables,  $wheres);
        $creator_suffix = in_array($company['creator_suffix'], ['', null]) ? '' : ', '.$company['creator_suffix'];
        $creator_name = $company['creator_first_name'] . ' '.$company['creator_middle_name'][0].'. '.$company['creator_last_name'].$creator_suffix;
        $company['created_by'] = $creator_name;

        $updator_suffix = in_array($company['updator_suffix'], ['', null]) ? '' : ', '.$company['updator_suffix'];
        $updator_name = $company['updator_first_name'] . ' '.$company['updator_middle_name'][0].'. '.$company['updator_last_name'].$updator_suffix;
        $company['updated_by'] = isset($company['updated_by']) ?  $updator_name : '';
        $company['created_at'] = Helper::humanDate('M d, Y h:i A', $company['created_at']);
        $company['updated_at'] = Helper::humanDate('M d, Y h:i A', $company['updated_at']);

        $show_fields = [ 'issued_at', 'expired_at' ];
        $show_fields = Helper::appendTable('sanitary_permits', $show_fields);
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';
        // END START COMPANIES

        // START SANITARY PERMITS
        $join_tables = [
            [ "LEFT", "payments", "sanitary_permits.payment_id", "payments.id"],
        ];
        $wheres = [[ 'table' => 'sanitary_permits', 'key' => 'company_id', 'value' => $request->id ]];

        $model = new SanitaryPermitModel;
        $sanitary_permits = $model->selects($show_fields, $join_tables, $wheres);

        foreach($sanitary_permits as $index => $sanitary_permit) {
            $sanitary_permits[$index]['index'] = $index + 1;
            $sanitary_permits[$index]['amount'] = number_format($sanitary_permit['amount'], 2);
            $sanitary_permits[$index]['issued_at'] = Helper::humanDate('M d, Y', $sanitary_permit['issued_at']);
            $sanitary_permits[$index]['expired_at'] = Helper::humanDate('M d, Y', $sanitary_permit['expired_at']);
            $sanitary_permits[$index]['paid_at'] = Helper::humanDate('M d, Y', $sanitary_permit['paid_at']);
        }
        // START SANITARY PERMITS

        // START BUSINESS PERMITS
        $show_fields = [ 'issued_at', 'expired_at' ];
        $show_fields = Helper::appendTable('business_permits', $show_fields);
        $show_fields[] = 'payments.or_no';
        $show_fields[] = 'payments.amount';
        $show_fields[] = 'payments.paid_at';


        $join_tables = [
            [ "LEFT", "payments", "business_permits.payment_id", "payments.id"],
        ];
        $wheres = [[ 'table' => 'business_permits', 'key' => 'company_id', 'value' => $request->id ]];

        $model = new BusinessPermitModel;
        $wheres = [[ 'table' => 'business_permits', 'key' => 'company_id', 'value' => $request->id ]];
        $business_permits = $model->selects($show_fields, $join_tables, $wheres);

        foreach($business_permits as $index => $business_permit) {
            $business_permits[$index]['index'] = $index + 1;
            $business_permits[$index]['amount'] = number_format($business_permit['amount'], 2);
            $business_permits[$index]['issued_at'] = Helper::humanDate('M d, Y', $sanitary_permit['issued_at']);
            $business_permits[$index]['expired_at'] = Helper::humanDate('M d, Y', $business_permit['expired_at']);
            $business_permits[$index]['paid_at'] = Helper::humanDate('M d, Y', $business_permit['paid_at']);
        }
        // END BUSINESS PERMITS

        return [
            "success" => true,
            "message" => "success",
            "data" => [
                "profile" => $company,
                "sanitary_permits" => $sanitary_permits,
                "business_permits" => $business_permits
            ],
        ];
    }

    public function update($request) {
        $company = new CompanyModel;
        $data = Helper::unsets((array) $request, ['module', 'action', 'csrf_token']);
        $data['updated_by'] = $this->auth->id;
        $data['updated_at'] = date('Y-m-d H:i:s');

        if($company->update($data)) {

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
        $company = new CompanyModel;
        $data = [
            'id' => $request->id,
            'status' => 'Inactive',
            'deleted_by' => $this->auth->id,
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        if($company->remove($data)) {

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