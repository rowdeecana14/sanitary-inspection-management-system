<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
date_default_timezone_set('Asia/Manila');

include_once('../template/BaseTemplate.php');
include_once('../helper/Helper.php');

include_once('../model/BaseModel.php');
include_once('../model/settings/BaranggayModel.php');
include_once('../model/settings/PurokModel.php');
include_once('../model/settings/ComplaintTypeModel.php');
include_once('../model/settings/ComplaintStatusModel.php');
include_once('../model/settings/CitizenshipModel.php');
include_once('../model/settings/CivilStatusModel.php');
include_once('../model/settings/OccupationModel.php');
include_once('../model/settings/GenderModel.php');
include_once('../model/settings/RelationshipModel.php');
include_once('../model/settings/PersonDisabilityModel.php');
include_once('../model/settings/EducationalAttainmentModel.php');
include_once('../model/settings/BloodTypeModel.php');
include_once('../model/settings/CemeteryModel.php');
include_once('../model/settings/EstablishmentModel.php');
include_once('../model/settings/UserModel.php');
include_once('../model/settings/SignatureModel.php');
include_once('../model/settings/FeeModel.php');
include_once('../model/settings/ChecklistModel.php');
include_once('../model/settings/SanitaryChecklistModel.php');
include_once('../model/settings/SanitaryChecklistAssignModel.php');
include_once('../model/CompanyModel.php');
include_once('../model/HealthOfficialModel.php');
include_once('../model/ResidentModel.php');
include_once('../model/ComplaintModel.php');
include_once('../model/SanitaryPermitModel.php');
include_once('../model/SanitaryPermitSignatureModel.php');
include_once('../model/SanitaryPermitInspectionModel.php');
include_once('../model/SanitaryPermitInspectionChecklistModel.php');
include_once('../model/BusinessPermitModel.php');
include_once('../model/BusinessPermitSignatureModel.php');
include_once('../model/BusinessPermitInspectionModel.php');
include_once('../model/BusinessPermitInspectionChecklistModel.php');
include_once('../model/HealthCertificateModel.php');
include_once('../model/HealthCertificateSignatureModel.php');
include_once('../model/MedicalCertificateModel.php');
include_once('../model/MedicalCertificateSignatureModel.php');
include_once('../model/ExhumationCertificateModel.php');
include_once('../model/ExhumationCertificateSignatureModel.php');
include_once('../model/TransferCadaverModel.php');
include_once('../model/TransferCadaverSignatureModel.php');
include_once('../model/PaymentModel.php');
include_once('../model/LogModel.php');

include_once('../controller/BaseController.php');
include_once('../controller/settings/BaranggayController.php');
include_once('../controller/settings/PurokController.php');
include_once('../controller/settings/ComplaintTypeController.php');
include_once('../controller/settings/ComplaintStatusController.php');
include_once('../controller/settings/CitizenshipController.php');
include_once('../controller/settings/CivilStatusController.php');
include_once('../controller/settings/OccupationController.php');
include_once('../controller/settings/GenderController.php');
include_once('../controller/settings/RelationshipController.php');
include_once('../controller/settings/PersonDisabilityController.php');
include_once('../controller/settings/EducationalAttainmentController.php');
include_once('../controller/settings/BloodTypeController.php');
include_once('../controller/settings/CemeteryController.php');
include_once('../controller/settings/EstablishmentController.php');
include_once('../controller/settings/UserController.php');
include_once('../controller/settings/SignatureController.php');
include_once('../controller/settings/FeeController.php');
include_once('../controller/settings/ChecklistController.php');
include_once('../controller/settings/SanitaryChecklistController.php');
include_once('../controller/CompanyController.php');
include_once('../controller/HealthOfficialController.php');
include_once('../controller/ResidentController.php');
include_once('../controller/ComplaintController.php');
include_once('../controller/SanitaryPermitController.php');
include_once('../controller/BusinessPermitController.php');
include_once('../controller/HealthCertificateController.php');
include_once('../controller/MedicalCertificateController.php');
include_once('../controller/ExhumationCertificateController.php');
include_once('../controller/TransferCadaverController.php');
include_once('../controller/DashboardController.php');
include_once('../controller/AuthController.php');
include_once('../controller/LogController.php');
include_once('../controller/ReportController.php');

if(trim($_SERVER["CONTENT_TYPE"]) == "application/json") {

    $content = trim(file_get_contents("php://input"));
    $request = json_decode($content);

    if(!isset($request->module)) {
        http_response_code(404);

        echo json_encode([
            "success" => false,
            "message" => "Module not found"
        ]);
    }

    if($request->csrf_token != token()) {
        http_response_code(401);
        
        echo json_encode([
            "success" => false,
            "session_token" =>  $_SESSION['SIMS_TOKEN'],
            "request_token" => $request->csrf_token,
            "message" => "Unauthorized user, wrong token"
        ]);

        exit();
    }
}

?>