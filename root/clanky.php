<?php 
	session_start();
	require_once '../vendor/autoload.php';
	
	$Comments = new App\Views\CommentsView(new App\Models\CommentsModel);
	$Top = new App\Views\TopContentView(new App\Models\TopContentModel);
	$Articles = new App\Views\ArticlesView(new App\Models\ArticlesModel);
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		define('TITLE', 'Články');
		include('templates/html/head.html');		
	?>
	<link rel="stylesheet" href="css/clanky.css">
</head>

<body class="<?php if (isset($_SESSION['darkmode']))echo $_SESSION['darkmode']?>" id="articles">
	<?php
		include 'templates/html/search.html';
		include 'templates/html/topbar.html';
		include 'templates/html/header.html';
		include 'templates/html/mobile-menu.html';
	?>

	<div class="o-wrapper o-wrapper--overview">
		<div class="o-container-outer o-container-outer--wide u-mb-m">
			<div class="o-container-flex u-db-ml">
				<div class="c-detail-title">
					Články
				</div>
				<nav class="c-detail-menu">
					<ul id="articlesMenuList" class="c-detail-menu__list">
						<li id="All" class="c-detail-menu__item <?php if(!isset($_GET['kategorie'])){echo 'c-detail-menu__item--active';} ?>"><a class="c-detail-menu__link">Všechny</a></li>
						<li id="Reviews" class="c-detail-menu__item <?php if(isset($_GET['kategorie'])){if($_GET['kategorie']=='recenze'){echo 'c-detail-menu__item--active';}} ?>"><a class="c-detail-menu__link">Recenze</a></li>
						<li id="Reports" class="c-detail-menu__item <?php if(isset($_GET['kategorie'])){if($_GET['kategorie']=='reporty'){echo 'c-detail-menu__item--active';}} ?>"><a class="c-detail-menu__link">Reporty</a></li>
						<li id="Interviews" class="c-detail-menu__item <?php if(isset($_GET['kategorie'])){if($_GET['kategorie']=='rozhovory'){echo 'c-detail-menu__item--active';}} ?>"><a class="c-detail-menu__link">Rozhovory</a></li>
						<li id="Albums" class="c-detail-menu__item <?php if(isset($_GET['kategorie'])){if($_GET['kategorie']=='alba'){echo 'c-detail-menu__item--active';}} ?>"><a class="c-detail-menu__link">Alba měsíce</a></li>
						<li id="Others" class="c-detail-menu__item <?php if(isset($_GET['kategorie'])){if($_GET['kategorie']=='ostatni'){echo 'c-detail-menu__item--active';}} ?>"><a class="c-detail-menu__link">Ostatní</a></li>
					</ul>
				</nav>
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

	<script src="js/main.js"></script>
</body>
</html>


