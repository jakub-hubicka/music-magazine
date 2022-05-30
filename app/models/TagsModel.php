<?php

namespace App\Models;
use App\Core\Database;

class TagsModel {

	public function getList(int $boxCount, string $tag): array {
		$Db = new Database;
		$tag = "%" . $tag . "%";
		$sql = "SELECT id, url_path, author_name, type, publish_date, title, image_reference FROM articles WHERE tags LIKE ?
				UNION ALL
				SELECT id, url_path, author_name, type, publish_date, title, image_reference FROM interviews WHERE tags LIKE ?
				UNION ALL
				SELECT id, url_path, author_name, type, publish_date, title, image_reference FROM reports WHERE tags LIKE ?
				UNION ALL
				SELECT id, url_path, author_name, type, publish_date, title, image_reference FROM gallery WHERE tags LIKE ?
				UNION ALL
				SELECT id, url_path, author_name, type, publish_date, title, image_reference FROM reviews WHERE tags LIKE ?
				UNION ALL
				SELECT id, url_path, author_name, type, publish_date, title, image_reference FROM news WHERE tags LIKE ?
				ORDER BY publish_date DESC LIMIT $boxCount, 9";
		$Db->query($sql);
		$Db->bind(1, $tag);
		$Db->bind(2, $tag);
		$Db->bind(3, $tag);
		$Db->bind(4, $tag);
		$Db->bind(5, $tag);
		$Db->bind(6, $tag);
		return $Db->resultSet();
	}
}
