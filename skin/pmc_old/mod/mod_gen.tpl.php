<div id="mod_gen">
<?php
$gen = pmc_genre_menu();
?>
<h2><?php echo $gen['tt']; ?></h2>
<?php
$total = count($gen['genre_id']);
if($total>0) {
  echo '<div id="gen_list">';
  echo '<ul>';
  for($i=1;$i<=$total;$i++) {
    $tt = $gen['genre_title'][$i];
    echo '<li>';
    if($gen['genre_items'][$i] > 0) {
      echo '<a href="'._APP_URL.'view/movies/genre/'.$gen['genre_id'][$i].'" title="'.$gen['tt'].'">';
      echo $tt;
      echo '</a>';
    }
    else {echo $tt;}
    echo ' (' . $gen['genre_items'][$i] . ')';
    echo  '</li>';
  }
  echo '</ul>';
  echo '</div>';
}
?>
</div>