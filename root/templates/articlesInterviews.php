<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\InterviewsModel;
$Interviews = new App\Views\InterviewsView($model);

$boxCount = $_POST['boxCount'] ?? 0;

echo '<div class="o-container-flex o-container-flex--wrap">';
$Interviews->showFullList($boxCount);
echo '</div>';