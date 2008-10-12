<div id="mod_src">
<h2><?php echo $lang['search']['search']; ?></h2>
<form enctype="multipart/form-data" id="src_form" name="src_form" action="<?php echo _APP_URL; ?>view/search/show/results" method="post">
<input id="search" name="search" type="hidden" value="2" />
<input id="mov_tt_s" name="mov_tt_s" type="text" size="15" maxlength="150" />
<input id="src" name="src" type="submit" value="<?php echo $lang['search']['search']; ?>" />
</form>
<a href="<?php echo _APP_URL; ?>view/search" title="<?php echo $lang['search']['advanced']; ?>"><?php echo $lang['search']['advanced']; ?></a>
</div>