<?php

namespace App\Views;
use App\Models as m;
use App\Views\abstract\AbstractArticlesView;
use App\Views\BaseView;

class ArticlesView extends AbstractArticlesView {

	private $model;

	public function __construct(m\ArticlesModel $model) {
		$this->model = $model;
	}	

	public function showAllList(): void {
		$this->printList($this->model->getAllList(), 'homepage');
	}

	public function showFullList(int $boxCount): void {
		$this->printList($this->model->getList($boxCount), 'overview');
	}

	public function showFullListOthers(int $boxCount): void {
		$res = $this->model->getOthersList($boxCount);
		$BaseView = new BaseView;	

		foreach ($res as $item) {

			$authorName = $this->parseAuthorName($item['author_name']);
			$publishDate = date("d.m.y", strtotime($item['publish_date']));
			$type = $item['category'] ?? $item['type'];

			$parsedResult = [
				'urlPath' => $item['url_path'],
				'image' => $item['image_reference'],
				'title' => $item['title'],
				'commentsCount' => $item['comments_count'],
				'authorName' => $authorName,
				'publishDate' => $publishDate,
				'type' => $type
			];

			$BaseView->printItem_v4($parsedResult);
		}
	}
}