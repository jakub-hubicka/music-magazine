<?php

namespace App\Views;
use App\Models as m;

class CommentsView {

	private $model;

	public function __construct(m\CommentsModel $model) {
		$this->model = $model;
	}

	private function getQuote(string $comment, string $startTag, string $endTag): string {

		$comment = ' ' . $comment;
		$startTagPosition = strpos($comment, $startTag);

		if ($startTagPosition === 0) {
			return '';
		}

		$commentPosition = $startTagPosition + strlen($startTag) + 7;   
		$quoteLength = strpos($comment, $endTag, $commentPosition) - $commentPosition;

		return substr($comment, $commentPosition, $quoteLength);
	}

	public function showDetailList($contentObjectId): void {
		$res = $this->model->getDetailList($contentObjectId);

		foreach ($res as $comment) {

			$publish_date = date('d.m.y H:i:s', $comment['created']);

			if ($comment['is_old'] == 1 && str_contains($comment['text'], '[quote')) {
				$quote = $this->getQuote($comment['text'], '[quote', '[/quote]');
				$quoteWrapped = '<span class="c-item-v2__quote">"' . $quote . '"</span> ';
				$text = preg_replace('#\[quote[^\]]*\](.*?)\[/quote\]#m', "$1", str_replace($quote, $quoteWrapped, $comment['text']));
			} else {
				$text = $comment['text'];
			}

			echo <<< EOT
				<div class='c-item-v2 c-item-v2--wide'><a style="position:relative;top:-45px;" name='$comment[id]'></a>	
					<div class='c-item-v2__header'>
						<span class='c-item-v2__author u-black'>$comment[name]</span> - <span class='c-item-v2__date'>$publish_date</span>
					</div>
					<div class='c-item-v2__text'>$text</div>
				</div>
			EOT;
		}
	}	

	public function showList(string $type) {

		$res = $this->model->getList($type);

		foreach ($res as $comment) {

			$publishDate = date('d.m.y H:i:s', $comment['created']);

			echo <<< EOT
				<div class='c-item-v2 c-item-v2--small'>					
					<a href='$comment[url_path]#$comment[id]' class='c-item-v2__text c-item-v2__text--hover'>$comment[detail_title]</a>
					<div class='c-item-v2__header'>
						<span class='c-item-v2__author u-black'>$comment[name]</span> - <span class='c-item-v2__date'>$publishDate</span>
					</div>
				</div>
			EOT;
		}
	}	

	public function showFullList(): void {
		$res = $this->model->getFullList();

		foreach ($res as $comment) {

			$publishDate = date('d.m.y H:i:s', $comment['created']);

			echo <<<EOT
				<div class='c-item-v2 c-item-v2--small'>					
					<a href='$comment[url_path]#$comment[id]' class='c-item-v2__text c-item-v2__text--hover'>$comment[detail_title]</a>
					<div class='c-item-v2__header'>
						<span class='c-item-v2__author u-black'>$comment[name]</span> - <span class='c-item-v2__date'>$publishDate</span>
					</div>
				</div>
			EOT;
		}
	}
}