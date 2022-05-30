<?php

namespace App\controllers;
use App\Models\CubeModel;

class CubeController extends CubeModel {

	public function saveCubeInfo(string $date, string $title, string $shortText, string $link, string $image): void {		
		$this->setCubeInfo($date, $title, $shortText, $link, $image);
	}
}