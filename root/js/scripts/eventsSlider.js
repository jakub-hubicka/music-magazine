$('.c-slider-multiple__arrow--right').click(function(){
    $(this).addClass('c-slider-multiple__arrow--disabled');
    $('.c-slider-multiple__bar--active').addClass('c-slider-multiple__bar--translated');
    $('.c-slider-multiple__arrow--left').removeClass('c-slider-multiple__arrow--disabled');
    $('.c-slider-multiple__container').addClass('c-slider-multiple__container--translated');
});

$('.c-slider-multiple__arrow--left').click(function(){
    $(this).addClass('c-slider-multiple__arrow--disabled');
    $('.c-slider-multiple__bar--active').removeClass('c-slider-multiple__bar--translated');
    $('.c-slider-multiple__arrow--right').removeClass('c-slider-multiple__arrow--disabled');
    $('.c-slider-multiple__container').removeClass('c-slider-multiple__container--translated');
}); 