<h1><?php echo $lang['categ']['viewall']; ?></h1>
<?php
if(is_array($cnt['cat_id']) && count($cnt['cat_id'])>0) {
  $tc = count($cnt['cat_id']);
  if($tc > 0) {
?>
<form enctype="multipart/form-data" id="categ_add_form" name="categ_add_form" action="" method="post">
<table border="1" cellpadding="3" cellspacing="0">
<?php
    for($i=1;$i<=$tc;$i++) {
?>
<tr>
  <td>
  <?php echo pmmc_image_thumb($cnt['cat_pic'][$i], 'var/pic_cat/', $cnt['cat_tt'][$i]); ?>
  </td>
  <td>
<?php echo $cnt['cat_tt'][$i]; ?>
  </td>
  <td>
<?php echo $cnt['cat_desc'][$i]; ?>
  </td>
  <td>
  <input id="cat_ord[]" name="cat_ord[]" type="text" size="1" maxlength="5" value="<?php echo $cnt['cat_ord'][$i]; ?>" />
  </td>
</tr>
<?php
    }
?>
</table>
</form>
<?php
  }
}
?>