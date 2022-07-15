<?php

use App\Controller\Settings\FeeController;

if(strtolower($request->action) == "all") {
    $fee = new FeeController;
    echo json_encode(
        $fee->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {

    $fee = new FeeController;
    echo json_encode(
        $fee->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $fee = new FeeController;
    echo json_encode(
        $fee->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $fee = new FeeController;
    echo json_encode(
        $fee->update($request)
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