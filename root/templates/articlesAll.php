<?php
require_once __DIR__ . "/../../vendor/autoload.php";

$model = new App\Models\ArticlesModel;
$Articles = new App\Views\ArticlesView($model);

$boxCount = $_POST['boxCount'] ?? 0;

echo '<div class="o-container-flex o-container-flex--wrap">';
$Articles->showFullList($boxCount);
echo '</div>';