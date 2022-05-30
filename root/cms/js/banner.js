if (poutac === 1) {
    $croppieSearch = $('#croppie').croppie({
        enableExif: true,
        viewport: {
            width: 754,
            height: 580
        },
        boundary: {
            width: 800,
            height: 600
        }
    });
} else if (poutac === 4) {
    $croppieSearch = $('#croppie').croppie({
        enableExif: true,
        viewport: {
            width: 440,
            height: 440
        },
        boundary: {
            width: 500,
            height: 500
        }
    });
} else {
    $croppieSearch = $('#croppie').croppie({
        enableExif: true,
        viewport: {
            width: 533,
            height: 278
        },
        boundary: {
            width: 800,
            height: 600
        }
    });
}

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
            url: "../handlers/save-main-banner.handler.php",
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