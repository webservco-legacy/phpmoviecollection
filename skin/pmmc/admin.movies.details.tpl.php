<h1><?php echo $lang['movie']['details']; ?></h1>
<form enctype="multipart/form-data" id="movie_imdb_form" name="movie_imdb_form" action="" method="post">
<div class="clear">
<label for="imdb_url"><?php echo $lang['imdb']['url'];?></label>
<input id="imdb_url" name="imdb_url" type="text" size="37" maxlength="37" value="" />
<input id="mov_imdb_fetch" name="mov_imdb_fetch" type="submit" value="<?php echo $lang['imdb']['fetch']; ?>" />
</div>
</form>

<div style="float: right">
<?php echo pmmc_image_thumb($cnt['mov_pic'], 'var/pic_mov/', $cnt['mov_tt']); ?>
</div>


<form enctype="multipart/form-data" id="movie_mod_form" name="movie_mod_form" action="" method="post">

<div class="clear">
<label for="cat_id" class="required"><?php echo $lang['categ']['categ']; ?></label>
<select id="cat_id" name="cat_id" size="q">
  <option value="0"><?php echo $lang['pmmc']['select']; ?></option>
<?php
$tc = count($cnt['categs']['id']);
if($tc > 0) {
  for($j=0;$j<$tc;$j++) {
  $sel[$j] = '';
  if($cnt['categs']['id'][$j] == $cnt['cat_id']) {$sel[$j] = ' selected="selected"';}
?>
  <option value="<?php echo $cnt['categs']['id'][$j]; ?>"<?php echo $sel[$j]; ?>><?php echo $cnt['categs']['tt'][$j]; ?></option>
<?php
  }
}
?>
</select>
</div>

<div class="clear">
<input id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" type="hidden" value="1024000" />
<label for="mov_pic"><?php echo $lang['pmmc']['pic']; ?></label>
<input id="mov_pic" name="mov_pic" type="file" />
</div>

<div class="clear">
<label for="mov_imdb"><?php echo $lang['movie']['imdb']; ?></label>
<input id="mov_imdb" name="mov_imdb" type="text" size="8" maxlength="8" value="<?php echo $cnt['mov_imdb']; ?>" />
</div>

<div class="clear">
<label for="mov_tt_pre"><?php echo $lang['pmmc']['ttpre']; ?></label>
<input id="mov_tt_pre" name="mov_tt_pre" type="text" size="3" maxlength="5" value="<?php echo $cnt['mov_tt_pre']; ?>" />
</div>

<div class="clear">
<label for="mov_tt" class="required"><?php echo $lang['pmmc']['tt']; ?></label>
<input id="mov_tt" name="mov_tt" type="text" size="50" maxlength="150" value="<?php echo $cnt['mov_tt']; ?>" />
</div>

<div class="clear">
<label for="mov_aka"><?php echo $lang['movie']['aka']; ?></label>
<input id="mov_aka" name="mov_aka" type="text" size="50" maxlength="255" value="<?php echo $cnt['mov_aka']; ?>" />
</div>

<div class="clear">
<label for="mov_year"><?php echo $lang['pmmc']['year']; ?></label>
<input id="mov_year" name="mov_year" type="text" size="4" maxlength="4" value="<?php echo $cnt['mov_year']; ?>" />
</div>

<div class="clear">
<label for="mov_country"><?php echo $lang['pmmc']['country']; ?></label>
<input id="mov_country" name="mov_country" type="text" size="20" maxlength="30" value="<?php echo $cnt['mov_country']; ?>" />
</div>

<div class="clear">
<label for="mov_language"><?php echo $lang['pmmc']['language']; ?></label>
<input id="mov_language" name="mov_language" type="text" size="20" maxlength="30" value="<?php echo $cnt['mov_language']; ?>" />
</div>

<div class="clear">
<label for="mov_dir"><?php echo $lang['movie']['director']; ?></label>
<input id="mov_dir" name="mov_dir" type="text" size="30" maxlength="150" value="<?php echo $cnt['mov_dir']; ?>" />
</div>

<div class="clear">
<label for="mov_wrt"><?php echo $lang['movie']['writer']; ?></label>
<input id="mov_wrt" name="mov_wrt" type="text" size="30" maxlength="150" value="<?php echo $cnt['mov_wrt']; ?>" />
</div>


<div class="clear">
<label for="mov_tag"><?php echo $lang['movie']['tagline']; ?></label>
<input id="mov_tag" name="mov_tag" type="text" size="50" maxlength="255" value="<?php echo $cnt['mov_tag']; ?>" />
</div>

<div class="clear">
<label for="mov_plot"><?php echo $lang['movie']['plot']; ?></label>
<input id="mov_plot" name="mov_plot" type="text" size="50" maxlength="255" value="<?php echo $cnt['mov_plot']; ?>" />
</div>

<div class="clear">
<label for="mov_cast"><?php echo $lang['movie']['cast']; ?></label>
<input id="mov_cast" name="mov_cast" type="text" size="50" maxlength="255" value="<?php echo $cnt['mov_cast']; ?>" />
</div>

<div class="clear">
<label for="mov_notes"><?php echo $lang['pmmc']['notes']; ?></label>
<input id="mov_notes" name="mov_notes" type="text" size="50" maxlength="255" value="<?php echo $cnt['mov_notes']; ?>" />
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
<label for="mov_mod">&#160;</label>
<input id="mov_mod" name="mov_mod" type="submit" value="<?php echo $lang['pmmc']['mod']; ?>" />
</div>
</form>