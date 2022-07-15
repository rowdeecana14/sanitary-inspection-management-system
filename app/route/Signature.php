<?php

use App\Controller\Settings\SignatureController;

if(strtolower($request->action) == "all") {
    $signature = new SignatureController;
    echo json_encode(
        $signature->all()
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $signature = new SignatureController;
    echo json_encode(
        $signature->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $signature = new SignatureController;
    echo json_encode(
        $signature->update($request)
    );
    die();
}
else if(strtolower($request->action) == "health_official") {
    $signature = new SignatureController;
    echo json_encode(
        $signature->healthOfficial($request)
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