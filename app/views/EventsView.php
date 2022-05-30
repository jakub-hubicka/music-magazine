<?php
namespace App\Views;
use App\Models as m;

class EventsView extends m\EventsModel {

	public function showEventsList(): void {
		$res = $this->getEventsList(7);

		foreach ($res as $event) {

			if (empty($event['event_type'])) {
				$eventType = "Akce";
			} else {
				$eventType = $event['event_type'];
			}

			if ($event['multiday_string'] !== "") {
				$date = $event['multiday_string'];
				$multiclass = "c-box-v2__date--multi";
			} else {
				$date = date("d.m", strtotime($event['date']));
				$multiclass = "";
			}

			$image = $event['image_reference'] === "http://test.com/" ? "images/default.jpg" : $event['image_reference'];

			echo <<< EOT
				<a href='$event[url_path]' class='c-slider-multiple__item'>
					<div class='c-box-v2 u-center' style='background-image:url($image), url(images/default.png)'>
						<div class='c-box-v2__content'>
							<div><span class='c-tag'>$eventType</span><span class='c-box-v2__comments-count'>$event[comments_count]</span></div>
							<div class='c-box-v2__date $multiclass'>$date</div>		
							<h3 class='c-box-v2__title'>$event[title]</h3>
							<div class='c-box-v2__footer'>$event[venue]</div>
							<span class='c-arrow c-arrow--colored'></span>
						</div>
					</div>
				</a>
			EOT;
		}

		echo <<< EOT
			<a href='akce' class='c-slider-multiple__item'>
				<div class='c-box-v2 c-box-v2--last u-center'>
					<div class='c-box-v2__content c-box-v2__content--last'>
						<img src='images/plus.png' class='c-box-v2__plus-icon'>
						<h3 class='c-box-v2__title c-box-v2__title--large'>VŠECHNY AKCE</h3>
					</div>
				</div>
			</a>
		EOT;
	}

	public function showLastEvent(): void {
		$res = $this->getEventsList(1);
		$event = $res[0];
		$image = $event['image_reference'];

		$date = date("d.m", strtotime($event['date']));

		$image = $event['image_reference'] === "http://test.com/" ? "images/default.jpg" : $event['image_reference'];

		echo <<< EOT
			<a href='$event[url_path]' class='c-box-v2 c-box-v2--cube' style='background-image:url($image), url(images/default.png)'>
				<div class='c-box-v2__content'>
					<div><span class='c-tag'>Promo</span><span class='c-box-v2__comments-count'>$event[comments_count]</span></div>	
					<div class='c-box-v2__date'>$date</div>		
					<h3 class='c-box-v2__title'>$event[title]</h3>
					<div class='c-box-v2__footer'>$event[venue]</div>
					<span class='c-arrow c-arrow--colored'></span>
				</div>
			</a>				
		EOT;
	}

	public function showFullList(int $boxCount): void {
		$res = $this->getList($boxCount);

		foreach ($res as $event) {
			
			if ($event['multiday_string'] !== "") {
				$date = $event['multiday_string'];
			} else {
				$date = date("d.m", strtotime($event['date']));
			}

			$image = $event['image_reference'] === "http://test.com/" ? "images/default.jpg" : $event['image_reference'];		

			echo <<< EOT
				<div class='u-mb'>
					<a href='$event[url_path]' class='c-box-v2 u-center' style='background-image:url($image), url(images/default.png)'>
						<div class='c-box-v2__content'>
							<div><span class='c-tag'>Akce</span><span class='c-box-v2__comments-count'>$event[comments_count]</span></div>
							<div class='c-box-v2__date'>$date</div>		
							<h3 class='c-box-v2__title'>$event[title]</h3>
							<div class='c-box-v2__footer'>$event[venue]</div>
							<span class='c-arrow c-arrow--colored'></span>
						</div>
					</a>
				</div>			
			EOT;
		}
	}
}
