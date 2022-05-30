<?php

namespace App\Views;
use App\Models as m;

class TopContentView extends BaseView {
	
	private $model;

	public function __construct(m\TopContentModel $model) {
		$this->model = $model;
	}	

	private function getResult(): array {
		return $this->model->getList();
	}

	public function showTop(): void {
		$item = $this->getResult()[0];

		$authorNames = $this->parseAuthorName($item['author_name']);
		$publish_date = date("d.m.y", strtotime($item['publish_date']));

		echo <<< EOT
			<a href='$item[url_path]' class='c-item-v3'>
				<div class='c-item-v3__img' style='background-image:url($item[image_reference]), url(images/default.png)'></div>
				<div class='c-item-v3__container'>					
					$authorNames - <span class='c-item-v3__date'>$publish_date</span>
					<span class='c-tag'>$item[type]</span>
					<div class='c-item-v3__text'>$item[title]</div>
				</div>
			</a>					
		EOT;		
	}

	public function showTheRest(): void {
		$res = $this->getResult();
		unset($res[0]);

		foreach ($res as $item) {
			
			$authorNames = $this->parseAuthorName($item['author_name']);
			$publishDate = date("d.m.y", strtotime($item['publish_date']));

			$image = $item['image_reference'] === "http://test.com/" ? "images/default.jpg" : $item['image_reference'];			

			echo <<< EOT
				<a href='$item[url_path]' class='c-item-v1'>
					<div class='c-item-v1__img' style='background-image: url($image), url(images/default.png)'></div>
					<div class='c-item-v1__container c-item-v1__container--small'>

						<div class='c-item-v1__tags'>
							<span class='c-tag'>$item[type]</span>
						</div>
						
						<div class='c-item-v1__text'>$item[title]</div>
						<div class='c-item-v1__footer'>
							<span class='c-item-v1__date'>$publishDate</span> - <span class='c-item-v1__author'>$authorNames</span> <span class='c-item-footer__comments-count c-item-footer__comments-count--dark'>$item[comments_count]</span>
						</div>						
					</div>
				</a>
			EOT;
		}
	}
}