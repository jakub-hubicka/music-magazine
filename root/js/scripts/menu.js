$('.c-mobile-navbar__button').click(function(){
    $('.c-mobile-menu').toggleClass('c-mobile-menu--opened');
});

$('#menuButton').click(function(){
    $('#mobileMenu').toggleClass('c-mobile-menu--opened');
});

$('#mobileSubmenuButton').click(function(){
    $('.c-mobile-menu__submenu').toggleClass('c-mobile-menu__submenu--opened');
    $('#mobileSubmenuButton .c-main-menu__arrow').toggleClass('c-main-menu__arrow--cube');
});