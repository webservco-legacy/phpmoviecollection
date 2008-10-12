<h1><?php echo $lang['media']['media']; ?></h1>
<?php
$t = count($cnt['meds']);
if($t > 0) {
?>
<form enctype="multipart/form-data" id="media_mod_form" name="media_mod_form" action="" method="post">
<table border="0" cellspacing="2">
<tr>
  <td class="media_adm_hcat">
  <?php echo $lang['media']['cat']; ?>
  </td>
  <td class="media_adm_htt">
  <?php echo $lang['media']['tt']; ?>
  </td>
  <td class="media_adm_htyp">
  <?php echo $lang['media']['type']; ?>
  </td>
  <td class="media_adm_hmov">
  <?php echo $lang['media']['items']; ?>
  </td>
  <td class="media_adm_hdel">
  <?php echo $lang['pmc']['del']; ?>
  </td>
</tr>
<?php
for($i=0;$i<$t;$i++) {
?>
<tr>
  <td class="media_adm_ccat">
  <input id="med_cat-<?php echo $cnt['meds'][$i]['med_id']; ?>" name="med_cat-<?php echo $cnt['meds'][$i]['med_id']; ?>" type="text" size="3" maxlength="15" value="<?php echo $cnt['meds'][$i]['med_cat']; ?>" />
  </td>
  <td class="media_adm_ctt">
  <input id="med_tt-<?php echo $cnt['meds'][$i]['med_id']; ?>" name="med_tt-<?php echo $cnt['meds'][$i]['med_id']; ?>" type="text" size="25" maxlength="150" value="<?php echo $cnt['meds'][$i]['med_tt']; ?>" />
  </td>
  <td class="media_adm_ctyp">
  <select id="med_typ-<?php echo $cnt['meds'][$i]['med_id']; ?>" name="med_typ-<?php echo $cnt['meds'][$i]['med_id']; ?>" size="1">
  <option value="1"<?php if($cnt['meds'][$i]['med_typ'] == 1) {echo ' selected="selected"';}?>><?php echo $lang['media'][1]; ?></option>
  <option value="2"<?php if($cnt['meds'][$i]['med_typ'] == 2) {echo ' selected="selected"';}?>><?php echo $lang['media'][2]; ?></option>
  <option value="3"<?php if($cnt['meds'][$i]['med_typ'] == 3) {echo ' selected="selected"';}?>><?php echo $lang['media'][3]; ?></option>
  <option value="4"<?php if($cnt['meds'][$i]['med_typ'] == 4) {echo ' selected="selected"';}?>><?php echo $lang['media'][4]; ?></option>
  </select>
  </td>
  <td class="media_adm_cmov">
  <?php
  if($cnt['meds'][$i]['med_items'] > 0) {
  echo '<a href="'._APP_URL.'admin/movies/media/'.$cnt['meds'][$i]['med_id'].'" title="'.$lang['movie']['movies'].'">';
  echo $cnt['meds'][$i]['med_items'];
  echo '</a>';
  }
  else {echo $cnt['meds'][$i]['med_items'];}
  ?>
  </td>
  <td class="media_adm_cdel">
  <input id="med_del-<?php echo $cnt['meds'][$i]['med_id']; ?>" name="med_del-<?php echo $cnt['meds'][$i]['med_id']; ?>" type="checkbox" />
  </td>
</tr>
<?php
}
?>
<tr>
  <td colspan="5" class="media_adm_subm">
  <input id="med_save_mod" name="med_save_mod" type="submit" value="<?php echo $lang['pmc']['save_mod']; ?>" />
  </td>
</tr>
<?php
echo '<tr>';
echo '<td class="media_adm_nav" colspan="5">';
echo $cnt['link_first'] . '&#160;';
echo $cnt['link_prev'] . '&#160;';
echo $lang['pmc']['page'] . '&#160;';
echo $cnt['page'] . '&#160;';
echo $lang['pmc']['of'] . '&#160;';
echo $cnt['maxpage'] . '&#160;';
echo $cnt['link_next'] . '&#160;';
echo $cnt['link_last'] . '&#160;';
echo '</td>';
echo '</tr>';
?>
</table>
</form>
<?php
}
else {
  echo $lang['media']['nomedia'];
}
?>