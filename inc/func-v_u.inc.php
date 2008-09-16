<?php
/**
* ./inc/func-v_u.inc.php (view users functions)
*
* <I> ./inc/func-v_u.inc.php</I>
* <BR>This is the view users functions file
* <BR>It contains all the functions
* <BR>used in the view side
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    01:32 2008-09-14
* @since      11:01 2008-09-07
* @access     public
* @package    pmc
* @subpackage Application Front
* @todo       stuff
*/

/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../lib/404.php';}
/**
* View user
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_usr_details($id) {
  global $lang;

  $cnt['skin'] = 'view/users/v_u-details.tpl.php';
  
  $cnt['tt'] = $lang['view']['view'] . _APP_SEP . $lang['usr']['usrs'] . _APP_SEP . $lang['usr']['view'];
  
  $cnt['page']['langs'] = pmc_lsdir(_APP_DIR.'lang/');
  $cnt['page']['skins'] = pmc_lsdir(_APP_DIR.'skin/');
    
  $result = pmc_qry_exec("SELECT * FROM pmc_set_usr WHERE usr_id = '{$id}'");
  $total = pmc_qry_total($result);
  if($total == 1) {
    $row = pmc_qry_row($result);
    $cnt['page']['usr_name']   = $row['usr_name'];
    $cnt['page']['usr_fname']  = $row['usr_fname'];
    $cnt['page']['usr_lname']  = $row['usr_lname'];
    $cnt['page']['usr_mail']   = $row['usr_mail'];
    $cnt['page']['usr_pass1']  = '';
    $cnt['page']['usr_pass2']  = '';
    $cnt['page']['usr_skin']   = $row['usr_skin'];
    $cnt['page']['usr_lang']   = $row['usr_lang'];
    $cnt['page']['usr_level']  = $row['usr_level'];
    $cnt['page']['usr_status'] = $row['usr_status'];
  }

  return $cnt;
}
/**
* Users - view all
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_usr_view() {
  global $lang;
  $cnt['skin'] = 'view/users/v_u-view.tpl.php';
  $cnt['tt'] = $lang['view']['view'] . _APP_SEP . $lang['usr']['usrs'] . _APP_SEP . $lang['usr']['viewall'];
  $cnt['page'] = pmc_usr_view();
  return $cnt;
}
?>