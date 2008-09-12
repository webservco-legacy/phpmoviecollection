<?php
/**
* ./setup/setup.inc.php (installs the application)
*
* <I> ./setup/setup.inc.php</I>
* <BR>This is the setup functions file
* <BR>It contains the functions used in the
* <BR>installation
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    14:34 2008-09-12
* @since      14:34 2008-09-12
* @access     public
* @package    pmc
* @subpackage Setup
* @todo       Everything :-)
*/


/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../lib/404.php';}

/**
* Generate configuration file to be written
*
* return mixed stuff
*/
function gen_cfg_str() {
$c = '<?php
/**
* ./inc/cfg.inc.php (app configuration options)
*
* <I> ./inc/cfg.inc.php</I>
* <BR>This file stores the application
* <BR>runtime configuration
* <BR>options
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    15:08 2008-09-12
* @since      15:08 2008-09-12
* @access     public
* @package    pmc
* @subpackage Configuration
* @todo       stuff
*/

/**
* Prevent direct file access
*/
if(!defined(\'_VALID_REQUEST\')) {require_once \'../lib/404.php\';}
/**
* Main URL of the application - notice the slash at the end
*/
$ap_cfg[\'app_url\'] = \'http://localhost/pub/temp/pmc/\';
/**
* Full path to the application - notice the slash at the end
*/
$ap_cfg[\'app_dir\'] = \'d:/home/devel/server/htdocs/pub/temp/pmc/\';
/**
* Whether to use rewrite engine functionality or not
*/
$ap_cfg[\'app_index\'] = \'\';
/**
* Database host
*/
$ap_cfg[\'db_host\'] = \'localhost\';
/**
* Database user
*/
$ap_cfg[\'db_user\'] = \'temp\';
/**
* Database password
*/
$ap_cfg[\'db_pass\'] = \'temp\';
/**
* Database name
*/
$ap_cfg[\'db_name\'] = \'temp\';
/**
* Control the loading of the user module
*/
$ap_cfg[\'mod\'][\'mod_usr\'] = 1;
/**
* Control the loading of the user login module
*/
$ap_cfg[\'mod\'][\'mod_login\'] = 1;
/**
* Control the loading of the genres module
*/
$ap_cfg[\'mod\'][\'mod_gen\'] = 1;
/**
* Control the loading of the search module
*/
$ap_cfg[\'mod\'][\'mod_src\'] = 1;
/**
* Control the loading of the imdb search module
*/
$ap_cfg[\'mod\'][\'mod_imdb\'] = 1;
/**
* Control the loading of the user list module
*/
$ap_cfg[\'mod\'][\'mod_lst\'] = 1;
/**
* Control the loading of the stats module
*/
$ap_cfg[\'mod\'][\'mod_sts\'] = 1;
?>
';
return $c;
}
/**
* Write configuration file
*
* return mixed stuff
*/
function wrt_cfg_str($c, $file) {
  $err = 0;
  $f = fopen($file, 'wb');
  if($f !== false) {
    $w = fwrite($f, $c);
    if ($w === false) {$err = 1;} // could not write
    else {$err = 0;} // write ok
    fclose($f);
  }
  else {$err = 2;} // could not open file for writing
  return $err;
}
/**
* Check if able to write cfg file
*
* return mixed stuff
*/
function chk_cfg_wrt($path, $file) {
  $err = 0;
  if(!is_dir($path)) {$err = 1;}
  else if(file_exists($path.$file) && !is_writable($path.$file)) {$err = 2;}
  else if(!file_exists($path.$file) && !is_writable($path)) {$err = 3;}
  return $err;
}
/**
* List subdirectories within a certain directory
*
* @param string directory to scan
*
* @return array subdirectory list
*/
function pmc_lsdir($dir) {
  $subdirs = NULL;
  $i = '0';
  if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
      while (($file = readdir($dh)) !== false) {
        if ($file != "." && $file != "..") {
          if (filetype($dir . $file) == 'dir') {
            $subdirs[$i] = $file;
            $i++;
          }
        }
      }
    closedir($dh);
    }
  }
  return $subdirs;
}
?>