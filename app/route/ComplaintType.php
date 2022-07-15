<?php

use App\Controller\Settings\ComplaintTypeController;

if(strtolower($request->action) == "all") {
    $complaint_type = new ComplaintTypeController;
    echo json_encode(
        $complaint_type->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {

    $complaint_type = new ComplaintTypeController;
    echo json_encode(
        $complaint_type->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {

    $complaint_type = new ComplaintTypeController;
    echo json_encode(
        $complaint_type->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $complaint_type = new ComplaintTypeController;
    echo json_encode(
        $complaint_type->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $complaint_type = new ComplaintTypeController;
    echo json_encode(
        $complaint_type->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $complaint_type = new ComplaintTypeController;
    echo json_encode(
        $complaint_type->remove($request)
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