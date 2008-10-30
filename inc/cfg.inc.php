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
* @version    10:01 2008-10-30
* @since      10:01 2008-10-30
* @access     public
* @package    pmc
* @subpackage Configuration
* @todo       stuff
*/

/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../lib/404.php';}
/**
* Main URL of the application - notice the slash at the end
*/
$ap_cfg['app_url'] = 'http://www.example.com/';
/**
* Full path to the application - notice the slash at the end
*/
$ap_cfg['app_dir'] = '/home/public_html/';
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
$ap_cfg['db_user'] = 'database_user';
/**
* Database password
*/
$ap_cfg['db_pass'] = 'database_password';
/**
* Database name
*/
$ap_cfg['db_name'] = 'database_name';
/**
* Control the loading of the menu module
*/
$ap_cfg['mod']['mod_mnu'] = 1;
/**
* Control the loading of the user module
*/
$ap_cfg['mod']['mod_usr'] = 1;
/**
* Control the loading of the user login module
*/
$ap_cfg['mod']['mod_login'] = 1;
/**
* Control the loading of the genres module
*/
$ap_cfg['mod']['mod_gen'] = 1;
/**
* Control the loading of the search module
*/
$ap_cfg['mod']['mod_src'] = 1;
/**
* Control the loading of the imdb search module
*/
$ap_cfg['mod']['mod_imdb'] = 1;
/**
* Control the loading of the user list module
*/
$ap_cfg['mod']['mod_lst'] = 1;
/**
* Control the loading of the stats module
*/
$ap_cfg['mod']['mod_sts'] = 1;
/**
* Control the loading of the application title module
*/
$ap_cfg['mod']['mod_apptt'] = 1;
/**
* Control the loading of the quick administration module
*/
$ap_cfg['mod']['mod_adm'] = 1;
?>
