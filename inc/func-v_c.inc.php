<?php
/**
* ./inc/func-v_c.inc.php (view categ functions)
*
* <I> ./inc/func-v_c.inc.php</I>
* <BR>This is the view categ functions file
* <BR>It contains all the functions
* <BR>used in the front side
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    18:39 2008-09-03
* @since      18:39 2008-09-03
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
* View a category
*
* @param integer category id
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_categ_details($id) {
  global $lang;
  $cnt['skin'] = 'view/categ/v_c-details.tpl.php';
  $cnt['tt']   = $lang['view']['view'] . _APP_SEP . $lang['categ']['categs'] . _APP_SEP . $lang['categ']['view'];
  $cnt['page'] = pmc_categ_details($id);
  return $cnt;
}
/**
* View all categories
*
* @return array $cnt content to be displayed to the user
*/
function pmc_view_categ_view() {
  $cnt = NULL;
  global $lang;
  $cnt['skin'] = 'view/categ/v_c-view.tpl.php';
  $cnt['tt'] = $lang['view']['view'] . _APP_SEP . $lang['categ']['categs'] . _APP_SEP . $lang['categ']['viewall'];
  $cnt['page'] = array();
  $cnt['page']['cat_id'] = array();
  $cnt['page'] = pmc_categ_view();
  return $cnt;
}
?>