<?php

namespace App\Models;
use App\Core\Database;

class CommentsModel {

	public function getFullList(): array {
		$Db = new Database;
		$sql = "
			SELECT * FROM (
				SELECT
					id,
					name,
					detail_title,
					url_path,
					created,
					ROW_NUMBER() OVER(PARTITION BY url_path) rownumber
				FROM comments				
			) AS a WHERE a.rownumber = 1 ORDER BY created DESC LIMIT 6
		";
		$Db->query($sql);
		return $Db->resultSet();
	}

	public function getList(string $type): array {
		$Db = new Database;
		$sql = "SELECT * FROM (
					SELECT
						id,
						name,
						detail_title,
						url_path,
						created,
						ROW_NUMBER() OVER(PARTITION BY url_path) rownumber
					FROM comments WHERE type = ?
				) AS a WHERE a.rownumber = 1 ORDER BY created DESC LIMIT 6";
		$Db->query($sql);
		$Db->bind(1, $type);
		return $Db->resultSet();
	}

	public function getDetailList(int $contentObjectId): array {
		$Db = new Database;
		$sql = "SELECT 
					id, 
					name, 
					created, 
					text, 
					is_old 
				FROM comments
				WHERE contentobject_id = ?
				ORDER BY created DESC";		
		$Db->query($sql);
		$Db->bind(1, $contentObjectId);
		return $Db->resultSet();
	}

	public function saveComment(string $name, string $text, $id, string $urlPath, string $detailTitle, string $type): void {
		$Db = new Database;
		$timeStamp = time();
		$sql = "INSERT INTO
					comments(
						name,
						text,
						contentobject_id,
						url_path,
						type,
						detail_title,
						created
					)
				VALUES
					(?, ?, ?, ?, ?, ?, ?)";
		$Db->query($sql);
		$Db->bind(1, $name);
		$Db->bind(2, $text);
		$Db->bind(3, $id);
		$Db->bind(4, $urlPath);
		$Db->bind(5, $type);
		$Db->bind(6, $detailTitle);
		$Db->bind(7, $timeStamp);
		$Db->execute();
	}

	protected function saveIncreasedCommentCount(string $urlPath, string $type): void {
		$Db = new Database;
		if ($type == "recenze") {
			$sql = "UPDATE reviews SET comments_count = comments_count + 1 WHERE url_path = ?";
			$Db->query($sql);
			$Db->bind(1, $urlPath);
			$Db->execute();
		} else if ($type == "report") {
			$sql = "UPDATE reports SET comments_count = comments_count + 1 WHERE url_path = ?";
			$Db->query($sql);
			$Db->bind(1, $urlPath);
			$Db->execute();
		} else if ($type == "interview") {
			$sql = "UPDATE interviews SET comments_count = comments_count + 1 WHERE url_path = ?";
			$Db->query($sql);
			$Db->bind(1, $urlPath);
			$Db->execute();
		} else if ($type == "novinka") {
			$sql = "UPDATE news SET comments_count = comments_count + 1 WHERE url_path = ?";
			$Db->query($sql);
			$Db->bind(1, $urlPath);
			$Db->execute();
		} else if ($type == "Alba měsíce" || $type == "Ostatní") {
			$sql = "UPDATE articles SET comments_count = comments_count + 1 WHERE url_path = ?";
			$Db->query($sql);
			$Db->bind(1, $urlPath);
			$Db->execute();
		}
	}

	/*
		protected function getContentInfo($targetId, $type) {		
			$Db = new Database;
			if ($type == "albums") {
				$sql = "SELECT title, url_path FROM articles WHERE contentobject_id = ? AND category = 'Alba měsíce'";
				$Db->query($sql);
				$Db->bind(1, $targetId);
				$res[0] = ['title' => 'xxx', 'url_path' => 'yyy'];
				return $res;

			} else if ($type == "reviews") {
				$sql = "SELECT title, url_path FROM reviews WHERE id = ?";
				$Db->query($sql);
				$Db->bind(1, $targetId);
			} else if ($type == "news") {
				$sql = "SELECT title, url_path FROM news WHERE id = ?";
				$Db->query($sql);
				$Db->bind(1, $targetId);
			} else if ($type == "reports") {
				$sql = "SELECT title, url_path FROM reports WHERE id = ?";
				$Db->query($sql);
				$Db->bind(1, $targetId);
			} else if ($type == "interviews") {
				$sql = "SELECT title, url_path FROM interviews WHERE id = ?";
				$Db->query($sql);
				$Db->bind(1, $targetId);
			} else {			
				/*$sql = "SELECT title, url_path FROM articles WHERE contentobject_id = ? AND category = 'Alba měsíce'";
				$Db->query($sql);
				$Db->bind(1, $targetId);

				$res[0] = ['title' => 'xxx', 'url_path' => 'yyy'];
				return $res;
			}

			$res = $Db->resultSet();
			return $res;
		}
	*/
		
}