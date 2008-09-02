<?php echo $_SESSION['pmmc_usr_alias']; ?>
<?php //echo _APP_SEP; ?>
&#160;&#149;&#160;
<?php echo $lang['usr']['level'] . ': ' . $lang['usr']['lvl'][$_SESSION['pmmc_usr_level']]; ?>
&#160;&#149;&#160;
<?php echo $lang['usr_status'][$usr_status]; ?>
<?php
if($_SESSION['pmmc_usr_level'] > 0) {
?>
&#160;&#149;&#160;
<a id="pmmc_logout" href="<?php echo _APP_URL; ?>logout/true" title="<?php echo $lang['usr']['logout'];?>"><?php echo $lang['usr']['logout'];?></a>
<?php
}
else {
?>
<br />
<form id="login_form" name="login_form" action="" method="post">
<input id="pmmc_token" name="pmmc_token" type="hidden" value="<?php echo $_SESSION['pmmc_token']; ?>" />
&#160;
<input id="pmmc_login" name="pmmc_login" type="text" maxlength="30" />
&#160;
<input id="pmmc_pass" name="pmmc_pass" type="password" maxlength="30" />
&#160;
<img id="pmmc_captcha_img" src="<?php echo _APP_URL;?>lib/captcha.php" />
&#160;=&#160;
<input id="pmmc_captcha" name="pmmc_captcha" type="text" maxlength="5" />
&#160;
<input id="login_submit" name="login_submit" type="submit" value="<?php echo $lang['usr']['login'];?>">
&#160;
</form>
<?php
}
?>
