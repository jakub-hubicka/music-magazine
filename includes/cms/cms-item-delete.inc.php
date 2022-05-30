<?php 
require_once __DIR__ . '/../app/controllers/CmsController.php';
$CmsController = new App\controllers\CmsController;
$CmsController->deleteCmsItem($type, $id);