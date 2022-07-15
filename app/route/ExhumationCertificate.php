<?php

use App\Controller\ExhumationCertificateController;

if(strtolower($request->action) == "all") {
    $exhumation_certificate = new ExhumationCertificateController;
    echo json_encode(
        $exhumation_certificate->all()
    );
    die();
}
else if(strtolower($request->action) == "resident") {
    $exhumation_certificate = new ExhumationCertificateController;
    echo json_encode(
        $exhumation_certificate->resident($request)
    );
    die();
}
else if(strtolower($request->action) == "select2") {
    $exhumation_certificate = new ExhumationCertificateController;
    echo json_encode(
        $exhumation_certificate->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {
    $exhumation_certificate = new ExhumationCertificateController;
    echo json_encode(
        $exhumation_certificate->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $exhumation_certificate = new ExhumationCertificateController;
    echo json_encode(
        $exhumation_certificate->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $exhumation_certificate = new ExhumationCertificateController;
    echo json_encode(
        $exhumation_certificate->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $exhumation_certificate = new ExhumationCertificateController;
    echo json_encode(
        $exhumation_certificate->remove($request)
    );
    die();
}
else if(strtolower($request->action) == "prints") {
    $exhumation_certificate = new ExhumationCertificateController;
    echo json_encode(
        $exhumation_certificate->prints($request)
    );
    die();
}
else if(strtolower($request->action) == "create") {
    $exhumation_certificate = new ExhumationCertificateController;
    echo json_encode(
        $exhumation_certificate->create()
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