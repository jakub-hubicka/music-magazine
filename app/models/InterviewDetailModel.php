<?php

namespace App\Models;
use App\Core\Database;

class InterviewDetailModel {

	public function getList(int $id): array {
		$Db = new Database;
		$sql = "SELECT 
					body, 
					contentobject_id, 
					title, 
					image, 
					author_name, 
					intro, 
					publish_date, 
					slider
				FROM interviews 
				WHERE id = ?";
		$Db->query($sql);
		$Db->bind(1, $id);
		return $Db->resultSet();
	}
}