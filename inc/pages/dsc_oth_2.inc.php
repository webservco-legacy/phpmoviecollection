<?php
$query_rstNextOthId = "SELECT MAX(`other_id`) FROM `pmc_dsc_src_other`";
$rstNextOthId=mysql_query($query_rstNextOthId) or die('Oups!<br>' . mysql_error());
$other_id = (mysql_result($rstNextOthId, 0)) + 1;
mysql_free_result($rstNextOthId);

$usr_id = $_SESSION['usr_id'];

$other_date = date("Y-m-d");

$other_notes = '';

$errMsg = '';

if (isset($_POST['other_id']))      {$other_id = $_POST['other_id'];}
if (isset($_POST['usr_id']))      {$usr_id = $_POST['usr_id'];}
if (isset($_POST['disc_id']))     {$disc_id = $_POST['disc_id'];}
if (isset($_POST['other_date']))    {$other_date = block_tags(trim($_POST['other_date']));}
if (isset($_POST['other_notes']))   {$other_notes = block_tags(trim($_POST['other_notes']));}
?>
<DIV CLASS="pg_title">

<?=$lnMMyDiscs . ' - ' . $lnMDiscsAdd . ' - ' . $lnMDiscsAddOther?>
</DIV>
<DIV CLASS="pg_subtitle">
&nbsp;&nbsp;
</DIV>
<DIV CLASS="pg_content">
<B>STEP 2: WHERE DID YOU GET IT?</B><BR><BR>
<?php
if (isset($_POST['continue'])) {
  $err = '0';
  if (block_tags(trim($_POST['other_date'])) == '') {$errMsg = 'date is empty!'; $err = '1';}
  if ($err == '0') {
    $query_add_other = "INSERT INTO `pmc_dsc_src_other` (other_id, usr_id, disc_id, other_date, other_notes) VALUES ('".$other_id."', '".$usr_id."', '".$disc_id."', '".$other_date."', '".$other_notes."')";
    mysql_query($query_add_other) or die('Oups!<br>' . mysql_error());
    echo 'Added disc source!';
    echo '<BR><BR>';
    echo '<A CLASS="default" HREF="'.PMC_ROOT.'dsc_brn_3.php?disc_id='.$disc_id.'&amp;new_disc=1">continue</A> ';
  }
  else {
    echo $errMsg . '<BR>';
    require_once INC_DIR . 'dsc_oth_2_form.inc.php';
    
  }
} // IF POST
else {
require_once INC_DIR . 'dsc_oth_2_form.inc.php';
} // IF NOT POST
?>
</DIV>