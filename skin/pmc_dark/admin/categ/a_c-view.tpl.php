<h1><?php echo $lang['categ']['categs']; ?></h1>
<?php
if(is_array($cnt['cat_id']) && count($cnt['cat_id'])>0) {
  $tc = count($cnt['cat_id']);
  if($tc > 0) {
?>
<form enctype="multipart/form-data" id="categs_mod_form" name="categs_mod_form" action="" method="post">
<table border="0" cellspacing="2">
<tr>
  <td class="cat_adm_hord">
  <?php echo $lang['pmc']['order']; ?>
  </td>
  <td class="cat_adm_himg">
  <?php echo $lang['pmc']['pic']; ?>
  </td>
  <td class="cat_adm_htt">
  <?php echo $lang['pmc']['tt']; ?>
  </td>
  <td class="cat_adm_hitm">
  <?php echo $lang['pmc']['items']; ?>
  </td>
  <td class="cat_adm_hdel">
  <?php echo $lang['pmc']['del']; ?>
  </td>
</tr>
<?php
    for($i=1;$i<=$tc;$i++) {
?>
<tr>
  <td class="cat_adm_cord">
  <input id="cat_ord-<?php echo $cnt['cat_id'][$i]; ?>" name="cat_ord-<?php echo $cnt['cat_id'][$i]; ?>" type="text" size="1" maxlength="5" value="<?php echo $cnt['cat_ord'][$i]; ?>" />
  </td>
  <td class="cat_adm_cimg">
  <?php echo pmc_image_thumb($cnt['cat_pic'][$i], 'var/pic_cat/', $cnt['cat_tt'][$i]); ?>
  </td>
  <td class="cat_adm_ctt">
  <a href="<?php echo _APP_URL; ?>admin/categ/details/<?php echo $cnt['cat_id'][$i]; ?>" title="<?php echo $cnt['cat_tt'][$i]; ?>"><?php echo $cnt['cat_tt'][$i]; ?></a>
  </td>
  <td class="cat_adm_citm">
  <?php echo $cnt['cat_items'][$i]; ?>
  </td>
  <td class="cat_adm_cdel">
  <input id="cat_del-<?php echo $cnt['cat_id'][$i]; ?>" name="cat_del-<?php echo $cnt['cat_id'][$i]; ?>" type="checkbox" />
  </td>
</tr>
<?php
    }
?>
<tr>
  <td colspan="5" class="cat_adm_subm">
  <input id="cat_save_mod" name="cat_save_mod" type="submit" value="<?php echo $lang['pmc']['save_mod']; ?>" />
  </td>
</tr>
</table>
</form>
<?php
  }
}
else {
  echo $lang['categ']['nocategs'];
}
?>