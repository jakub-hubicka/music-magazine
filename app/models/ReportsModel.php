<?php

namespace App\Models;
use App\Core\Database;

class ReportsModel {

	public function getList(): array {
		$Db = new Database;
		$sql = "SELECT 
					id, 
					comments_count, 
					author_name, 
					url_path,
					publish_date, 
					title, 
					image_reference, 
					type,
					is_redesign_version
				FROM reports
				ORDER BY publish_date DESC
				LIMIT 4";
		$Db->query($sql);
		return $Db->resultSet();
	}

	public function getReportData(int $id): array {
		$Db = new Database;
		$sql = "SELECT event_date, venue FROM reports WHERE id = ? LIMIT 1";
		$Db->query($sql);
		$Db->bind(1, $id);
		return $Db->resultSet();
	}

	/*
	protected function getReportsDetailList($id) {
		$Db = new Database;
		$sql = "SELECT id, intro, body, contentobject_id, author_name, publish_date, title, image FROM reports WHERE id = ?";
		$Db->query($sql);
		$Db->bind(1, $id);
		$res = $Db->resultSet();
		return $res;
	}
	*/

	public function getFullList(int $boxCount): array {
		$Db = new Database;
		$sql = "SELECT 
					id, 
					author_name, 
					comments_count, 
					type, 
					publish_date, 
					title, 
					image_reference, 
					url_path,					
					title,
					is_redesign_version
				FROM reports
				ORDER BY publish_date DESC
				LIMIT $boxCount, 9";
		$Db->query($sql);
		return $Db->resultSet();
	}
}