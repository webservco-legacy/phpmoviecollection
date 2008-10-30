<?php
/**
* ./inc/func-a_m.inc.php (admin movie functions)
*
* <I> ./inc/func-a_m.inc.php</I>
* <BR>This is the admin movie functions file
* <BR>It contains all the functions
* <BR>used in the admin side
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    09:58 2008-10-30
* @since      15:32 2008-09-03
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
* Movie add
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_mov_add() {
  global $lang;
  $vcr = pmc_qry_exec("SELECT cat_id, cat_tt FROM pmc_mov_cat ORDER BY cat_ord");
  $vct = pmc_qry_total($vcr);
  if($vct > 0) {
    for($v=0;$v<$vct;$v++) {
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
  
  $cnt['skin'] = 'admin/movies/a_m-new.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['movie']['movies'] . _APP_SEP . $lang['movie']['add'];
  $cnt['page']['cat_id']       = '';
  $cnt['page']['med_id']       = 0;
  $cnt['page']['mov_cat']      = '';
  
  $last_cat = pmc_qry_exec("SELECT MAX(mov_cat) FROM pmc_mov_tt");
  $cnt['page']['mov_cat_last'] = pmc_qry_result($last_cat);
  
  $cnt['page']['mov_pic']       = '';
  $cnt['page']['mov_imdb']      = '';
  $cnt['page']['mov_tt_pre']    = '';
  $cnt['page']['mov_tt']        = '';
  $cnt['page']['mov_typ']       = 0;
  $cnt['page']['mov_aka']       = '';
  $cnt['page']['mov_year']      = '';
  $cnt['page']['mov_country']   = '';
  $cnt['page']['mov_language']  = '';
  $cnt['page']['mov_dir']       = '';
  $cnt['page']['mov_wrt']       = '';
  $cnt['page']['mov_tag']       = '';
  $cnt['page']['mov_plot']      = '';
  $cnt['page']['mov_cast']      = '';
  $cnt['page']['mov_imdb_pic']  = '';
  $cnt['page']['mov_format']    = '';
  $cnt['page']['mov_subs']      = '';
  $cnt['page']['mov_notes']     = '';
  
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
      $cnt['page']['genre'][$cnt['page']['genres'][$i]] = 0;
    }
  }
  /* //genres */
 
  /*
  REMOVED FOR COMPATIBILITY WITH PHP < 5.2
  $egl = error_get_last();
  $res = strpos($egl['message'], 'POST Content-Length of');
  if ($res !== false ) {$_SESSION['pmc_msg'] = 17; header("Location: " . _APP_URL); exit;}
  else if(isset($_POST['mov_imdb_fetch'])) {
  */
  if(isset($_POST['mov_imdb_fetch'])) {
    if(isset($_POST['imdb_url'])) {
      require_once './lib/browseremulator.class.php';
      require_once './lib/imdb.inc.php';
      $imdb_id = pmc_filter_input($_POST['imdb_url']);
      $imdb_id = str_replace('http://www.imdb.com/title/tt', '', $imdb_id);
      $imdb_id = str_replace('/', '', $imdb_id);
      
      $imdb = pmc_get_imdb($imdb_id);
      $cnt['page']['mov_imdb']      = $imdb_id;
      $cnt['page']['mov_tt_pre']    = $imdb['title_the'];
      $cnt['page']['mov_tt']        = $imdb['title'];
      $cnt['page']['mov_typ']       = $imdb['typ'];
      $cnt['page']['mov_aka']       = $imdb['aka'];
      $cnt['page']['mov_year']      = $imdb['year'];
      $cnt['page']['mov_country']   = $imdb['country'];
      $cnt['page']['mov_language']  = $imdb['language'];
      $cnt['page']['mov_dir']       = $imdb['dir'];
      $cnt['page']['mov_wrt']       = $imdb['wrt'];
      $cnt['page']['mov_tag']       = $imdb['tag'];
      $cnt['page']['mov_plot']      = $imdb['plot'];
      $cnt['page']['mov_cast']      = $imdb['cast'];
      $_SESSION['pmc_imdb_pics']    = pmc_get_imdb_pics($imdb['pics_url']);
      $_SESSION['pmc_msg'] = 35;
    }
  }
  else if(isset($_POST['mov_add'])) {
    if(isset($_POST['cat_id']))        {$cnt['page']['cat_id']        = pmc_filter_input($_POST['cat_id']);}
    if(isset($_POST['med_id']))        {$cnt['page']['med_id']        = pmc_filter_input($_POST['med_id']);}
    if(isset($_POST['mov_cat']))       {$cnt['page']['mov_cat']       = pmc_filter_input($_POST['mov_cat']);}
    if(isset($_POST['mov_imdb']))      {$cnt['page']['mov_imdb']      = pmc_filter_input($_POST['mov_imdb']);}
    if(isset($_POST['mov_tt_pre']))    {$cnt['page']['mov_tt_pre']    = pmc_filter_input($_POST['mov_tt_pre']);}
    if(isset($_POST['mov_tt']))        {$cnt['page']['mov_tt']        = pmc_filter_input($_POST['mov_tt']);}
    if(isset($_POST['mov_typ']))       {$cnt['page']['mov_typ']       = pmc_filter_input($_POST['mov_typ']);}
    if(isset($_POST['mov_aka']))       {$cnt['page']['mov_aka']       = pmc_filter_input($_POST['mov_aka']);}
    if(isset($_POST['mov_year']))      {$cnt['page']['mov_year']      = pmc_filter_input($_POST['mov_year']);}
    if(isset($_POST['mov_country']))   {$cnt['page']['mov_country']   = pmc_filter_input($_POST['mov_country']);}
    if(isset($_POST['mov_language']))  {$cnt['page']['mov_language']  = pmc_filter_input($_POST['mov_language']);}
    if(isset($_POST['mov_dir']))       {$cnt['page']['mov_dir']       = pmc_filter_input($_POST['mov_dir']);}
    if(isset($_POST['mov_wrt']))       {$cnt['page']['mov_wrt']       = pmc_filter_input($_POST['mov_wrt']);}
    if(isset($_POST['mov_tag']))       {$cnt['page']['mov_tag']       = pmc_filter_input($_POST['mov_tag']);}
    if(isset($_POST['mov_plot']))      {$cnt['page']['mov_plot']      = pmc_filter_input($_POST['mov_plot']);}
    if(isset($_POST['mov_cast']))      {$cnt['page']['mov_cast']      = pmc_filter_input($_POST['mov_cast']);}
    if(isset($_POST['mov_imdb_pic']))  {$cnt['page']['mov_imdb_pic']  = pmc_filter_input($_POST['mov_imdb_pic']);}
    if(isset($_POST['mov_format']))    {$cnt['page']['mov_format']    = pmc_filter_input($_POST['mov_format']);}
    if(isset($_POST['mov_subs']))      {$cnt['page']['mov_subs']      = pmc_filter_input($_POST['mov_subs']);}
    if(isset($_POST['mov_notes']))     {$cnt['page']['mov_notes']     = pmc_filter_input($_POST['mov_notes']);}
    
    /* genres */
    if($tg > 0) {
      for($j=0;$j<$tg;$j++) {
        if(isset($_POST['genres_'.$cnt['page']['genres'][$j]])) {$cnt['page']['genre'][$cnt['page']['genres'][$j]] = 1;}
        else {$cnt['page']['genre'][$cnt['page']['genres'][$j]] = 0;}
      }
    }
    /* //genres */

    if($cnt['page']['cat_id'] != 0 && $cnt['page']['mov_tt'] != '') {
      $lock    = pmc_lock_tables(array('pmc_mov_tt', 'pmc_mov_rel'));
      $id      = pmc_next_auto_id('pmc_mov_tt');
      $mov_pic = '';
      $err = 0;
      if(isset($_FILES['mov_pic'])) {
        $pic_name     = $_FILES['mov_pic']['name'];
        $pic_type     = $_FILES['mov_pic']['type'];
        $pic_tmp_name = $_FILES['mov_pic']['tmp_name'];
        $pic_error    = $_FILES['mov_pic']['error'];
        $pic_size     = $_FILES['mov_pic']['size'];
        $allowed_file_types = array("image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/gif");
        if($pic_error == 0 && !in_array($pic_type, $allowed_file_types)) {$_SESSION['pmc_msg'] = 11; $err = 1;} /* not an image */
        else if ($pic_error == 2)                                        {$_SESSION['pmc_msg'] = 15; $err = 1;} /* too big */
        //else if ($pic_error == 4)                                      {$err = 1;} /* no file uploaded but that's ok */
        else if ($pic_error == 3)                                        {$_SESSION['pmc_msg'] = 13; $err = 1;} /* partial upload */
        else if ($pic_error == 3)                                        {$_SESSION['pmc_msg'] = 13; $err = 1;} /* partial upload */
        if($pic_error == 0 && !is_uploaded_file($pic_tmp_name))          {$_SESSION['pmc_msg'] = 14; $err = 1;} /* not sent by form */
        if($err == 0) {
          $pic_ext  = pmc_pic_ext($pic_type);
          $mov_pic  = 'mov_' . $id . '.' . $pic_ext;
          $pic_path = _APP_DIR . 'var/pic_mov/';
          if (@move_uploaded_file($pic_tmp_name, $pic_path . $mov_pic)) {$pic_store = 1;}
          else {$pic_store = 0;}
        }
      }
      if($pic_store == 0 && $cnt['page']['mov_imdb_pic'] != '') {
        //die($pic_path.$mov_pic.' - '.$_SESSION['pmc_imdb_pics'][$cnt['page']['mov_imdb_pic']]); exit;
        $mov_pic  = 'mov_' . $id . '.' . 'jpg';
        $pic_path = _APP_DIR . 'var/pic_mov/';
        require_once './lib/browseremulator.class.php';
        require_once './lib/imdb.inc.php';
        if (pmc_save_imdb_pics($pic_path.$mov_pic,$_SESSION['pmc_imdb_pics'][$cnt['page']['mov_imdb_pic']])) {$pic_store = 1;}
        else {$pic_store = 0;}
      } /* imdb pic */
      if($err == 0) {
        $idate = date("Y-m-d");
        $itime = date("H:i:s");
        $insert  = pmc_qry_exec("INSERT INTO pmc_mov_tt (cat_id, med_id, mov_cat, mov_pic, mov_imdb, mov_tt_pre, mov_tt, mov_typ, mov_aka, mov_year, mov_country, mov_language, mov_dir, mov_wrt, mov_tag, mov_plot, mov_cast, mov_format, mov_subs, mov_notes, mov_date, mov_time) VALUES ('{$cnt['page']['cat_id']}', '{$cnt['page']['med_id']}', '{$cnt['page']['mov_cat']}', '{$mov_pic}', '{$cnt['page']['mov_imdb']}', '{$cnt['page']['mov_tt_pre']}', '{$cnt['page']['mov_tt']}', '{$cnt['page']['mov_typ']}', '{$cnt['page']['mov_aka']}', '{$cnt['page']['mov_year']}', '{$cnt['page']['mov_country']}', '{$cnt['page']['mov_language']}', '{$cnt['page']['mov_dir']}', '{$cnt['page']['mov_wrt']}', '{$cnt['page']['mov_tag']}', '{$cnt['page']['mov_plot']}', '{$cnt['page']['mov_cast']}', '{$cnt['page']['mov_format']}', '{$cnt['page']['mov_subs']}', '{$cnt['page']['mov_notes']}', '{$idate}', '{$itime}')");
        /* genres */
        if($tg > 0) {
          for($k=0;$k<$tg;$k++) {
            $ver = pmc_qry_total(pmc_qry_exec("SELECT rel_id FROM pmc_mov_rel WHERE mov_id = '{$id}' AND gen_id = '{$cnt['page']['genres'][$k]}' LIMIT 1"));
            if($cnt['page']['genre'][$cnt['page']['genres'][$k]] == 1) {
              if($ver != 1) {
                pmc_qry_exec("INSERT INTO pmc_mov_rel (mov_id, gen_id) VALUES ('{$id}', '{$cnt['page']['genres'][$k]}')");
              }
            }
            else if($cnt['page']['genre'][$cnt['page']['genres'][$k]] == 0) {
              if($ver == 1) {
                pmc_qry_exec("DELETE FROM pmc_mov_rel WHERE mov_id = '{$id}' AND gen_id = '{$cnt['page']['genres'][$k]}' LIMIT 1");
              }
            }
          }
        }
        /* //genres */
        $unlock  = pmc_unlock_tables();
        if($insert === true) {
          if($pic_store == 1) {$_SESSION['pmc_msg'] = 32;}
          else {$_SESSION['pmc_msg'] = 33;}
          $_SESSION['pmc_imdb_pics'] = array();
          header("Location: " . _APP_URL . 'admin/movies/details/' . $id);
          exit;
        }
        else {$_SESSION['pmc_msg'] = 31; header("Location: "._APP_URL . 'admin/movies/add/new'); exit;}
      }
    }
    else {$_SESSION['pmc_msg'] = 16;}
  }
  return $cnt;
}
/**
* Movie view
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_mov_details($id) {
  global $lang;
  $cnt['skin'] = 'admin/movies/a_m-details.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['movie']['movies'] . _APP_SEP . $lang['movie']['details'];
  
  $cnt['page'] = pmc_mov_details($id);
  
  /*
  REMOVED FOR COMPATIBILITY WITH PHP < 5.2
  $egl = error_get_last();
  $res = strpos($egl['message'], 'POST Content-Length of');
  if ($res !== false ) {$_SESSION['pmc_msg'] = 17; header("Location: " . _APP_URL); exit;}
  else if(isset($_POST['mov_imdb_fetch'])) {
  */
  if(isset($_POST['mov_imdb_fetch'])) {
    if(isset($_POST['imdb_url'])) {
      require_once './lib/browseremulator.class.php';
      require_once './lib/imdb.inc.php';
      $imdb_id = pmc_filter_input($_POST['imdb_url']);
      $imdb_id = str_replace('http://www.imdb.com/title/tt', '', $imdb_id);
      $imdb_id = str_replace('/', '', $imdb_id);
      
      $imdb = pmc_get_imdb($imdb_id);
      $cnt['page']['mov_imdb']     = $imdb_id;
      $cnt['page']['mov_tt_pre']   = $imdb['title_the'];
      $cnt['page']['mov_tt']       = $imdb['title'];
      $cnt['page']['mov_typ']      = $imdb['typ'];
      $cnt['page']['mov_aka']      = $imdb['aka'];
      $cnt['page']['mov_year']     = $imdb['year'];
      $cnt['page']['mov_country']  = $imdb['country'];
      $cnt['page']['mov_language'] = $imdb['language'];
      $cnt['page']['mov_dir']      = $imdb['dir'];
      $cnt['page']['mov_wrt']      = $imdb['wrt'];
      $cnt['page']['mov_tag']      = $imdb['tag'];
      $cnt['page']['mov_plot']     = $imdb['plot'];
      $cnt['page']['mov_cast']     = $imdb['cast'];
      $_SESSION['pmc_imdb_pics']   = pmc_get_imdb_pics($imdb['pics_url']);
      $_SESSION['pmc_msg'] = 35;
    }
  }
  else if(isset($_POST['mov_mod'])) {
    if(isset($_POST['cat_id']))       {$cnt['page']['cat_id']       = pmc_filter_input($_POST['cat_id']);}
    if(isset($_POST['med_id']))       {$cnt['page']['med_id']       = pmc_filter_input($_POST['med_id']);}
    if(isset($_POST['mov_cat']))      {$cnt['page']['mov_cat']      = pmc_filter_input($_POST['mov_cat']);}
    if(isset($_POST['mov_imdb']))     {$cnt['page']['mov_imdb']     = pmc_filter_input($_POST['mov_imdb']);}
    if(isset($_POST['mov_tt_pre']))   {$cnt['page']['mov_tt_pre']   = pmc_filter_input($_POST['mov_tt_pre']);}
    if(isset($_POST['mov_tt']))       {$cnt['page']['mov_tt']       = pmc_filter_input($_POST['mov_tt']);}
    if(isset($_POST['mov_typ']))      {$cnt['page']['mov_typ']      = pmc_filter_input($_POST['mov_typ']);}
    if(isset($_POST['mov_aka']))      {$cnt['page']['mov_aka']      = pmc_filter_input($_POST['mov_aka']);}
    if(isset($_POST['mov_year']))     {$cnt['page']['mov_year']     = pmc_filter_input($_POST['mov_year']);}
    if(isset($_POST['mov_country']))  {$cnt['page']['mov_country']  = pmc_filter_input($_POST['mov_country']);}
    if(isset($_POST['mov_language'])) {$cnt['page']['mov_language'] = pmc_filter_input($_POST['mov_language']);}
    if(isset($_POST['mov_dir']))      {$cnt['page']['mov_dir']      = pmc_filter_input($_POST['mov_dir']);}
    if(isset($_POST['mov_wrt']))      {$cnt['page']['mov_wrt']      = pmc_filter_input($_POST['mov_wrt']);}
    if(isset($_POST['mov_tag']))      {$cnt['page']['mov_tag']      = pmc_filter_input($_POST['mov_tag']);}
    if(isset($_POST['mov_plot']))     {$cnt['page']['mov_plot']     = pmc_filter_input($_POST['mov_plot']);}
    if(isset($_POST['mov_cast']))     {$cnt['page']['mov_cast']     = pmc_filter_input($_POST['mov_cast']);}
    if(isset($_POST['mov_imdb_pic']))  {$cnt['page']['mov_imdb_pic']  = pmc_filter_input($_POST['mov_imdb_pic']);}
    if(isset($_POST['mov_format']))   {$cnt['page']['mov_format']   = pmc_filter_input($_POST['mov_format']);}
    if(isset($_POST['mov_subs']))     {$cnt['page']['mov_subs']     = pmc_filter_input($_POST['mov_subs']);}
    if(isset($_POST['mov_notes']))    {$cnt['page']['mov_notes']    = pmc_filter_input($_POST['mov_notes']);}
    
    /* genres */
    if($cnt['page']['tg'] > 0) {
      for($j=0;$j<$cnt['page']['tg'];$j++) {
        if(isset($_POST['genres_'.$cnt['page']['genres'][$j]])) {$cnt['page']['genre'][$cnt['page']['genres'][$j]] = 1;}
        else {$cnt['page']['genre'][$cnt['page']['genres'][$j]] = 0;}
      }
    }
    /* //genres */

    if($cnt['page']['cat_id'] != 0 && $cnt['page']['mov_tt'] != '') {
      $lock    = pmc_lock_tables(array('pmc_mov_tt', 'pmc_mov_rel'));
      //$id      = pmc_next_auto_id('pmc_mov_tt');
      $mov_pic     = $cnt['page']['mov_pic'];
      $new_mov_pic = $cnt['page']['mov_pic'];
      $err = 0;
      $pic_store = 2;
      if(isset($_FILES['mov_pic'])) {
        $pic_name     = $_FILES['mov_pic']['name'];
        $pic_type     = $_FILES['mov_pic']['type'];
        $pic_tmp_name = $_FILES['mov_pic']['tmp_name'];
        $pic_error    = $_FILES['mov_pic']['error'];
        $pic_size     = $_FILES['mov_pic']['size'];
        $allowed_file_types = array("image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/gif");
        if($pic_error == 0 && !in_array($pic_type, $allowed_file_types)) {$_SESSION['pmc_msg'] = 11; $err = 1;} /* not an image */
        else if ($pic_error == 2)                                        {$_SESSION['pmc_msg'] = 15; $err = 1;} /* too big */
        else if ($pic_error == 4)                                        {$err = 2;} /* no file uploaded but that's ok */
        else if ($pic_error == 3)                                        {$_SESSION['pmc_msg'] = 13; $err = 1;} /* partial upload */
        else if ($pic_error == 3)                                        {$_SESSION['pmc_msg'] = 13; $err = 1;} /* partial upload */
        if($pic_error == 0 && !is_uploaded_file($pic_tmp_name))          {$_SESSION['pmc_msg'] = 14; $err = 1;} /* not sent by form */
        if($err == 0) {
          $pic_ext  = pmc_pic_ext($pic_type);
          $new_mov_pic  = 'mov_' . $id . '.' . $pic_ext;
          $pic_path = _APP_DIR . 'var/pic_mov/';
          if(is_file($pic_path.$mov_pic)) {@unlink($pic_path.$mov_pic);}
          if (@move_uploaded_file($pic_tmp_name, $pic_path . $new_mov_pic)) {$pic_store = 1;}
          else {$pic_store = 0;}
        }
      }
      if($pic_store == 0 && $cnt['page']['mov_imdb_pic'] != '') {
        $mov_pic  = 'mov_' . $id . '.' . 'jpg';
        $pic_path = _APP_DIR . 'var/pic_mov/';
        require_once './lib/browseremulator.class.php';
        require_once './lib/imdb.inc.php';
        if (pmc_save_imdb_pics($pic_path.$mov_pic,$_SESSION['pmc_imdb_pics'][$cnt['page']['mov_imdb_pic']])) {$pic_store = 1;}
        else {$pic_store = 0;}
      } /* imdb pic */
      if($err == 0 || $err == 2) {
        //$idate = date("Y-m-d");
        //$itime = date("H:i:s");
        $update = pmc_qry_exec("UPDATE pmc_mov_tt SET cat_id = '{$cnt['page']['cat_id']}', med_id = '{$cnt['page']['med_id']}', mov_cat = '{$cnt['page']['mov_cat']}', mov_pic = '{$new_mov_pic}', mov_imdb = '{$cnt['page']['mov_imdb']}', mov_tt_pre = '{$cnt['page']['mov_tt_pre']}', mov_tt = '{$cnt['page']['mov_tt']}', mov_typ = '{$cnt['page']['mov_typ']}', mov_aka = '{$cnt['page']['mov_aka']}', mov_year= '{$cnt['page']['mov_year']}', mov_country = '{$cnt['page']['mov_country']}', mov_language = '{$cnt['page']['mov_language']}', mov_dir = '{$cnt['page']['mov_dir']}', mov_wrt = '{$cnt['page']['mov_wrt']}', mov_tag = '{$cnt['page']['mov_tag']}', mov_plot = '{$cnt['page']['mov_plot']}', mov_cast = '{$cnt['page']['mov_cast']}', mov_format = '{$cnt['page']['mov_format']}', mov_subs = '{$cnt['page']['mov_subs']}', mov_notes = '{$cnt['page']['mov_notes']}' WHERE mov_id = '{$id}' LIMIT 1");

        /* genres */
        if($cnt['page']['tg'] > 0) {
          for($k=0;$k<$cnt['page']['tg'];$k++) {
            $ver = pmc_qry_total(pmc_qry_exec("SELECT rel_id FROM pmc_mov_rel WHERE mov_id = '{$id}' AND gen_id = '{$cnt['page']['genres'][$k]}' LIMIT 1"));
            if($cnt['page']['genre'][$cnt['page']['genres'][$k]] == 1) {
              if($ver != 1) {
                pmc_qry_exec("INSERT INTO pmc_mov_rel (mov_id, gen_id) VALUES ('{$id}', '{$cnt['page']['genres'][$k]}')");
              }
            }
            else if($cnt['page']['genre'][$cnt['page']['genres'][$k]] == 0) {
              if($ver == 1) {
                pmc_qry_exec("DELETE FROM pmc_mov_rel WHERE mov_id = '{$id}' AND gen_id = '{$cnt['page']['genres'][$k]}' LIMIT 1");
              }
            }
          }
        }
        /* //genres */
        $unlock  = pmc_unlock_tables();
        if($update === true) {
          if($pic_store == 1 || $pic_store == 2) {$_SESSION['pmc_msg'] = 36;}
          else {$_SESSION['pmc_msg'] = 37;}
          $_SESSION['pmc_imdb_pics'] = array();
          header("Location: " . _APP_URL . 'admin/movies/details/' . $id);
          exit;
        }
        else {$_SESSION['pmc_msg'] = 38; header("Location: "._APP_URL . 'admin/movies/details/' . $id); exit;}
      }
    }
    else {$_SESSION['pmc_msg'] = 16;}
  }
  return  $cnt;
}
/**
* Movie list
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_mov_view() {
  global $lang;
  $cnt['skin'] = 'admin/movies/a_m-view.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['movie']['movies'] . _APP_SEP . $lang['movie']['list'];
  $cnt['page'] = pmc_mov_view();
  return $cnt;
}
?>