<?php
/*
16:44 2008-10-23
imdb.inc.php will be updated
also this file maybe

*/      
      
      
      error_reporting(E_ALL);
      define("_VALID_REQUEST", TRUE);
      $raw_imdb = '';
      if(isset($_GET['imdb'])) {$raw_imdb = $_GET['imdb'];}
      require_once './lib.inc.php';
      require_once './browseremulator.class.php';
      require_once './imdb.inc.php';
      //$imdb_id = pmc_filter_input($raw_imdb);
      //$imdb_id = str_replace('http://www.imdb.com/title/tt', '', $imdb_id);
      $imdb_id = str_replace('http://www.imdb.com/title/tt', '', $raw_imdb);
      $imdb_id = str_replace('/', '', $imdb_id);
      
      $imdb = pmc_get_imdb($imdb_id);
      $cnt['page']['mov_imdb']     = $imdb_id;
      $cnt['page']['mov_pics_url'] = $imdb['pics_url'];
      $cnt['page']['mov_tt_pre']   = $imdb['title_the'];
      $cnt['page']['mov_tt']       = $imdb['title'];
      $cnt['page']['mov_typ']      = $imdb['typ'];
      $cnt['page']['mov_aka']      = $imdb['aka'];
      $cnt['page']['mov_year']     = $imdb['year'];
      $cnt['page']['mov_country']  = $imdb['country'];
      $cnt['page']['mov_language'] = $imdb['language'];
      $cnt['page']['mov_dir']      = $imdb['dir'];
      $cnt['page']['mov_wrt']      = $imdb['wrt'];
      $cnt['page']['mov_tag']      = $imdb['tag'];
      $cnt['page']['mov_plot']     = $imdb['plot'];
      $cnt['page']['mov_cast']     = $imdb['cast'];
?>
<pre>
<?php print_r($cnt['page']);?>
</pre>
<hr>
<?php
$imdb_pics = pmc_get_imdb_pics($cnt['page']['mov_pics_url']);
echo '<pre>';
print_r($imdb_pics);
echo '</pre>';
?>