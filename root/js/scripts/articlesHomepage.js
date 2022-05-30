$('#homepage #main').load('templates/allList.php');

function loadList(button, template) {
	button.click(function(){
		$('#main').load(template);
		$('.c-center-menu__item').removeClass('c-center-menu__item--active');
		$(this).addClass('c-center-menu__item--active');
	});
}

loadList($('#all'), 'templates/allList.php');
loadList($('#news'), 'templates/newsList.php');
loadList($('#reviews'), 'templates/reviewsList.php');
loadList($('#reports'), 'templates/reportsList.php');
loadList($('#interviews'), 'templates/interviewsList.php');
loadList($('#albums'), 'templates/albumsList.php');
loadList($('#others'), 'templates/othersList.php');