function search(searchType) {
	$('#searchResult > a').remove();
	var searchString = $('.c-search__input').val(),
		searchType = searchType;
	if (searchString.length >= 3) {		
		$('.c-search__load').addClass('c-search__load--visible');	
		template = window.location.origin + '/root/templates/searchResult.php';	
		setTimeout(function(){																
			$('#searchResult').load(template, {'searchString': searchString, 'type': searchType}, function() {
				$('.c-search__load').removeClass('c-search__load--visible');
			});									
		}, 1500);
	} else {
		$('.c-search__load').removeClass('c-search__load--visible');
	}
}

$('.c-search__input').keyup(function(){
	search($('#searchMenu .c-center-menu__item--active').attr('id'));
});

$('#searchMenu a').click(function() {
	search($(this).parent().attr('id'));
});

$('.c-topbar__search').click(function(){	
	$('.c-search').addClass('c-search--visible');
	$('.c-search__load').removeClass('c-search__load--hidden');
	setTimeout(function(){
		$('body').addClass('u-o-h');
		$('.c-search__container').addClass('c-search__container--visible');
		$('#searchInput').get(0).focus();
	}, 800);
});

$('.c-search__close-button').click(function(){
	$('.c-search').removeClass('c-search--visible');
	$('.c-search__load').addClass('c-search__load--hidden');
	$('body').removeClass('u-o-h');
	$('.c-search__container').removeClass('c-search__container--visible');
	$('#searchInput').val('');
	$('#searchResult > a').remove();
});

$('.c-search__submit').click(function(){
	search($('#searchMenu .c-center-menu__item--active').attr('id'));
});

$('#searchMenu .c-center-menu__link').click(function(){
	$('#searchMenu li').removeClass('c-center-menu__item--active');
	$(this).parent().addClass('c-center-menu__item--active');
});