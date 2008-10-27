<?php
/**
* ./inc/func-a_c.inc.php (admin categ functions)
*
* <I> ./inc/func-a_c.inc.php</I>
* <BR>This is the admin categ functions file
* <BR>It contains all the functions
* <BR>used in the admin side
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    19:10 2008-10-27
* @since      14:32 2008-09-03
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
* Add new category
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_categ_add() {
  global $lang;
  $cnt['skin'] = 'admin/categ/a_c-new.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['categ']['categs'] . _APP_SEP . $lang['categ']['add'];

  /*
  REMOVED FOR COMPATIBILITY WITH PHP < 5.2
  $egl = error_get_last();
  $res = strpos($egl['message'], 'POST Content-Length of');
  if ($res !== false ) {$_SESSION['pmc_msg'] = 17; header("Location: " . _APP_URL); exit;}
  else if(isset($_POST['cat_add'])) {
  */
  if(isset($_POST['cat_add'])) {
    if(isset($_POST['cat_tt']))   {$cnt['page']['cat_tt']   = pmc_filter_input($_POST['cat_tt']);}
    if(isset($_POST['cat_desc'])) {$cnt['page']['cat_desc'] = pmc_filter_input($_POST['cat_desc']);}
    if($cnt['page']['cat_tt'] != '' && $cnt['page']['cat_desc'] != '') {
      $lock    = pmc_lock_tables(array('pmc_mov_cat'));
      $id      = pmc_next_auto_id('pmc_mov_cat');
      $cat_pic = '';
      $err = 0;
      $pic_store = 2;
      if(isset($_FILES['cat_pic'])) {
        $pic_name     = $_FILES['cat_pic']['name'];
        $pic_type     = $_FILES['cat_pic']['type'];
        $pic_tmp_name = $_FILES['cat_pic']['tmp_name'];
        $pic_error    = $_FILES['cat_pic']['error'];
        $pic_size     = $_FILES['cat_pic']['size'];
        $allowed_file_types = array("image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/gif");
        if($pic_error == 0 && !in_array($pic_type, $allowed_file_types)) {$_SESSION['pmc_msg'] = 11; $err = 1;} /* not an image */
        else if ($pic_error == 2)                                        {$_SESSION['pmc_msg'] = 15; $err = 1;} /* too big */
        else if ($pic_error == 4)                                        {$err = 2;} /* no file uploaded but that's ok */
        else if ($pic_error == 3)                                        {$_SESSION['pmc_msg'] = 13; $err = 1;} /* partial upload */
        else if ($pic_error == 3)                                        {$_SESSION['pmc_msg'] = 13; $err = 1;} /* partial upload */
        if($pic_error == 0 && !is_uploaded_file($pic_tmp_name))          {$_SESSION['pmc_msg'] = 14; $err = 1;} /* not sent by form */
        if($err == 0) {
          $pic_ext  = pmc_pic_ext($pic_type);
          $cat_pic  = 'cat_' . $id . '.' . $pic_ext;
          $pic_path = _APP_DIR . 'var/pic_cat/';
          if (@move_uploaded_file($pic_tmp_name, $pic_path . $cat_pic)) {$pic_store = 1;}
          else {$pic_store = 0;}
        }
      }
      if($err == 0 || $err == 2) {
        $cat_ord = pmc_next_id('pmc_mov_cat', 'cat_ord');
        $insert  = pmc_qry_exec("INSERT INTO pmc_mov_cat (cat_pic, cat_tt, cat_ord, cat_desc) VALUES ('{$cat_pic}', '{$cnt['page']['cat_tt']}', '{$cat_ord}', '{$cnt['page']['cat_desc']}')");
        $unlock  = pmc_unlock_tables();
        if($insert === true) {
          if($pic_store == 1) {$_SESSION['pmc_msg'] = 23;}
          else {$_SESSION['pmc_msg'] = 29;}
          header("Location: " . _APP_URL . 'admin/categ/view/' . $id); exit;
        }
        else {$_SESSION['pmc_msg'] = 22; header("Location: "._APP_URL . 'admin/categ/add/new'); exit;}
      }
    }
    else {$_SESSION['pmc_msg'] = 16;}
  }
  else {
    $cnt['page']['cat_pic']  = '';
    $cnt['page']['cat_tt']   = '';
    $cnt['page']['cat_desc'] = '';
  }
  return $cnt;
}
/**
* Edit a category
*
* @param integer category id
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_categ_details($id) {
  global $lang;
  $cnt['skin'] = 'admin/categ/a_c-details.tpl.php';
  $cnt['tt']   = $lang['adm']['adm'] . _APP_SEP . $lang['categ']['categs'] . _APP_SEP . $lang['categ']['view'];
  
  /*
  REMOVED FOR COMPATIBILITY WITH PHP < 5.2
  $egl = error_get_last();
  $res = strpos($egl['message'], 'POST Content-Length of');
  if ($res !== false ) {$_SESSION['pmc_msg'] = 17; header("Location: " . _APP_URL); exit;}
  else if(isset($_POST['cat_mod'])) {
  */
  if(isset($_POST['cat_mod'])) {
    if(isset($_POST['cat_tt']))   {$cnt['page']['cat_tt'] = pmc_filter_input($_POST['cat_tt']);}
    if(isset($_POST['cat_desc'])) {$cnt['page']['cat_desc'] = pmc_filter_input($_POST['cat_desc']);}
    if($cnt['page']['cat_tt'] != '' && $cnt['page']['cat_desc'] != '') {
      $lock    = pmc_lock_tables(array('pmc_mov_cat'));
      //$id      = pmc_next_auto_id('pmc_mov_cat');
      $dbpic = pmc_qry_result(pmc_qry_exec("SELECT cat_pic FROM pmc_mov_cat WHERE cat_id = '{$id}' LIMIT 1"));
      $cat_pic     = $dbpic;
      $new_cat_pic = $dbpic;
      $err = 0;
      $pic_store = 2;
      if(isset($_FILES['cat_pic'])) {
        $pic_name     = $_FILES['cat_pic']['name'];
        $pic_type     = $_FILES['cat_pic']['type'];
        $pic_tmp_name = $_FILES['cat_pic']['tmp_name'];
        $pic_error    = $_FILES['cat_pic']['error'];
        $pic_size     = $_FILES['cat_pic']['size'];
        $allowed_file_types = array("image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/gif");
        if($pic_error == 0 && !in_array($pic_type, $allowed_file_types)) {$_SESSION['pmc_msg'] = 11; $err = 1;} /* not an image */
        else if ($pic_error == 2) {$_SESSION['pmc_msg'] = 15; $err = 1;} /* too big */
        else if ($pic_error == 4) {$err = 2;} /* no file uploaded but that's ok */
        else if ($pic_error == 3) {$_SESSION['pmc_msg'] = 13; $err = 1;} /* partial upload */
        if($pic_error == 0 && !is_uploaded_file($pic_tmp_name)) {$_SESSION['pmc_msg'] = 14; $err = 1;} /* not sent by form */
        if($err == 0) {
          $pic_ext = pmc_pic_ext($pic_type);
          $new_cat_pic = 'cat_' . $id . '.' . $pic_ext;
          $pic_path = _APP_DIR . 'var/pic_cat/';
          if(is_file($pic_path.$cat_pic)) {unlink($pic_path.$cat_pic);}
          if (@move_uploaded_file($pic_tmp_name, $pic_path . $new_cat_pic)) {$pic_store = 1;}
          else {$pic_store = 0;}
        }
      }
      if($err == 0 || $err == 2) {
        $update = pmc_qry_exec("UPDATE pmc_mov_cat SET cat_pic = '{$new_cat_pic}', cat_tt = '{$cnt['page']['cat_tt']}', cat_desc = '{$cnt['page']['cat_desc']}' WHERE cat_id = '{$id}' LIMIT 1");
        $unlock = pmc_unlock_tables();
        if($update === true) {
          if($pic_store == 1 || $pic_store == 2) {$_SESSION['pmc_msg'] = 25;}
          else {$_SESSION['pmc_msg'] = 30;}
          header("Location: " . _APP_URL . 'admin/categ/details/' . $id); exit;
        }
        else {$_SESSION['pmc_msg'] = 24; header("Location: " . _APP_URL . 'admin/categ/details/' . $id); exit;}
      }
      else {header("Location: " . _APP_URL . 'admin/categ/details/' . $id); exit;}
    }
    else {$_SESSION['pmc_msg'] = 16; header("Location: " . _APP_URL . 'admin/categ/details/' . $id); exit;}
  }
  else {
    $cnt['page'] = pmc_categ_details($id);
  }
  return $cnt;
}
/**
* View all categories
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_categ_view() {
  $cnt = NULL;
  global $lang;
  $cnt['skin'] = 'admin/categ/a_c-view.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['categ']['categs'] . _APP_SEP . $lang['categ']['viewall'];
  $cnt['page'] = array();
  $cnt['page']['cat_id'] = array();
  $cnt['page'] = pmc_categ_view();
  return $cnt;
}
?>