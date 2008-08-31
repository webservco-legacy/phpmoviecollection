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
* @version    20:01 2008-08-31
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
      case 'categ'    : {$cnt = pmmc_adm_categ(); break;}
      /**
      * Movies administration
      */
      case 'movies'   : {$cnt = pmmc_adm_movies(); break;}
      /**
      * Application settings
      */
      case 'settings' : {$cnt = pmmc_adm_settings(); break;}
      /**
      * Users administration
      */
      case 'users'    : {$cnt = pmmc_adm_usr(); break;}
      default         : {header("Location: "._APP_URL); exit; break;}
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
  else {header("Location: "._APP_URL . 'admin/categ/view/all'); exit;}
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
        else if ($pic_error == 4)                                        {$err = 2;} /* no file uploaded but that's ok */
        else if ($pic_error == 3)                                        {$_SESSION['pmmc_msg'] = 13; $err = 1;} /* partial upload */
        else if ($pic_error == 3)                                        {$_SESSION['pmmc_msg'] = 13; $err = 1;} /* partial upload */
        if($pic_error == 0 && !is_uploaded_file($pic_tmp_name))          {$_SESSION['pmmc_msg'] = 14; $err = 1;} /* not sent by form */
        if($err == 0) {
          $pic_ext  = pmmc_pic_ext($pic_type);
          $cat_pic  = 'cat_' . $id . '.' . $pic_ext;
          $pic_path = _APP_DIR . 'var/pic_cat/';
          if (@move_uploaded_file($pic_tmp_name, $pic_path . $cat_pic)) {$pic_store = 1;}
          else {$pic_store = 0;}
        }
      }
      if($err == 0 || $err == 2) {
        $cat_ord = pmmc_next_id('pmmc_mov_cat', 'cat_ord');
        $insert  = pmmc_qry_exec("INSERT INTO pmmc_mov_cat (cat_pic, cat_tt, cat_ord, cat_desc) VALUES ('{$cat_pic}', '{$cnt['page']['cat_tt']}', '{$cat_ord}', '{$cnt['page']['cat_desc']}')");
        $unlock  = pmmc_unlock_tables();
        if($insert === true) {
          if($pic_store == 1) {$_SESSION['pmmc_msg'] = 23;}
          else {$_SESSION['pmmc_msg'] = 29;}
          header("Location: " . _APP_URL . 'admin/categ/view/' . $id); exit;
        }
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
      $pic_store = 2;
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
          if (@move_uploaded_file($pic_tmp_name, $pic_path . $new_cat_pic)) {$pic_store = 1;}
          else {$pic_store = 0;}
        }
      }
      if($err == 0 || $err == 2) {
        //$cat_ord = pmmc_next_id('pmmc_mov_cat', 'cat_ord');
        $update = pmmc_qry_exec("UPDATE pmmc_mov_cat SET cat_pic = '{$new_cat_pic}', cat_tt = '{$cnt['page']['cat_tt']}', cat_desc = '{$cnt['page']['cat_desc']}' WHERE cat_id = '{$id}' LIMIT 1");
        $unlock = pmmc_unlock_tables();
        if($update === true) {
          if($pic_store == 1 || $pic_store == 2) {$_SESSION['pmmc_msg'] = 25;}
          else {$_SESSION['pmmc_msg'] = 30;}
          header("Location: " . _APP_URL . 'admin/categ/view/' . $id); exit;
        }
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
      
      if(isset($_POST['cat_save_mod'])) {
        $lock = pmmc_lock_tables(array('pmmc_mov_cat'));
        if(isset($_POST['cat_del-'.$cnt['page']['cat_id'][$i]])) {
          if(is_file(_APP_DIR.'var/pic_cat/'.$cnt['page']['cat_pic'][$i])) {unlink(_APP_DIR.'var/pic_cat/'.$cnt['page']['cat_pic'][$i]);}
          $delete = pmmc_qry_exec("DELETE FROM pmmc_mov_cat WHERE cat_id = '{$cnt['page']['cat_id'][$i]}' LIMIT 1");
          if($delete === true) {$_SESSION['pmmc_msg'] = 28;}
        }
        else if(isset($_POST['cat_ord-'.$cnt['page']['cat_id'][$i]]) && pmmc_is_int($_POST['cat_ord-'.$cnt['page']['cat_id'][$i]])) {
          $update = pmmc_qry_exec("UPDATE pmmc_mov_cat SET cat_ord = '{$_POST['cat_ord-'.$cnt['page']['cat_id'][$i]]}' WHERE cat_id = '{$cnt['page']['cat_id'][$i]}' LIMIT 1");
          if($update === true) {$_SESSION['pmmc_msg'] = 27;}
        }
        $unlock = pmmc_unlock_tables();
        }
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
  if(isset($_GET['details']) && pmmc_is_int($_GET['details'])) {
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
  //else {header("Location: "._APP_URL); exit;}
  else {$cnt = pmmc_adm_movies_view();}
  return $cnt;
}
/**
* Movie add
*
* @return mixed
*/
function pmmc_adm_movies_add() {
  $vcr = pmmc_qry_exec("SELECT cat_id, cat_tt FROM pmmc_mov_cat ORDER BY cat_ord");
  $vct = pmmc_qry_total($vcr);
  if($vct > 0) {
    for($v=0;$v<$vct;$v++) {
      $vcrw = pmmc_qry_row($vcr);
      $cnt['page']['categs']['id'][$v] = $vcrw['cat_id'];
      $cnt['page']['categs']['tt'][$v] = $vcrw['cat_tt'];
    }
  }
  else {$_SESSION['pmmc_msg'] = 34; header("Location: " . _APP_URL . 'admin/categ/add/new'); exit;}
  global $lang;
  $cnt['skin'] = 'admin.movies.add.new.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['movie']['movies'] . _APP_SEP . $lang['movie']['add'];
  //$_SESSION['pmmc_msg']  = 0;
  $cnt['page']['cat_id']       = '';
  $cnt['page']['mov_pic']      = '';
  $cnt['page']['mov_imdb']     = '';
  $cnt['page']['mov_tt_pre']   = '';
  $cnt['page']['mov_tt']       = '';
  $cnt['page']['mov_aka']      = '';
  $cnt['page']['mov_year']     = '';
  $cnt['page']['mov_country']  = '';
  $cnt['page']['mov_language'] = '';
  $cnt['page']['mov_dir']      = '';
  $cnt['page']['mov_wrt']      = '';
  $cnt['page']['mov_tag']      = '';
  $cnt['page']['mov_plot']     = '';
  $cnt['page']['mov_cast']     = '';
  $cnt['page']['mov_notes']    = '';
  
  /* genres */
  $rg = pmmc_qry_exec("SELECT gen_id, gen_tt FROM pmmc_mov_gen");
  $tg = pmmc_qry_total($rg);
  $cnt['page']['genres'] = array();
  $cnt['page']['genrett'] = array();
  if($tg > 0) {
    for($i=0;$i<$tg;$i++) {
      $rwg = pmmc_qry_row($rg); /* array cu genres ids*/
      $cnt['page']['genres'][$i] = $rwg['gen_id'];
      $cnt['page']['genrett'][$cnt['page']['genres'][$i]] = $rwg['gen_tt'];
      /** ONLY FOR EDIT
      $rg2 = pmmc_qry_exec("SELECT rel_id FROM pmmc_mov_rel WHERE mov_id = '{$id}' AND gen_id = '{$cnt['page']['genres'][$i]}' LIMIT 1");
      $tg2 = pmmc_qry_total($rg2);
      if($tg2 == 1) {$cnt['page']['genre'][$cnt['page']['genres'][$i]] = 1;}
      else {$cnt['page']['genre'][$cnt['page']['genres'][$i]] = 0;}
      */
      $cnt['page']['genre'][$cnt['page']['genres'][$i]] = 0;
    }
  }
  /* //genres */
 
  $egl = error_get_last();
  $res = strpos($egl['message'], 'POST Content-Length of');
  if ($res !== false ) {$_SESSION['pmmc_msg'] = 17; header("Location: " . _APP_URL); exit;}
  else if(isset($_POST['mov_imdb_fetch'])) {
    if(isset($_POST['imdb_url'])) {
      require_once './inc/browseremulator.class.php';
      require_once './inc/imdb.inc.php';
      $imdb_id = pmmc_filter_input($_POST['imdb_url']);
      $imdb_id = str_replace('http://www.imdb.com/title/tt', '', $imdb_id);
      $imdb_id = str_replace('/', '', $imdb_id);
      
      $imdb = pmmc_get_imdb($imdb_id);
      $cnt['page']['mov_imdb']     = $imdb_id;
      $cnt['page']['mov_tt_pre']   = $imdb['title_the'];
      $cnt['page']['mov_tt']       = $imdb['title'];
      $cnt['page']['mov_aka']      = $imdb['aka'];
      $cnt['page']['mov_year']     = $imdb['year'];
      $cnt['page']['mov_country']  = $imdb['country'];
      $cnt['page']['mov_language'] = $imdb['language'];
      $cnt['page']['mov_dir']      = $imdb['dir'];
      $cnt['page']['mov_wrt']      = $imdb['wrt'];
      $cnt['page']['mov_tag']      = $imdb['tag'];
      $cnt['page']['mov_plot']     = $imdb['plot'];
      $cnt['page']['mov_cast']     = $imdb['cast'];
      $_SESSION['pmmc_msg'] = 35;
    }
  }
  else if(isset($_POST['mov_add'])) {
    if(isset($_POST['cat_id']))       {$cnt['page']['cat_id']       = pmmc_filter_input($_POST['cat_id']);}
    if(isset($_POST['mov_imdb']))     {$cnt['page']['mov_imdb']     = pmmc_filter_input($_POST['mov_imdb']);}
    if(isset($_POST['mov_tt_pre']))   {$cnt['page']['mov_tt_pre']   = pmmc_filter_input($_POST['mov_tt_pre']);}
    if(isset($_POST['mov_tt']))       {$cnt['page']['mov_tt']       = pmmc_filter_input($_POST['mov_tt']);}
    if(isset($_POST['mov_aka']))      {$cnt['page']['mov_aka']      = pmmc_filter_input($_POST['mov_aka']);}
    if(isset($_POST['mov_year']))     {$cnt['page']['mov_year']     = pmmc_filter_input($_POST['mov_year']);}
    if(isset($_POST['mov_country']))  {$cnt['page']['mov_country']  = pmmc_filter_input($_POST['mov_country']);}
    if(isset($_POST['mov_language'])) {$cnt['page']['mov_language'] = pmmc_filter_input($_POST['mov_language']);}
    if(isset($_POST['mov_dir']))      {$cnt['page']['mov_dir']      = pmmc_filter_input($_POST['mov_dir']);}
    if(isset($_POST['mov_wrt']))      {$cnt['page']['mov_wrt']      = pmmc_filter_input($_POST['mov_wrt']);}
    if(isset($_POST['mov_tag']))      {$cnt['page']['mov_tag']      = pmmc_filter_input($_POST['mov_tag']);}
    if(isset($_POST['mov_plot']))     {$cnt['page']['mov_plot']     = pmmc_filter_input($_POST['mov_plot']);}
    if(isset($_POST['mov_cast']))     {$cnt['page']['mov_cast']     = pmmc_filter_input($_POST['mov_cast']);}
    if(isset($_POST['mov_notes']))    {$cnt['page']['mov_notes']    = pmmc_filter_input($_POST['mov_notes']);}
    
    /* genres */
    if($tg > 0) {
      for($j=0;$j<$tg;$j++) {
        if(isset($_POST['genres_'.$cnt['page']['genres'][$j]])) {$cnt['page']['genre'][$cnt['page']['genres'][$j]] = 1;}
        else {$cnt['page']['genre'][$cnt['page']['genres'][$j]] = 0;}
      }
    }
    /* //genres */

    if($cnt['page']['cat_id'] != 0 && $cnt['page']['mov_tt'] != '') {
      $lock    = pmmc_lock_tables(array('pmmc_mov_tt', 'pmmc_mov_rel'));
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
          if (@move_uploaded_file($pic_tmp_name, $pic_path . $mov_pic)) {$pic_store = 1;}
          else {$pic_store = 0;}
        }
      }
      if($err == 0) {
        $idate = date("Y-m-d");
        $itime = date("H:i:s");
        $insert  = pmmc_qry_exec("INSERT INTO pmmc_mov_tt (cat_id, mov_pic, mov_imdb, mov_tt_pre, mov_tt, mov_aka, mov_year, mov_country, mov_language, mov_dir, mov_wrt, mov_tag, mov_plot, mov_cast, mov_notes, mov_date, mov_time) VALUES ('{$cnt['page']['cat_id']}', '{$mov_pic}', '{$cnt['page']['mov_imdb']}', '{$cnt['page']['mov_tt_pre']}', '{$cnt['page']['mov_tt']}', '{$cnt['page']['mov_aka']}', '{$cnt['page']['mov_year']}', '{$cnt['page']['mov_country']}', '{$cnt['page']['mov_language']}', '{$cnt['page']['mov_dir']}', '{$cnt['page']['mov_wrt']}', '{$cnt['page']['mov_tag']}', '{$cnt['page']['mov_plot']}', '{$cnt['page']['mov_cast']}', '{$cnt['page']['mov_notes']}', '{$idate}', '{$itime}')");
        /* genres */
        if($tg > 0) {
          for($k=0;$k<$tg;$k++) {
            $ver = pmmc_qry_total(pmmc_qry_exec("SELECT rel_id FROM pmmc_mov_rel WHERE mov_id = '{$id}' AND gen_id = '{$cnt['page']['genres'][$k]}' LIMIT 1"));
            if($cnt['page']['genre'][$cnt['page']['genres'][$k]] == 1) {
              if($ver != 1) {
                pmmc_qry_exec("INSERT INTO pmmc_mov_rel (mov_id, gen_id) VALUES ('{$id}', '{$cnt['page']['genres'][$k]}')");
              }
            }
            else if($cnt['page']['genre'][$cnt['page']['genres'][$k]] == 0) {
              if($ver == 1) {
                pmmc_qry_exec("DELETE FROM pmmc_mov_rel WHERE mov_id = '{$id}' AND gen_id = '{$cnt['page']['genres'][$k]}' LIMIT 1");
              }
            }
          }
        }
        /* //genres */
        $unlock  = pmmc_unlock_tables();
        if($insert === true) {
          if($pic_store == 1) {$_SESSION['pmmc_msg'] = 32;}
          else {$_SESSION['pmmc_msg'] = 33;}
          header("Location: " . _APP_URL . 'admin/movies/details/' . $id);
          exit;
        }
        else {$_SESSION['pmmc_msg'] = 31; header("Location: "._APP_URL . 'admin/movies/add/new'); exit;}
      }
    }
    else {$_SESSION['pmmc_msg'] = 16;}
  }
  return $cnt;
}
/**
* Movie edit
*
* @return mixed
*/
function pmmc_adm_movies_detail($id) {
  $vcr = pmmc_qry_exec("SELECT cat_id, cat_tt FROM pmmc_mov_cat ORDER BY cat_ord");
  $vct = pmmc_qry_total($vcr);
  if($vct > 0) {
    for($v=0;$v<$vct;$v++) {
      $vcrw = pmmc_qry_row($vcr);
      $cnt['page']['categs']['id'][$v] = $vcrw['cat_id'];
      $cnt['page']['categs']['tt'][$v] = $vcrw['cat_tt'];
    }
  }
  else {$_SESSION['pmmc_msg'] = 34; header("Location: " . _APP_URL . 'admin/categ/add/new'); exit;}
  global $lang;
  $cnt['skin'] = 'admin.movies.details.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['movie']['movies'] . _APP_SEP . $lang['movie']['details'];
  //$_SESSION['pmmc_msg']  = 0;
  
  $result = pmmc_qry_exec("SELECT * FROM pmmc_mov_tt WHERE mov_id = '{$id}'");
  $total = pmmc_qry_total($result);
  if($total == 1) {
    $row = pmmc_qry_row($result);
    $cnt['page']['cat_id']       = $row['cat_id'];
    $cnt['page']['mov_pic']      = $row['mov_pic'];
    $cnt['page']['mov_imdb']     = $row['mov_imdb'];
    $cnt['page']['mov_tt_pre']   = $row['mov_tt_pre'];
    $cnt['page']['mov_tt']       = $row['mov_tt'];
    $cnt['page']['mov_aka']      = $row['mov_aka'];
    $cnt['page']['mov_year']     = $row['mov_year'];
    $cnt['page']['mov_country']  = $row['mov_country'];
    $cnt['page']['mov_language'] = $row['mov_language'];
    $cnt['page']['mov_dir']      = $row['mov_dir'];
    $cnt['page']['mov_wrt']      = $row['mov_wrt'];
    $cnt['page']['mov_tag']      = $row['mov_tag'];
    $cnt['page']['mov_plot']     = $row['mov_plot'];
    $cnt['page']['mov_cast']     = $row['mov_cast'];
    $cnt['page']['mov_notes']    = $row['mov_notes'];
  }
  else {
    $cnt['page']['cat_id']       = '';
    $cnt['page']['mov_pic']      = '';
    $cnt['page']['mov_imdb']     = '';
    $cnt['page']['mov_tt_pre']   = '';
    $cnt['page']['mov_tt']       = '';
    $cnt['page']['mov_aka']      = '';
    $cnt['page']['mov_year']     = '';
    $cnt['page']['mov_country']  = '';
    $cnt['page']['mov_language'] = '';
    $cnt['page']['mov_dir']      = '';
    $cnt['page']['mov_wrt']      = '';
    $cnt['page']['mov_tag']      = '';
    $cnt['page']['mov_plot']     = '';
    $cnt['page']['mov_cast']     = '';
    $cnt['page']['mov_notes']    = '';
  }
  /* genres */
  $rg = pmmc_qry_exec("SELECT gen_id, gen_tt FROM pmmc_mov_gen");
  $tg = pmmc_qry_total($rg);
  $cnt['page']['genres'] = array();
  $cnt['page']['genrett'] = array();
  if($tg > 0) {
    for($i=0;$i<$tg;$i++) {
      $rwg = pmmc_qry_row($rg); /* array cu genres ids*/
      $cnt['page']['genres'][$i] = $rwg['gen_id'];
      $cnt['page']['genrett'][$cnt['page']['genres'][$i]] = $rwg['gen_tt'];
      $rg2 = pmmc_qry_exec("SELECT rel_id FROM pmmc_mov_rel WHERE mov_id = '{$id}' AND gen_id = '{$cnt['page']['genres'][$i]}' LIMIT 1");
      $tg2 = pmmc_qry_total($rg2);
      if($tg2 == 1) {$cnt['page']['genre'][$cnt['page']['genres'][$i]] = 1;}
      else {$cnt['page']['genre'][$cnt['page']['genres'][$i]] = 0;}
    }
  }
  /* //genres */
 
  $egl = error_get_last();
  $res = strpos($egl['message'], 'POST Content-Length of');
  if ($res !== false ) {$_SESSION['pmmc_msg'] = 17; header("Location: " . _APP_URL); exit;}
  else if(isset($_POST['mov_imdb_fetch'])) {
    if(isset($_POST['imdb_url'])) {
      require_once './inc/browseremulator.class.php';
      require_once './inc/imdb.inc.php';
      $imdb_id = pmmc_filter_input($_POST['imdb_url']);
      $imdb_id = str_replace('http://www.imdb.com/title/tt', '', $imdb_id);
      $imdb_id = str_replace('/', '', $imdb_id);
      
      $imdb = pmmc_get_imdb($imdb_id);
      $cnt['page']['mov_imdb']     = $imdb_id;
      $cnt['page']['mov_tt_pre']   = $imdb['title_the'];
      $cnt['page']['mov_tt']       = $imdb['title'];
      $cnt['page']['mov_aka']      = $imdb['aka'];
      $cnt['page']['mov_year']     = $imdb['year'];
      $cnt['page']['mov_country']  = $imdb['country'];
      $cnt['page']['mov_language'] = $imdb['language'];
      $cnt['page']['mov_dir']      = $imdb['dir'];
      $cnt['page']['mov_wrt']      = $imdb['wrt'];
      $cnt['page']['mov_tag']      = $imdb['tag'];
      $cnt['page']['mov_plot']     = $imdb['plot'];
      $cnt['page']['mov_cast']     = $imdb['cast'];
      $_SESSION['pmmc_msg'] = 35;
    }
  }
  else if(isset($_POST['mov_mod'])) {
    if(isset($_POST['cat_id']))       {$cnt['page']['cat_id']       = pmmc_filter_input($_POST['cat_id']);}
    if(isset($_POST['mov_imdb']))     {$cnt['page']['mov_imdb']     = pmmc_filter_input($_POST['mov_imdb']);}
    if(isset($_POST['mov_tt_pre']))   {$cnt['page']['mov_tt_pre']   = pmmc_filter_input($_POST['mov_tt_pre']);}
    if(isset($_POST['mov_tt']))       {$cnt['page']['mov_tt']       = pmmc_filter_input($_POST['mov_tt']);}
    if(isset($_POST['mov_aka']))      {$cnt['page']['mov_aka']      = pmmc_filter_input($_POST['mov_aka']);}
    if(isset($_POST['mov_year']))     {$cnt['page']['mov_year']     = pmmc_filter_input($_POST['mov_year']);}
    if(isset($_POST['mov_country']))  {$cnt['page']['mov_country']  = pmmc_filter_input($_POST['mov_country']);}
    if(isset($_POST['mov_language'])) {$cnt['page']['mov_language'] = pmmc_filter_input($_POST['mov_language']);}
    if(isset($_POST['mov_dir']))      {$cnt['page']['mov_dir']      = pmmc_filter_input($_POST['mov_dir']);}
    if(isset($_POST['mov_wrt']))      {$cnt['page']['mov_wrt']      = pmmc_filter_input($_POST['mov_wrt']);}
    if(isset($_POST['mov_tag']))      {$cnt['page']['mov_tag']      = pmmc_filter_input($_POST['mov_tag']);}
    if(isset($_POST['mov_plot']))     {$cnt['page']['mov_plot']     = pmmc_filter_input($_POST['mov_plot']);}
    if(isset($_POST['mov_cast']))     {$cnt['page']['mov_cast']     = pmmc_filter_input($_POST['mov_cast']);}
    if(isset($_POST['mov_notes']))    {$cnt['page']['mov_notes']    = pmmc_filter_input($_POST['mov_notes']);}
    
    /* genres */
    if($tg > 0) {
      for($j=0;$j<$tg;$j++) {
        if(isset($_POST['genres_'.$cnt['page']['genres'][$j]])) {$cnt['page']['genre'][$cnt['page']['genres'][$j]] = 1;}
        else {$cnt['page']['genre'][$cnt['page']['genres'][$j]] = 0;}
      }
    }
    /* //genres */

    if($cnt['page']['cat_id'] != 0 && $cnt['page']['mov_tt'] != '') {
      $lock    = pmmc_lock_tables(array('pmmc_mov_tt', 'pmmc_mov_rel'));
      //$id      = pmmc_next_auto_id('pmmc_mov_tt');
      $mov_pic     = $row['mov_pic'];
      $new_mov_pic = $row['mov_pic'];
      $err = 0;
      $pic_store = 2;
      if(isset($_FILES['mov_pic'])) {
        $pic_name     = $_FILES['mov_pic']['name'];
        $pic_type     = $_FILES['mov_pic']['type'];
        $pic_tmp_name = $_FILES['mov_pic']['tmp_name'];
        $pic_error    = $_FILES['mov_pic']['error'];
        $pic_size     = $_FILES['mov_pic']['size'];
        $allowed_file_types = array("image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/gif");
        if($pic_error == 0 && !in_array($pic_type, $allowed_file_types)) {$_SESSION['pmmc_msg'] = 11; $err = 1;} /* not an image */
        else if ($pic_error == 2)                                        {$_SESSION['pmmc_msg'] = 15; $err = 1;} /* too big */
        else if ($pic_error == 4)                                        {$err = 2;} /* no file uploaded but that's ok */
        else if ($pic_error == 3)                                        {$_SESSION['pmmc_msg'] = 13; $err = 1;} /* partial upload */
        else if ($pic_error == 3)                                        {$_SESSION['pmmc_msg'] = 13; $err = 1;} /* partial upload */
        if($pic_error == 0 && !is_uploaded_file($pic_tmp_name))          {$_SESSION['pmmc_msg'] = 14; $err = 1;} /* not sent by form */
        if($err == 0) {
          $pic_ext  = pmmc_pic_ext($pic_type);
          $new_mov_pic  = 'mov_' . $id . '.' . $pic_ext;
          $pic_path = _APP_DIR . 'var/pic_mov/';
          if(is_file($pic_path.$mov_pic)) {@unlink($pic_path.$mov_pic);}
          if (@move_uploaded_file($pic_tmp_name, $pic_path . $new_mov_pic)) {$pic_store = 1;}
          else {$pic_store = 0;}
        }
      }
      if($err == 0 || $err == 2) {
        //$idate = date("Y-m-d");
        //$itime = date("H:i:s");
        $update = pmmc_qry_exec("UPDATE pmmc_mov_tt SET cat_id = '{$cnt['page']['cat_id']}', mov_pic = '{$new_mov_pic}', mov_imdb = '{$cnt['page']['mov_imdb']}', mov_tt_pre = '{$cnt['page']['mov_tt_pre']}', mov_tt = '{$cnt['page']['mov_tt']}', mov_aka = '{$cnt['page']['mov_aka']}', mov_year= '{$cnt['page']['mov_year']}', mov_country = '{$cnt['page']['mov_country']}', mov_language = '{$cnt['page']['mov_language']}', mov_dir = '{$cnt['page']['mov_dir']}', mov_wrt = '{$cnt['page']['mov_wrt']}', mov_tag = '{$cnt['page']['mov_tag']}', mov_plot = '{$cnt['page']['mov_plot']}', mov_cast = '{$cnt['page']['mov_cast']}', mov_notes = '{$cnt['page']['mov_notes']}' WHERE mov_id = '{$id}' LIMIT 1");

        /* genres */
        if($tg > 0) {
          for($k=0;$k<$tg;$k++) {
            $ver = pmmc_qry_total(pmmc_qry_exec("SELECT rel_id FROM pmmc_mov_rel WHERE mov_id = '{$id}' AND gen_id = '{$cnt['page']['genres'][$k]}' LIMIT 1"));
            if($cnt['page']['genre'][$cnt['page']['genres'][$k]] == 1) {
              if($ver != 1) {
                pmmc_qry_exec("INSERT INTO pmmc_mov_rel (mov_id, gen_id) VALUES ('{$id}', '{$cnt['page']['genres'][$k]}')");
              }
            }
            else if($cnt['page']['genre'][$cnt['page']['genres'][$k]] == 0) {
              if($ver == 1) {
                pmmc_qry_exec("DELETE FROM pmmc_mov_rel WHERE mov_id = '{$id}' AND gen_id = '{$cnt['page']['genres'][$k]}' LIMIT 1");
              }
            }
          }
        }
        /* //genres */
        $unlock  = pmmc_unlock_tables();
        if($update === true) {
          if($pic_store == 1 || $pic_store == 2) {$_SESSION['pmmc_msg'] = 36;}
          else {$_SESSION['pmmc_msg'] = 37;}
          header("Location: " . _APP_URL . 'admin/movies/details/' . $id);
          exit;
        }
        else {$_SESSION['pmmc_msg'] = 38; header("Location: "._APP_URL . 'admin/movies/details/' . $id); exit;}
      }
    }
    else {$_SESSION['pmmc_msg'] = 16;}
  }
  return $cnt;
}
/**
* Movie list
*
* @return mixed
*/
function pmmc_adm_movies_view() {
  global $lang;
  $cnt['skin'] = 'admin.movies.list.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['movie']['movies'] . _APP_SEP . $lang['movie']['list'];
  
  // categories
  $rc = pmmc_qry_exec("SELECT * FROM pmmc_mov_cat ORDER BY cat_ord ASC");
  $tc = pmmc_qry_total($rc);
  if($tc > 0) {
    for($j=1;$j<=$tc;$j++) {
      $rwc = pmmc_qry_row($rc);
      $cnt['page']['cat_tt'][$rwc['cat_id']] = $rwc['cat_tt'];
    }
  }
  
  // categ
  $cat_id = 0;
  $q_cat_id        = "IS NOT NULL";
  if(isset($_GET['categ'])) {
    $cat_id = pmmc_filter_input($_GET['categ']);
    if(pmmc_is_int($cat_id) && $cat_id != 0) {$q_cat_id = "= '{$cat_id}'";}
  }
  // sorting
  $sort = 'title';
  $q_sort         = "mov_tt";
  if(isset($_GET['sort'])) {
    $sort = pmmc_filter_input($_GET['sort']);
    switch($sort) {
      case 'categ' : {$q_sort = "cat_id"; break;}
      case 'title' : {$q_sort = "mov_tt"; break;}
      case 'year'  : {$q_sort = "mov_year"; break;}
      default      : {break;}
    }
  }
  $order = 'a';
  $q_order        = "ASC";
  if(isset($_GET['order'])) {
    $order = pmmc_filter_input($_GET['order']);
    switch($order) {
      case 'a' : {$q_order = "ASC";  break;}
      case 'd' : {$q_order = "DESC"; break;}
      default  : {break;}
    }
  }
  // filter (search)
  $searchtype = 0;
  if(isset($_POST['search'])) {
    if(pmmc_filter_input($_POST['search']) == 1) {$searchtype = 1;}
    else if(pmmc_filter_input($_POST['search']) == 2) {$searchtype = 2;}
    else if(pmmc_filter_input($_POST['search']) == 3) {$searchtype = 3;}
  }
  $q_mov_imdb     = "IS NOT NULL";
  if(isset($_POST['mov_imdb'])) {$q_mov_imdb = pmmc_queryfill_search($searchtype, $_POST['mov_imdb']);}
  $q_mov_tt       = "IS NOT NULL";
  if(isset($_POST['mov_tt'])) {$q_mov_tt = pmmc_queryfill_search($searchtype, $_POST['mov_tt']);}
  $q_mov_aka      = "IS NOT NULL";
  if(isset($_POST['mov_aka'])) {$q_mov_aka = pmmc_queryfill_search($searchtype, $_POST['mov_aka']);}
  $q_mov_year     = "IS NOT NULL";
  if(isset($_POST['mov_year'])) {$q_mov_year = pmmc_queryfill_search($searchtype, $_POST['mov_year']);}
  $q_mov_country  = "IS NOT NULL";
  if(isset($_POST['mov_country'])) {$q_mov_country = pmmc_queryfill_search($searchtype, $_POST['mov_country']);}
  $q_mov_language = "IS NOT NULL";
  if(isset($_POST['mov_language'])) {$q_mov_language = pmmc_queryfill_search($searchtype, $_POST['mov_language']);}
  $q_mov_dir      = "IS NOT NULL";
  if(isset($_POST['mov_dir'])) {$q_mov_dir = pmmc_queryfill_search($searchtype, $_POST['mov_dir']);}
  $q_mov_wrt      = "IS NOT NULL";
  if(isset($_POST['mov_wrt'])) {$q_mov_wrt = pmmc_queryfill_search($searchtype, $_POST['mov_wrt']);}
  $q_mov_tag      = "IS NOT NULL";
  if(isset($_POST['mov_tag'])) {$q_mov_tag = pmmc_queryfill_search($searchtype, $_POST['mov_tag']);}
  $q_mov_plot     = "IS NOT NULL";
  if(isset($_POST['mov_plot'])) {$q_mov_plot = pmmc_queryfill_search($searchtype, $_POST['mov_plot']);}
  $q_mov_cast     = "IS NOT NULL";
  if(isset($_POST['mov_cast'])) {$q_mov_cast = pmmc_queryfill_search($searchtype, $_POST['mov_cast']);}
  // pagination
  
  $page = 1;
  if(isset($_GET['page']) && pmmc_is_int($_GET['page'])) {$page = $_GET['page'];}
  $items = 2;
  $offset = ($page - 1) * $items;
  if ($searchtype == 0) {$q_limit = " LIMIT ".$offset.", ".$items."";}
  else {$q_limit = "";}
  
  // build query
  $q1 = "SELECT SQL_CALC_FOUND_ROWS * FROM pmmc_mov_tt WHERE cat_id {$q_cat_id} AND mov_imdb {$q_mov_imdb} AND mov_tt {$q_mov_tt} AND mov_aka {$q_mov_aka} AND mov_year {$q_mov_year} AND mov_country {$q_mov_country} AND mov_language {$q_mov_language} AND mov_dir {$q_mov_dir} AND mov_wrt {$q_mov_wrt} AND mov_tag {$q_mov_tag} AND mov_plot {$q_mov_plot} AND mov_cast {$q_mov_cast} ORDER BY {$q_sort} {$q_order} {$q_limit}";
  $q2 = "SELECT FOUND_ROWS() as totalitems";
  
  
  
  $cnt['page']['movies'] = array();
  $r = pmmc_qry_exec($q1);
  $t = pmmc_qry_total($r);
  $rw = array();
  if($t > 0) {
    for($i=0;$i<$t;$i++) {
      $rw[$i] = pmmc_qry_row($r);
      if(isset($_POST['mov_save_mod'])) {
        $lock = pmmc_lock_tables(array('pmmc_mov_tt'));
        if(isset($_POST['mov_del-'.$rw[$i]['mov_id']])) {
          if(is_file(_APP_DIR.'var/pic_mov/'.$rw[$i]['mov_pic'])) {unlink(_APP_DIR.'var/pic_mov/'.$rw[$i]['mov_pic']);}
          $delete = pmmc_qry_exec("DELETE FROM pmmc_mov_tt WHERE mov_id = '{$rw[$i]['mov_id']}' LIMIT 1");
          if($delete === true) {$_SESSION['pmmc_msg'] = 40;}
        }
        $unlock = pmmc_unlock_tables();
      }  
    }
    if(isset($_POST['mov_save_mod'])) {
      header("Location: " . _APP_URL . "admin/movies/categ/".$cat_id."/sort/".$sort."/order/".$order);
      exit;
    }
  }
  $total = pmmc_qry_result(pmmc_qry_exec($q2));
  $cnt['page']['searchtype'] = $searchtype;
  $cnt['page']['page']       = $page;
  $cnt['page']['total']      = $total;
  $cnt['page']['maxpage']    = ceil($total/$items);
  $cnt['page']['prevpage']   = $page - 1;
  $cnt['page']['nextpage']   = $page + 1;
  $cnt['page']['categ']      = $cat_id;
  
  $cnt['page']['link_first'] = '&#60;&#60;';
  $cnt['page']['link_prev']  = '&#60;';
  if($cnt['page']['page'] > 1) {
    $cnt['page']['link_first'] = '<a href="'._APP_URL.'admin/movies/categ/'.$cat_id.'/sort/'.$sort.'/order/'.$order.'/page/1">'.$cnt['page']['link_first'].'</a>';
    $cnt['page']['link_prev']  = '<a href="'._APP_URL.'admin/movies/categ/'.$cat_id.'/sort/'.$sort.'/order/'.$order.'/page/'.$cnt['page']['prevpage'].'">'.$cnt['page']['link_first'].'</a>';
  }
  $cnt['page']['link_next']  = '&#62;';
  $cnt['page']['link_last']  = '&#62;&#62;';
  if($cnt['page']['page'] < $cnt['page']['maxpage']) {
    $cnt['page']['link_next']  = '<a href="'._APP_URL.'admin/movies/categ/'.$cat_id.'/sort/'.$sort.'/order/'.$order.'/page/'.$cnt['page']['nextpage'].'">'.$cnt['page']['link_next'].'</a>';
    $cnt['page']['link_last']  = '<a href="'._APP_URL.'admin/movies/categ/'.$cat_id.'/sort/'.$sort.'/order/'.$order.'/page/'.$cnt['page']['maxpage'].'">'.$cnt['page']['link_last'].'</a>';
  }
  $cnt['page']['movies'] = $rw;
  if($cnt['page']['total'] == 0) {$_SESSION['pmmc_msg'] = 39;}
  else if($_SESSION['pmmc_msg'] != 40) {$_SESSION['pmmc_msg'] = 0;}
  return $cnt;
}
/**
* Application settings
*
* @return mixed
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
    $err = 0;
    if($cnt['page']['lang']      == '') {$err = 1;}
    else if($cnt['page']['skin'] == '') {$err = 1;}
    else if($cnt['page']['pcat'] == '') {$err = 1;}
    else if($cnt['page']['pmov'] == '') {$err = 1;}
    if($err == 0) {
      $u[] = pmmc_cfg_var_set('LANG', $cnt['page']['lang']);
      $u[] = pmmc_cfg_var_set('SKIN', $cnt['page']['skin']);
      $u[] = pmmc_cfg_var_set('PCAT', $cnt['page']['pcat']);
      $u[] = pmmc_cfg_var_set('PMOV', $cnt['page']['pmov']);
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
  }
  return $cnt;
}
/**
* User administration function
*
* @return mixed
*/
function pmmc_adm_usr() {
  $cnt = NULL;
  if(isset($_GET['details']) && pmmc_is_int($_GET['details'])) {
    /**
    * View (edit) one user
    */
    $cnt = pmmc_adm_usr_detail($_GET['details']);
  }
  else if(isset($_GET['add']) && $_GET['add'] == 'new') {
    /**
    * Add new user
    */
    $cnt = pmmc_adm_usr_add();
  }
  else {$cnt = pmmc_adm_usr_view();}
  return $cnt;
}
/**
* Add new user
*
* @return mixed
*/
function pmmc_adm_usr_add() {
  global $lang;
  $cnt['skin'] = 'admin.usr.add.new.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['usr']['usrs'] . _APP_SEP . $lang['usr']['add'];
  
  $cnt['page']['langs'] = pmmc_lsdir(_APP_DIR.'lang/');
  $cnt['page']['skins'] = pmmc_lsdir(_APP_DIR.'skin/');
  
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
    if($cnt['page']['usr_name'] == '')                                                                   {$err = 1;}
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
      $insert = pmmc_qry_exec("INSERT INTO pmmc_set_usr (usr_name, usr_fname, usr_lname, usr_mail, usr_pass, usr_skin, usr_lang, usr_level, usr_status, usr_date) VALUES ('{$cnt['page']['usr_name']}', '{$cnt['page']['usr_fname']}', '{$cnt['page']['usr_lname']}', '{$cnt['page']['usr_mail2']}', '{$cnt['page']['usr_pass2']}', '{$cnt['page']['usr_skin']}', '{$cnt['page']['usr_lang']}', '{$cnt['page']['usr_level']}', '{$cnt['page']['usr_status']}', '{$udate}')");
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
  return $cnt;
}
?>