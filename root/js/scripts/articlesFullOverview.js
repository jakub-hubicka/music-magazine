$('#articlesMenuList > li').each(function(){
	if ($(this).hasClass('c-detail-menu__item--active')) {
		$(this).find('a').click();
		history.pushState({}, null, 'clanky');
	}
});

function loadArticles(button, template) {
	button.click(function(){
		$('#main').load(template);
		$('.c-detail-menu__item').removeClass('c-detail-menu__item--active');
		$(this).addClass('c-detail-menu__item--active');
	});
}

loadArticles($('#All'), 'templates/articlesAll.php');
loadArticles($('#Reviews'), 'templates/articlesReviews.php');
loadArticles($('#Reports'), 'templates/articlesReports.php');
loadArticles($('#Interviews'), 'templates/articlesInterviews.php');
loadArticles($('#Albums'), 'templates/articlesAlbums.php');
loadArticles($('#Others'), 'templates/articlesOthers.php');