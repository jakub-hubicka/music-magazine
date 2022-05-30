$(window).scroll(function() {
    if ($(this).scrollTop() > 40) {
        $('header').addClass('c-header--fixed');
    } else {
        $('header').removeClass('c-header--fixed');
    }
    if ($(this).scrollTop() > 250) {
        $('header').addClass('c-header--small');
        $('.c-submenu__body').addClass('c-submenu__body--small');
    } else {
        $('header').removeClass('c-header--small');
        $('.c-submenu__body').removeClass('c-submenu__body--small');
    }
    $('#detail-header').css('background-position-y', -$(this).scrollTop() / 6);
});