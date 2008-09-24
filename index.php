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
* @version    18:53 2008-09-24
* @since      19:27 2008-08-19
* @access     public
* @package    pmc
* @subpackage Application
* @todo       stuff
*/

/**
* Prevent unauthorized access to other files
*/
define("_VALID_REQUEST", TRUE);
/**
* Load app configuration options
*/
if(is_readable('./inc/cfg.inc.php')) {require_once './inc/cfg.inc.php';}
else {header("Location: ./setup/install.php"); exit;}
/**
* Load runtime libraries
*/
if(is_readable('./inc/lib.inc.php')) {require_once './inc/lib.inc.php';}
else {die('ERROR! Files missing. Please re-install the application.');}
/**
* Set app configuration options
*/
pmc_cfg($ap_cfg);
/**
* Set error reporting
*/
pmc_error_reporting(1);
/**
* Search engine friendly URLs
*/
pmc_seo_urls();
/**
* Open database connection
*/
$pmc_dbconn = pmc_dbopen(_DB_HOST, _DB_USER, _DB_PASS, _DB_NAME);
if(!$pmc_dbconn) {header("Location: ./setup/install.php"); exit;}
/**
* Set variable configuration options (stored in database)
*/
pmc_cfg_var();
/**
* Initialize session
*/
$usr_status = pmc_session($pmc_dbconn);
/**
* Load language file with main dialogs
*/
require_once _APP_DIR . 'lang/' . $_SESSION['pmc_usr_lang'] . '/lang.inc.php';
/**
* Load language file with messages
*/
require_once _APP_DIR . 'lang/' . $_SESSION['pmc_usr_lang'] . '/msg.inc.php';
/**
* Load application functions
*/
require_once './inc/func.inc.php';
/**
* Manage user list
*/
if(isset($_POST['pmc_cart_act'])) {pmc_usr_list($_POST['pmc_cart_act']);}
/**
* Logout user
*/
if(isset($_GET['logout']) && $_GET['logout'] == 'true') {pmc_usr_logout();}
/**
* Process requests
*/
$cnt = pmc_process();
/**
* Load additional content modules
*/
$mod = pmc_mod_add();
/**
* Display page
*/
echo pmc_output($cnt, $mod);
/**
* Close database connection
*/
pmc_dbclose($pmc_dbconn);
?>