<?php
/*
./inc/lib.inc.php
19:10 2008-08-21
*/


if(!defined('_VALID_REQUEST')) {show404();}

class skin {
  var $skindir;
  var $skinvars;

  function skin($skindir = null) {
    $this->skindir = $skindir;
    $this->skinvars = array();
	}
  function set($name, $value) {
    $this->skinvars[$name] = $value;
	}
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
  //return die('hacker alert!');
  header('HTTP/1.1 404 Not Found');
  $skindir = './skin/pmmc/';
  $skin = & new Skin($skindir);
  $skin->set('title', '404 Not Found');
  $content = & new Skin($skindir);
  $content->set('msg404', '<H1>404 Not Found</H1>' . "\n\t" . 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found on this server.');
  $skin->set('content', $content->parse('404.tpl.php'));
  echo $skin->parse('layout.tpl.php');
  exit;
}

/**
* Error reporting function
*
* Sets the error reporting (useful for debugging purposes
*/
function pmmc_error_reporting($level=0) {
  switch($level) {
    case 0 : {return error_reporting(E_ALL ^ E_NOTICE); break;}
    case 1 : {return error_reporting(E_ALL); break;}
    default : {return error_reporting(E_ALL); break;}
  }
}
/**
* Prevent invalid requests
*
* If requested page is ok, there are get variables, but there is a slash at the end,
* it breaks the seo_urls function so we treat it as an invalid request
*/
function pmmc_protect_seo() {
  if ($_SERVER['REQUEST_URI'][strlen($_SERVER['REQUEST_URI'])-1] == "/" && count($_GET) != 0) {
    $site_root = 'http://localhost/pub/temp/phpMyMovieCollection/index.php';
    return header("Location: $site_root");
    exit;
  }
}
/**
* Create Search Engine friendly URLs
*
* before: index.php?id=2&page=3
* after: index.php/id/2/page/3
* inspiration from code created by 
* ReDuX (http://www.daniweb.com/code/snippet74.html)
* and
* DD32 (http://www.php.net/manual/en/language.variables.predefined.php#63312)
*/
function pmmc_seo_urls() {
  if (isset($_SERVER['PATH_INFO'])) {
    $raw_data = explode('/', $_SERVER['PATH_INFO']);
    unset($raw_data[0]);
    $total_data = count($raw_data);
    // remove empty values - useful for //
    //
    if($raw_data[$total_data] == '') {unset($raw_data[$total_data]);}
    $total_data = count($raw_data);
    if (is_int($total_data / 2)) {
      for($i=1;$i<=count($raw_data);$i+=2) {
        $_GET[$raw_data[$i]] = $raw_data[$i+1];
      }
    }
  }
}
?>