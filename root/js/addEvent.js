$("#userEventSubmit").click(function(e) {
    e.preventDefault();
    $.post('handlers/save-user-event.handler.php', {
        event: $("#event").val(),
        date: $("#date").val(), 
        club: $("#club").val(),
        facebook: $("#facebook").val(), 
        image: $("#image").val()
    }, function(){ 
        $(".c-detail-form__container, .c-detail-form__image")
            .addClass("c-detail-form__container--disabled");
        $(".c-detail-form__success")
            .addClass("c-detail-form__success--visible");
        setTimeout(function() {
            history.back();
        }, 2500); 
    });
});

$croppieSearch = $('#croppie').croppie({
    enableExif: true,
    viewport: {
        width: 310,
        height: 440
    },
    boundary: {
        width: 500,
        height: 600
    }
});

$('#croppie-btn').click(function(){
    $('#modal').addClass('c-croppie__modal--visible');
});

$('#upload').on('change', function () { 
    var reader = new FileReader();
    reader.onload = function (e) {
        $croppieSearch.croppie('bind', {
            url: e.target.result
        }).then(function(){
            console.log('ahoj');
        });
    }
    reader.readAsDataURL(this.files[0]);
});

$('#croppie-upload').on('click', function(ev) {   
    $croppieSearch.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function(response) {
        $.ajax({
            url: "handlers/save-event-img.handler.php",
            type: "POST",
            data: {
                "image": response
            },
            success: function(data) {
                html = '<img src="' + response + '" />';
                $("#upload-preview").html(html);
                $("#image").attr('value', data); 
            }
        });
        $('.c-croppie__modal').removeClass('c-croppie__modal--visible');
        $('#upload-preview').addClass('c-croppie__preview--visible')
    });
});