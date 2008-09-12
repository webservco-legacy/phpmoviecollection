<?php
/**
* ./setup/install.php (installs the application)
*
* <I> ./setup/install.php</I>
* <BR>This is the main setup file
* <BR>It tries to install
* <BR>the application
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    14:22 2008-09-12
* @since      14:22 2008-09-12
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
* Load setup functions
*/
if(is_readable('./setup.inc.php')) {require_once './setup.inc.php';}
else {die('ERROR! Files missing. Please re-install the application.');}
/**
* xxx
*/
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//$c = gen_cfg_str();
//$w = wrt_cfg_str($c, './test.php');
//echo $w . '<br />';

//echo chk_cfg_wrt('./', 'test.php');
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] != '') {$server = $_SERVER['HTTP_HOST'];}
else if(isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] != '') {$server = $_SERVER['SERVER_NAME'];}
$request_uri = str_replace('/setup/install.php', '/', $_SERVER['REQUEST_URI']);
$app_url = 'http://' . $server . $request_uri;

$cfg = array();

$cfg['app_url']   = $app_url;
$cfg['app_index'] = '1';
$cfg['app_dir']   = str_replace('\\', '/', realpath(dirname('../index.php'))) . '/';

$cfg['db_host']   = 'localhost';
$cfg['db_user']   = '';
$cfg['db_pass']   = '';
$cfg['db_name']   = '';

$cfg['mod_usr']   = '1';
$cfg['mod_login'] = '1';
$cfg['mod_gen']   = '1';
$cfg['mod_src']   = '1';
$cfg['mod_imdb']  = '1';
$cfg['mod_lst']   = '1';

$cfg['usr_name']  = '';
$cfg['usr_fname'] = '';
$cfg['usr_lname'] = '';
$cfg['usr_mail']  = '';
$cfg['usr_pass']  = '';
$cfg['usr_skin']  = 'pmc';
$cfg['usr_lang']  = 'ro';

$cfg['app_lang']  = 'ro';
$cfg['app_skin']  = 'pmc';
$cfg['app_pcat']  = '150';
$cfg['app_pmov']  = '150';
$cfg['app_imov']  = '10';
$cfg['app_iusr']  = '10';
$cfg['app_dmov']  = '3';

/*
* if post -> validate 
err) -> die(error+link: try again-redirect)
ok) - > cfg= -> -> check if vales are ok
  err) -> die....
  ok) ->wrt_cfg -> insert dbs -> insert dbv -> echo ok(redirect)
* if not post echo form


*/
require_once 'tpl.hdr.inc.php';

if(isset($_POST['install'])) {
  echo 'install';
}
else {
?>
<form enctype="multipart/form-data" id="setup_form" name="setup_form" action="" method="post">
<table border="0" cellspacing="0" cellpadding="0" align="center">

<tr>
  <td class="label">
  &#160;
  </td>
  <td class="input">
  <h3>Application information</h3>
  </td>
</tr>
<tr>
 <td class="label">
 <label for="app_url">Application URL:</label>
 </td>
 <td class="input">
 <input id="app_url" name="app_url" type="text" size="50" maxlength="150" value="<?php echo $cfg['app_url']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="app_dir">Application Path:</label>
 </td>
 <td class="input">
 <input id="app_dir" name="app_dir" type="text" size="50" maxlength="150" value="<?php echo $cfg['app_dir']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="app_index">Remove "index.php" from application URL:</label>
 </td>
 <td class="input">
 <select id="app_index" name="app_index" size="1">
  <option value="0"<?php if($cfg['app_index'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['app_index'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>

<tr>
  <td class="label">
  &#160;
  </td>
  <td class="input">
  <h3>Database information</h3>
  </td>
</tr>
<tr>
 <td class="label">
 <label for="db_host">Database host:</label>
 </td>
 <td class="input">
 <input id="db_host" name="db_host" type="text" size="20" maxlength="30" value="<?php echo $cfg['db_host']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="db_user">Database user:</label>
 </td>
 <td class="input">
 <input id="db_user" name="db_user" type="text" size="20" maxlength="30" value="<?php echo $cfg['db_user']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="db_pass">Database password:</label>
 </td>
 <td class="input">
 <input id="db_pass" name="db_pass" type="text" size="20" maxlength="30" value="<?php echo $cfg['db_pass']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="db_name">Database name:</label>
 </td>
 <td class="input">
 <input id="db_name" name="db_name" type="text" size="20" maxlength="30" value="<?php echo $cfg['db_name']; ?>" />
 </td>
</tr>

<tr>
  <td class="label">
  &#160;
  </td>
  <td class="input">
  <h3>Load content modules</h3>
  </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_usr">"User" module:</label>
 </td>
 <td class="input">
 <select id="mod_usr" name="mod_usr" size="1">
  <option value="0"<?php if($cfg['mod_usr'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_usr'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_login">"Login" module:</label>
 </td>
 <td class="input">
 <select id="mod_login" name="mod_login" size="1">
  <option value="0"<?php if($cfg['mod_login'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_login'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_gen">"Genres" module:</label>
 </td>
 <td class="input">
 <select id="mod_gen" name="mod_gen" size="1">
  <option value="0"<?php if($cfg['mod_gen'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_gen'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_src">"Search" module:</label>
 </td>
 <td class="input">
 <select id="mod_src" name="mod_src" size="1">
  <option value="0"<?php if($cfg['mod_src'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_src'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_imdb">"IMDb search" module:</label>
 </td>
 <td class="input">
 <select id="mod_imdb" name="mod_imdb" size="1">
  <option value="0"<?php if($cfg['mod_imdb'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_imdb'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>
<tr>
 <td class="label">
 <label for="mod_lst">"MyList" module:</label>
 </td>
 <td class="input">
 <select id="mod_lst" name="mod_lst" size="1">
  <option value="0"<?php if($cfg['mod_lst'] == 0) {echo ' selected="selected"';} ?>>No</option>
  <option value="1"<?php if($cfg['mod_lst'] == 1) {echo ' selected="selected"';} ?>>Yes</option>
 </select>
 </td>
</tr>

<tr>
  <td class="label">
  &#160;
  </td>
  <td class="input">
  <h3>Root User</h3>
  </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_name">Alias:</label>
 </td>
 <td class="input">
 <input id="usr_name" name="usr_name" type="text" size="20" maxlength="30" value="<?php echo $cfg['usr_name']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_fname">First name:</label>
 </td>
 <td class="input">
 <input id="usr_fname" name="usr_fname" type="text" size="20" maxlength="30" value="<?php echo $cfg['usr_fname']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_lname">Last name:</label>
 </td>
 <td class="input">
 <input id="usr_lname" name="usr_lname" type="text" size="20" maxlength="30" value="<?php echo $cfg['usr_lname']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_mail">Valid email:</label>
 </td>
 <td class="input">
 <input id="usr_mail" name="usr_mail" type="text" size="20" maxlength="30" value="<?php echo $cfg['usr_mail']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_pass">Password:</label>
 </td>
 <td class="input">
 <input id="usr_pass" name="usr_pass" type="text" size="20" maxlength="30" value="<?php echo $cfg['usr_pass']; ?>" />
 </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_skin">Skin:</label>
 </td>
 <td class="input">
<select id="usr_skin" name="usr_skin" size="1">
<?php
$skins = pmc_lsdir('../skin/');
$ts = count($skins);
for($i=0;$i<$ts;$i++) {
?>
<option value="<?php echo $skins[$i]; ?>"<?php if($cfg['usr_skin'] == $skins[$i]) {echo ' selected="selected"';}?>><?php echo $skins[$i]; ?></option>
<?php
}
?>
</select> 
 </td>
</tr>
<tr>
 <td class="label">
 <label for="usr_lang">Language:</label>
 </td>
 <td class="input">
<select id="usr_lang" name="usr_lang" size="1">
<?php
$langs = pmc_lsdir('../lang/');
$tl = count($langs);
for($j=0;$j<$tl;$j++) {
?>
<option value="<?php echo $langs[$j]; ?>"<?php if($cfg['usr_lang'] == $langs[$j]) {echo ' selected="selected"';}?>><?php echo $langs[$j]; ?></option>
<?php
}
?>
</select> 
 </td>
</tr>







<tr>
  <td class="label">
  &#160;
  </td>
  <td class="input">
  <h3>Application settings</h3>
  </td>
</tr>
</table>
</form>
<?php

}

require_once 'tpl.ftr.inc.php';
?>