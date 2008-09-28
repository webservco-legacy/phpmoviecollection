<h1><?php echo $lang['categ']['view']; ?></h1>
<?php
if($cnt['cat_tt'] != '') {
?>
<div id="cat_view_holder" class="clear">
  <div id="cat_view_pic">
  <?php echo pmc_image_thumb($cnt['cat_pic'], 'var/pic_cat/', $cnt['cat_tt'], _APP_PCAT); ?>
  </div>
  <div id="cat_view_tt">
  <?php echo $cnt['cat_tt']; ?>
  </div>
  <div id="cat_view_dsc">
  <?php echo $cnt['cat_desc']; ?>
  </div>
</div>
<?php
}
?>