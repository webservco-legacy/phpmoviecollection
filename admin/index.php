<?php
/**
* ./admin/index.php (redirect to admin area)
*
* <I> .index.php</I>
* <BR>This is just
* <BR>a redirection
* <BR>file
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    23:03 2008-10-12
* @since      18:55 2008-09-24
* @access     public
* @package    pmc
* @subpackage Application
* @todo       stuff
*/

/**
* Allow access to the configuration file
*/
define("_VALID_REQUEST", TRUE);

require_once '../inc/cfg.inc.php';
$admin_location = $ap_cfg['app_url'] . $ap_cfg['app_index'] . 'admin/admin';
header("Location: $admin_location");
?>