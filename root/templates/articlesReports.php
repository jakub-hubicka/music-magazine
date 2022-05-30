<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\ReportsModel;
$Reports = new App\Views\ReportsView($model);

$boxCount = $_POST['boxCount'] ?? 0;

echo '<div class="o-container-flex o-container-flex--wrap">';
$Reports->showFullList($boxCount);
echo '</div>';