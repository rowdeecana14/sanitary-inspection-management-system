<?php

use App\Controller\HealthCertificateController;

if(strtolower($request->action) == "all") {
    $health_certificate = new HealthCertificateController;
    echo json_encode(
        $health_certificate->all()
    );
    die();
}
else if(strtolower($request->action) == "resident") {
    $health_certificate = new HealthCertificateController;
    echo json_encode(
        $health_certificate->resident($request)
    );
    die();
}
else if(strtolower($request->action) == "select2") {
    $health_certificate = new HealthCertificateController;
    echo json_encode(
        $health_certificate->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {
    $health_certificate = new HealthCertificateController;
    echo json_encode(
        $health_certificate->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $health_certificate = new HealthCertificateController;
    echo json_encode(
        $health_certificate->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $health_certificate = new HealthCertificateController;
    echo json_encode(
        $health_certificate->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $health_certificate = new HealthCertificateController;
    echo json_encode(
        $health_certificate->remove($request)
    );
    die();
}
else if(strtolower($request->action) == "prints") {
    $health_certificate = new HealthCertificateController;
    echo json_encode(
        $health_certificate->prints($request)
    );
    die();
}
else if(strtolower($request->action) == "signature") {
    $health_certificate = new HealthCertificateController;
    echo json_encode([
        'data' => $health_certificate->getSignatures($request)
    ]);
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