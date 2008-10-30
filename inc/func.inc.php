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
* @version    09:58 2008-10-30
* @since      19:27 2008-08-19
* @access     public
* @package    pmc
* @subpackage Application
* @todo       stuff
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
function pmc_mod_add() {
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
function pmc_process() {
  $cnt = NULL;
  if(isset($_GET['admin']) && $_GET['admin'] != '') {
    if($_SESSION['pmc_usr_level'] >= 4) {
      switch($_GET['admin']) {
        case 'admin'    : {$cnt = pmc_adm_adm(); break;}
        case 'categ'    : {require_once _APP_DIR . 'inc/func-a_c.inc.php';  $cnt = pmc_adm_categ(); break;}
        case 'movies'   : {require_once _APP_DIR . 'inc/func-a_m.inc.php';  $cnt = pmc_adm_movies(); break;}
        case 'settings' : {require_once _APP_DIR . 'inc/func-a_s.inc.php';  $cnt = pmc_adm_settings(); break;}
        case 'users'    : {require_once _APP_DIR . 'inc/func-a_u.inc.php';  $cnt = pmc_adm_users(); break;}
        case 'media'    : {require_once _APP_DIR . 'inc/func-a_md.inc.php'; $cnt = pmc_adm_media(); break;}
        default         : {$_SESSION['pmc_msg'] = 2; header("Location: "._APP_URL); exit; break;}
      }
    }
    else {$_SESSION['pmc_msg'] = 2; header("Location: "._APP_URL); exit;}
  }
  else if(isset($_GET['view']) && $_GET['view'] != '') {
    switch($_GET['view']) {
      case 'categ'    : {require_once _APP_DIR . 'inc/func-v_c.inc.php'; $cnt = pmc_view_categ(); break;}
      case 'movies'   : {require_once _APP_DIR . 'inc/func-v_m.inc.php'; $cnt = pmc_view_movies(); break;}
      case 'latest'   : {require_once _APP_DIR . 'inc/func-v_m.inc.php'; $cnt = pmc_view_latest(); break;}
      case 'settings' : {
      if($_SESSION['pmc_usr_level'] > 0) {
        require_once _APP_DIR . 'inc/func-v_s.inc.php'; $cnt = pmc_view_settings();;
      }
      else {
        $_SESSION['pmc_msg'] = 2; header("Location: "._APP_URL); exit;
      }
      break;
      }
      case 'users'    : {require_once _APP_DIR . 'inc/func-v_u.inc.php'; $cnt = pmc_view_users(); break;}
      case 'search'   : {require_once _APP_DIR . 'inc/func-s.inc.php';   $cnt = pmc_view_search(); break;}
      case 'langs'    : {$cnt = pmc_view_langs(); break;}
      case 'skins'    : {$cnt = pmc_view_skins(); break;}
      case 'list'     : {$cnt = pmc_view_list(); break;}
      case 'help'     : {$cnt = pmc_view_help(); break;}
      case 'about'    : {$cnt = pmc_view_about(); break;}
      default         : {$_SESSION['pmc_msg'] = 2; header("Location: "._APP_URL); exit; break;}
    }
  }
  else {
    $cnt = pmc_home_page();
  }
  return $cnt;
}




/*
* ********** ********** ********** ********** CATEGORY REQUEST PROCESSING START ********** ********** ********** **********
*/

/**
* Administration menu function
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_adm() {
    global $lang;
    $_SESSION['pmc_msg'] = 0;
    $cnt['skin'] = 'admin/a-admin.tpl.php';
    $cnt['tt'] = $lang['adm']['adm'];
    $cnt['page'] = NULL;
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
function pmc_adm_categ() {
  $cnt = NULL;
  if(isset($_GET['add']) && $_GET['add'] == 'new') {
    $cnt = pmc_adm_categ_add();
  }
  else if(isset($_GET['details']) && pmc_is_int($_GET['details'])) {
    $cnt = pmc_adm_categ_details($_GET['details']);
  }
  else {
    $cnt = pmc_adm_categ_view();
  }
  return $cnt;
}
/**
* Categories view function
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_categ() {
  $cnt = NULL;
  if(isset($_GET['details']) && pmc_is_int($_GET['details'])) {
    $cnt = pmc_view_categ_details($_GET['details']);
  }
  else {
    $cnt = pmc_view_categ_view();
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
function pmc_adm_movies() {
  $cnt = NULL;
  if(isset($_GET['add']) && $_GET['add'] == 'new') {
    $cnt = pmc_adm_mov_add();
  }
  else if(isset($_GET['details']) && pmc_is_int($_GET['details'])) {
    $cnt = pmc_adm_mov_details($_GET['details']);
  }
  else {
    $cnt = pmc_adm_mov_view();
  }
  return $cnt;
}
/**
* Movies view function
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_movies() {
  $cnt = NULL;
  if(isset($_GET['details']) && pmc_is_int($_GET['details'])) {
    $cnt = pmc_view_mov_details($_GET['details']);
  }
  else {
    $cnt = pmc_view_mov_view();
  }
  return $cnt;
}
/**
* Movies view latest function
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_latest() {
  $cnt = pmc_view_mov_latest();
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
function pmc_adm_users() {
  $cnt = NULL;
  if(isset($_GET['add']) && $_GET['add'] == 'new') {
    $cnt = pmc_adm_usr_add();
  }
  else if(isset($_GET['details']) && pmc_is_int($_GET['details'])) {
    $cnt = pmc_adm_usr_details($_GET['details']);
  }
  else {
    $cnt = pmc_adm_usr_view();
  }
  return $cnt;
}
/**
* Users view function
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_users() {
  $cnt = NULL;
  if($_SESSION['pmc_usr_level'] > 0) {
    if(isset($_GET['details']) && pmc_is_int($_GET['details'])) {
      $cnt = pmc_view_usr_details($_GET['details']);
    }
    else {
      $cnt = pmc_view_usr_view();
    }
  }
  else {$_SESSION['pmc_msg'] = 2; header("Location: "._APP_URL); exit;}
  
  return $cnt;
}

/*
* ********** ********** ********** ********** USERS REQUEST PROCESSING END ********** ********** ********** **********
*/

/*
* ********** ********** ********** ********** SEARCH REQUEST PROCESSING START ********** ********** ********** **********
*/
/**
* Search function
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_search() {
  $cnt = NULL;
  if(isset($_GET['show']) && $_GET['show'] == 'results') {
    $cnt = pmc_view_search_results();
  }
  else {
    $cnt = pmc_view_search_advanced();
  }
  return $cnt;
}
/*
* ********** ********** ********** ********** SEARCH REQUEST PROCESSING END ********** ********** ********** **********
*/

/*
* ********** ********** ********** ********** MEDIA REQUEST PROCESSING START ********** ********** ********** **********
*/
/**
* Media administration function
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_media() {
  $cnt = NULL;
  if(isset($_GET['add']) && $_GET['add'] == 'new') {
    $cnt = pmc_adm_media_add();
  }
  else {
    $cnt = pmc_adm_media_view();
  }
  return $cnt;
}
/*
* ********** ********** ********** ********** MEDIA REQUEST PROCESSING END ********** ********** ********** **********
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
function pmc_categ_details($id) {
  $cnt['page'] = NULL;
  $result      = pmc_qry_exec("SELECT * FROM pmc_mov_cat WHERE cat_id = '{$id}'");
  $total       = pmc_qry_total($result);
  if($total == 1) {
    $row = pmc_qry_row($result);
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
function pmc_categ_view() {
  $cnt['page'] = NULL;
  $result = pmc_qry_exec("SELECT * FROM pmc_mov_cat ORDER BY cat_ord ASC");
  $total = pmc_qry_total($result);
  if($total > 0) {
    for($i=1;$i<=$total;$i++) {
      $row = pmc_qry_row($result);
      $cnt['page']['cat_id'][$i]   = $row['cat_id'];
      $cnt['page']['cat_pic'][$i]  = $row['cat_pic'];
      $cnt['page']['cat_tt'][$i]   = $row['cat_tt'];
      $cnt['page']['cat_ord'][$i]  = $row['cat_ord'];
      $cnt['page']['cat_desc'][$i] = $row['cat_desc'];
      $items = pmc_qry_exec("SELECT COUNT(mov_id) FROM pmc_mov_tt WHERE cat_id = '{$cnt['page']['cat_id'][$i]}'");
      $cnt['page']['cat_items'][$i] = pmc_qry_result($items);
      
      if(isset($_POST['cat_save_mod']) && $_SESSION['pmc_usr_level'] >= 4) {
        $lock = pmc_lock_tables(array('pmc_mov_cat'));
        if(isset($_POST['cat_del-'.$cnt['page']['cat_id'][$i]])) {
          if(is_file(_APP_DIR.'var/pic_cat/'.$cnt['page']['cat_pic'][$i])) {unlink(_APP_DIR.'var/pic_cat/'.$cnt['page']['cat_pic'][$i]);}
          $delete = pmc_qry_exec("DELETE FROM pmc_mov_cat WHERE cat_id = '{$cnt['page']['cat_id'][$i]}' LIMIT 1");
          if($delete === true) {$_SESSION['pmc_msg'] = 28;}
        }
        else if(isset($_POST['cat_ord-'.$cnt['page']['cat_id'][$i]]) && pmc_is_int($_POST['cat_ord-'.$cnt['page']['cat_id'][$i]])) {
          $update = pmc_qry_exec("UPDATE pmc_mov_cat SET cat_ord = '{$_POST['cat_ord-'.$cnt['page']['cat_id'][$i]]}' WHERE cat_id = '{$cnt['page']['cat_id'][$i]}' LIMIT 1");
          if($update === true) {$_SESSION['pmc_msg'] = 27;}
        }
        $unlock = pmc_unlock_tables();
        }
    }
    if(isset($_POST['cat_save_mod']) && $_SESSION['pmc_usr_level'] >= 4) {
      header("Location: " . _APP_URL . 'admin/categ/view/all');
      exit;
    }
  }
  else {
    $_SESSION['pmc_msg'] = 26;
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
function pmc_mov_details($id) {
  // categs
  $vcr = pmc_qry_exec("SELECT cat_id, cat_tt FROM pmc_mov_cat ORDER BY cat_ord");
  $vct = pmc_qry_total($vcr);
  if($vct > 0) {
    for($v=1;$v<=$vct;$v++) {
      $vcrw = pmc_qry_row($vcr);
      $cnt['page']['categs']['id'][$v] = $vcrw['cat_id'];
      $cnt['page']['categs']['tt'][$v] = $vcrw['cat_tt'];
    }
  }
  else {$_SESSION['pmc_msg'] = 34; header("Location: " . _APP_URL . 'admin/categ/add/new'); exit;}
  
  // media
  $rm = pmc_qry_exec("SELECT * FROM pmc_mov_med ORDER BY med_cat ASC");
  $tm = pmc_qry_total($rm);
  if($tm > 0) {
    for($j=1;$j<=$tm;$j++) {
      $rwm = pmc_qry_row($rm);
      $cnt['page']['media']['id'][$j] = $rwm['med_id'];
      $cnt['page']['media']['tt'][$j] = $rwm['med_cat'] . ' : ' . $rwm['med_tt'];
    }
  }
  else {$cnt['page']['media']['id'] = array();}
  
  $result = pmc_qry_exec("SELECT * FROM pmc_mov_tt WHERE mov_id = '{$id}'");
  $total = pmc_qry_total($result);
  if($total == 1) {
    $row = pmc_qry_row($result);
    $cnt['page']['cat_id']       = $row['cat_id'];
    $cnt['page']['med_id']       = $row['med_id'];
    $cnt['page']['mov_cat']      = $row['mov_cat'];
    $cnt['page']['mov_pic']      = $row['mov_pic'];
    $cnt['page']['mov_imdb']     = $row['mov_imdb'];
    $cnt['page']['mov_tt_pre']   = $row['mov_tt_pre'];
    $cnt['page']['mov_tt']       = $row['mov_tt'];
    $cnt['page']['mov_typ']      = $row['mov_typ'];
    $cnt['page']['mov_aka']      = $row['mov_aka'];
    $cnt['page']['mov_year']     = $row['mov_year'];
    $cnt['page']['mov_country']  = $row['mov_country'];
    $cnt['page']['mov_language'] = $row['mov_language'];
    $cnt['page']['mov_dir']      = $row['mov_dir'];
    $cnt['page']['mov_wrt']      = $row['mov_wrt'];
    $cnt['page']['mov_tag']      = $row['mov_tag'];
    $cnt['page']['mov_plot']     = $row['mov_plot'];
    $cnt['page']['mov_cast']     = $row['mov_cast'];
    $cnt['page']['mov_imdb_pic'] = '';
    $cnt['page']['mov_format']   = $row['mov_format'];
    $cnt['page']['mov_subs']     = $row['mov_subs'];
    $cnt['page']['mov_notes']    = $row['mov_notes'];
  }
  else {
    $cnt['page']['cat_id']       = '';
    $cnt['page']['med_id']       = '';
    $cnt['page']['mov_pic']      = '';
    $cnt['page']['mov_cat']      = '';
    $cnt['page']['mov_imdb']     = '';
    $cnt['page']['mov_tt_pre']   = '';
    $cnt['page']['mov_tt']       = '';
    $cnt['page']['mov_typ']      = 0;
    $cnt['page']['mov_aka']      = '';
    $cnt['page']['mov_year']     = '';
    $cnt['page']['mov_country']  = '';
    $cnt['page']['mov_language'] = '';
    $cnt['page']['mov_dir']      = '';
    $cnt['page']['mov_wrt']      = '';
    $cnt['page']['mov_tag']      = '';
    $cnt['page']['mov_plot']     = '';
    $cnt['page']['mov_cast']     = '';
    $cnt['page']['mov_imdb_pic'] = '';
    $cnt['page']['mov_format']   = '';
    $cnt['page']['mov_subs']     = '';
    $cnt['page']['mov_notes']    = '';
  }
  /* genres */
  $rg = pmc_qry_exec("SELECT gen_id, gen_tt FROM pmc_mov_gen");
  $tg = pmc_qry_total($rg);
  $cnt['page']['genres'] = array();
  $cnt['page']['genrett'] = array();
  if($tg > 0) {
    for($i=0;$i<$tg;$i++) {
      $rwg = pmc_qry_row($rg); /* array cu genres ids*/
      $cnt['page']['genres'][$i] = $rwg['gen_id'];
      $cnt['page']['genrett'][$cnt['page']['genres'][$i]] = $rwg['gen_tt'];
      $rg2 = pmc_qry_exec("SELECT rel_id FROM pmc_mov_rel WHERE mov_id = '{$id}' AND gen_id = '{$cnt['page']['genres'][$i]}' LIMIT 1");
      $tg2 = pmc_qry_total($rg2);
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
function pmc_mov_view($cnttype = 'admin', $homepage = 0) {
  // categories
  $rc = pmc_qry_exec("SELECT * FROM pmc_mov_cat ORDER BY cat_ord ASC");
  $tc = pmc_qry_total($rc);
  if($tc > 0) {
    for($j=1;$j<=$tc;$j++) {
      $rwc = pmc_qry_row($rc);
      $cnt['page']['cat_tt'][$rwc['cat_id']] = $rwc['cat_tt'];
    }
  }
  // media  
  $rm = pmc_qry_exec("SELECT * FROM pmc_mov_med ORDER BY med_cat ASC");
  $tm = pmc_qry_total($rm);
  if($tm > 0) {
    for($k=1;$k<=$tm;$k++) {
      $rwm = pmc_qry_row($rm);
      $cnt['page']['med_cat'][$rwm['med_id']] = $rwm['med_cat'];
    }
  }
  // categ
  $cat_id = 0;
  $q_cat_id        = "IS NOT NULL";
  if(isset($_GET['categ'])) {
    $cat_id = pmc_filter_input($_GET['categ']);
    if(pmc_is_int($cat_id) && $cat_id != 0) {$q_cat_id = "= '{$cat_id}'";}
  }
  // med
  $med_id = 0;
  $q_med_id        = "IS NOT NULL";
  if(isset($_GET['media'])) {
    $med_id = pmc_filter_input($_GET['media']);
    if(pmc_is_int($med_id) && $med_id != 0) {$q_med_id = "= '{$med_id}'";}
  }
  // format
  $mov_format = 0;
  $q_mov_format        = "IS NOT NULL";
  if(isset($_GET['format'])) {
    $mov_format = pmc_filter_input($_GET['format']);
    if(pmc_is_int($mov_format) && $mov_format != 0) {$q_mov_format = "= '{$mov_format}'";}
  }
  // sorting
  $sort = 'title';
  $q_sort = "mov_tt";
  if(isset($_GET['sort'])) {
    $sort = pmc_filter_input($_GET['sort']);
    switch($sort) {
      case 'categ' : {$q_sort = "cat_id"; break;}
      case 'title' : {$q_sort = "mov_tt"; break;}
      case 'year'  : {$q_sort = "mov_year"; break;}
      case 'latest': {$q_sort = "y"; break;}
      default      : {break;}
    }
  }
  else if(isset($_GET['view']) && $_GET['view'] == 'latest') {$q_sort = "x";}
  else if($homepage == 1) {$q_sort = "x";}
  $order = 'a';
  $latest = 0;
  $q_order        = "ASC";
  
  if($q_sort == 'x') {$q_sort = ''; $q_order = "mov_date DESC, mov_time DESC"; $latest = 1;}
  else if($q_sort == 'y') {$q_sort = ''; $q_order = "mov_date DESC, mov_time DESC"; $latest = 2;}
  else if(isset($_GET['order'])) {
    $order = pmc_filter_input($_GET['order']);
    switch($order) {
      case 'a' : {$q_order = "ASC";  break;}
      case 'd' : {$q_order = "DESC"; break;}
      default  : {break;}
    }
  }

  $genre = '0';
  if(isset($_GET['genre'])) {
    if(pmc_is_int($_GET['genre'])) {$genre = pmc_filter_input($_GET['genre']);}
  }
  
  // filter (search)
  $searchtype = 0;
  if(isset($_POST['search'])) {
    if(pmc_filter_input($_POST['search']) == 1) {$searchtype = 1;}
    else if(pmc_filter_input($_POST['search']) == 2) {$searchtype = 2;}
    else if(pmc_filter_input($_POST['search']) == 3) {$searchtype = 3;}
  }
  $q_mov_cat     = "IS NOT NULL";
  if(isset($_POST['mov_cat'])) {$q_mov_cat = pmc_queryfill_search($searchtype, $_POST['mov_cat']);}
  $q_mov_imdb     = "IS NOT NULL";
  if(isset($_POST['mov_imdb'])) {$q_mov_imdb = pmc_queryfill_search($searchtype, $_POST['mov_imdb']);}
  $q_mov_tt       = "IS NOT NULL";
  if(isset($_POST['mov_tt'])) {$q_mov_tt = pmc_queryfill_search($searchtype, $_POST['mov_tt']);}
  else if(isset($_POST['mov_tt_s'])) {$q_mov_tt = pmc_queryfill_search($searchtype, $_POST['mov_tt_s']);}
  $q_mov_aka      = "IS NOT NULL";
  if(isset($_POST['mov_aka'])) {$q_mov_aka = pmc_queryfill_search($searchtype, $_POST['mov_aka']);}
  $q_mov_year     = "IS NOT NULL";
  if(isset($_POST['mov_year'])) {$q_mov_year = pmc_queryfill_search($searchtype, $_POST['mov_year']);}
  $q_mov_country  = "IS NOT NULL";
  if(isset($_POST['mov_country'])) {$q_mov_country = pmc_queryfill_search($searchtype, $_POST['mov_country']);}
  $q_mov_language = "IS NOT NULL";
  if(isset($_POST['mov_language'])) {$q_mov_language = pmc_queryfill_search($searchtype, $_POST['mov_language']);}
  $q_mov_dir      = "IS NOT NULL";
  if(isset($_POST['mov_dir'])) {$q_mov_dir = pmc_queryfill_search($searchtype, $_POST['mov_dir']);}
  $q_mov_wrt      = "IS NOT NULL";
  if(isset($_POST['mov_wrt'])) {$q_mov_wrt = pmc_queryfill_search($searchtype, $_POST['mov_wrt']);}
  $q_mov_tag      = "IS NOT NULL";
  if(isset($_POST['mov_tag'])) {$q_mov_tag = pmc_queryfill_search($searchtype, $_POST['mov_tag']);}
  $q_mov_plot     = "IS NOT NULL";
  if(isset($_POST['mov_plot'])) {$q_mov_plot = pmc_queryfill_search($searchtype, $_POST['mov_plot']);}
  $q_mov_cast     = "IS NOT NULL";
  if(isset($_POST['mov_cast'])) {$q_mov_cast = pmc_queryfill_search($searchtype, $_POST['mov_cast']);}
  // pagination
  
  $page = 1;
  if(isset($_GET['page']) && pmc_is_int($_GET['page'])) {$page = $_GET['page'];}
  $items = _APP_IMOV;
  $offset = ($page - 1) * $items;
  if ($searchtype == 0 && $latest == 0) {$q_limit = " LIMIT ".$offset.", ".$items."";}
  else if($searchtype == 0 && $latest == 1) {$q_limit = " LIMIT 0, "._APP_LMOV;}
  else if($searchtype == 0 && $latest == 2) {$q_limit = " LIMIT ".$offset.", ".$items."";}
  else {$q_limit = "";}
  
  //genre query
  $q_genres = "IS NOT NULL";
  if($genre != '0') {
    $rg = pmc_qry_exec("SELECT DISTINCT(mov_id) FROM pmc_mov_rel WHERE gen_id = '{$genre}'");
    $tg = pmc_qry_total($rg);
    if($tg != 0) {
      $mi = '';
      for($g=0;$g<$tg;$g++) {
      $qg = pmc_qry_row($rg);
      $mi .= $qg['mov_id'];
      if($g != $tg-1) {$mi .= ', ';}
      }
      $q_genres = "IN ({$mi})";
    }
    else {$q_genres = "IN (0)";}
  }
  
  // build query
  $q1 = "SELECT SQL_CALC_FOUND_ROWS * FROM pmc_mov_tt WHERE med_id {$q_med_id} AND cat_id {$q_cat_id} AND mov_id {$q_genres} AND mov_imdb {$q_mov_imdb} AND mov_tt {$q_mov_tt} AND mov_aka {$q_mov_aka} AND mov_year {$q_mov_year} AND mov_country {$q_mov_country} AND mov_language {$q_mov_language} AND mov_dir {$q_mov_dir} AND mov_wrt {$q_mov_wrt} AND mov_tag {$q_mov_tag} AND mov_plot {$q_mov_plot} AND mov_cast {$q_mov_cast} AND mov_format {$q_mov_format} ORDER BY {$q_sort} {$q_order} {$q_limit}";
  $q2 = "SELECT FOUND_ROWS() as totalitems";
  //die($q1); exit;
  
  $cnt['page']['movies'] = array();
  $r = pmc_qry_exec($q1);
  $t = pmc_qry_total($r);
  $rw = array();
  if($t > 0) {
    for($i=0;$i<$t;$i++) {
      $rw[$i] = pmc_qry_row($r);
      if(isset($_POST['mov_save_mod']) && $_SESSION['pmc_usr_level'] >= 4) {
        $lock = pmc_lock_tables(array('pmc_mov_tt', 'pmc_mov_rel'));
        if(isset($_POST['mov_del-'.$rw[$i]['mov_id']])) {
          if(is_file(_APP_DIR.'var/pic_mov/'.$rw[$i]['mov_pic'])) {unlink(_APP_DIR.'var/pic_mov/'.$rw[$i]['mov_pic']);}
          $delete  = pmc_qry_exec("DELETE FROM pmc_mov_tt WHERE mov_id = '{$rw[$i]['mov_id']}' LIMIT 1");
          $delete2 = pmc_qry_exec("DELETE FROM pmc_mov_rel WHERE mov_id = '{$rw[$i]['mov_id']}'");
          if($delete === true && $delete2 === true) {$_SESSION['pmc_msg'] = 40;}
        }
        $unlock = pmc_unlock_tables();
      }  
    }
    if(isset($_POST['mov_save_mod']) && $_SESSION['pmc_usr_level'] >= 4) {
      header("Location: " . _APP_URL . "admin/movies/media/".$med_id."/categ/".$cat_id."/sort/".$sort."/order/".$order."/genre/".$genre."/format/".$mov_format);
      exit;
    }
  }
  $total = pmc_qry_result(pmc_qry_exec($q2));
  $cnt['page']['searchtype'] = $searchtype;
  $cnt['page']['latest']     = $latest;
  $cnt['page']['page']       = $page;
  $cnt['page']['total']      = $total;
  $cnt['page']['maxpage']    = ceil($total/$items);
  $cnt['page']['prevpage']   = $page - 1;
  $cnt['page']['nextpage']   = $page + 1;
  $cnt['page']['categ']      = $cat_id;
  $cnt['page']['sort']       = $sort;
  $cnt['page']['order']      = $order;
  //$cnt['page']['genre']      = $genre;
  
  $cnt['page']['link_first'] = '&#60;&#60;';
  $cnt['page']['link_prev']  = '&#60;';
  if($cnt['page']['page'] > 1) {
    $cnt['page']['link_first'] = '<a href="'._APP_URL.$cnttype.'/movies/media/'.$med_id.'/categ/'.$cat_id.'/sort/'.$sort.'/order/'.$order.'/genre/'.$genre.'/format/'.$mov_format.'/page/1">'.$cnt['page']['link_first'].'</a>';
    $cnt['page']['link_prev']  = '<a href="'._APP_URL.$cnttype.'/movies/media/'.$med_id.'/categ/'.$cat_id.'/sort/'.$sort.'/order/'.$order.'/genre/'.$genre.'/format/'.$mov_format.'/page/'.$cnt['page']['prevpage'].'">'.$cnt['page']['link_prev'].'</a>';
  }
  $cnt['page']['link_next']  = '&#62;';
  $cnt['page']['link_last']  = '&#62;&#62;';
  if($cnt['page']['page'] < $cnt['page']['maxpage']) {
    $cnt['page']['link_next']  = '<a href="'._APP_URL.$cnttype.'/movies/media/'.$med_id.'/categ/'.$cat_id.'/sort/'.$sort.'/order/'.$order.'/genre/'.$genre.'/format/'.$mov_format.'/page/'.$cnt['page']['nextpage'].'">'.$cnt['page']['link_next'].'</a>';
    $cnt['page']['link_last']  = '<a href="'._APP_URL.$cnttype.'/movies/media/'.$med_id.'/categ/'.$cat_id.'/sort/'.$sort.'/order/'.$order.'/genre/'.$genre.'/format/'.$mov_format.'/page/'.$cnt['page']['maxpage'].'">'.$cnt['page']['link_last'].'</a>';
  }
  $cnt['page']['movies'] = $rw;
  if($cnt['page']['total'] == 0) {if($_SESSION['pmc_msg'] != 55) {$_SESSION['pmc_msg'] = 39;}}
  else if($_SESSION['pmc_msg'] != 40) {$_SESSION['pmc_msg'] = 0;}
  return $cnt['page'];
}

/*
* ********** ********** ********** ********** GENERAL MOVIE FUNCTIONS END ********** ********** ********** **********
*/


/*
* ********** ********** ********** ********** GENERAL USERS FUNCTIONS START ********** ********** ********** **********
*/

/**
* Users - view all
*
* @return array $cnt content to be displayed to the user
*/
function pmc_usr_view() {
  $page = 1;
  if(isset($_GET['page']) && pmc_is_int($_GET['page'])) {$page = $_GET['page'];}
  $items = _APP_IUSR;
  $offset = ($page - 1) * $items;
  $q_limit = " LIMIT ".$offset.", ".$items."";
  
  $r = pmc_qry_exec("SELECT SQL_CALC_FOUND_ROWS U.usr_id, U.usr_name, U.usr_fname, U.usr_lname, U.usr_level, U.usr_status, count(distinct(l.mov_id)) as list_items FROM pmc_set_usr AS U LEFT JOIN pmc_set_lst AS l ON (U.usr_id = L.usr_id) GROUP BY U.usr_name {$q_limit}");
  $t = pmc_qry_total($r);
  if($t > 0) {
    for($i=0;$i<$t;$i++) {
      $rw[$i] = pmc_qry_row($r);
      if(isset($_POST['usr_save_mod']) && $_SESSION['pmc_usr_level'] >= 4) {
        if(isset($_POST['usr_del-'.$rw[$i]['usr_id']])) {
          $lock = pmc_lock_tables(array('pmc_set_usr'));
          $delete = pmc_qry_exec("DELETE FROM pmc_set_usr WHERE usr_id = '{$rw[$i]['usr_id']}' LIMIT 1");
          if($delete === true) {$_SESSION['pmc_msg'] = 50;}
          $unlock = pmc_unlock_tables();
          
        }
      }
    }
    if(isset($_POST['usr_save_mod']) && $_SESSION['pmc_usr_level'] >= 4) {header("Location: " . _APP_URL . 'admin/users'); exit;}
  }
  $cnt['page']['total']    = pmc_qry_result(pmc_qry_exec("SELECT FOUND_ROWS() as totalitems"));
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
  
  if($cnt['page']['total'] == 0) {$_SESSION['pmc_msg'] = 49;}
  else if($_SESSION['pmc_msg'] != 50) {$_SESSION['pmc_msg'] = 0;}
  return $cnt['page'];
}
/*
* ********** ********** ********** ********** GENERAL USERS FUNCTIONS END ********** ********** ********** **********
*/

/*
* ********** ********** ********** ********** GENERAL GENRES FUNCTIONS START ********** ********** ********** **********
*/
/**
* Genres - all genres
*
* @return array $gen genres with total items
*/
function pmc_genre_menu() {
  global $lang;
  $gen['tt'] = $lang['genre']['genres'];
  
  $gen['genre_id']    = '';
  $gen['genre_title'] = '';
  $gen['genre_items'] = '';
  $result = pmc_qry_exec("SELECT A.gen_id AS genre_id, A.gen_tt AS genre_title, count(distinct(B.mov_id)) AS genre_items FROM pmc_mov_gen AS A LEFT JOIN pmc_mov_rel AS B ON (A.gen_id = B.gen_id) GROUP BY genre_title");
  $total = pmc_qry_total($result);
  if($total > 0) {
    for($i=1;$i<=$total;$i++) {
      $row = pmc_qry_row($result);
      $gen['genre_id'][$i]    = $row['genre_id'];
      $gen['genre_title'][$i] = $row['genre_title'];
      $gen['genre_items'][$i] = $row['genre_items'];
    }
  }
  return $gen;
}
/*
* ********** ********** ********** ********** GENERAL GENRES FUNCTIONS END ********** ********** ********** **********
*/

/*
* ********** ********** ********** ********** LANGS & SKINS FUNCTION START ********** ********** ********** **********
*/
/**
* Languages - change on the fly
*
* @return array $cnt content to be displayed
*/
function pmc_view_langs() {
  global $lang;
  $cnt['skin'] = 'view/langs/v_l.tpl.php';
  $cnt['tt'] = $lang['view']['view'] . _APP_SEP . $lang['lang']['langs'];
  $langs = pmc_lsdir(_APP_DIR.'lang/');
  $t = count($langs);
  
  if($t > 0) {
    for($i=0;$i<$t;$i++) {
      $cnt['page']['langs']['idx'][$i] = $langs[$i];
      if(isset($_POST['lang_set-'.$cnt['page']['langs']['idx'][$i]])) {
        $_SESSION['pmc_usr_lang'] = $cnt['page']['langs']['idx'][$i];
        $_SESSION['pmc_msg'] = 51;
        header("Location: " . _APP_URL . 'view/langs');
        exit;
      }
      else {$_SESSION['pmc_msg'] = 0;}
      $info_file = _APP_DIR.'lang/'. $cnt['page']['langs']['idx'][$i] . '/lang.info.php';
      $cnt['page']['langs']['name'][$i]  = 'n/a';
      $cnt['page']['langs']['desc'][$i]  = 'n/a';
      $cnt['page']['langs']['trans'][$i] = 'n/a';
      $cnt['page']['langs']['mail'][$i]  = 'n/a';
      $cnt['page']['langs']['url'][$i]   = 'n/a';
      if(is_readable($info_file)) {
        $lines = file($info_file);
        $cnt['page']['langs']['name'][$i]  = trim(str_replace('\';', '', str_replace('$lang_info[\'ln_name\']  = \'', '', $lines[27])));
        $cnt['page']['langs']['desc'][$i]  = trim(str_replace('\';', '', str_replace('$lang_info[\'ln_desc\']  = \'', '', $lines[28])));
        $cnt['page']['langs']['trans'][$i] = trim(str_replace('\';', '', str_replace('$lang_info[\'ln_trans\'] = \'', '', $lines[29])));
        $cnt['page']['langs']['mail'][$i]  = trim(str_replace('\';', '', str_replace('$lang_info[\'ln_mail\']  = \'', '', $lines[30])));
        $cnt['page']['langs']['url'][$i]   = trim(str_replace('\';', '', str_replace('$lang_info[\'ln_url\']   = \'', '', $lines[31])));
      }
    }
  }
  return $cnt;
}
/**
* Skins - change on the fly
*
* @return array $cnt content to be displayed
*/
function pmc_view_skins() {
  global $lang;
  $cnt['skin'] = 'view/skins/v_sk.tpl.php';
  $cnt['tt'] = $lang['view']['view'] . _APP_SEP . $lang['skin']['skins'];
  $skins = pmc_lsdir(_APP_DIR.'skin/');
  $t = count($skins);
  
  if($t > 0) {
    for($i=0;$i<$t;$i++) {
      $cnt['page']['skins']['idx'][$i] = $skins[$i];
      if(isset($_POST['skin_set-'.$cnt['page']['skins']['idx'][$i]])) {
        $_SESSION['pmc_usr_skin']      = _APP_DIR . 'skin/' . $cnt['page']['skins']['idx'][$i] . '/';
        $_SESSION['pmc_usr_skin_url']  = _APP_WWW . 'skin/' . $cnt['page']['skins']['idx'][$i] . '/';
        $_SESSION['pmc_msg'] = 52;
        header("Location: " . _APP_URL . 'view/skins');
        exit;
      }
      else {$_SESSION['pmc_msg'] = 0;}
      $info_file = _APP_DIR.'skin/'. $cnt['page']['skins']['idx'][$i] . '/skin.info.php';
      $cnt['page']['skins']['name'][$i]  = 'n/a';
      $cnt['page']['skins']['desc'][$i]  = 'n/a';
      $cnt['page']['skins']['auth'][$i]  = 'n/a';
      $cnt['page']['skins']['mail'][$i]  = 'n/a';
      $cnt['page']['skins']['url'][$i]   = 'n/a';
      if(is_readable($info_file)) {
        $lines = file($info_file);
        $cnt['page']['skins']['name'][$i]  = trim(str_replace('\';', '', str_replace('$skin_info[\'sk_name\']  = \'', '', $lines[27])));
        $cnt['page']['skins']['desc'][$i]  = trim(str_replace('\';', '', str_replace('$skin_info[\'sk_desc\']  = \'', '', $lines[28])));
        $cnt['page']['skins']['auth'][$i]  = trim(str_replace('\';', '', str_replace('$skin_info[\'sk_auth\']  = \'', '', $lines[29])));
        $cnt['page']['skins']['mail'][$i]  = trim(str_replace('\';', '', str_replace('$skin_info[\'sk_mail\']  = \'', '', $lines[30])));
        $cnt['page']['skins']['url'][$i]   = trim(str_replace('\';', '', str_replace('$skin_info[\'sk_url\']   = \'', '', $lines[31])));
        $cnt['page']['skins']['ver'][$i]   = trim(str_replace('\';', '', str_replace('$skin_info[\'sk_ver\']   = \'', '', $lines[32])));
      }
    }
  }
  return $cnt;
}
/*
* ********** ********** ********** ********** LANGS & SKINS FUNCTION END ********** ********** ********** **********
*/

/*
* ********** ********** ********** ********** USER LIST FUNCTIONS START ********** ********** ********** **********
*/
/**
* User list - manage
*
* @return mixed result
*/
function pmc_usr_list($pmc_cart_act) {
  $request_uri = $_SERVER['REQUEST_URI'];
  if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] != '') {$server = $_SERVER['HTTP_HOST'];}
  else if(isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] != '') {$server = $_SERVER['SERVER_NAME'];}
  $location = 'http://' . $server . $request_uri;
  foreach($pmc_cart_act as $id => $act) {
    switch($act) {
      case 'add'   : {if(!isset($_SESSION['pmc_usr_lst'][$id])) {$_SESSION['pmc_usr_lst'][$id] = true; $_SESSION['pmc_msg'] = 53;} break;}
      case 'del'   : {if(isset($_SESSION['pmc_usr_lst'][$id])) {unset($_SESSION['pmc_usr_lst'][$id]); $_SESSION['pmc_msg'] = 54;} break;}
      case 'clear' : {pmc_usr_list_clear(); break;}
      case 'save'  : {pmc_usr_list_save(); break;}
      case 'load'  : {pmc_usr_list_load(); break;}
    }
  }
  header("Location: " . $location); exit;
}
/**
* User list - clear
*
* @return mixed result
*/
function pmc_usr_list_clear() {
  $_SESSION['pmc_usr_lst'] = array();
  if($_SESSION['pmc_usr_id'] != 0) {
    pmc_qry_exec("DELETE FROM pmc_set_lst WHERE usr_id = '{$_SESSION['pmc_usr_id']}'");
  }
  $_SESSION['pmc_msg'] = 56;
  return true;
}
/**
* User list - save
*
* @return mixed result
*/
function pmc_usr_list_save() {
  if($_SESSION['pmc_usr_level'] > 0) {
    pmc_qry_exec("DELETE FROM pmc_set_lst WHERE usr_id = '{$_SESSION['pmc_usr_id']}'");
    $t = count($_SESSION['pmc_usr_lst']);
    if($t > 0) {
      $date = date("Y-m-d");
      $time = date("H:i:s");
      foreach($_SESSION['pmc_usr_lst'] as $id => $value) {
        pmc_qry_exec("INSERT INTO pmc_set_lst (usr_id, mov_id, lst_date, lst_time) VALUES ('{$_SESSION['pmc_usr_id']}', '{$id}', '{$date}', '{$time}')");
      }
      $_SESSION['pmc_msg'] = 57;
    }
    else {$_SESSION['pmc_msg'] = 60;}
  }
  else {$_SESSION['pmc_msg'] = 55;}
  return true;
}
/**
* User list - load
*
* @return mixed result
*/
function pmc_usr_list_load() {
  if($_SESSION['pmc_usr_level'] > 0) {
    $_SESSION['pmc_usr_lst'] = array();
    $r = pmc_qry_exec("SELECT mov_id FROM pmc_set_lst WHERE usr_id = '{$_SESSION['pmc_usr_id']}'");
    $t = pmc_qry_total($r);
    if($t > 0) {
      for($i=0;$i<$t;$i++) {
        $rw = pmc_qry_row($r);
        $_SESSION['pmc_usr_lst'][$rw['mov_id']] = true;
      }
      $_SESSION['pmc_msg'] = 58;
    }
    else {$_SESSION['pmc_msg'] = 59;}
  }
  else {$_SESSION['pmc_msg'] = 55;}
  return true;
}
/**
* User list - view personal or other's
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_list() {
  $cnt = NULL;
  if($_SESSION['pmc_usr_level'] > 0) {
    if(isset($_GET['user']) && pmc_is_int($_GET['user'])) {
      $cnt = pmc_view_list_user($_GET['user']);
    }
    else {
      $cnt = pmc_view_list_usr();
    }
  }
  else if($_SESSION['pmc_usr_level'] == 0 && !isset($_GET['user'])) {$cnt = pmc_view_list_usr();}
  else {$_SESSION['pmc_msg'] = 55; header("Location: "._APP_URL); exit;}
  
  return $cnt;
}
/**
* User list - view other's
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_list_user($usrid) {
  global $lang;
  $cnt['skin'] = 'view/list/v_l-user.tpl.php';
  $cnt['tt'] = $lang['view']['view'] . _APP_SEP . $lang['list']['mylist'];
  
  
  $r = pmc_qry_exec("SELECT mov_id FROM pmc_set_lst WHERE usr_id = '{$usrid}'");
  $tl = pmc_qry_total($r);
  if($tl > 0) {
    $movie_list = '';
    for($i=0;$i<$tl;$i++) {
      $rw = pmc_qry_row($r);
      $movie_list .= $rw['mov_id'] . ', ';
    }
    $movie_list .= '0';
  }
  else {$movie_list = '0';}
  $cnt['page'] = pmc_view_list_get($movie_list);
  return $cnt;
}
/**
* User list - view own
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_list_usr() {
  global $lang;
  $cnt['skin'] = 'view/list/v_l.tpl.php';
  $cnt['tt'] = $lang['view']['view'] . _APP_SEP . $lang['list']['mylist'];
  
  $tl = count($_SESSION['pmc_usr_lst']);
  if($tl > 0) {
    $movie_list = '';
    foreach($_SESSION['pmc_usr_lst'] as $id => $value) {$movie_list .= $id . ', ';}
    $movie_list .= '0';
  }
  else {$movie_list = '0';}
  $cnt['page'] = pmc_view_list_get($movie_list);
  return $cnt;
}
/**
* User list - get from db
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_list_get($movie_list) {
  // categories
  $rc = pmc_qry_exec("SELECT * FROM pmc_mov_cat ORDER BY cat_ord ASC");
  $tc = pmc_qry_total($rc);
  if($tc > 0) {
    for($j=1;$j<=$tc;$j++) {
      $rwc = pmc_qry_row($rc);
      $cnt['page']['cat_tt'][$rwc['cat_id']] = $rwc['cat_tt'];
    }
  }
  
  // build query
  $q1 = "SELECT * FROM pmc_mov_tt WHERE mov_id IN ({$movie_list}) ORDER BY mov_tt ASC";
  
  $cnt['page']['movies'] = array();
  $r = pmc_qry_exec($q1);
  $t = pmc_qry_total($r);
  $rw = array();
  if($t > 0) {
    for($i=0;$i<$t;$i++) {
      $rw[$i] = pmc_qry_row($r);
    }
  }
  $cnt['page']['movies'] = $rw;
  if($t == 0) {if($_SESSION['pmc_msg'] != 55) {$_SESSION['pmc_msg'] = 39;}}
  else {$_SESSION['pmc_msg'] = 0;}
  return $cnt['page'];
}
/*
* ********** ********** ********** ********** USER LIST FUNCTIONS END ********** ********** ********** **********
*/

/*
* ********** ********** ********** ********** HELP FUNCTIONS START ********** ********** ********** **********
*/
/**
* Help page
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_help() {
  global $lang;
  $cnt['skin'] = 'help.tpl.php';
  $cnt['tt']   = $lang['help']['help'];
  $cnt['page']['text']  = $lang['help']['text'];
  $cnt['page']['urltt'] = $lang['help']['urltt'];
  return $cnt;
}
/*
* ********** ********** ********** ********** HELP FUNCTIONS END ********** ********** ********** **********
*/
/*
* ********** ********** ********** ********** ABOUT FUNCTIONS START ********** ********** ********** **********
*/
/**
* About page
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_about() {
  global $lang;
  $cnt['skin'] = 'about.tpl.php';
  $cnt['tt']   = $lang['about']['about'];
  $cnt['page'] = null;
  return $cnt;
}
/*
* ********** ********** ********** ********** ABOUT FUNCTIONS END ********** ********** ********** **********
*/
/*
* ********** ********** ********** ********** MISC FUNCTIONS START ********** ********** ********** **********
*/
/**
* Collector info
*
* @return array $usr collector info
*/
function pmc_collector() {
  global $lang;
  $usr['name']  = 'Guest';
  $usr['fname'] = 'Anonymous';
  $usr['lname'] = '';
  $result = pmc_qry_exec("SELECT usr_name, usr_fname, usr_lname FROM pmc_set_usr WHERE usr_id = '1' AND usr_level = '5' LIMIT 1");
  $total = pmc_qry_total($result);
  if($total > 0) {
    $row = pmc_qry_row($result);
    $usr['name']  = $row['usr_name'];
    $usr['fname'] = $row['usr_fname'];
    $usr['lname'] = $row['usr_lname'];
  }
  return $usr;
}
/**
* Movie list latest
*
* @return array $cnt content to be displayed to the user
*/
function pmc_home_page() {
  global $lang;
  $cnt['skin'] = 'home.tpl.php';
  $cnt['tt'] = $lang['pmc']['welcome'];
  $cnt['page'] = pmc_mov_view('view', 1);
  return $cnt;
}
/*
* ********** ********** ********** ********** MISC FUNCTIONS END ********** ********** ********** **********
*/
?>