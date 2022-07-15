<?php

namespace App\Controller;
use App\Controller\BaseController;
use App\Model\Settings\UserModel;

use App\Model\HealthOfficialModel;
use App\Model\CompanyModel;
use App\Model\ResidentModel;
use App\Model\Settings\GenderModel;
use App\Model\ComplaintModel;
use App\Model\SanitaryPermitModel;
use App\Model\BusinessPermitModel;
use App\Model\MedicalCertificateModel;
use App\Model\HealthCertificateModel;
use App\Model\ExhumationCertificateModel;
use App\Model\TransferCadaverModel;

class DashboardController extends BaseController {

    public function widgets() {
        $model = new UserModel;
        $wheres = [[ 'table' => 'users', 'key' => 'status', 'value' => 'Active' ]];
        $users_count = $model->rowsCount([], $wheres);

        $model = new HealthOfficialModel;
        $wheres = [[ 'table' => 'health_officials', 'key' => 'status', 'value' => 'Active' ]];
        $health_officials_count = $model->rowsCount([], $wheres);

        $model = new CompanyModel;
        $wheres = [[ 'table' => 'companies', 'key' => 'status', 'value' => 'Active' ]];
        $companies_count = $model->rowsCount([], $wheres);

        $model = new ResidentModel;
        $wheres = [[ 'table' => 'residents', 'key' => 'status', 'value' => 'Active' ]];
        $residents_count = $model->rowsCount([], $wheres);

        $model = new ResidentModel;
        $males_count = $model->countMales();
        $females_count = $model->countFemales();
        $seniors_count = $model->countSeniors();
        $pwds_count = $model->countPwds();
        $voters_count = $model->countVoters();

        $model = new ComplaintModel;
        $complaints_count = $model->rowsCount([], []);
        $unsetteleds_count = $model->countUnsettleds();

        $model = new BusinessPermitModel;
        $business_permits_count = $model->rowsCount([], []);

        $model = new SanitaryPermitModel;
        $sanitary_permits_count = $model->rowsCount([], []);

        $model = new HealthOfficialModel;
        $health_certificate_count = $model->rowsCount([], []);

        $model = new MedicalCertificateModel;
        $medical_certificate_count = $model->rowsCount([], []);

        $model = new ExhumationCertificateModel;
        $exhumation_certificate_count = $model->rowsCount([], []);

        return [
            'data' => [
                'users' => $users_count,
                'health_officials' =>  $health_officials_count,
                'companies' =>  $companies_count,
                'residents' =>  $residents_count,
                'males' => $males_count,
                'females' => $females_count,
                'siniors' => $seniors_count,
                'pwds' => $pwds_count,
                'voters' => $voters_count,
                'complaints' => $complaints_count,
                'unsettleds' => $unsetteleds_count,
                'permits' => $business_permits_count + $sanitary_permits_count,
                'certificates' => $health_certificate_count + $medical_certificate_count + $exhumation_certificate_count,
                'permits_and_certificates' => $business_permits_count + $sanitary_permits_count + $health_certificate_count + $medical_certificate_count + $exhumation_certificate_count,
            ]
        ];
    }

    public function gendersGraph() {
        $model = new ResidentModel;
        return [
            'data' =>  $model->gendersGraph()
        ];
    }

    public function personDisabilitiesGraph() {
        $model = new ResidentModel;
        return [
            'data' =>  $model->personDisabilitiesGraph()
        ];
    }

    public function residentsGraph() {
        $model = new ResidentModel;
        return [
            'data' =>  $model->monthlyGraph()
        ];
    }

    public function complaintsGraph() {
        $model = new ComplaintModel;
        return [
            'data' =>  $model->monthlyGraph()
        ];
    }

    public function permitsGraph() {
        $model = new BusinessPermitModel;
        $business_permits = $model->monthlyGraph();

        $model = new SanitaryPermitModel;
        $sanitary_permits = $model->monthlyGraph();

        return [
            'data' => [
                'business_permits' =>  $business_permits,
                'sanitary_permits' =>  $sanitary_permits,
            ]
        ];
    }

    public function certificatesGraph() {
        $model = new HealthCertificateModel;
        $health_certificates = $model->monthlyGraph();

        $model = new MedicalCertificateModel;
        $medical_certificates = $model->monthlyGraph();

        $model = new ExhumationCertificateModel;
        $exhumation_certificates = $model->monthlyGraph();

        $model = new TransferCadaverModel;
        $transfer_cadavers = $model->monthlyGraph();

        return [
            'data' => [
                'health_certificates' =>  $health_certificates,
                'medical_certificates' =>  $medical_certificates,
                'exhumation_certificates' =>  $exhumation_certificates,
                'transfer_cadavers' => $transfer_cadavers
            ]
        ];
    }
}
?>