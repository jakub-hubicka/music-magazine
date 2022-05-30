<form enctype="multipart/form-data" action="../handlers/post.handler.php" method="post">
    <div class="form-group">
        <label>Nadpis</label>
        <input require_onced type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label>Místo</label>
        <input require_onced type="text" class="form-control" name="venue">
    </div>
    <div class="form-group">
        <label>Datum akce</label>
        <input require_onced type="text" class="form-control" name="eventDate">
    </div>
    <div class="form-group">
        <label>Galerie</label>
        <input multiple require_onced type="file" name="galerie[]">
    </div>       
    <div class="form-group">
        <label>Náhled na titulce</label>
        <input require_onced type="file" name="imageSmall">
    </div>
    <div class="form-group">
        <label>Tagy</label>
        <input require_onced type="text" class="form-control" id="first_name" name="tags">
    </div>
    <input type="hidden" name="type" value="galerie">
    <button type="submit" type="button" class="btn btn-default cms-submit">Potvrdit</button>
</form>