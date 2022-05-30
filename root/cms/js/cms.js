$(document).ready(function(){

    $(".deletelink").click(function(e){
        var linkTitle = $(this).attr('link-title');
        if(confirm('Opravdu smazat ' + linkTitle + ' ???')) {
            if(confirm('Kliknutím na OK smažeš ' + linkTitle)) {
                
            } else {
                 e.preventDefault();
            }
        } else {
            e.preventDefault();
        }
    });
    
    $('#summernote').summernote({
        height: 350
    });

    if (type === 'novinka') {
        $croppieMain = $('#croppie-main').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 132
            },
            boundary: {
                width: 500,
                height: 400
            }
        });
    } else {
        $croppieMain = $('#croppie-main').croppie({
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
    }
    
    $('#croppie-btn-main').click(function(){
        $('#modal-main').addClass('c-croppie__modal--visible');
    });
    
    $('#upload-main').on('change', function () { 
        var reader = new FileReader();
        reader.onload = function (e) {
            $croppieMain.croppie('bind', {
                url: e.target.result
            }).then(function(){
                console.log('main');
            });
        }
        reader.readAsDataURL(this.files[0]);
    });
    
    $('#croppie-upload-main').on('click', function(ev) {   
        $croppieMain.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response) {
            $.ajax({
                url: "../handlers/save-uploaded-img.handlers.php",
                type: "POST",
                data: {
                    "image": response,
                    "type": type
                },
                success: function(data) {
                    html = '<img src="' + response + '" />';
                    $("#upload-main-preview").html(html);
                    $("#image-main-post").attr('value', data); 
                }
            });
            $('.c-croppie__modal').removeClass('c-croppie__modal--visible');
            $('#upload-main-preview').addClass('c-croppie__preview--visible')
        });
    });
    
    $croppieSearch = $('#croppie-search').croppie({
        enableExif: true,
        viewport: {
            width: 420,
            height: 222
        },
        boundary: {
            width: 500,
            height: 300
        }
    });
    
    $('#croppie-btn-search').click(function(){
        $('#modal-search').addClass('c-croppie__modal--visible');
    });
    
    $('#upload-search').on('change', function () { 
        var reader = new FileReader();
        reader.onload = function (e) {
            $croppieSearch.croppie('bind', {
                url: e.target.result
            }).then(function(){
                console.log('search');
            });
        }
        reader.readAsDataURL(this.files[0]);
    });
    
    $('#croppie-upload-search').on('click', function(ev) {   
        $croppieSearch.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response) {
            $.ajax({
                url: "../handlers/save-uploaded-img.handlers.php",
                type: "POST",
                data: {
                    "image": response,
                    "type": type
                },
                success: function(data) {
                    html = '<img src="' + response + '" />';
                    $("#upload-search-preview").html(html);
                    $("#image-search-post").attr('value', data); 
                }
            });
            $('.c-croppie__modal').removeClass('c-croppie__modal--visible');
            $('#upload-search-preview').addClass('c-croppie__preview--visible')
        });
    });
    
    $croppieDetail = $('#croppie-detail').croppie({
        enableExif: true,
        viewport: {
            width: 1366,
            height: 500
        },
        boundary: {
            width: 1400,
            height: 600
        }
    });
    
    $('#croppie-btn-detail').click(function(){
        $('#modal-detail').addClass('c-croppie__modal--visible');
    });
    
    $('#upload-detail').on('change', function () { 
        var reader = new FileReader();
        reader.onload = function (e) {
            $croppieDetail.croppie('bind', {
                url: e.target.result
            }).then(function(){
                console.log('detail');
            });
        }
        reader.readAsDataURL(this.files[0]);
    });
    
    $('#croppie-upload-detail').on('click', function(ev) {   
        $croppieDetail.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response) {
            $.ajax({
                url: "../handlers/save-uploaded-img.handlers.php",
                type: "POST",
                data: {
                    "image": response,
                    "type": type
                },
                success: function(data) {
                    html = '<img src="' + response + '" />';
                    $("#upload-detail-preview").html(html);
                    $("#image-detail-post").attr('value', data); 
                }
            });
            $('.c-croppie__modal').removeClass('c-croppie__modal--visible');
            $('#upload-detail-preview').addClass('c-croppie__preview--visible')
        });
    });
});
