<b><?php echo $_SESSION['pmc_usr_alias']; ?></b>

<?php
if($_SESSION['pmc_usr_level'] >= 4) {
?>
&#160;&#149;&#160;
<a id="pmc_adm" href="<?php echo _APP_URL; ?>admin/admin" title="<?php echo $lang['adm']['adm']; ?>"><?php echo $lang['adm']['adm']; ?></a>
<?php
}
?>
&#160;&#149;&#160;
<a id="pmc_list" href="<?php echo _APP_URL; ?>view/list" title="<?php echo $lang['list']['mylist']; ?>"><?php echo $lang['list']['mylist']; ?></a>
&#160;&#149;&#160;
<a id="pmc_lang" href="<?php echo _APP_URL; ?>view/langs" title="<?php echo $lang['lang']['lang'];?>"><?php echo $lang['lang']['lang'];?></a>
&#160;&#149;&#160;
<a id="pmc_skin" href="<?php echo _APP_URL; ?>view/skins" title="<?php echo $lang['skin']['skin'];?>"><?php echo $lang['skin']['skin'];?></a>
<?php
if($_SESSION['pmc_usr_level'] > 0) {
?>
&#160;&#149;&#160;
<a id="pmc_logout" href="<?php echo _APP_URL; ?>logout/true" title="<?php echo $lang['usr']['logout'];?>"><?php echo $lang['usr']['logout'];?></a>
<?php
}
?>

