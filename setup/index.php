<?php
/**
* ./setup/index.php (installs the application)
*
* <I> ./setup/index.php</I>
* <BR>This is the main setup file
* <BR>It tries to install
* <BR>the application
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    01:02 2008-09-12
* @since      01:02 2008-09-12
* @access     public
* @package    pmc
* @subpackage Setup
* @todo       Everything :-)
*/


/**
* Prevent unauthorized access to other files
*/
define("_VALID_REQUEST", TRUE);
/**
* xxx
*/
die(realpath(dirname('../inc/cfg.inc.php')));
?>