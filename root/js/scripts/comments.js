$('#slideToCommentSection').click(function () {
    $([document.documentElement, document.body]).animate(
        {
            scrollTop: $('.c-detail-comments').offset().top,
        },
        2000
    );
});

function loadCommentsSection(button, template) {
	button.click(function(){
		$('#comments').addClass('c-loader');
		$('.c-item-v2').addClass('c-item-v2--invisible');
		$('#comments').load(template, function() {
			$('#comments').removeClass('c-loader');
			$('.c-item-v2').removeClass('c-item-v2--invisible');
		});
		$('.c-text-filter__item').removeClass('c-text-filter__item--active');
		$(this).addClass('c-text-filter__item--active');
	});
}

if ($('#homepage').length ||
	$('#overview').length || 
	$('#articles').length || 
	$('#gallery-overview').length || 
	$('#events-overview').length) {
	$('#comments').load('templates/commentsAll.php');
}

loadCommentsSection($('#commentsAll'), 'templates/commentsAll.php');
loadCommentsSection($('#commentsReports'), 'templates/commentsReports.php');
loadCommentsSection($('#commentsReviews'), 'templates/commentsReviews.php');
loadCommentsSection($('#commentsOthers'), 'templates/commentsOthers.php');