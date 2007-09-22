<?php
$query_rstDTypes = "SELECT * FROM `pmc_dsc_types` ORDER BY `dtype_id` ASC";
$rstDTypes = mysql_query($query_rstDTypes) or die('Oups!<br>' . mysql_error());
$totalDTypes = mysql_num_rows($rstDTypes);

$query_rstDMnf = "SELECT * FROM `pmc_dsc_mnf` ORDER BY `mnf_id` ASC";
$rstDMnf = mysql_query($query_rstDMnf) or die('Oups!<br>' . mysql_error());
$totalDMnf = mysql_num_rows($rstDMnf);

$query_rstNextDdbId = "SELECT MAX(`ddb_id`) FROM `pmc_dsc_ddb`";
$rstNextDdbId=mysql_query($query_rstNextDdbId) or die('Oups!<br>' . mysql_error());
$ddb_id = (mysql_result($rstNextDdbId, 0)) + 1;
mysql_free_result($rstNextDdbId);

$dtype_id     = '';
$ddb_name     = '';
$ddb_mnf_id    = '';
$ddb_time     = '00:00:00';
$ddb_capacity = '';
$ddb_speed    = '';
$ddb_notes    = '';

$errMsg = '';

if (isset($_POST['ddb_id']))       {$ddb_id = $_POST['ddb_id'];}
if (isset($_POST['dtype_id']))     {$dtype_id = $_POST['dtype_id'];}
if (isset($_POST['ddb_name']))     {$ddb_name = block_tags(trim($_POST['ddb_name']));}
if (isset($_POST['ddb_mnf_id']))   {$ddb_mnf_id = $_POST['ddb_mnf_id'];}
if (isset($_POST['ddb_time']))     {$ddb_time = block_tags(trim($_POST['ddb_time']));}
if (isset($_POST['ddb_capacity'])) {$ddb_capacity = block_tags(trim($_POST['ddb_capacity']));}
if (isset($_POST['ddb_speed']))    {$ddb_speed = block_tags(trim($_POST['ddb_speed']));}
if (isset($_POST['ddb_notes']))    {$ddb_notes = block_tags(trim($_POST['ddb_notes']));}
?>
<DIV CLASS="pg_title">
<?=$lnMMyDiscs . ' - ' . $lnMDiscsModel . ' - ' . $lnMDiscsModelAdd?>
</DIV>
<DIV CLASS="pg_subtitle">
&nbsp;&nbsp;
</DIV>
<DIV CLASS="pg_content">
<?php
if (isset($_POST['continue'])) {
  $err = '0';
  if (trim($ddb_name) == '') {$errMsg = 'must have title'; $err = '1';}
  if ($err == '0') {
    $query_add_ddb = "INSERT INTO `pmc_dsc_ddb` (ddb_id, dtype_id, ddb_name, ddb_mnf_id, ddb_time, ddb_capacity, ddb_speed, ddb_notes) VALUES ('".$ddb_id."', '".$dtype_id."', '".$ddb_name."', '".$ddb_mnf_id."', '".$ddb_time."', '".$ddb_capacity."', '".$ddb_speed."', '".$ddb_notes."')";
		mysql_query($query_add_ddb) or die('Oups!<br>' . mysql_error());
    echo 'Added disc model ' . $ddb_name . '!';
    echo '<BR><BR>';
    echo '<A CLASS="default" HREF="'.PMC_ROOT.'dsc_mod.php?act=add&amp;popup='.$popup.'">add another</A> ';
  }
  else {
    echo $errMsg . '<BR>';
    require_once INC_DIR . 'dsc_mod_form.inc.php';
    
  }
} // IF POST
else {
require_once INC_DIR . 'dsc_mod_form.inc.php';
} // IF NOT POST
?>
<?php if ($popup != '0') {  ?>
<BR><BR>
<A CLASS="default" HREF="Javascript:closeProgram();">close and refresh</A>
<?php } ?>
</DIV>