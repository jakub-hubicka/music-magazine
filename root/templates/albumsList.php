<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\AlbumsModel;
$Albums = new App\Views\AlbumsView($model);
$Albums->showMainList();