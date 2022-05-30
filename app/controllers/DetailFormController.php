<?php

namespace App\controllers;
use App\Models\CommentsModel;

class DetailFormController extends CommentsModel {

	public function setComment(string $name, string $text, int $id, string $urlPath, string $title, string $type): void {
		$this->saveComment($name, $text, $id, $urlPath, $title, $type);		
	}

	public function increaseCommentCount(string $urlPath, string $type): void {
		$this->saveIncreasedCommentCount($urlPath, $type);
	}
}