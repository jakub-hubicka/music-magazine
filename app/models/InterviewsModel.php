<?php

namespace App\Models;
use App\Core\Database;

class InterviewsModel {

	public function getInterviewsList(): array {
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
				FROM interviews 
				WHERE publish_date < NOW() 
				ORDER BY publish_date DESC 
				LIMIT 4";
		$Db->query($sql);
		return $Db->resultSet();
	}

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
				FROM interviews 
				WHERE publish_date < NOW() 
				ORDER BY publish_date DESC 
				LIMIT $boxCount, 9";
		$Db->query($sql);
		return $Db->resultSet();
	}
}