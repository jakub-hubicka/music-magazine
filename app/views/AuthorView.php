<?php

namespace App\Views;
use App\Models as m;

class AuthorView extends m\AuthorModel {

	public function showList(string $boxCount, string $author): void {
		$res = $this->getList($boxCount, $author);

		foreach ($res as $item) {
			
			$publishDate = date("d.m.y", strtotime($item['publish_date']));

			echo <<< EOT
				<a href='$item[url_path]' class='c-item-v4'>
					<div class='c-item-v4__img' style='background-image:url($item[image_reference]), url(images/default.jpg)'>
						<span class='c-tag'>$item[type]</span>
					</div>
					<div class='c-item-v4__container'>
						<div class='c-item-v4__text'>$item[title]</div>
						<span class='c-item-v4__author'>$item[author_name]</span> - <span class='c-item-v4__date'>$publishDate</span>
					</div>
				</a>
			EOT;
		}
	}
}