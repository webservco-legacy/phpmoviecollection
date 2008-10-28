<?php
/**
* ./lib/imdbpic.php (IMDb poster viewer)
*
* <I> ./lib/imdbpic.php</I>
* <BR>This file
* <BR>generates a 
* <BR>thumbnail for a IMDb poster
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    19:19 2008-10-28
* @since      18:40 2008-10-28
* @access     public
* @package    pmc
* @subpackage Imdb
* @todo       stuff
*/

/**
* Start session
*/
session_cache_limiter('public, must-revalidate');
session_cache_expire(600); // minutes (10 hours);
ini_set("session.gc_maxlifetime","36000"); //seconds (1 hours)
session_start();
header("ETag: PUB" . time());
header("Last-Modified: " . gmdate("D, d M Y H:i:s", time()-10) . " GMT");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 5) . " GMT");
header("Pragma: no-cache");
header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");
//header('HTTP/1.1 200 OK');
/**
* Check if the request is valid
*/
//$_SESSION['pmc_token'] = true;
if(isset($_SESSION['pmc_token']) && isset($_GET['pic'])) {
  define("_VALID_REQUEST", TRUE);
  require_once '../inc/lib.inc.php';
  require_once './browseremulator.class.php';
  require_once './imdb.inc.php';
  $picfile = pmc_filter_input($_GET['pic'],0);
  if($picfile == '') {require_once './404.php';}
  else {
    $be = new BrowserEmulator();
    $be->addHeaderLine("Referer", "http://ia.media-imdb.com/"); 
    $be->addHeaderLine("Accept-Encoding", "x-compress; x-zip");
    $file = $be->fopen('http://ia.media-imdb.com/images/M/'.$picfile);
    $pic = '';
    $i = 0;
    while($line[$i] = fgets($file, 10240)) {$pic .= $line[$i]; $i++;}
    fclose($file);
    $img = imagecreatefromstring($pic);
    if($img !== false) {
      header("Content-type: image/png");
      header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
      header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
      imagepng($img); 
      imagedestroy($img);
    }
    else {require_once './404.php';}
  }
}
/**
* If request is not valid show error page
*/
else {require_once './404.php';}
?>