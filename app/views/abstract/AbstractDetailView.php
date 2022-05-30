<?php

namespace App\Views\abstract;
use App\Models as m;

abstract class AbstractDetailView {

    abstract protected function showTitle(): void;
    abstract protected function showDetail(): void;

    protected $id;
	protected $type;
	protected $tags;
	protected $slider;
	protected $relatedContentString;
	protected $image;
	protected $authorName;
	protected $publishDate;
	protected $contentObjectId;
	protected $server;
	
	public function getContentObjectId(): int {
		return $this->contentObjectId;
	}

	public function getId(): int {
		return $this->id;
	}

	public function showSlider(): void {
		if ($this->slider !== "") {
			$sliderArray = explode(',', $this->slider);
			foreach ($sliderArray as $imgPath) {
				echo <<< EOT
					<img src='../images/slider/$imgPath'>
				EOT;
			}
		}
	}

	public function imgUrl(): void {
		echo "$this->image";	
	}

	public function showImg(): void {
		echo <<< EOT
			<img class='c-article-img' src='../$this->image'>
		EOT;	
	}

	public function showRelated(): void {
		$Related = new m\RelatedModel;
		$res = $Related->getRelated($this->relatedContentString);
		$server = $_SERVER['SERVER_NAME'];

		foreach ($res as $item) {

			$author = $this->parseDetailAuthorName($item['author_name'], 'relatedContent');
			$publishDate = date("d.m.y", strtotime($item['publish_date']));
            $type = $item['category'] ?? $item['type'];

			echo <<< EOT
				<a href='https://$server/root/$item[url_path]' class='c-item-v4'>
					<div class='c-item-v4__img' style='background-image:url(../$item[image]), url(../images/default.png)'>
						<span class='c-tag'>$type</span>
					</div>
					<div class='c-item-v4__container'>
						<div class='c-item-v4__text'>$item[title]</div>
						<span class='c-item-v4__author'>$author</span> - <span class='c-item-v4__date'>$publishDate</span>
					</div>
				</a>		
			EOT;
		}
	}    

	public function showTags(): void {
		$tags = explode(',', $this->tags);
		foreach ($tags as $tag) {
			$tag = trim($tag);
			$tagLink = str_replace(' ', '_', $tag);
			$fullLink = "https://" . $_SERVER['HTTP_HOST'] . '/root/tagy/' . $tagLink;
			
			echo <<< EOT
				<a href='$fullLink' class='c-tags__tag'>$tag</a>
			EOT;
		}
	}    

	public function getType(): string {
		return $this->type;
	}

	public function getTitle(): string {
		return $this->title;
	}

    public function parseDetailAuthorName(string $authorName, string $type = NULL): string {
        $authorNamesCollection = explode(",", $authorName);
        $authorNames = [];

        if ($type === 'relatedContent') {
            foreach($authorNamesCollection as $author) {
                $authorNames[] = "<span class='c-item-footer__author'>" . $author . "</span>";
            }
        } else {
            foreach($authorNamesCollection as $author) {
                $authorNames[] = "<a href='$this->server/autor/$author' class='c-header-large__author'>" . $author . "</a>";
            }
        }

        return implode(", ", $authorNames);
    }

	public function showHeaderFooter(): void {
		echo <<< EOT
			$this->authorName - <span class='c-header-large__date'>$this->publishDate</span>
		EOT;
	}    
}
