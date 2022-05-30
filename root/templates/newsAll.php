<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\NewsModel;
$News = new App\Views\NewsView($model);

$boxCount = $_POST['boxCount'] ?? 0;

echo '<div class="o-container-flex o-container-flex--wrap">';
$News->showFullList($boxCount);
echo '</div>';