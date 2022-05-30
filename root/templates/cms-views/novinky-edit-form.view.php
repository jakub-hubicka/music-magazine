<?php 
    $CmsView = new App\Views\CmsView;
    $newsData = $CmsView->showNewsData($_GET['id'])[0];
    $title = $newsData['title'];
    $intro = $newsData['intro'];
    $image = $newsData['image'];
    $image_reference = $newsData['image_reference'];
    $img_main = $newsData['img_main'];
    $body = $newsData['body'];
    $tags = $newsData['tags'];
    $url_path = $newsData['url_path'];
?>
<form enctype="multipart/form-data" action="../handlers/post-edit.handler.php" method="post">
    <div class="form-group">
        <label>Nadpis</label>
        <input require_onced type="text" class="form-control" name="title" value="<?php echo $title; ?>">
    </div>
    <div class="form-group">
        <label>Intro</label>
        <input type="text" class="form-control" name="intro" value="<?php echo strip_tags($intro); ?>">
    </div>                                                 
    <div class="form-group">
        <label>Text</label>
        <textarea require_onced id="summernote" style="height: 300px" class="form-control" name="content"><?php echo $body ?></textarea>
    </div>
    <div class="form-group">
        <label>Náhled na titulce</label>
        <input type="file" name="imageMain">
    </div>      
    <div class="form-group">
        <label>Náhled ve vyhledávání</label>
        <input type="file" name="imageSmall">
    </div>       
    <div class="form-group">
        <label>Hlavní obrázek v detailu příspěvku</label>
        <input type="file" name="imageLarge">
    </div>
    <div class="form-group">
        <label>Tagy</label>
        <input require_onced type="text" class="form-control" id="first_name" name="tags" value="<?php echo $tags; ?>">
    </div>
    <input type="hidden" name="type" value="novinka">
    <input type="hidden" name="oldimage" value="<?php echo $image; ?>">
    <input type="hidden" name="oldimageref" value="<?php echo $image_reference; ?>">
    <input type="hidden" name="oldimgmain" value="<?php echo $img_main; ?>">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input type="hidden" name="url_path" value="<?php echo $url_path; ?>">
    <button type="submit" type="button" class="btn btn-default cms-submit">Potvrdit</button>
</form>