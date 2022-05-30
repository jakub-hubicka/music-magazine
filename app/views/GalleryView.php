<?php

namespace App\Views;
use App\Models as m;
use App\Views\BaseView;

class GalleryView extends BaseView {

	private $contentobject_id;
	private $relatedContentString;
	private $model;

	public function __construct(m\GalleryModel $model) {
		$this->model = $model;
	}

	public function showGalleryList(int $boxCount, int $limit): void {
		$res = $this->model->getGalleryList($boxCount, $limit);

		foreach ($res as $gallery) {
			
			$authorNames = $this->parseAuthorName($gallery['author_name']);
			$publish_date = date("d.m.y", strtotime($gallery['publish_date']));
			$numberOfPhotos = count($this->model->getNumberOfPhotos($gallery['url_path']));

			echo <<< EOT
				<a href='$gallery[url_path]' class='c-box-v5' style='background-image:url($gallery[image_reference]), url(images/default.png)'>
					<div class='c-box-v5__content'>						
						<h3 class='c-box-v5__title'>
							$gallery[title]
						</h3>
						<div class='c-item-footer'>
							<span class='c-item-footer__author'>$authorNames</span> - <span class='c-item-footer__date'>$publish_date</span>
							<span class='c-box-v5__tag'>$numberOfPhotos Fotek</span> <span class='c-box-v2__comments-count'>$gallery[comments_count]</span>
						</div>
						<span class='c-arrow c-arrow--colored'></span>
					</div>
				</a>		
			EOT;
		}
	}

	public function showGalleryData(string $galleryName): void {

		$galleryNameFull = 'galerie/' . $galleryName;
		$res = $this->model->getGalleryData($galleryNameFull);

		$this->contentobject_id = $res[0]['contentobject_id'];
		$this->relatedContentString = $res[0]['related_content'];

		$title = $res[0]['title'];
		$author_name = $res[0]['author_name'];
		$event_date = $res[0]['event_date'];
		$venue = $res[0]['venue'];

		echo <<< EOT
			<div class='c-info-block__title'>$title</div>
			<div>$author_name<br>$event_date<br>$venue</div>
		EOT;
	}

	public function getTitle() {
		return "title"; // :)
	}

	public function getType() {
		return "galerie"; // :)
	}

	public function showRelated() {		

		$Related = new m\RelatedModel;
		$res = $Related->getRelated($this->relatedContentString);

		if ($res == NULL) {
			return 'empty';
		}

		$server = $_SERVER['SERVER_NAME'];

		foreach ($res as $item) {

			$authorNames = $this->parseAuthorName($item['author_name']);
			$publish_date = date("d.m.y", strtotime($item['publish_date']));

			$type = $item['category'] ?? $item['type'];	

			echo <<< EOT
				<a href='https://$server/root/$item[url_path]' class='c-item-v4'>
					<div class='c-item-v4__img' style='background-image:url($item[image]), url(../images/default.png)'>
						<span class='c-tag'>$type</span>
					</div>
					<div class='c-item-v4__container'>
						<div class='c-item-v4__text'>$item[title]</div>
						<span class='c-item-v4__author'>$authorNames</span> - <span class='c-item-v4__date'>$publish_date</span>
					</div>
				</a>		
			EOT;
		}
	}

	public function getContentObjectId() {
		return $this->contentobject_id;
	}

	public function showImages(string $galleryName): void {

		$galleryNameFull = 'galerie/' . $galleryName;
		$res = $this->model->getImages($galleryNameFull);

		foreach ($res as $image) {
			$img = $image['image_reference'];
			$name = $image['name'];

			echo "<a class='c-gallery-detail__img' style='background-image:url(../$img)'><img data-fancybox='gallery' data-caption='$name' src='../$img'></a>";
		}
	}
}