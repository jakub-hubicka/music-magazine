<?php
	session_start();
	require_once '../vendor/autoload.php';

	$Comments = new App\Views\CommentsView(new App\Models\CommentsModel);
	$Top = new App\Views\TopContentView(new App\Models\TopContentModel);
	$News = new App\Views\NewsView(new App\Models\NewsModel);
	$Event = new App\Views\EventsView;

	$tag = $_GET['tag'];
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		define('TITLE', 'Články');
		include('templates/html/head.html');
	?>
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
			<div class="c-detail-title">Tagy</div>			
		</div>
	</div>

	<div class="o-container-outer o-container-outer--wide">
		<div id="main"></div>

		<div class="c-pagination">
			<button id="btnMore" class="c-pagination__more-button">Načíst další</button>
		</div>

		<script>
			$("#btnMore").click(function() {
				var boxCount = $(".c-item-v4").length;
				$("<div></div>").appendTo("#main").load("../templates/tags.php", {boxCount: boxCount, tag: '<?php echo $tag ?>'});
			});
		</script>
		<script type="text/javascript">		
			$("#main").load("../templates/tags.php", {tag: '<?php echo $tag ?>'});
		</script>

	</div>
</div>

	<div class="u-bg-dark u-pt-large u-o-h">
		<div class="o-container-outer o-container-outer--wide">
			<?php include 'templates/html/events.html'; ?>
		</div>
	</div>

	<?php include 'templates/html/footer.html'; ?>

	<div class="c-text-fixed">
		<img src="../images/text-fixed.png">
	</div>

	<script src="../js/main.js"></script>
</body>
</html>


