<?php
/**
* ./inc/func-a_u.inc.php (admin users functions)
*
* <I> ./inc/func-a_u.inc.php</I>
* <BR>This is the admin users functions file
* <BR>It contains all the functions
* <BR>used in the admin side
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    11:18 2008-09-07
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
* Add new user
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_usr_add() {
  global $lang;
  $cnt['skin'] = 'admin/users/a_u-new.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['usr']['usrs'] . _APP_SEP . $lang['usr']['add'];
  
  $cnt['page']['langs'] = pmc_lsdir(_APP_DIR.'lang/');
  $cnt['page']['skins'] = pmc_lsdir(_APP_DIR.'skin/');

  if(isset($_POST['usr_add'])) {
    
    if(isset($_POST['usr_name']))   {$cnt['page']['usr_name']   = pmc_filter_input($_POST['usr_name']);}
    if(isset($_POST['usr_fname']))  {$cnt['page']['usr_fname']  = pmc_filter_input($_POST['usr_fname']);}
    if(isset($_POST['usr_lname']))  {$cnt['page']['usr_lname']  = pmc_filter_input($_POST['usr_lname']);}
    if(isset($_POST['usr_mail1']))  {$cnt['page']['usr_mail1']  = pmc_filter_input($_POST['usr_mail1']);}
    if(isset($_POST['usr_mail2']))  {$cnt['page']['usr_mail2']  = pmc_filter_input($_POST['usr_mail2']);}
    if(isset($_POST['usr_pass1']))  {$cnt['page']['usr_pass1']  = pmc_filter_input($_POST['usr_pass1']);}
    if(isset($_POST['usr_pass2']))  {$cnt['page']['usr_pass2']  = pmc_filter_input($_POST['usr_pass2']);}
    if(isset($_POST['usr_skin']))   {$cnt['page']['usr_skin']   = pmc_filter_input($_POST['usr_skin']);}
    if(isset($_POST['usr_lang']))   {$cnt['page']['usr_lang']   = pmc_filter_input($_POST['usr_lang']);}
    if(isset($_POST['usr_level']))  {$cnt['page']['usr_level']  = pmc_filter_input($_POST['usr_level']);}
    if(isset($_POST['usr_status'])) {$cnt['page']['usr_status'] = pmc_filter_input($_POST['usr_status']);}
    $err = 0;
    $check_email = pmc_qry_total(pmc_qry_exec("SELECT usr_id FROM pmc_set_usr WHERE usr_mail = '{$cnt['page']['usr_mail1']}' LIMIT 1"));
    if($check_email != 0) {$_SESSION['pmc_msg'] = 47; header("Location: "._APP_URL . 'admin/users/add/new'); exit;}
    else if($cnt['page']['usr_name'] == '')                                                              {$err = 1;}
    else if($cnt['page']['usr_fname'] == '')                                                             {$err = 1;}
    else if($cnt['page']['usr_lname'] == '')                                                             {$err = 1;}
    else if($cnt['page']['usr_mail1'] == '' || !pmc_is_email($cnt['page']['usr_mail1']))                {$err = 1;}
    else if($cnt['page']['usr_mail2'] == '' || !pmc_is_email($cnt['page']['usr_mail2']))                {$err = 1;}
    else if($cnt['page']['usr_mail1'] != $cnt['page']['usr_mail2'])                                      {$err = 1;}
    else if($cnt['page']['usr_pass1'] == '')                                                             {$err = 1;}
    else if($cnt['page']['usr_pass2'] == '')                                                             {$err = 1;}
    else if($cnt['page']['usr_pass1'] != $cnt['page']['usr_pass2'])                                      {$err = 1;}
    else if($cnt['page']['usr_skin'] == '')                                                              {$err = 1;}
    else if($cnt['page']['usr_lang'] == '')                                                              {$err = 1;}
    else if($cnt['page']['usr_level'] == '' || $cnt['page']['usr_level'] >= $_SESSION['pmc_usr_level']) {$err = 1;}
    else if($cnt['page']['usr_status'] == '')                                                            {$err = 1;}
    if($err == 0) {
      $lock   = pmc_lock_tables(array('pmc_set_usr'));
      $id     = pmc_next_auto_id('pmc_set_usr');
      $udate  = date("Y-m-d");
      $upass = md5($cnt['page']['usr_pass2']);
      $insert = pmc_qry_exec("INSERT INTO pmc_set_usr (usr_name, usr_fname, usr_lname, usr_mail, usr_pass, usr_skin, usr_lang, usr_level, usr_status, usr_date) VALUES ('{$cnt['page']['usr_name']}', '{$cnt['page']['usr_fname']}', '{$cnt['page']['usr_lname']}', '{$cnt['page']['usr_mail2']}', '{$upass}', '{$cnt['page']['usr_skin']}', '{$cnt['page']['usr_lang']}', '{$cnt['page']['usr_level']}', '{$cnt['page']['usr_status']}', '{$udate}')");
      $unlock = pmc_unlock_tables();
      if($insert === true) {
          $_SESSION['pmc_msg'] = 43;
          header("Location: " . _APP_URL . 'admin/users/details/' . $id);
          exit;
      }
      else {$_SESSION['pmc_msg'] = 44; header("Location: "._APP_URL . 'admin/users/add/new'); exit;}
    }
    else {$_SESSION['pmc_msg'] = 16;}
  }
  else {
    $cnt['page']['usr_name']   = '';
    $cnt['page']['usr_fname']  = '';
    $cnt['page']['usr_lname']  = '';
    $cnt['page']['usr_mail1']  = '';
    $cnt['page']['usr_mail2']  = '';
    $cnt['page']['usr_pass1']  = '';
    $cnt['page']['usr_pass2']  = '';
    $cnt['page']['usr_skin']   = _APP_SKIN;
    $cnt['page']['usr_lang']   = _APP_LANG;
    $cnt['page']['usr_level']  = 1;
    $cnt['page']['usr_status'] = 1;
  }
  return $cnt;
}
/**
* View user
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_usr_details($id) {
  global $lang;
  
  $id_level = pmc_qry_result(pmc_qry_exec("SELECT usr_level FROM pmc_set_usr WHERE usr_id = '{$id}'"));
  if($id_level == 0) {$_SESSION['pmc_msg'] = 48; header("Location: "._APP_URL . 'admin/users'); exit;}
  
  if($_SESSION['pmc_usr_level'] == 5) {
    $cnt['skin'] = 'admin/users/a_u-details.tpl.php';
  }
  else {
    if($_SESSION['pmc_usr_id'] != 1 && $_SESSION['pmc_usr_id'] == $id) {
      $cnt['skin'] = 'admin/users/a_u-details-own.tpl.php';
    }
    else if($_SESSION['pmc_usr_level'] > $id_level && $_SESSION['pmc_usr_level'] >= 4) {
      $cnt['skin'] = 'admin/users/a_u-details-limited.tpl.php';
    }
    else if($_SESSION['pmc_usr_level'] <= $id_level) {
      $cnt['skin'] = 'admin/users/a_u-details-show.tpl.php';
    }
  }
  
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['usr']['usrs'] . _APP_SEP . $lang['usr']['view'];
  
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
    else if($cnt['page']['usr_skin'] == '')                                                              {$err = 1;}
    else if($cnt['page']['usr_lang'] == '')                                                              {$err = 1;}
    else if(isset($_POST['usr_level']) && $cnt['page']['usr_level'] == '') {
      if($cnt['page']['usr_level'] >= $_SESSION['pmc_usr_level']) {$err = 1;}
    }
    else if(isset($_POST['usr_status']) && $cnt['page']['usr_status'] == '')                              {$err = 1;}
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
          header("Location: " . _APP_URL . 'admin/users/details/' . $id);
          exit;
      }
      else {$_SESSION['pmc_msg'] = 46; header("Location: "._APP_URL . 'admin/users/details' . $id); exit;}
    }
    else {$_SESSION['pmc_msg'] = 16; header("Location: "._APP_URL . 'admin/users/details' . $id); exit;}
  }
  //else {
    //$cnt['page'] = pmc_usr_details($id);
  //}
  return $cnt;
}
/**
* Users - view all
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_usr_view() {
  global $lang;
  $cnt['skin'] = 'admin/users/a_u-view.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['usr']['usrs'] . _APP_SEP . $lang['categ']['viewall'];
  $cnt['page'] = pmc_usr_view();
  return $cnt;
}
?>