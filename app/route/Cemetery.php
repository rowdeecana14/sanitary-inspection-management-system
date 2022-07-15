<?php

use App\Controller\Settings\CemeteryController;

if(strtolower($request->action) == "all") {
    $cemetery = new CemeteryController;
    echo json_encode(
        $cemetery->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {

    $cemetery = new CemeteryController;
    echo json_encode(
        $cemetery->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {

    $cemetery = new CemeteryController;
    echo json_encode(
        $cemetery->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $cemetery = new CemeteryController;
    echo json_encode(
        $cemetery->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $cemetery = new CemeteryController;
    echo json_encode(
        $cemetery->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $cemetery = new CemeteryController;
    echo json_encode(
        $cemetery->remove($request)
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