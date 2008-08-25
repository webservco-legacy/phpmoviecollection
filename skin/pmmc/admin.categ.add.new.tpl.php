<h1><?php echo $lang['categ']['add']; ?></h1>
<form enctype="multipart/form-data" id="categ_add_form" name="categ_add_form" action="" method="post">
<label for="cat_tt"><?php echo $lang['categ']['tt']; ?></label>
<input id="cat_tt" name="cat_tt" type="text" />
<br class="clear" />
<label for="cat_dsc"><?php echo $lang['categ']['dsc']; ?></label>
<input id="cat_dsc" name="cat_dsc" type="text" />
</form>
<br class="clear" />
<?php print_r($cnt); ?>