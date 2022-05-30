<form enctype="multipart/form-data" action="../handlers/post.handler.php" method="post">
    <div class="form-group">
        <label>Url hlavní recenze</label>
        <input type="text" class="form-control" name="url">
    </div>                                  
    <div class="form-group">
        <label>Text</label>
        <textarea  id="summernote" style="height: 300px" class="form-control" name="content"></textarea>
    </div>
    <div class="form-group">
        <label>Hodnocení</label>
        <input type="text" class="form-control input-mini" name="rating">
    </div>
    <input type="hidden" name="type" value="additional_reviews">
    <button type="submit" type="button" class="btn btn-default cms-submit">Potvrdit</button>
</form>
<script>
    var type = 'additional_reviews';
</script>