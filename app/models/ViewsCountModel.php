<?php

namespace App\Models;
use App\Core\Database;

class ViewsCountModel {

	protected function saveView(string $type, string $urlpath): void {
		$Db = new Database;

		switch ($type) {
			case 'report':
				$urlpath = "clanky/" . $urlpath;
				$sql = "UPDATE reports SET views = views + 1 WHERE url_path = ?";
				$Db->query($sql);
				$Db->bind(1, $urlpath);
				$Db->execute();
			break;

			case 'recenze':
				$urlpath = "recenze/" . $urlpath;
				$sql = "UPDATE reviews SET views = views + 1 WHERE url_path = ?";
				$Db->query($sql);
				$Db->bind(1, $urlpath);
				$Db->execute();
			break;

			case 'novinka':
				$urlpath = "novinky/" . $urlpath;
				$sql = "UPDATE news SET views = views + 1 WHERE url_path = ?";
				$Db->query($sql);
				$Db->bind(1, $urlpath);
				$Db->execute();
			break;

			case 'interview':
				$urlpath = "clanky/" . $urlpath;
				$sql = "UPDATE interviews SET views = views + 1 WHERE url_path = ?";
				$Db->query($sql);
				$Db->bind(1, $urlpath);
				$Db->execute();
			break;

			case 'article':
				$urlpath = "clanky/" . $urlpath;
				$sql = "UPDATE articles SET views = views + 1 WHERE url_path = ?";
				$Db->query($sql);
				$Db->bind(1, $urlpath);
				$Db->execute();
			break;
		}
	}
}


