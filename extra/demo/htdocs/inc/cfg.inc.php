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
* @version    06:20 2008-11-19
* @since      06:20 2008-11-19
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
$ap_cfg['app_url'] = 'http://rudisoft.jumponthe.net/pmc/demo/';
/**
* Full path to the application - notice the slash at the end
*/
$ap_cfg['app_dir'] = '/home/rudisoft/public_html/pmc/demo/';
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
$ap_cfg['db_user'] = 'rudisoft_pmcusr';
/**
* Database password
*/
$ap_cfg['db_pass'] = 'REDACTED';
/**
* Database name
*/
$ap_cfg['db_name'] = 'rudisoft_pmc';
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
