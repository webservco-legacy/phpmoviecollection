<h1><?php echo $lang['usr']['viewall']; ?></h1>
<?php
if(is_array($cnt['usr_id']) && count($cnt['usr_id'])>0) {
  $tc = count($cnt['usr_id']);
  if($tc > 0) {
?>
<form enctype="multipart/form-data" id="usr_mod_form" name="usr_mod_form" action="" method="post">
<table border="0" cellspacing="1">
<tr>
  <td class="usr_adm_halias">
  <?php echo $lang['usr']['name']; ?>
  </td>
  <td class="usr_adm_hname">
  <?php echo $lang['usr']['lname']; ?>
  </td>
  <td class="usr_adm_hlevel">
  <?php echo $lang['usr']['level']; ?>
  </td>
  <td class="usr_adm_hstatus">
  <?php echo $lang['usr']['status']; ?>
  </td>
  <td class="usr_adm_hdel">
  <?php echo $lang['pmmc']['del']; ?>
  </td>
</tr>
<?php
    for($i=1;$i<=$tc;$i++) {
    // xxx
?>
<tr>
  <td class="usr_adm_calias">
  <input id="cat_ord-<?php echo $cnt['cat_id'][$i]; ?>" name="cat_ord-<?php echo $cnt['cat_id'][$i]; ?>" type="text" size="1" maxlength="5" value="<?php echo $cnt['cat_ord'][$i]; ?>" />
  </td>
  <td class="usr_adm_cname">
  <?php echo pmmc_image_thumb($cnt['cat_pic'][$i], 'var/pic_cat/', $cnt['cat_tt'][$i]); ?>
  </td>
  <td class="usr_adm_clevel">
  <a href="<?php echo _APP_URL; ?>admin/categ/view/<?php echo $cnt['cat_id'][$i]; ?>" title="<?php echo $cnt['cat_tt'][$i]; ?>"><?php echo $cnt['cat_tt'][$i]; ?></a>
  </td>
  <td class="usr_adm_cstatus">
  <?php echo $cnt['cat_items'][$i]; ?>
  </td>
  <td class="usr_adm_cdel">
  <input id="cat_del-<?php echo $cnt['cat_id'][$i]; ?>" name="cat_del-<?php echo $cnt['cat_id'][$i]; ?>" type="checkbox" />
  </td>
</tr>
<?php
    }
?>
<tr>
  <td colspan="5" class="cat_adm_subm">
  <input id="cat_save_mod" name="cat_save_mod" type="submit" value="<?php echo $lang['pmmc']['save_mod']; ?>" />
  </td>
</tr>
</table>
</form>
<?php
  }
}
?>