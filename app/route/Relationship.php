<?php

use App\Controller\Settings\RelationshipController;

if(strtolower($request->action) == "all") {
    $relationship = new RelationshipController;
    echo json_encode(
        $relationship->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {

    $relationship = new RelationshipController;
    echo json_encode(
        $relationship->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {

    $relationship = new RelationshipController;
    echo json_encode(
        $relationship->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $relationship = new RelationshipController;
    echo json_encode(
        $relationship->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $relationship = new RelationshipController;
    echo json_encode(
        $relationship->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $relationship = new RelationshipController;
    echo json_encode(
        $relationship->remove($request)
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