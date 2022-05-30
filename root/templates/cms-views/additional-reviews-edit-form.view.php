<?php 
    $CmsView = new App\Views\CmsView;
    $data = $CmsView->showAdditionalReviewsData($_GET['id'])[0];
    $url = $data['url'];
    $rating = $data['rating'];
    $content = $data['content'];
?>
<form enctype="multipart/form-data" action="../handlers/post-edit.handler.php" method="post">
    <div class="form-group">
        <label>Url hlavní recenze</label>
        <input type="text" class="form-control" name="url" value="<?php echo $url; ?>">
    </div>                                  
    <div class="form-group">
        <label>Text</label>
        <textarea  id="summernote" style="height: 300px" class="form-control" name="content" value="<?php echo $content; ?>"></textarea>
    </div>
    <div class="form-group">
        <label>Hodnocení</label>
        <input type="text" class="form-control input-mini" name="rating" value="<?php echo $rating; ?>">
    </div>
    <input type="hidden" name="type" value="additional_reviews">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <button type="submit" type="button" class="btn btn-default cms-submit">Potvrdit</button>
</form>