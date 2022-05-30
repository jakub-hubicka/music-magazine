$('.c-topbar__toggle').click(function(){
    $(this).toggleClass('c-topbar__toggle--active');
    var darkmode = $('body').hasClass('darkmode') ? '' : 'darkmode';

    $.post('../handlers/darkmode.handler.php', {
        darkmode: darkmode
    });

    $('body').toggleClass('darkmode');
});