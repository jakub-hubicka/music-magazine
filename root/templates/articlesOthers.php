<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\ArticlesModel;
$Others = new App\Views\ArticlesView($model);

$boxCount = $_POST['boxCount'] ?? 0;

echo '<div class="o-container-flex o-container-flex--wrap">';
$Others->showFullListOthers($boxCount);
echo '</div>';