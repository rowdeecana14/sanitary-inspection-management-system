<?php

use App\Controller\TransferCadaverController;

if(strtolower($request->action) == "all") {
    $transfer_cadaver = new TransferCadaverController;
    echo json_encode(
        $transfer_cadaver->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {
    $transfer_cadaver = new TransferCadaverController;
    echo json_encode(
        $transfer_cadaver->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {
    $transfer_cadaver = new TransferCadaverController;
    echo json_encode(
        $transfer_cadaver->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $transfer_cadaver = new TransferCadaverController;
    echo json_encode(
        $transfer_cadaver->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $transfer_cadaver = new TransferCadaverController;
    echo json_encode(
        $transfer_cadaver->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $transfer_cadaver = new TransferCadaverController;
    echo json_encode(
        $transfer_cadaver->remove($request)
    );
    die();
}
else if(strtolower($request->action) == "prints") {
    $transfer_cadaver = new TransferCadaverController;
    echo json_encode(
        $transfer_cadaver->prints($request)
    );
    die();
}
else if(strtolower($request->action) == "create") {
    $transfer_cadaver = new TransferCadaverController;
    echo json_encode(
        $transfer_cadaver->create($request)
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