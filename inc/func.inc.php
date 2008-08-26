<?php
/**
* ./inc/func.inc.php (application functions and classes)
*
* <I> ./inc/func.inc.php</I>
* <BR>This is the application functions file
* <BR>It contains all the functions
* <BR>used in the application
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    14:19 2008-08-25
* @since      19:27 2008-08-19
* @access     public
* @package    phpMyMovieCollection
* @subpackage Application
* @todo       Everything :-)
*/

/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../lib/404.php';}
/**
* Additional modules
*
* Whether or not to load additional modules
*
* @return array modules
*/
function pmmc_mod_add() {
  global $ap_cfg;
  $mod = array();
  $i=0;
  foreach($ap_cfg['mod'] as $key => $value) {

    $mod[$i]['name'] = $key;
    if($value == 1) {$mod[$i]['file'] = $key;}
    else {$mod[$i]['file'] = 'blank';}
    $i++;
  }
  return $mod;
}
/**
* Check for admin get request and act accordingly
*
* @return mixed
*/
function pmmc_admin() {
  $cnt= NULL;
  if($_GET['admin'] != '' && $_SESSION['pmmc_usr_level'] >= 3) {
    switch($_GET['admin']) {
      /**
      * Categories administration
      */
      case 'categ'  : {$cnt = pmmc_admin_categ(); break;}
      /**
      * Movies administration
      */
      case 'movies' : {break;}
      /**
      * Users administration
      */
      case 'users'  : {break;}
      default       : {header("Location: "._APP_URL); exit; break;}
    }
  }
  else {header("Location: "._APP_URL); exit;}
  return $cnt;
}
/**
* Categories administration function
*
* @return mixed
*/
function pmmc_admin_categ() {
  $cnt = NULL;
  if(isset($_GET['view']) && $_GET['view'] != '') {
    if($_GET['view'] == 'all') {
      /**
      * View all categories
      */
      $cnt = pmmc_categ_view_all();
    }
    else if(pmmc_is_int($_GET['view'])) {
      /**
      * View (edit) one category
      */
      $cnt = pmmc_categ_view($_GET['view']);
    }
    else {header("Location: "._APP_URL); exit;}
  }
  else if(isset($_GET['add']) && $_GET['add'] == 'new') {
    /**
    * Add new category
    */
    $cnt = pmmc_categ_add();
  }
  else {header("Location: "._APP_URL); exit;}
  return $cnt;
}
/**
* Category add
*
* @return mixed
*/
function pmmc_categ_add() {
  global $lang;
  $cnt['skin'] = 'admin.categ.add.new.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['categ']['categs'] . _APP_SEP . $lang['categ']['add'];
  //$_SESSION['pmmc_msg']  = 21;
  $cnt['page']['cat_pic']  = '';
  $cnt['page']['cat_tt']   = '';
  $cnt['page']['cat_desc'] = '';
  
  $egl = error_get_last();
  $res = strpos($egl['message'], 'POST Content-Length of');
  if ($res !== false ) {$_SESSION['pmmc_msg'] = 17; header("Location: " . _APP_URL); exit;}
  else if(isset($_POST['cat_add'])) {
    if(isset($_POST['cat_tt']))   {$cnt['page']['cat_tt']   = pmmc_filter_input($_POST['cat_tt']);}
    if(isset($_POST['cat_desc'])) {$cnt['page']['cat_desc'] = pmmc_filter_input($_POST['cat_desc']);}
    if($cnt['page']['cat_tt'] != '' && $cnt['page']['cat_desc'] != '') {
      $lock    = pmmc_lock_tables(array('pmmc_mov_cat'));
      $id      = pmmc_next_auto_id('pmmc_mov_cat');
      $cat_pic = '';
      $err = 0;
      if(isset($_FILES['cat_pic'])) {
        $pic_name     = $_FILES['cat_pic']['name'];
        $pic_type     = $_FILES['cat_pic']['type'];
        $pic_tmp_name = $_FILES['cat_pic']['tmp_name'];
        $pic_error    = $_FILES['cat_pic']['error'];
        $pic_size     = $_FILES['cat_pic']['size'];
        $allowed_file_types = array("image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/gif");
        if($pic_error == 0 && !in_array($pic_type, $allowed_file_types)) {$_SESSION['pmmc_msg'] = 11; $err = 1;} /* not an image */
        else if ($pic_error == 2)                                        {$_SESSION['pmmc_msg'] = 15; $err = 1;} /* too big */
        //else if ($pic_error == 4)                                      {$err = 1;} /* no file uploaded but that's ok */
        else if ($pic_error == 3)                                        {$_SESSION['pmmc_msg'] = 13; $err = 1;} /* partial upload */
        else if ($pic_error == 3)                                        {$_SESSION['pmmc_msg'] = 13; $err = 1;} /* partial upload */
        if($pic_error == 0 && !is_uploaded_file($pic_tmp_name))          {$_SESSION['pmmc_msg'] = 14; $err = 1;} /* not sent by form */
        if($err == 0) {
          $pic_ext  = pmmc_pic_ext($pic_type);
          $cat_pic  = 'cat_' . $id . '.' . $pic_ext;
          $pic_path = _APP_DIR . 'var/pic_cat/';
          move_uploaded_file($pic_tmp_name, $pic_path . $cat_pic);
        }
      }
      if($err == 0) {
        $cat_ord = pmmc_next_id('pmmc_mov_cat', 'cat_ord');
        $insert  = pmmc_qry_exec("INSERT INTO pmmc_mov_cat (cat_pic, cat_tt, cat_ord, cat_desc) VALUES ('{$cat_pic}', '{$cnt['page']['cat_tt']}', '{$cat_ord}', '{$cnt['page']['cat_desc']}')");
        $unlock  = pmmc_unlock_tables();
        if($insert === true) {$_SESSION['pmmc_msg'] = 23; header("Location: " . _APP_URL . 'admin/categ/view/' . $id); exit;}
        else {$_SESSION['pmmc_msg'] = 22; header("Location: "._APP_URL . 'admin/categ/add/new'); exit;}
      }
    }
    else {$_SESSION['pmmc_msg'] = 16;}
  }
  return $cnt;
}
/**
* Category edit
*
* @return mixed
*/
function pmmc_categ_view($id) {
  global $lang;
  $cnt['skin'] = 'admin.categ.view.id.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['categ']['categs'] . _APP_SEP . $lang['categ']['view'];
  //$_SESSION['pmmc_msg'] = 21;
  $result = pmmc_qry_exec("SELECT * FROM pmmc_mov_cat WHERE cat_id = '{$id}'");
  $total = pmmc_qry_total($result);
  if($total == 1) {
    $row = pmmc_qry_row($result);
    $cnt['page']['cat_pic']  = $row['cat_pic'];
    $cnt['page']['cat_tt']   = $row['cat_tt'];
    $cnt['page']['cat_desc'] = $row['cat_desc'];
  }
  else {
    $cnt['page']['cat_pic']  = '';
    $cnt['page']['cat_tt']   = '';
    $cnt['page']['cat_desc'] = '';
  }
  $egl = error_get_last();
  $res = strpos($egl['message'], 'POST Content-Length of');
  if ($res !== false ) {$_SESSION['pmmc_msg'] = 17; header("Location: " . _APP_URL); exit;}
  else if(isset($_POST['cat_mod'])) {
    if(isset($_POST['cat_tt']))   {$cnt['page']['cat_tt'] = pmmc_filter_input($_POST['cat_tt']);}
    if(isset($_POST['cat_desc'])) {$cnt['page']['cat_desc'] = pmmc_filter_input($_POST['cat_desc']);}
    if($cnt['page']['cat_tt'] != '' && $cnt['page']['cat_desc'] != '') {
      $lock    = pmmc_lock_tables(array('pmmc_mov_cat'));
      //$id      = pmmc_next_auto_id('pmmc_mov_cat');
      $cat_pic = $row['cat_pic'];
      $err = 0;
      if(isset($_FILES['cat_pic'])) {
        $pic_name     = $_FILES['cat_pic']['name'];
        $pic_type     = $_FILES['cat_pic']['type'];
        $pic_tmp_name = $_FILES['cat_pic']['tmp_name'];
        $pic_error    = $_FILES['cat_pic']['error'];
        $pic_size     = $_FILES['cat_pic']['size'];
        $allowed_file_types = array("image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/gif");
        if($pic_error == 0 && !in_array($pic_type, $allowed_file_types)) {$_SESSION['pmmc_msg'] = 11; $err = 1;} /* not an image */
        else if ($pic_error == 2) {$_SESSION['pmmc_msg'] = 15; $err = 1;} /* too big */
        else if ($pic_error == 4) {$err = 2;} /* no file uploaded but that's ok */
        else if ($pic_error == 3) {$_SESSION['pmmc_msg'] = 13; $err = 1;} /* partial upload */
        else if ($pic_error == 3) {$_SESSION['pmmc_msg'] = 13; $err = 1;} /* partial upload */
        if($pic_error == 0 && !is_uploaded_file($pic_tmp_name)) {$_SESSION['pmmc_msg'] = 14; $err = 1;} /* not sent by form */
        if($err == 0) {
          $pic_ext = pmmc_pic_ext($pic_type);
          $new_cat_pic = 'cat_' . $id . '.' . $pic_ext;
          $pic_path = _APP_DIR . 'var/pic_cat/';
          if(is_file($pic_path.$cat_pic)) {unlink($pic_path.$cat_pic);}
          move_uploaded_file($pic_tmp_name, $pic_path . $new_cat_pic);
        }
      }
      if($err == 0 || $err == 2) {
        //$cat_ord = pmmc_next_id('pmmc_mov_cat', 'cat_ord');
        $update = pmmc_qry_exec("UPDATE pmmc_mov_cat SET cat_pic = '{$new_cat_pic}', cat_tt = '{$cnt['page']['cat_tt']}', cat_desc = '{$cnt['page']['cat_desc']}' WHERE cat_id = '{$id}' LIMIT 1");
        $unlock = pmmc_unlock_tables();
        if($update === true) {$_SESSION['pmmc_msg'] = 25; header("Location: " . _APP_URL . 'admin/categ/view/' . $id); exit;}
        else {$_SESSION['pmmc_msg'] = 24; header("Location: " . _APP_URL . 'admin/categ/view/' . $id); exit;}
      }
    }
    else {$_SESSION['pmmc_msg'] = 16; header("Location: " . _APP_URL . 'admin/categ/view/' . $id); exit;}
  }
  return $cnt;
}
?>