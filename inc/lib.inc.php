<?php
/**
* ./inc/lib.inc.php (core functions and classes)
*
* <I> ./inc/lib.inc.php</I>
* <BR>This is the main functions file
* <BR>It contains all the core functions
* <BR>used in the application
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    14:37 2008-08-22
* @since      19:27 2008-08-19
* @access     public
* @package    phpMyMovieCollection
* @subpackage Core
* @todo       Everything :-)
*/

/**
* Only authorized access permitted
*/
if(!defined('_VALID_REQUEST')) {show404();}

/**
* Skin handling class
*
* My first class ever!
*
* @version    12:58 2008-08-22
* @since      19:27 2008-08-19
* @access     public
* @package    phpMyMovieCollection
* @subpackage Core
*/
class skin {
  /**
  * Skin directory
  *
  * @var string
  */
  var $skindir;
  /**
  * Skin variables
  *
  * @var mixed
  */
  var $skinvars;
  /**
	* This is what they call a constructor
	*
	* @param string $skindir the path to the skin directory
	*
	* @return void
	*/
  function skin($skindir = null) {
    $this->skindir = $skindir;
    $this->skinvars = array();
	}
  /**
	* Sets a skin variable
	*
	* @param string $name the name of the variable
	* @param mixed $value the value of the variable
	*
	* @return void
	*/
  function set($name, $value) {
    $this->skinvars[$name] = $value;
	}
  /**
	* Do the magic to the skin file
	* 
	* It returns the processed skin
	*
	* @param string $skinfile the file name of the skin
	*
	* @return string
	*/
  function parse($skinfile) {
    extract($this->skinvars);
    ob_start();
    include($this->skindir . $skinfile);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }
}
/**
* Custom error page
*
* Increase app security by not displaying too much information on bad requests
*/
function show404() {
  header('HTTP/1.1 404 Not Found');
  $skindir = './skin/pmmc/';
  $skin = & new Skin($skindir);
  $skin->set('title', '404 Not Found');
  $content = & new Skin($skindir);
  $content->set('msg404', '<h1>404 Not Found</h1>' . "\n\t" . 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found on this server.');
  $skin->set('content', $content->parse('404.tpl.php'));
  echo $skin->parse('layout.tpl.php');
  exit;
}
/**
* Display nice mysql error messages
*
* @param mixed $errno error number (mysql_errno)
* @param mixed $error error message (mysql_error)
*/
function my_err($errno, $error) {
  //header('HTTP/1.1 404 Not Found');
  $skindir = './skin/pmmc/';
  $skin = & new Skin($skindir);
  $skin->set('title', 'MySQL Error'); 
  $content = & new Skin($skindir);
  $content->set('msg404', '<h1>MySQL Error</h1>' . "\n\t" . $errno . ' : ' . $error . '.<br />');
  $skin->set('content', $content->parse('404.tpl.php'));
  echo $skin->parse('layout.tpl.php');
  exit;
}
/**
* Error reporting function
*
* Sets the error reporting (useful for debugging purposes
*
* @param integer $level Error level to report
* @return mixed
*/
function pmmc_error_reporting($level=0) {
  switch($level) {
    case 0 : {return error_reporting(E_ALL ^ E_NOTICE); break;}
    case 1 : {return error_reporting(E_ALL); break;}
    default : {return error_reporting(E_ALL); break;}
  }
}
/**
* Create Search Engine friendly URLs
*
* before: index.php?id=2&page=3
* after: index.php/id/2/page/3
* inspiration from code snippets in the php manual
*/
function pmmc_seo_urls() {
  // we will not be taking orders from normal style requests!
  // ignore ?id=2&page=3
  // we didn't do our stuff yet, so if GET exists it means it has values from normal style requests
  if(!empty($_GET)) {$_GET = array();}
  // if the request is in the form id/2/page/3 put them in the GET array
  if (isset($_SERVER['PATH_INFO'])) {
    // split the request by /
    $raw_data = explode('/', $_SERVER['PATH_INFO']);
    // get rid of empty values
    $raw_data = array_diff($raw_data, array(''));
    // how many values we have
    $total_data = count($raw_data);
    // if total number of vaues divides by 2, then we have pairs (name-value) so we can start to do our stufsf
    if (is_int($total_data / 2)) {
      for($i=1;$i<=count($raw_data);$i+=2) {
        $_GET[$raw_data[$i]] = $raw_data[$i+1];
      }
    }
    // if total number of values doesn't divide by 2, the request is invalid so we redirect to index
    else {
      $site_root = _APP_URL;
      header("Location: $site_root");
    }
  }
}
/**
* Initialize app configuration
*
* @pram array The configuration directives from ./inc/cfg.inc.php
* @return void
*/
function pmmc_cfg($ap_cfg) {
  /**
  * Whether to use rewrite engine functionality or not
  */
  define('_APP_INDEX',$ap_cfg['app_index']);
  /**
  * Full URL of the application
  */
  define('_APP_URL',$ap_cfg['app_url'] . _APP_INDEX);
  /**
  * Database host
  */
  define('_DB_HOST',$ap_cfg['db_host']);
  /**
  * Database user
  */
  define('_DB_USER',$ap_cfg['db_user']);
  /**
  * Database password
  */
  define('_DB_PASS',$ap_cfg['db_pass']);
  /**
  * Database name
  */
  define('_DB_NAME',$ap_cfg['db_name']);
}
/**
* Open a database connection
*
* @pram string Database host
* @pram string Database user
* @pram string Database password
* @pram string Database name
* @pram string Database port defaults to 3306 (MySQL)
* @pram integer Database type defaults to 0 (MySQL)
* @return mixed Connection link
*/
function pmmc_dbopen($db_host, $db_user, $db_pass, $db_name, $db_port='', $db_type=0) {
  $pmmc_dbconn = NULL;
  switch($db_type) {
    case 0 : {
      /**
      * Create connection
      */
      $pmmc_dbconn = @mysql_connect($db_host . ":" . $db_port , $db_user, $db_pass) or my_err(mysql_errno(), mysql_error());
      /**
      * Select database
      */
      mysql_select_db($db_name) or my_err(mysql_errno(), mysql_error());
      /**
      * Enable UTF-8 support
      */
      pmmc_qry_exec("SET NAMES 'utf8'");
      break;
    }
  }
  return $pmmc_dbconn;
}
/**
* Close a database connection
*
* @pram mixed Connection link
* @pram integer Database type defaults to 0 (MySQL)
* @return mixed
*/
function pmmc_dbclose($pmmc_dbconn, $db_type=0) {
  switch($db_type) {
    case 0 : {mysql_close($pmmc_dbconn); break;}
  }
}
/**
* Execute a query
*
* @pram mixed Query to execute
* @pram integer Database type defaults to 0 (MySQL)
* @return mixed
*/
function pmmc_qry_exec($query, $db_type=0) {
  $result = NULL;
  switch($db_type) {
    case 0 : {$result = mysql_query($query) or my_err(mysql_errno(), mysql_error()); break;}
  }
  return $result;
}
/**
* Return an associative array with the results of a query
*
* @pram mixed result of a query
* @pram integer Database type defaults to 0 (MySQL)
* @return mixed
*/
function pmmc_qry_row($result, $db_type=0) {
  $row = NULL;
  switch($db_type) {
    case 0 : {
      $row = mysql_fetch_assoc($result);
      break;
    }
  }
  return $row;
}
/**
* Return the value resulted from a query
*
* @pram mixed result of a query
* @pram integer Row to return defaults to 0 (first row)
* @pram integer Database type defaults to 0 (MySQL)
* @return mixed
*/
function pmmc_qry_result($result, $row=0, $db_type=0) {
  $res = NULL;
  switch($db_type) {
    case 0 : {
      $res = mysql_result($result, $row);
      break;
    }
  }
  return $res;
}
/**
* Return the number of rows resulted from a query
*
* @pram mixed result of a query
* @pram integer Database type defaults to 0 (MySQL)
* @return mixed
*/
function pmmc_qry_total($result, $db_type=0) {
  $total = NULL;
  switch($db_type) {
    case 0 : {$total = mysql_num_rows($result); break;}
  }
  return $total;
}
/**
* Number of rows affected by a query
*
* @pram mixed result of a query (needed for PostgreSQL)
* @pram integer Database type defaults to 0 (MySQL)
* @return mixed
*/
function pmmc_qry_aff($result, $db_type=0) {
  $aff = NULL;
  switch($db_type) {
    // MySQL: INSERT, UPDATE, REPLACE, DELETE
    case 0 : {$aff = mysql_affected_rows(); break;}
  }
  return $aff;
}
/**
* Get user settings from database
*
* @return mixed
*/
function pmmc_cfg_usr() {
  $r = pmmc_qry_exec("SELECT cfg_set, cfg_val FROM pmmc_set_cfg");
  $t = pmmc_qry_total($r);
  for($i=1; $i<=$t; $i++) {
    $rw = pmmc_qry_row($r);
    /**
    * Define settings
    */
    define('_APP_'.$rw['cfg_set'], strval($rw['cfg_val']));
  }
}
/**
* Initialize the user session
*
* @return mixed
*/
function pmmc_session() {
  session_cache_limiter('public, must-revalidate');
  session_cache_expire(600); // minutes (10 hours);
  ini_set("session.gc_maxlifetime","36000"); //seconds (1 hours)
  session_start();
  header("ETag: PUB" . time());
  header("Last-Modified: " . gmdate("D, d M Y H:i:s", time()-10) . " GMT");
  header("Expires: " . gmdate("D, d M Y H:i:s", time() + 5) . " GMT");
  header("Pragma: no-cache");
  header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");
  header('HTTP/1.1 200 OK');
  /**
  * First load of the page
  */
  if (!isset($_SESSION['pmmc_token'])) {
    /**
    * Unique token for security
    */
    $_SESSION['pmmc_token'] = md5(uniqid(rand(), TRUE));
    /**
    * Visit date
    */
    $_SESSION['pmmc_vdate'] = date("Y-m-d");
    /**
    * Visit time
    */
    $_SESSION['pmmc_vtime'] = date("H:i:s");
    /**
    * User id
    */
    $_SESSION['pmmc_usr_id']    = '0';
    /**
    * User access level
    */
    $_SESSION['pmmc_usr_level'] = '0';
    /**
    * User alias
    */
    $_SESSION['pmmc_usr_alias'] = 'Guest';
    /**
    * User full name
    */
    $_SESSION['pmmc_usr_name']  = 'Anonymous';
  }
}
?>