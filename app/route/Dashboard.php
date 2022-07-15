<?php

use App\Controller\DashboardController;

if(strtolower($request->action) == "widgets") {
    $dashboard = new DashboardController;
    echo json_encode(
        $dashboard->widgets()
    );
    die();
}
else if(strtolower($request->action) == "genders") {
    $dashboard = new DashboardController;
    echo json_encode(
        $dashboard->gendersGraph()
    );
    die();
}
else if(strtolower($request->action) == "genders") {
    $dashboard = new DashboardController;
    echo json_encode(
        $dashboard->gendersGraph()
    );
    die();
}
else if(strtolower($request->action) == "person_disabilities") {
    $dashboard = new DashboardController;
    echo json_encode(
        $dashboard->personDisabilitiesGraph()
    );
    die();
}
else if(strtolower($request->action) == "complaints") {
    $dashboard = new DashboardController;
    echo json_encode(
        $dashboard->complaintsGraph()
    );
    die();
}
else if(strtolower($request->action) == "permits") {
    $dashboard = new DashboardController;
    echo json_encode(
        $dashboard->permitsGraph()
    );
    die();
}
else if(strtolower($request->action) == "certificates") {
    $dashboard = new DashboardController;
    echo json_encode(
        $dashboard->certificatesGraph()
    );
    die();
}
else if(strtolower($request->action) == "residents") {
    $dashboard = new DashboardController;
    echo json_encode(
        $dashboard->residentsGraph()
    );
    die();
}
?>