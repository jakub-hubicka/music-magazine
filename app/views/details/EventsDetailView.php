<?php

namespace App\Views\details;
use App\Models as m;

class EventsDetailView extends m\EventsModel {
	
	private $contentObjectId;
	private $type;
	private $date;
	private $title;
	private $text;
	private $image;
	private $tags;
	//private $bands;
	//private $venue;
	//private $time;
	//private $info;	
	//private $facebook;

	public function __construct($urlpath, $type) {
		$res = $this->getDetail($urlpath, $type)[0];
		
		$this->contentObjectId = $res["contentobject_id"];
		$this->type = $res["type"];
		$this->date = $res["date"];
		$this->title = $res["title"];
		$this->text = $res["text"];
		$this->image = $res["image"];
		$this->tags = $res["tags"];
		//$this->bands = $res[0]["bands"];
		//$this->venue = $res[0]["venue"];
		//$this->time = $res[0]["time"];
		//$this->info = $res[0]["info"];
		//$this->facebook = $res[0]["facebook"];
	}

	public function getContentObjectId(): int {
		return $this->contentObjectId;
	}

	public function getType(): string {
		return $this->type;
	}

	public function getDate(): string {
		return date("d.m.Y", strtotime($this->date));
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function showTitle(): void {
		echo <<< EOT
			<h1 class='c-header-large__title u-mb'>$this->title</h1>
		EOT;	
	}

	public function showDetail(): void {
		echo <<< EOT
			<div class='c-text'>$this->text</div>			
		EOT;	
	}

	public function showImgUrl(): void {
		echo "$this->image";
	}

	public function showImg(): void {
		echo <<< EOT
			<img class='c-article-img' src='../$this->image'>
		EOT;	
	}
	
	public function showTags(): void {
		$tags = explode(',', $this->tags);
		foreach ($tags as $tag) {
			$tag = trim($tag);
			$tagLink = str_replace(' ', '_', $tag);
			$fullLink = "https://" . $_SERVER['HTTP_HOST'] . '/root/tagy/' . $tagLink;
			
			echo <<< EOT
				<a href='$fullLink' class='c-tags__tag'>$tag</a>
			EOT;
		}
	}    
}
