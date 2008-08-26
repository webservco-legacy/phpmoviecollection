<h1><?php echo $lang['categ']['view']; ?></h1>
<div style="float: right">
<img src="<?php echo _APP_URL;?>lib/thumb.php?img=<?php echo _APP_DIR; ?>var/pic_cat/<?php echo $cnt['cat_pic']; ?>&amp;max=50" />
</div>
<form enctype="multipart/form-data" id="categ_add_form" name="categ_add_form" action="" method="post">
<div class="clear">
<label for="cat_tt" class="required"><?php echo $lang['categ']['tt']; ?></label>
<input id="cat_tt" name="cat_tt" type="text" size="30" maxlength="50" value="<?php echo $cnt['cat_tt']; ?>" />
</div>
<div class="clear">
<input id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" type="hidden" value="512000" />
<label for="cat_pic"><?php echo $lang['categ']['pic']; ?>
</label>
<input id="cat_pic" name="cat_pic" type="file" />
</div>
<div class="clear">
<label for="cat_desc"><?php echo $lang['categ']['dsc']; ?></label>
<input id="cat_desc" name="cat_desc" type="text" size="50" maxlength="255" value="<?php echo $cnt['cat_desc']; ?>" />
</div>
<div class="clear">
<label for="cat_add">&#160;</label>
<input id="cat_add" name="cat_mod" type="submit" value="<?php echo $lang['categ']['cat_mod']; ?>" />
</div>
</form>
<?php echo $cnt['cat_pic']; ?>