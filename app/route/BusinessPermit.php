<?php

use App\Controller\BusinessPermitController;

if(strtolower($request->action) == "all") {
    $business_permit = new BusinessPermitController;
    echo json_encode(
        $business_permit->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {

    $business_permit = new BusinessPermitController;
    echo json_encode(
        $business_permit->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {

    $business_permit = new BusinessPermitController;
    echo json_encode(
        $business_permit->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $business_permit = new BusinessPermitController;
    echo json_encode(
        $business_permit->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $business_permit = new BusinessPermitController;
    echo json_encode(
        $business_permit->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $business_permit = new BusinessPermitController;
    echo json_encode(
        $business_permit->remove($request)
    );
    die();
}
else if(strtolower($request->action) == "prints") {
    $business_permit = new BusinessPermitController;
    echo json_encode(
        $business_permit->prints($request)
    );
    die();
}
else if(strtolower($request->action) == "create") {
    $business_permit = new BusinessPermitController;
    echo json_encode(
        $business_permit->create()
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