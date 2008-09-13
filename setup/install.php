<?php
/**
* ./setup/install.php (installs the application)
*
* <I> ./setup/install.php</I>
* <BR>This is the main setup file
* <BR>It tries to install
* <BR>the application
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    14:22 2008-09-12
* @since      14:22 2008-09-12
* @access     public
* @package    pmc
* @subpackage Setup
* @todo       Everything :-)
*/


/**
* Prevent unauthorized access to other files
*/
define("_VALID_REQUEST", TRUE);
/**
* Load setup functions
*/
if(is_readable('./setup.inc.php')) {require_once './setup.inc.php';}
else {die('ERROR! Files missing. Please re-install the application.');}
/**
* Load core functions
*/
if(is_readable('../inc/lib.inc.php')) {require_once '../inc/lib.inc.php';}
else {die('ERROR! Files missing. Please re-install the application.');}
/**
* xxx
*/
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//$c = gen_cfg_str();
//$w = wrt_cfg_str($c, './test.php');
//echo $w . '<br />';

//echo chk_cfg_wrt('./', 'test.php');
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] != '') {$server = $_SERVER['HTTP_HOST'];}
else if(isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] != '') {$server = $_SERVER['SERVER_NAME'];}
$request_uri = str_replace('/setup/install.php', '/', $_SERVER['REQUEST_URI']);
$app_url = 'http://' . $server . $request_uri;

$cfg = array();

$cfg['app_url']   = $app_url;
$cfg['app_index'] = '1';
$cfg['app_dir']   = str_replace('\\', '/', realpath(dirname('../index.php'))) . '/';

$cfg['db_host']   = 'localhost';
$cfg['db_user']   = '';
$cfg['db_pass']   = '';
$cfg['db_name']   = '';

$cfg['mod_usr']   = '1';
$cfg['mod_login'] = '1';
$cfg['mod_gen']   = '1';
$cfg['mod_src']   = '1';
$cfg['mod_imdb']  = '1';
$cfg['mod_lst']   = '1';

$cfg['usr_name']  = '';
$cfg['usr_fname'] = '';
$cfg['usr_lname'] = '';
$cfg['usr_mail']  = '';
$cfg['usr_pass']  = '';
$cfg['usr_skin']  = 'pmc';
$cfg['usr_lang']  = 'ro';

$cfg['app_lang']  = 'ro';
$cfg['app_skin']  = 'pmc';
$cfg['app_pcat']  = '150';
$cfg['app_pmov']  = '150';
$cfg['app_imov']  = '10';
$cfg['app_iusr']  = '10';
$cfg['app_dmov']  = '3';

/*
* if post -> validate 
err) -> die(error+link: try again-redirect)
ok) - > cfg= -> -> check if vales are ok
  err) -> die....
  ok) ->wrt_cfg -> insert dbs -> insert dbv -> echo ok(redirect)
* if not post echo form

*/

require_once 'tpl.hdr.inc.php';

if(isset($_POST['install'])) {
  $err = 0;
  $msg = '';
  $unwanted = array("\\", "\x00", "\n", "\r", "'", '"', "\xla", '&lt;', '&gt;', '<', '>');
  $cfg['db_host']   = trim(str_replace($unwanted, ' ', $_POST['db_host']));
  $cfg['db_user']   = trim(str_replace($unwanted, ' ', $_POST['db_user']));
  $cfg['db_pass']   = trim(str_replace($unwanted, ' ', $_POST['db_pass']));
  $cfg['db_name']   = trim(str_replace($unwanted, ' ', $_POST['db_name']));
  
  $pmc_dbconn = pmc_dbopen($cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);
  if(!$pmc_dbconn) {$err = 1; $msg = 'Database information is invalid!';}
  else {
    $cfg['app_url']   = pmc_filter_input($_POST['app_url']);
    $cfg['app_index'] = pmc_filter_input($_POST['app_index']);
    $cfg['app_dir']   = pmc_filter_input($_POST['app_dir']);
    
    $cfg['mod_usr']   = pmc_filter_input($_POST['mod_usr']);
    $cfg['mod_login'] = pmc_filter_input($_POST['mod_login']);
    $cfg['mod_gen']   = pmc_filter_input($_POST['mod_gen']);
    $cfg['mod_src']   = pmc_filter_input($_POST['mod_src']);
    $cfg['mod_imdb']  = pmc_filter_input($_POST['mod_imdb']);
    $cfg['mod_lst']   = pmc_filter_input($_POST['mod_lst']);
    
    $cfg['usr_name']  = pmc_filter_input($_POST['usr_name']);
    $cfg['usr_fname'] = pmc_filter_input($_POST['usr_fname']);
    $cfg['usr_lname'] = pmc_filter_input($_POST['usr_lame']);
    $cfg['usr_mail']  = pmc_filter_input($_POST['usr_mail']);
    $cfg['usr_pass']  = pmc_filter_input($_POST['usr_pass']);
    $cfg['usr_skin']  = pmc_filter_input($_POST['usr_skin']);
    $cfg['usr_lang']  = pmc_filter_input($_POST['usr_lang']);
    
    $cfg['app_lang']  = pmc_filter_input($_POST['app_lang']);
    $cfg['app_skin']  = pmc_filter_input($_POST['app_skin']);
    $cfg['app_pcat']  = pmc_filter_input($_POST['app_pcat']);
    $cfg['app_pmov']  = pmc_filter_input($_POST['app_pmov']);
    $cfg['app_imov']  = pmc_filter_input($_POST['app_imov']);
    $cfg['app_iusr']  = pmc_filter_input($_POST['app_iusr']);
    $cfg['app_dmov']  = pmc_filter_input($_POST['app_dmov']);
    
    pmc_dbclose($pmc_dbconn);
  }
  if($err == 0) {echo 'install';}
  else {echo 'err';}
}
else {
  require_once 'tpl.frm.inc.php';
}

require_once 'tpl.ftr.inc.php';
?>