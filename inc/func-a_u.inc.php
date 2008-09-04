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
* Add new user
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_adm_usr_add() {
  global $lang;
  $cnt['skin'] = 'admin.usr.add.new.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['usr']['usrs'] . _APP_SEP . $lang['usr']['add'];
  
  $cnt['page']['langs'] = pmmc_lsdir(_APP_DIR.'lang/');
  $cnt['page']['skins'] = pmmc_lsdir(_APP_DIR.'skin/');

  if(isset($_POST['usr_add'])) {
    
    if(isset($_POST['usr_name']))   {$cnt['page']['usr_name']   = pmmc_filter_input($_POST['usr_name']);}
    if(isset($_POST['usr_fname']))  {$cnt['page']['usr_fname']  = pmmc_filter_input($_POST['usr_fname']);}
    if(isset($_POST['usr_lname']))  {$cnt['page']['usr_lname']  = pmmc_filter_input($_POST['usr_lname']);}
    if(isset($_POST['usr_mail1']))  {$cnt['page']['usr_mail1']  = pmmc_filter_input($_POST['usr_mail1']);}
    if(isset($_POST['usr_mail2']))  {$cnt['page']['usr_mail2']  = pmmc_filter_input($_POST['usr_mail2']);}
    if(isset($_POST['usr_pass1']))  {$cnt['page']['usr_pass1']  = pmmc_filter_input($_POST['usr_pass1']);}
    if(isset($_POST['usr_pass2']))  {$cnt['page']['usr_pass2']  = pmmc_filter_input($_POST['usr_pass2']);}
    if(isset($_POST['usr_skin']))   {$cnt['page']['usr_skin']   = pmmc_filter_input($_POST['usr_skin']);}
    if(isset($_POST['usr_lang']))   {$cnt['page']['usr_lang']   = pmmc_filter_input($_POST['usr_lang']);}
    if(isset($_POST['usr_level']))  {$cnt['page']['usr_level']  = pmmc_filter_input($_POST['usr_level']);}
    if(isset($_POST['usr_status'])) {$cnt['page']['usr_status'] = pmmc_filter_input($_POST['usr_status']);}
    $err = 0;
    $check_email = pmmc_qry_total(pmmc_qry_exec("SELECT usr_id FROM pmmc_set_usr WHERE usr_mail = '{$cnt['page']['usr_mail1']}' LIMIT 1"));
    if($check_email != 0) {$_SESSION['pmmc_msg'] = 47; header("Location: "._APP_URL . 'admin/users/add/new'); exit;}
    else if($cnt['page']['usr_name'] == '')                                                              {$err = 1;}
    else if($cnt['page']['usr_fname'] == '')                                                             {$err = 1;}
    else if($cnt['page']['usr_lname'] == '')                                                             {$err = 1;}
    else if($cnt['page']['usr_mail1'] == '' || !pmmc_is_email($cnt['page']['usr_mail1']))                {$err = 1;}
    else if($cnt['page']['usr_mail2'] == '' || !pmmc_is_email($cnt['page']['usr_mail2']))                {$err = 1;}
    else if($cnt['page']['usr_mail1'] != $cnt['page']['usr_mail2'])                                      {$err = 1;}
    else if($cnt['page']['usr_pass1'] == '')                                                             {$err = 1;}
    else if($cnt['page']['usr_pass2'] == '')                                                             {$err = 1;}
    else if($cnt['page']['usr_pass1'] != $cnt['page']['usr_pass2'])                                      {$err = 1;}
    else if($cnt['page']['usr_skin'] == '')                                                              {$err = 1;}
    else if($cnt['page']['usr_lang'] == '')                                                              {$err = 1;}
    else if($cnt['page']['usr_level'] == '' || $cnt['page']['usr_level'] >= $_SESSION['pmmc_usr_level']) {$err = 1;}
    else if($cnt['page']['usr_status'] == '')                                                            {$err = 1;}
    if($err == 0) {
      $lock   = pmmc_lock_tables(array('pmmc_set_usr'));
      $id     = pmmc_next_auto_id('pmmc_set_usr');
      $udate  = date("Y-m-d");
      $upass = md5($cnt['page']['usr_pass2']);
      $insert = pmmc_qry_exec("INSERT INTO pmmc_set_usr (usr_name, usr_fname, usr_lname, usr_mail, usr_pass, usr_skin, usr_lang, usr_level, usr_status, usr_date) VALUES ('{$cnt['page']['usr_name']}', '{$cnt['page']['usr_fname']}', '{$cnt['page']['usr_lname']}', '{$cnt['page']['usr_mail2']}', '{$upass}', '{$cnt['page']['usr_skin']}', '{$cnt['page']['usr_lang']}', '{$cnt['page']['usr_level']}', '{$cnt['page']['usr_status']}', '{$udate}')");
      $unlock = pmmc_unlock_tables();
      if($insert === true) {
          $_SESSION['pmmc_msg'] = 43;
          header("Location: " . _APP_URL . 'admin/users/details/' . $id);
          exit;
      }
      else {$_SESSION['pmmc_msg'] = 44; header("Location: "._APP_URL . 'admin/users/add/new'); exit;}
    }
    else {$_SESSION['pmmc_msg'] = 16;}
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
function pmmc_adm_usr_details($id) {
  global $lang;
  $id_level = pmmc_qry_result(pmmc_qry_exec("SELECT usr_level FROM pmmc_set_usr WHERE usr_id = '{$id}'"));
  if($id_level == 0) {$_SESSION['pmmc_msg'] = 48; header("Location: "._APP_URL . 'admin/users'); exit;}
  
  if($_SESSION['pmmc_usr_level'] == 5) {
    $cnt['skin'] = 'admin.usr.view.id.tpl.php';
  }
  else {
    if($_SESSION['pmmc_usr_id'] != 1 && $_SESSION['pmmc_usr_id'] == $id) {
      $cnt['skin'] = 'admin.usr.view.own.tpl.php';
    }
    else if($_SESSION['pmmc_usr_level'] > $id_level && $_SESSION['pmmc_usr_level'] >= 4) {
      $cnt['skin'] = 'admin.usr.viewl.id.tpl.php';
    }
    else if($_SESSION['pmmc_usr_level'] <= $id_level) {
      $cnt['skin'] = 'admin.usr.display.id.tpl.php';
    }
  }
  
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['usr']['usrs'] . _APP_SEP . $lang['usr']['view'];
  
  if(isset($_POST['usr_mod'])) {
    if(isset($_POST['usr_name']))   {$cnt['page']['usr_name']   = pmmc_filter_input($_POST['usr_name']);}
    if(isset($_POST['usr_fname']))  {$cnt['page']['usr_fname']  = pmmc_filter_input($_POST['usr_fname']);}
    if(isset($_POST['usr_lname']))  {$cnt['page']['usr_lname']  = pmmc_filter_input($_POST['usr_lname']);}
    if(isset($_POST['usr_pass1']))  {$cnt['page']['usr_pass1']  = pmmc_filter_input($_POST['usr_pass1']);}
    if(isset($_POST['usr_pass2']))  {$cnt['page']['usr_pass2']  = pmmc_filter_input($_POST['usr_pass2']);}
    if(isset($_POST['usr_skin']))   {$cnt['page']['usr_skin']   = pmmc_filter_input($_POST['usr_skin']);}
    if(isset($_POST['usr_lang']))   {$cnt['page']['usr_lang']   = pmmc_filter_input($_POST['usr_lang']);}
    if(isset($_POST['usr_level']))  {$cnt['page']['usr_level']  = pmmc_filter_input($_POST['usr_level']);}
    if(isset($_POST['usr_status'])) {$cnt['page']['usr_status'] = pmmc_filter_input($_POST['usr_status']);}
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
    else if($cnt['page']['usr_level'] == '' || $cnt['page']['usr_level'] >= $_SESSION['pmmc_usr_level']) {$err = 1;}
    else if($cnt['page']['usr_status'] == '')                                                            {$err = 1;}
    if($err == 0) {
      $lock   = pmmc_lock_tables(array('pmmc_set_usr'));
      $upass = "";
      if($cnt['page']['usr_pass2'] != '') {
        $pass = md5($cnt['page']['usr_pass2']);
        $upass = "usr_pass = '{$pass}', ";
      }
      $update = pmmc_qry_exec("UPDATE pmmc_set_usr SET usr_name = '{$cnt['page']['usr_name']}', usr_fname = '{$cnt['page']['usr_fname']}', usr_lname = '{$cnt['page']['usr_lname']}', {$upass}usr_skin = '{$cnt['page']['usr_skin']}', usr_lang = '{$cnt['page']['usr_lang']}', usr_level = '{$cnt['page']['usr_level']}', usr_status = '{$cnt['page']['usr_status']}' WHERE usr_id = '{$id}' LIMIT 1");
      $unlock = pmmc_unlock_tables();
      if($update === true) {
          $_SESSION['pmmc_msg'] = 45;
          header("Location: " . _APP_URL . 'admin/users/details/' . $id);
          exit;
      }
      else {$_SESSION['pmmc_msg'] = 46; header("Location: "._APP_URL . 'admin/users/details' . $id); exit;}
    }
    else {$_SESSION['pmmc_msg'] = 16;}
  }
  else {
    $cnt['page'] = pmmc_usr_details($id);
  }
  return $cnt;
}
/**
* Users - view all
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_adm_usr_view() {
  global $lang;
  $cnt['skin'] = 'admin.usr.view.all.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['usr']['usrs'] . _APP_SEP . $lang['categ']['viewall'];
  $cnt['page'] = pmmc_usr_view();
  //$cnt['page']['users'] = array();
  //$rw = array();
  return $cnt;
}
?>