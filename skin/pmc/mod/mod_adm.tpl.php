<?php if($_SESSION['pmc_usr_level'] > 4) { ?>
<div id="mod_adm">
<h2><?php echo $lang['adm']['adm'] ; ?></h2>
<ul>
<li><a href="<?php echo _APP_URL; ?>admin/media" title="<?php echo $lang['media']['media']; ?>"><?php echo $lang['media']['media']; ?></a></li>
<li><a href="<?php echo _APP_URL; ?>admin/media/add/new" title="<?php echo $lang['media']['add']; ?>"><?php echo $lang['media']['add']; ?></a></li>
<li><a href="<?php echo _APP_URL; ?>admin/categ" title="<?php echo $lang['categ']['categs']; ?>"><?php echo $lang['categ']['categs']; ?></a></li>
<li><a href="<?php echo _APP_URL; ?>admin/categ/add/new" title="<?php echo $lang['categ']['add']; ?>"><?php echo $lang['categ']['add']; ?></a></li>
<li><a href="<?php echo _APP_URL; ?>admin/movies" title="<?php echo $lang['movie']['movies']; ?>"><?php echo $lang['movie']['movies']; ?></a></li>
<li><a href="<?php echo _APP_URL; ?>admin/movies/add/new" title="<?php echo $lang['movie']['add']; ?>"><?php echo $lang['movie']['add']; ?></a></li>
</ul>
</div>
<?php } ?>