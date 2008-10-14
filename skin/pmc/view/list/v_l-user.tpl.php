<h1><?php echo $lang['list']['view']; ?></h1>

<?php
$t = count($cnt['movies']);
if($t > 0) {
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
    if($cnt['movies'][$i]['mov_typ'] == 1) {$movie_title[$i] .= '&#160;(V)'}
    else if($cnt['movies'][$i]['mov_typ'] == 2) {$movie_title[$i] .= '&#160;(TV)'}
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
  &#160;
  </td>
</tr>
<?php
  }
?>
</table>
<?php
}
else {echo $lang['list']['isempty'];}
?>
