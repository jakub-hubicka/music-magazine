<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\ReportsModel;
$Reports = new App\Views\ReportsView($model);

$Reports->showReportsList();