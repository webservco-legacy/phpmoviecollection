<?php echo $_SESSION['pmc_usr_alias']; ?>
<?php //echo _APP_SEP; ?>
&#160;&#149;&#160;
<?php echo $lang['usr']['level'] . ': ' . $lang['usr']['lvl'][$_SESSION['pmc_usr_level']]; ?>
&#160;&#149;&#160;
<?php echo $lang['usr_status'][$usr_status]; ?>
<?php
if($_SESSION['pmc_usr_level'] > 0) {
?>
&#160;&#149;&#160;
<a id="pmc_logout" href="<?php echo _APP_URL; ?>logout/true" title="<?php echo $lang['usr']['logout'];?>"><?php echo $lang['usr']['logout'];?></a>
<?php
}
else {
?>
<br />
<form id="login_form" name="login_form" action="" method="post">
<input id="pmc_token" name="pmc_token" type="hidden" value="<?php echo $_SESSION['pmc_token']; ?>" />
&#160;
<input id="pmc_login" name="pmc_login" type="text" maxlength="30" />
&#160;
<input id="pmc_pass" name="pmc_pass" type="password" maxlength="30" />
&#160;
<img id="pmc_captcha_img" src="<?php echo _APP_URL;?>lib/captcha.php" />
&#160;=&#160;
<input id="pmc_captcha" name="pmc_captcha" type="text" maxlength="5" />
&#160;
<input id="login_submit" name="login_submit" type="submit" value="<?php echo $lang['usr']['login'];?>">
&#160;
</form>
<?php
}
?>
