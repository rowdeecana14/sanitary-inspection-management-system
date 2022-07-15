<?php

use App\Controller\Settings\EstablishmentController;

if(strtolower($request->action) == "all") {
    $establishment = new EstablishmentController;
    echo json_encode(
        $establishment->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {

    $establishment = new EstablishmentController;
    echo json_encode(
        $establishment->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {

    $establishment = new EstablishmentController;
    echo json_encode(
        $establishment->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $establishment = new EstablishmentController;
    echo json_encode(
        $establishment->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $establishment = new EstablishmentController;
    echo json_encode(
        $establishment->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $establishment = new EstablishmentController;
    echo json_encode(
        $establishment->remove($request)
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