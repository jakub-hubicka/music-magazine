<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\InterviewsModel;
$Interviews = new App\Views\InterviewsView($model);
$Interviews->showInterviewsList();