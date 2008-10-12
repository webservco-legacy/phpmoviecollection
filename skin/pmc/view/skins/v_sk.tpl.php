<h1><?php echo $lang['skin']['skins']; ?></h1>
<?php
$t = count($cnt['skins']['idx']);
if($t > 0) {
?>
<form enctype="multipart/form-data" id="skin_form" name="skin_form" action="" method="post">
<table border="0" cellspacing="2">
<tr>
  <td class="skinsb"><?php echo $lang['skin']['skin']; ?></td>
  <td class="skinsb"><?php echo $lang['pmc']['desc']; ?></td>
  <td class="skinsb"><?php echo $lang['skin']['auth']; ?></td>
  <td class="skinsb"><?php echo $lang['skin']['ver']; ?></td>
  <td class="skinsb"><?php echo $lang['set']['set']; ?></td>
</tr>
<?php
  for($i=0;$i<$t;$i++) {
?>
<tr>
  <td class="skins">
  <?php echo $cnt['skins']['name'][$i]; ?>
  </td>
  <td class="skins">
  <?php echo $cnt['skins']['desc'][$i]; ?>
  </td>
  <td class="skins">
  <?php echo $cnt['skins']['auth'][$i]; ?>
  </td>
  <td class="skins">
  <a href="<?php echo $cnt['skins']['url'][$i]; ?>" title="<?php echo $cnt['skins']['auth'][$i]; ?>" target="_blank"><?php echo $cnt['skins']['ver'][$i]; ?></a>
  </td>
  <td class="skins">
<?php
if($_SESSION['pmc_usr_skin'] == _APP_DIR . 'skin/' . $cnt['skins']['idx'][$i] . '/') {echo $lang['skin']['current'];}
else {
?>
<input id="skin_set-<?php echo $cnt['skins']['idx'][$i]; ?>" name="skin_set-<?php echo $cnt['skins']['idx'][$i]; ?>" type="submit" value="<?php echo $lang['set']['set']; ?>" />
<?php
}
?>
  </td>
</tr>
<?php
  }
?>
</table>
</form>
<?php
}
?>
