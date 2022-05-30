<?php

namespace App\controllers;
use App\Models\CmsModel;

class CmsController extends CmsModel {

	public function sendData(array $post, array $files): void {
		if ($post['type'] === 'galerie') {
			$this->saveGalleryData($post, $files);
		} else {
			$this->saveData($post, $files);
		}
	}

	public function sendEditData(array $post, array $files): void {
		$this->saveEditedData($post, $files);
	}

	public function sendBannerLink(array $post): void {
		$this->saveBannerLink($post);
	}

	public function deleteCmsItem(string $type, int $id): void {
		$this->removeCmsItem($type, $id);
	}
}