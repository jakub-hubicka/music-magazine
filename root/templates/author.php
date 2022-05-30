<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\AuthorModel;
$Author = new App\Views\AuthorView($model);

$boxCount = $_POST['boxCount'] ?? 0;

echo '<div class="o-container-flex o-container-flex--wrap tagsContainer">';
$Author->showList($boxCount, $_POST['author']);
echo '</div>';