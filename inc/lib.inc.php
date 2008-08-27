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
* @version    18:50 2008-08-26
* @since      19:27 2008-08-19
* @access     public
* @package    phpMyMovieCollection
* @subpackage Core
* @todo       Everything :-)
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
* Output data to user
*
* @return mixed page to diplay
*/
function pmmc_output($cnt, $mod=null) {
  global $lang, $usr_status;
  /**
  * Initialize
  */
  $skin = new Skin($_SESSION['pmmc_usr_skin']);
  /**
  * Title
  */
  $skin->set('title',$cnt['tt']);
  /**
  * Message
  */
  $msg = new Skin($_SESSION['pmmc_usr_skin']);
  $msg->set('lang', $lang);
  //$msg->set('msg', $cnt['msg']);
  $skin->set('msg', $msg->parse('msg.tpl.php'));
  /**
  * Page
  */
  $page = new Skin($_SESSION['pmmc_usr_skin']);
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
      $opt_mod[$i] = new Skin($_SESSION['pmmc_usr_skin']);
      $opt_mod[$i]->set('lang', $lang);
      if($mod[$i]['name'] == 'mod_usr') {$opt_mod[$i]->set('usr_status', $usr_status);}
      $skin->set($mod[$i]['name'], $opt_mod[$i]->parse($mod[$i]['file'].'.tpl.php'));
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
  //header('HTTP/1.1 404 Not Found');
  /*
  $skin = new Skin($_SESSION['pmmc_usr_skin']);
  $skin->set('title', 'MySQL Error'); 
  $content = new Skin($_SESSION['pmmc_usr_skin']);
  $content->set('msg404', '<h1>MySQL Error</h1>' . "\n\t" . $errno . ' : ' . $error . '.<br />');
  $skin->set('page', $content->parse('404.tpl.php'));
  echo $skin->parse('layout.tpl.php');
  */
  //echo '<h1>MySQL Error</h1>' . "\n\t" . $errno . ' : ' . $error . '.<br />';
  //exit;
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
      header("Location: " . _APP_URL);
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
  define('_APP_NAME','phpMyMovieCollection');
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
* Lock tables for writing
*
* @param array tables to lock
*
* @return mixed
*/
function pmmc_lock_tables($tables) {
  $t = count($tables);
  $q = "LOCK TABLES ";
  for($i=0;$i<$t;$i++) {
    $q .= "{$tables[$i]} WRITE";
    if($i!=$t-1) {$q .= ", ";}
  }
  $r = pmmc_qry_exec($q);
  return $r;
}
/**
* Unlock tables
*
* @return mixed
*/
function pmmc_unlock_tables() {
  $r = pmmc_qry_exec("UNLOCK TABLES");
  return $r;
}
/**
* Get next autoincrement id
*
* @param string table
*
* @return int next auto increment id
*/
function pmmc_next_auto_id($table) {
  $id = 0;
  $r = pmmc_qry_exec("SHOW TABLE STATUS LIKE '{$table}'");
  $t = pmmc_qry_total($r);
  if($t == 1) {
    $rw = pmmc_qry_row($r);
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
function pmmc_next_id($table, $col) {
  $id = 0;
  $r = pmmc_qry_exec("SELECT MAX({$col}) FROM {$table}");
  $t = pmmc_qry_total($r);
  if($t == 1) {$id = pmmc_qry_result($r) + 1;}
  return $id;
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
  //header('HTTP/1.1 200 OK');
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
    /**
    * Default language
    */
    $_SESSION['pmmc_usr_lang']  = _APP_LANG;
    /**
    * Default skin
    */
    $_SESSION['pmmc_usr_skin']  = _APP_DIR . 'skin/' . _APP_SKIN . '/';
    /**
    * Reset user movie list
    */
    $_SESSION['pmmc_usr_lst'] = NULL;
    /**
    * Default message
    */
    $_SESSION['pmmc_msg'] = 0;
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
    if (!isset($_SESSION['pmmc_auth'])) {
      /**
      * User status message
      */
      $usr_status = pmmc_usr_login();
    }
    /**
    * User is already logged in
    */
    else if (isset($_SESSION['pmmc_auth']) && $_SESSION['pmmc_auth'] == 'ok') {
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
function pmmc_usr_login() {
  if((isset($_POST['pmmc_login']) && isset($_POST['pmmc_pass'])) && isset($_POST['pmmc_captcha'])) {
    if(isset($_SESSION['pmmc_token']) && isset($_POST['pmmc_token'])) {
      if($_POST['pmmc_token'] === $_SESSION['pmmc_token']) {
        $pmmc_login   = pmmc_filter_input($_POST['pmmc_login']);
        $pmmc_pass    = md5($_POST['pmmc_pass']);
        $pmmc_captcha = strtoupper(pmmc_filter_input($_POST['pmmc_captcha']));
        if(($pmmc_login != '' && $pmmc_pass != '') && $pmmc_captcha != '') {
          $verif = str_split($_SESSION['pmmc_token'], 5);
          $verif = strtoupper(strrev($verif[0]));
          if($pmmc_captcha == $verif) {
            
            $r  = pmmc_qry_exec("SELECT * FROM pmmc_set_usr WHERE usr_mail = '{$pmmc_login}' AND usr_pass = '{$pmmc_pass}' LIMIT 1");
            $t  = pmmc_qry_total($r);
            if($t == 1) { // we have a match, do the thing
              $rw = pmmc_qry_row($r);
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
                $_SESSION['pmmc_auth'] = 'ok';
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
                $_SESSION['pmmc_usr_id'] = $rw['usr_id'];
                /**
                * User access level
                */
                $_SESSION['pmmc_usr_level'] = $rw['usr_level'];
                /**
                * User alias
                */
                $_SESSION['pmmc_usr_alias'] = $rw['usr_name'];
                /**
                * User full name
                */
                $_SESSION['pmmc_usr_name']  = $rw['usr_fname'] . ' ' . $rw['usr_lname'];
                /**
                * User language
                */
                $_SESSION['pmmc_usr_lang']  = $rw['usr_lang'];
                /**
                * User skin
                */
                $_SESSION['pmmc_usr_skin']  = _APP_DIR . 'skin/' . $rw['usr_skin'] . '/';
                /**
                * Default message
                */
                $_SESSION['pmmc_msg'] = 1;
                /**
                * Get last login data
                */
                $rl1  = pmmc_qry_exec("SELECT MAX(log_id) FROM pmmc_var_log WHERE usr_id = '{$_SESSION['pmmc_usr_id']}'");
                $tl1  = pmmc_qry_total($rl1);
                if($tl1 == 1) {
                  $l1 = pmmc_qry_result($rl1, 0);
                  $rl2  = pmmc_qry_exec("SELECT log_date, log_time FROM pmmc_var_log WHERE log_id = '{$l1}'");
                  $tl2  = pmmc_qry_total($rl2);
                  if($tl2 == 1) {
                    $rwl2 = pmmc_qry_row($rl2);
                    /**
                    * Last login date
                    */
                    $_SESSION['pmmc_ldate'] = $rwl2['log_date'];
                    /**
                    * Last login time
                    */
                    $_SESSION['pmmc_ltime'] = $rwl2['log_time'];
                  }
                }
                else { // first login
                  $_SESSION['pmmc_ldate'] = '0000-00-00';
                  $_SESSION['pmmc_ltime'] = '00:00:00';
                }
                /**
                * Count total logins
                */
                $rtl  = pmmc_qry_exec("SELECT COUNT(log_id) FROM pmmc_var_log WHERE usr_id = '{$_SESSION['pmmc_usr_id']}'");
                $_SESSION['pmmc_ltotal'] = pmmc_qry_result($rtl, 0) + 1;
                /**
                * Record current login
                */
                pmmc_qry_exec("INSERT INTO pmmc_var_log (usr_id, log_date, log_time) VALUES ('{$_SESSION['pmmc_usr_id']}', '{$_SESSION['pmmc_vdate']}', '{$_SESSION['pmmc_vtime']}')");
                
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
              $_SESSION['pmmc_token'] = md5(uniqid(rand(), TRUE));
              return 3;
            }
          }
          else { // invalid security code
            session_regenerate_id(TRUE);
            $_SESSION['pmmc_token'] = md5(uniqid(rand(), TRUE));
            return 7;
          }
        }
        else { // empty fields
          session_regenerate_id(TRUE);
          $_SESSION['pmmc_token'] = md5(uniqid(rand(), TRUE));
          return 2;
        }
      }
      else { // hacking attempt
        session_regenerate_id(TRUE);
        $_SESSION['pmmc_token'] = md5(uniqid(rand(), TRUE));
        return 8;
      }
    }
    else { // hacking attempt
      session_regenerate_id(TRUE);
      $_SESSION['pmmc_token'] = md5(uniqid(rand(), TRUE));
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
function pmmc_usr_logout() {
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
function pmmc_filter_input($input) {
  if(get_magic_quotes_gpc()) {$input = stripslashes($input);}
  // get rid of unwanted characters
  $unwanted = array('\\', '');
  $input = str_replace($unwanted, ' ', $input);
  // block tags
  $input = str_replace('&lt;', '&#60;', $input);
  $input = str_replace('&gt;', '&#62;', $input);
  $input = str_replace('<', '&#60;', $input);
  $input = str_replace('>', '&#62;', $input);
  return mysql_real_escape_string(trim($input));
}
/**
* Check for a valid email address
*
* @return bool result
*/
function pmmc_is_email($email) { 
  return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
}
/**
* Check for a valid integer between 1 and 99999
*
* @return bool result
*/
function pmmc_is_int($input) {
  return(preg_match("/^[1-9]$|^[1-9][0-9]$|^[1-9][0-9][0-9]$|^[1-9][0-9][0-9][0-9]$|^[1-9][0-9][0-9][0-9][0-9]$/", $input));
}
/**
* Determine picture extension from file type
*
* @param string file type
*
* @return string extension
*/
function pmmc_pic_ext($pic_type) {
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
function pmmc_image_thumb($img, $path, $title) {
  if(is_file(_APP_DIR.$path.$img)) {
    $img_d = _APP_DIR.$path.$img;
    $img_u = _APP_URL.$path.$img;
    $link = '<a href="'.$img_u.'" title="'.$title.'" target="_blank">';
    $link .= '<img src="'._APP_URL.'lib/thumb.php?img='.$img_d.'&amp;max=50" title="'.$title.'" alt="'.$title.'" />';
    $link .= '</a>';
  }
  else {
    $img_d = _APP_DIR . 'lib/nopic.png';
    $img_u = _APP_URL . 'lib/nopic.png';
    $link = '<img src="'._APP_URL.'lib/thumb.php?img='.$img_d.'&amp;max=50" title="'.$title.'" alt="'.$title.'" />';
  }
  return $link;
}
?>