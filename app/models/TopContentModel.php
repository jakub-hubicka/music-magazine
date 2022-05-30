<?php

namespace App\Models;
use App\Core\Database;

class TopContentModel {

	public function getList(): array {
		$Db = new Database;
		$sql = "SELECT id, views, comments_count, url_path, author_name, type, publish_date, title, image_reference FROM articles
				UNION ALL
				SELECT id, views, comments_count, url_path, author_name, type, publish_date, title, image_reference FROM interviews
				UNION ALL
				SELECT id, views, comments_count, url_path, author_name, type, publish_date, title, image_reference FROM reports
				UNION ALL
				SELECT id, views, comments_count, url_path, author_name, type, publish_date, title, image_reference FROM reviews
				UNION ALL
				SELECT id, views, comments_count, url_path, author_name, type, publish_date, title, image_reference FROM news
				ORDER BY views DESC LIMIT 4";
		$Db->query($sql);
		return $Db->resultSet();
	}
}
