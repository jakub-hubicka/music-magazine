<?php
namespace App\Views;
use App\Models as m;

class CubeView extends m\CubeModel {

	public function showCube(): void {
		$res = $this->getCubeInfo();

        $date = $res['date'];
        $title = $res['title'];
        $subtitle = $res['subtitle'];
        $image = $res['image'];
        $link = $res['link'];

		echo <<< EOT
			<a href='$link' class='c-box-v2 c-box-v2--cube' style='background-image:url($image), url(images/default.png)'>
				<div class='c-box-v2__content'>
					<div><span class='c-tag'>Promo</span></div>	
					<div class='c-box-v2__date'>$date</div>		
					<h3 class='c-box-v2__title'>$title</h3>
					<div class='c-box-v2__footer'>$subtitle</div>
					<span class='c-arrow c-arrow--colored'></span>
				</div>
			</a>				
		EOT;
	}	
}