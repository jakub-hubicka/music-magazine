<?php

namespace App\Views;
use App\Models as m;

class NewsView extends BaseView {

	private $model;

	public function __construct(m\NewsModel $model) {
		$this->model = $model;
	}	

	public function showNews(string $version, int $count = 3): void {
		$res = $this->model->getNewsList($count);

		foreach ($res as $item) {

			$authorName = $this->parseAuthorName($item['author_name']);
			$publishDate = date("d.m.y", strtotime($item['publish_date']));
			$type = $item['type'];

			$size = $version == 'small' ? 'c-item-v1__container--small' : '';

			$parsedResult = [
				'urlPath' => $item['url_path'],
				'image' => $item['img_main'],				
				'title' => $item['title'],
				'commentsCount' => $item['comments_count'],
				'authorName' => $authorName,
				'publishDate' => $publishDate,
				'size' => $size,
				'type' => $type
			];

			$this->printItem_v1($parsedResult);
		}
	}	

	public function showFullList(int $boxCount): void {
		$res = $this->model->getList($boxCount);

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

			$this->printItem_v4($parsedResult);
		}
	}
}