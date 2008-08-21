<?php
/*
./index.php
15:46 2008-03-12
*/

/**
* Index.php (short description)
*
* <I> .index.php</I>
* <BR>long description for index.php
* <BR>second line
* <BR>third line
* @author Radu Maier <rudisoft@rudisoft.net>
* @copyright Copyright (c) 2007-2008, Radu Maier
* @license http://opensource.org/licenses/gpl-2.0.php
* @version 19:27 2008-08-19
* @since 19:27 2008-08-19
* @access public
* @package phpMyMovieCollection
* @subpackage Other
* @todo Everything :-)
* extra {@tutorial RudWEb/Other/tutorial1.pkg}
* @example example1.phps
*/

/**
* temp
*/

error_reporting(E_ALL);

// TEST SKIN CLASS START
require './inc/skin.class.php';
$skindir = './skin/pmmc/';
$skin = & new Skin($skindir);
$skin->set('title', 'Test Title');
// inner
$content = & new Skin($skindir);
$content->set('teststuff', 'Is it working?');
$skin->set('content', $content->parse('tester.tpl.php'));
echo $skin->parse('layout.tpl.php');
// TEST SKIN CLASS END
?>