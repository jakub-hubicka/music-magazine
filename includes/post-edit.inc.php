<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	require __DIR__ . '/../app/controllers/CmsController.php';
	$CmsController = new App\controllers\CmsController;
	$CmsController->sendEditData($_POST, $_FILES);
}