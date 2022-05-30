<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\GalleryModel;
$Gallery = new App\Views\GalleryView($model);

$boxCount = $_POST['boxCount'] ?? 0;

echo '<div class="o-container-flex o-container-flex--wrap">';
$Gallery->showGalleryList($boxCount, 8);
echo '</div>';