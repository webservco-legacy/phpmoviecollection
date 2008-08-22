<?php
/*
./inc/skin.class.php
19:10 2008-08-21
*/

//if(!defined('_VALID_REQUEST')) {show404();}


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
?>