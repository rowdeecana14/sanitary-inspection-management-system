<?php

use App\Controller\ReportController;

if(strtolower($request->action) == "generate") {
    $report = new ReportController;
    echo json_encode(
        $report->generate($request)
    );
    die();
}
?>