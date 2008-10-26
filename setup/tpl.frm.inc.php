<div id="frm">
<form enctype="multipart/form-data" id="setup_form" name="setup_form" action="" method="post">
<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
  <td class="label">
  &#160;
  </td>
  <td class="input">
  <h3>Application information</h3>
  </td>
</tr>
<tr>
 <td class="label">
 <label for="app_url">Application URL:</label>
 </td>
 <td class="input">
 <input id="app_url" name="app_url" type="text" size="45" maxlength="150" value="<?php echo $cfg['app_url']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="app_dir">Application Path:</label>
 </td>
 <td class="input">
 <input id="app_dir" name="app_dir" type="text" size="45" maxlength="150" value="<?php echo $cfg['app_dir']; ?>" />
 </td>
</tr>
<?php
if($mod_rewrite == 1 || $mod_rewrite == 2) {
?>
<tr>
 <td class="label">
 <label for="app_index">Remove "index.php" from application URL:</label>
 </td>
 <td class="input">
 <select id="app_index" name="app_index" size="1">
  <option value="0"<?php if($cfg['app_index'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['app_index'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<?php
}
?>
<tr>
  <td class="label">
  &#160;
  </td>
  <td class="input">
  <h3>Database information</h3>
  </td>
</tr>
<tr>
 <td class="label">
 <label for="db_host">Database host:</label>
 </td>
 <td class="input">
 <input id="db_host" name="db_host" type="text" size="20" maxlength="30" value="<?php echo $cfg['db_host']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="db_user">Database user:</label>
 </td>
 <td class="input">
 <input id="db_user" name="db_user" type="text" size="20" maxlength="30" value="<?php echo $cfg['db_user']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="db_pass">Database password:</label>
 </td>
 <td class="input">
 <input id="db_pass" name="db_pass" type="text" size="20" maxlength="30" value="<?php echo $cfg['db_pass']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="db_name">Database name:</label>
 </td>
 <td class="input">
 <input id="db_name" name="db_name" type="text" size="20" maxlength="30" value="<?php echo $cfg['db_name']; ?>" />
 </td>
</tr>

<tr>
  <td class="label">
  &#160;
  </td>
  <td class="input">
  <h3>Root User</h3>
  </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_name">Alias:</label>
 </td>
 <td class="input">
 <input id="usr_name" name="usr_name" type="text" size="20" maxlength="30" value="<?php echo $cfg['usr_name']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_fname">First name:</label>
 </td>
 <td class="input">
 <input id="usr_fname" name="usr_fname" type="text" size="20" maxlength="30" value="<?php echo $cfg['usr_fname']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_lname">Last name:</label>
 </td>
 <td class="input">
 <input id="usr_lname" name="usr_lname" type="text" size="20" maxlength="30" value="<?php echo $cfg['usr_lname']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_mail">Valid email:</label>
 </td>
 <td class="input">
 <input id="usr_mail" name="usr_mail" type="text" size="20" maxlength="30" value="<?php echo $cfg['usr_mail']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_pass">Password:</label>
 </td>
 <td class="input">
 <input id="usr_pass" name="usr_pass" type="text" size="20" maxlength="30" value="<?php echo $cfg['usr_pass']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_skin">Skin:</label>
 </td>
 <td class="input">
<select id="usr_skin" name="usr_skin" size="1">
<?php
$skins = pmc_lsdir('../skin/');
$ts = count($skins);
for($i=0;$i<$ts;$i++) {
?>
<option value="<?php echo $skins[$i]; ?>"<?php if($cfg['usr_skin'] == $skins[$i]) {echo ' selected="selected"';}?>><?php echo $skins[$i]; ?></option>
<?php
}
?>
</select> 
 </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_lang">Language:</label>
 </td>
 <td class="input">
<select id="usr_lang" name="usr_lang" size="1">
<?php
$langs = pmc_lsdir('../lang/');
$tl = count($langs);
for($j=0;$j<$tl;$j++) {
?>
<option value="<?php echo $langs[$j]; ?>"<?php if($cfg['usr_lang'] == $langs[$j]) {echo ' selected="selected"';}?>><?php echo $langs[$j]; ?></option>
<?php
}
?>
</select> 
 </td>
</tr>

<tr>
  <td class="label">
  &#160;
  </td>
  <td class="input">
  <h3>Application settings</h3>
  </td>
</tr>
<tr>
 <td class="label">
 <label for="app_lang">Language:</label>
 </td>
 <td class="input">
<select id="app_lang" name="app_lang" size="1">
<?php
//$langs = pmc_lsdir('../lang/');
//$tl = count($langs);
for($k=0;$k<$tl;$k++) {
?>
<option value="<?php echo $langs[$k]; ?>"<?php if($cfg['app_lang'] == $langs[$k]) {echo ' selected="selected"';}?>><?php echo $langs[$k]; ?></option>
<?php
}
?>
</select> 
 </td>
</tr>
<tr>
 <td class="label">
 <label for="app_skin">Skin:</label>
 </td>
 <td class="input">
<select id="app_skin" name="app_skin" size="1">
<?php
//$skins = pmc_lsdir('../skin/');
//$ts = count($skins);
for($l=0;$l<$ts;$l++) {
?>
<option value="<?php echo $skins[$l]; ?>"<?php if($cfg['app_skin'] == $skins[$l]) {echo ' selected="selected"';}?>><?php echo $skins[$l]; ?></option>
<?php
}
?>
</select> 
 </td>
</tr>
<tr>
 <td class="label">
 <label for="app_pcat">Category image thumbnail size:</label>
 </td>
 <td class="input">
 <input id="app_pcat" name="app_pcat" type="text" size="3" maxlength="4" value="<?php echo $cfg['app_pcat']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="app_pmov">Movie image thumbnail size:</label>
 </td>
 <td class="input">
 <input id="app_pmov" name="app_pmov" type="text" size="3" maxlength="4" value="<?php echo $cfg['app_pmov']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="app_imov">Number of movies per page:</label>
 </td>
 <td class="input">
 <input id="app_imov" name="app_imov" type="text" size="2" maxlength="5" value="<?php echo $cfg['app_imov']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="app_iusr">Number of users per page:</label>
 </td>
 <td class="input">
 <input id="app_iusr" name="app_iusr" type="text" size="3" maxlength="4" value="<?php echo $cfg['app_iusr']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="app_imed">Number of media per page:</label>
 </td>
 <td class="input">
 <input id="app_imed" name="app_imed" type="text" size="3" maxlength="4" value="<?php echo $cfg['app_imed']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="app_lmov">Number of latest movies to show</label>
 </td>
 <td class="input">
 <input id="app_lmov" name="app_lmov" type="text" size="3" maxlength="4" value="<?php echo $cfg['app_lmov']; ?>" />
 </td>
</tr>

<tr>
  <td class="label">
  &#160;
  </td>
  <td class="input">
  <h3>Load content modules</h3>
  </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_mnu">"Menu" module:</label>
 </td>
 <td class="input">
 <select id="mod_mnu" name="mod_mnu" size="1">
  <option value="0"<?php if($cfg['mod_mnu'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_mnu'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_usr">"User" module:</label>
 </td>
 <td class="input">
 <select id="mod_usr" name="mod_usr" size="1">
  <option value="0"<?php if($cfg['mod_usr'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_usr'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_login">"Login" module:</label>
 </td>
 <td class="input">
 <select id="mod_login" name="mod_login" size="1">
  <option value="0"<?php if($cfg['mod_login'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_login'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_gen">"Genres" module:</label>
 </td>
 <td class="input">
 <select id="mod_gen" name="mod_gen" size="1">
  <option value="0"<?php if($cfg['mod_gen'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_gen'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_src">"Search" module:</label>
 </td>
 <td class="input">
 <select id="mod_src" name="mod_src" size="1">
  <option value="0"<?php if($cfg['mod_src'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_src'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_imdb">"IMDb search" module:</label>
 </td>
 <td class="input">
 <select id="mod_imdb" name="mod_imdb" size="1">
  <option value="0"<?php if($cfg['mod_imdb'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_imdb'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_lst">"MyList" module:</label>
 </td>
 <td class="input">
 <select id="mod_lst" name="mod_lst" size="1">
  <option value="0"<?php if($cfg['mod_lst'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_lst'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_sts">"Statistics" module:</label>
 </td>
 <td class="input">
 <select id="mod_sts" name="mod_sts" size="1">
  <option value="0"<?php if($cfg['mod_sts'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_sts'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_apptt">"Application title" module:</label>
 </td>
 <td class="input">
 <select id="mod_apptt" name="mod_apptt" size="1">
  <option value="0"<?php if($cfg['mod_apptt'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_apptt'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_adm">"Quick Admin" module:</label>
 </td>
 <td class="input">
 <select id="mod_adm" name="mod_adm" size="1">
  <option value="0"<?php if($cfg['mod_adm'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_adm'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>

<tr>
 <td class="label">
 &#160;
 </td>
 <td class="input">
 <input id="install" name="install" type="hidden" value="1" />
 <input id="setup" name="setup" type="submit" value="Install" />
 <input id="reset" name="reset" type="reset" value="Reset" />
 </td>
</tr>

</table>
</form>
</div>