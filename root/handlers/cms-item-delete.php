<?php
	$type = $_GET['type'];
	$id = $_GET['id'];
	require_once '../../includes/cms/cms-item-delete.inc.php';
	header('Location:/root/cms/novinky-edit-list');
?>