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
* @version    11:18 2008-08-27
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
      case 'categ'  : {$cnt = pmmc_adm_categ(); break;}
      /**
      * Movies administration
      */
      case 'movies' : {$cnt = pmmc_adm_movies(); break;}
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
function pmmc_adm_categ() {
  $cnt = NULL;
  if(isset($_GET['view']) && $_GET['view'] != '') {
    if($_GET['view'] == 'all') {
      /**
      * View all categories
      */
      $cnt = pmmc_adm_categ_view_all();
    }
    else if(pmmc_is_int($_GET['view'])) {
      /**
      * View (edit) one category
      */
      $cnt = pmmc_adm_categ_view($_GET['view']);
    }
    else {header("Location: "._APP_URL); exit;}
  }
  else if(isset($_GET['add']) && $_GET['add'] == 'new') {
    /**
    * Add new category
    */
    $cnt = pmmc_adm_categ_add();
  }
  else {header("Location: "._APP_URL); exit;}
  return $cnt;
}
/**
* Category add
*
* @return mixed
*/
function pmmc_adm_categ_add() {
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
function pmmc_adm_categ_view($id) {
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
      $cat_pic     = $row['cat_pic'];
      $new_cat_pic = $row['cat_pic'];
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
/**
* Categories - view all
*
* @return mixed
*/
function pmmc_adm_categ_view_all() {
  global $lang;
  $cnt['skin'] = 'admin.categ.view.all.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['categ']['categs'] . _APP_SEP . $lang['categ']['viewall'];
  $cnt['page'] = array();
  $cnt['page']['cat_id'] = array();
  
  $result = pmmc_qry_exec("SELECT * FROM pmmc_mov_cat ORDER BY cat_ord ASC");
  $total = pmmc_qry_total($result);
  if($total > 0) {
    for($i=1;$i<=$total;$i++) {
      $row = pmmc_qry_row($result);
      $cnt['page']['cat_id'][$i]   = $row['cat_id'];
      $cnt['page']['cat_pic'][$i]  = $row['cat_pic'];
      $cnt['page']['cat_tt'][$i]   = $row['cat_tt'];
      $cnt['page']['cat_ord'][$i]  = $row['cat_ord'];
      $cnt['page']['cat_desc'][$i] = $row['cat_desc'];
      $items = pmmc_qry_exec("SELECT COUNT(mov_id) FROM pmmc_mov_tt WHERE cat_id = '{$cnt['page']['cat_id'][$i]}'");
      $cnt['page']['cat_items'][$i] = pmmc_qry_result($items);
      
      $lock = pmmc_lock_tables(array('pmmc_mov_cat'));
      if(isset($_POST['cat_del-'.$cnt['page']['cat_id'][$i]])) {
        if(is_file(_APP_DIR.'var/pic_cat/'.$cnt['page']['cat_pic'][$i])) {unlink(_APP_DIR.'var/pic_cat/'.$cnt['page']['cat_pic'][$i]);}
        $delete = pmmc_qry_exec("DELETE FROM pmmc_mov_cat WHERE cat_id = '{$cnt['page']['cat_id'][$i]}' LIMIT 1");
        if($delete === true) {$_SESSION['pmmc_msg'] = 27;}
      }
      else if(isset($_POST['cat_ord-'.$cnt['page']['cat_id'][$i]]) && pmmc_is_int($_POST['cat_ord-'.$cnt['page']['cat_id'][$i]])) {
        $update = pmmc_qry_exec("UPDATE pmmc_mov_cat SET cat_ord = '{$_POST['cat_ord-'.$cnt['page']['cat_id'][$i]]}' WHERE cat_id = '{$cnt['page']['cat_id'][$i]}' LIMIT 1");
        if($update === true) {$_SESSION['pmmc_msg'] = 28;}
      }
      $unlock = pmmc_unlock_tables();
    }
    if(isset($_POST['cat_save_mod'])) {
      header("Location: " . _APP_URL . 'admin/categ/view/all');
      exit;
    }
  }
  else {
    $_SESSION['pmmc_msg'] = 26;
  }
  return $cnt;
}
/**
* Movies administration function
*
* @return mixed
*/
/**
* Categories administration function
*
* @return mixed
*/
function pmmc_adm_movies() {
  $cnt = NULL;
  if(isset($_GET['categ']) && $_GET['categ'] != '') {
    if($_GET['categ'] == 'all') {
      /**
      * View all movies
      */
      $cnt = pmmc_adm_movies_categ_all();
    }
    else if(pmmc_is_int($_GET['categ'])) {
      /**
      * View movies from a certain category
      */
      $cnt = pmmc_adm_movies_categ_one($_GET['categ']);
    }
    else {header("Location: "._APP_URL); exit;}
  }
  else if(isset($_GET['details']) && pmmc_is_int($_GET['details'])) {
    /**
    * View (edit) one title
    */
    $cnt = pmmc_adm_movies_detail($_GET['details']);
  }
  else if(isset($_GET['add']) && $_GET['add'] == 'new') {
    /**
    * Add new movie
    */
    $cnt = pmmc_adm_movies_add();
  }
  else {header("Location: "._APP_URL); exit;}
  return $cnt;
}
/**
* Movie add
*
* @return mixed
*/
function pmmc_adm_movies_add() {
  global $lang;
  $cnt['skin'] = 'admin.movies.add.new.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['movie']['movies'] . _APP_SEP . $lang['movie']['add'];
  //$_SESSION['pmmc_msg']  = 0;
  $cnt['page']['cat_id']     = '';
  $cnt['page']['mov_pic']    = '';
  $cnt['page']['mov_imdb']   = '';
  $cnt['page']['mov_tt_the'] = '';
  $cnt['page']['mov_tt']     = '';
  $cnt['page']['mov_year']   = '';
  $cnt['page']['mov_dir']    = '';
  $cnt['page']['mov_wrt']    = '';
  $cnt['page']['mov_tag']    = '';
  $cnt['page']['mov_plot']   = '';
  $cnt['page']['mov_cast']   = '';
  $cnt['page']['mov_notes']  = '';
  
  /* genres */
  $rg = pmmc_qry_exec("SELECT gen_id FROM pmmc_mov_gen");
  $tg = pmmc_qry_total($rg);
  $rwg = array();
  if($tg > 0) {
    for($i=0;$i<$tg;$i++) {
      $rwg = pmmc_qry_row($rg); /* array cu genres */
      //$cnt['page']['mov_gen'][$rwg['gen_id']] = 0;
    }
  }
  /* //genres */
 
  $egl = error_get_last();
  $res = strpos($egl['message'], 'POST Content-Length of');
  if ($res !== false ) {$_SESSION['pmmc_msg'] = 17; header("Location: " . _APP_URL); exit;}
  else if(isset($_POST['mov_add'])) {
    if(isset($_POST['cat_id']))     {$cnt['page']['cat_id']     = pmmc_filter_input($_POST['cat_id']);}
    if(isset($_POST['mov_imdb']))   {$cnt['page']['mov_imdb']   = pmmc_filter_input($_POST['mov_imdb']);}
    if(isset($_POST['mov_tt_the'])) {$cnt['page']['mov_tt_the'] = pmmc_filter_input($_POST['mov_tt_the']);}
    if(isset($_POST['mov_tt']))     {$cnt['page']['mov_tt']     = pmmc_filter_input($_POST['mov_tt']);}
    if(isset($_POST['mov_year']))   {$cnt['page']['mov_year']   = pmmc_filter_input($_POST['mov_year']);}
    if(isset($_POST['mov_dir']))    {$cnt['page']['mov_dir']    = pmmc_filter_input($_POST['mov_dir']);}
    if(isset($_POST['mov_wrt']))    {$cnt['page']['mov_wrt']    = pmmc_filter_input($_POST['mov_wrt']);}
    if(isset($_POST['mov_tag']))    {$cnt['page']['mov_tag']    = pmmc_filter_input($_POST['mov_tag']);}
    if(isset($_POST['mov_plot']))   {$cnt['page']['mov_plot']   = pmmc_filter_input($_POST['mov_plot']);}
    if(isset($_POST['mov_cast']))   {$cnt['page']['mov_cast']   = pmmc_filter_input($_POST['mov_cast']);}
    if(isset($_POST['mov_notes']))  {$cnt['page']['mov_notes']  = pmmc_filter_input($_POST['mov_notes']);}
    
    /* genres */

    /* //genres */

    if($cnt['page']['cat_id'] != '' && $cnt['page']['mov_tt'] != '') {
      $lock    = pmmc_lock_tables(array('pmmc_mov_tt'));
      $id      = pmmc_next_auto_id('pmmc_mov_tt');
      $mov_pic = '';
      $err = 0;
      if(isset($_FILES['mov_pic'])) {
        $pic_name     = $_FILES['mov_pic']['name'];
        $pic_type     = $_FILES['mov_pic']['type'];
        $pic_tmp_name = $_FILES['mov_pic']['tmp_name'];
        $pic_error    = $_FILES['mov_pic']['error'];
        $pic_size     = $_FILES['mov_pic']['size'];
        $allowed_file_types = array("image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/gif");
        if($pic_error == 0 && !in_array($pic_type, $allowed_file_types)) {$_SESSION['pmmc_msg'] = 11; $err = 1;} /* not an image */
        else if ($pic_error == 2)                                        {$_SESSION['pmmc_msg'] = 15; $err = 1;} /* too big */
        //else if ($pic_error == 4)                                      {$err = 1;} /* no file uploaded but that's ok */
        else if ($pic_error == 3)                                        {$_SESSION['pmmc_msg'] = 13; $err = 1;} /* partial upload */
        else if ($pic_error == 3)                                        {$_SESSION['pmmc_msg'] = 13; $err = 1;} /* partial upload */
        if($pic_error == 0 && !is_uploaded_file($pic_tmp_name))          {$_SESSION['pmmc_msg'] = 14; $err = 1;} /* not sent by form */
        if($err == 0) {
          $pic_ext  = pmmc_pic_ext($pic_type);
          $mov_pic  = 'mov_' . $id . '.' . $pic_ext;
          $pic_path = _APP_DIR . 'var/pic_mov/';
          move_uploaded_file($pic_tmp_name, $pic_path . $mov_pic);
        }
      }
      if($err == 0) {
        $insert  = pmmc_qry_exec("INSERT INTO pmmc_mov_tt (cat_id, mov_pic, mov_imdb, mov_tt_the, mov_tt, mov_year, mov_dir, mov_wrt, mov_tag, mov_plot, mov_cast, mov_notes, mov_date, mov_time) VALUES ('{$cnt['page']['cat_id']}', '{$mov_pic}', '{$cnt['page']['mov_imdb']}', '{$cnt['page']['mov_tt_the']}', '{$cnt['page']['mov_tt']}', '{$cnt['page']['mov_year']}', '{$cnt['page']['mov_dir']}', '{$cnt['page']['mov_wrt']}', '{$cnt['page']['mov_tag']}', '{$cnt['page']['mov_plot']}', '{$cnt['page']['mov_cast']}', '{$cnt['page']['mov_notes']}', '', '')");
        $unlock  = pmmc_unlock_tables();
        if($insert === true) {$_SESSION['pmmc_msg'] = 30; header("Location: " . _APP_URL . 'admin/movies/details/' . $id); exit;}
        else {$_SESSION['pmmc_msg'] = 29; header("Location: "._APP_URL . 'admin/movies/add/new'); exit;}
      }
    }
    else {$_SESSION['pmmc_msg'] = 16;}
  }
  return $cnt;
}
?>