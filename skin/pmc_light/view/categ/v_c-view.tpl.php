<h1><?php echo $lang['categ']['viewall']; ?></h1>
<?php
if(is_array($cnt['cat_id']) && count($cnt['cat_id'])>0) {
  $tc = count($cnt['cat_id']);
  if($tc > 0) {
    for($i=1;$i<=$tc;$i++) {
?>
<div id="cat_view_holder" class="clear">
  <div id="cat_view_pic">
  <?php echo pmc_image_thumb_link($cnt['cat_pic'][$i], 'var/pic_cat/', $cnt['cat_tt'][$i], _APP_URL.'view/movies/categ/'.$cnt['cat_id'][$i], '_self', _APP_PCAT); ?>
  </div>
  <div id="cat_view_tt">
  <a href="<?php echo _APP_URL; ?>view/movies/categ/<?php echo $cnt['cat_id'][$i]; ?>" title="<?php echo $cnt['cat_tt'][$i]; ?>"><?php echo $cnt['cat_tt'][$i]; ?></a>
  </div>
  <div id="cat_view_itms">
  <?php echo $cnt['cat_items'][$i]; ?>&#160;
  <?php
  if($cnt['cat_items'][$i] == 1) {echo $lang['movie']['movie'];}
  else {echo $lang['movie']['movies'];}
  ?>
  </div>
  <div id="cat_view_dsc">
  <?php echo $cnt['cat_desc'][$i]; ?>
  </div>
  <div id="cat_view_det">
  <a href="<?php echo _APP_URL; ?>view/categ/details/<?php echo $cnt['cat_id'][$i]; ?>" title="<?php echo $cnt['cat_tt'][$i]; ?>"><?php echo $lang['categ']['view']; ?></a>
  </div>
</div>
<?php
    }
  }
}
else {
  echo $lang['categ']['nocategs'];
}
?>