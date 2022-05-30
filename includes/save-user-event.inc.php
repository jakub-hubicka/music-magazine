<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	require __DIR__ . "/../app/controllers/UserEventController.php";
	require __DIR__ . "/../app/core/Database.php";
	$UserEventController = new App\controllers\UserEventController;

	$UserEventController->saveUserEvent($post['event'], $post['date'], $post['club'], $post['facebook'], $post['image']);
}