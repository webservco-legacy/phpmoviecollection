<h1><?php echo $lang['movie']['movies']; ?></h1>

<?php
$t = count($cnt['movies']);
if($t > 0) {
?>
<?php
if($t<0) {
// hide the filter box until we solve the bug
?>
<form enctype="application/x-www-form-urlencoded" id="mov_filter_form" name="mov_filter_form" action="" method="get">
<table border="0" cellspacing="1">
<tr>
<td class="mov_adm_fsort">
<input id="categ" name="categ" type="hidden" value="<?php echo $cnt['categ']; ?>" />
<?php echo $lang['pmc']['sortby']; ?>
&#160;
<select id="sort" name="sort" size="1">
  <option value="title"<?php if($cnt['sort'] == 'title') {echo 'selected="selected"';} ?>><?php echo $lang['pmc']['tt']; ?></option>
  <option value="categ"<?php if($cnt['sort'] == 'categ') {echo 'selected="selected"';} ?>><?php echo $lang['categ']['categ']; ?></option>
  <option value="year"<?php if($cnt['sort'] == 'year')   {echo 'selected="selected"';} ?>><?php echo $lang['pmc']['year']; ?></option>
</select>
  </td>
  <td class="mov_adm_ford">
<?php echo $lang['pmc']['order']; ?>
&#160;
<select id="order" name="order" size="1">
  <option value="a"<?php if($cnt['order'] == 'a') {echo 'selected="selected"';} ?>><?php echo $lang['pmc']['ordera']; ?></option>
  <option value="d"<?php if($cnt['order'] == 'd') {echo 'selected="selected"';} ?>><?php echo $lang['pmc']['orderd']; ?></option>
</select>
  </td>
  <td class="mov_adm_fok">
<input id="filter" name="filter" type="submit" value="<?php echo $lang['pmc']['ok']; ?>" />
  </td>
</tr>
</table>
</form>
<?php
}
?>
<form enctype="multipart/form-data" id="movies_mod_form" name="movies_mod_form" action="" method="post">
<table border="0" cellspacing="1">
<tr>
  <td class="mov_adm_hmovie">
  <?php echo $lang['movie']['movie']; ?>
  </td>
  <td class="mov_adm_hdel">
  <?php echo $lang['pmc']['del']; ?>
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
  <td class="mov_adm_cmovie">
    <table border="0" cellspacing="1">
    <tr>
      <td class="mov_adm_img" rowspan="2">
      <?php echo pmc_image_thumb($cnt['movies'][$i]['mov_pic'], 'var/pic_mov/', $movie_title[$i]); ?>
      </td>
      <td class="mov_adm_tt">
      <a href="<?php echo _APP_URL; ?>admin/movies/details/<?php echo $cnt['movies'][$i]['mov_id']; ?>"><?php echo $movie_title[$i]; ?></a>
      </td>
      <td class="mov_adm_year">
      <?php echo $cnt['movies'][$i]['mov_year']; ?>
      </td>
    </tr>
    <tr>
      <td class="mov_adm_cat">
      <?php
      if($cnt['movies'][$i]['med_id'] != 0) {
      ?>
      <a href="<?php echo _APP_URL; ?>admin/movies/media/<?php echo $cnt['movies'][$i]['med_id']; ?>"><?php echo $cnt['med_cat'][$cnt['movies'][$i]['med_id']]; ?></a>
      <?php
      }
      ?>
      <a href="<?php echo _APP_URL; ?>admin/movies/categ/<?php echo $cnt['movies'][$i]['cat_id']; ?>"><?php echo $cnt['cat_tt'][$cnt['movies'][$i]['cat_id']]; ?></a>
      </td>
      <td class="mov_adm_imdb">
      <a href="http://www.imdb.com/title/tt<?php echo $cnt['movies'][$i]['mov_imdb']; ?>/" target="_blank"><?php echo $lang['imdb']['imdb']; ?></a>
      </td>
    </tr>
    </table>
  </td>
  <td class="mov_adm_cdel">
  <?php if($cnt['movies'][$i]['mov_cat'] != '') {echo $cnt['movies'][$i]['mov_cat'];} ?><br />
  <input id="mov_del-<?php echo $cnt['movies'][$i]['mov_id']; ?>" name="mov_del-<?php echo $cnt['movies'][$i]['mov_id']; ?>" type="checkbox" />
  </td>
</tr>
<?php
  }
?>
<tr>
  <td colspan="2" class="mov_adm_subm">
  <input id="mov_save_mod" name="mov_save_mod" type="submit" value="<?php echo $lang['pmc']['save_mod']; ?>" />
  </td>
</tr>
<?php
  if($cnt['searchtype'] == 0) {
    echo '<tr>';
    echo '<td class="mov_adm_nav" colspan="2">';
    echo $cnt['link_first'] . '&#160;';
    echo $cnt['link_prev'] . '&#160;';
    echo $lang['pmc']['page'] . '&#160;';
    echo $cnt['page'] . '&#160;';
    echo $lang['pmc']['of'] . '&#160;';
    echo $cnt['maxpage'] . '&#160;';
    echo $cnt['link_next'] . '&#160;';
    echo $cnt['link_last'] . '&#160;';
    echo '</td>';
    echo '</tr>';
  }
?>
</table>
</form>
<?php
}
else {
  echo $lang['movie']['nomovies'];
}
?>
