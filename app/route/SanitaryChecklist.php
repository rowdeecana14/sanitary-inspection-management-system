<?php

use App\Controller\Settings\SanitaryChecklistController;

if(strtolower($request->action) == "all") {
    $sanitary_checklist = new SanitaryChecklistController;
    echo json_encode(
        $sanitary_checklist->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {

    $sanitary_checklist = new SanitaryChecklistController;
    echo json_encode(
        $sanitary_checklist->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $sanitary_checklist = new SanitaryChecklistController;
    echo json_encode(
        $sanitary_checklist->show($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $sanitary_checklist = new SanitaryChecklistController;
    echo json_encode(
        $sanitary_checklist->update($request)
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