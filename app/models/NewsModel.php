<?php

namespace App\Models;
use App\Core\Database;

class NewsModel {

	public function getNewsList(int $limit): array {
		$Db = new Database;
		$sql = "SELECT id, comments_count, url_path, author_name, publish_date, title, img_main, type FROM news WHERE publish_date < NOW() ORDER BY publish_date DESC LIMIT ?";
		$Db->query($sql);
		$Db->bind(1, $limit);
		return $Db->resultSet();
	}

	public function getDetail(string $urlpath): array {
		$urlpathFull = "novinky/" . $urlpath;
		$Db = new Database;
		$sql = "SELECT body, tags, related_content, type, author_name, contentobject_id, title, image, publish_date, url_path, optional_tag, slider FROM news WHERE url_path = ?";
		$Db->query($sql);
		$Db->bind(1, $urlpathFull);
		return $Db->resultSet();
	}

	public function getList(int $boxCount): array {
		$Db = new Database;
		$boxCount = (int)$boxCount;
		$sql = "SELECT id, author_name, comments_count, publish_date, title, image_reference, type, url_path, is_redesign_version FROM news WHERE publish_date < NOW() ORDER BY publish_date DESC LIMIT ?, 9";
		$Db->query($sql);
		$Db->bind(1, $boxCount);
		return $Db->resultSet();
	}
}