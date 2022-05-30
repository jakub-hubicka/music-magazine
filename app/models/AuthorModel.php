<?php

namespace App\Models;
use App\Core\Database;

class AuthorModel {

	protected function getList(int $boxCount, string $author): array {
		$Db = new Database;
		$author = "%" . $author . "%";
		$sql = "SELECT id, url_path, author_name, type, publish_date, title, image_reference FROM articles WHERE author_name LIKE ?
				UNION ALL
				SELECT id, url_path, author_name, type, publish_date, title, image_reference FROM interviews WHERE author_name LIKE ?
				UNION ALL
				SELECT id, url_path, author_name, type, publish_date, title, image_reference FROM reports WHERE author_name LIKE ?
				UNION ALL
				SELECT id, url_path, author_name, type, publish_date, title, image_reference FROM gallery WHERE author_name LIKE ?
				UNION ALL
				SELECT id, url_path, author_name, type, publish_date, title, image_reference FROM news WHERE author_name LIKE ?
				ORDER BY publish_date DESC LIMIT $boxCount, 9";
		$Db->query($sql);
		$Db->bind(1, $author);
		$Db->bind(2, $author);
		$Db->bind(3, $author);
		$Db->bind(4, $author);
		$Db->bind(5, $author);
		return $Db->resultSet();
	}
}
