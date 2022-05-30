<?php

namespace App\controllers;
use App\Models\ViewsCountModel;

class ViewsCountController extends ViewsCountModel {

	public function addView(string $type, string $urlpath): void {		
		$this->saveView($type, $urlpath);
	}
}