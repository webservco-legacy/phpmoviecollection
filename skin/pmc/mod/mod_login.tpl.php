<div id="mod_login">
<?php echo $lang['pmc']['welcome']; ?>&#160;<?php echo $_SESSION['pmc_usr_name']; ?>!
<br />
<?php echo $lang['usr']['level'] . ': ' . $lang['usr']['lvl'][$_SESSION['pmc_usr_level']]; ?>
<br />
<?php echo $lang['usr']['status'] . ': ' . $lang['usr_status'][$usr_status]; ?>
<?php
if($_SESSION['pmc_usr_level'] > 0) {
?>
<br />
<?php
if($_SESSION['pmc_ldate'] == '0000-00-00') {echo $lang['usr']['vfirst'] . '!';}
else {
  echo $_SESSION['pmc_ltotal'] . '&#160;' . $lang['usr']['vtotal'];
  echo '<br />';
  echo $lang['usr']['vlast'] . ':&#160;';
  
  $vd = pmc_qry_result(pmc_qry_exec("SELECT DATEDIFF('{$_SESSION['pmc_vdate']}', '{$_SESSION['pmc_ldate']}')"));
  switch($vd) {
    case 0 :  {echo $lang['pmc']['today']; break;}
    case 1 :  {echo $lang['pmc']['yesterday']; break;}
    default : {echo $lang['pmc']['ago1'] . '&#160;' . $vd . '&#160;' . $lang['pmc']['ago2']; break;}
  }
}
?>
<?php
}
else {
?>
<form id="login_form" name="login_form" action="" method="post">
<div class="clear2">
<input id="pmc_token" name="pmc_token" type="hidden" value="<?php echo $_SESSION['pmc_token']; ?>" />
<label for="pmc_login" class="login"><?php echo $lang['usr']['mail1']; ?></label>
<input id="pmc_login" name="pmc_login" type="text" maxlength="30" />
</div>
<div class="clear2">
<label for="pmc_pass" class="login"><?php echo $lang['usr']['pass1']; ?></label>
<input id="pmc_pass" name="pmc_pass" type="password" maxlength="30" />
</div>

<div class="clear2">
<label for="pmc_captcha" class="login"><img id="pmc_captcha_img" src="<?php echo _APP_WWW;?>lib/captcha.php" title="<?php echo $lang['pmc']['captcha']; ?>" alt="<?php echo $lang['pmc']['captcha']; ?>" />&#160;=</label>
<input id="pmc_captcha" name="pmc_captcha" type="text" maxlength="5" />
</div>
<div class="clear2">
<label for="login_submit" class="login">&#160;</label>
<input id="login_submit" name="login_submit" type="submit" value="<?php echo $lang['usr']['login'];?>" />
</div>
</form>
<?php
}
?>
</div>