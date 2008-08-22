<?php
/**
* ./inc/cfg.inc.php (app configuration options)
*
* <I> ./inc/cfg.inc.php</I>
* <BR>This file stores the application
* <BR>runtime configuration
* <BR>options
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    12:26 2008-08-22
* @since      19:27 2008-08-19
* @access     public
* @package    phpMyMovieCollection
* @subpackage Application
* @todo       Everything :-)
*/

/**
* Only authorized access permitted
*/
if(!defined('_VALID_REQUEST')) {header("Location: index.php");}
/**
* Main URL of the application - notice the slash at the end
*/
$ap_cfg['app_url'] = 'http://localhost/pub/temp/phpMyMovieCollection/';
/**
* Whether to use rewrite engine functionality or not
*/
$ap_cfg['app_index'] = '';
/**
* Database host
*/
$ap_cfg['db_host'] = 'localhost';
/**
* Database user
*/
$ap_cfg['db_user'] = 'temp';
/**
* Database password
*/
$ap_cfg['db_pass'] = 'REDACTED';
/**
* Database name
*/
$ap_cfg['db_name'] = 'temp';
?>