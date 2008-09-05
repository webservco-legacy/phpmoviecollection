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
* @version    13:00 2008-09-03
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
* Control additional modules loading
*
* Uses values from configuration file to control the loading of additional modules
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
* Process all requests
*
* @return array $cnt content to be displayed to the user content
*/
function pmmc_process() {
  $cnt = NULL;
  if(isset($_GET['admin']) && $_GET['admin'] != '') {
    if($_SESSION['pmmc_usr_level'] >= 4) {
      switch($_GET['admin']) {
        case 'categ'    : {require_once _APP_DIR . 'inc/func-a_c.inc.php'; $cnt = pmmc_adm_categ(); break;}
        case 'movies'   : {require_once _APP_DIR . 'inc/func-a_m.inc.php'; $cnt = pmmc_adm_movies(); break;}
        case 'settings' : {require_once _APP_DIR . 'inc/func-a_s.inc.php'; $cnt = pmmc_adm_settings(); break;}
        case 'users'    : {require_once _APP_DIR . 'inc/func-a_u.inc.php'; $cnt = pmmc_adm_users(); break;}
        default         : {$_SESSION['pmmc_msg'] = 2; header("Location: "._APP_URL); exit; break;}
      }
    }
    else {$_SESSION['pmmc_msg'] = 2; header("Location: "._APP_URL); exit;}
  }
  else if(isset($_GET['view']) && $_GET['view'] != '') {
    switch($_GET['view']) {
      case 'categ' : {require_once _APP_DIR . 'inc/func-v_c.inc.php'; $cnt = pmmc_view_categ(); break;}
      case 'movies' : {require_once _APP_DIR . 'inc/func-v_m.inc.php'; $cnt = pmmc_view_movies(); break;}
      default      : {$_SESSION['pmmc_msg'] = 2; header("Location: "._APP_URL); exit; break;}
    }
  }
  else {
    /* TEMP SOLUTION */
    $cnt['skin'] = 'tester.tpl.php';
    $cnt['tt'] = 'Tester';
    $cnt['page'] = 'Hello World!';
    /* //TEMP SOLUTION */
  }
  return $cnt;
}

/*
* ********** ********** ********** ********** CATEGORY REQUEST PROCESSING START ********** ********** ********** **********
*/

/**
* Categories administration function
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_adm_categ() {
  $cnt = NULL;
  if(isset($_GET['add']) && $_GET['add'] == 'new') {
    $cnt = pmmc_adm_categ_add();
  }
  else if(isset($_GET['details']) && pmmc_is_int($_GET['details'])) {
    $cnt = pmmc_adm_categ_details($_GET['details']);
  }
  else {
    $cnt = pmmc_adm_categ_view();
  }
  return $cnt;
}
/**
* Categories view function
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_view_categ() {
  $cnt = NULL;
  if(isset($_GET['details']) && pmmc_is_int($_GET['details'])) {
    $cnt = pmmc_view_categ_details($_GET['details']);
  }
  else {
    $cnt = pmmc_view_categ_view();
  }
  return $cnt;
}

/*
* ********** ********** ********** ********** CATEGORY REQUEST PROCESSING END ********** ********** ********** **********
*/

/*
* ********** ********** ********** ********** MOVIE REQUEST PROCESSING START ********** ********** ********** **********
*/

/**
* Movies administration function
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_adm_movies() {
  $cnt = NULL;
  if(isset($_GET['add']) && $_GET['add'] == 'new') {
    $cnt = pmmc_adm_mov_add();
  }
  else if(isset($_GET['details']) && pmmc_is_int($_GET['details'])) {
    $cnt = pmmc_adm_mov_details($_GET['details']);
  }
  else {
    $cnt = pmmc_adm_mov_view();
  }
  return $cnt;
}
/**
* Movies view function
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_view_movies() {
  $cnt = NULL;
  if(isset($_GET['details']) && pmmc_is_int($_GET['details'])) {
    $cnt = pmmc_view_mov_details($_GET['details']);
  }
  else {
    $cnt = pmmc_view_mov_view(); // xxx
  }
  return $cnt;
}
/*
* ********** ********** ********** ********** MOVIE REQUEST PROCESSING END ********** ********** ********** **********
*/

/*
* ********** ********** ********** ********** USERS REQUEST PROCESSING START ********** ********** ********** **********
*/

/**
* Users administration function
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_adm_users() {
  $cnt = NULL;
  if(isset($_GET['add']) && $_GET['add'] == 'new') {
    $cnt = pmmc_adm_usr_add();
  }
  else if(isset($_GET['details']) && pmmc_is_int($_GET['details'])) {
    $cnt = pmmc_adm_usr_details($_GET['details']);
  }
  else {
    $cnt = pmmc_adm_usr_view();
  }
  return $cnt;
}

/*
* ********** ********** ********** ********** USERS REQUEST PROCESSING END ********** ********** ********** **********
*/

/*
* ********** ********** ********** ********** GENERAL CATEGORY FUNCTIONS START ********** ********** ********** **********
*/

/**
* General category view function
*
* @param integer category id
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_categ_details($id) {
  $cnt['page'] = NULL;
  $result      = pmmc_qry_exec("SELECT * FROM pmmc_mov_cat WHERE cat_id = '{$id}'");
  $total       = pmmc_qry_total($result);
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
  return $cnt['page'];
}
/**
* Categories - view all
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_categ_view() {
  $cnt['page'] = NULL;
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
      
      if(isset($_POST['cat_save_mod']) && $_SESSION['pmmc_usr_level'] >= 4) {
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
    if(isset($_POST['cat_save_mod']) && $_SESSION['pmmc_usr_level'] >= 4) {
      header("Location: " . _APP_URL . 'admin/categ/view/all');
      exit;
    }
  }
  else {
    $_SESSION['pmmc_msg'] = 26;
  }
  return $cnt['page'];
}

/*
* ********** ********** ********** ********** GENERAL CATEGORY FUNCTIONS END ********** ********** ********** **********
*/

/*
* ********** ********** ********** ********** GENERAL MOVIE FUNCTIONS START ********** ********** ********** **********
*/

/**
* Movie view
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_mov_details($id) {
  $vcr = pmmc_qry_exec("SELECT cat_id, cat_tt FROM pmmc_mov_cat ORDER BY cat_ord");
  $vct = pmmc_qry_total($vcr);
  if($vct > 0) {
    for($v=1;$v<=$vct;$v++) {
      $vcrw = pmmc_qry_row($vcr);
      $cnt['page']['categs']['id'][$v] = $vcrw['cat_id'];
      $cnt['page']['categs']['tt'][$v] = $vcrw['cat_tt'];
    }
  }
  else {$_SESSION['pmmc_msg'] = 34; header("Location: " . _APP_URL . 'admin/categ/add/new'); exit;}
  
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
  $cnt['page']['tg'] = $tg;
  /* //genres */
  return $cnt['page'];
}
/**
* Movie list
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_mov_view() {
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
      if(isset($_POST['mov_save_mod']) && $_SESSION['pmmc_usr_level'] >= 4) {
        $lock = pmmc_lock_tables(array('pmmc_mov_tt'));
        if(isset($_POST['mov_del-'.$rw[$i]['mov_id']])) {
          if(is_file(_APP_DIR.'var/pic_mov/'.$rw[$i]['mov_pic'])) {unlink(_APP_DIR.'var/pic_mov/'.$rw[$i]['mov_pic']);}
          $delete = pmmc_qry_exec("DELETE FROM pmmc_mov_tt WHERE mov_id = '{$rw[$i]['mov_id']}' LIMIT 1");
          if($delete === true) {$_SESSION['pmmc_msg'] = 40;}
        }
        $unlock = pmmc_unlock_tables();
      }  
    }
    if(isset($_POST['mov_save_mod']) && $_SESSION['pmmc_usr_level'] >= 4) {
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
    $cnt['page']['link_prev']  = '<a href="'._APP_URL.'admin/movies/categ/'.$cat_id.'/sort/'.$sort.'/order/'.$order.'/page/'.$cnt['page']['prevpage'].'">'.$cnt['page']['link_prev'].'</a>';
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
  return $cnt['page'];
}

/*
* ********** ********** ********** ********** GENERAL MOVIE FUNCTIONS END ********** ********** ********** **********
*/


/*
* ********** ********** ********** ********** GENERAL USERS FUNCTIONS START ********** ********** ********** **********
*/

/**
* View user
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_usr_details($id) {
  $cnt['page']['langs'] = pmmc_lsdir(_APP_DIR.'lang/');
  $cnt['page']['skins'] = pmmc_lsdir(_APP_DIR.'skin/');
    
  $result = pmmc_qry_exec("SELECT * FROM pmmc_set_usr WHERE usr_id = '{$id}'");
  $total = pmmc_qry_total($result);
  if($total == 1) {
    $row = pmmc_qry_row($result);
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
  return $cnt['page'];
}
/**
* Users - view all
*
* @return array $cnt content to be displayed to the user
*/
function pmmc_usr_view() {
  /*
  global $lang;
  $cnt['skin'] = 'admin.usr.view.all.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['usr']['usrs'] . _APP_SEP . $lang['categ']['viewall'];
  $cnt['page']['users'] = array();
  $rw = array();
  */
  $page = 1;
  if(isset($_GET['page']) && pmmc_is_int($_GET['page'])) {$page = $_GET['page'];}
  $items = 2;
  $offset = ($page - 1) * $items;
  $q_limit = " LIMIT ".$offset.", ".$items."";
  
  $r = pmmc_qry_exec("SELECT SQL_CALC_FOUND_ROWS usr_id, usr_name, usr_fname, usr_lname, usr_level, usr_status FROM pmmc_set_usr ORDER BY usr_level DESC, usr_name ASC {$q_limit}");
  $t = pmmc_qry_total($r);
  if($t > 0) {
    for($i=0;$i<$t;$i++) {
      $rw[$i] = pmmc_qry_row($r);
      if(isset($_POST['usr_save_mod']) && $_SESSION['pmmc_usr_level'] >= 4) {
        if(isset($_POST['usr_del-'.$rw[$i]['usr_id']])) {
          $lock = pmmc_lock_tables(array('pmmc_set_usr'));
          $delete = pmmc_qry_exec("DELETE FROM pmmc_set_usr WHERE usr_id = '{$rw[$i]['usr_id']}' LIMIT 1");
          if($delete === true) {$_SESSION['pmmc_msg'] = 50;}
          $unlock = pmmc_unlock_tables();
          header("Location: " . _APP_URL . 'admin/users');
          exit;
        }
      }
    }
  }
  $cnt['page']['total']    = pmmc_qry_result(pmmc_qry_exec("SELECT FOUND_ROWS() as totalitems"));
  $cnt['page']['page']     = $page;
  $cnt['page']['maxpage']  = ceil($cnt['page']['total']/$items);
  $cnt['page']['prevpage'] = $page - 1;
  $cnt['page']['nextpage'] = $page + 1;
  
  $cnt['page']['link_first'] = '&#60;&#60;';
  $cnt['page']['link_prev']  = '&#60;';
  if($cnt['page']['page'] > 1) {
    $cnt['page']['link_first'] = '<a href="'._APP_URL.'admin/users/page/1">'.$cnt['page']['link_first'].'</a>';
    $cnt['page']['link_prev']  = '<a href="'._APP_URL.'admin/users/page/'.$cnt['page']['prevpage'].'">'.$cnt['page']['link_prev'].'</a>';
  }
  $cnt['page']['link_next']  = '&#62;';
  $cnt['page']['link_last']  = '&#62;&#62;';
  if($cnt['page']['page'] < $cnt['page']['maxpage']) {
    $cnt['page']['link_next']  = '<a href="'._APP_URL.'admin/users/page/'.$cnt['page']['nextpage'].'">'.$cnt['page']['link_next'].'</a>';
    $cnt['page']['link_last']  = '<a href="'._APP_URL.'admin/users/page/'.$cnt['page']['maxpage'].'">'.$cnt['page']['link_last'].'</a>';
  }
  
  $cnt['page']['users'] = $rw;
  
  if($cnt['page']['total'] == 0) {$_SESSION['pmmc_msg'] = 49;}
  else if($_SESSION['pmmc_msg'] != 50) {$_SESSION['pmmc_msg'] = 0;}
  return $cnt['page'];
}
/*
* ********** ********** ********** ********** GENERAL USERS FUNCTIONS END ********** ********** ********** **********
*/
?>