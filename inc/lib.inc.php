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
* @version    00:18 2008-11-02
* @since      19:27 2008-08-19
* @access     public
* @package    pmc
* @subpackage Core
* @todo       stuff
*/

/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../lib/404.php';}
/**
* Skin handling class
*
* My first class ever!
*
* @version    12:58 2008-08-22
* @since      19:27 2008-08-19
* @access     public
* @package    pmc
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
* Output data to user
*
* @return mixed page to diplay
*/
function pmc_output($cnt, $mod=null) {
  global $lang, $usr_status;
  /**
  * Initialize
  */
  $skin = new Skin($_SESSION['pmc_usr_skin']);
  /**
  * Title
  */
  $skin->set('title',$cnt['tt']);
  /**
  * Message
  */
  $msg = new Skin($_SESSION['pmc_usr_skin']);
  $msg->set('lang', $lang);
  //$msg->set('msg', $cnt['msg']);
  $skin->set('msg', $msg->parse('msg.tpl.php'));
  /**
  * Page
  */
  $page = new Skin($_SESSION['pmc_usr_skin']);
  //$page->set('h1', $cnt['tt']);
  $page->set('lang', $lang);
  $page->set('cnt', $cnt['page']);
  $skin->set('page', $page->parse($cnt['skin']));
  /**
  * Additional modules
  */
  if(is_array($mod) && count($mod) >= 1) {
    $tm = count($mod);
    for($i=0;$i<$tm;$i++) {
      $opt_mod[$i] = new Skin($_SESSION['pmc_usr_skin']);
      $opt_mod[$i]->set('lang', $lang);
      if($mod[$i]['name'] == 'mod_login') {$opt_mod[$i]->set('usr_status', $usr_status);}
      $skin->set($mod[$i]['name'], $opt_mod[$i]->parse('mod/'.$mod[$i]['file'].'.tpl.php'));
    }
  }
  /**
  * Display
  */
  return $skin->parse('layout.tpl.php');
}
/**
* Display nice mysql error messages
*
* @param mixed $errno error number (mysql_errno)
* @param mixed $error error message (mysql_error)
*/
function my_err($errno, $error) {
  return false;
}
/**
* Error reporting function
*
* Sets the error reporting (useful for debugging purposes
*
* @param integer $level Error level to report
* @return mixed
*/
function pmc_error_reporting($level=0) {
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
function pmc_seo_urls() {
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
      if(isset($_SERVER['REDIRECT_QUERY_STRING'])) {
        $new_qs = trim($_SERVER['REDIRECT_QUERY_STRING']);
        $new_qs = str_replace('&', '/', $new_qs);
        $new_qs = str_replace('=', '/', $new_qs);
        $request_uri = str_replace('?'.$_SERVER['REDIRECT_QUERY_STRING'], '/'.$new_qs, $_SERVER['REQUEST_URI']);
        if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] != '') {$server = $_SERVER['HTTP_HOST'];}
        else if(isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] != '') {$server = $_SERVER['SERVER_NAME'];}
        $location = 'http://' . $server . $request_uri;
        header("Location: " . $location);
      }
    }
    // if total number of values doesn't divide by 2, the request is invalid so we redirect to index
    else {
      header("Location: " . _APP_URL);
    }
  }
}
/**
* Initialize app configuration
*
* @param array The configuration directives from ./inc/cfg.inc.php
* @return void
*/
function pmc_cfg($ap_cfg) {
  /**
  * Whether to use rewrite engine functionality or not
  */
  define('_APP_INDEX',$ap_cfg['app_index']);
  /**
  * Full URL of the application
  */
  define('_APP_URL',$ap_cfg['app_url'] . _APP_INDEX);
  define('_APP_WWW',$ap_cfg['app_url']);
  /**
  * Full path to the application
  */
  define('_APP_DIR',$ap_cfg['app_dir']);
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
  /**
  * Separator for titles etc
  */
  define('_APP_SEP',' &#187; ');
  /**
  * Application name
  */
  define('_APP_NAME','phpMovieCollection');
  /**
  * Application version
  */
  define('_APP_VER','1.1.1-081102');
  /**
  * Application author
  */
  define('_APP_AUTH','Radu Maier');
  /**
  * Application copyright
  */
  define('_APP_CPY','&copy; 2008 '._APP_AUTH);
}
/**
* Open a database connection
*
* @param string Database host
* @param string Database user
* @param string Database password
* @param string Database name
* @param string Database port defaults to 3306 (MySQL)
* @param integer Database type defaults to 0 (MySQL)
* @return mixed Connection link
*/
function pmc_dbopen($db_host, $db_user, $db_pass, $db_name, $db_port='', $db_type=0) {
  $pmc_dbconn = NULL;
  switch($db_type) {
    case 0 : {
      /**
      * Create connection
      */
      $pmc_dbconn = @mysql_connect($db_host . ":" . $db_port , $db_user, $db_pass) or my_err(mysql_errno(), mysql_error());
      /**
      * Select database
      */
      if($pmc_dbconn) {$dbcon = mysql_select_db($db_name) or my_err(mysql_errno(), mysql_error());}
      else {return false; break;}
      /**
      * Enable UTF-8 support
      */
      if($dbcon) {pmc_qry_exec("SET NAMES 'utf8'");}
      else {return false; break;}
      break;
    }
  }
  return $pmc_dbconn;
}
/**
* Close a database connection
*
* @param mixed Connection link
* @param integer Database type defaults to 0 (MySQL)
* @return mixed
*/
function pmc_dbclose($pmc_dbconn, $db_type=0) {
  switch($db_type) {
    case 0 : {mysql_close($pmc_dbconn); break;}
  }
}
/**
* Execute a query
*
* @param mixed Query to execute
* @param integer Database type defaults to 0 (MySQL)
* @return mixed
*/
function pmc_qry_exec($query, $db_type=0) {
  $result = NULL;
  switch($db_type) {
    case 0 : {$result = mysql_query($query) or my_err(mysql_errno(), mysql_error()); break;}
  }
  return $result;
}
/**
* Return an associative array with the results of a query
*
* @param mixed result of a query
* @param integer Database type defaults to 0 (MySQL)
* @return mixed
*/
function pmc_qry_row($result, $db_type=0) {
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
* @param mixed result of a query
* @param integer Row to return defaults to 0 (first row)
* @param integer Database type defaults to 0 (MySQL)
* @return mixed
*/
function pmc_qry_result($result, $row=0, $db_type=0) {
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
* @param mixed result of a query
* @param integer Database type defaults to 0 (MySQL)
* @return mixed
*/
function pmc_qry_total($result, $db_type=0) {
  $total = NULL;
  switch($db_type) {
    case 0 : {$total = mysql_num_rows($result); break;}
  }
  return $total;
}
/**
* Number of rows affected by a query
*
* @param mixed result of a query (needed for PostgreSQL)
* @param integer Database type defaults to 0 (MySQL)
* @return mixed
*/
function pmc_qry_aff($result, $db_type=0) {
  $aff = NULL;
  switch($db_type) {
    // MySQL: INSERT, UPDATE, REPLACE, DELETE
    case 0 : {$aff = mysql_affected_rows(); break;}
  }
  return $aff;
}
/**
* Get variable settings from database
*
* @return mixed
*/
function pmc_cfg_var() {
  $r = pmc_qry_exec("SELECT cfg_set, cfg_val FROM pmc_set_cfg");
  if($r) {
    $t = pmc_qry_total($r);
    if($t>0) {
      for($i=1; $i<=$t; $i++) {
        $rw = pmc_qry_row($r);
        /**
        * Define settings
        */
        define('_APP_'.$rw['cfg_set'], strval($rw['cfg_val']));
      }
    }
    else {
      /* Some minor error like no values in table */
      header("Location: ./setup/install.php"); exit;
    }
  }
  else {
    /* Some big error like no tables in database */
    header("Location: ./setup/install.php"); exit;
  }
}
/**
* Store variable settings in database
*
* @param string setting
* @param string value
* @return boolean result
*/
function pmc_cfg_var_set($set, $val) {
  return pmc_qry_exec("UPDATE pmc_set_cfg SET cfg_val = '{$val}' WHERE cfg_set = '{$set}' LIMIT 1");
}
/**
* Lock tables for writing
*
* @param array tables to lock
*
* @return mixed
*/
function pmc_lock_tables($tables) {
  $t = count($tables);
  $q = "LOCK TABLES ";
  for($i=0;$i<$t;$i++) {
    $q .= "{$tables[$i]} WRITE";
    if($i!=$t-1) {$q .= ", ";}
  }
  $r = pmc_qry_exec($q);
  return $r;
}
/**
* Unlock tables
*
* @return mixed
*/
function pmc_unlock_tables() {
  $r = pmc_qry_exec("UNLOCK TABLES");
  return $r;
}
/**
* Get next autoincrement id
*
* @param string table
*
* @return int next auto increment id
*/
function pmc_next_auto_id($table) {
  $id = 0;
  $r = pmc_qry_exec("SHOW TABLE STATUS LIKE '{$table}'");
  $t = pmc_qry_total($r);
  if($t == 1) {
    $rw = pmc_qry_row($r);
    $id = $rw['Auto_increment'];
  }
  return $id;
}
/**
* Get next id (no auto increment)
*
* @param string table
* @param string column
*
* @return int next id
*/
function pmc_next_id($table, $col) {
  $id = 0;
  $r = pmc_qry_exec("SELECT MAX({$col}) FROM {$table}");
  $t = pmc_qry_total($r);
  if($t == 1) {$id = pmc_qry_result($r) + 1;}
  return $id;
}
/**
* Initialize the user session
*
* @return mixed
*/
function pmc_session($pmc_dbconn) {
  session_cache_limiter('public, must-revalidate');
  session_cache_expire(600); // minutes (10 hours);
  ini_set("session.gc_maxlifetime","36000"); //seconds (1 hours)
  session_start();
  header("ETag: PUB" . time());
  header("Last-Modified: " . gmdate("D, d M Y H:i:s", time()-10) . " GMT");
  header("Expires: " . gmdate("D, d M Y H:i:s", time() + 5) . " GMT");
  header("Pragma: no-cache");
  header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");
  //header('HTTP/1.1 200 OK');
  /**
  * First load of the page
  */
  if (!isset($_SESSION['pmc_token'])) {
    /**
    * Check valid configuration
    */
    pmc_check_install($pmc_dbconn);
    /**
    * Unique token for security
    */
    $_SESSION['pmc_token'] = md5(uniqid(rand(), TRUE));
    /**
    * Visit date
    */
    $_SESSION['pmc_vdate'] = date("Y-m-d");
    /**
    * Visit time
    */
    $_SESSION['pmc_vtime'] = date("H:i:s");
    /**
    * User id
    */
    $_SESSION['pmc_usr_id']    = '0';
    /**
    * User access level
    */
    $_SESSION['pmc_usr_level'] = '0';
    /**
    * User alias
    */
    $_SESSION['pmc_usr_alias'] = 'Guest';
    /**
    * User full name
    */
    $_SESSION['pmc_usr_name']  = 'Anonymous';
    /**
    * Default language
    */
    $_SESSION['pmc_usr_lang']  = _APP_LANG;
    /**
    * Default skin
    */
    $_SESSION['pmc_usr_skin']  = _APP_DIR . 'skin/' . _APP_SKIN . '/';
    $_SESSION['pmc_usr_skin_url']  = _APP_WWW . 'skin/' . _APP_SKIN . '/';
    /**
    * Reset user movie list
    */
    $_SESSION['pmc_usr_lst'] = array();
    /**
    * Default message
    */
    $_SESSION['pmc_msg'] = 0;
    /**
    * Imdbpics
    */
    $_SESSION['pmc_imdb_pics'] = array();
    /**
    * User status message
    */
    $usr_status = 1;
  }
  /**
  * Not first load of the page
  */
  else {
    /**
    * User is not logged in, include login functionality
    */
    if (!isset($_SESSION['pmc_auth'])) {
      /**
      * User status message
      */
      $usr_status = pmc_usr_login();
    }
    /**
    * User is already logged in
    */
    else if (isset($_SESSION['pmc_auth']) && $_SESSION['pmc_auth'] == 'ok') {
      /**
      * User status message
      */
      $usr_status = 6;
    }
  }
  return $usr_status;
}
/**
* User login functionality
*
* @return integer login status
*/
function pmc_usr_login() {
  if((isset($_POST['pmc_login']) && isset($_POST['pmc_pass'])) && isset($_POST['pmc_captcha'])) {
    if(isset($_SESSION['pmc_token']) && isset($_POST['pmc_token'])) {
      if($_POST['pmc_token'] === $_SESSION['pmc_token']) {
        $pmc_login   = pmc_filter_input($_POST['pmc_login']);
        $pmc_pass    = md5($_POST['pmc_pass']);
        $pmc_captcha = strtoupper(pmc_filter_input($_POST['pmc_captcha']));
        if(($pmc_login != '' && $pmc_pass != '') && $pmc_captcha != '') {
          $verif = str_split($_SESSION['pmc_token'], 5);
          $verif = strtoupper(strrev($verif[0]));
          if($pmc_captcha == $verif) {
            
            $r  = pmc_qry_exec("SELECT * FROM pmc_set_usr WHERE usr_mail = '{$pmc_login}' AND usr_pass = '{$pmc_pass}' LIMIT 1");
            $t  = pmc_qry_total($r);
            if($t == 1) { // we have a match, do the thing
              $rw = pmc_qry_row($r);
              if($rw['usr_status'] == 0) { // account suspended
                return 4;
              }
              else { // log in user
                /**
                * Keep existing data but get a new session id
                */
                session_regenerate_id(TRUE);
                /**
                * Authorize user
                */
                $_SESSION['pmc_auth'] = 'ok';
                /**
                * Unique token for security
                */
                $_SESSION['pmc_token'] = md5(uniqid(rand(), TRUE));
                /**
                * Visit date
                */
                $_SESSION['pmc_vdate'] = date("Y-m-d");
                /**
                * Visit time
                */
                $_SESSION['pmc_vtime'] = date("H:i:s");
                /**
                * User id
                */
                $_SESSION['pmc_usr_id'] = $rw['usr_id'];
                /**
                * User access level
                */
                $_SESSION['pmc_usr_level'] = $rw['usr_level'];
                /**
                * User alias
                */
                $_SESSION['pmc_usr_alias'] = $rw['usr_name'];
                /**
                * User full name
                */
                $_SESSION['pmc_usr_name']  = $rw['usr_fname'] . ' ' . $rw['usr_lname'];
                /**
                * User language
                */
                $_SESSION['pmc_usr_lang']  = $rw['usr_lang'];
                /**
                * User skin
                */
                $_SESSION['pmc_usr_skin']  = _APP_DIR . 'skin/' . $rw['usr_skin'] . '/';
                $_SESSION['pmc_usr_skin_url']  = _APP_WWW . 'skin/' . $rw['usr_skin'] . '/';
                /**
                * Default message
                */
                $_SESSION['pmc_msg'] = 1;
                /**
                * Get last login data
                */
                $rl1  = pmc_qry_exec("SELECT MAX(log_id) FROM pmc_var_log WHERE usr_id = '{$_SESSION['pmc_usr_id']}'");
                $tl1  = pmc_qry_total($rl1);
                if($tl1 == 1) {
                  $l1 = pmc_qry_result($rl1, 0);
                  $rl2  = pmc_qry_exec("SELECT log_date, log_time FROM pmc_var_log WHERE log_id = '{$l1}'");
                  $tl2  = pmc_qry_total($rl2);
                  if($tl2 == 1) {
                    $rwl2 = pmc_qry_row($rl2);
                    /**
                    * Last login date
                    */
                    $_SESSION['pmc_ldate'] = $rwl2['log_date'];
                    /**
                    * Last login time
                    */
                    $_SESSION['pmc_ltime'] = $rwl2['log_time'];
                  }
                  else {
                    $_SESSION['pmc_ldate'] = '0000-00-00';
                    $_SESSION['pmc_ltime'] = '00:00:00';
                  }
                }
                else { // first login
                  $_SESSION['pmc_ldate'] = '0000-00-00';
                  $_SESSION['pmc_ltime'] = '00:00:00';
                }
                /**
                * Count total logins
                */
                $rtl  = pmc_qry_exec("SELECT COUNT(log_id) FROM pmc_var_log WHERE usr_id = '{$_SESSION['pmc_usr_id']}'");
                $_SESSION['pmc_ltotal'] = pmc_qry_result($rtl, 0) + 1;
                /**
                * Record current login
                */
                pmc_qry_exec("INSERT INTO pmc_var_log (usr_id, log_date, log_time) VALUES ('{$_SESSION['pmc_usr_id']}', '{$_SESSION['pmc_vdate']}', '{$_SESSION['pmc_vtime']}')");
                
                /**
                * Redirect to the same page where we came from to avoid double submit
                */
                if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] != '') {
                  $location = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                }
                else if(isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] != '') {
                  $location = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                }
                else {
                  $location = _APP_URL;
                }
                header("Location: $location");
                exit;
                //return 5;
              }
            }
            else { //invalid login
              session_regenerate_id(TRUE);
              $_SESSION['pmc_token'] = md5(uniqid(rand(), TRUE));
              return 3;
            }
          }
          else { // invalid security code
            session_regenerate_id(TRUE);
            $_SESSION['pmc_token'] = md5(uniqid(rand(), TRUE));
            return 7;
          }
        }
        else { // empty fields
          session_regenerate_id(TRUE);
          $_SESSION['pmc_token'] = md5(uniqid(rand(), TRUE));
          return 2;
        }
      }
      else { // hacking attempt
        session_regenerate_id(TRUE);
        $_SESSION['pmc_token'] = md5(uniqid(rand(), TRUE));
        return 8;
      }
    }
    else { // hacking attempt
      session_regenerate_id(TRUE);
      $_SESSION['pmc_token'] = md5(uniqid(rand(), TRUE));
      return 9;
    }
  }
  else { // not submitted
    return 1;
  }
}
/**
* Logout
*
* @return mixed
*/
function pmc_usr_logout() {
  $_SESSION = array();
  session_destroy();

  /**
  * Following cookie removal code from php manual comments
  */
  //powerlord at spamless dot vgmusic dot com (19-Nov-2002 07:41)
  //This code might be a bit better for expiring session cookies, in case your domain, path, and/or secure session cookie settings are changed.
  $CookieInfo = session_get_cookie_params();
  if ( (empty($CookieInfo['domain'])) && (empty($CookieInfo['secure'])) ) {
    setcookie(session_name(), '', time()-3600, $CookieInfo['path']);
  }
  elseif (empty($CookieInfo['secure'])) {
    setcookie(session_name(), '', time()-3600, $CookieInfo['path'], $CookieInfo['domain']);
  }
  else {
    setcookie(session_name(), '', time()-3600, $CookieInfo['path'], $CookieInfo['domain'], $CookieInfo['secure']);
  }
  unset($_COOKIE[session_name()]);
  
  header("Location: "._APP_URL);
  exit;
}
/**
* Filter user input
*
* @return string filtered input
*/
function pmc_filter_input($input,$sql=1) {
  if(get_magic_quotes_gpc()) {$input = stripslashes($input);}
  // get rid of unwanted characters
  $unwanted = array('\\', '');
  $input = str_replace($unwanted, ' ', $input);
  // block tags
  $input = str_replace('&lt;', '&#60;', $input);
  $input = str_replace('&gt;', '&#62;', $input);
  $input = str_replace('<', '&#60;', $input);
  $input = str_replace('>', '&#62;', $input);
  if($sql == 1) {$input = mysql_real_escape_string($input);}
  return trim($input);
}
/**
* Filter user input for searching
*
* @return string filtered input
*/
function pmc_filter_input_search($input) {
  $input  = pmc_filter_input($input);
  $common = array(' the ', ' and ', ' or ');
  $input  = str_replace($common, ' ', $input);
  // split by words
  $words = preg_split("/[\s,]+/", $input);
  // get rid of duplicates
  $words = array_unique($words);
  // get rid of short words 1, 2 chars
  $words = preg_replace("/^([a-z]{1,2})$/", '', $words);
  // remove some unwanted chars
  $words = preg_replace("/^([.']{1,})$/", '', $words);
  // get rid of empty words
  $words = array_diff($words, array(''));
  // create string
  $input = implode('|', $words);
  return $input;
}
/**
* Check for a valid email address
*
* @return bool result
*/
function pmc_is_email($email) { 
  return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
}
/**
* Check for a valid integer between 1 and 99999
*
* @return bool result
*/
function pmc_is_int($input) {
  return(preg_match("/^[1-9]$|^[1-9][0-9]$|^[1-9][0-9][0-9]$|^[1-9][0-9][0-9][0-9]$|^[1-9][0-9][0-9][0-9][0-9]$/", $input));
}
/**
* Determine picture extension from file type
*
* @param string file type
*
* @return string extension
*/
function pmc_pic_ext($pic_type) {
  $ext = 'unknown';
  switch($pic_type) {
    case 'image/jpeg'  : {$ext = 'jpg'; break;}
    case 'image/pjpeg' : {$ext = 'jpg'; break;}
    case 'image/png'   : {$ext = 'png'; break;}
    case 'image/x-png' : {$ext = 'png'; break;}
    case 'image/gif'   : {$ext = 'gif'; break;}
  }
  return $ext;
}
/**
* Create an image link with thumbnail
*
* @param string image
* @param string path to image
* @param string image title
* @param integer max image size
*
* @return string link
*/
function pmc_image_thumb($img, $path, $title, $max=50) {
  if(is_file(_APP_DIR.$path.$img)) {
    $img_d = _APP_DIR.$path.$img;
    $img_u = _APP_WWW.$path.$img;
    $link = '<a href="'.$img_u.'" title="'.$title.'" target="_blank">';
    $link .= '<img src="'._APP_WWW.'lib/thumb.php?img='.$img_d.'&amp;max='.$max.'" title="'.$title.'" alt="'.$title.'" />';
    $link .= '</a>';
  }
  else {
    $img_d = _APP_DIR . 'lib/nopic.png';
    $img_u = _APP_WWW . 'lib/nopic.png';
    $link = '<img src="'._APP_WWW.'lib/thumb.php?img='.$img_d.'&amp;max='.$max.'" title="'.$title.'" alt="'.$title.'" />';
  }
  return $link;
}
/**
* Create an image link with thumbnail leading to a custom loaction
*
* @param string image
* @param string path to image
* @param string image title
* @param string target url
* @param integer max image size
*
* @return string link
*/
function pmc_image_thumb_link($img, $path, $title, $url, $target='_blank', $max=50) {
  if(is_file(_APP_DIR.$path.$img)) {
    $img_d = _APP_DIR.$path.$img;
    $link  = '<a href="'.$url.'" title="'.$title.'" target="'.$target.'">';
    $link .= '<img src="'._APP_WWW.'lib/thumb.php?img='.$img_d.'&amp;max='.$max.'" title="'.$title.'" alt="'.$title.'" />';
    $link .= '</a>';
  }
  else {
    $img_d = _APP_DIR . 'lib/nopic.png';
    $link  = '<a href="'.$url.'" title="'.$title.'" target="_blank">';
    $link .= '<img src="'._APP_WWW.'lib/thumb.php?img='.$img_d.'&amp;max='.$max.'" title="'.$title.'" alt="'.$title.'" />';
    $link .= '</a>';
  }
  return $link;
}
/**
* Create a query search expression from user input
*
* @param integer search type
* @param string user input
*
* @return string query search expression
*/
function pmc_queryfill_search($searchtype, $input) {
  $query_fill = "IS NOT NULL";
  if($searchtype == 1)      {$input = pmc_filter_input($input);        if($input != '') {$query_fill = "= '{$input}'";}}
  else if($searchtype == 2) {$input = pmc_filter_input($input);        if($input != '') {$query_fill = "LIKE '%{$input}%'";}}
  else if($searchtype == 3) {$input = pmc_filter_input_search($input); if($input != '') {$query_fill = "REGEXP '{$input}'";}}
  return $query_fill;
}
/**
* List subdirectories within a certain directory
*
* @param string directory to scan
*
* @return array subdirectory list
*/
function pmc_lsdir($dir) {
  $subdirs = NULL;
  $i = '0';
  if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
      while (($file = readdir($dh)) !== false) {
        if ($file != "." && $file != "..") {
          if (filetype($dir . $file) == 'dir') {
            $subdirs[$i] = $file;
            $i++;
          }
        }
      }
    closedir($dh);
    }
  }
  return $subdirs;
}
/**
* Checks for valid instalation
*
* @return boolean result
*/
function pmc_check_install($pmc_dbconn) {
  global $ap_cfg;
  if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] != '') {$server = $_SERVER['HTTP_HOST'];}
  else if(isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] != '') {$server = $_SERVER['SERVER_NAME'];}
  if(isset($_SERVER['PATH_INFO'])) {$request_uri = str_replace($_SERVER['PATH_INFO'], '/', $_SERVER['REQUEST_URI']);}
  else {$request_uri = $_SERVER['REQUEST_URI'];}
  $request_uri = str_replace('index.php/', '', $request_uri);
  $request_uri = str_replace('index.php', '', $request_uri);
  $app_url = 'http://' . $server . $request_uri;
  if($ap_cfg['app_index'] != '') {$app_url = $app_url.$ap_cfg['app_index'];}
  if(!is_readable(_APP_DIR.'inc/cfg.inc.php')) {header("Location: ./setup/install.php"); exit;}
  else if(_APP_URL != $app_url) {header("Location: ./setup/install.php"); exit;}
  if(!$pmc_dbconn) {header("Location: ./setup/install.php"); exit;}
  return true;
}
/**
* Helper function for strpos
*
* @param string $search string to be found
* @param string $string string containing the string to be found
* @return bool result
*/
function pmc_string_exists($search, $string){ 
  $found = strpos($string, $search); 
  if ($found === false) { 
    return false; 
  }
  else { 
    return true; 
  } 
}
/**
* str_split() replacement for PHP < 5
*
* from php manual user notes
* created by heavyraptor (10-Mar-2006 10:07)
* @param string $str string for splitting
* @param integer $length string length
* @return array split string
*/
if(!function_exists("str_split")) {
 function str_split($str,$length = 1) {
   if ($length < 1) return false;
   $strlen = strlen($str);
   $ret = array();
   for ($i = 0; $i < $strlen; $i += $length) {
    $ret[] = substr($str,$i,$length);
   }
   return $ret;
 }
}
?>