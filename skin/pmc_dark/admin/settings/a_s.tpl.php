<!--
<tr>
  <td class="label">
  
  </td>
  <td class="input">
  
  </td>
</tr>
-->
<h1><?php echo $lang['set']['sets']; ?></h1>
<form enctype="multipart/form-data" id="set_mod_form" name="set_mod_form" action="" method="post">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
  <td class="label">
  <label for="set_lang" class="required"><?php echo $lang['set']['lang']; ?></label>
  </td>
  <td class="input">
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
  </td>
</tr>
<tr>
  <td class="label">
  <label for="set_skin" class="required"><?php echo $lang['set']['skin']; ?></label>
  </td>
  <td class="input">
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
  </td>
</tr>
<tr>
  <td class="label">
  <label for="set_pcat" class="required"><?php echo $lang['set']['pcat']; ?></label>
  </td>
  <td class="input">
  <input id="set_pcat" name="set_pcat" type="text" size="3" maxlength="3" value="<?php echo $cnt['pcat']; ?>" />
  </td>
</tr>
<tr>
  <td class="label">
  <label for="set_pmov" class="required"><?php echo $lang['set']['pmov']; ?></label>
  </td>
  <td class="input">
  <input id="set_pmov" name="set_pmov" type="text" size="3" maxlength="3" value="<?php echo $cnt['pmov']; ?>" />
  </td>
</tr>
<tr>
  <td class="label">
  <label for="set_imov" class="required"><?php echo $lang['set']['imov']; ?></label>
  </td>
  <td class="input">
  <input id="set_imov" name="set_imov" type="text" size="3" maxlength="3" value="<?php echo $cnt['imov']; ?>" />
  </td>
</tr>
<tr>
  <td class="label">
  <label for="set_iusr" class="required"><?php echo $lang['set']['iusr']; ?></label>
  </td>
  <td class="input">
  <input id="set_iusr" name="set_iusr" type="text" size="3" maxlength="3" value="<?php echo $cnt['iusr']; ?>" />
  </td>
</tr>
<tr>
  <td class="label">
  <label for="set_imed" class="required"><?php echo $lang['set']['imed']; ?></label>
  </td>
  <td class="input">
  <input id="set_imed" name="set_imed" type="text" size="3" maxlength="3" value="<?php echo $cnt['imed']; ?>" />
  </td>
</tr>
<tr>
  <td class="label">
  <label for="set_lmov" class="required"><?php echo $lang['set']['lmov']; ?></label>
  </td>
  <td class="input">
  <input id="set_lmov" name="set_lmov" type="text" size="3" maxlength="3" value="<?php echo $cnt['lmov']; ?>" />
  </td>
</tr>
<tr>
  <td class="label">
  <label for="set_save">&#160;</label>
  </td>
  <td class="input">
  <input id="set_save" name="set_save" type="submit" value="<?php echo $lang['pmc']['save_mod']; ?>" />
  </td>
</tr>
</table>
</form>