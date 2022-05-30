<?php

namespace App\Models;
use App\Core\Database;

class SearchResultModel {

	public function getList(string $searchString, string $searchType): array {
		$Db = new Database;

		switch ($searchType) {
			case 'search_news':
				$querySearchString = "%" . $searchString . "%";
				$sql = "SELECT url_path, author_name, type, publish_date, title, image_reference
						FROM news
						WHERE title
						LIKE ?";
				$Db->query($sql);
				$Db->bind(1, $querySearchString);
				break;

			case 'search_interviews':
				$querySearchString = "%" . $searchString . "%";
				$sql = "SELECT url_path, author_name, type, publish_date, title, image_reference
						FROM interviews
						WHERE title
						LIKE ?";
				$Db->query($sql);
				$Db->bind(1, $querySearchString);
				break;

			case 'search_reviews':
				$querySearchString = "%" . $searchString . "%";
				$sql = "SELECT url_path, author_name, type, publish_date, title, image_reference
						FROM reviews
						WHERE title
						LIKE ?";
				$Db->query($sql);
				$Db->bind(1, $querySearchString);
				break;

			case 'search_reports':
				$querySearchString = "%" . $searchString . "%";
				$sql = "SELECT url_path, author_name, type, publish_date, title, image_reference
						FROM reports
						WHERE title
						LIKE ?";
				$Db->query($sql);
				$Db->bind(1, $querySearchString);
				break;

			case 'search_gallery':
				$querySearchString = "%" . $searchString . "%";
				$sql = "SELECT url_path, author_name, type, publish_date, title, image_reference
						FROM gallery
						WHERE title
						LIKE ?";
				$Db->query($sql);
				$Db->bind(1, $querySearchString);
				break;

			case 'search_albums':
				$querySearchString = "%" . $searchString . "%";
				$sql = "SELECT url_path, author_name, type, publish_date, title, image_reference FROM articles WHERE category = 'Alba měsíce' AND title LIKE ?";
				$Db->query($sql);
				$Db->bind(1, $querySearchString);
				break;

			case 'search_others':
				$querySearchString = "%" . $searchString . "%";
				$sql = "SELECT url_path, author_name, type, publish_date, title, image_reference FROM articles WHERE NOT category = 'Alba měsíce' AND title LIKE ?";
				$Db->query($sql);
				$Db->bind(1, $querySearchString);
				break;
			
			case 'search_all':
				$querySearchString = "%" . $searchString . "%";				
				$sql = "SELECT url_path, author_name, type, publish_date, title, image_reference FROM articles WHERE title LIKE ?
						UNION ALL
						SELECT url_path, author_name, type, publish_date, title, image_reference FROM interviews WHERE title LIKE ?
						UNION ALL
						SELECT url_path, author_name, type, publish_date, title, image_reference FROM reports WHERE title LIKE ?
						UNION ALL
						SELECT url_path, author_name, type, publish_date, title, image FROM gallery WHERE title LIKE ?
						UNION ALL
						SELECT url_path, author_name, type, publish_date, title, image_reference FROM news WHERE title LIKE ?
						ORDER BY publish_date DESC";
				$Db->query($sql);
				$Db->bind(1, $querySearchString);
				$Db->bind(2, $querySearchString);
				$Db->bind(3, $querySearchString);
				$Db->bind(4, $querySearchString);
				$Db->bind(5, $querySearchString);
				break;
		}		
		return $Db->resultSet();
	}
}