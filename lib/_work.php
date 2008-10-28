<?php


error_reporting(E_ALL);
      define("_VALID_REQUEST", TRUE);
      require_once '../inc/lib.inc.php';
      require_once './browseremulator.class.php';
      require_once './imdb.inc.php';
      

/*      
      
$filename = 'test.jpg';
$imdb_url = pmc_filter_input('http://ia.media-imdb.com/images/M/MV5BMTk2MjIxMjgwNF5BMl5BanBnXkFtZTcwNDAzNTgzMQ@@.jpg');
$be = new BrowserEmulator(); 
$be->addHeaderLine("Referer", "http://ia.media-imdb.com/"); 
$be->addHeaderLine("Accept-Encoding", "x-compress; x-zip");
$file = $be->fopen($imdb_url);
$pic = '';
$i = 0;
while ($line[$i] = fgets($file, 10240)) {$pic .= $line[$i]; $i++;}
$somecontent = $pic;
fclose($file);
//die($somecontent);

if (!$handle = fopen($filename, 'w')) {echo "Cannot open file ($filename)";exit;}
if (fwrite($handle, $somecontent) === FALSE) {echo "Cannot write to file ($filename)";exit;}
$im = imagecreatefromstring($somecontent);
if ($im !== false) {
   header('Content-Type: image/png');
   imagepng($im);
}
else {
   echo 'An error occurred.';
}
//echo '<img src="'.$imdb_url.'" height="100" />';
fclose($handle);
*/

if(!pmc_save_imdb_pics('tester.jpg','MV5BMTk2MjIxMjgwNF5BMl5BanBnXkFtZTcwNDAzNTgzMQ@@.jpg')) {echo 'error';} else {echo 'ok';}
?>