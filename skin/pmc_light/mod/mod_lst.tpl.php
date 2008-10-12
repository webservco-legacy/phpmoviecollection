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
<div class="lst_viewd">
<form enctype="multipart/form-data" id="lst_form0" name="lst_form0" action="<?php echo _APP_URL; ?>view/list" method="get">
<input id="lst_view" name="lst_view" type="submit" value="<?php echo $lang['view']['view']; ?>" />
</form>
</div>

<div class="lst_cleard">
<form enctype="multipart/form-data" id="lst_form1" name="lst_form1" action="" method="post">
<input name="pmc_cart_act[2]" type="hidden" value="clear" />
<input id="lst_clear" name="lst_clear" type="submit" value="<?php echo $lang['list']['clear']; ?>" />
</form>
</div>

<?php if($_SESSION['pmc_usr_level'] > 0) { ?>
<div class="lst_loadd">
<form enctype="multipart/form-data" id="lst_form2" name="lst_form2" action="" method="post">
<input name="pmc_cart_act[1]" type="hidden" value="load" />
<input id="lst_load" name="lst_load" type="submit" value="<?php echo $lang['list']['load']; ?>" />
</form> 
</div>

<div class="lst_saved">
<form enctype="multipart/form-data" id="lst_form3" name="lst_form3" action="" method="post">
<input name="pmc_cart_act[3]" type="hidden" value="save" />
<input id="lst_save" name="lst_save" type="submit" value="<?php echo $lang['list']['save']; ?>" />
</form>
</div>
<?php } ?>

<div class="clearer"></div>
<?php } ?>
</div>