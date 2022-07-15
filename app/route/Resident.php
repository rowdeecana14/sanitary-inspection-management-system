<?php

use App\Controller\ResidentController;

if(strtolower($request->action) == "all") {
    $resident = new ResidentController;
    echo json_encode(
        $resident->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {

    $resident = new ResidentController;
    echo json_encode(
        $resident->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {

    $resident = new ResidentController;
    echo json_encode(
        $resident->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $resident = new ResidentController;
    echo json_encode(
        $resident->show($request)
    );
    die();
}
else if(strtolower($request->action) == "profile") {
    $resident = new ResidentController;
    echo json_encode(
        $resident->profile($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $resident = new ResidentController;
    echo json_encode(
        $resident->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $resident = new ResidentController;
    echo json_encode(
        $resident->remove($request)
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