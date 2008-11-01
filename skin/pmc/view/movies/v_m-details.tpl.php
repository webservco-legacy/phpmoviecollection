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
<?php
if($cnt['mov_year'] != '0000') {
?>
<?php echo $cnt['mov_year']; ?>
<?php
}
else {echo '&#160;';}
?>
</div>
<div id="mov_view_imdb">
<?php
if($cnt['mov_imdb'] != '') {
?>
<a href="http://www.imdb.com/title/tt<?php echo $cnt['mov_imdb']; ?>" title="<?php echo $mov_tt; ?>" target="_blank"><?php echo $lang['imdb']['imdb']; ?></a>
<?php
}
else {echo '&#160;';}
?>
</div>
<div id="mov_view_catno">
<?php
if($cnt['mov_cat'] != '') {echo $cnt['mov_cat'];}
else {echo '&#160;';}
?>
</div>
<div class="clearer"></div>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
  <td class="mname">
  <?php echo $lang['movie']['type']; ?>
  </td>
  <td class="mvalue">
  &#160;<?php echo $lang['movie']['typ'][$cnt['mov_typ']]; ?>
  </td>
</tr>
<tr>
  <td class="mname">
  <?php echo $lang['movie']['aka']; ?>
  </td>
  <td class="mvalue">
  &#160;<?php echo $cnt['mov_aka']; ?>
  </td>
</tr>

<tr>
  <td class="mname">
  <?php echo $lang['pmc']['country']; ?>
  </td>
  <td class="mvalue">
  &#160;<?php echo $cnt['mov_country']; ?>
  </td>
</tr>

<tr>
  <td class="mname">
  <?php echo $lang['pmc']['language']; ?>
  </td>
  <td class="mvalue">
  &#160;<?php echo $cnt['mov_language']; ?>
  </td>
</tr>

<tr>
  <td class="mname">
  <?php echo $lang['movie']['director']; ?>
  </td>
  <td class="mvalue">
  &#160;<?php echo $cnt['mov_dir']; ?>
  </td>
</tr>

<tr>
  <td class="mname">
  <?php echo $lang['movie']['writer']; ?>
  </td>
  <td class="mvalue">
  &#160;<?php echo $cnt['mov_wrt']; ?>
  </td>
</tr>

<tr>
  <td class="mname">
  <?php echo $lang['movie']['tagline']; ?>
  </td>
  <td class="mvalue">
  &#160;<?php echo $cnt['mov_tag']; ?>
  </td>
</tr>

<tr>
  <td class="mname">
  <?php echo $lang['movie']['plot']; ?>
  </td>
  <td class="mvalue">
  &#160;<?php echo $cnt['mov_plot']; ?>
  </td>
</tr>

<tr>
  <td class="mname">
  <?php echo $lang['movie']['cast']; ?>
  </td>
  <td class="mvalue">
  &#160;<?php echo $cnt['mov_cast']; ?>
  </td>
</tr>

<tr>
  <td class="mname">
  <?php echo $lang['genre']['genres']; ?>
  </td>
  <td class="mvalue">
  &#160;
<?php

$tg = count($cnt['genres']);
$genres = array();
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
  </td>
</tr>

<tr>
  <td class="mname">
  <?php echo $lang['movie']['mformat']; ?>
  </td>
  <td class="mvalue">
  &#160;<?php echo $lang['movie']['format'][$cnt['mov_format']]; ?>
  </td>
</tr>

<tr>
  <td class="mname">
  <?php echo $lang['movie']['subs']; ?>
  </td>
  <td class="mvalue">
  &#160;<?php echo $cnt['mov_subs']; ?>
  </td>
</tr>

<tr>
  <td class="mname">
  <?php echo $lang['pmc']['notes']; ?>
  </td>
  <td class="mvalue">
  &#160;<?php echo $cnt['mov_notes']; ?>
  </td>
</tr>

</table>
<?php
}
?>