$('#btnMore').click(function() {
	if ($('#overview').length) {
		var boxCount = $('#main .c-item-v4').length;
	}
	
	if ($('#events-overview').length) {
		var boxCount = $('#main .c-box-v2').length;
	}

	if ($('#gallery-overview').length) {
		var boxCount = $('#main .c-box-v5').length;
	}

	if (!$('#articles').length) {
		$('<div></div>').appendTo('#main').load(overviewTemplate, {boxCount: boxCount});
	}
});

if ($('#overview').length ||
	$('#events-overview').length ||
	$('#gallery-overview').length) {
	$('#main').load(overviewTemplate);
}