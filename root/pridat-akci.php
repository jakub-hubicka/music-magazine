<?php
    session_start();
    require_once '../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CMS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.template.css" rel="stylesheet">
    <link href="cms/css/main.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
</head>

<body class="u-bg-dark">
<div class="o-container-inner">
<div class="c-detail-form">
    <div class="c-detail-form__image"></div>
    <div class="c-detail-form__container">
        <h3 class="c-detail-form__title">Přidat akci</h3>
        <form>
            <div class="c-detail-form__input-group">
                <input id="event" class="c-detail-form__input" type="text" placeholder="Název akce">
            </div>
            <div class="c-detail-form__input-group">
                <input id="date" class="c-detail-form__input" type="text" placeholder="Datum">
            </div>
            <div class="c-detail-form__input-group">
                <input id="club" class="c-detail-form__input" type="text" placeholder="Klub">
            </div>
            <div class="c-detail-form__input-group">
                <input id="facebook" class="c-detail-form__input" type="text" placeholder="Facebook event">
            </div>            
            <div class="form-group">
                <label id="croppie-btn" class="c-croppie__button c-croppie__button--v2" for="upload">Nahrát plakát</label>
                <input id="upload" class="c-croppie__input" type="file">
            </div>
            <div id="modal" class="c-croppie__modal">
                <div class="c-croppie__modal-container">
                    <div id="croppie"></div>
                    <div id="croppie-upload" class="c-croppie__button c-croppie__button--main">Potvrdit</div>
                </div>
            </div>
            <div id="upload-preview" class="c-croppie__preview c-croppie__preview--user"></div>
            <input type="hidden" id="image" name="image">

            <input id="userEventSubmit" class="c-detail-form__button" type="submit" value="Odeslat">
        </form>
    </div>
    <div class="c-detail-form__success">
        <img src="images/check.png">
        <div class="c-detail-form__success-text">Akce čeká na schválení</div>
    </div>
</div>
</div>
</body>

<script src="js/addEvent.js"></script>

</html>
