<h1><?php echo $lang['usr']['viewall']; ?></h1>
<?php
$t = count($cnt['users']);
if($t > 0) {
?>
<table border="0" cellspacing="2">
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
  <?php echo $lang['movie']['list']; ?>
  </td>
</tr>
<?php
for($i=0;$i<$t;$i++) {
?>
<tr>
  <td class="usr_adm_calias">
  <a href="<?php echo _APP_URL; ?>view/users/details/<?php echo $cnt['users'][$i]['usr_id']; ?>"><?php echo $cnt['users'][$i]['usr_name']; ?></a>
  </td>
  <td class="usr_adm_cname">
  <?php echo $cnt['users'][$i]['usr_fname']; ?>&#160;<?php echo $cnt['users'][$i]['usr_lname']; ?>
  </td>
  <td class="usr_adm_clevel">
  <?php echo $lang['usr']['lvl'][$cnt['users'][$i]['usr_level']]; ?>
  </td>
  <td class="usr_adm_cstatus">
  <?php
  if($cnt['users'][$i]['list_items'] > 0) {
    echo '<a href="'._APP_URL.'view/">'.$cnt['users'][$i]['list_items'].'</a>';
  }
  else {echo $cnt['users'][$i]['list_items'];}
  ?>
  </td>
</tr>
<?php
}
?>
<?php
echo '<tr>';
echo '<td class="usr_adm_nav" colspan="5">';
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
<?php
}
?>