<?php

namespace App\Models;
use App\Core\Database;

class ReviewDetailModel {

	protected function getList(int $id): array {
		$Db = new Database;
		$sql = "SELECT 
					body, 
					band, 
					album, 
					image, 
					author_name, 
					intro, 
					publish_date, 
					slider
				FROM reviews
				WHERE id = ?";
		$Db->query($sql);
		$Db->bind(1, $id);
		return $Db->resultSet();
	}
}