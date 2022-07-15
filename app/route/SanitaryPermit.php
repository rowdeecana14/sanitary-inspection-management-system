<?php

use App\Controller\SanitaryPermitController;

if(strtolower($request->action) == "all") {
    $sanitary_permit = new SanitaryPermitController;
    echo json_encode(
        $sanitary_permit->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {

    $sanitary_permit = new SanitaryPermitController;
    echo json_encode(
        $sanitary_permit->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {

    $sanitary_permit = new SanitaryPermitController;
    echo json_encode(
        $sanitary_permit->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $sanitary_permit = new SanitaryPermitController;
    echo json_encode(
        $sanitary_permit->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $sanitary_permit = new SanitaryPermitController;
    echo json_encode(
        $sanitary_permit->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $sanitary_permit = new SanitaryPermitController;
    echo json_encode(
        $sanitary_permit->remove($request)
    );
    die();
}
else if(strtolower($request->action) == "prints") {
    $sanitary_permit = new SanitaryPermitController;
    echo json_encode(
        $sanitary_permit->prints($request)
    );
    die();
}
else if(strtolower($request->action) == "create") {
    $sanitary_permit = new SanitaryPermitController;
    echo json_encode(
        $sanitary_permit->create()
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