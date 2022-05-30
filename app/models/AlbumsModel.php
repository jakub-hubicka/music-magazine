<?php

namespace App\Models;
use App\Core\Database;

class AlbumsModel {

	public function getAlbumsList(): array {
		$Db = new Database;
		$sql = "SELECT
					id,
					url_path,
					comments_count,
					author_name,
					publish_date,
					title,
					image_reference,
					img_main,
					is_redesign_version,
					category
				FROM articles
				WHERE category = 'Alba měsíce'
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
					title, 
					category, 
					type, 
					publish_date, 
					image_reference, 
					url_path,					
					title,
					is_redesign_version
				FROM articles
				WHERE category = 'Alba měsíce'
				ORDER BY publish_date DESC
				LIMIT $boxCount, 9";
		$Db->query($sql);
		return $Db->resultSet();
	}
}