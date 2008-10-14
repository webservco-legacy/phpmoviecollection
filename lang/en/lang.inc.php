<?php
/**
* ./lang/en/lang.inc.php (English Language file)
*
* <I> lang.inc.php</I>
* <BR>This is the file
* <BR>for the English
* <BR>language
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    10:34 2008-10-14
* @since      11:24 2008-09-14
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
* User status
*/
$lang['usr_status'][1]      = 'Not logged in';
$lang['usr_status'][2]      = 'Empty fields';
$lang['usr_status'][3]      = 'Incorrect data';
$lang['usr_status'][4]      = 'Suspended account';
$lang['usr_status'][5]      = 'Authentication ok';
$lang['usr_status'][6]      = 'Logged in';
$lang['usr_status'][7]      = 'Incorrect verification code';
$lang['usr_status'][8]      = 'Multiple submits';
$lang['usr_status'][9]      = 'Possible intrusion attempt';
/**
* General
*/
$lang['pmc']['welcome']     = 'Welcome';
$lang['pmc']['order']       = 'Order';
$lang['pmc']['pic']         = 'Image';
$lang['pmc']['ttpre']       = 'Title prefix';
$lang['pmc']['tt']          = 'Title';
$lang['pmc']['desc']        = 'Description';
$lang['pmc']['items']       = 'Items';
$lang['pmc']['add']         = 'Add';
$lang['pmc']['mod']         = 'Modify';
$lang['pmc']['del']         = 'Delete';
$lang['pmc']['save_mod']    = 'Save changes';
$lang['pmc']['select']      = 'Select';
$lang['pmc']['year']        = 'Year';
$lang['pmc']['country']     = 'Country';
$lang['pmc']['language']    = 'Language';
$lang['pmc']['notes']       = 'Notes';
$lang['pmc']['page']        = 'Page';
$lang['pmc']['of']          = 'of';
$lang['pmc']['sortby']      = 'Sort by';
$lang['pmc']['order']       = 'Order';
$lang['pmc']['ordera']      = 'Ascending';
$lang['pmc']['orderd']      = 'Descending';
$lang['pmc']['ok']          = 'Ok';
$lang['pmc']['url']         = 'Address';
$lang['pmc']['captcha']     = 'Verification code';
$lang['pmc']['today']       = 'today';
$lang['pmc']['yesterday']   = 'yesterday';
$lang['pmc']['ago1']        = '';
$lang['pmc']['ago2']        = 'days ago';
/**
* Administration
*/
$lang['adm']['adm']         = 'Administration';
/**
* Categories
*/
$lang['categ']['categ']     = 'Category';
$lang['categ']['categs']    = 'Categories';
$lang['categ']['nocategs']  = 'No categories';
$lang['categ']['add']       = 'Add Category';
$lang['categ']['view']      = 'Category Details';
$lang['categ']['viewall']   = 'View Categories';
$lang['categ']['allcategs'] = 'All Categories';
/**
* Movies
*/
$lang['movie']['movie']     = 'Movie';
$lang['movie']['movies']    = 'Movies';
$lang['movie']['mymovies']  = 'My Movies';
$lang['movie']['nomovies']  = 'No movies';
$lang['movie']['details']   = 'Movie Details';
$lang['movie']['add']       = 'Add Movie';
$lang['movie']['imdb']      = 'IMDb Id';
$lang['movie']['type']      = 'Type';
$lang['movie']['typ'][0]    = 'Theatrical';
$lang['movie']['typ'][1]    = 'Video';
$lang['movie']['typ'][2]    = 'Television';
$lang['movie']['aka']       = 'Alternative titles';
$lang['movie']['director']  = 'Director';
$lang['movie']['writer']    = 'Writer';
$lang['movie']['tagline']   = 'Tagline';
$lang['movie']['plot']      = 'Plot';
$lang['movie']['cast']      = 'Cast';
$lang['movie']['list']      = 'Movie list';
$lang['movie']['catno']     = 'Catalogue number';
$lang['movie']['mformat']   = 'Format';
$lang['movie']['noformat']  = 'n/a';
$lang['movie']['format'][0] = 'n/a';
$lang['movie']['format'][1] = 'Avi (DivX/XviD)';
$lang['movie']['format'][2] = 'Mpeg';
$lang['movie']['format'][3] = 'DVD';
$lang['movie']['subs']      = 'Subtitles';
$lang['movie']['latest']    = 'Recent movies';
$lang['movie']['last']      = 'Last';
/**
* Genres
*/
$lang['genre']['genres']    = 'Genres';
/**
* IMDb
*/
$lang['imdb']['imdb']       = 'IMDb';
$lang['imdb']['url']        = 'IMDb URL';
$lang['imdb']['fetch']      = 'Fetch';
/**
* Settings
*/
$lang['set']['set']         = 'Set';
$lang['set']['sets']        = 'Settings';
$lang['set']['lang']        = 'Default application language';
$lang['set']['skin']        = 'Default application skin';
$lang['set']['pcat']        = 'Category image thumbnail size';
$lang['set']['pmov']        = 'Movie image thumbnail size';
$lang['set']['imov']        = 'Number of movies per page';
$lang['set']['iusr']        = 'Number of users per page';
$lang['set']['imed']        = 'Number of media per page';
$lang['set']['lmov']        = 'Number of latest movies to show';
/**
* Users
*/
$lang['usr']['usrs']        = 'Users';
$lang['usr']['add']         = 'Add User';
$lang['usr']['view']        = 'User Details';
$lang['usr']['viewall']     = 'View Users';
$lang['usr']['name']        = 'Alias';
$lang['usr']['fname']       = 'First name';
$lang['usr']['lname']       = 'Last name';
$lang['usr']['mail1']       = 'E-mail';
$lang['usr']['mail2']       = 'E-mail again';
$lang['usr']['pass1']       = 'Password';
$lang['usr']['pass2']       = 'Password again';
$lang['usr']['pass1n']      = 'New password';
$lang['usr']['pass2n']      = 'New password again';
$lang['usr']['level']       = 'Access level';
$lang['usr']['lvl'][0]      = 'Guest';
$lang['usr']['lvl'][1]      = 'User';
$lang['usr']['lvl'][2]      = 'VIP User';
$lang['usr']['lvl'][3]      = 'Administrator';
$lang['usr']['lvl'][4]      = 'Collector';
$lang['usr']['lvl'][5]      = 'Root';
$lang['usr']['status']      = 'Status';
$lang['usr']['stat'][0]     = 'Suspended';
$lang['usr']['stat'][1]     = 'Active';
$lang['usr']['login']       = 'Login';
$lang['usr']['logout']      = 'Logout';
$lang['usr']['status']      = 'Status';
$lang['usr']['vfirst']      = 'First visit';
$lang['usr']['vtotal']      = 'total visits';
$lang['usr']['vlast']       = 'Last visit';
/**
* Vizualization
*/
$lang['view']['view']       = 'View';
/**
* Search
*/
$lang['search']['search']   = 'Search';
$lang['search']['reset']    = 'Reset';
$lang['search']['imdb']     = 'IMDb search';
$lang['search']['simple']   = 'Simple search';
$lang['search']['advanced'] = 'Advanced search';
$lang['search']['results']  = 'Search results';
$lang['search']['exact']    = 'Exact match';
$lang['search']['aprox']    = 'All words';
$lang['search']['regexp']   = 'Any word';
$lang['search']['after']    = 'Search after';
/**
* Language
*/
$lang['lang']['lang']       = 'Language';
$lang['lang']['langs']      = 'Languages';
$lang['lang']['trans']      = 'Translator';
$lang['lang']['current']    = 'Current language';
/**
* Skins
*/
$lang['skin']['skin']       = 'Skin';
$lang['skin']['skins']      = 'Skins';
$lang['skin']['auth']       = 'Author';
$lang['skin']['current']    = 'Current skin';
$lang['skin']['ver']        = 'Version';
/**
* User list
*/
$lang['list']['mylist']     = 'My list';
$lang['list']['view']       = 'View list';
$lang['list']['add']        = 'Add';
$lang['list']['del']        = 'Delete';
$lang['list']['save']       = 'Save';
$lang['list']['clear']      = 'Clear';
$lang['list']['load']       = 'Load';
$lang['list']['isempty']    = 'Empty list';
$lang['list']['onetitle']   = 'One title';
$lang['list']['titles']     = 'titles';
/**
* Statistics
*/
$lang['stats']['stats']     = 'Statistics';
$lang['stats']['movies']    = 'Total movies';
$lang['stats']['newmovies'] = 'today';
$lang['stats']['users']     = 'Total users';
/**
* Help
*/
$lang['help']['help']       = 'Help';
$lang['help']['text']       = 'For the latest version of the manual please visit';
$lang['help']['urltt']      = 'The '. _APP_NAME. ' Website';
/**
* About
*/
$lang['about']['about']     = 'About';
/**
* Media
*/
$lang['media']['media']     = 'Media';
$lang['media']['nomedia']   = 'No media';
$lang['media']['add']       = 'Add Media';
$lang['media']['view']      = 'View Media';
$lang['media']['cat']       = 'Catalogue number';
$lang['media']['tt']        = 'Title';
$lang['media']['type']      = 'Format';
$lang['media']['items']     = 'Titles';
$lang['media'][1]           = 'VHS';
$lang['media'][2]           = 'CD';
$lang['media'][3]           = 'DVD5';
$lang['media'][4]           = 'DVD9';
/**
* Setup
*/
$lang['setup']['setup']     = 'Setup';
$lang['setup']['install']   = 'Install';
?>