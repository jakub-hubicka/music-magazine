<?php 
    $CmsView = new App\Views\CmsView;
    $data = $CmsView->showEventsData($_GET['id'])[0];
    $title = $data['title'];   
    $image = $data['image'];
    $image_reference = $data['image_reference'];
    $img_main = $data['img_main'];
    $body = $data['text'];
    $where = $data['venue'];
    $when = $data['date'];
    $time = $data['time'];
    $tags = $data['tags'];
    $url_path = $data['url_path'];
?>
<form enctype="multipart/form-data" action="../handlers/post-edit.handler.php" method="post">
    <div class="form-group">
        <label>Nadpis</label>
        <input require_onced type="text" class="form-control" name="title" value="<?php echo $title; ?>">
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
        <label>Kde</label>
        <input type="text" name="where" value="<?php echo $where; ?>">
    </div>
     <div class="form-group">
        <label>Kdy</label>
        <input type="text" name="when" value="<?php echo $when; ?>">
    </div>
     <div class="form-group">
        <label>Čas</label>
        <input type="text" name="time" value="<?php echo $time; ?>">
    </div>
    <div class="form-group">
        <label>Tagy</label>
        <input require_onced type="text" class="form-control" id="first_name" name="tags" value="<?php echo $tags; ?>">
    </div>
    <input type="hidden" name="type" value="event">
    <input type="hidden" name="oldimage" value="<?php echo $image; ?>">
    <input type="hidden" name="oldimageref" value="<?php echo $image_reference; ?>">
    <input type="hidden" name="oldimgmain" value="<?php echo $img_main; ?>">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input type="hidden" name="url_path" value="<?php echo $url_path; ?>">
    <button type="submit" type="button" class="btn btn-default cms-submit">Potvrdit</button>
</form>