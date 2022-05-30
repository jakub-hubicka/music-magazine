<?php
	session_start();
	require_once '../vendor/autoload.php';

	$Detail = new App\Views\GalleryView(new App\Models\GalleryModel);
	$Comments = new App\Views\CommentsView(new App\Models\CommentsModel);

	$fullPath = "galerie/" . $_GET['urlpath'];
	$galleryPath = $_GET['urlpath'];
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		define('TITLE', 'Galerie');
		include 'templates/html/head.html';
	?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
</head>

<body class="<?php if (isset($_SESSION['darkmode']))echo $_SESSION['darkmode']?>">
	<?php
		include 'templates/html/search.html';
		include 'templates/html/topbar.html';
		include 'templates/html/header.html';
		include 'templates/html/mobile-menu.html'; 
	?>
	<div class="o-wrapper o-wrapper--overview">
		<div class="o-container-outer o-container-outer--wide u-mb-m">
			<div class="o-container-flex">
				<div class="c-detail-title">
					Galerie
				</div>
				<div class="c-info-block">
					<?php $Detail->showGalleryData($galleryPath); ?> 
				</div>
			</div>		
			<div class="c-gallery-detail o-container-flex o-container-flex--wrap">			
				<?php $Detail->showImages($galleryPath); ?>
			</div>
			<div class="o-container-inner">
				<div class="c-detail-comments">
					<!--<h1 class="c-detail-title c-detail-title--large">Diskuze</h1>-->
				
					<?php include 'templates/html/detail-form.html'; ?>

					<div id="comments" class="c-detail-comments__container">						
						<?php include 'templates/commentsDetail.php'; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="o-container-outer o-container-outer--wide">
			<h1 class="c-detail-title c-detail-title--v2">Zkus tohle</h1>
			<div class="o-container-flex">
				<?php
					$Detail->showRelated();
				?>
			</div>
		</div>
	</div>
	<?php include 'templates/html/footer.html'; ?>

	<div class="c-text-fixed">
		<img src="../images/text-fixed.png">
	</div>
	
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
	<script src="../js/main.js"></script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-62276f5ab66ad7b0"></script> 
	
</body>
</html>
