$('.c-main-menu__list, .c-submenu__body').mouseenter(function(){
    $('.c-submenu__body').addClass('c-submenu__body--open');
});

$('.c-main-menu, .c-submenu__body').mouseleave(function(){
    $('.c-submenu__body').removeClass('c-submenu__body--open');
});