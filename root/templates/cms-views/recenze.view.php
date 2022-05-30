<form enctype="multipart/form-data" action="../handlers/post.handler.php" method="post">
    <div class="form-group">
        <label>Nadpis</label>
        <input  type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label>Intro</label>
        <input  type="text" class="form-control" name="intro">
    </div>                                                 
    <div class="form-group">
        <label>Text</label>
        <textarea  id="summernote" style="height: 300px" class="form-control" name="content"></textarea>
    </div>
    <div class="form-group">
        <label>Hodnocení</label>
        <input type="text" class="form-control input-mini" name="rating">
    </div>   
    <div class="form-group cms-slider">
        <label>Slider <br> <i>do textu vlož: #slider#</i></label>
        <input multiple type="file" name="slider[]">
    </div>
    <div class="form-group">
        <label id="croppie-btn-main" class="c-croppie__button btn" for="upload-main">Náhled na titulce</label>
        <input id="upload-main" class="c-croppie__input" type="file">
    </div>
    <div id="modal-main" class="c-croppie__modal">
        <div class="c-croppie__modal-container">
            <div id="croppie-main"></div>
            <div id="croppie-upload-main" class="c-croppie__button btn">Nahrát obrázek</div>
        </div>
    </div>
    <div id="upload-main-preview" class="c-croppie__preview c-croppie__preview--main"></div>
    <input type="hidden" id="image-main-post" name="image-main-post">
    <div class="form-group">
        <label id="croppie-btn-search" class="c-croppie__button btn" for="upload-search">Náhled ve vyhledávání</label>
        <input id="upload-search" class="c-croppie__input" type="file">
    </div>
    <div id="modal-search" class="c-croppie__modal">
        <div class="c-croppie__modal-container">
            <div id="croppie-search"></div>
            <div id="croppie-upload-search" class="c-croppie__button btn">Nahrát obrázek</div>
        </div>
    </div>
    <div id="upload-search-preview" class="c-croppie__preview c-croppie__preview--search"></div>
    <input type="hidden" id="image-search-post" name="image-search-post">

    <div class="form-group">
        <label id="croppie-btn-detail" class="c-croppie__button btn" for="upload-detail">Hlavní obrázek v detailu příspěvku</label>
        <input id="upload-detail" class="c-croppie__input" type="file">
    </div>
    <div id="modal-detail" class="c-croppie__modal">
        <div class="c-croppie__modal-container">
            <div id="croppie-detail"></div>
            <div id="croppie-upload-detail" class="c-croppie__button btn">Nahrát obrázek</div>
        </div>
    </div>
    <div id="upload-detail-preview" class="c-croppie__preview c-croppie__preview--detail"></div>
    <input type="hidden" id="image-detail-post" name="image-detail-post">
    <div class="form-group">
        <label>Datum / Čas vydání</label>
        <input class="form-control input-datetime" type="datetime-local" name="datum">
    </div>
    <div class="form-group">
        <label>Tagy</label>
        <input  type="text" class="form-control" id="first_name" name="tags">
    </div>
    <input type="hidden" name="type" value="recenze">
    <button type="submit" type="button" class="btn btn-default cms-submit">Potvrdit</button>
</form>
<script>
    var type = 'recenze';
</script>