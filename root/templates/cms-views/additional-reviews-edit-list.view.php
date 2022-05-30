<?php 
	$CmsView = new App\Views\CmsView;
?>
<table class="table">
	<tr>
		<th>Nadpis recenze</th>
		<th></th>
	</tr>

	<?php
		foreach ($CmsView->showAdditionalReviewsList() as $newsItem) {
			$title = $newsItem['title'];
			$id = $newsItem['id'];

			if ($_SESSION['role'] === 1) {
				echo <<< EOT
					<tr>
						<td><a href='additional_reviews-edit-form?id=$id'>$title</a></td>
						<td><a class='deletelink' link-title='$title' style='color:red' href='../handlers/cms-item-delete.php?type=additional_reviews&id=$id'>VYMAZAT</a></td>
					</tr>
				EOT;
			} else {
				echo <<< EOT
					<tr>
						<td><a href='additional_reviews-edit-form?id=$id'>$title</a></td>
					</tr>
				EOT;
			}
		}
	?>
</table>