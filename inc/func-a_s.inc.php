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
* @package    pmc
* @subpackage Application Back
* @todo       stuff
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
function pmc_adm_settings() {
  global $lang;
  $cnt['skin'] = 'admin/settings/a_s.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['set']['sets'];
  
  $cnt['page']['langs'] = pmc_lsdir(_APP_DIR.'lang/');
  $cnt['page']['skins'] = pmc_lsdir(_APP_DIR.'skin/');
  
  if(isset($_POST['set_save'])) {
    if(isset($_POST['set_lang'])) {$cnt['page']['lang'] = pmc_filter_input($_POST['set_lang']);}
    if(isset($_POST['set_skin'])) {$cnt['page']['skin'] = pmc_filter_input($_POST['set_skin']);}
    if(isset($_POST['set_pcat'])) {$cnt['page']['pcat'] = pmc_filter_input($_POST['set_pcat']);}
    if(isset($_POST['set_pmov'])) {$cnt['page']['pmov'] = pmc_filter_input($_POST['set_pmov']);}
    if(isset($_POST['set_imov'])) {$cnt['page']['imov'] = pmc_filter_input($_POST['set_imov']);}
    if(isset($_POST['set_iusr'])) {$cnt['page']['iusr'] = pmc_filter_input($_POST['set_iusr']);}
    if(isset($_POST['set_imed'])) {$cnt['page']['imed'] = pmc_filter_input($_POST['set_imed']);}
    if(isset($_POST['set_lmov'])) {$cnt['page']['lmov'] = pmc_filter_input($_POST['set_lmov']);}
    $err = 0;
    if($cnt['page']['lang']      == '') {$err = 1;}
    else if($cnt['page']['skin'] == '') {$err = 1;}
    else if($cnt['page']['pcat'] == '') {$err = 1;}
    else if($cnt['page']['pmov'] == '') {$err = 1;}
    else if($cnt['page']['imov'] == '') {$err = 1;}
    else if($cnt['page']['iusr'] == '') {$err = 1;}
    else if($cnt['page']['imed'] == '') {$err = 1;}
    else if($cnt['page']['lmov'] == '') {$err = 1;}
    if($err == 0) {
      $u[] = pmc_cfg_var_set('LANG', $cnt['page']['lang']);
      $u[] = pmc_cfg_var_set('SKIN', $cnt['page']['skin']);
      $u[] = pmc_cfg_var_set('PCAT', $cnt['page']['pcat']);
      $u[] = pmc_cfg_var_set('PMOV', $cnt['page']['pmov']);
      $u[] = pmc_cfg_var_set('IMOV', $cnt['page']['imov']);
      $u[] = pmc_cfg_var_set('IUSR', $cnt['page']['iusr']);
      $u[] = pmc_cfg_var_set('IMED', $cnt['page']['imed']);
      $u[] = pmc_cfg_var_set('LMOV', $cnt['page']['lmov']);
      $res = 1;
      foreach($u as $key => $value) {if($value !== true) {$res = 0; break;}}
      if($res == 1) {$_SESSION['pmc_msg'] = 41;}
      else {$_SESSION['pmc_msg'] = 42;}
    }
    else {$_SESSION['pmc_msg'] = 16;}
    header("Location: "._APP_URL . 'admin/settings'); exit;
  }
  else {
    $cnt['page']['lang']  = pmc_qry_result(pmc_qry_exec("SELECT cfg_val FROM pmc_set_cfg WHERE cfg_set = 'LANG'"));
    $cnt['page']['skin']  = pmc_qry_result(pmc_qry_exec("SELECT cfg_val FROM pmc_set_cfg WHERE cfg_set = 'SKIN'"));
    $cnt['page']['pcat']  = pmc_qry_result(pmc_qry_exec("SELECT cfg_val FROM pmc_set_cfg WHERE cfg_set = 'PCAT'"));
    $cnt['page']['pmov']  = pmc_qry_result(pmc_qry_exec("SELECT cfg_val FROM pmc_set_cfg WHERE cfg_set = 'PMOV'"));
    $cnt['page']['imov']  = pmc_qry_result(pmc_qry_exec("SELECT cfg_val FROM pmc_set_cfg WHERE cfg_set = 'IMOV'"));
    $cnt['page']['iusr']  = pmc_qry_result(pmc_qry_exec("SELECT cfg_val FROM pmc_set_cfg WHERE cfg_set = 'IUSR'"));
    $cnt['page']['imed']  = pmc_qry_result(pmc_qry_exec("SELECT cfg_val FROM pmc_set_cfg WHERE cfg_set = 'IMED'"));
    $cnt['page']['lmov']  = pmc_qry_result(pmc_qry_exec("SELECT cfg_val FROM pmc_set_cfg WHERE cfg_set = 'LMOV'"));
  }
  return $cnt;
}
?>