<h1><?php echo $lang['media']['add']; ?></h1>
<form enctype="multipart/form-data" id="med_add_form" name="med_add_form" action="" method="post">

<div class="clearer"></div>
<label for="med_cat" class="required"><?php echo $lang['media']['cat']; ?></label>
<input id="med_cat" name="med_cat" type="text" size="15" maxlength="15" value="<?php echo $cnt['med_cat']; ?>" />

<div class="clearer"></div>
<label for="med_tt" class="required"><?php echo $lang['media']['tt']; ?></label>
<input id="med_tt" name="med_tt" type="text" size="40" maxlength="150" value="<?php echo $cnt['med_tt']; ?>" />

<div class="clearer"></div>
<label for="med_typ" class="required"><?php echo $lang['media']['type']; ?></label>
<select id="med_typ" name="med_typ" size="1">
<option value="1"<?php if($cnt['med_typ'] == 1) {echo ' selected="selected"';}?>><?php echo $lang['media'][1]; ?></option>
<option value="2"<?php if($cnt['med_typ'] == 2) {echo ' selected="selected"';}?>><?php echo $lang['media'][2]; ?></option>
<option value="3"<?php if($cnt['med_typ'] == 3) {echo ' selected="selected"';}?>><?php echo $lang['media'][3]; ?></option>
<option value="4"<?php if($cnt['med_typ'] == 4) {echo ' selected="selected"';}?>><?php echo $lang['media'][4]; ?></option>
</select>

<div class="clearer"></div>
<label for="med_add">&#160;</label>
<input id="med_add" name="med_add" type="submit" value="<?php echo $lang['pmc']['add']; ?>" />
</form>