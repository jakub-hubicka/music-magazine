<?php

namespace App\Models;
use App\Core\Database;

class ReviewsModel {
	
	public function getList(): array {
		$Db = new Database;
		$sql = "SELECT 
					id, 
					comments_count, 
					author_name, 
					url_path, 
					publish_date, 
					band, 
					album, 
					image_reference, 
					type,
					title,
					is_redesign_version
					FROM reviews ORDER BY publish_date DESC LIMIT 4";
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
					band, 
					album, 
					image_reference, 
					url_path,
					title,
					is_redesign_version
					FROM reviews
					ORDER BY publish_date DESC
					LIMIT $boxCount, 9";
		$Db->query($sql);
		return $Db->resultSet();
	}

	public function getDetail(string $urlpath): array {
		$urlpathFull = "recenze/" . $urlpath;
		$Db = new Database;
		$sql = "SELECT 
					rating, 
					body, 
					tags, 
					related_content, 
					band, 
					album, 
					contentobject_id, 
					title, 
					image, 
					author_name, 
					intro, 
					publish_date, 
					type, 
					url_path, 
					is_redesign_version, 
					slider
				FROM reviews
				WHERE url_path = ?";
		$Db->query($sql);
		$Db->bind(1, $urlpathFull);
		return $Db->resultSet();
	}

	public function checkAdditionalReview(string $urlpath): array {
		$urlpathFull = "recenze/" . $urlpath;
		$Db = new Database;
		$sql = "SELECT
					author,
					content,
					rating
				FROM additional_reviews
				WHERE url_path = ?";
		$Db->query($sql);
		$Db->bind(1, $urlpathFull);
		return $Db->resultSet();
	}
}