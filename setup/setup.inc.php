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
* @version    19:46 2008-10-29
* @since      14:34 2008-09-12
* @access     public
* @package    pmc
* @subpackage Setup
* @todo       stuff
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
function gen_cfg_str($cfg, $datime) {
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
* @version    '.$datime.'
* @since      '.$datime.'
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
$ap_cfg[\'app_url\'] = \''.$cfg['app_url'].'\';
/**
* Full path to the application - notice the slash at the end
*/
$ap_cfg[\'app_dir\'] = \''.$cfg['app_dir'].'\';
/**
* Whether to use rewrite engine functionality or not
*/
$ap_cfg[\'app_index\'] = \''.$cfg['app_index'].'\';
/**
* Database host
*/
$ap_cfg[\'db_host\'] = \''.$cfg['db_host'].'\';
/**
* Database user
*/
$ap_cfg[\'db_user\'] = \''.$cfg['db_user'].'\';
/**
* Database password
*/
$ap_cfg[\'db_pass\'] = \''.$cfg['db_pass'].'\';
/**
* Database name
*/
$ap_cfg[\'db_name\'] = \''.$cfg['db_name'].'\';
/**
* Control the loading of the menu module
*/
$ap_cfg[\'mod\'][\'mod_mnu\'] = '.$cfg['mod_mnu'].';
/**
* Control the loading of the user module
*/
$ap_cfg[\'mod\'][\'mod_usr\'] = '.$cfg['mod_usr'].';
/**
* Control the loading of the user login module
*/
$ap_cfg[\'mod\'][\'mod_login\'] = '.$cfg['mod_login'].';
/**
* Control the loading of the genres module
*/
$ap_cfg[\'mod\'][\'mod_gen\'] = '.$cfg['mod_gen'].';
/**
* Control the loading of the search module
*/
$ap_cfg[\'mod\'][\'mod_src\'] = '.$cfg['mod_src'].';
/**
* Control the loading of the imdb search module
*/
$ap_cfg[\'mod\'][\'mod_imdb\'] = '.$cfg['mod_imdb'].';
/**
* Control the loading of the user list module
*/
$ap_cfg[\'mod\'][\'mod_lst\'] = '.$cfg['mod_lst'].';
/**
* Control the loading of the stats module
*/
$ap_cfg[\'mod\'][\'mod_sts\'] = '.$cfg['mod_sts'].';
/**
* Control the loading of the application title module
*/
$ap_cfg[\'mod\'][\'mod_apptt\'] = '.$cfg['mod_apptt'].';
/**
* Control the loading of the quick administration module
*/
$ap_cfg[\'mod\'][\'mod_adm\'] = '.$cfg['mod_adm'].';
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
* Split sql file into separate queries
*
* inspired by phpbb code
*
* return mixed stuff
*/
function split_sql($file, $delimiter) {
  $sql = file_get_contents($file);
  // trim
  $sql = trim($sql);
	// remove # comments
  $sql = preg_replace('/\n{2,}/', "\n", preg_replace('/^#.*$/m', "\n", $sql));
  // remove -- comments
	$sql = preg_replace('/\n{2,}/', "\n", preg_replace('/^--.*$/m', "\n", $sql));
  // remove \r
  $sql = eregi_replace("\r", "", $sql);
  // split
  $sql = preg_split('/' . preg_quote($delimiter, '/') . '$/m', $sql);
  // trim pieces
  $sql = array_map('trim', $sql);
  // delete last one if empty
  $last_one = end($sql);
  if(empty($last_one)) {unset($sql[key($sql)]);}
  // return
  return $sql;
}
/**
* Check for GD/FreeType
*
* return mixed stuff
*/
function check_gd() {
  if(function_exists('gd_info')) {
    $raw_gd_info = gd_info();
    $gd_check[0] = ereg_replace('[[:alpha:][:space:]()]+', '', $raw_gd_info['GD Version']);
    $gd_check[1] = $raw_gd_info['FreeType Support'];
  }
  else {
    $gd_check[0] = '0';
    $gd_check[1] = '0';
  }
  return $gd_check;
}
?>