<h1><?php echo $lang['movie']['details']; ?></h1>
<form enctype="multipart/form-data" id="movie_imdb_form" name="movie_imdb_form" action="" method="post">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
  <td class="label">
  <label for="imdb_url"><?php echo $lang['imdb']['url'];?></label>
  </td>
  <td class="input">
  <input id="imdb_url" name="imdb_url" type="text" size="37" maxlength="37" value="" /><input id="mov_imdb_fetch" name="mov_imdb_fetch" type="submit" value="<?php echo $lang['imdb']['fetch']; ?>" />
  </td>
</tr>
</table>
</form>

<div style="float: right">
<?php echo pmc_image_thumb($cnt['mov_pic'], 'var/pic_mov/', $cnt['mov_tt']); ?>
</div> 

<form enctype="multipart/form-data" id="movie_add_form" name="movie_add_form" action="" method="post">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
  <td class="label">
<label for="cat_id" class="required"><?php echo $lang['categ']['categ']; ?></label>  
  </td>
  <td class="input">
<select id="cat_id" name="cat_id" size="1">
  <option value="0"><?php echo $lang['pmc']['select']; ?></option>
<?php
$tc = count($cnt['categs']['id']);
if($tc > 0) {
  for($j=1;$j<=$tc;$j++) {
  $sel[$j] = '';
  if($cnt['categs']['id'][$j] == $cnt['cat_id']) {$sel[$j] = ' selected="selected"';}
?>
  <option value="<?php echo $cnt['categs']['id'][$j]; ?>"<?php echo $sel[$j]; ?>><?php echo $cnt['categs']['tt'][$j]; ?></option>
<?php
  }
}
?>
</select>  
  </td>
</tr>
<tr>
  <td class="label">
  <label for="med_id"><?php echo $lang['media']['media']; ?></label>
  </td>
  <td class="input">
<select id="med_id" name="med_id" size="1">
  <option value="0"><?php echo $lang['media']['nomedia']; ?></option>
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
  </td>
</tr>
<tr>
  <td class="label">
  <label for="mov_cat"><?php echo $lang['movie']['catno']; ?></label>
  </td>
  <td class="input">
  <input id="mov_cat" name="mov_cat" type="text" size="5" maxlength="15" value="<?php echo $cnt['mov_cat']; ?>" />
  </td>
</tr>
<tr>
  <td class="label">
<input id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" type="hidden" value="1024000" />
<label for="mov_pic"><?php echo $lang['pmc']['pic']; ?></label>  
  </td>
  <td class="input">
<input id="mov_pic" name="mov_pic" type="file" />  
  </td>
</tr>
<tr>
  <td class="label">
 <label for="mov_imdb"><?php echo $lang['movie']['imdb']; ?></label> 
  </td>
  <td class="input">
 <input id="mov_imdb" name="mov_imdb" type="text" size="8" maxlength="8" value="<?php echo $cnt['mov_imdb']; ?>" /> 
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_tt_pre"><?php echo $lang['pmc']['ttpre']; ?></label>  
  </td>
  <td class="input">
<input id="mov_tt_pre" name="mov_tt_pre" type="text" size="3" maxlength="5" value="<?php echo $cnt['mov_tt_pre']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_tt" class="required"><?php echo $lang['pmc']['tt']; ?></label>  
  </td>
  <td class="input">
<input id="mov_tt" name="mov_tt" type="text" size="40" maxlength="150" value="<?php echo $cnt['mov_tt']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_aka"><?php echo $lang['movie']['aka']; ?></label>  
  </td>
  <td class="input">
<input id="mov_aka" name="mov_aka" type="text" size="40" maxlength="255" value="<?php echo $cnt['mov_aka']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_year"><?php echo $lang['pmc']['year']; ?></label>  
  </td>
  <td class="input">
<input id="mov_year" name="mov_year" type="text" size="4" maxlength="4" value="<?php echo $cnt['mov_year']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_country"><?php echo $lang['pmc']['country']; ?></label>  
  </td>
  <td class="input">
<input id="mov_country" name="mov_country" type="text" size="20" maxlength="30" value="<?php echo $cnt['mov_country']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_language"><?php echo $lang['pmc']['language']; ?></label>  
  </td>
  <td class="input">
<input id="mov_language" name="mov_language" type="text" size="20" maxlength="30" value="<?php echo $cnt['mov_language']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_dir"><?php echo $lang['movie']['director']; ?></label>  
  </td>
  <td class="input">
<input id="mov_dir" name="mov_dir" type="text" size="30" maxlength="150" value="<?php echo $cnt['mov_dir']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_wrt"><?php echo $lang['movie']['writer']; ?></label>  
  </td>
  <td class="input">
<input id="mov_wrt" name="mov_wrt" type="text" size="30" maxlength="150" value="<?php echo $cnt['mov_wrt']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_tag"><?php echo $lang['movie']['tagline']; ?></label>  
  </td>
  <td class="input">
<input id="mov_tag" name="mov_tag" type="text" size="40" maxlength="255" value="<?php echo $cnt['mov_tag']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_plot"><?php echo $lang['movie']['plot']; ?></label>  
  </td>
  <td class="input">
<input id="mov_plot" name="mov_plot" type="text" size="40" maxlength="255" value="<?php echo $cnt['mov_plot']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_cast"><?php echo $lang['movie']['cast']; ?></label>  
  </td>
  <td class="input">
<input id="mov_cast" name="mov_cast" type="text" size="40" maxlength="255" value="<?php echo $cnt['mov_cast']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
<?php echo $lang['genre']['genres']; ?>  
  </td>
  <td class="input">
&#160;
  </td>
</tr>
<tr>
  <td class="input" colspan="2">
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
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_format"><?php echo $lang['movie']['mformat']; ?></label>
  </td>
  <td class="input">
<select id="mov_format" name="mov_format" size="1">
  <option value="0"><?php echo $lang['movie']['noformat']; ?></option>
  <option value="1"<?php if($cnt['mov_format'] == 1) {echo 'selected="selected"';} ?>><?php echo $lang['movie']['format'][1]; ?></option>
  <option value="2"<?php if($cnt['mov_format'] == 2) {echo 'selected="selected"';} ?>><?php echo $lang['movie']['format'][2]; ?></option>
  <option value="3"<?php if($cnt['mov_format'] == 3) {echo 'selected="selected"';} ?>><?php echo $lang['movie']['format'][3]; ?></option>
</select>  
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_subs"><?php echo $lang['movie']['subs']; ?></label>  
  </td>
  <td class="input">
<input id="mov_subs" name="mov_subs" type="text" size="40" maxlength="255" value="<?php echo $cnt['mov_subs']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
<label for="mov_notes"><?php echo $lang['pmc']['notes']; ?></label>  
  </td>
  <td class="input">
<input id="mov_notes" name="mov_notes" type="text" size="40" maxlength="255" value="<?php echo $cnt['mov_notes']; ?>" />  
  </td>
</tr>
<tr>
  <td class="label">
&#160;
  </td>
  <td class="input">
<input id="mov_mod" name="mov_mod" type="submit" value="<?php echo $lang['pmc']['mod']; ?>" />  
  </td>
</tr>
</table>
</form>