<div id="mod_imdb">
<h2><?php echo $lang['search']['imdb']; ?></h2>
<form enctype="application/x-www-form-urlencoded" id="imdb_form" name="imdb_form" action="http://www.imdb.com/find" method="get" target="_blank">
<input id="s" name="s" type="hidden" value="tt" />
<input id="q" name="q" type="text" size="15" maxlength="150" />
<input id="imdb" name="imdb" type="submit" value="<?php echo $lang['search']['search']; ?>" />
</form>
</div>