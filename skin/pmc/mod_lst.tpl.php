<div id="mod_lst">
<h2><?php echo $lang['list']['mylist']; ?></h2>
<?php
if(isset($_SESSION['pmc_usr_lst'])) {$t = count($_SESSION['pmc_usr_lst']);}
else {$t = 0;}
switch($t) {
  case 0  : {echo $lang['list']['isempty']; break;}
  case 1  : {echo $lang['list']['onetitle']; break;}
  default : {echo $t . '&#160;' . $lang['list']['titles']; break;}
}
?>
<?php if($t >= 0) { ?>
<table border="0" cellspacing="1">
<tr>
  <td class="listd">
<a href="<?php echo _APP_URL; ?>view/list" title="<?php echo $lang['view']['view']; ?>"><?php echo $lang['view']['view']; ?></a>
  </td>
  <td class="listd">
<form enctype="multipart/form-data" id="lst_form" name="lst_form" action="" method="post">
<input name="pmc_cart_act[2]" type="hidden" value="clear" />
<input id="lst_clear" name="lst_clear" type="submit" value="<?php echo $lang['list']['clear']; ?>" />
</form>
  </td>
</tr>
<tr>
  <td class="listd">
<form enctype="multipart/form-data" id="lst_form" name="lst_form" action="" method="post">
<input name="pmc_cart_act[1]" type="hidden" value="load" />
<input id="lst_load" name="lst_load" type="submit" value="<?php echo $lang['list']['load']; ?>" />
</form>  
  </td>
  <td class="listd">
<form enctype="multipart/form-data" id="lst_form" name="lst_form" action="" method="post">
<input name="pmc_cart_act[3]" type="hidden" value="save" />
<input id="lst_save" name="lst_save" type="submit" value="<?php echo $lang['list']['save']; ?>" />
</form>
  </td>
</tr>
</table>
<?php } ?>
</div>