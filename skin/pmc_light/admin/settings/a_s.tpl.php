<h1><?php echo $lang['set']['sets']; ?></h1>
<form enctype="multipart/form-data" id="set_mod_form" name="set_mod_form" action="" method="post">

<div class="clearer"></div>
<label for="set_lang" class="required"><?php echo $lang['set']['lang']; ?></label>
<select id="set_lang" name="set_lang" size="1">
<?php
$tl = count($cnt['langs']);
for($i=0;$i<$tl;$i++) {
?>
<option value="<?php echo $cnt['langs'][$i]; ?>"<?php if($cnt['lang'] == $cnt['langs'][$i]) {echo ' selected="selected"';}?>><?php echo $cnt['langs'][$i]; ?></option>
<?php
}
?>
</select>

<div class="clearer"></div>
<label for="set_skin" class="required"><?php echo $lang['set']['skin']; ?></label>
<select id="set_skin" name="set_skin" size="1">
<?php
$ts = count($cnt['skins']);
for($j=0;$j<$ts;$j++) {
?>
<option value="<?php echo $cnt['skins'][$j]; ?>"<?php if($cnt['skin'] == $cnt['skins'][$j]) {echo ' selected="selected"';}?>><?php echo $cnt['skins'][$j]; ?></option>
<?php
}
?>
</select>  

<div class="clearer"></div>
<label for="set_pcat" class="required"><?php echo $lang['set']['pcat']; ?></label>
<input id="set_pcat" name="set_pcat" type="text" size="3" maxlength="3" value="<?php echo $cnt['pcat']; ?>" />

<div class="clearer"></div>
<label for="set_pmov" class="required"><?php echo $lang['set']['pmov']; ?></label>
<input id="set_pmov" name="set_pmov" type="text" size="3" maxlength="3" value="<?php echo $cnt['pmov']; ?>" />

<div class="clearer"></div>
<label for="set_imov" class="required"><?php echo $lang['set']['imov']; ?></label>
<input id="set_imov" name="set_imov" type="text" size="3" maxlength="3" value="<?php echo $cnt['imov']; ?>" />

<div class="clearer"></div>
<label for="set_iusr" class="required"><?php echo $lang['set']['iusr']; ?></label>
<input id="set_iusr" name="set_iusr" type="text" size="3" maxlength="3" value="<?php echo $cnt['iusr']; ?>" />

<div class="clearer"></div>
<label for="set_imed" class="required"><?php echo $lang['set']['imed']; ?></label>
<input id="set_imed" name="set_imed" type="text" size="3" maxlength="3" value="<?php echo $cnt['imed']; ?>" />

<div class="clearer"></div>
<label for="set_lmov" class="required"><?php echo $lang['set']['lmov']; ?></label>
<input id="set_lmov" name="set_lmov" type="text" size="3" maxlength="3" value="<?php echo $cnt['lmov']; ?>" />

<div class="clearer"></div>
<label for="set_save">&#160;</label>
<input id="set_save" name="set_save" type="submit" value="<?php echo $lang['pmc']['save_mod']; ?>" />
</form>