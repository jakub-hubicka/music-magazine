<?php

namespace App\Views;
use App\Models as m;
use App\Views\abstract\AbstractArticlesView;

class ReportsView extends AbstractArticlesView {

	private $model;

	public function __construct(m\ReportsModel $model) {
		$this->model = $model;
	}

	public function showReportData($id) {
		return $this->model->getReportData($id);
	}

	public function showReportsList(): void {
		$this->printList($this->model->getList(), 'homepage');
	}

	public function showFullList(int $boxCount): void {
		$this->printList($this->model->getFullList($boxCount), 'overview');
	}
}