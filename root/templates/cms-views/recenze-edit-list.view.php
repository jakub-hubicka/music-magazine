<?php 
	$CmsView = new App\Views\CmsView;
?>
<table class="table">
	<tr>
		<th>Nadpis recenze</th>
		<th></th>
	</tr>

	<?php
		foreach ($CmsView->showReviewsList() as $newsItem) {
			$title = $newsItem['title'];
			$id = $newsItem['id'];

			if ($_SESSION['role'] === 1) {
				echo "
					<tr>
						<td><a href='recenze-edit-form?id=$id'>$title</a></td>
						<td><a class='deletelink' link-title='$title' style='color:red' href='../handlers/cms-item-delete.php?type=recenze&id=$id'>VYMAZAT</a></td>
					</tr>
				";
			} else {
				echo "
					<tr>
						<td><a href='recenze-edit-form?id=$id'>$title</a></td>
					</tr>
				";
			}
		}
	?>
</table>