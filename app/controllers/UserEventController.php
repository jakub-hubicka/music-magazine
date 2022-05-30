<?php

namespace App\controllers;
use App\Models\EventsModel;

class UserEventController extends EventsModel {

	public function saveUserEvent(string $event, string $date, string $club, string $facebook, string $image): void {		
		$this->setUserEvent($event, $date, $club, $facebook, $image);
	}
}