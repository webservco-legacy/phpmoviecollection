<h1><?php echo $lang['movie']['details']; ?></h1>

<?php
if($cnt['mov_tt'] != '') {
  if($cnt['mov_tt_pre'] != '') {$mov_tt = $cnt['mov_tt_pre'] . '&#160' . $cnt['mov_tt'];}
  else {$mov_tt = $cnt['mov_tt'];}
?>
<div id="mov_view_holder1" class="clear">
  <div id="mov_view_pic">
  <?php echo pmc_image_thumb($cnt['mov_pic'], 'var/pic_mov/', $mov_tt, _APP_PMOV); ?>
  </div>
  <div id="mov_view_tt">
  <?php echo $mov_tt; ?>
  </div>
</div>
<div id="mov_view_cat">
<?php echo $cnt['categs']['tt'][$cnt['cat_id']]; ?>
</div>
<div id="mov_view_year">
<?php echo $cnt['mov_year']; ?>
</div>
<div id="mov_view_imdb">
<a href="http://www.imdb.com/title/tt<?php echo $cnt['mov_imdb']; ?>" title="<?php echo $mov_tt; ?>" target="_blank"><?php echo $lang['imdb']['imdb']; ?></a>
</div>
<div class="clear">
<div class="mname"><?php echo $lang['movie']['aka']; ?></div>
<div class="mvalue"><?php echo $cnt['mov_aka']; ?></div>
</div>
<div class="clear">
<div class="mname"><?php echo $lang['pmc']['country']; ?></div>
<div class="mvalue"><?php echo $cnt['mov_country']; ?></div>
</div>
<div class="clear">
<div class="mname"><?php echo $lang['pmc']['language']; ?></div>
<div class="mvalue"><?php echo $cnt['mov_language']; ?></div>
</div>
<div class="clear">
<div class="mname"><?php echo $lang['movie']['director']; ?></div>
<div class="mvalue"><?php echo $cnt['mov_dir']; ?></div>
</div>
<div class="clear">
<div class="mname"><?php echo $lang['movie']['writer']; ?></div>
<div class="mvalue"><?php echo $cnt['mov_wrt']; ?></div>
</div>
<div class="clear">
<div class="mname"><?php echo $lang['movie']['tagline']; ?></div>
<div class="mvalue"><?php echo $cnt['mov_tag']; ?></div>
</div>
<div class="clear">
<div class="mname"><?php echo $lang['movie']['plot']; ?></div>
<div class="mvalue"><?php echo $cnt['mov_plot']; ?></div>
</div>
<div class="clear">
<div class="mname"><?php echo $lang['movie']['cast']; ?></div>
<div class="mvalue"><?php echo $cnt['mov_cast']; ?></div>
</div>
<div class="clear">
<div class="mname"><?php echo $lang['pmc']['notes']; ?></div>
<div class="mvalue"><?php echo $cnt['mov_notes']; ?></div>
</div>
<div class="clear">
<div class="mname"><?php echo $lang['genre']['genres']; ?></div>
<div class="mvalue">
<?php
$tg = count($cnt['genres']);
for($i=0;$i<$tg;$i++) {
  if($cnt['genre'][$cnt['genres'][$i]] == 1) {$genres[] = $cnt['genrett'][$cnt['genres'][$i]];}
}
$tg2 = count($genres);
if($tg2 > 0) {
  for($j=0;$j<$tg2;$j++) {
    echo $genres[$j];
    if($j != $tg2-1) {echo ', ';}
  }
}
?>
</div>
</div>
<?php
}
?>