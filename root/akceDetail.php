<?php
	session_start();
	require_once '../vendor/autoload.php';

	$Detail = new App\Views\details\EventsDetailView($_GET['urlpath'], $_GET['type']);
	$Comments = new App\Views\CommentsView(new App\Models\CommentsModel);
	
	$fullPath = "recenze/" . $_GET['urlpath'];
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		define('TITLE', 'Marast');
		include 'templates/html/head.html';
	?>
</head>

<body class="<?php if (isset($_SESSION['darkmode']))echo $_SESSION['darkmode']?>">
	<?php
		include 'templates/html/search.html';
		include 'templates/html/topbar.html';
		include 'templates/html/header.html';
		include 'templates/html/mobile-menu.html';
	?>

	<div id="detail-header" class="c-header-large" style="background-image: url(../<?php $Detail->showImgUrl() ?>), url(../images/default.png)">
		<div class="c-header-large__container" >
			<span class="c-tag">Tiskové zprávy</span> <span id="slideToCommentSection" class="c-item-footer__comments-count c-item-footer__comments-count--dark u-invert u-c-pointer"></span>
			<?php $Detail->showTitle() ?>
			<h3 class="u-white u-mb">
				<?php echo $Detail->getDate() ?>
			</h3>
		</div>
	</div>

	<div class="o-wrapper">
		<div class="o-container-outer">
			<div class="o-container-inner">
				<?php $Detail->showDetail() ?>				
			</div>

			<?php $Detail->showImg() ?>

			<div class="o-container-inner">
				<div class="c-detail-comments">
					<!--<h1 class="c-detail-title c-detail-title--v3">Diskuze</h1>-->
				
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
</div>

	<?php include 'templates/html/footer.html'; ?>

	<div class="c-text-fixed">
		<img src="../images/text-fixed.png">
	</div>

	<script src="../js/main.js"></script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-62276f5ab66ad7b0"></script> 

</body>
</html>


