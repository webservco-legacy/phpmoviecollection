<?php
/**
* ./inc/func.inc.php (application functions and classes)
*
* <I> ./inc/funct.inc.php</I>
* <BR>This is the application functions file
* <BR>It contains all the functions
* <BR>used in the application
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    00:00 2008-08-25
* @since      19:27 2008-08-19
* @access     public
* @package    phpMyMovieCollection
* @subpackage Application
* @todo       Everything :-)
*/

/**
* Only authorized access permitted
*/
if(!defined('_VALID_REQUEST')) {header("Location: ../index.php");}
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
  
  $cnt['skin'] = 'admin.categ.view.all.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['categ']['categs'] . _APP_SEP . $lang['categ']['add'];
  $cnt['msg'] = 'add a new category';
  
  $cnt['page']['cat_id'] = NULL;
  $cnt['page']['cat_pic'] = NULL;
  $cnt['page']['cat_tt'] = NULL;
  $cnt['page']['cat_ord'] = NULL;
  $cnt['page']['cat_desc'] = NULL;
  /**
  * If post form, validate, add to db and redirect to view all categories
  */
  return $cnt;
}
?>