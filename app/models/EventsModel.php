<?php

namespace App\Models;
use App\Core\Database;

class EventsModel {

	protected function getEventsList(int $limit): array {
		$Db = new Database;
		$sql = "SELECT 
					id, 
					comments_count, 
					title, 
					venue, 
					date, 
					image_reference, 
					url_path, 
					multiday_string, 
					event_type
				FROM events
				WHERE date > CURDATE()
				ORDER BY date ASC
				LIMIT ?";
		$Db->query($sql);
		$Db->bind(1, $limit);
		return $Db->resultSet();
	}

	protected function getList(int $boxCount): array {
		$boxCount = (int)$boxCount;
		$Db = new Database;
		$sql = "SELECT 
					id, 
					comments_count, 
					title, 
					venue, 
					date, 
					image_reference, 
					url_path, 
					multiday_string
				FROM events
				WHERE date > CURDATE()
				ORDER BY date ASC
				LIMIT ?, 8";
		$Db->query($sql);
		$Db->bind(1, $boxCount);
		return $Db->resultSet();
	}

	protected function getDetail(string $url_path, string $type): array {
		$Db = new Database;
		$urlPathFull = $type . "/" . $url_path;
		$sql = "SELECT 
					title, 
					type, 
					tags, 
					contentobject_id, 
					bands, 
					image, 
					venue, 
					date, 
					time, 
					info, 
					text, 
					facebook, 
					multiday_string, 
					event_type
				FROM events
				WHERE url_path = ?";
		$Db->query($sql);
		$Db->bind(1, $urlPathFull);
		return $Db->resultSet();
	}

	protected function setUserEvent(string $event, string $date, string $club, string $facebook, string $image): void {
		$Db = new Database;		
		$time = time();
		$sql = "INSERT INTO
					user_events(
						event, 
						date, 
						club, 
						facebook, 
						image, 
						created
					)
				VALUES (?,?,?,?,?,?)					
		";
		$Db->query($sql);
		$Db->bind(1, $event);
		$Db->bind(2, $date);
		$Db->bind(3, $club);
		$Db->bind(4, $facebook);
		$Db->bind(5, $image);
		$Db->bind(6, $time);
		$Db->execute();

		$emailContent = "Návštěvník marastu přidal novou akci: " . $event;

		if ($_SESSION['role'] !== 1) {		
			mail('bizzaro@test.com', 'CHECKNI MARAST', $emailContent);
		}
	}
}