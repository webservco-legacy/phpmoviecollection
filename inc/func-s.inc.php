<?php
/**
* ./inc/func-s.inc.php (search functions)
*
* <I> ./inc/func-s.inc.php</I>
* <BR>This is the search functions file
* <BR>It contains all the functions
* <BR>used in the front side
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    20:42 2008-09-07
* @since      18:55 2008-09-07
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
* Advanced search
*
* This acts exactly like an optional module but it isn't
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_search_advanced() {
  global $lang;
  $cnt['skin'] = 'view/search/v_s.tpl.php';
  $cnt['tt'] = $lang['search']['search'] . _APP_SEP . $lang['search']['advanced'];
  $cnt['page']['tt'] = Null;
  return  $cnt;
}
/**
* Movie list
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_search_results() {
  global $lang;
  $cnt['skin'] = 'view/search/v_s-results.tpl.php';
  $cnt['tt'] = $lang['search']['search'] . _APP_SEP . $lang['search']['results'];
  $cnt['page'] = pmc_mov_view('view');
  return $cnt;
}
?>