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
* @version    19:46 2008-10-29
* @since      14:22 2008-09-12
* @access     public
* @package    pmc
* @subpackage Setup
* @todo       stuff
*/


/**
* Prevent unauthorized access to other files
*/
define("_VALID_REQUEST", TRUE);
/**
* Security
*/
if(!is_readable('./setup.txt')) {die('Setup has been disabled.'); exit;}
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

if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] != '') {$server = $_SERVER['HTTP_HOST'];}
else if(isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] != '') {$server = $_SERVER['SERVER_NAME'];}

$check_err = 0;
$php_version = phpversion();
$php_file_uploads = (int) ini_get('file_uploads');
$gd_check = check_gd();
if(function_exists('apache_get_modules')) {
  if (in_array('mod_rewrite', apache_get_modules())) {$mod_rewrite = 1;}
  else {$mod_rewrite = 0;}
}
else {$mod_rewrite = 2;}

$php_short_open_tag   = (int) ini_get('short_open_tag');
$php_safe_mode        = (int) ini_get('safe_mode');
$php_register_globals = (int) ini_get('register_globals');
$php_magic_quotes_gpc = (int) ini_get('magic_quotes_gpg');
$php_allow_url_fopen  = (int) ini_get('allow_url_fopen');
  
$request_uri = str_replace('/setup/install.php', '/', $_SERVER['REQUEST_URI']);
$app_url = 'http://' . $server . $request_uri;

$cfg = array();

$cfg['app_url']   = $app_url;
if($mod_rewrite == 1) {$cfg['app_index'] = '1';}
else {$cfg['app_index'] = '0';}
$cfg['app_dir']   = str_replace('\\', '/', realpath(dirname('../index.php'))) . '/';

$cfg['db_host']   = 'localhost';
$cfg['db_user']   = '';
$cfg['db_pass']   = '';
$cfg['db_name']   = '';

$cfg['mod_mnu']   = '1';
$cfg['mod_usr']   = '1';
$cfg['mod_login'] = '1';
$cfg['mod_gen']   = '1';
$cfg['mod_src']   = '1';
$cfg['mod_imdb']  = '1';
$cfg['mod_lst']   = '1';
$cfg['mod_sts']   = '1';
$cfg['mod_apptt'] = '1';
$cfg['mod_adm']   = '1';

$cfg['usr_name']  = 'Root';
$cfg['usr_fname'] = '';
$cfg['usr_lname'] = '';
$cfg['usr_mail']  = '';
$cfg['usr_pass']  = '';
$cfg['usr_skin']  = 'pmc';
$cfg['usr_lang']  = 'en';

$cfg['app_lang']  = 'en';
$cfg['app_skin']  = 'pmc';
$cfg['app_pcat']  = '150';
$cfg['app_pmov']  = '150';
$cfg['app_imov']  = '10';
$cfg['app_iusr']  = '10';
$cfg['app_imed']  = '20';
$cfg['app_lmov']  = '5';

require_once 'tpl.hdr.inc.php';

if(isset($_POST['install'])) {
  $err = 0;
  $msg = '';
  $unwanted = array("\\", "\x00", "\n", "\r", "'", '"', "\xla", '&lt;', '&gt;', '<', '>');
  if(isset($_POST['db_host'])) {$cfg['db_host']   = trim(str_replace($unwanted, ' ', $_POST['db_host']));}
  if(isset($_POST['db_user'])) {$cfg['db_user']   = trim(str_replace($unwanted, ' ', $_POST['db_user']));}
  if(isset($_POST['db_pass'])) {$cfg['db_pass']   = trim(str_replace($unwanted, ' ', $_POST['db_pass']));}
  if(isset($_POST['db_name'])) {$cfg['db_name']   = trim(str_replace($unwanted, ' ', $_POST['db_name']));}
  
  if(isset($_POST['app_url']))   {$cfg['app_url']   = $_POST['app_url'];}
  if(isset($_POST['app_index'])) {$cfg['app_index'] = $_POST['app_index'];}
  if(isset($_POST['app_dir']))   {$cfg['app_dir']   = $_POST['app_dir'];}
  
  if(isset($_POST['usr_name']))  {$cfg['usr_name']  = $_POST['usr_name'];}
  if(isset($_POST['usr_fname'])) {$cfg['usr_fname'] = $_POST['usr_fname'];}
  if(isset($_POST['usr_lname'])) {$cfg['usr_lname'] = $_POST['usr_lname'];}
  if(isset($_POST['usr_mail']))  {$cfg['usr_mail']  = $_POST['usr_mail'];}
  if(isset($_POST['usr_pass']))  {$cfg['usr_pass']  = $_POST['usr_pass'];}
  if(isset($_POST['usr_skin']))  {$cfg['usr_skin']  = $_POST['usr_skin'];}
  if(isset($_POST['usr_lang']))  {$cfg['usr_lang']  = $_POST['usr_lang'];}

  if(isset($_POST['app_lang'])) {$cfg['app_lang']  = $_POST['app_lang'];}
  if(isset($_POST['app_skin'])) {$cfg['app_skin']  = $_POST['app_skin'];}
  if(isset($_POST['app_pcat'])) {$cfg['app_pcat']  = $_POST['app_pcat'];}
  if(isset($_POST['app_pmov'])) {$cfg['app_pmov']  = $_POST['app_pmov'];}
  if(isset($_POST['app_imov'])) {$cfg['app_imov']  = $_POST['app_imov'];}
  if(isset($_POST['app_iusr'])) {$cfg['app_iusr']  = $_POST['app_iusr'];}
  if(isset($_POST['app_imed'])) {$cfg['app_imed']  = $_POST['app_imed'];}
  if(isset($_POST['app_lmov'])) {$cfg['app_lmov']  = $_POST['app_lmov'];}

  if(isset($_POST['mod_mnu']))   {$cfg['mod_mnu']   = $_POST['mod_mnu'];}
  if(isset($_POST['mod_usr']))   {$cfg['mod_usr']   = $_POST['mod_usr'];}
  if(isset($_POST['mod_login'])) {$cfg['mod_login'] = $_POST['mod_login'];}
  if(isset($_POST['mod_gen']))   {$cfg['mod_gen']   = $_POST['mod_gen'];}
  if(isset($_POST['mod_src']))   {$cfg['mod_src']   = $_POST['mod_src'];}
  if(isset($_POST['mod_imdb']))  {$cfg['mod_imdb']  = $_POST['mod_imdb'];}
  if(isset($_POST['mod_lst']))   {$cfg['mod_lst']   = $_POST['mod_lst'];}
  if(isset($_POST['mod_sts']))   {$cfg['mod_sts']   = $_POST['mod_sts'];}
  if(isset($_POST['mod_apptt'])) {$cfg['mod_apptt'] = $_POST['mod_apptt'];}
  if(isset($_POST['mod_adm']))   {$cfg['mod_adm']   = $_POST['mod_adm'];}
  
  $pmc_dbconn = pmc_dbopen($cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);
  if(!$pmc_dbconn) {$err = 1; $msg = 'Database information is invalid!';}
  else {
    $cfg['app_url']   = pmc_filter_input($_POST['app_url']);
    $cfg['app_index'] = pmc_filter_input($_POST['app_index']);
    $cfg['app_dir']   = pmc_filter_input($_POST['app_dir']);
    
    $cfg['usr_name']  = pmc_filter_input($_POST['usr_name']);
    $cfg['usr_fname'] = pmc_filter_input($_POST['usr_fname']);
    $cfg['usr_lname'] = pmc_filter_input($_POST['usr_lname']);
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
    $cfg['app_imed']  = pmc_filter_input($_POST['app_imed']);
    $cfg['app_lmov']  = pmc_filter_input($_POST['app_lmov']);
          
    $cfg['mod_mnu']   = pmc_filter_input($_POST['mod_mnu']);
    $cfg['mod_usr']   = pmc_filter_input($_POST['mod_usr']);
    $cfg['mod_login'] = pmc_filter_input($_POST['mod_login']);
    $cfg['mod_gen']   = pmc_filter_input($_POST['mod_gen']);
    $cfg['mod_src']   = pmc_filter_input($_POST['mod_src']);
    $cfg['mod_imdb']  = pmc_filter_input($_POST['mod_imdb']);
    $cfg['mod_lst']   = pmc_filter_input($_POST['mod_lst']);
    $cfg['mod_sts']   = pmc_filter_input($_POST['mod_sts']);
    $cfg['mod_apptt'] = pmc_filter_input($_POST['mod_apptt']);
    $cfg['mod_adm']   = pmc_filter_input($_POST['mod_adm']);
    
    if($cfg['app_url'] == '') {$err = 1; $msg = 'Application URL is empty!';}
    else if($cfg['app_dir'] == '') {$err = 1; $msg = 'Application path is empty!';}
    else if($cfg['app_dir'] != '' && !is_writable($cfg['app_dir'] . 'inc/cfg.inc.php')) {$err = 1; $msg = 'Config file not writeable! Check application path and access permissions!';}
    else {
      if($cfg['usr_name'] == '') {$err = 1; $msg = 'User alias is empty!';}
      else if($cfg['usr_fname'] == '') {$err = 1; $msg = 'User first name is empty!';}
      else if($cfg['usr_lname'] == '') {$err = 1; $msg = 'User last name is empty!';}
      else if($cfg['usr_mail'] == '') {$err = 1; $msg = 'User email is empty!';}
      else if(!pmc_is_email($cfg['usr_mail'])) {$err = 1; $msg = 'User email is invalid!';}
      else if($cfg['usr_pass'] == '') {$err = 1; $msg = 'User password is empty!';}
      else {
        if(!pmc_is_int($cfg['app_pcat'])) {$err = 1; $msg = 'Category picture thumbnail size is invalid!';}
        else if(!pmc_is_int($cfg['app_pmov'])) {$err = 1; $msg = 'Movie picture thumbnail size is invalid!';}
        else if(!pmc_is_int($cfg['app_imov'])) {$err = 1; $msg = 'Number of movies per page is invalid!';}
        else if(!pmc_is_int($cfg['app_iusr'])) {$err = 1; $msg = 'Number of users per page is invalid!';}
        else if(!pmc_is_int($cfg['app_imed'])) {$err = 1; $msg = 'Number of media per page is invalid!';}
        else if(!pmc_is_int($cfg['app_lmov'])) {$err = 1; $msg = 'Number of latest movies to show is invalid!';}
      }
    }
  }
  if($err == 0) {
    // 1 config file
    if($cfg['app_index'] == 0) {$cfg['app_index'] = 'index.php/';}
    else if($cfg['app_index'] == 1) {$cfg['app_index'] = '';}
    $datime = date("H:i Y-m-d");
    $c = gen_cfg_str($cfg, $datime);
    $chk = chk_cfg_wrt($cfg['app_dir'].'inc/', 'cfg.inc.php');
    echo '<div class="msg">';
    if($chk == 0) {
      $w = wrt_cfg_str($c, $cfg['app_dir'].'inc/cfg.inc.php');
      if($w == 0) {echo '<div class="ok">Configuration file sucessfully saved!</div>';}
      else {echo '<div class="err">Config file not saved!</div>';}
    }
    else {echo '<div class="err">Config file not saved!</div>';}
    // 2 db structure
    $dbs_err = 0;
    $dbs = split_sql($cfg['app_dir'].'setup/db_structure.sql', ";");
    $t_dbs = count($dbs);
    for($i=0;$i<$t_dbs;$i++) {
      $r[$i] = pmc_qry_exec($dbs[$i]);
      if($r[$i] !== true) {$dbs_err = 1;}
    }
    if($dbs_err == 0) {echo '<div class="ok">Database structure sucessfully saved ('.$t_dbs.' queries)!</div>';}
    else {echo '<div class="err">Error saving database structure!</div>';}
    // 3 db_values
    $dbv_err = 0;
    $dbv = split_sql($cfg['app_dir'].'setup/db_values.sql', ";");
    $t_dbv = count($dbv);
    for($j=0;$j<$t_dbv;$j++) {
      $r[$j] = pmc_qry_exec($dbv[$j]);
      if($r[$j] !== true) {$dbv_err = 1;}
    }
    if($dbv_err == 0) {echo '<div class="ok">Database values sucessfully saved ('.$t_dbv.' queries)!</div>';}
    else {echo '<div class="err">Error saving database values!</div>';}
    // user
    $dbx_err = 0;
    $cfg['usr_pass'] = md5($cfg['usr_pass']);
    $datex = date("Y-m-d");
    $ru = pmc_qry_exec("INSERT INTO pmc_set_usr (usr_name, usr_fname, usr_lname, usr_mail, usr_pass, usr_skin, usr_lang, usr_level, usr_status, usr_date) VALUES ('{$cfg['usr_name']}', '{$cfg['usr_fname']}', '{$cfg['usr_lname']}', '{$cfg['usr_mail']}', '{$cfg['usr_pass']}', '{$cfg['usr_skin']}', '{$cfg['usr_lang']}', '5', '1', '{$datex}')");
    if($ru !== true) {$dbx_err = 1;}
    // settings
    $rs1 = pmc_qry_exec("INSERT INTO pmc_set_cfg (cfg_set, cfg_val) VALUES ('LANG', '{$cfg['app_lang']}')");
    if($rs1 !== true) {$dbx_err = 1;}
    $rs2 = pmc_qry_exec("INSERT INTO pmc_set_cfg (cfg_set, cfg_val) VALUES ('SKIN', '{$cfg['app_skin']}')");
    if($rs2 !== true) {$dbx_err = 1;}
    $rs3 = pmc_qry_exec("INSERT INTO pmc_set_cfg (cfg_set, cfg_val) VALUES ('PCAT', '{$cfg['app_pcat']}')");
    if($rs3 !== true) {$dbx_err = 1;}
    $rs4 = pmc_qry_exec("INSERT INTO pmc_set_cfg (cfg_set, cfg_val) VALUES ('PMOV', '{$cfg['app_pmov']}')");
    if($rs4 !== true) {$dbx_err = 1;}
    $rs5 = pmc_qry_exec("INSERT INTO pmc_set_cfg (cfg_set, cfg_val) VALUES ('IMOV', '{$cfg['app_imov']}')");
    if($rs5 !== true) {$dbx_err = 1;}
    $rs6 = pmc_qry_exec("INSERT INTO pmc_set_cfg (cfg_set, cfg_val) VALUES ('IUSR', '{$cfg['app_iusr']}')");
    if($rs6 !== true) {$dbx_err = 1;}
    $rs7 = pmc_qry_exec("INSERT INTO pmc_set_cfg (cfg_set, cfg_val) VALUES ('IMED', '{$cfg['app_imed']}')");
    if($rs7 !== true) {$dbx_err = 1;}
    $rs8 = pmc_qry_exec("INSERT INTO pmc_set_cfg (cfg_set, cfg_val) VALUES ('LMOV', '{$cfg['app_lmov']}')");
    if($rs8 !== true) {$dbx_err = 1;}
    $rs9 = pmc_qry_exec("INSERT INTO pmc_set_cfg (cfg_set, cfg_val) VALUES ('IMDBD', '0')");
    if($rs9 !== true) {$dbx_err = 1;}
    $rs10 = pmc_qry_exec("INSERT INTO pmc_set_cfg (cfg_set, cfg_val) VALUES ('IMDBP', '0')");
    if($rs10 !== true) {$dbx_err = 1;}
    if($dbx_err == 0) {echo '<div class="ok">User and settings sucessfully saved (11 queries)!</div>';}
    else {echo '<div class="err">Error saving user and settings!</div>';}
    // optimization
    $dbo_err = 0;
    $dbo = split_sql($cfg['app_dir'].'setup/db_optimization.sql', ";");
    $t_dbo = count($dbo);
    for($k=0;$k<$t_dbo;$k++) {
      $ro[$k] = pmc_qry_exec($dbo[$k]);
      if($ro[$k] == null) {$dbo_err = 1;}
    }
    if($dbo_err == 0) {echo '<div class="ok">Database optimization sucessfull ('.$t_dbo.' queries)!</div>';}
    else {echo '<div class="err">Database optimization error!</div>';}
    echo '</div>';
    // final message
    echo '<div class="msg">';
    echo '<br />Setup is finished.<br />';
    echo '<br />Don\'t forget to remove the write permissions on the configuration file<br />('.$cfg['app_dir'].'inc/cfg.inc.php)<br />';
    echo 'and to delete the setup.txt file<br />('.$cfg['app_dir'].'setup/setup.txt).<br />';
    echo '<br />If you encountered errors please read the manual and <a href="install.php" title="phpMovieCollection Setup">try again</a>.<br />';
    echo 'Else, <a href="'.$cfg['app_url'].'" title="phpMovieCollection">have fun with phpMovieCollection</a>!';
    echo '</div>';
    if($pmc_dbconn) {pmc_dbclose($pmc_dbconn);}
  }
  else {
    echo '<div class="msg">';
    echo '<div class="err">';
    echo $msg;
    echo '</div>';
    echo '</div>';
    require_once 'tpl.frm.inc.php';
  }
}
else {
  require_once 'tpl.chk.inc.php';
  if($check_err == 0) {
    require_once 'tpl.frm.inc.php';
  }
  else {
    echo '<div class="msg">';
    echo '<span class="err">';
    echo 'Your system does not meet the minimum system requirements for installing phpMovieCollection. Please read the manual and <a href="install.php" title="phpMovieCollection Setup">try again</a> or use manual setup.';
    echo '</span>';
    echo '</div>';
  }
}

require_once 'tpl.ftr.inc.php';
?>