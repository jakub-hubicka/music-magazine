<?php

namespace App\Models;
use App\Core\Database;

class CmsModel {

	protected function getRelatedContent(string $tags): string {
		$Db = new Database;
		$tagsArray = explode(",", $tags);

		$relatedArray = [];

		foreach ($tagsArray as $tag) {

			if (count($relatedArray) >= 3) {
				break;
			}

			$tag = "%" . $tag . "%";
			$sql = "SELECT id, type, publish_date FROM articles WHERE tags LIKE ?
					UNION ALL
					SELECT id, type, publish_date FROM interviews WHERE tags LIKE ?
					UNION ALL
					SELECT id, type, publish_date FROM reports WHERE tags LIKE ?
					UNION ALL
					SELECT id, type, publish_date FROM reviews WHERE tags LIKE ?
					UNION ALL
					SELECT id, type, publish_date FROM news WHERE tags LIKE ?
					ORDER BY publish_date DESC LIMIT 3";
			$Db->query($sql);
			$Db->bind(1, $tag);
			$Db->bind(2, $tag);
			$Db->bind(3, $tag);
			$Db->bind(4, $tag);
			$Db->bind(5, $tag);
			$res = $Db->resultSet();

			foreach ($res as $relatedResultArray) {
				if (count($relatedArray) >= 3) {
					break;
				}

				$relatedResultString = $relatedResultArray['type'] . ":" . $relatedResultArray['id'];

				if (!in_array($relatedResultString, $relatedArray)) {
					$relatedArray[] = $relatedResultString;
				}
			}
		}

		if (count($relatedArray) >= 3) {
			$relatedArrayString = implode(",", $relatedArray);

			return $relatedArrayString;
		} else {
			$q = "SELECT id FROM news ORDER BY publish_date DESC LIMIT 3";
			$Db->query($q);
			$resultSet = $Db->resultSet();
			$relatedArrayString = "novinka:" . $resultSet[0]['id'] . ",novinka:" . $resultSet[1]['id'] . ",novinka:" . $resultSet[2]['id'];

			return $relatedArrayString;
		}
	}

	protected function getItemDataForBanner(string $urlPath): array {
		$Db = new Database;
		$sql = "SELECT title, author_name, image_reference, publish_date, type, comments_count, tags FROM articles WHERE url_path = ?
				UNION ALL
				SELECT title, author_name, image_reference, publish_date, type, comments_count, tags FROM interviews WHERE url_path = ?
				UNION ALL
				SELECT title, author_name, image_reference, publish_date, type, comments_count, tags FROM reports WHERE url_path = ?
				UNION ALL
				SELECT title, author_name, image_reference, publish_date, type, comments_count, tags FROM reviews WHERE url_path = ?
				UNION ALL
				SELECT title, author_name, image_reference, publish_date, type, comments_count, tags FROM news WHERE url_path = ?
				LIMIT 1
			";
		$Db->query($sql);
		$Db->bind(1, $urlPath);
		$Db->bind(2, $urlPath);
		$Db->bind(3, $urlPath);
		$Db->bind(4, $urlPath);
		$Db->bind(5, $urlPath);
		return $Db->resultSet()[0];
	}

	protected function getLastTenLinks(): array {
		$Db = new Database;
		$sql = "SELECT url_path, publish_date, added FROM articles
				UNION ALL
				SELECT url_path, publish_date, added FROM interviews
				UNION ALL
				SELECT url_path, publish_date, added FROM reports
				UNION ALL
				SELECT url_path, publish_date, added FROM reviews
				UNION ALL
				SELECT url_path, publish_date, added FROM events
				UNION ALL
				SELECT url_path, publish_date, added FROM news
				ORDER BY added DESC LIMIT 10
			";
		$Db->query($sql);
		return $Db->resultSet();
	}

	protected function saveBannerLink(array $post): void {
		$Db = new Database;

		$link = $post['link'];
		$linkArray = explode("/", $link);
		$urlId = end($linkArray);
		array_pop($linkArray);
		$urlType = end($linkArray);
		$urlPath = $urlType . "/" . $urlId;

		$typeBanner = (int)$post['type'];

		$data = $this->getItemDataForBanner($urlPath);	

		$title = $data['title'];
		$author_name = $data['author_name'];
		$publish_date = $data['publish_date'];
		$type = $data['type'];

		if (!empty($post['image'])) {
			$image = $post['image'];
		} else {
			$image = $data['image_reference'];
		}

		switch ($type) {
			case 'interview':
				$type = "rozhovor";
				break;
			case 'article':
				$type = "článek";
				break;
		}

		$comments_count = $data['comments_count'];
		$tags = $data['tags'];

		$sql = "UPDATE
					banner
				SET
					url_path = ?,
					title = ?,
					author_name = ?,
					image = ?,
					publish_date = ?,
					type = ?,
					comments_count = ?,
					tags = ?
				WHERE
					id = ?";

		$Db->query($sql);
		$Db->bind(1, $urlPath);
		$Db->bind(2, $title);
		$Db->bind(3, $author_name);
		$Db->bind(4, $image);
		$Db->bind(5, $publish_date);
		$Db->bind(6, $type);
		$Db->bind(7, $comments_count);
		$Db->bind(8, $tags);
		$Db->bind(9, $typeBanner);
		$Db->execute();
	}

	protected function uploadSliderImages(array $sliderInput): string {
				
		$sliderFolder = __DIR__ . '/../../root/images/slider';
		$allowed = ['jpg', 'jpeg', 'png'];
		$sliderPaths = [];

		foreach ($sliderInput['name'] as $index => $name) {
			$tmp_name = $sliderInput['tmp_name'][$index];

			$image_extension_prepare = explode(".", $name);
			$image_extension = strtolower(end($image_extension_prepare));

			if (in_array($image_extension, $allowed)) {
				$imageNewName_prepare = uniqid('image', true);
				$imageNewName = str_replace('.', rand(), $imageNewName_prepare) . "." . $image_extension;
				$path = $sliderFolder . "/" . $imageNewName;

				move_uploaded_file($tmp_name, $path);

				$sliderPaths[] = $imageNewName;			
			}
		}

		$sliderString = implode(',', $sliderPaths);
		
		return $sliderString;		
	}

	protected function getEvents(): array {		
		$Db = new Database;
		$sql = "SELECT 
					event,
					date,
					club,
					facebook,
					image,
					created
				FROM user_events";
		$Db->query($sql);
		return $Db->resultSet();
	}

	protected function getCzFix(): array {
		$czfix = [
			"á" => "a",
			"č" => "c",
			"ď" => "d",
			"ě" => "e",
			"é" => "e",
			"í" => "i",
			"ň" => "n",
			"ó" => "o",
			"ř" => "r",
			"š" => "s",
			"ť" => "t",
			"ú" => "u",
			"ů" => "u",
			"ý" => "y",
			"ž" => "z"
		];
		return $czfix;
	}
	
	protected function saveGalleryData(array $post, array $files): void {
		$Db = new Database;

		// GALERIE
		$title = $post['title'];
		$venue = $post['venue'];
		$event_date = $post['eventDate'];

		$url_path = strtolower($title);
		$url_path = str_replace(" ", "_", $url_path);
		$url_path = str_replace(",", "", $url_path);
		$url_path = 'galerie/' . $url_path;

		$czfix = $this->getCzFix();

		$url_path = strtr($url_path, $czfix);
		$authorName = $_SESSION['login'];
		$publishDate = date('Y-m-d H:i:s', time());
		$type = "galerie";
		$tags = trim(htmlspecialchars($post['tags']));
		$relatedContent = $this->getRelatedContent($tags);

		$allowed = ['jpg', 'jpeg', 'png'];	

		$imageSmall_name = $files['imageSmall']['name'];
		$imageSmall_tmp_name = $files['imageSmall']['tmp_name'];

		$imageSmall_extension_prepare = explode(".", $imageSmall_name);
		$imageSmall_extension = strtolower(end($imageSmall_extension_prepare));

		if (in_array($imageSmall_extension, $allowed)) {

			$imageSmallNewName_prepare = uniqid('image', true);
			$imageSmallNewName = $type . '/' . str_replace('.', rand(), $imageSmallNewName_prepare) . "." . $imageSmall_extension;
			$path = __DIR__ . '/../../root/images/' . $imageSmallNewName;
			
			move_uploaded_file($imageSmall_tmp_name, $path);
		}

		$imageSmallNewName = "images/" . $imageSmallNewName;

		$time = substr(time(), 1, 10) . rand(10,99);
		$time = (int)$time;

		$sql = "INSERT INTO
					gallery(
						url_path, 
						title, 
						author_name, 
						venue, 
						image_reference, 
						publish_date, 
						tags, 
						type, 
						event_date, 
						is_redesign_version, 
						related_content, 
						contentobject_id)
			VALUES(?,?,?,?,?,?,?,?,?,?,?,?)					
		";
		$Db->query($sql);
		$Db->bind(1, $url_path);
		$Db->bind(2, $title);
		$Db->bind(3, $authorName);
		$Db->bind(4, $venue);
		$Db->bind(5, $imageSmallNewName);
		$Db->bind(6, $publishDate);
		$Db->bind(7, $tags);
		$Db->bind(8, $type);
		$Db->bind(9, $event_date);
		$Db->bind(10, 1);
		$Db->bind(11, $relatedContent);
		$Db->bind(12, $time);
		$Db->execute();

		// IMAGES
		$gallery = $files['galerie'];
		$newFolder = __DIR__ . '/../../root/images/' . $url_path;

		mkdir($newFolder);

		$watermarkSrc = __DIR__ . '/../../root/images/footer-logo.png';
		$watermark = imagecreatefrompng($watermarkSrc);

		$watermarkWidth = imagesx($watermark);
		$watermarkHeight = imagesy($watermark);

		foreach ($gallery['name'] as $index => $name) {

			$tmp_name = $gallery['tmp_name'][$index];
			$type = $gallery['type'][$index];
			$originalName = $name;
			$image_url_path = $url_path . "/" . $originalName . "_" . $index;

			$image_extension_prepare = explode(".", $name);
			$image_extension = strtolower(end($image_extension_prepare));

			if (in_array($image_extension, $allowed)) {

				$imageNewName_prepare = uniqid('image', true);
				$imageNewName = str_replace('.', rand(), $imageNewName_prepare) . "." . $image_extension;
				$path = $newFolder . "/" . $imageNewName;

				move_uploaded_file($tmp_name, $path);

				switch($image_extension) {
					case 'jpg':
						$createdImg = imagecreatefromjpeg($path);
						break;
					case 'jpeg':
						$createdImg = imagecreatefromjpeg($path);
						break;
					case 'png':
						$createdImg = imagecreatefrompng($path);
						break;
					default:
						$createdImg = imagecreatefromjpeg($path);
				}

				$image_size = getimagesize($path);
				$watermark_x = $image_size[0] - $watermarkWidth - 20;
				$watermark_y = $image_size[1] - $watermarkHeight - 20;

				imagecopy($createdImg, $watermark, $watermark_x, $watermark_y, 0, 0, $watermarkWidth, $watermarkHeight);
				imagepng($createdImg, $path);
				imagedestroy($createdImg);
			}

			$DBImgName = "images/" . $url_path . "/" . $imageNewName;

			$sql = "
					INSERT INTO 
					images(url_path, name, image, image_reference)
					VALUES(?,?,?,?)
				";

			$Db->query($sql);
			$Db->bind(1, $image_url_path);
			$Db->bind(2, $originalName);
			$Db->bind(3, $DBImgName);
			$Db->bind(4, $DBImgName);
			$Db->execute();
		}
	}

	protected function confirm(): array {
		$Db = new Database;
		$sql = "SELECT url_path, category, added, id, author_name FROM articles WHERE public = 0
				UNION ALL
				SELECT url_path, type, added, id, author_name FROM interviews WHERE public = 0
				UNION ALL
				SELECT url_path, type, added, id, author_name FROM reports WHERE public = 0
				UNION ALL
				SELECT url_path, type, added, id, author_name FROM reviews WHERE public = 0
				UNION ALL
				SELECT url_path, type, added, id, '(akce)' FROM events WHERE public = 0
				UNION ALL
				SELECT url_path, type, added, id, author_name FROM news WHERE public = 0
				ORDER BY added DESC
			";
		$Db->query($sql);
		return $Db->resultSet();
	}


	protected function saveData(array $post, array $files): void {
		$Db = new Database;	

		switch ($post['type']) {
			case 'novinka':
				$type = "novinky";
				$optionalTag = $post['optionalTag'];
			break;
			case 'recenze':
				$type = "recenze";
			break;
			case 'rozhovor':
				$type = "clanky";
			break;
			case 'report':
				$type = "clanky";
			break;
			case 'akce':
				$type = "akce";
			break;
			case 'alba':
				$type = "clanky";
			break;
			case 'ostatni':
				$type = "clanky";
			break;
			case 'additional_reviews':
				$type = "additional_reviews";
				$additionalReviewContent = $post['content'];
				$additionalReviewRating = $post['rating'];

				$linkArray = explode("/", $post['url']);
				$urlId = end($linkArray);
				$mainReviewUrl = 'recenze/' . $urlId;
			break;
		}

		$title = trim(htmlspecialchars($post['title']));

		if (isset($post['intro'])) {
			$intro = "<h4>" . trim(htmlspecialchars($post['intro'])) . "</h4>";
		} else {
			$intro = "";
		}
		if (isset($post['rating'])) {
			$rating = $post['rating'];
		}

		if ($type === 'akce') {
			$where = $post['where'];
			$when = $post['when'];
			$eventTime = $post['time'];
			$eventType = $post['eventType'];

			if (!empty($post['eventEnd'])) {
				$multidayString = date("d.m", strtotime($post['when'])) . " - " . date("d.m", strtotime($post['eventEnd']));
				$when = $post['eventEnd'];
			} else {
				$multidayString = "";
			}
		}

		$content = $post['content'];
		$content = str_replace("<iframe", "<iframe allow='fullscreen;'", $content);
		$content = str_replace("#slider#", "<div id='slider'></div>", $content);

		$tags = trim(htmlspecialchars($post['tags']));
		$authorName = $_SESSION['login'];

		if ($post['datum'] == "") {
			$publishDate = date('Y-m-d H:i:s', time());
		} else {
			$publishDate = $post['datum'];
		}

		$url_path = $type . "/" . strtolower(str_replace(" ", "_", $title));

		$time = substr(time(), 1, 10) . rand(10,99);
		$time = (int)$time;

		$czfix = $this->getCzFix();

		$url_path = strtr($url_path, $czfix);

		if ($files['slider']['size'][0] === 0) {
			$slider = "";
		} else {
			$sliderInput = $files['slider'];
			$slider = $this->uploadSliderImages($sliderInput);
		}

		// OLD NO CROP SOLUTION
		/*
			$allowed = ['jpg', 'jpeg', 'png'];
			$imageSmall_name = $files['imageSmall']['name'];
			$imageSmall_tmp_name = $files['imageSmall']['tmp_name'];
			$imageSmall_extension_prepare = explode(".", $imageSmall_name);
			$imageSmall_extension = strtolower(end($imageSmall_extension_prepare));

			if (in_array($imageSmall_extension, $allowed)) {
				$imageSmallNewName_prepare = uniqid('image', true);
				$imageSmallNewName = $type . '/' . str_replace('.', rand(), $imageSmallNewName_prepare) . "." . $imageSmall_extension;
				$path = __DIR__ . '/../../root/images/' . $imageSmallNewName;
				move_uploaded_file($imageSmall_tmp_name, $path);
			}

			$imageLarge_name = $files['imageLarge']['name'];
			$imageLarge_tmp_name = $files['imageLarge']['tmp_name'];
			$imageLarge_extension_prepare = explode(".", $imageLarge_name);
			$imageLarge_extension = strtolower(end($imageLarge_extension_prepare));

			if (in_array($imageLarge_extension, $allowed)) {
				$imageLargeNewName_prepare = uniqid('image', true);
				$imageLargeNewName = $type . '/' . str_replace('.', rand(), $imageLargeNewName_prepare) . "." . $imageLarge_extension;
				$path = __DIR__ . '/../../root/images/' . $imageLargeNewName;
				move_uploaded_file($imageLarge_tmp_name, $path);
			}
		*/

		if (isset($post['image-main-post'])) {
			$imageMain = $post['image-main-post'];
		} else {
			$imageMain = "";
		}
		if (isset($post['image-main-post'])) {
			$imageSearch = $post['image-search-post'];
		} else {
			$imageSearch = "";
		}
		if (isset($post['image-main-post'])) {
			$imageDetail = $post['image-detail-post'];
		} else {
			$imageDetail = "";
		}

		$relatedContent = $this->getRelatedContent($tags);

		if ($_SESSION['role'] === 1) {
			$public = 1;
		} else {
			$public = 0;
		}

		$sessionLogin = $_SESSION['login'];		
		$emailLink = "https://" . $_SERVER['HTTP_HOST'] . "/root/" . $url_path;
		
		$emailContent = "
			Editor: $sessionLogin<br>
			Link: <a href='$emailLink'>$emailLink</a>
		";

		if ($_SESSION['role'] !== 1) {		
			mail(':)', ':)', $emailContent);
		}

		switch ($post['type']) {
			case 'novinka':
				$type = 'novinka';
				// old no crop solution
				//$imageLargeNewName = "images/" . $imageLargeNewName;
				//$imageSmallNewName = "images/" . $imageSmallNewName;
				//$contentobject_id = (int)$contentobject_id;
				$sql = "
					INSERT INTO 
					news(url_path, title, author_name, body, image, publish_date, tags, type, image_reference, is_redesign_version, related_content, intro, contentobject_id, optional_tag, img_main, slider, public, added)
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP())					
				";
				$Db->query($sql);
				$Db->bind(1, $url_path);
				$Db->bind(2, $title);
				$Db->bind(3, $authorName);
				$Db->bind(4, $content);
				$Db->bind(5, $imageDetail);
				$Db->bind(6, $publishDate);
				$Db->bind(7, $tags);
				$Db->bind(8, $type);
				$Db->bind(9, $imageSearch);
				$Db->bind(10, 1);
				$Db->bind(11, $relatedContent);
				$Db->bind(12, $intro);
				$Db->bind(13, $time);
				$Db->bind(14, $optionalTag);
				$Db->bind(15, $imageMain);
				$Db->bind(16, $slider);
				$Db->bind(17, $public);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				// Redirect
				// header("Location: https://" . $host . "/root/" . $url_path);
				header("Location: https://" . $host . "/root/cms");
				die;
			break;
			case 'recenze':
				$type = 'recenze';
				//$imageLargeNewName = "images/" . $imageLargeNewName;
				//$imageSmallNewName = "images/" . $imageSmallNewName;
				$sql = "
					INSERT INTO 
					reviews(url_path, title, author_name, body, image, publish_date, tags, type, image_reference, is_redesign_version, related_content, intro, contentobject_id, img_main, slider, rating, public, added)
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP())					
				";
				$Db->query($sql);
				$Db->bind(1, $url_path);
				$Db->bind(2, $title);
				$Db->bind(3, $authorName);
				$Db->bind(4, $content);
				$Db->bind(5, $imageDetail);
				$Db->bind(6, $publishDate);
				$Db->bind(7, $tags);
				$Db->bind(8, $type);
				$Db->bind(9, $imageSearch);
				$Db->bind(10, 1);
				$Db->bind(11, $relatedContent);
				$Db->bind(12, $intro);
				$Db->bind(13, $time);
				$Db->bind(14, $imageMain);
				$Db->bind(15, $slider);
				$Db->bind(16, $rating);
				$Db->bind(17, $public);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				//header("Location: https://" . $host . "/root/" . $url_path);
				header("Location: https://" . $host . "/root/cms");
				die;
			break;
			case 'rozhovor':
				$type = 'rozhovor';
				//$imageLargeNewName = "images/" . $imageLargeNewName;
				//$imageSmallNewName = "images/" . $imageSmallNewName;
				$sql = "
					INSERT INTO 
					interviews(url_path, title, author_name, body, image, publish_date, tags, type, image_reference, is_redesign_version, related_content, intro, contentobject_id, img_main, slider, public, added)
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP())					
				";
				$Db->query($sql);
				$Db->bind(1, $url_path);
				$Db->bind(2, $title);
				$Db->bind(3, $authorName);
				$Db->bind(4, $content);
				$Db->bind(5, $imageDetail);
				$Db->bind(6, $publishDate);
				$Db->bind(7, $tags);
				$Db->bind(8, $type);
				$Db->bind(9, $imageSearch);
				$Db->bind(10, 1);
				$Db->bind(11, $relatedContent);
				$Db->bind(12, $intro);
				$Db->bind(13, $time);
				$Db->bind(14, $imageMain);
				$Db->bind(15, $slider);
				$Db->bind(16, $public);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				//header("Location: https://" . $host . "/root/" . $url_path);
				header("Location: https://" . $host . "/root/cms");
				die;
			break;
			case 'report':
				$type = 'report';
				//$imageLargeNewName = "images/" . $imageLargeNewName;
				//$imageSmallNewName = "images/" . $imageSmallNewName;
				$sql = "
					INSERT INTO 
					reports(url_path, title, author_name, body, image, publish_date, tags, type, image_reference, is_redesign_version, related_content, intro, contentobject_id, img_main, slider, public, added)
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP())					
				";
				$Db->query($sql);
				$Db->bind(1, $url_path);
				$Db->bind(2, $title);
				$Db->bind(3, $authorName);
				$Db->bind(4, $content);
				$Db->bind(5, $imageDetail);
				$Db->bind(6, $publishDate);
				$Db->bind(7, $tags);
				$Db->bind(8, $type);
				$Db->bind(9, $imageSearch);
				$Db->bind(10, 1);
				$Db->bind(11, $relatedContent);
				$Db->bind(12, $intro);
				$Db->bind(13, $time);
				$Db->bind(14, $imageMain);
				$Db->bind(15, $slider);
				$Db->bind(16, $public);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				//header("Location: https://" . $host . "/root/" . $url_path);
				header("Location: https://" . $host . "/root/cms");
				die;
			break;
			case 'akce':
				$type = 'event';	
				$currentDatetime = date('y-m-dTH:I:S');
				//$imageLargeNewName = "images/" . $imageLargeNewName;
				//$imageSmallNewName = "images/" . $imageSmallNewName;
				$sql = "
					INSERT INTO 
					events(url_path, title, bands, text, image, publication_date, tags, type, image_reference, is_redesign_version, related_content, time, venue, date, contentobject_id, img_main, multiday_string, event_type, publish_date, public, added)
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP())
				";
				$Db->query($sql);
				$Db->bind(1, $url_path);
				$Db->bind(2, $title);
				$Db->bind(3, "");
				$Db->bind(4, $content);
				$Db->bind(5, $imageDetail);
				$Db->bind(6, $publishDate);
				$Db->bind(7, $tags);
				$Db->bind(8, $type);
				$Db->bind(9, $imageSearch);
				$Db->bind(10, 1);
				$Db->bind(11, $relatedContent);
				$Db->bind(12, $eventTime);
				$Db->bind(13, $where);
				$Db->bind(14, $when);
				$Db->bind(15, $time);
				$Db->bind(16, $imageMain);
				$Db->bind(17, $multidayString);
				$Db->bind(18, $eventType);
				$Db->bind(19, $currentDatetime);
				$Db->bind(20, $public);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				//header("Location: https://" . $host . "/root/" . $url_path);
				header("Location: https://" . $host . "/root/cms");
				die;
			break;
			case 'alba':
				$type = 'article';	
				$category = 'Alba měsíce';
				//$imageLargeNewName = "images/" . $imageLargeNewName;
				//$imageSmallNewName = "images/" . $imageSmallNewName;
				$sql = "
					INSERT INTO 
					articles(url_path, title, author_name, body, image, publish_date, tags, type, image_reference, is_redesign_version, related_content, intro, contentobject_id, img_main, slider, category, public, added)
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP())					
				";
				$Db->query($sql);
				$Db->bind(1, $url_path);
				$Db->bind(2, $title);
				$Db->bind(3, $authorName);
				$Db->bind(4, $content);
				$Db->bind(5, $imageDetail);
				$Db->bind(6, $publishDate);
				$Db->bind(7, $tags);
				$Db->bind(8, $type);
				$Db->bind(9, $imageSearch);
				$Db->bind(10, 1);
				$Db->bind(11, $relatedContent);
				$Db->bind(12, $intro);
				$Db->bind(13, $time);
				$Db->bind(14, $imageMain);
				$Db->bind(15, $slider);
				$Db->bind(16, $category);
				$Db->bind(17, $public);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				//header("Location: https://" . $host . "/root/" . $url_path);
				header("Location: https://" . $host . "/root/cms");
				die;
			break;
			case 'ostatni':
				$type = 'article';
				$category = 'Ostatní';
				$type = 'rozhovor';	
				//$imageLargeNewName = "images/" . $imageLargeNewName;
				//$imageSmallNewName = "images/" . $imageSmallNewName;
				$sql = "
					INSERT INTO 
					articles(url_path, title, author_name, body, image, publish_date, tags, type, image_reference, is_redesign_version, related_content, intro, contentobject_id, img_main, slider, category, public, added)
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP())					
				";
				$Db->query($sql);
				$Db->bind(1, $url_path);
				$Db->bind(2, $title);
				$Db->bind(3, $authorName);
				$Db->bind(4, $content);
				$Db->bind(5, $imageDetail);
				$Db->bind(6, $publishDate);
				$Db->bind(7, $tags);
				$Db->bind(8, $type);
				$Db->bind(9, $imageSearch);
				$Db->bind(10, 1);
				$Db->bind(11, $relatedContent);
				$Db->bind(12, $intro);
				$Db->bind(13, $time);
				$Db->bind(14, $imageMain);
				$Db->bind(15, $slider);
				$Db->bind(16, $category);
				$Db->bind(17, $public);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				//header("Location: https://" . $host . "/root/" . $url_path);
				header("Location: https://" . $host . "/root/cms");
				die;
			break;
			case 'additional_reviews':
				$author = $_SESSION['login'];
				$sql = "
					INSERT INTO 
					additional_reviews(url_path, author, content, rating)
					VALUES(?,?,?,?)			
				";
				$Db->query($sql);
				$Db->bind(1, $mainReviewUrl);
				$Db->bind(2, $author);
				$Db->bind(3, $additionalReviewContent);
				$Db->bind(4, $additionalReviewRating);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				//header("Location: https://" . $host . "/root/" . $url_path);
				header("Location: https://" . $host . "/root/cms");
				die;
			break;
		}
	}

	protected function saveEditedData(array $data, array $files): void {
		$Db = new Database;
		$allowed = ['jpg', 'jpeg', 'png'];

		$type = $data['type'];	

		// NEEDS REFACTORING
		if (empty($files['imageMain']['name'])) {
			$img_main = $data['oldimgmain'];
		} else {
			$img_main_name = $files['oldimgmain']['name'];
			$img_main_tmp_name = $files['oldimgmain']['tmp_name'];
			$img_main_extension_prepare = explode(".", $img_main_name);
			$img_main_extension = strtolower(end($img_main_extension_prepare));

			if (in_array($img_main_extension, $allowed)) {
				$img_main_prepare = uniqid('image', true);
				$img_main_new_name = $type . '/' . str_replace('.', rand(), $img_main_prepare) . "." . $img_main_extension;
				$path = __DIR__ . '/../../root/images/' . $img_main_new_name;
				move_uploaded_file($img_main_tmp_name, $path);			
				$img_main = "images/" . $img_main_new_name;
			}
		}

		// NEEDS REFACTORING
		if (empty($files['imageSmall']['name'])) {
			$image_reference = $data['oldimageref'];
		} else {
			$imageSmall_name = $files['imageSmall']['name'];
			$imageSmall_tmp_name = $files['imageSmall']['tmp_name'];
			$imageSmall_extension_prepare = explode(".", $imageSmall_name);
			$imageSmall_extension = strtolower(end($imageSmall_extension_prepare));

			if (in_array($imageSmall_extension, $allowed)) {
				$imageSmallNewName_prepare = uniqid('image', true);
				$imageSmallNewName = $type . '/' . str_replace('.', rand(), $imageSmallNewName_prepare) . "." . $imageSmall_extension;
				$path = __DIR__ . '/../../root/images/' . $imageSmallNewName;
				move_uploaded_file($imageSmall_tmp_name, $path);			
				$image_reference = "images/" . $imageSmallNewName;
			}
		}
		
		// NEEDS REFACTORING
		if (empty($files['imageLarge']['name'])) {
			$image = $data['oldimage'];
		} else {			
			$imageLarge_name = $files['imageLarge']['name'];
			$imageLarge_tmp_name = $files['imageLarge']['tmp_name'];
			$imageLarge_extension_prepare = explode(".", $imageLarge_name);
			$imageLarge_extension = strtolower(end($imageLarge_extension_prepare));

			if (in_array($imageLarge_extension, $allowed)) {
				$imageLargeNewName_prepare = uniqid('image', true);
				$imageLargeNewName = $type . '/' . str_replace('.', rand(), $imageLargeNewName_prepare) . "." . $imageLarge_extension;
				$path = __DIR__ . '/../../root/images/' . $imageLargeNewName;
				move_uploaded_file($imageLarge_tmp_name, $path);
				$image = "images/" . $imageLargeNewName;
			}
		}

		$title = $data['title'];

		if (isset($data['intro'])) {
			$intro = $data['intro'];
		}
		if (isset($data['rating'])) {
			$rating = $data['rating'];
		}

		$tags = $data['tags'];
		$body = $data['content'];
		$type = $data['type'];
		$url_path = $data['url_path'];
		$id = $data['id'];

		if ($_SESSION['role'] === 1) {
			$confirm = ",public=1"; 
		} else {
			$confirm = "";
		}

		switch ($data['type']) {
			case 'novinka':				
				$sql = "
					UPDATE news
					SET
						title = ?,
						body = ?,
						tags = ?,
						image = ?,
						image_reference = ?,
						img_main = ?".$confirm."
					WHERE id = ?				
				";
				$Db->query($sql);
				$Db->bind(1, $title);
				$Db->bind(2, $body);
				$Db->bind(3, $tags);				
				$Db->bind(4, $image);
				$Db->bind(5, $image_reference);
				$Db->bind(6, $id);
				$Db->bind(7, $img_main);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				//header("Location: https://" . $host . "/root/" . $url_path);
				header("Location: https://" . $host . "/root/cms");
				die;
			break;
			case 'recenze':				
				$sql = "
					UPDATE reviews
					SET
						title = ?,
						body = ?,
						tags = ?,
						image = ?,
						image_reference = ?,
						img_main = ?,
						rating = ?".$confirm."
					WHERE id = ?				
				";
				$Db->query($sql);
				$Db->bind(1, $title);
				$Db->bind(2, $body);
				$Db->bind(3, $tags);				
				$Db->bind(4, $image);
				$Db->bind(5, $image_reference);
				$Db->bind(6, $id);
				$Db->bind(7, $img_main);
				$Db->bind(7, $rating);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				header("Location: https://" . $host . "/root/" . $url_path);
				die;
			break;
			case 'rozhovor':				
				$sql = "
					UPDATE interviews
					SET
						title = ?,
						body = ?,
						tags = ?,
						image = ?,
						image_reference = ?,
						img_main = ?".$confirm."
					WHERE id = ?				
				";
				$Db->query($sql);
				$Db->bind(1, $title);
				$Db->bind(2, $body);
				$Db->bind(3, $tags);				
				$Db->bind(4, $image);
				$Db->bind(5, $image_reference);
				$Db->bind(6, $id);
				$Db->bind(7, $img_main);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				//header("Location: https://" . $host . "/root/" . $url_path);
				header("Location: https://" . $host . "/root/cms");
				die;
			break;
			case 'report':				
				$sql = "
					UPDATE reports
					SET
						title = ?,
						body = ?,
						tags = ?,
						image = ?,
						image_reference = ?,
						img_main = ?,
						intro = ?".$confirm."			
					WHERE id = ?				
				";
				$Db->query($sql);
				$Db->bind(1, $title);
				$Db->bind(2, $body);
				$Db->bind(3, $tags);				
				$Db->bind(4, $image);
				$Db->bind(5, $image_reference);				
				$Db->bind(6, $id);
				$Db->bind(7, $img_main);
				$Db->bind(8, $intro);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				header("Location: https://" . $host . "/root/" . $url_path);
				die;
			break;
			case 'alba':				
				$sql = "
					UPDATE articles
					SET
						title = ?,
						body = ?,
						tags = ?,
						image = ?,
						image_reference = ?,
						img_main = ?,
						intro = ?".$confirm."			
					WHERE id = ?				
				";
				$Db->query($sql);
				$Db->bind(1, $title);
				$Db->bind(2, $body);
				$Db->bind(3, $tags);				
				$Db->bind(4, $image);
				$Db->bind(5, $image_reference);				
				$Db->bind(6, $id);
				$Db->bind(7, $img_main);
				$Db->bind(8, $intro);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				header("Location: https://" . $host . "/root/" . $url_path);
				die;
			break;
			case 'ostatni':				
				$sql = "
					UPDATE articles
					SET
						title = ?,
						body = ?,
						tags = ?,
						image = ?,
						image_reference = ?,
						img_main = ?,
						intro = ?".$confirm."			
					WHERE id = ?				
				";
				$Db->query($sql);
				$Db->bind(1, $title);
				$Db->bind(2, $body);
				$Db->bind(3, $tags);				
				$Db->bind(4, $image);
				$Db->bind(5, $image_reference);				
				$Db->bind(6, $id);
				$Db->bind(7, $img_main);
				$Db->bind(8, $intro);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				header("Location: https://" . $host . "/root/" . $url_path);
				die;
			break;
			case 'event':	
				$venue = $data['where'];
				$date = $data['when'];
				$time = $data['time'];
				$text = $data['text'];
				$sql = "
					UPDATE events
					SET
						title = ?,
						text = ?,
						tags = ?,
						image = ?,
						image_reference = ?,
						venue = ?,
						date = ?,
						time = ?,
						img_main = ?".$confirm."
					WHERE id = ?				
				";
				$Db->query($sql);
				$Db->bind(1, $title);
				$Db->bind(2, $text);
				$Db->bind(3, $tags);				
				$Db->bind(4, $image);
				$Db->bind(5, $image_reference);
				$Db->bind(6, $venue);
				$Db->bind(7, $date);
				$Db->bind(8, $time);
				$Db->bind(9, $id);
				$Db->bind(10, $img_main);
				$Db->execute();
				$host = $_SERVER['HTTP_HOST'];
				//header("Location: https://" . $host . "/root/" . $url_path);
				header("Location: https://" . $host . "/root/cms");
				die;
			break;
		}
	}

	protected function getNewsList(): array {
		$Db = new Database;
		$sql = "SELECT title, id FROM news ORDER BY publish_date DESC";
		$Db->query($sql);
		return $Db->resultSet();
	}

	protected function getNewsData(int $id): array {
		$Db = new Database;
		$sql = "SELECT title, intro, body, image, image_reference, img_main, tags, url_path FROM news WHERE id = ?";
		$Db->query($sql);
		$Db->bind(1, $id);
		return $Db->resultSet();
	}

	protected function getReviewsList(): array {
		$Db = new Database;
		$sql = "SELECT title, id FROM reviews ORDER BY publish_date DESC";
		$Db->query($sql);
		return $Db->resultSet();
	}

	protected function getReviewsData(int $id): array {
		$Db = new Database;
		$sql = "SELECT title, intro, body, image, image_reference, img_main, tags, url_path, rating FROM reviews WHERE id = ?";
		$Db->query($sql);
		$Db->bind(1, $id);
		return $Db->resultSet();
	}

	protected function getAdditionalReviewsList(): array {
		$Db = new Database;
		$sql = "SELECT title, id FROM reviews ORDER BY publish_date DESC";
		$Db->query($sql);
		return $Db->resultSet();
	}

	protected function getAdditionalReviewsData(int $id): array {
		$Db = new Database;
		$sql = "SELECT content, author, url_path, rating FROM reviews WHERE id = ?";
		$Db->query($sql);
		$Db->bind(1, $id);
		return $Db->resultSet();
	}

	protected function getInterviewsList(): array {
		$Db = new Database;
		$sql = "SELECT title, id FROM interviews ORDER BY publish_date DESC";
		$Db->query($sql);
		return $Db->resultSet();
	}

	protected function getInterviewsData(int $id): array {
		$Db = new Database;
		$sql = "SELECT title, intro, body, image, image_reference, img_main, tags, url_path FROM interviews WHERE id = ?";
		$Db->query($sql);
		$Db->bind(1, $id);
		return $Db->resultSet();
	}

	protected function getAlbumsList(): array {
		$Db = new Database;
		$sql = "SELECT title, id FROM articles WHERE category = 'Alba měsíce' ORDER BY publish_date DESC";
		$Db->query($sql);
		return $Db->resultSet();
	}

	protected function getAlbumsData(int $id): array {
		$Db = new Database;
		$sql = "SELECT title, intro, body, image, image_reference, img_main, tags, url_path FROM articles WHERE category = 'Alba měsíce' AND id = ?";
		$Db->query($sql);
		$Db->bind(1, $id);
		return $Db->resultSet();
	}

	protected function getOthersList(): array {
		$Db = new Database;
		$sql = "SELECT title, id FROM articles WHERE category = 'Ostatní' ORDER BY publish_date DESC";
		$Db->query($sql);
		return $Db->resultSet();
	}

	protected function getOthersData(int $id): array {
		$Db = new Database;
		$sql = "SELECT title, intro, body, image, image_reference, img_main, tags, url_path FROM articles WHERE category = 'Ostatní' AND id = ?";
		$Db->query($sql);
		$Db->bind(1, $id);
		return $Db->resultSet();
	}

	protected function getReportsList(): array {
		$Db = new Database;
		$sql = "SELECT title, id FROM reports ORDER BY publish_date DESC";
		$Db->query($sql);
		return $Db->resultSet();
	}

	protected function getReportsData(int $id): array {
		$Db = new Database;
		$sql = "SELECT title, intro, body, image, image_reference, img_main, tags, url_path FROM reports WHERE id = ?";
		$Db->query($sql);
		$Db->bind(1, $id);
		return $Db->resultSet();
	}

	protected function getEventsList(): array {
		$Db = new Database;
		$sql = "SELECT title, id FROM events ORDER BY publication_date DESC";
		$Db->query($sql);
		return $Db->resultSet();
	}

	protected function getEventsData($id): array {
		$Db = new Database;
		$sql = "SELECT url_path, title, text, image, publication_date, img_main, tags, image_reference, time, venue, date, contentobject_id FROM events WHERE id = ?";
		$Db->query($sql);
		$Db->bind(1, $id);
		return $Db->resultSet();
	}

	protected function removeCmsItem(string $type, int $id): void {
		$Db = new Database;
		switch ($type) {
			case 'novinka':				
				$sql = "DELETE FROM news WHERE id = ?";
				$Db->query($sql);
				$Db->bind(1, $id);
				$Db->execute();
			break;
			case 'recenze':				
				$sql = "DELETE FROM reviews WHERE id = ?";
				$Db->query($sql);
				$Db->bind(1, $id);
				$Db->execute();
			break;
			case 'rozhovor':				
				$sql = "DELETE FROM interviews WHERE id = ?";
				$Db->query($sql);
				$Db->bind(1, $id);
				$Db->execute();
			break;
			case 'report':				
				$sql = "DELETE FROM reports WHERE id = ?";
				$Db->query($sql);
				$Db->bind(1, $id);
				$Db->execute();
			break;
			case 'event':				
				$sql = "DELETE FROM events WHERE id = ?";
				$Db->query($sql);
				$Db->bind(1, $id);
				$Db->execute();
			break;
			case 'alba':				
				$sql = "DELETE FROM articles WHERE id = ?";
				$Db->query($sql);
				$Db->bind(1, $id);
				$Db->execute();
			break;
			case 'ostatni':				
				$sql = "DELETE FROM events WHERE id = ?";
				$Db->query($sql);
				$Db->bind(1, $id);
				$Db->execute();
			break;
			case 'additional_reviews':				
				$sql = "DELETE FROM additional_reviews WHERE id = ?";
				$Db->query($sql);
				$Db->bind(1, $id);
				$Db->execute();
			break;
		}
	}
}




