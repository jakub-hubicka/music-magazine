<?php

namespace App\Views\details;
use App\Models as m;
use App\Views\abstract\AbstractDetailView;

class ReviewDetailView  extends AbstractDetailView {

	private $model;
	private $intro;
	private $body;
	private $title;
	private $rating;	
	private $band;
	private $album;
	private $isRedesignVersion;
	private $additionalReview;

	public function __construct($urlpath) {

		$this->model = new m\ReviewsModel;

		$this->server = "https://" . $_SERVER['HTTP_HOST'] . "/" . "marast";
		
		$res = $this->model->getDetail($urlpath);

		$this->additionalReview = $this->model->checkAdditionalReview($urlpath);

		$this->intro = $res["intro"];
		$this->body = $res["body"];
		$this->slider = $res["slider"];
		$this->rating = $res["rating"];
		$this->type = $res["type"];
		$this->tags = $res["tags"];
		$this->title = $res["title"];
		$this->band = $res["band"];
		$this->album = $res["album"];
		$this->image = $res["image"];
		$this->related_content_string = $res["related_content"];
		$this->isRedesignVersion = $res["is_redesign_version"];
		$this->contentObjectId = $res["contentobject_id"];

		$this->authorName = $this->parseDetailAuthorName($res['author_name']);
		$this->publish_date = date("d.m.Y", strtotime($res[0]["publish_date"]));
	}

	public function showTitle(): void {
		if ($this->isRedesignVersion === '1') {
			echo <<< EOT
				<h1 class='c-header-large__title u-mb'>Recenze: $this->title</h1>
			EOT;
		} else {
			echo <<< EOT
				<h1 class='c-header-large__title u-mb'>Recenze: $this->band - $this->album</h1>
			EOT;	
		}
	}

	public function showDetail(): void {
		echo <<< EOT
			<h3>$this->intro</h3>
			<div class='c-text'>$this->body</div>			
		EOT;

		if (!empty($this->additionalReview)) {
			$author = $this->additionalReview[0]['author'];
			$content = $this->additionalReview[0]['content'];
			$rating = $this->additionalReview[0]['rating'];

			echo <<< EOT
				<h3>$author</h3>
				<div class='u-pos-rel'>
					<div class='c-detail-info'>
						Hodnocení:<br>
						<span class='c-detail-info--large'>$rating</span>
					</div>
				</div>
				<div class='c-text'>$content</div>
			EOT;
		}
	}

	public function getRating() {
		return $this->rating;
	}
}
