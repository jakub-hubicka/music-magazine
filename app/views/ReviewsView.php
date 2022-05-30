<?php

namespace App\Views;
use App\Models as m;
use App\Views\abstract\AbstractArticlesView;

class ReviewsView extends AbstractArticlesView {

	private $model;

	public function __construct(m\ReviewsModel $model) {
		$this->model = $model;
	}	

	public function showReviewsList(): void {
		$this->printList($this->model->getList(), 'homepage');
	}

	public function showFullList(int $boxCount): void {
		$this->printList($this->model->getFullList($boxCount), 'overview');
	}
}
