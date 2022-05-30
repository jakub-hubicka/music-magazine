<?php

namespace App\Views;
use App\Models as m;

class OthersView extends m\OthersModel {

	public function showList(): void {
		$res = $this->getList();

		foreach ($res as $item) {
			
			$authors = explode(",", $item['author_name']);
			$authorsWrapped = [];

			foreach($authors as $author) {
				$authorsWrapped[] = "<span class='c-item-footer__author'>" . $author . "</span>";
			}

			$authorsString = implode(", ", $authorsWrapped);
			$publishDate = date("d.m.y", strtotime($item['publish_date']));

			$image = $item['image_reference'] === "http://test.com/" ? "images/default.jpg" : $item['image_reference'];

			echo <<<EOT
				<a href='$item[url_path]' class='c-box-v1' style='background-image:url($image), url(images/default.png)'>
				<div class='c-box-v1__content'>		
					<h3 class='c-box-v1__title'>$item[title]</h3>
					<div class='c-box-v1__tags'>
						<span class='c-tag'>$item[category]</span>
					</div>
					<span class='c-arrow' style='background:blue;color:white;'></span>
				</div>
					<div class='c-item-footer'>
						$authorsString - <span class='c-item-footer__date'>$publishDate</span> <span class='c-item-footer__comments-count'> $item[comments_count]</span>
					</div>
				</a>				
			EOT;
		}
	}
}