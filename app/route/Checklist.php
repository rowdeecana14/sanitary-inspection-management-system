<?php

use App\Controller\Settings\ChecklistController;

if(strtolower($request->action) == "all") {
    $checklist = new ChecklistController;
    echo json_encode(
        $checklist->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {

    $checklist = new ChecklistController;
    echo json_encode(
        $checklist->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $checklist = new ChecklistController;
    echo json_encode(
        $checklist->show($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {
    $checklist = new ChecklistController;
    echo json_encode(
        $checklist->store($request)
    );
}
else if(strtolower($request->action) == "update") {
    $checklist = new ChecklistController;
    echo json_encode(
        $checklist->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $checklist = new ChecklistController;
    echo json_encode(
        $checklist->remove($request)
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