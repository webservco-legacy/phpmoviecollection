<?php
/**
* ./lib/thumb.php (Thumbnail image generator)
*
* <I> ./lib/thumb.php</I>
* <BR>This file
* <BR>generates a 
* <BR>thumbnail image
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    18:44 2008-08-26
* @since      16:52 2008-08-26
* @access     public
* @package    pmc
* @subpackage Core
* @todo       generate a small image on error in order not to break caller scripts
* @todo       support more input formats
* @todo       option to generate other formats (jpeg, gif, etc)
*/

/**
* Start session
*/
session_cache_limiter('public, must-revalidate');
session_cache_expire(600); // minutes (10 hours);
ini_set("session.gc_maxlifetime","36000"); //seconds (1 hours)
session_start();
/*
header("ETag: PUB" . time());
header("Last-Modified: " . gmdate("D, d M Y H:i:s", time()-10) . " GMT");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 5) . " GMT");
header("Pragma: no-cache");
header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");
*/
/**
* Check if the request is valid
*/
if (isset($_SESSION['pmc_token'])) {

  $img = '';
  if (!isset($_GET['img'])) {die('Oops!');}
  else {$img = $_GET['img'];}
  $max = '80';
  if(isset($_GET['max'])) {$max = $_GET['max'];}
  
  list($old_width, $old_height, $old_type) = getimagesize($img);
  
  switch ($old_type) {
    case "1": {$new_image = imagecreatefromgif($img) ; break;}
    case "2": {$new_image = imagecreatefromjpeg($img); break;}
    case "3": {$new_image = imagecreatefrompng($img); break;}
    default: {die('image type not supported'); break;}
  }
  
  // resize math
  if ($old_width > $old_height) { // landscape
    $new_width  = $max;
    $new_height = ($old_height * $max) / $old_width;
  }
  else if ($old_width < $old_height) { // portrait
    $new_width  = ($old_width * $max) / $old_height;
    $new_height = $max;
  }
  else if ($old_width == $old_height) { //square
    $new_width  = $max;
    $new_height = $max;
  }
  
  $newsizeimage = imagecreatetruecolor($new_width, $new_height);
  imagecopyresampled($newsizeimage, $new_image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
  
  header("Content-type: image/png");
  /*
  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
  */
  imagepng($newsizeimage);
  imagedestroy($newsizeimage);
}
/**
* If request is not valid show error page
*/
else {require_once './404.php';}
?>