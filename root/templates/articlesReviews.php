<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\ReviewsModel;
$Reviews = new App\Views\ReviewsView($model);

$boxCount = $_POST['boxCount'] ?? 0;

echo '<div class="o-container-flex o-container-flex--wrap">';
$Reviews->showFullList($boxCount);
echo '</div>';