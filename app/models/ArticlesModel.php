<?php

namespace App\Models;
use App\Core\Database;

class ArticlesModel {

	public function getDetail(string $urlpath): array {
		$urlpathFull = "clanky/" . $urlpath;
		$Db = new Database;
		$sql = "SELECT * FROM (
					SELECT id, tags, related_content, comments_count, url_path, body, intro, contentobject_id, author_name, publish_date, title, type, image, slider FROM articles
					UNION
					SELECT id, tags, related_content, comments_count, url_path, body, intro, contentobject_id, author_name, publish_date, title, type, image, slider FROM interviews
					UNION
					SELECT id, tags, related_content, comments_count, url_path, body, intro, contentobject_id, author_name, publish_date, title, type, image, slider FROM reports
				) AS a WHERE a.url_path = ?
			";			
		$Db->query($sql);
		$Db->bind(1, $urlpathFull);
		return $Db->resultSet();
	}

	public function getCategory(string $urlpath): array {
		$urlpathFull = "clanky/" . $urlpath;
		$Db = new Database;
		$sql = "SELECT category FROM articles WHERE url_path = ?";			
		$Db->query($sql);
		$Db->bind(1, $urlpathFull);
		return $Db->resultSet();
	}

	public function getList(string $boxCount): array {
		$Db = new Database;
		$sql = "SELECT id, author_name, comments_count, publish_date, title, category, image_reference, url_path, is_redesign_version FROM articles
				UNION
				SELECT id, author_name, comments_count, publish_date, title, type, image_reference, url_path, is_redesign_version FROM interviews
				UNION
				SELECT id, author_name, comments_count, publish_date, title, type, image_reference, url_path, is_redesign_version FROM reports
				WHERE publish_date < NOW() ORDER BY publish_date DESC LIMIT $boxCount, 9";
		$Db->query($sql);
		return $Db->resultSet();
	}

	public function getOthersList(string $boxCount): array {
		$Db = new Database;
		$sql = "SELECT id, 
					author_name, 
					comments_count, 
					publish_date, 
					title, 
					category, 
					image_reference, 
					url_path
				FROM articles
				WHERE NOT category = 'Alba měsíce'
				ORDER BY publish_date DESC
				LIMIT $boxCount, 9";
		$Db->query($sql);
		return $Db->resultSet();
	}

	public function getAllList(): array {
		$Db = new Database;
		$sql = "SELECT id, comments_count, author_name, url_path, publish_date, title, img_main, image_reference, is_redesign_version, type FROM reports
				UNION All
				SELECT id, comments_count, author_name, url_path, publish_date, title, img_main, image_reference, is_redesign_version, type FROM reviews
				UNION All
				SELECT id, comments_count, author_name, url_path, publish_date, title, img_main, image_reference, is_redesign_version, type FROM interviews
				UNION All
				SELECT id, comments_count, author_name, url_path, publish_date, title, img_main, image_reference, is_redesign_version, type FROM articles
				WHERE publish_date < NOW() ORDER BY publish_date DESC LIMIT 4";
		$Db->query($sql);
		return $Db->resultSet();
	}
}