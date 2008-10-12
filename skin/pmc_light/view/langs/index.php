<?php
/**
* ./index.php (for security purposes)
*
* <I> ./index.php</I>
* <BR>This file
* <BR>displays a custom
* <BR>error message
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    18:10 2008-10-12
* @since      18:10 2008-10-12
* @access     public
* @package    pmc
* @subpackage Core
* @todo       stuff
*/

header('HTTP/1.1 404 Not Found');
echo '<?xml version="1.0" encoding="utf-8" standalone="no"?>'."\n";
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
echo '<meta http-equiv="content-language" content="en" />';
echo '<title>404 Not Found</title>';
echo '</head><body>';
echo '<h1>404 Not Found</h1>' . "\n\t" . 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found on this server.';
echo '</body></html>';
exit;
?>