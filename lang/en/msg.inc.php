<?php
/**
* ./lang/en/msg.inc.php (English Language file - messages)
*
* <I> msg.inc.php</I>
* <BR>This is the file
* <BR>for the English
* <BR>language - messages
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    18:34 2008-10-11
* @since      10:56 2008-09-14
* @access     public
* @package    pmc
* @subpackage Internationalization
* @todo       stuff
*/

/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../../lib/404.php';}
/**
* General
*/
$lang['msg'][0]['tt'] = 'phpMovieCollection'; // default
$lang['msg'][0]['tp'] = 'msg';
$lang['msg'][1]['tt'] = 'Welcome'; // logged in user
$lang['msg'][1]['tp'] = 'ok';
$lang['msg'][2]['tt'] = 'Requested resource not found!'; // invalid request
$lang['msg'][2]['tp'] = 'err';
$lang['msg'][3]['tt'] = '';
$lang['msg'][3]['tp'] = 'ok';
$lang['msg'][4]['tt'] = '';
$lang['msg'][4]['tp'] = 'ok';
$lang['msg'][5]['tt'] = '';
$lang['msg'][5]['tp'] = 'ok';
$lang['msg'][6]['tt'] = '';
$lang['msg'][6]['tp'] = 'ok';
$lang['msg'][7]['tt'] = '';
$lang['msg'][7]['tp'] = 'ok';
$lang['msg'][8]['tt'] = '';
$lang['msg'][8]['tp'] = 'ok';
$lang['msg'][9]['tt'] = '';
$lang['msg'][9]['tp'] = 'ok';
$lang['msg'][10]['tt'] = '';
$lang['msg'][10]['tp'] = 'ok';
/**
* Forms
*/
$lang['msg'][11]['tt'] = 'Image processing error. Only jpeg,png,gif formats allowed!';
$lang['msg'][11]['tp'] = 'err';
$lang['msg'][12]['tt'] = 'Image processing error. Nu file uploaded!';
$lang['msg'][12]['tp'] = 'err';
$lang['msg'][13]['tt'] = 'Image processing error. Partial upload!';
$lang['msg'][13]['tp'] = 'err';
$lang['msg'][14]['tt'] = 'Image processing error. File not sent by form!';
$lang['msg'][14]['tp'] = 'err';
$lang['msg'][15]['tt'] = 'Image processing error. File size too big!';
$lang['msg'][15]['tp'] = 'err';
$lang['msg'][16]['tt'] = 'Form processing error. Fill all required fields!';
$lang['msg'][16]['tp'] = 'err';
$lang['msg'][17]['tt'] = 'Form processing error. File size too big. The form was reset!';
$lang['msg'][17]['tp'] = 'err';
$lang['msg'][18]['tt'] = '';
$lang['msg'][18]['tp'] = 'err';
$lang['msg'][19]['tt'] = '';
$lang['msg'][19]['tp'] = 'err';
$lang['msg'][20]['tt'] = '';
$lang['msg'][20]['tp'] = 'err';
/**
* Categories
*/
$lang['msg'][21]['tt'] = 'Fill in the form and press the \'Add\' button. Image is optional.';
$lang['msg'][21]['tp'] = 'msg';
$lang['msg'][22]['tt'] = 'Internal error. New category not added. If this is the first time you see this message...';
$lang['msg'][22]['tp'] = 'err';
$lang['msg'][23]['tt'] = 'New category added successfully!';
$lang['msg'][23]['tp'] = 'ok';
$lang['msg'][24]['tt'] = 'Internal error. Category has not been modified. If this is the first time you see this message...';
$lang['msg'][24]['tp'] = 'err';
$lang['msg'][25]['tt'] = 'Category modified successfully!';
$lang['msg'][25]['tp'] = 'ok';
$lang['msg'][26]['tt'] = 'No categories.';
$lang['msg'][26]['tp'] = 'err';
$lang['msg'][27]['tt'] = 'Category order modified successfully!';
$lang['msg'][27]['tp'] = 'ok';
$lang['msg'][28]['tt'] = 'One or more categories have been deleted!';
$lang['msg'][28]['tp'] = 'ok';
$lang['msg'][29]['tt'] = 'New category added successfully but image storing failed!';
$lang['msg'][29]['tp'] = 'msg';
$lang['msg'][30]['tt'] = 'Category modified successfully but image storing failed!';
$lang['msg'][30]['tp'] = 'msg';
/**
* Movies
*/
$lang['msg'][31]['tt'] = 'Internal error. New movie not added. If this is the first time you see this message...';
$lang['msg'][31]['tp'] = 'err';
$lang['msg'][32]['tt'] = 'New movie added successfully!';
$lang['msg'][32]['tp'] = 'ok';
$lang['msg'][33]['tt'] = 'New movie added successfully but image storing failed!';
$lang['msg'][33]['tp'] = 'msg';
$lang['msg'][34]['tt'] = 'No categories! Before you can add movies you must add at least one category!';
$lang['msg'][34]['tp'] = 'err';
$lang['msg'][35]['tt'] = 'IMDb data fetching attempted...';
$lang['msg'][35]['tp'] = 'msg';
$lang['msg'][36]['tt'] = 'Movie modified successfully!';
$lang['msg'][36]['tp'] = 'ok';
$lang['msg'][37]['tt'] = 'Movie modified successfully but image storing failed!';
$lang['msg'][37]['tp'] = 'msg';
$lang['msg'][38]['tt'] = 'Internal error. Movie has not been modified. If this is the first time you see this message...';
$lang['msg'][38]['tp'] = 'err';
$lang['msg'][39]['tt'] = 'No movies found matching selection!';
$lang['msg'][39]['tp'] = 'err';
$lang['msg'][40]['tt'] = 'One or more movies have been deleted!';
$lang['msg'][40]['tp'] = 'ok';
/**
* Settings
*/
$lang['msg'][41]['tt'] = 'Settings saved successfully! You will have to log in again to see the changes!';
$lang['msg'][41]['tp'] = 'ok';
$lang['msg'][42]['tt'] = 'Internal error. One or more settings have not been modified. If this is the first time you see this message...';
$lang['msg'][42]['tp'] = 'err';
/**
* Users
*/
$lang['msg'][43]['tt'] = 'New user added successfully!';
$lang['msg'][43]['tp'] = 'ok';
$lang['msg'][44]['tt'] = 'Internal error. New user not added. If this is the first time you see this message...';
$lang['msg'][44]['tp'] = 'err';
$lang['msg'][45]['tt'] = 'User data modified successfully!';
$lang['msg'][45]['tp'] = 'ok';
$lang['msg'][46]['tt'] = 'Internal error. User data not modified. If this is the first time you see this message...';
$lang['msg'][46]['tp'] = 'err';
$lang['msg'][47]['tt'] = 'The email address is already registered!';
$lang['msg'][47]['tp'] = 'err';
$lang['msg'][48]['tt'] = 'No such user!';
$lang['msg'][48]['tp'] = 'err';
$lang['msg'][49]['tt'] = 'No users.';
$lang['msg'][49]['tp'] = 'err';
$lang['msg'][50]['tt'] = 'One or more users have been deleted!';
$lang['msg'][50]['tp'] = 'ok';
/**
* Languages
*/
$lang['msg'][51]['tt'] = 'Language was set successfully!';
$lang['msg'][51]['tp'] = 'ok';
/**
* Skins
*/
$lang['msg'][52]['tt'] = 'Skin was set successfully!';
$lang['msg'][52]['tp'] = 'ok';
/**
* User lists
*/
$lang['msg'][53]['tt'] = 'Title added to list!';
$lang['msg'][53]['tp'] = 'ok';
$lang['msg'][54]['tt'] = 'Title deleted from list!';
$lang['msg'][54]['tp'] = 'ok';
$lang['msg'][55]['tt'] = 'You must be logged in to have this feature available!';
$lang['msg'][55]['tp'] = 'err';
$lang['msg'][56]['tt'] = 'List erased!';
$lang['msg'][56]['tp'] = 'ok';
$lang['msg'][57]['tt'] = 'List saved!';
$lang['msg'][57]['tp'] = 'ok';
$lang['msg'][58]['tt'] = 'List loaded!';
$lang['msg'][58]['tp'] = 'ok';
$lang['msg'][59]['tt'] = 'List is empty!';
$lang['msg'][59]['tp'] = 'msg';
$lang['msg'][60]['tt'] = 'Nothing to delete!';
$lang['msg'][60]['tp'] = 'msg';
/**
* Media
*/
$lang['msg'][61]['tt'] = 'Media added successfully!';
$lang['msg'][61]['tp'] = 'ok';
$lang['msg'][62]['tt'] = 'Internal error. New media not added. If this is the first time you see this message...';
$lang['msg'][62]['tp'] = 'err';
$lang['msg'][63]['tt'] = 'Media modified successfully!';
$lang['msg'][63]['tp'] = 'ok';
$lang['msg'][64]['tt'] = 'One or more media have been deleted!';
$lang['msg'][64]['tp'] = 'ok';
$lang['msg'][65]['tt'] = 'No media.';
$lang['msg'][65]['tp'] = 'err';
?>