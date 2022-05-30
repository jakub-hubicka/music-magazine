<?php

require_once __DIR__ . '/../../app/core/CmsRouter.php';

$Router = new App\Core\CmsRouter;

$Router->register('/', function() {
	require __DIR__ . '/../../root/templates/cms-views/intro.view.php';
});

$Router->register('/novinka', function() {
    require __DIR__ . '/../../root/templates/cms-views/novinka.view.php';
});

$Router->register('/recenze', function() {
    require __DIR__ . '/../../root/templates/cms-views/recenze.view.php';
});

$Router->register('/rozhovor', function() {
    require __DIR__ . '/../../root/templates/cms-views/rozhovor.view.php';
});

$Router->register('/report', function() {
    require __DIR__ . '/../../root/templates/cms-views/report.view.php';
});

$Router->register('/akce', function() {
    require __DIR__ . '/../../root/templates/cms-views/akce.view.php';
});

$Router->register('/poutac1', function() {
    require __DIR__ . '/../../root/templates/cms-views/poutac1.view.php';
});

$Router->register('/poutac2', function() {
    require __DIR__ . '/../../root/templates/cms-views/poutac2.view.php';
});

$Router->register('/poutac3', function() {
    require __DIR__ . '/../../root/templates/cms-views/poutac3.view.php';
});

$Router->register('/kostka', function() {
    require __DIR__ . '/../../root/templates/cms-views/poutac4.view.php';
});

$Router->register('/novinky-edit-list', function() {
    require __DIR__ . '/../../root/templates/cms-views/novinky-edit-list.view.php';
});

$Router->register('/novinky-edit-form', function() {
    require __DIR__ . '/../../root/templates/cms-views/novinky-edit-form.view.php';
});

$Router->register('/recenze-edit-list', function() {
    require __DIR__ . '/../../root/templates/cms-views/recenze-edit-list.view.php';
});

$Router->register('/recenze-edit-form', function() {
    require __DIR__ . '/../../root/templates/cms-views/recenze-edit-form.view.php';
});

$Router->register('/rozhovor-edit-list', function() {
    require __DIR__ . '/../../root/templates/cms-views/rozhovor-edit-list.view.php';
});

$Router->register('/rozhovor-edit-form', function() {
    require __DIR__ . '/../../root/templates/cms-views/rozhovor-edit-form.view.php';
});

$Router->register('/report-edit-list', function() {
    require __DIR__ . '/../../root/templates/cms-views/report-edit-list.view.php';
});

$Router->register('/report-edit-form', function() {
    require __DIR__ . '/../../root/templates/cms-views/report-edit-form.view.php';
});

$Router->register('/akce-edit-list', function() {
    require __DIR__ . '/../../root/templates/cms-views/akce-edit-list.view.php';
});

$Router->register('/akce-edit-form', function() {
    require __DIR__ . '/../../root/templates/cms-views/akce-edit-form.view.php';
});

$Router->register('/galerie', function() {
    require __DIR__ . '/../../root/templates/cms-views/galerie.view.php';
});

$Router->register('/wishlist', function() {
    require __DIR__ . '/../../root/templates/cms-views/wishlist.view.php';
});

$Router->register('/akce-od-lidi', function() {
    require __DIR__ . '/../../root/templates/cms-views/users-events.view.php';
});

$Router->register('/alba', function() {
    require __DIR__ . '/../../root/templates/cms-views/alba.view.php';
});

$Router->register('/alba-edit-list', function() {
    require __DIR__ . '/../../root/templates/cms-views/alba-edit-list.view.php';
});

$Router->register('/alba-edit-form', function() {
    require __DIR__ . '/../../root/templates/cms-views/alba-edit-form.view.php';
});

$Router->register('/ostatni', function() {
    require __DIR__ . '/../../root/templates/cms-views/ostatni.view.php';
});

$Router->register('/ostatni-edit-list', function() {
    require __DIR__ . '/../../root/templates/cms-views/ostatni-edit-list.view.php';
});

$Router->register('/ostatni-edit-form', function() {
    require __DIR__ . '/../../root/templates/cms-views/ostatni-edit-form.view.php';
});

$Router->register('/additional-reviews', function() {
    require __DIR__ . '/../../root/templates/cms-views/additional-reviews.view.php';
});

$Router->register('/additional-reviews-edit-form', function() {
    require __DIR__ . '/../../root/templates/cms-views/additional-reviews-edit-form.view.php';
});

$Router->register('/additional-reviews-edit-form', function() {
    require __DIR__ . '/../../root/templates/cms-views/additional-reviews-edit-form.view.php';
});

$Router->register('/schvaleni', function() {
    require __DIR__ . '/../../root/templates/cms-views/schvaleni.view.php';
});

$Router->run()();