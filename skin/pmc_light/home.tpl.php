<h1><?php echo $lang['pmc']['welcome']; ?>!</h1>
<h2><?php echo $lang['movie']['latest']; ?>:</h2>
<?php
$t = count($cnt['movies']);
if($t > 0) {
?>
<?php
if($t<0) {
// hide the filter box until we solve the bug
?>
<form enctype="application/x-www-form-urlencoded" id="mov_filter_form" name="mov_filter_form" action="<?php echo _APP_URL; ?>view/movies" method="get">
<table border="0" cellspacing="1">
<tr><td>
<table border="0" cellspacing="0">
<tr>
<td class="mov_view_fsort">
<input id="categ" name="categ" type="hidden" value="<?php echo $cnt['categ']; ?>" />
<?php echo $lang['pmc']['sortby']; ?>
&#160;
<select id="sort" name="sort" size="1">
  <option value="title"<?php if($cnt['sort'] == 'title') {echo 'selected="selected"';} ?>><?php echo $lang['pmc']['tt']; ?></option>
  <option value="categ"<?php if($cnt['sort'] == 'categ') {echo 'selected="selected"';} ?>><?php echo $lang['categ']['categ']; ?></option>
  <option value="year"<?php if($cnt['sort'] == 'year')   {echo 'selected="selected"';} ?>><?php echo $lang['pmc']['year']; ?></option>
</select>
  </td>
  <td class="mov_view_ford">
<?php echo $lang['pmc']['order']; ?>
&#160;
<select id="order" name="order" size="1">
  <option value="a"<?php if($cnt['order'] == 'a') {echo 'selected="selected"';} ?>><?php echo $lang['pmc']['ordera']; ?></option>
  <option value="d"<?php if($cnt['order'] == 'd') {echo 'selected="selected"';} ?>><?php echo $lang['pmc']['orderd']; ?></option>
</select>
  </td>
  <td class="mov_view_fok">
<input id="filter" name="filter" type="submit" value="<?php echo $lang['pmc']['ok']; ?>" />
  </td>
</tr>
</table>
</td></tr></table>
</form>
<?php
}
?>
<table border="0" cellspacing="2">
<tr>
  <td class="mov_view_hmovie">
  <?php echo $lang['movie']['movie']; ?>
  </td>
  <td class="mov_view_hdel">
  &#160;
  </td>
</tr>
<?php
  for($i=0;$i<$t;$i++) {
    if($cnt['movies'][$i]['mov_tt_pre'] != '') {$movie_title[$i] = $cnt['movies'][$i]['mov_tt_pre'] . '&#160;' . $cnt['movies'][$i]['mov_tt'];}
    else {$movie_title[$i] = $cnt['movies'][$i]['mov_tt'];}
    if($cnt['movies'][$i]['mov_typ'] == 1) {$movie_title[$i] .= '&#160;(V)';}
    else if($cnt['movies'][$i]['mov_typ'] == 2) {$movie_title[$i] .= '&#160;(TV)';}
?>
<tr>
  <td class="mov_view_cmovie">
    <table border="0" cellspacing="1">
    <tr>
      <td class="mov_view_img" rowspan="2">
      <?php echo pmc_image_thumb($cnt['movies'][$i]['mov_pic'], 'var/pic_mov/', $movie_title[$i]); ?>
      </td>
      <td class="mov_view_tt">
      <a href="<?php echo _APP_URL; ?>view/movies/details/<?php echo $cnt['movies'][$i]['mov_id']; ?>"><?php echo $movie_title[$i]; ?></a>
      </td>
      <td class="mov_view_year">
      <?php echo $cnt['movies'][$i]['mov_year']; ?>
      </td>
    </tr>
    <tr>
      <td class="mov_view_cat">
      <a href="<?php echo _APP_URL; ?>view/movies/categ/<?php echo $cnt['movies'][$i]['cat_id']; ?>"><?php echo $cnt['cat_tt'][$cnt['movies'][$i]['cat_id']]; ?></a>
      </td>
      <td class="mov_view_imdb">
      <a href="http://www.imdb.com/title/tt<?php echo $cnt['movies'][$i]['mov_imdb']; ?>/" target="_blank"><?php echo $lang['imdb']['imdb']; ?></a>
      </td>
    </tr>
    </table>
  </td>
  <td class="mov_view_cdel">
  <?php if($cnt['movies'][$i]['mov_cat'] != '') {echo $cnt['movies'][$i]['mov_cat'];} ?><br />
  <form enctype="multipart/form-data" id="lst_form-<?php echo $cnt['movies'][$i]['mov_id']; ?>" name="lst_form-<?php echo $cnt['movies'][$i]['mov_id']; ?>" action="" method="post">
  <?php
  if(isset($_SESSION['pmc_usr_lst'][$cnt['movies'][$i]['mov_id']])) {
  ?>
  <input name="pmc_cart_act[<?php echo $cnt['movies'][$i]['mov_id']; ?>]" type="hidden" value="del" />
  <input name="go" type="submit" value="<?php echo $lang['list']['del']; ?>" />
  <?php
  }
  else {
  ?>
  <input name="pmc_cart_act[<?php echo $cnt['movies'][$i]['mov_id']; ?>]" type="hidden" value="add" />
  <input name="go" type="submit" value="<?php echo $lang['list']['add']; ?>" />
  <?php
  }
  ?>
  </form>
  </td>
</tr>
<?php
  }
?>
</table>
<?php
}
else {
  echo $lang['movie']['nomovies'];
}
?>
