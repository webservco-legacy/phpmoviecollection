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
  global $allowed_file_types;
  $cnt['skin'] = 'admin.categ.add.new.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['categ']['categs'] . _APP_SEP . $lang['categ']['add'];
  $cnt['msg'] = 21;
  
  $cnt['page']['cat_pic'] = '';
  $cnt['page']['cat_tt'] = '';
  $cnt['page']['cat_desc'] = '';
  
  if(isset($_POST['cat_add'])) {
    if(isset($_POST['cat_tt'])) {$cnt['page']['cat_tt'] = pmmc_filter_input($_POST['cat_tt']);}
    if(isset($_POST['cat_desc'])) {$cnt['page']['cat_desc'] = pmmc_filter_input($_POST['cat_desc']);}
    if($cnt['page']['cat_tt'] != '' && $cnt['page']['cat_desc'] != '') {
      
      if(isset($_FILES['cat_pic'])) {
        $pic_name     = $_FILES['cat_pic']['name'];
        $pic_type     = $_FILES['cat_pic']['type'];
        $pic_tmp_name = $_FILES['cat_pic']['tmp_name'];
        $pic_error    = $_FILES['cat_pic']['error'];
        $pic_size     = $_FILES['cat_pic']['size'];
        /*xxx*/
        $cnt['page']['cat_pic'] = $_FILES['cat_pic']['size'];
        $err = 0;
        if($pic_error == 0 && !in_array($pic_type, $allowed_file_types)) {$msg = 11; $err = 1;}
      }
    }
    else {$cnt['msg'] = 16;}
  }
  return $cnt;
}
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
?>