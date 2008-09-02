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
* @version    00:38 2008-08-29
* @since      19:27 2008-08-19
* @access     public
* @package    phpMyMovieCollection
* @subpackage Application
* @todo       Everything :-)
*/

/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../lib/404.php';}
/**
* Main URL of the application - notice the slash at the end
*/
$ap_cfg['app_url'] = 'http://localhost/pub/temp/phpMyMovieCollection/';
/**
* Whether to use rewrite engine functionality or not
*/
$ap_cfg['app_index'] = '';
/**
* Full path to the application - notice the slash at the end
*/
//$ap_cfg['app_dir'] = '/opt/lampp/htdocs/pub/temp/phpMyMovieCollection/';
$ap_cfg['app_dir'] = 'd:/home/devel/server/htdocs/pub/temp/phpMyMovieCollection/';
//$ap_cfg['app_dir'] = 'e:/home/devel/server/htdocs/pub/temp/phpMyMovieCollection/';
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
/**
* Control the loading of the user module
*/
$ap_cfg['mod']['mod_usr'] = 1;
/**
* Control the loading of the test module
*/
$ap_cfg['mod']['tester'] = 0;
?>