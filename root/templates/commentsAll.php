<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\CommentsModel;
$Comments = new App\Views\CommentsView($model);

$Comments->showFullList();