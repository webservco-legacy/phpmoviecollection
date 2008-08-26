<?php
/**
* ./index.php (all the magic gets done here)
*
* <I> .index.php</I>
* <BR>This is the main file
* <BR>It processes all the requests
* <BR>transparently
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    14:19 2008-08-25
* @since      19:27 2008-08-19
* @access     public
* @package    phpMyMovieCollection
* @subpackage Application
* @todo       Everything :-)
*/

/**
* Prevent unauthorized access to other files
*/
define("_VALID_REQUEST", TRUE);
/**
* Load app configuration options
*/
require_once './inc/cfg.inc.php';
/**
* Load runtime libraries
*/
require_once './inc/lib.inc.php';
/**
* Set app configuration options
*/
pmmc_cfg($ap_cfg);
/**
* Set error reporting
*/
pmmc_error_reporting(1);
/**
* Search engine friendly URLs
*/
pmmc_seo_urls();
/**
* Open database connection
*/
$pmmc_dbconn = pmmc_dbopen(_DB_HOST, _DB_USER, _DB_PASS, _DB_NAME);
/**
* Set user configuration options
*/
pmmc_cfg_usr();
/**
* Initialize session
*/
$usr_status = pmmc_session();
/**
* Load language file with main dialogs
*/
require_once _APP_DIR . 'lang/' . $_SESSION['pmmc_usr_lang'] . '/lang.inc.php';
/**
* Load language file with messages
*/
require_once _APP_DIR . 'lang/' . $_SESSION['pmmc_usr_lang'] . '/msg.inc.php';
/**
* Load application functions
*/
require_once './inc/func.inc.php';
/**
* Logout user
*/
if(isset($_GET['logout']) && $_GET['logout'] == 'true') {pmmc_usr_logout();}
/**
* Admin request processing
*/
else if(isset($_GET['admin'])) {$cnt = pmmc_admin();}
/**
* User request processing
*/
else if(isset($_GET['view'])) {$cnt = pmmc_view();}
/**
* Else no request has been made, show something
*/
else {
  $cnt['skin'] = 'tester.tpl.php';
  $cnt['tt'] = 'Tester';
  $cnt['page'] = 'Hello World!';
}
/**
* Additional modules
*/
$mod = pmmc_mod_add();
/**
* Display page
*/
echo pmmc_output($cnt, $mod);
/**
* Close database connection
*/
pmmc_dbclose($pmmc_dbconn, $db_type=0)
?>