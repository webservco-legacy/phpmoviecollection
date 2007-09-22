<?php
$query_rstNextMagId = "SELECT MAX(`mag_id`) FROM `pmc_dsc_src_mag`";
$rstNextMagId=mysql_query($query_rstNextMagId) or die('Oups!<br>' . mysql_error());
$mag_id = (mysql_result($rstNextMagId, 0)) + 1;
mysql_free_result($rstNextMagId);

$usr_id = $_SESSION['usr_id'];

$magazine_id = '0';

$issue_id = '0';

$mag_date = date("Y-m-d");

$mag_notes = '';

$errMsg = '';

if (isset($_POST['mag_id']))      {$mag_id = $_POST['mag_id'];}
if (isset($_POST['usr_id']))      {$usr_id = $_POST['usr_id'];}
if (isset($_POST['disc_id']))     {$disc_id = $_POST['disc_id'];}
if (isset($_POST['magazine_id'])) {$magazine_id = $_POST['magazine_id'];}
if (isset($_POST['issue_id']))    {$issue_id = $_POST['issue_id'];}
if (isset($_POST['mag_date']))    {$mag_date = block_tags(trim($_POST['mag_date']));}
if (isset($_POST['mag_notes']))   {$mag_notes = block_tags(trim($_POST['mag_notes']));}
?>
<DIV CLASS="pg_title">

<?=$lnMMyDiscs . ' - ' . $lnMDiscsAdd . ' - ' . $lnMDiscsAddMag?>
</DIV>
<DIV CLASS="pg_subtitle">
&nbsp;&nbsp;
</DIV>
<DIV CLASS="pg_content">
<B>STEP 2: WHERE DID YOU GET IT?</B><BR><BR>
<?php
if (isset($_POST['continue'])) {
  $err = '0';
  if (block_tags(trim($_POST['mag_date'])) == '') {$errMsg = 'date is empty!'; $err = '1';}
  if ($err == '0') {
    $query_add_mag = "INSERT INTO `pmc_dsc_src_mag` (mag_id, usr_id, disc_id, magazine_id, issue_id, mag_date, mag_notes) VALUES ('".$mag_id."', '".$usr_id."', '".$disc_id."', '".$magazine_id."', '".$issue_id."', '".$mag_date."', '".$mag_notes."')";
    mysql_query($query_add_mag) or die('Oups!<br>' . mysql_error());
    echo 'Added disc source!';
    echo '<BR><BR>';
    echo '<A CLASS="default" HREF="'.PMC_ROOT.'dsc_brn_3.php?disc_id='.$disc_id.'&amp;new_disc=1">continue</A> ';
  }
  else {
    echo $errMsg . '<BR>';
    require_once INC_DIR . 'dsc_mag_2_form.inc.php';
    
  }
} // IF POST
else {
require_once INC_DIR . 'dsc_mag_2_form.inc.php';
} // IF NOT POST
?>
</DIV>