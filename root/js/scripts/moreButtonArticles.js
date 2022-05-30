if ($('#articles').length) {
	$('#btnMore').click(function() {
		$('.c-pagination__page-button').hide();
		var boxCount = $('.c-item-v4').length,
			activeId = $('.c-detail-menu__item--active').attr('id');
		console.log(activeId);
		$('<div></div>').appendTo('#main').load('templates/articles' + activeId + '.php', {boxCount: boxCount});
	});

	var activeId = $('.c-detail-menu__item--active').attr('id');
	$('#main').load('templates/articles' + activeId + '.php');
}