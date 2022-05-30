<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	require __DIR__ . '/../../app/controllers/CubeController.php';
    require __DIR__ . '/../../app/core/Database.php';
	$Cube = new App\controllers\CubeController;

	$Cube->saveCubeInfo($post['date'], $post['title'], $post['shortText'], $post['link'], $post['image']);
}