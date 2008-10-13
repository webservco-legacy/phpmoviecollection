<?php
/**
* ./inc/func-a_md.inc.php (admin media functions)
*
* <I> ./inc/func-a_md.inc.php</I>
* <BR>This is the admin media functions file
* <BR>It contains all the functions
* <BR>used in the admin side
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    18:15 2008-10-13
* @since      17:00 2008-09-14
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
* Add new media
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_media_add() {
  global $lang;
  $cnt['skin'] = 'admin/media/a_md-new.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['media']['media'] . _APP_SEP . $lang['media']['add'];
  
  if(isset($_POST['med_add'])) {
    if(isset($_POST['med_cat']))   {$cnt['page']['med_cat']   = pmc_filter_input($_POST['med_cat']);}
    if(isset($_POST['med_tt']))   {$cnt['page']['med_tt']   = pmc_filter_input($_POST['med_tt']);}
    if(isset($_POST['med_typ']))   {$cnt['page']['med_typ']   = pmc_filter_input($_POST['med_typ']);}
    $err = 0;
    if($cnt['page']['med_cat'] == '')      {$err = 1;}
    else if($cnt['page']['med_tt'] == '')  {$err = 1;}
    else if($cnt['page']['med_typ'] == '') {$err = 1;}
    if($err == 0) {
      $lock   = pmc_lock_tables(array('pmc_mov_med'));
      $insert = pmc_qry_exec("INSERT INTO pmc_mov_med (med_cat, med_tt, med_typ) VALUES ('{$cnt['page']['med_cat']}', '{$cnt['page']['med_tt']}', '{$cnt['page']['med_typ']}')");
      $unlock = pmc_unlock_tables();
      if($insert === true) {
          $_SESSION['pmc_msg'] = 61;
          header("Location: " . _APP_URL . 'admin/media');
          exit;
      }
      else {$_SESSION['pmc_msg'] = 62; header("Location: "._APP_URL . 'admin/media/add/new'); exit;}
    }
    else {$_SESSION['pmc_msg'] = 16;}
  }
  else {
    $cnt['page']['med_cat'] = pmc_next_auto_id('pmc_mov_med');;
    $cnt['page']['med_tt']  = '';
    $cnt['page']['med_typ'] = 3;
  }
  return $cnt;
}
/**
* Media - view all
*
* @return array $cnt content to be displayed to the user
*/
function pmc_adm_media_view() {
  global $lang;
  $cnt['skin'] = 'admin/media/a_md-view.tpl.php';
  $cnt['tt'] = $lang['adm']['adm'] . _APP_SEP . $lang['media']['media'];
  
  $page = 1;
  if(isset($_GET['page']) && pmc_is_int($_GET['page'])) {$page = $_GET['page'];}
  $items = _APP_IMED;
  $offset = ($page - 1) * $items;
  $q_limit = " LIMIT ".$offset.", ".$items."";
  
  $r = pmc_qry_exec("SELECT SQL_CALC_FOUND_ROWS M.med_id, M.med_cat, M.med_tt, M.med_typ, COUNT(DISTINCT(MV.mov_id)) as med_items FROM pmc_mov_med AS M LEFT JOIN pmc_mov_tt AS MV ON (M.med_id = MV.med_id) GROUP BY M.med_cat {$q_limit}");
  $t = pmc_qry_total($r);
  if($t > 0) {
    for($i=0;$i<$t;$i++) {
      $rw[$i] = pmc_qry_row($r);
      if(isset($_POST['med_save_mod']) && $_SESSION['pmc_usr_level'] >= 4) {
        $lock = pmc_lock_tables(array('pmc_mov_med'));
        if(isset($_POST['med_del-'.$rw[$i]['med_id']])) {
          $delete = pmc_qry_exec("DELETE FROM pmc_mov_med WHERE med_id = '{$rw[$i]['med_id']}' LIMIT 1");
          if($delete === true) {$_SESSION['pmc_msg'] = 64;}
        }
        else {
          $med_cat[$rw[$i]['med_id']] = $rw[$i]['med_cat'];
          $med_tt[$rw[$i]['med_id']]  = $rw[$i]['med_tt'];
          $med_typ[$rw[$i]['med_id']] = $rw[$i]['med_typ'];
          if(isset($_POST['med_cat-'.$rw[$i]['med_id']])) {$med_cat[$rw[$i]['med_id']] = pmc_filter_input($_POST['med_cat-'.$rw[$i]['med_id']]);}
          if(isset($_POST['med_tt-'.$rw[$i]['med_id']]))  {$med_tt[$rw[$i]['med_id']]  = pmc_filter_input($_POST['med_tt-'.$rw[$i]['med_id']]);}
          if(isset($_POST['med_typ-'.$rw[$i]['med_id']])) {$med_typ[$rw[$i]['med_id']] = pmc_filter_input($_POST['med_typ-'.$rw[$i]['med_id']]);}
          if($med_cat[$rw[$i]['med_id']] != '' && ($med_tt[$rw[$i]['med_id']] != '' && $med_typ[$rw[$i]['med_id']] != '')) {
            $update = pmc_qry_exec("UPDATE pmc_mov_med SET med_cat = '{$med_cat[$rw[$i]['med_id']]}', med_tt = '{$med_tt[$rw[$i]['med_id']]}', med_typ = '{$med_typ[$rw[$i]['med_id']]}' WHERE med_id = '{$rw[$i]['med_id']}' LIMIT 1");
            if($update === true) {$_SESSION['pmc_msg'] = 63;}
          }
          else {$_SESSION['pmc_msg'] = 16;}
        }
        $unlock = pmc_unlock_tables();
      }
    }
    if(isset($_POST['med_save_mod']) && $_SESSION['pmc_usr_level'] >= 4) {header("Location: " . _APP_URL . 'admin/media'); exit;}
  }
  else {$rw = array();}
  $cnt['page']['total']    = pmc_qry_result(pmc_qry_exec("SELECT FOUND_ROWS() as totalitems"));
  $cnt['page']['page']     = $page;
  $cnt['page']['maxpage']  = ceil($cnt['page']['total']/$items);
  $cnt['page']['prevpage'] = $page - 1;
  $cnt['page']['nextpage'] = $page + 1;
  
  $cnt['page']['link_first'] = '&#60;&#60;';
  $cnt['page']['link_prev']  = '&#60;';
  if($cnt['page']['page'] > 1) {
    $cnt['page']['link_first'] = '<a href="'._APP_URL.'admin/media/page/1">'.$cnt['page']['link_first'].'</a>';
    $cnt['page']['link_prev']  = '<a href="'._APP_URL.'admin/media/page/'.$cnt['page']['prevpage'].'">'.$cnt['page']['link_prev'].'</a>';
  }
  $cnt['page']['link_next']  = '&#62;';
  $cnt['page']['link_last']  = '&#62;&#62;';
  if($cnt['page']['page'] < $cnt['page']['maxpage']) {
    $cnt['page']['link_next']  = '<a href="'._APP_URL.'admin/media/page/'.$cnt['page']['nextpage'].'">'.$cnt['page']['link_next'].'</a>';
    $cnt['page']['link_last']  = '<a href="'._APP_URL.'admin/media/page/'.$cnt['page']['maxpage'].'">'.$cnt['page']['link_last'].'</a>';
  }
  $cnt['page']['meds'] = $rw;
  
  if($cnt['page']['total'] == 0) {$_SESSION['pmc_msg'] = 65;}
  else if($_SESSION['pmc_msg'] != 63 || $_SESSION['pmc_msg'] != 64) {$_SESSION['pmc_msg'] = 0;}
  return $cnt;
}
?>