$('textarea').on('input', function () {
	this.style.height = 'auto';
	this.style.height = (this.scrollHeight) + 'px';
});

$('#detailFormSubmit').click(function(e) {
	e.preventDefault();
	if ($('#name').val() != '' && $('#text').val() != '') {
		$(this).addClass('c-detail-form__button--clicked');		
		$.post('../handlers/detail-form.handler.php', {
			name: $('#name').val(),
			text: $('#text').val(),
			id: $('#contentObjectId').val(),
			urlPath: $('#urlPath').val(),
			title: $('#title').val(),
			type: $('#type').val()
		}, function() {
			$('.c-detail-form__input').val('');
			$('#comments').load('../templates/commentsDetail.php', {contentObjectId: $('#contentObjectId').val()});
		});
	}
});

$('.c-detail-form__input').focus(function(){
	$('#detailFormSubmit').removeClass('c-detail-form__button--clicked');
});