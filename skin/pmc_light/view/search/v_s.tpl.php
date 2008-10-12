<h1><?php echo $lang['search']['advanced']; ?></h1>
<form enctype="multipart/form-data" id="movie_imdb_form" name="movie_imdb_form" action="<?php echo _APP_URL; ?>view/search/show/results" method="post">

<div class="clearer"></div>
<label for="search"><?php echo $lang['search']['after']; ?></label>
<select id="search" name="search" size="1">
<option value="2"><?php echo $lang['search']['aprox']; ?></option>
<option value="3"><?php echo $lang['search']['regexp']; ?></option>
<option value="1"><?php echo $lang['search']['exact']; ?></option>
</select>

<div class="clearer"></div>
<label for="mov_cat"><?php echo $lang['movie']['catno']; ?></label>
<input id="mov_catno" name="mov_catno" type="text" size="5" maxlength="15" />

<div class="clearer"></div>
<label for="mov_imdb"><?php echo $lang['movie']['imdb']; ?></label>
<input id="mov_imdb" name="mov_imdb" type="text" size="8" maxlength="8" />

<div class="clearer"></div>
<label for="mov_tt_s"><?php echo $lang['pmc']['tt']; ?></label>
<input id="mov_tt_s" name="mov_tt_s" type="text" size="35" maxlength="150" />

<div class="clearer"></div>
<label for="mov_aka"><?php echo $lang['movie']['aka']; ?></label>
<input id="mov_aka" name="mov_aka" type="text" size="35" maxlength="255" />

<div class="clearer"></div>
<label for="mov_year"><?php echo $lang['pmc']['year']; ?></label>
<input id="mov_year" name="mov_year" type="text" size="4" maxlength="4" />

<div class="clearer"></div>
<label for="mov_country"><?php echo $lang['pmc']['country']; ?></label>
<input id="mov_country" name="mov_country" type="text" size="20" maxlength="30" />

<div class="clearer"></div>
<label for="mov_language"><?php echo $lang['pmc']['language']; ?></label>
<input id="mov_language" name="mov_language" type="text" size="20" maxlength="30" />

<div class="clearer"></div>
<label for="mov_dir"><?php echo $lang['movie']['director']; ?></label>
<input id="mov_dir" name="mov_dir" type="text" size="30" maxlength="150" />

<div class="clearer"></div>
<label for="mov_wrt"><?php echo $lang['movie']['writer']; ?></label>
<input id="mov_wrt" name="mov_wrt" type="text" size="30" maxlength="150" />

<div class="clearer"></div>
<label for="mov_tag"><?php echo $lang['movie']['tagline']; ?></label>
<input id="mov_tag" name="mov_tag" type="text" size="35" maxlength="255" />

<div class="clearer"></div>
<label for="mov_plot"><?php echo $lang['movie']['plot']; ?></label>
<input id="mov_plot" name="mov_plot" type="text" size="35" maxlength="255" />

<div class="clearer"></div>
<label for="mov_cast"><?php echo $lang['movie']['cast']; ?></label>
<input id="mov_cast" name="mov_cast" type="text" size="35" maxlength="255" />

<div class="clearer"></div>
<label for="s">&#160;</label>
<input id="s" name="s" type="submit" value="<?php echo $lang['search']['search']; ?>" />
&#160;&#160;&#160;
<input id="r" name="r" type="reset" value="<?php echo $lang['search']['reset']; ?>" />
</form>