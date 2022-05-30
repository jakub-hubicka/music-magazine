<?php
	session_start();
	require_once '../vendor/autoload.php';
	
	$Event = new App\Views\EventsView;
	$Cube = new App\Views\CubeView;
	$News = new App\Views\NewsView(new App\Models\NewsModel);
	$Gallery = new App\Views\GalleryView(new App\Models\GalleryModel);
	$Banner = new App\Views\BannerView(new App\Models\BannerModel);
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		define('TITLE', 'Články');
		include('templates/html/head.html');
	?>
</head>

<body class="<?php if (isset($_SESSION['darkmode']))echo $_SESSION['darkmode']?>" id="homepage">

	<?php
		include 'templates/html/search.html';
		include 'templates/html/topbar.html';
		include 'templates/html/header.html'; 
		include 'templates/html/mobile-menu.html'; 
	?>

	<div class="o-wrapper o-wrapper--main">
		<div class="o-container-outer o-container-outer--wide">
			<div class="o-container-flex">			
				<?php $Banner->showBanner(); ?>
			</div>	

			<?php
				$bannerDark = true;
				include 'templates/html/banner.html'; 
			?>

			<div class="c-title c-title--compact">Novinky</div>	

			<div class="o-container-flex o-container-flex--tablet-reset">	
				<?php include 'templates/html/news-block.html'; ?>			
			</div>			
		</div>
	</div>

	<section class="o-section u-bg-dark">
		<div class="o-container-outer o-container-outer--wide">
			<?php include 'templates/html/articles.html'; ?>
		</div>
	</section>

	<section class="o-section">
		<div class="o-container-outer o-container-outer--wide">			
			<div class="u-pb">
				<div class="c-detail-title c-detail-title--small">Galerie</div>
			</div>
			<div class="o-container-flex">
				<?php $Gallery->showGalleryList(0, 2); ?>
			</div>
			<?php
				include 'templates/html/banner.html';
			?>
		</div>
	</section>

	<section class="o-section u-bg-dark">
		<div class="o-container-outer o-container-outer--wide">
			<?php include 'templates/html/events.html'; ?>
		</div>
	</section>

	<?php include 'templates/html/spotify.html'; ?>
	<?php include 'templates/html/footer.html'; ?>

	<div class="c-text-fixed">
		<img src="images/text-fixed.png">
	</div>

	<script src="js/main.js"></script>
</body>
</html>


