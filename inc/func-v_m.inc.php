<?php
/**
* ./inc/func-v_m.inc.php (view movie functions)
*
* <I> ./inc/func-v_m.inc.php</I>
* <BR>This is the view movie functions file
* <BR>It contains all the functions
* <BR>used in the front side
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    20:14 2008-09-17
* @since      19:32 2008-09-03
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
* Movie view
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_mov_details($id) {
  global $lang;
  $cnt['skin'] = 'view/movies/v_m-details.tpl.php';
  $cnt['tt'] = $lang['view']['view'] . _APP_SEP . $lang['movie']['movies'] . _APP_SEP . $lang['movie']['details'];
  
  $cnt['page'] = pmc_mov_details($id);
  return  $cnt;
}
/**
* Movie list
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_mov_view() {
  global $lang;
  $cnt['skin'] = 'view/movies/v_m-view.tpl.php';
  $cnt['tt'] = $lang['view']['view'] . _APP_SEP . $lang['movie']['movies'] . _APP_SEP . $lang['movie']['list'];
  $cnt['page'] = pmc_mov_view('view');
  return $cnt;
}
?>