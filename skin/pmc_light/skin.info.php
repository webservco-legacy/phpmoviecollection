<?php
/**
* ./skin/pmc/skin.info.php (pmc skin file)
*
* <I> .skin.info.php</I>
* <BR>This is the info file
* <BR>for the pmc
* <BR>skin
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    00:17 2008-11-02
* @since      19:41 2008-09-08
* @access     public
* @package    pmc
* @subpackage Skins
* @todo       stuff
*/

/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../../lib/404.php';}
/**
* Skin info
*/
$skin_info['sk_name']  = 'P.M.C. Light';
$skin_info['sk_desc']  = 'Default skin (light version)';
$skin_info['sk_auth']  = 'Radu Maier';
$skin_info['sk_mail']  = 'rudisoft@rudisoft.net';
$skin_info['sk_url']   = 'http://pmc.rudisoft.net';
$skin_info['sk_ver']   = '1.1.1-081102';
?>