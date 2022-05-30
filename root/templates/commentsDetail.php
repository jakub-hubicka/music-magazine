<?php
if (isset($_POST['contentObjectId'])) {
	require_once __DIR__ . '/../../vendor/autoload.php';
	
	$model = new App\Models\CommentsModel;
	$Comments = new App\Views\CommentsView($model);
	$contentObjectId = $_POST['contentObjectId'];
	$Comments->showDetailList($contentObjectId);
} else {
	$contentObjectId = $Detail->getContentObjectId();
	$Comments->showDetailList($contentObjectId);
}