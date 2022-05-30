<?php

namespace App\Models;
use App\Core\Database;

class BannerModel {

	public function getList(): array {
		$Db = new Database;
		$sql = "SELECT
					comments_count, 
					author_name, 
					url_path, 
					publish_date, 
					title, 
					image, 
					type
				FROM banner
				ORDER BY id LIMIT 3";
		$Db->query($sql);
		return $Db->resultSet();
	}

	public function getCommentsCount(string $url_path, string $type) {
		$Db = new Database;
		switch ($type) {
			case 'report':
				$sql = "SELECT comments_count FROM reports WHERE url_path = ? LIMIT 1";
				$Db->query($sql);
				$Db->bind(1, $url_path);
				return $Db->resultSet()[0]['comments_count'];
			break;

			case 'recenze':
				$sql = "SELECT comments_count FROM reviews WHERE url_path = ? LIMIT 1";
				$Db->query($sql);
				$Db->bind(1, $url_path);
				$Db->execute();
				return $Db->resultSet()[0]['comments_count'];
			break;

			case 'novinka':
				$sql = "SELECT comments_count FROM news WHERE url_path = ? LIMIT 1";
				$Db->query($sql);
				$Db->bind(1, $url_path);
				$Db->execute();
				return $Db->resultSet()[0]['comments_count'];
			break;

			case 'interview':
				$sql = "SELECT comments_count FROM interviews WHERE url_path = ? LIMIT 1";
				$Db->query($sql);
				$Db->bind(1, $url_path);
				$Db->execute();
				return $Db->resultSet()[0]['comments_count'];
			break;

			case 'article':
				$sql = "SELECT comments_count FROM articles WHERE url_path = ? LIMIT 1";
				$Db->query($sql);
				$Db->bind(1, $url_path);
				$Db->execute();
				return $Db->resultSet()[0]['comments_count'];
			break;			
		}
	}
}