<?php
/**
* ./inc/func-a_s.inc.php (admin settings functions)
*
* <I> ./inc/func-a_s.inc.php</I>
* <BR>This is the admin settings functions file
* <BR>It contains all the functions
* <BR>used in the admin side
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    16:12 2008-09-03
* @since      16:12 2008-09-03
* @access     public
* @package    phpMyMovieCollection
* @subpackage Application Back
* @todo       Everything :-)
*/

/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../lib/404.php';}
/**
* Application settings
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_adm_settings() {
  global $lang;
  $cnt['skin'] = 'admin.settings.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['set']['sets'];
  
  $cnt['page']['langs'] = pmmc_lsdir(_APP_DIR.'lang/');
  $cnt['page']['skins'] = pmmc_lsdir(_APP_DIR.'skin/');
  
  if(isset($_POST['set_save'])) {
    if(isset($_POST['set_lang'])) {$cnt['page']['lang'] = pmmc_filter_input($_POST['set_lang']);}
    if(isset($_POST['set_skin'])) {$cnt['page']['skin'] = pmmc_filter_input($_POST['set_skin']);}
    if(isset($_POST['set_pcat'])) {$cnt['page']['pcat'] = pmmc_filter_input($_POST['set_pcat']);}
    if(isset($_POST['set_pmov'])) {$cnt['page']['pmov'] = pmmc_filter_input($_POST['set_pmov']);}
    if(isset($_POST['set_imov'])) {$cnt['page']['imov'] = pmmc_filter_input($_POST['set_imov']);}
    if(isset($_POST['set_iusr'])) {$cnt['page']['iusr'] = pmmc_filter_input($_POST['set_iusr']);}
    $err = 0;
    if($cnt['page']['lang']      == '') {$err = 1;}
    else if($cnt['page']['skin'] == '') {$err = 1;}
    else if($cnt['page']['pcat'] == '') {$err = 1;}
    else if($cnt['page']['pmov'] == '') {$err = 1;}
    else if($cnt['page']['imov'] == '') {$err = 1;}
    else if($cnt['page']['iusr'] == '') {$err = 1;}
    if($err == 0) {
      $u[] = pmmc_cfg_var_set('LANG', $cnt['page']['lang']);
      $u[] = pmmc_cfg_var_set('SKIN', $cnt['page']['skin']);
      $u[] = pmmc_cfg_var_set('PCAT', $cnt['page']['pcat']);
      $u[] = pmmc_cfg_var_set('PMOV', $cnt['page']['pmov']);
      $u[] = pmmc_cfg_var_set('IMOV', $cnt['page']['imov']);
      $u[] = pmmc_cfg_var_set('IUSR', $cnt['page']['iusr']);
      $res = 1;
      foreach($u as $key => $value) {if($value !== true) {$res = 0; break;}}
      if($res == 1) {$_SESSION['pmmc_msg'] = 41;}
      else {$_SESSION['pmmc_msg'] = 42;}
    }
    else {$_SESSION['pmmc_msg'] = 16;}
    header("Location: "._APP_URL . 'admin/settings'); exit;
  }
  else {
    $cnt['page']['lang']  = pmmc_qry_result(pmmc_qry_exec("SELECT cfg_val FROM pmmc_set_cfg WHERE cfg_set = 'LANG'"));
    $cnt['page']['skin']  = pmmc_qry_result(pmmc_qry_exec("SELECT cfg_val FROM pmmc_set_cfg WHERE cfg_set = 'SKIN'"));
    $cnt['page']['pcat']  = pmmc_qry_result(pmmc_qry_exec("SELECT cfg_val FROM pmmc_set_cfg WHERE cfg_set = 'PCAT'"));
    $cnt['page']['pmov']  = pmmc_qry_result(pmmc_qry_exec("SELECT cfg_val FROM pmmc_set_cfg WHERE cfg_set = 'PMOV'"));
    $cnt['page']['imov']  = pmmc_qry_result(pmmc_qry_exec("SELECT cfg_val FROM pmmc_set_cfg WHERE cfg_set = 'IMOV'"));
    $cnt['page']['iusr']  = pmmc_qry_result(pmmc_qry_exec("SELECT cfg_val FROM pmmc_set_cfg WHERE cfg_set = 'IUSR'"));
  }
  return $cnt;
}
?>