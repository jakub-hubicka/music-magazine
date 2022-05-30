<?php

namespace App\Views;
use App\Models as m;
use App\Views\abstract\AbstractArticlesView;

class interviewsView extends AbstractArticlesView {

	private $model;

	public function __construct(m\interviewsModel $model) {
		$this->model = $model;
	}	

	public function showInterviewsList(): void {
		$this->printList($this->model->getInterviewsList(), 'homepage');
	}

	public function showFullList(int $boxCount): void {
		$this->printList($this->model->getFullList($boxCount), 'overview');
	}
}