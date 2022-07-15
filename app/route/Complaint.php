<?php

use App\Controller\ComplaintController;

if(strtolower($request->action) == "all") {
    $complaint = new ComplaintController;
    echo json_encode(
        $complaint->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {

    $complaint = new ComplaintController;
    echo json_encode(
        $complaint->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {

    $complaint = new ComplaintController;
    echo json_encode(
        $complaint->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $complaint = new ComplaintController;
    echo json_encode(
        $complaint->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $complaint = new ComplaintController;
    echo json_encode(
        $complaint->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $complaint = new ComplaintController;
    echo json_encode(
        $complaint->remove($request)
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