if ($('.c-article-slider').length) {
	$('.c-article-slider').appendTo('#slider');
	$('.c-article-slider').slick();	
}	  

/*
// SLIDER FOR OLD ARTICLES (disabled)

if ($('.c-text').length) {
	$('.c-text img').each(function(){
		var src = $(this).attr('src'),
			srcFixed = '../' + src;
		$(this).attr('src', srcFixed);
	});
	
	var articleCenter = $('.c-text b').length / 2;
	
	$('.c-text b')[articleCenter].classList.add('b-center');
	$('.c-article-slider').insertBefore('.b-center');
	
	$('.c-text img').wrap('<div class='itm'></div>');
	$('.itm').appendTo('.c-article-slider');
}
*/