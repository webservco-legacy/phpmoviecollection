<?php
$query_rstDdb = "SELECT * FROM `pmc_dsc_ddb` ORDER BY `ddb_id` ASC";
$rstDdb = mysql_query($query_rstDdb) or die('Oups!<br>' . mysql_error());
$totalDdb = mysql_num_rows($rstDdb);


$query_rstDiscFormats = "SELECT * FROM `pmc_dsc_formats` ORDER BY `format_id` ASC";
$rstDiscFormats = mysql_query($query_rstDiscFormats) or die('Oups!<br>' . mysql_error());
$totalDiscFormats = mysql_num_rows($rstDiscFormats);

$query_rstNextDiscId = "SELECT MAX(`disc_id`) FROM `pmc_dsc_discs`";
$rstNextDiscId=mysql_query($query_rstNextDiscId) or die('Oups!<br>' . mysql_error());
$disc_id = (mysql_result($rstNextDiscId, 0)) + 1;
mysql_free_result($rstNextDiscId);
$usr_id      = $_SESSION['usr_id'];
$disc_source = '4';

$ddb_id      = '';
$disc_format = '';
$disc_tt_the = '';
$disc_tt     = '';
$disc_notes  = '';

$errMsg = '';


if (isset($_POST['ddb_id']))      {$ddb_id = $_POST['ddb_id'];}
if (isset($_POST['disc_format'])) {$disc_format = $_POST['disc_format'];}
if (isset($_POST['disc_tt_the'])) {$disc_tt_the = block_tags(trim($_POST['disc_tt_the']));}
if (isset($_POST['disc_tt']))     {$disc_tt = block_tags(trim($_POST['disc_tt']));}
if (isset($_POST['disc_notes']))  {$disc_notes = block_tags(trim($_POST['disc_notes']));}
?>
<DIV CLASS="pg_title">
<?=$lnMMyDiscs . ' - ' . $lnMDiscsAdd . ' - ' . $lnMDiscsAddOther?>
</DIV>
<DIV CLASS="pg_subtitle">
&nbsp;&nbsp;
</DIV>
<DIV CLASS="pg_content">
<?php
if (isset($_POST['continue'])) {
  $err = '0';
  if (trim($disc_tt) == '') {$errMsg = 'must have title'; $err = '1';}
  if ($err == '0') {
    $query_add_disc = "INSERT INTO `pmc_dsc_discs` (disc_id, usr_id, ddb_id, disc_format, disc_source, disc_tt_the, disc_tt, disc_notes) VALUES ('".$disc_id."', '".$usr_id."', '".$ddb_id."', '".$disc_format."', '".$disc_source."', '".$disc_tt_the."', '".$disc_tt."', '".$disc_notes."')";
        mysql_query($query_add_disc) or die('Oups!<br>' . mysql_error());
    echo 'Added disc ' . $disc_tt_the . '&nbsp;' . $disc_tt . '!';
    echo '<BR><BR>';
    echo '<A CLASS="default" HREF="'.PMC_ROOT.'dsc_oth_2.php?disc_id='.$disc_id.'">continue</A> ';
  }
  else {
    echo $errMsg . '<BR>';
    require_once INC_DIR . 'new_disc_form.inc.php';
    
  }
} // IF POST
else {
require_once INC_DIR . 'new_disc_form.inc.php';
} // IF NOT POST
?>
</DIV>