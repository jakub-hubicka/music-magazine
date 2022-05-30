<?php
	session_start();
	require_once '../vendor/autoload.php';
	
	$Comments = new App\Views\CommentsView(new App\Models\CommentsModel);
	$Top = new App\Views\TopContentView(new App\Models\TopContentModel);
	$News = new App\Views\NewsView(new App\Models\NewsModel);
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		define('TITLE', 'Novinky');
		include 'templates/html/head.html';
	?>
</head>

<body class="<?php if (isset($_SESSION['darkmode']))echo $_SESSION['darkmode']?>" id="overview">
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
					Novinky
				</div>
			</div>
		</div>

		<div class="o-container-outer o-container-outer--wide">
			<div id="main"></div>

			<div class="c-pagination">
				<button id="btnMore" class="c-pagination__more-button">Načíst další</button>
			</div>
		</div>

		<?php include 'templates/html/top-content-block.html'; ?>
	</div>

	<?php include 'templates/html/footer.html'; ?>

	<div class="c-text-fixed">
		<img src="images/text-fixed.png">
	</div>

	<script>var overviewTemplate = "templates/newsAll.php";</script>
	<script src="js/main.js"></script>
</body>
</html>


