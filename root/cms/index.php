<?php
    session_start();
    require_once "../../vendor/autoload.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CMS</title>
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap/bootstrap.template.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script src="https://kit.fontawesome.com/e744032045.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
</head>

<body>

<?php 
    require_once "../../includes/login.inc.php";
    $server = explode("/", $_SERVER["REQUEST_URI"]);
    $currentTemplate = strtok(end($server),'?');
    $currentRole = $_SESSION['role'] === 1 ? 'Admin' : 'Editor';
?>

<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <span class="cms-user"><?php echo $_SESSION['login'] . " (" . $currentRole . ")";?></span>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img class="cms-logo" src="images/cms-logo.png"><a class="navbar-brand" href="https://www.test.com">test.com</a>  
        </div>        
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <?php include 'html/menu.html' ?>
        </div>
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <?php include 'html/page-header.php' ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <?php require_once __DIR__ . "/../../includes/cms/cms-router.inc.php" ?>                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/cms.js"></script>

</body>
</html>
