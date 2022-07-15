<?php

include_once('./Request.php');

if(trim($_SERVER["CONTENT_TYPE"]) == "application/json") {

    if(strtolower($request->module) == "baranggay") {
        include_once('./Baranggay.php');
    }
    else if(strtolower($request->module) == "purok") {
        include_once('./Purok.php');
    }
    else if(strtolower($request->module) == "complaint_type") {
        include_once('./ComplaintType.php');
    }
    else if(strtolower($request->module) == "complaint_status") {
        include_once('./ComplaintStatus.php');
    }
    else if(strtolower($request->module) == "citizenship") {
        include_once('./Citizenship.php');
    }
    else if(strtolower($request->module) == "civil_status") {
        include_once('./CivilStatus.php');
    }
    else if(strtolower($request->module) == "occupation") {
        include_once('./Occupation.php');
    }
    else if(strtolower($request->module) == "gender") {
        include_once('./Gender.php');
    }
    else if(strtolower($request->module) == "relationship") {
        include_once('./Relationship.php');
    }
    else if(strtolower($request->module) == "person_disability") {
        include_once('./PersonDisability.php');
    }
    else if(strtolower($request->module) == "educational_attainment") {
        include_once('./EducationalAttainment.php');
    }
    else if(strtolower($request->module) == "blood_type") {
        include_once('./BloodType.php');
    }
    else if(strtolower($request->module) == "cemetery") {
        include_once('./Cemetery.php');
    }
    else if(strtolower($request->module) == "establishment") {
        include_once('./Establishment.php');
    }
    else if(strtolower($request->module) == "user") {
        include_once('./User.php');
    }
    else if(strtolower($request->module) == "company") {
        include_once('./Company.php');
    }
    else if(strtolower($request->module) == "health_official") {
        include_once('./HealthOfficial.php');
    }
    else if(strtolower($request->module) == "sanitary_permit") {
        include_once('./SanitaryPermit.php');
    }
    else if(strtolower($request->module) == "business_permit") {
        include_once('./BusinessPermit.php');
    }
    else if(strtolower($request->module) == "resident") {
        include_once('./Resident.php');
    }
    else if(strtolower($request->module) == "complaint") {
        include_once('./Complaint.php');
    }
    else if(strtolower($request->module) == "medical_certificate") {
        include_once('./MedicalCertificate.php');
    }
    else if(strtolower($request->module) == "health_certificate") {
        include_once('./HealthCertificate.php');
    }
    else if(strtolower($request->module) == "exhumation_certificate") {
        include_once('./ExhumationCertificate.php');
    }
    else if(strtolower($request->module) == "transfer_cadaver") {
        include_once('./TransferCadaver.php');
    }
    else if(strtolower($request->module) == "dashboard") {
        include_once('./Dashboard.php');
    }
    else if(strtolower($request->module) == "auth") {
        include_once('./Auth.php');
    }
    else if(strtolower($request->module) == "activity_log") {
        include_once('./ActivityLog.php');
    }
    else if(strtolower($request->module) == "signature") {
        include_once('./Signature.php');
    }
    else if(strtolower($request->module) == "fee") {
        include_once('./Fee.php');
    }
    else if(strtolower($request->module) == "checklist") {
        include_once('./Checklist.php');
    }
    else if(strtolower($request->module) == "sanitary_checklist") {
        include_once('./SanitaryChecklist.php');
    }
    else if(strtolower($request->module) == "report") {
        include_once('./Report.php');
    }
    else {
        http_response_code(404);
        echo json_encode([
            "success" => false,
            "message" => "Module not found"
        ]);
    }
}
else {
    http_response_code(404);
    echo json_encode([
        "success" => false,
        "message" => "Content Type json header not found"
    ]);
}

?>