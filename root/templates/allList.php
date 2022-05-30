<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\ArticlesModel;
$AllList = new App\Views\ArticlesView($model);
$AllList->showAllList();