<?php

namespace App\Views\details;
use App\Models as m;
use App\Views\abstract\AbstractDetailView;

class ArticlesDetailView extends AbstractDetailView {

	private $model;
	private $body;
	private $intro;

	public function __construct($urlPath) {

		$this->model = new m\ArticlesModel;

		$res = $this->model->getDetail($urlPath)[0];

		$this->intro = $res['intro'];
		$this->title = $res['title'];
		$this->slider = $res['slider'];
		$this->id = $res['id'];
		$this->tags = $res['tags'];
		$this->type = $res['type'];
		$this->body = $res['body'];
		$this->image = $res['image'];

		$this->server = 'https://' . $_SERVER['HTTP_HOST'] . '/' . 'marast';
		$this->relatedContentString = $res['related_content'];
		$this->contentObjectId = $res['contentobject_id'];

		if ($this->type === 'article') {
			$category = $this->model->getCategory($urlPath);
			$this->type = $category[0]['category'];
		}	

		$this->authorName = $this->parseDetailAuthorName($res['author_name']);
		$this->publishDate = date("d.m.Y", strtotime($res["publish_date"]));
	}

	public function showTitle(): void {
		echo <<< EOT
			<h1 class='c-header-large__title u-mb'>$this->title</h1>
		EOT;	
	}

	public function showDetail(): void {
		echo <<< EOT
			<h3>$this->intro</h3>
			<div class='c-text'>$this->body</div>
		EOT;
	}
	
}
