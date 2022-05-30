<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$Events = new App\Views\EventsView;

$boxCount = $_POST['boxCount'] ?? 0;

echo '<div class="o-container-flex o-container-flex--wrap">';
$Events->showFullList($boxCount);
echo '</div>';