<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\AlbumsModel;
$Albums = new App\Views\AlbumsView($model);

$boxCount = $_POST['boxCount'] ?? 0;

echo '<div class="o-container-flex o-container-flex--wrap">';
$Albums->showFullList($boxCount);
echo '</div>';