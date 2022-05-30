<?php

namespace App\Views;
use App\Models as m;

class BannerView extends BaseView {

	private $model;

	public function __construct(m\BannerModel $model) {
		$this->model = $model;
	}

	public function showBanner(): void {
		$res = $this->model->getList(3);

		foreach ($res as $item) {
			
			$authorNames = $this->parseAuthorName($item['author_name']);
			$publishDate = date("d.m.y", strtotime($item['publish_date']));
			$commentsCount = $this->model->getCommentsCount($item['url_path'], $item['type']);
			$image = $item['image'] === "http://test.com/" ? "images/dafault.jpg" : $item['image'];
			
			switch (true) {
				case $res[0] == $item:
					echo <<< EOT
						<a href='$item[url_path]' class='c-box-v3' style='background-image:url($image), url(images/default.png)'>	
							<div class='c-box-v3__content'>
								<div>
									<span class='c-tag'>$item[type]</span>
								</div>							
								<h2 class='c-box-v3__title'>$item[title]</h2>
								<span class='c-arrow'></span>
							</div>
							<div class='c-item-footer'>
								$authorNames - <span class='c-item-footer__date'>$publishDate</span> <span class='c-item-footer__comments-count'> $commentsCount</span>
							</div>
						</a>
					EOT;
				break;

				case $res[1] == $item:
					echo <<< EOT
						<div><a href='$item[url_path]' class='c-box-v4' style='background-image:url($image), url(images/default.png)'>	
							<div class='c-box-v4__content'>
								<div>
									<span class='c-tag'>$item[type]</span>
								</div>							
								<h2 class='c-box-v4__title'>$item[title]</h2>
								<span class='c-arrow'></span>
							</div>
							<div class='c-item-footer'>
							$authorNames - <span class='c-item-footer__date'>$publishDate</span> <span class='c-item-footer__comments-count'> $commentsCount</span>
							</div>
						</a>
					EOT;
				break;

				case $res[2] == $item:
					echo <<< EOT
						<a href='$item[url_path]' class='c-box-v4' style='background-image:url($image), url(images/default.png)'>
							<div class='c-box-v4__content'>
								<div>
									<span class='c-tag'>$item[type]</span>
								</div>	
								<h3 class='c-box-v4__title'>$item[title]</h3>
								<span class='c-arrow'></span>
							</div>
								<div class='c-item-footer'>
								$authorNames - <span class='c-item-footer__date'>$publishDate</span> <span class='c-item-footer__comments-count'> $commentsCount</span>
								</div>							
						</a></div>
					EOT;
				break;
			}
		}
	}	
}