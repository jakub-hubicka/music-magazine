<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	require __DIR__ . '/../app/controllers/DetailFormController.php';
	$DetailFormController = new App\controllers\DetailFormController;
	$DetailFormController->setComment($post['name'], $post['text'], $post['id'], $post['urlPath'], $post['title'], $post['type']);
	$DetailFormController->increaseCommentCount($post['urlPath'], $post['type']);
}