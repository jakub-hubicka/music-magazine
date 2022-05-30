<?php

namespace App\Models;
use App\Core\Database;

class RelatedModel {
	public function getRelated(string $relatedContentString): bool|array {
		
		if ($relatedContentString == NULL) {
			return false;
		}

		$Db = new Database;
		$relatedContentArray = explode(",", $relatedContentString);

		$result = [];

		foreach ($relatedContentArray as $relatedGroup) {
			$relatedGroupArray = explode(":", $relatedGroup);
			$type = $relatedGroupArray[0];
			$id = $relatedGroupArray[1];

			switch ($type) {
				case 'report':
					$sql = "SELECT author_name, url_path, publish_date, title, image, type FROM reports WHERE id = ? LIMIT 1";
					$Db->query($sql);
					$Db->bind(1, $id);
					$result[] = $Db->resultSet()[0];
				break;

				case 'recenze':
					$sql = "SELECT author_name, url_path, publish_date, title, image, type FROM reviews WHERE id = ? LIMIT 1";
					$Db->query($sql);
					$Db->bind(1, $id);
					$Db->execute();
					$result[] = $Db->resultSet()[0];
				break;

				case 'novinka':
					$sql = "SELECT author_name, url_path, publish_date, title, image, type FROM news WHERE id = ? LIMIT 1";
					$Db->query($sql);
					$Db->bind(1, $id);
					$Db->execute();
					$result[] = $Db->resultSet()[0];
				break;

				case 'interview':
					$sql = "SELECT author_name, url_path, publish_date, title, image, type FROM interviews WHERE id = ? LIMIT 1";
					$Db->query($sql);
					$Db->bind(1, $id);
					$Db->execute();
					$result[] = $Db->resultSet()[0];
				break;

				case 'article':
					$sql = "SELECT author_name, url_path, publish_date, title, image, type FROM articles WHERE id = ? LIMIT 1";
					$Db->query($sql);
					$Db->bind(1, $id);
					$Db->execute();
					$result[] = $Db->resultSet()[0];
				break;
			}
		}

		return $result;
	}
}