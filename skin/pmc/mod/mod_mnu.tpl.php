<div id="mod_mnu">
<a class="mnulnk" href="<?php echo _APP_URL; ?>view/categ" title="<?php echo $lang['categ']['categs']; ?>"><?php echo $lang['categ']['categs']; ?></a>
<a class="mnulnk" href="<?php echo _APP_URL; ?>view/movies" title="<?php echo $lang['movie']['movies']; ?>"><?php echo $lang['movie']['movies']; ?></a>
<a class="mnulnk" href="<?php echo _APP_URL; ?>view/search" title="<?php echo $lang['search']['search']; ?>"><?php echo $lang['search']['search']; ?></a>
<a class="mnulnk" href="<?php echo _APP_URL; ?>view/list" title="<?php echo $lang['list']['mylist']; ?>"><?php echo $lang['list']['mylist']; ?></a>
<a class="mnulnk" href="<?php echo _APP_URL; ?>view/users" title="<?php echo $lang['usr']['usrs']; ?>"><?php echo $lang['usr']['usrs']; ?></a>
<a class="mnulnk" href="<?php echo _APP_URL; ?>view/settings" title="<?php echo $lang['set']['sets']; ?>"><?php echo $lang['set']['sets']; ?></a>
<a class="mnulnk" href="<?php echo _APP_URL; ?>view/help" title="<?php echo $lang['help']['help']; ?>"><?php echo $lang['help']['help']; ?></a>
<a class="mnulnk" href="<?php echo _APP_URL; ?>view/about" title="<?php echo $lang['about']['about']; ?>"><?php echo $lang['about']['about']; ?></a>
<?php
if($_SESSION['pmc_usr_level'] >= 4) {
?>
<a class="mnulnk" href="<?php echo _APP_URL; ?>admin/admin" title="<?php echo $lang['adm']['adm']; ?>"><?php echo $lang['adm']['adm']; ?></a>
<?php
}
?>
</div>