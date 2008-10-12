<h1><?php echo $lang['categ']['add']; ?></h1>
<form enctype="multipart/form-data" id="categ_add_form" name="categ_add_form" action="" method="post">
<label for="cat_tt" class="required"><?php echo $lang['pmc']['tt']; ?></label>
<input id="cat_tt" name="cat_tt" type="text" size="30" maxlength="50" value="<?php echo $cnt['cat_tt']; ?>" />

<div class="clearer"></div>
<input id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" type="hidden" value="1024000" />
<label for="cat_pic"><?php echo $lang['pmc']['pic']; ?></label>
<input id="cat_pic" name="cat_pic" type="file" />

<div class="clearer"></div>
<label for="cat_desc" class="required"><?php echo $lang['pmc']['desc']; ?></label>
<input id="cat_desc" name="cat_desc" type="text" size="38" maxlength="255" value="<?php echo $cnt['cat_desc']; ?>" />

<div class="clearer"></div>
<label for="cat_add">&#160;</label>
<input id="cat_add" name="cat_add" type="submit" value="<?php echo $lang['pmc']['add']; ?>" />
</form>