<h1><?php echo $lang['movie']['add']; ?></h1>

<?php if(_APP_IMDBD == 1) { ?>
<form enctype="multipart/form-data" id="movie_imdb_form" name="movie_imdb_form" action="" method="post">
<label for="imdb_url"><?php echo $lang['imdb']['url'];?></label>
<input id="imdb_url" name="imdb_url" type="text" size="37" maxlength="37" value="" />

<div class="clearer"></div>
<div class="label">&#160;</div>
<input id="mov_imdb_fetch" name="mov_imdb_fetch" type="submit" value="<?php echo $lang['imdb']['fetch']; ?>" />
</form>
<?php } ?>

<div class="clearer"></div>
<form enctype="multipart/form-data" id="movie_add_form" name="movie_add_form" action="" method="post">
<label for="cat_id" class="required"><?php echo $lang['categ']['categ']; ?></label>  
<select id="cat_id" name="cat_id" size="1">
  <option value="0"><?php echo $lang['pmc']['select']; ?></option>
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

<div class="clearer"></div>
<label for="med_id"><?php echo $lang['media']['media']; ?></label>
<select id="med_id" name="med_id" size="1">
  <option value="0"><?php echo $lang['media']['media']; ?></option>
<?php
$tm = count($cnt['media']['id']);
if($tm > 0) {
  for($k=1;$k<=$tm;$k++) {
  $sel[$k] = '';
  if($cnt['media']['id'][$k] == $cnt['med_id']) {$sel[$k] = ' selected="selected"';}
?>
  <option value="<?php echo $cnt['media']['id'][$k]; ?>"<?php echo $sel[$k]; ?>><?php echo $cnt['media']['tt'][$k]; ?></option>
<?php
  }
}
?>
</select>

<div class="clearer"></div>
<label for="mov_cat"><?php echo $lang['movie']['catno']; ?></label>
<input id="mov_cat" name="mov_cat" type="text" size="5" maxlength="15" value="<?php echo $cnt['mov_cat']; ?>" />
&#160;(<?php echo $lang['movie']['last']; ?>:&#160;<?php echo $cnt['mov_cat_last']; ?>)
<input id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" type="hidden" value="1024000" />

<div class="clearer"></div>
<label for="mov_pic"><?php echo $lang['pmc']['pic']; ?></label>  
<input id="mov_pic" name="mov_pic" type="file" />

<?php if(_APP_IMDBD == 1 && _APP_IMDBP == 1) { ?>
<?php
$tpi = count($_SESSION['pmc_imdb_pics']);
if($tpi > 0) {
?>
<div class="clearer"></div>
<div class="label">
<select id="mov_imdb_pic" name="mov_imdb_pic" size="1">
<?php
  for($i=0;$i<$tpi;$i++) {
?>  
<option value="<?php echo $i; ?>"<?php if($cnt['mov_imdb_pic'] == $i) {echo ' selected="selected"';} ?>><?php echo $i; ?></option>
<?php
  }
?>
<option value="">---</option>
</select>
</div>
<div class="input">
<?php
  for($j=0;$j<$tpi;$j++) {
?>
<div class="movimbdpic">
<img src="<?php echo _APP_WWW; ?>lib/imdbpic.php?pic=<?php echo $_SESSION['pmc_imdb_pics'][$j]; ?>" height="80" alt="imdb_pic" title="imdb_pic" />
<br />
<?php echo $j; ?>
</div>
<?php
  }
?>
</div>
<?php  
}
?>
<?php } ?>

<div class="clearer"></div>
<label for="mov_imdb"><?php echo $lang['movie']['imdb']; ?></label> 
<input id="mov_imdb" name="mov_imdb" type="text" size="8" maxlength="8" value="<?php echo $cnt['mov_imdb']; ?>" /> 

<div class="clearer"></div>
<label for="mov_tt_pre"><?php echo $lang['pmc']['ttpre']; ?></label>  
<input id="mov_tt_pre" name="mov_tt_pre" type="text" size="3" maxlength="5" value="<?php echo $cnt['mov_tt_pre']; ?>" />  

<div class="clearer"></div>
<label for="mov_tt" class="required"><?php echo $lang['pmc']['tt']; ?></label>  
<input id="mov_tt" name="mov_tt" type="text" size="38" maxlength="150" value="<?php echo $cnt['mov_tt']; ?>" />

<div class="clearer"></div>
<label for="mov_typ"><?php echo $lang['movie']['type']; ?></label>
<select id="mov_typ" name="mov_typ" size="1">
  <option value="0"<?php if($cnt['mov_typ'] == 0) {echo ' selected="selected"';} ?>><?php echo $lang['movie']['typ'][0]; ?></option>
  <option value="1"<?php if($cnt['mov_typ'] == 1) {echo ' selected="selected"';} ?>><?php echo $lang['movie']['typ'][1]; ?></option>
  <option value="2"<?php if($cnt['mov_typ'] == 2) {echo ' selected="selected"';} ?>><?php echo $lang['movie']['typ'][2]; ?></option>
</select>

<div class="clearer"></div>
<label for="mov_aka"><?php echo $lang['movie']['aka']; ?></label>  
<input id="mov_aka" name="mov_aka" type="text" size="38" maxlength="255" value="<?php echo $cnt['mov_aka']; ?>" />  

<div class="clearer"></div>
<label for="mov_year"><?php echo $lang['pmc']['year']; ?></label>  
<input id="mov_year" name="mov_year" type="text" size="4" maxlength="4" value="<?php echo $cnt['mov_year']; ?>" />  

<div class="clearer"></div>
<label for="mov_country"><?php echo $lang['pmc']['country']; ?></label>  
<input id="mov_country" name="mov_country" type="text" size="20" maxlength="30" value="<?php echo $cnt['mov_country']; ?>" />  

<div class="clearer"></div>
<label for="mov_language"><?php echo $lang['pmc']['language']; ?></label>  
<input id="mov_language" name="mov_language" type="text" size="20" maxlength="30" value="<?php echo $cnt['mov_language']; ?>" />  

<div class="clearer"></div>
<label for="mov_dir"><?php echo $lang['movie']['director']; ?></label>  
<input id="mov_dir" name="mov_dir" type="text" size="30" maxlength="150" value="<?php echo $cnt['mov_dir']; ?>" />  

<div class="clearer"></div>
<label for="mov_wrt"><?php echo $lang['movie']['writer']; ?></label>  
<input id="mov_wrt" name="mov_wrt" type="text" size="30" maxlength="150" value="<?php echo $cnt['mov_wrt']; ?>" />  

<div class="clearer"></div>
<label for="mov_tag"><?php echo $lang['movie']['tagline']; ?></label>  
<input id="mov_tag" name="mov_tag" type="text" size="38" maxlength="255" value="<?php echo $cnt['mov_tag']; ?>" />  

<div class="clearer"></div>
<label for="mov_plot"><?php echo $lang['movie']['plot']; ?></label>  
<input id="mov_plot" name="mov_plot" type="text" size="38" maxlength="255" value="<?php echo $cnt['mov_plot']; ?>" />  

<div class="clearer"></div>
<label for="mov_cast"><?php echo $lang['movie']['cast']; ?></label>  
<input id="mov_cast" name="mov_cast" type="text" size="38" maxlength="255" value="<?php echo $cnt['mov_cast']; ?>" />  

<div class="clearer"></div>
<div class="label">
<?php echo $lang['genre']['genres']; ?>  
</div>

<div class="clearer"></div>
<?php
$tg = count($cnt['genres']);
for($i=0;$i<$tg;$i++) {
$chk[$i] = '';
if($cnt['genre'][$cnt['genres'][$i]] == 1) {$chk[$i] = ' checked="checked"';}
 ?>
<div class="genrehold">
<table border="0" cellpadding="0" cellspacing="0" class="genres">
<tr><td>
<input id="genres_<?php echo $cnt['genres'][$i]; ?>" name="genres_<?php echo $cnt['genres'][$i]; ?>" class="genres" type="checkbox"<?php echo $chk[$i]; ?> />
</td><td>
<label for="genres_<?php echo $cnt['genres'][$i]; ?>" class="genres"><?php echo $cnt['genrett'][$cnt['genres'][$i]]; ?></label>
</td>
</tr>
</table>
</div>
<?php } ?>

<div class="clearer"></div>
<label for="mov_format"><?php echo $lang['movie']['mformat']; ?></label>
<select id="mov_format" name="mov_format" size="1">
  <option value="0"><?php echo $lang['movie']['noformat']; ?></option>
  <option value="1"<?php if($cnt['mov_format'] == 1) {echo ' selected="selected"';} ?>><?php echo $lang['movie']['format'][1]; ?></option>
  <option value="2"<?php if($cnt['mov_format'] == 2) {echo ' selected="selected"';} ?>><?php echo $lang['movie']['format'][2]; ?></option>
  <option value="3"<?php if($cnt['mov_format'] == 3) {echo ' selected="selected"';} ?>><?php echo $lang['movie']['format'][3]; ?></option>
</select>

<div class="clearer"></div>
<label for="mov_subs"><?php echo $lang['movie']['subs']; ?></label>  
<input id="mov_subs" name="mov_subs" type="text" size="38" maxlength="255" value="<?php echo $cnt['mov_subs']; ?>" />  

<div class="clearer"></div>
<label for="mov_notes"><?php echo $lang['pmc']['notes']; ?></label>  
<input id="mov_notes" name="mov_notes" type="text" size="38" maxlength="255" value="<?php echo $cnt['mov_notes']; ?>" />  

<div class="clearer"></div>
<div class="label">&#160;</div>
<input id="mov_add" name="mov_add" type="submit" value="<?php echo $lang['pmc']['add']; ?>" />
</form>