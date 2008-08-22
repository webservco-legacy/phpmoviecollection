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


define("_VALID_REQUEST", TRUE);

require_once './inc/lib.inc.php';
require_once './inc/cfg.inc.php';

// set error reporting
pmmc_error_reporting(1);
// protect seo_urls function from invalid requests
//pmmc_protect_seo();
// search engine friendly urls
pmmc_seo_urls();


// TEST SKIN CLASS START
$skindir = './skin/pmmc/';
$skin = & new Skin($skindir);
$skin->set('title', 'Test Title');
// inner
$content = & new Skin($skindir);
$content->set('teststuff', 'Is it working?');
$skin->set('content', $content->parse('tester.tpl.php'));
echo $skin->parse('layout.tpl.php');
// TEST SKIN CLASS END


echo '<BR>';
print_r($_GET);
echo '<BR>';
echo $_SERVER['PATH_INFO'];
echo '<BR>';
echo $_SERVER['REQUEST_URI'];
?>