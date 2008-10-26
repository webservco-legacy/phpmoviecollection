<div id="chk">
<h2>Checking System</h2>
<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
  <td class="label">
  &#160;
  </td>
  <td class="input">
  <h3>Required:</h3>
  </td>
</tr>
<tr>
  <td class="label">
  Config file writable:
  </td>
  <td class="input">
  <?php
  $chk = chk_cfg_wrt('../inc/', 'cfg.inc.php');
  if($chk == 0) {echo '<span class="ok">Yes</span>';}
  else {echo '<span class="err">No</span>'; $check_err = 1;}
  ?>
  </td>
</tr>
<tr>
  <td class="label">
  Var directories writable:
  </td>
  <td class="input">
  <?php
  $chkvc = 1;
  $chkvm = 1;
  if(is_dir('../var/pic_cat/') && is_writable('../var/pic_cat')) {$chkvc = 0;}
  if(is_dir('../var/pic_mov/') && is_writable('../var/pic_mov')) {$chkvm = 0;}
  if($chkvc == 0 && $chkvm == 0) {echo '<span class="ok">Yes</span>';}
  else {echo '<span class="err">No</span>'; $check_err = 1;}
  ?>
  </td>
</tr>
<tr>
  <td class="label">
  PHP Version >= 4.4.4:
  </td>
  <td class="input">
  <?php
  if(version_compare($php_version, '4.4.4', '<')) {echo '<span class="err">Error</span>'; $check_err = 1;}
  else {echo '<span class="ok">'.$php_version.'</span>';}
  ?>
  </td>
</tr>
<tr>
  <td class="label">
  File uploads:
  </td>
  <td class="input">
  <?php
  if($php_file_uploads == 0) {echo '<span class="err">Off</span>'; $check_err = 1;}
  else {echo '<span class="ok">On</span>';}
  ?>
  </td>
</tr>
<tr>
  <td class="label">
  GD Support:
  </td>
  <td class="input">
  <?php
  if($gd_check[0] != '0') {echo '<span class="ok">Yes (' . $gd_check[0] . ')</span>';}
  else {echo '<span class="err">No</span>'; $check_err = 1;}
  ?>
  </td>
</tr>
<tr>
  <td class="label">
  FreeType Support:
  </td>
  <td class="input">
  <?php
  if($gd_check[1] != '0') {echo '<span class="ok">Yes</span>';}
  else {echo '<span class="err">No</span>'; $check_err = 1;}
  ?>
  </td>
</tr>
<tr>
  <td class="label">
  &#160;
  </td>
  <td class="input">
  <h3>Recomended:</h3>
  </td>
</tr>
<tr>
  <td class="label">
  Rewrite engine
  </td>
  <td class="input">
  <?php
  if ($mod_rewrite == 1) {echo '<span class="ok">Yes</span>';}
  else if ($mod_rewrite == 2) {echo '<span class="neu">n/a</span>';}
  else {echo '<span class="err">No</span>';}
  ?>
  </td>
</tr>
<tr>
  <td class="label">
  Short open tag
  </td>
  <td class="input">
  <?php
  if($php_short_open_tag == 0) {echo '<span class="ok">Off</span>';}
  else {echo '<span class="neu">On</span>';}
  ?>
  </td>
</tr>
<tr>
  <td class="label">
  Safe mode
  </td>
  <td class="input">
  <?php
  if($php_safe_mode == 1) {echo '<span class="ok">On</span>';}
  else {echo '<span class="neu">Off</span>';}
  ?>
  </td>
</tr>
<tr>
  <td class="label">
  Register globals
  </td>
  <td class="input">
  <?php
  if($php_register_globals == 0) {echo '<span class="ok">Off</span>';}
  else {echo '<span class="neu">On</span>';}
  ?>
  </td>
</tr>
<tr>
  <td class="label">
  Magic quotes
  </td>
  <td class="input">
  <?php
  if($php_magic_quotes_gpc == 0) {echo '<span class="ok">Off</span>';}
  else {echo '<span class="neu">On</span>';}
  ?>
  </td>
</tr>
<tr>
  <td class="label">
  Allow URL fopen
  </td>
  <td class="input">
  <?php
  if($php_allow_url_fopen == 0) {echo '<span class="ok">Off</span>';}
  else {echo '<span class="neu">On</span>';}
  ?>
  </td>
</tr>

</table>
</div>