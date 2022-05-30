<?php

namespace App\Views;

class BaseView {

	public function printItem_v1($parsedResult): void {
        echo <<< EOT
            <a href='$parsedResult[urlPath]' class='c-item-v1'>
                <div class='c-item-v1__img' style='background-image: url($parsedResult[image]), url(images/default.png)'></div>
                <div class='c-item-v1__container $parsedResult[size]'>
                    
                    <div class='c-item-v1__tags'>
                        <span class='c-tag'>$parsedResult[type]</span>
                    </div>
                    
                    <div class='c-item-v1__text'>$parsedResult[title]</div>
                    <div class='c-item-v1__footer'>
                        <span class='c-item-v1__author'>$parsedResult[authorName]</span> - <span class='c-item-v1__date'>$parsedResult[publishDate]</span> <span class='c-item-footer__comments-count c-item-footer__comments-count--dark'>$parsedResult[commentsCount]</span>
                    </div>						
                </div>
            </a>
        EOT;
    }

    public function printItem_v4($parsedResult): void {
        echo <<< EOT
            <a href='$parsedResult[urlPath]' class='c-item-v4'>
                <div class='c-item-v4__img' style='background-image:url($parsedResult[image]), url(images/default.png)'>
                    <span class='c-tag'>$parsedResult[type]</span>
                </div>
                <div class='c-item-v4__container'>
                    <div class='c-item-v4__text'>$parsedResult[title]</div>
                    <span class='c-item-v4__author'>$parsedResult[authorName]</span> - <span class='c-item-v4__date'>$parsedResult[publishDate]</span> <span class='c-item-footer__comments-count c-item-footer__comments-count--dark'> $parsedResult[commentsCount]</span>
                </div>
            </a>		
        EOT;
    }

    protected function parseAuthorName(string $authorName): string {
        $authorNamesCollection = explode(",", $authorName);
        $authorNames = [];

        foreach($authorNamesCollection as $author) {
            $authorNames[] = "<span class='c-item-footer__author'>" . $author . "</span>";
        }

        return implode(", ", $authorNames);
    }
}
