<?php

use App\Controller\MedicalCerticateController;

if(strtolower($request->action) == "all") {
    $medical_cetificate = new MedicalCerticateController;
    echo json_encode(
        $medical_cetificate->all()
    );
    die();
}
else if(strtolower($request->action) == "resident") {
    $medical_cetificate = new MedicalCerticateController;
    echo json_encode(
        $medical_cetificate->resident($request)
    );
    die();
}
else if(strtolower($request->action) == "select2") {
    $medical_cetificate = new MedicalCerticateController;
    echo json_encode(
        $medical_cetificate->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {
    $medical_cetificate = new MedicalCerticateController;
    echo json_encode(
        $medical_cetificate->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $medical_cetificate = new MedicalCerticateController;
    echo json_encode(
        $medical_cetificate->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $medical_cetificate = new MedicalCerticateController;
    echo json_encode(
        $medical_cetificate->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $medical_cetificate = new MedicalCerticateController;
    echo json_encode(
        $medical_cetificate->remove($request)
    );
    die();
}
else if(strtolower($request->action) == "prints") {
    $medical_cetificate = new MedicalCerticateController;
    echo json_encode(
        $medical_cetificate->prints($request)
    );
    die();
}
else if(strtolower($request->action) == "create") {
    $medical_cetificate = new MedicalCerticateController;
    echo json_encode(
        $medical_cetificate->create()
    );
    die();
}
else {
    http_response_code(401);
    echo json_encode([
        "success" => false,
        "message" => "Unauthorized user, action not found"
    ]);
    die();
}
?>