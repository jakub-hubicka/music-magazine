<?php

namespace App\Models;
use App\Core\Database;

class GalleryModel {

	public function getGalleryList(int $boxCount, int $limit): array {
		$boxCount = (int)$boxCount;
		$Db = new Database;
		$sql = "SELECT 
					id, 
					author_name, 
					comments_count, 
					publish_date, 
					title, 
					image_reference, 
					url_path 
				FROM gallery 
				ORDER BY publish_date DESC
				LIMIT ?, ?";
		$Db->query($sql);
		$Db->bind(1, $boxCount);
		$Db->bind(2, $limit);
		return $Db->resultSet();
	}

	public function getGalleryData(string $galleryName): array {
		$Db = new Database;
		$sql = "SELECT 
					title, 
					contentobject_id, 
					related_content, 
					author_name, 
					event_date, 
					venue 
				FROM gallery
				WHERE url_path LIKE ?
				LIMIT 1";
		$Db->query($sql);
		$Db->bind(1, $galleryName);
		return $Db->resultSet();
	}

	public function getImages(string $galleryName): array {
		$Db = new Database;
		$sql = "SELECT image_reference, name FROM images WHERE url_path LIKE ?";
		$Db->query($sql);
		$Db->bind(1, "%$galleryName%");
		return $Db->resultSet();
	}

	public function getNumberOfPhotos(string $url_path): array {
		$Db = new Database;
		$sql = "SELECT url_path FROM images WHERE url_path LIKE ?";
		$Db->query($sql);
		$Db->bind(1, "%$url_path%");
		return $Db->resultSet();
	}
}