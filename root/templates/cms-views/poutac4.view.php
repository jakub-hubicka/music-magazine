<form enctype="multipart/form-data" action="../handlers/cube.handler.php" method="post">
    <div class="form-group">
        <label>Datum</label>
        <input require_onced type="text" class="form-control" name="date">
    </div>
    <div class="form-group">
        <label>Nadpis</label>
        <input require_onced type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label>Menší text</label>
        <input require_onced type="text" class="form-control" name="shortText">
    </div>
    <div class="form-group">
        <label>Obsah po rozkliknutí (link)</label>
        <input require_onced type="text" class="form-control" name="link">
    </div>
    <div class="form-group">
        <label id="croppie-btn" class="c-croppie__button c-croppie__button--v2" for="upload">Nahrát obrázek</label>
        <input id="upload" class="c-croppie__input" type="file">
    </div>
    <div id="modal" class="c-croppie__modal">
        <div class="c-croppie__modal-container">
            <div id="croppie"></div>
            <div id="croppie-upload" class="c-croppie__button c-croppie__button--main">Potvrdit</div>
        </div>
    </div>
    <div id="upload-preview" class="c-croppie__preview c-croppie__preview--banner"></div>
    <input type="hidden" id="image" name="image">

    <input type="hidden" name="type" value="4">
    <button type="submit" type="button" class="btn btn-default cms-submit">Potvrdit</button>

    <script>var poutac = 4;</script>
    <script src="js/banner.js"></script>
</form>