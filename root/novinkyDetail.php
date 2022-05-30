<?php
	session_start();
	require_once '../vendor/autoload.php';
	
	$Detail = new App\Views\details\NewsDetailView($_GET['urlpath']);
	$Comments = new App\Views\CommentsView(new App\Models\CommentsModel);

	$ViewsCountController = new App\controllers\ViewsCountController;
	$ViewsCountController->addView($Detail->getType(), $_GET['urlpath']);
	
	$fullPath = "novinky/" . $_GET['urlpath'];
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		define('TITLE', 'Novinky');
		include 'templates/html/head.html';		
	?>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
</head>

<body class="<?php if (isset($_SESSION['darkmode']))echo $_SESSION['darkmode']?>">

	<?php
		include 'templates/html/search.html';
		include 'templates/html/topbar.html';
		include 'templates/html/header.html';
		include 'templates/html/mobile-menu.html'; 
	?>

	<div id="detail-header" class="c-header-large" style="background-image: url(../<?php $Detail->imgUrl() ?>), url(../images/default.png)">
		<div class="c-header-large__container" >			
			<?php $Detail->showTitle() ?>
			<span class="c-tag">Novinka</span> <?php $Detail->showOptionalTag(); ?> <span id="slideToCommentSection" class="c-item-footer__comments-count c-item-footer__comments-count--dark u-invert u-c-pointer"></span>
			<div class="c-header-large__footer">
				<?php $Detail->showHeaderFooter() ?>
			</div>
		</div>
	</div>

	<div class="o-wrapper">
		<div class="o-container-outer">
			<div class="o-container-inner">
				<?php $Detail->showDetail() ?>
				<div class="c-article-slider">
				<?php $Detail->showSlider() ?>
				</div>
			</div>

			<?php $Detail->showImg() ?>

			<div class="o-container-inner">
				<div class="c-detail-comments">

					<?php include 'templates/html/detail-form.html'; ?>

					<div id="comments" class="c-detail-comments__container">						
						<?php include 'templates/commentsDetail.php'; ?>
					</div>
				</div>
			</div>

			<div class="c-tags">
				<?php $Detail->showTags() ?>
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

	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-62276f5ab66ad7b0"></script> 
	<script src="../js/main.js"></script>

</body>
</html>


