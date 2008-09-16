<?php
/**
* ./inc/func-v_s.inc.php (view settings functions)
*
* <I> ./inc/func-v_s.inc.php</I>
* <BR>This is the view settings functions file
* <BR>It contains all the functions
* <BR>used in the view side
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    10:48 2008-09-08
* @since      21:13 2008-09-07
* @access     public
* @package    pmc
* @subpackage Application Front
* @todo       stuff
*/

/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../lib/404.php';}
/**
* User settings
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_settings() {
  global $lang;
  $id = $_SESSION['pmc_usr_id'];
  $cnt['skin'] = 'view/settings/v_s.tpl.php';
  
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['set']['sets'];
  
  $cnt['page']['langs'] = pmc_lsdir(_APP_DIR.'lang/');
  $cnt['page']['skins'] = pmc_lsdir(_APP_DIR.'skin/');
    
  $result = pmc_qry_exec("SELECT * FROM pmc_set_usr WHERE usr_id = '{$id}'");
  $total = pmc_qry_total($result);
  if($total == 1) {
    $row = pmc_qry_row($result);
    $cnt['page']['usr_name']   = $row['usr_name'];
    $cnt['page']['usr_fname']  = $row['usr_fname'];
    $cnt['page']['usr_lname']  = $row['usr_lname'];
    $cnt['page']['usr_mail']  = $row['usr_mail'];
    $cnt['page']['usr_pass1']  = '';
    $cnt['page']['usr_pass2']  = '';
    $cnt['page']['usr_skin']   = $row['usr_skin'];
    $cnt['page']['usr_lang']   = $row['usr_lang'];
    $cnt['page']['usr_level']  = $row['usr_level'];
    $cnt['page']['usr_status'] = $row['usr_status'];
  }
    
  if(isset($_POST['usr_mod'])) {
    if(isset($_POST['usr_name']))   {$cnt['page']['usr_name']   = pmc_filter_input($_POST['usr_name']);}
    if(isset($_POST['usr_fname']))  {$cnt['page']['usr_fname']  = pmc_filter_input($_POST['usr_fname']);}
    if(isset($_POST['usr_lname']))  {$cnt['page']['usr_lname']  = pmc_filter_input($_POST['usr_lname']);}
    if(isset($_POST['usr_pass1']))  {$cnt['page']['usr_pass1']  = pmc_filter_input($_POST['usr_pass1']);}
    if(isset($_POST['usr_pass2']))  {$cnt['page']['usr_pass2']  = pmc_filter_input($_POST['usr_pass2']);}
    if(isset($_POST['usr_skin']))   {$cnt['page']['usr_skin']   = pmc_filter_input($_POST['usr_skin']);}
    if(isset($_POST['usr_lang']))   {$cnt['page']['usr_lang']   = pmc_filter_input($_POST['usr_lang']);}
    if(isset($_POST['usr_level']))  {$cnt['page']['usr_level']  = pmc_filter_input($_POST['usr_level']);}
    if(isset($_POST['usr_status'])) {$cnt['page']['usr_status'] = pmc_filter_input($_POST['usr_status']);}
    $err = 0;
    if($cnt['page']['usr_name'] == '')                                                              {$err = 1;}
    else if($cnt['page']['usr_fname'] == '')                                                        {$err = 1;}
    else if($cnt['page']['usr_lname'] == '')                                                        {$err = 1;}
    else if($cnt['page']['usr_pass1'] != '') {
      if($cnt['page']['usr_pass2'] == '') {$err = 1;}
    }
    else if($cnt['page']['usr_pass2'] != '') {
      if($cnt['page']['usr_pass1'] == '') {$err = 1;}
    }
    else if($cnt['page']['usr_pass1'] != '' && $cnt['page']['usr_pass2'] != '') {
      if($cnt['page']['usr_pass1'] != $cnt['page']['usr_pass2']) {
        $err = 1;
      }
    }
    else if($cnt['page']['usr_skin'] == '')                                                         {$err = 1;}
    else if($cnt['page']['usr_lang'] == '')                                                         {$err = 1;}
    else if(isset($_POST['usr_level']) && $cnt['page']['usr_level'] == '') {
      if($cnt['page']['usr_level'] >= $_SESSION['pmc_usr_level']) {$err = 1;}
    }
    else if(isset($_POST['usr_status']) && $cnt['page']['usr_status'] == '')                         {$err = 1;}
    if($err == 0) {
      $lock   = pmc_lock_tables(array('pmc_set_usr'));
      $upass = "";
      if($cnt['page']['usr_pass2'] != '') {
        $pass = md5($cnt['page']['usr_pass2']);
        $upass = "usr_pass = '{$pass}', ";
      }
      $update = pmc_qry_exec("UPDATE pmc_set_usr SET usr_name = '{$cnt['page']['usr_name']}', usr_fname = '{$cnt['page']['usr_fname']}', usr_lname = '{$cnt['page']['usr_lname']}', {$upass}usr_skin = '{$cnt['page']['usr_skin']}', usr_lang = '{$cnt['page']['usr_lang']}', usr_level = '{$cnt['page']['usr_level']}', usr_status = '{$cnt['page']['usr_status']}' WHERE usr_id = '{$id}' LIMIT 1");
      $unlock = pmc_unlock_tables();
      if($update === true) {
          $_SESSION['pmc_msg'] = 45;
          header("Location: " . _APP_URL . 'view/settings');
          exit;
      }
      else {$_SESSION['pmc_msg'] = 46; header("Location: "._APP_URL . 'view/settings'); exit;}
    }
    else {$_SESSION['pmc_msg'] = 16; header("Location: "._APP_URL . 'view/settings'); exit;}
  }
  //else {
    //$cnt['page'] = pmc_usr_details($id);
  //}
  return $cnt;
}
?>