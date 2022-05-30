<?php

namespace App\Views\details;
use App\Models as m;
use App\Views\abstract\AbstractDetailView;

class NewsDetailView extends AbstractDetailView {

	public $title;
	private $model;
	private $body;
	private $optionalTag;

	public function __construct($urlpath) {

		$this->model = new m\NewsModel;

		$this->server = "https://" . $_SERVER['HTTP_HOST'] . "/" . "marast";
		
		$res = $this->model->getDetail($urlpath)[0];

		$this->body = $res["body"];
		$this->slider = $res["slider"];
		$this->type = $res["type"];
		$this->tags = $res["tags"];		
		$this->title = $res["title"];
		$this->image = $res["image"];
		$this->relatedContentString = $res["related_content"];
		$this->contentObjectId = $res["contentobject_id"];
		$this->optionalTag = $res["optional_tag"];	

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
			<div class='c-text'>$this->body</div>			
		EOT;
	}

	public function showOptionalTag() {
		if (isset($this->optionalTag) && !empty($this->optionalTag)) {
			echo <<< EOT
				<span class='c-tag'>$this->optionalTag</span>
			EOT;
		}
	}
}
