<?php

namespace App\Views;
use App\Models as m;
use App\Views\abstract\AbstractArticlesView;

class AlbumsView extends AbstractArticlesView {

	private $model;

	public function __construct(m\AlbumsModel $model) {
		$this->model = $model;
	}

	public function showMainList(): void {
		$this->printList($this->model->getAlbumsList(), 'homepage');
	}

	public function showFullList(int $boxCount): void {
		$this->printList($this->model->getFullList($boxCount), 'overview');
	}
}