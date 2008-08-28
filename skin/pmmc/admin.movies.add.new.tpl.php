<h1><?php echo $lang['movie']['add']; ?></h1>
<form enctype="multipart/form-data" id="movie_add_form" name="movie_add_form" action="" method="post">

<div class="clear">
<label for="cat_tt" class="required"><?php echo $lang['pmmc']['tt']; ?></label>
<input id="cat_tt" name="cat_tt" type="text" size="30" maxlength="50" value="<?php echo $cnt['mov_tt']; ?>" />
</div>
<div class="clear">
<input id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" type="hidden" value="512000" />
<label for="cat_pic"><?php echo $lang['pmmc']['pic']; ?></label>
<input id="cat_pic" name="cat_pic" type="file" />
</div>
<div class="clear">
<label for="cat_desc" class="required"><?php echo $lang['pmmc']['desc']; ?></label>
<input id="cat_desc" name="cat_desc" type="text" size="50" maxlength="255" value="<?php echo $cnt['mov_year']; ?>" />
</div>

<div class="clear">
<?php echo $lang['genre']['genres']; ?><br />
<?php
$tg = count($cnt['genres']);
for($i=0;$i<$tg;$i++) {
$chk[$i] = '';
if($cnt['genre'][$cnt['genres'][$i]] == 1) {$chk[$i] = ' checked="checked"';}
 ?>
<div class="genrehold">
<input id="genres_<?php echo $cnt['genres'][$i]; ?>" name="genres_<?php echo $cnt['genres'][$i]; ?>" class="genres" type="checkbox"<?php echo $chk[$i]; ?> />
<label for="genres_<?php echo $cnt['genres'][$i]; ?>" class="genres"><?php echo $cnt['genrett'][$cnt['genres'][$i]]; ?></label>
</div>
<?php } ?>
</div>



<div class="clear">
<label for="mov_add">&#160;</label>
<input id="mov_add" name="mov_add" type="submit" value="<?php echo $lang['pmmc']['add']; ?>" />
</div>
</form>