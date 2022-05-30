<?php

namespace App\Models;
use App\Core\Database;

/*
class MostRelevantModel {

	protected function getList($tags, $fullPath) {
		$Db = new Database;

		$tagsArray = explode(",", $tags);

		$firstTag = "%" . $tagsArray[0] ."%";
		$secondTag = "%" . $tagsArray[1] ."%";
		$thirdTag = "%" . $tagsArray[2] ."%";		

		$resultComplet = [];

		$q = "
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM articles WHERE tags LIKE ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM interviews WHERE tags LIKE ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM news WHERE tags LIKE ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM reports WHERE tags LIKE ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM reviews WHERE tags LIKE ? AND url_path != ?
			ORDER BY publish_date DESC LIMIT 3
		";

		$Db->query($q);	
		$Db->bind(1, $firstTag);
		$Db->bind(2, $fullPath);

		$Db->bind(3, $firstTag);
		$Db->bind(4, $fullPath);

		$Db->bind(5, $firstTag);
		$Db->bind(6, $fullPath);

		$Db->bind(7, $firstTag);
		$Db->bind(8, $fullPath);

		$Db->bind(9, $firstTag);
		$Db->bind(10, $fullPath);

		$result = $Db->resultSet();
		
		$resultComplet[] = $result;

		$firstResultUrl = $result[0]['url_path'];

		$q = "
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM articles WHERE tags LIKE ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM interviews WHERE tags LIKE ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM news WHERE tags LIKE ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM reports WHERE tags LIKE ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM reviews WHERE tags LIKE ? AND url_path != ? AND url_path != ?
			ORDER BY publish_date DESC LIMIT 1
		";

		$Db->query($q);	
		$Db->bind(1, $secondTag);
		$Db->bind(2, $fullPath);
		$Db->bind(3, $firstResultUrl);

		$Db->bind(4, $secondTag);
		$Db->bind(5, $fullPath);
		$Db->bind(6, $firstResultUrl);

		$Db->bind(7, $secondTag);
		$Db->bind(8, $fullPath);
		$Db->bind(9, $firstResultUrl);

		$Db->bind(10, $secondTag);
		$Db->bind(11, $fullPath);
		$Db->bind(12, $firstResultUrl);

		$Db->bind(13, $secondTag);
		$Db->bind(14, $fullPath);
		$Db->bind(15, $firstResultUrl);

		$result = $Db->resultSet();
		$resultComplet[] = $result;
		$secondResultUrl = $result[0]['url_path'];	

		$q = "
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM articles WHERE tags LIKE ? AND url_path != ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM interviews WHERE tags LIKE ? AND url_path != ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM news WHERE tags LIKE ? AND url_path != ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM reports WHERE tags LIKE ? AND url_path != ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM reviews WHERE tags LIKE ? AND url_path != ? AND url_path != ? AND url_path != ?
			ORDER BY publish_date DESC LIMIT 1
		";

		$Db->query($q);	
		$Db->bind(1, $thirdTag);
		$Db->bind(2, $fullPath);
		$Db->bind(3, $firstResultUrl);
		$Db->bind(4, $secondResultUrl);
		
		$Db->bind(5, $thirdTag);
		$Db->bind(6, $fullPath);
		$Db->bind(7, $firstResultUrl);
		$Db->bind(8, $secondResultUrl);

		$Db->bind(9, $thirdTag);
		$Db->bind(10, $fullPath);
		$Db->bind(11, $firstResultUrl);
		$Db->bind(12, $secondResultUrl);

		$Db->bind(13, $thirdTag);
		$Db->bind(14, $fullPath);
		$Db->bind(15, $firstResultUrl);
		$Db->bind(16, $secondResultUrl);

		$Db->bind(17, $thirdTag);
		$Db->bind(18, $fullPath);
		$Db->bind(19, $firstResultUrl);
		$Db->bind(20, $secondResultUrl);

		$resultComplet[] = $Db->resultSet();

		return $resultComplet;
	}
}
*/

/*
class MostRelevantModel {

	protected function getList($tags, $fullPath) {
		$Db = new Database;

		$tagsArray = explode(",", $tags);

		$tagsArray = ["metallica"];

		$resultComplet = [];

		foreach ($tagsArray as $tag) {
			$tag = "%" . $tag . "%";
			$q = "
				SELECT comments_count, author_name, url_path, publish_date, title, image, type 
				FROM articles WHERE tags LIKE ? AND url_path != ?
				UNION
				SELECT comments_count, author_name, url_path, publish_date, title, image, type 
				FROM interviews WHERE tags LIKE ? AND url_path != ?
				UNION
				SELECT comments_count, author_name, url_path, publish_date, title, image, type 
				FROM news WHERE tags LIKE ? AND url_path != ?
				UNION
				SELECT comments_count, author_name, url_path, publish_date, title, image, type 
				FROM reports WHERE tags LIKE ? AND url_path != ?
				UNION
				SELECT comments_count, author_name, url_path, publish_date, title, image, type 
				FROM reviews WHERE tags LIKE ? AND url_path != ?
				ORDER BY publish_date DESC LIMIT 3
			";
			$Db->query($q);
			$Db->bind(1, $tag);
			$Db->bind(2, $fullPath);

			$Db->bind(3, $tag);
			$Db->bind(4, $fullPath);

			$Db->bind(5, $tag);
			$Db->bind(6, $fullPath);

			$Db->bind(7, $tag);
			$Db->bind(8, $fullPath);

			$Db->bind(9, $tag);
			$Db->bind(10, $fullPath);

			$resultComplet[] = $Db->resultSet();

			if (count($Db->resultSet()) == 3) {
				$resultComplet[] = $Db->resultSet();
				return $resultComplet;
			} else {

			}
		}

		$result = $Db->resultSet();
		
		$resultComplet[] = $result;

		$firstResultUrl = $result[0]['url_path'];

		$q = "
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM articles WHERE tags LIKE ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM interviews WHERE tags LIKE ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM news WHERE tags LIKE ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM reports WHERE tags LIKE ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM reviews WHERE tags LIKE ? AND url_path != ? AND url_path != ?
			ORDER BY publish_date DESC LIMIT 1
		";

		$Db->query($q);	
		$Db->bind(1, $secondTag);
		$Db->bind(2, $fullPath);
		$Db->bind(3, $firstResultUrl);

		$Db->bind(4, $secondTag);
		$Db->bind(5, $fullPath);
		$Db->bind(6, $firstResultUrl);

		$Db->bind(7, $secondTag);
		$Db->bind(8, $fullPath);
		$Db->bind(9, $firstResultUrl);

		$Db->bind(10, $secondTag);
		$Db->bind(11, $fullPath);
		$Db->bind(12, $firstResultUrl);

		$Db->bind(13, $secondTag);
		$Db->bind(14, $fullPath);
		$Db->bind(15, $firstResultUrl);

		$result = $Db->resultSet();
		$resultComplet[] = $result;
		$secondResultUrl = $result[0]['url_path'];	

		$q = "
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM articles WHERE tags LIKE ? AND url_path != ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM interviews WHERE tags LIKE ? AND url_path != ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM news WHERE tags LIKE ? AND url_path != ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM reports WHERE tags LIKE ? AND url_path != ? AND url_path != ? AND url_path != ?
			UNION
			SELECT comments_count, author_name, url_path, publish_date, title, image, type 
			FROM reviews WHERE tags LIKE ? AND url_path != ? AND url_path != ? AND url_path != ?
			ORDER BY publish_date DESC LIMIT 1
		";

		$Db->query($q);	
		$Db->bind(1, $thirdTag);
		$Db->bind(2, $fullPath);
		$Db->bind(3, $firstResultUrl);
		$Db->bind(4, $secondResultUrl);
		
		$Db->bind(5, $thirdTag);
		$Db->bind(6, $fullPath);
		$Db->bind(7, $firstResultUrl);
		$Db->bind(8, $secondResultUrl);

		$Db->bind(9, $thirdTag);
		$Db->bind(10, $fullPath);
		$Db->bind(11, $firstResultUrl);
		$Db->bind(12, $secondResultUrl);

		$Db->bind(13, $thirdTag);
		$Db->bind(14, $fullPath);
		$Db->bind(15, $firstResultUrl);
		$Db->bind(16, $secondResultUrl);

		$Db->bind(17, $thirdTag);
		$Db->bind(18, $fullPath);
		$Db->bind(19, $firstResultUrl);
		$Db->bind(20, $secondResultUrl);

		$resultComplet[] = $Db->resultSet();

		return $resultComplet;
	}
}
*/