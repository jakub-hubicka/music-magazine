<?php

namespace App\Models;
use App\Core\Database;

class OthersModel {

	protected function getList(): array {
		$Db = new Database;
		$sql = "SELECT 
					id, 
					comments_count, 
					author_name, 
					url_path, 
					publish_date, 
					title, 
					image_reference, 
					category,
					is_redesign_version
				FROM articles
				WHERE NOT category = 'Alba měsíce'
				ORDER BY publish_date DESC
				LIMIT 4";
		$Db->query($sql);
		return $Db->resultSet();
	}
}