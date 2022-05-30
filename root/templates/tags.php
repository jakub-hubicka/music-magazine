<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\TagsModel;
$Tags = new App\Views\TagsView($model);

$boxCount = $_POST['boxCount'] ?? 0;

echo '<div class="o-container-flex o-container-flex--wrap tagsContainer">';
$Tags->showList($boxCount, $_POST['tag']);
echo '</div>';