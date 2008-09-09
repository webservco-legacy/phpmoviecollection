<h1><?php echo $lang['lang']['langs']; ?></h1>
<?php
$t = count($cnt['langs']['idx']);
if($t > 0) {
?>
<form enctype="multipart/form-data" id="lang_form" name="lang_form" action="" method="post">
<table border="0" cellspacing="2">
<tr>
  <td class="langsb"><?php echo $lang['lang']['lang']; ?></td>
  <td class="langsb"><?php echo $lang['pmc']['desc']; ?></td>
  <td class="langsb"><?php echo $lang['lang']['trans']; ?></td>
  <td class="langsb"><?php echo $lang['set']['set']; ?></td>
</tr>
<?php
  for($i=0;$i<$t;$i++) {
?>
<tr>
  <td class="langs">
  <?php echo $cnt['langs']['name'][$i]; ?>
  </td>
  <td class="langs">
  <?php echo $cnt['langs']['desc'][$i]; ?>
  </td>
  <td class="langs">
  <a href="<?php echo $cnt['langs']['url'][$i]; ?>" title="<?php echo $cnt['langs']['trans'][$i]; ?>" target="_blank"><?php echo $cnt['langs']['trans'][$i]; ?></a>
  </td>
  <td class="langs">
<?php
if($_SESSION['pmc_usr_lang'] == $cnt['langs']['idx'][$i]) {echo $lang['lang']['current'];}
else {
?>
<input id="lang_set-<?php echo $cnt['langs']['idx'][$i]; ?>" name="lang_set-<?php echo $cnt['langs']['idx'][$i]; ?>" type="submit" value="<?php echo $lang['set']['set']; ?>" />
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
