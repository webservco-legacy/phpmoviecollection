<?php
/**
* ./lib/captcha.php (Captcha image generator)
*
* <I> ./lib/captcha.php</I>
* <BR>This file
* <BR>generates a 
* <BR>captcha image
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    18:52 2008-10-27
* @since      14:21 2008-08-25
* @access     public
* @package    pmc
* @subpackage Core
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
if(isset($_SESSION['pmc_token'])) {
  define("_VALID_REQUEST", TRUE);
  require_once '../inc/lib.inc.php';
  $captcha = str_split(strtoupper($_SESSION['pmc_token']), 1);
  
  header("Content-type: image/png");
  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
  $img = imagecreatetruecolor(70, 18);
  
  $bgc = imagecolorallocate($img, 0x11, 0x11, 0x11);
  $fgc = imagecolorallocate($img, 0xff, 0xff, 0xff);
  
  $font = './ttf/VeraMono.ttf';
  
  imagefill($img, 0, 0, $bgc);
  
  imagettftext($img, 12, 10, 3, 16, $fgc, $font, $captcha['4']);
  imagettftext($img, 12, -30, 13, 12, $fgc, $font, $captcha['3']);
  imagettftext($img, 12, 10, 30, 16, $fgc, $font, $captcha['2']);
  imagettftext($img, 12, -10, 40, 14, $fgc, $font, $captcha['1']);
  imagettftext($img, 12, 10, 58, 16, $fgc, $font, $captcha['0']);
  
  imagepng($img); 
  imagedestroy($img);
}
/**
* If request is not valid show error page
*/
else {require_once './404.php';}
?>