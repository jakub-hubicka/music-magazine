<?php

namespace App\Views;
use App\Models as m;
use App\Views\BaseView;

class SearchResultView extends BaseView {

	private $model;

	public function __construct(m\SearchResultModel $model) {
		$this->model = $model;
	}	

	public function showList(string $searchString, string $searchType): void {
		$res = $this->model->getList($searchString, $searchType);

		foreach ($res as $item) {
			
			$authorName = $this->parseAuthorName($item['author_name']);
			$publish_date = date("d.m.y", strtotime($item['publish_date']));
			$image = $item['image_reference'] === "http://test.com/" ? "images/default.jpg" : $item['image_reference'];

			switch ($item['type']) {
				case 'novinka':
					$folder = 'novinky';
					break;
				case 'article':
					$folder = 'clanky';
					$type = 'Článek';
					break;
				case 'Review':
					$folder = 'clanky';
					break;
				case 'gallery':
					$folder = 'galerie';
					break;
				case 'report':
					$folder = 'novinky';
					break;
				case 'recenze':
					$folder = 'clanky';
					break;
				case 'interview':
					$folder = 'clanky';
					break;
			}

			echo <<<EOT
				<a href='$item[url_path]' class='c-item-v4'>
					<div class='c-item-v4__img' style='background-image:url($image), url(images/default.png)'>
						<span class='c-tag'>$item[type]</span>
					</div>
					<div class='c-item-v4__container'>
						<div class='c-item-v4__text'>$item[title]</div>
						<span class='c-item-v4__author'>$authorName</span> - <span class='c-item-v4__date'>$publish_date</span>
					</div>
				</a>
			EOT;
		}
	}
}