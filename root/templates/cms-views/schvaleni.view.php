<?php 
	$CmsView = new App\Views\CmsView;
?>
<table class="table">
	<tr>
		<th>Shválení příspěvků</th>
		<th></th>
	</tr>

	<?php
		foreach ($CmsView->confirmList() as $item) {
			$url_path = $item['url_path'];
            $type = $item['category'];
            $id = $item['id'];
            $author_name = $item['author_name'];

            switch ($type) {
                case 'Ostatní':
                    $form = 'ostatni';
                    break;
                case 'Alba měsíce':
                    $form = 'alba';
                    break;
                case 'event':
                    $form = 'akce';
                    break;
                case 'interview':
                    $form = 'rozhovor';
                    break;
                case 'novinka':
                    $form = 'novinky';
                    break;
                case 'report':
                    $form = 'report';
                    break;
                case 'recenze':
                    $form = 'recenze';
                    break;
            }
            
            echo "
                <tr>
                    <td><a href='$form-edit-form?id=$id'>$url_path</a> - $author_name</td>
                </tr>
            ";
		}
	?>
</table>