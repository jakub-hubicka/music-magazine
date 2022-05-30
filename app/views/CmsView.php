<?php

namespace App\Views;
use App\Models as m;

class CmsView extends m\CmsModel {

	public function showLastTenLinks(): void {
		$links = $this->getLastTenLinks();
		foreach ($links as $id => $link) {
			$url = $_SERVER['HTTP_HOST'] . '/root/' . $link['url_path'];
			if ($id === 0) {
				echo "<span class='link-bold'><a href=https://$url> $url </a></span> (poslední příspěvek)<br><br>";
			} else {
				echo "<a href=https://$url> $url </a><br><br>";
			}
        }
	}

	public function showEvents(): void {
		$events = $this->getEvents();
		foreach ($events as $event) {	
			$created = date("Y/m/d H:i:s", $event['created']);			
			echo <<< EOT
				<div class='event-container'>
					<h4 class='event-title'>Název akce</h4>
					<div class='event-text'>$event[event]</div>
					<br>
					<h4 class='event-title'>Datum</h4>
					<div class='event-text'>$event[date]</div>
					<br>
					<h4 class='event-title'>Klub</h4>
					<div class='event-text'>$event[club]</div>
					<br>
					<h4 class='event-title'>Facebook odkaz</h4>
					<div class='event-text'>$event[facebook]</div>
					<br>
					<div><img src='../$event[image]'></div>
					<br>
					<h4 class='event-title'>Vytvořeno</h4>
					<div class='event-text'>$created</div>
					<br>					
				<div>
			EOT;
        }
	}

	public function confirmList() {
		$res = $this->confirm();
		return $res;
	}

	public function showNewsList() {
		$res = $this->getNewsList();
		return $res;
	}
	public function showNewsData($id) {
		$res = $this->getNewsData($id);
		return $res;
	}

	public function showReviewsList() {
		$res = $this->getReviewsList();
		return $res;
	}
	public function showReviewsData($id) {
		$res = $this->getReviewsData($id);
		return $res;
	}

	public function showAdditionalReviewsList() {
		$res = $this->getAdditionalReviewsList();
		return $res;
	}
	public function showAdditionalReviewsData($id) {
		$res = $this->getAdditionalReviewsData($id);
		return $res;
	}

	public function showInterviewsList() {
		$res = $this->getInterviewsList();
		return $res;
	}
	public function showInterviewsData($id) {
		$res = $this->getInterviewsData($id);
		return $res;
	}

	public function showOthersList() {
		$res = $this->getOthersList();
		return $res;
	}
	public function showOthersData($id) {
		$res = $this->getOthersData($id);
		return $res;
	}

	public function showAlbumsList() {
		$res = $this->getAlbumsList();
		return $res;
	}
	public function showAlbumsData($id) {
		$res = $this->getAlbumsData($id);
		return $res;
	}

	public function showReportsList() {
		$res = $this->getReportsList();
		return $res;
	}
	public function showReportsData($id) {
		$res = $this->getReportsData($id);
		return $res;
	}

	public function showEventsList() {
		$res = $this->getEventsList();
		return $res;
	}
	public function showEventsData($id) {
		$res = $this->getEventsData($id);
		return $res;
	}
}