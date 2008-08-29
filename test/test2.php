<?php
error_reporting(E_ALL);

function pmmc_get_imdb($imdb_id) {
  $imdb_id = 'http://www.imdb.com/title/tt'.$imdb_id;
  $be = new BrowserEmulator(); 
  $be->addHeaderLine("Referer", "http://example.com/"); 
  $be->addHeaderLine("Accept-Encoding", "x-compress; x-zip"); 
  //$be->addPostData("Submit", "OK"); 
  //$be->addPostData("item", "42"); 
  //$be->setAuth("admin", "secretpass"); 
  // also possible: 
  // $be->setPort(10080); 
  $file = $be->fopen($imdb_id);
  //$response = $be->getLastResponseHeaders(); 
  //print_r($response);

  $imdb['title_the'] = '{TT_THE}';
  $imdb['title'] = '{TT}';
  $imdb['year']  = '{YR}';
  $dirline = 0;
  $imdb['dir']   = '{DIR}';
  $wrtline = 0;
  $imdb['wrt'] = '{WRT}';
  $tagline = 0;
  $imdb['tag'] = '{TAG}';
  $plotline = 0;
  $imdb['plot'] = '{PLOT}';
  $castline = 0;
  $imdb['cast'] = '{CAST}';
  $i = 0;
  $imdb = stream_get_contents($file);
  $imdb = trim(strip_tags($imdb));
  $imdb1 = strstr($imdb, 'Country:');
  $imdb2 = strstr($imdb, 'Language:');
  //echo $imdb1;
  //echo '<hr>';
  //echo $imdb2;
  //echo '</pre>';
  $imdb = str_replace($imdb2, '', $imdb1);
  fclose($file);
  return $imdb;
}

/**
* Usage
*/
$imdb_id = '0360486/'; /* ct */
//$imdb_id = '0360487/';
//$imdb_id = '0133093/'; /* mx */
require_once 'browseremulator.class.php';
$imdb = pmmc_get_imdb($imdb_id);
echo '<pre>';
print_r($imdb);
echo '</pre>';
?>