<?php

namespace App\Views\abstract;

abstract class AbstractArticlesView {

    abstract public function showFullList(int $boxCount): void;

    protected function parseAuthorName(string $authorName): string {
        $authorNamesCollection = explode(",", $authorName);
        $authorNames = [];

        foreach($authorNamesCollection as $author) {
            $authorNames[] = "<span class='c-item-footer__author'>" . $author . "</span>";
        }

        return implode(", ", $authorNames);
    }

    protected function printList(array $data, string $page): void {
        foreach ($data as $item) {

            $type = $item['category'] ?? $item['type'];

			$author = $this->parseAuthorName($item['author_name']);
			$publishDate = date("d.m.y", strtotime($item['publish_date']));

            if ($item['is_redesign_version'] === 1) {
                $image = $item['img_main'];
            } else if ($item['image_reference'] === "http://test.com/") {
                $image = "images/default.jpg";
            } else {
                $image = $item['image_reference'];
            }

            switch ($page) {
                case 'homepage':
                    echo <<< EOT
                        <a href='$item[url_path]' class='c-box-v1' style='background-image:url($image), url(images/default.png)'>
                        <div class='c-box-v1__content'>
                            <h3 class='c-box-v1__title'>$item[title]</h3>
                            <div class='c-box-v1__tags'>
                                <span class='c-tag'>$type</span>
                            </div>
                            <span class='c-arrow' style='background:blue;color:white;'></span>
                        </div>
                            <div class='c-item-footer'>
                                <span class='c-item-footer__author'>$author</span> - <span class='c-item-footer__date'>$publishDate</span> <span class='c-item-footer__comments-count'> $item[comments_count]</span>
                            </div>
                        </a>				
                    EOT;
                break;
                case 'overview':
                    echo <<< EOT
                        <a href='$item[url_path]' class='c-item-v4'>
                            <div class='c-item-v4__img' style='background-image:url($image), url(images/default.png)'>
                                <span class='c-tag'>$type</span>
                            </div>
                            <div class='c-item-v4__container'>
                                <div class='c-item-v4__text'>$item[title]</div>
                                <span class='c-item-v4__author'>$author</span> - <span class='c-item-v4__date'>$publishDate</span> <span class='c-item-footer__comments-count c-item-footer__comments-count--dark'> $item[comments_count]</span>
                            </div>
                        </a>		
                    EOT;
                break;
            }
		}
    }
}