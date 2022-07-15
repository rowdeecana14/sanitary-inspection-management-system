<?php

use App\Controller\CompanyController;

if(strtolower($request->action) == "all") {
    $company = new CompanyController;
    echo json_encode(
        $company->all()
    );
    die();
}
else if(strtolower($request->action) == "select2") {

    $company = new CompanyController;
    echo json_encode(
        $company->select2($request)
    );
    die();
}
else if(strtolower($request->action) == "store") {

    $company = new CompanyController;
    echo json_encode(
        $company->store($request)
    );
    die();
}
else if(strtolower($request->action) == "show") {
    $company = new CompanyController;
    echo json_encode(
        $company->show($request)
    );
    die();
}
else if(strtolower($request->action) == "profile") {
    $company = new CompanyController;
    echo json_encode(
        $company->profile($request)
    );
    die();
}
else if(strtolower($request->action) == "update") {
    $company = new CompanyController;
    echo json_encode(
        $company->update($request)
    );
    die();
}
else if(strtolower($request->action) == "remove") {
    $company = new CompanyController;
    echo json_encode(
        $company->remove($request)
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