<h1><?php echo $lang['usr']['view']; ?></h1>
<form enctype="multipart/form-data" id="usr_mod_form" name="usr_mod_form" action="" method="post">

<div class="clearer"></div>
<label for="usr_name" class="required"><?php echo $lang['usr']['name']; ?></label>
<input id="usr_name" name="usr_name" type="text" size="30" maxlength="30" value="<?php echo $cnt['usr_name']; ?>" />

<div class="clearer"></div>
<label for="usr_fname" class="required"><?php echo $lang['usr']['fname']; ?></label>
<input id="usr_fname" name="usr_fname" type="text" size="30" maxlength="30" value="<?php echo $cnt['usr_fname']; ?>" />

<div class="clearer"></div>
<label for="usr_lname" class="required"><?php echo $lang['usr']['lname']; ?></label>
<input id="usr_lname" name="usr_lname" type="text" size="30" maxlength="30" value="<?php echo $cnt['usr_lname']; ?>" />

<div class="clearer"></div>
<label for="mail" class="required"><?php echo $lang['usr']['mail1']; ?></label>
<input id="mail" name="mail" type="text" size="25" maxlength="30" value="<?php echo $cnt['usr_mail']; ?>" readonly="readonly" />

<div class="clearer"></div>
<label for="usr_pass1" class="required"><?php echo $lang['usr']['pass1n']; ?></label>
<input id="usr_pass1" name="usr_pass1" type="text" size="20" maxlength="30" value="<?php echo $cnt['usr_pass1']; ?>" />

<div class="clearer"></div>
<label for="usr_pass2" class="required"><?php echo $lang['usr']['pass2n']; ?></label>
<input id="usr_pass2" name="usr_pass2" type="text" size="20" maxlength="30" value="<?php echo $cnt['usr_pass2']; ?>" />

<div class="clearer"></div>
<label for="usr_skin" class="required"><?php echo $lang['skin']['skin']; ?></label>
<select id="usr_skin" name="usr_skin" size="1">
<?php
$ts = count($cnt['skins']);
for($i=0;$i<$ts;$i++) {
?>
<option value="<?php echo $cnt['skins'][$i]; ?>"<?php if($cnt['usr_skin'] == $cnt['skins'][$i]) {echo ' selected="selected"';}?>><?php echo $cnt['skins'][$i]; ?></option>
<?php
}
?>
</select>

<div class="clearer"></div>
<label for="usr_lang" class="required"><?php echo $lang['pmc']['language']; ?></label>
<select id="usr_lang" name="usr_lang" size="1">
<?php
$tl = count($cnt['langs']);
for($j=0;$j<$tl;$j++) {
?>
<option value="<?php echo $cnt['langs'][$j]; ?>"<?php if($cnt['usr_lang'] == $cnt['langs'][$j]) {echo ' selected="selected"';}?>><?php echo $cnt['langs'][$j]; ?></option>
<?php
}
?>
</select>

<div class="clearer"></div>
<label for="usr_level" class="required"><?php echo $lang['usr']['level']; ?></label>
<select id="usr_level" name="usr_level" size="1">
<?php
for($k=1;$k<=5;$k++) {
  if($k == 1) {
?>
<option value="<?php echo $k; ?>"<?php if($cnt['usr_level'] == $k) {echo ' selected="selected"';}?>><?php echo $lang['usr']['lvl'][$k]; ?></option>
<?php
  }
}
?>
</select>

<div class="clearer"></div>
<label for="usr_status" class="required"><?php echo $lang['usr']['status']; ?></label>
<select id="usr_status" name="usr_status" size="1">
<option value="0"<?php if($cnt['usr_status'] == 0) {echo ' selected="selected"';}?>><?php echo $lang['usr']['stat'][0]; ?></option>
<option value="1"<?php if($cnt['usr_status'] == 1) {echo ' selected="selected"';}?>><?php echo $lang['usr']['stat'][1]; ?></option>
</select>

<div class="clearer"></div>
<label for="usr_mod">&#160;</label>
<input id="usr_mod" name="usr_mod" type="submit" value="<?php echo $lang['pmc']['mod']; ?>" />

</form>