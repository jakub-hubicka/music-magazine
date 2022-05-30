<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	$_SESSION['darkmode'] = $post['darkmode'];
}