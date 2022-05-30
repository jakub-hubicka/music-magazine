<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$model = new App\Models\ReviewsModel;
$Reviews = new App\Views\ReviewsView($model);

$Reviews->showReviewsList();