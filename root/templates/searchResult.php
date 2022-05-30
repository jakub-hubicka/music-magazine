<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\SearchResultModel;
$SearchResult = new App\Views\SearchResultView($model);

$SearchResult->showList($_POST['searchString'], $_POST['type']);