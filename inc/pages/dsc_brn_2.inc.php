<?php
$query_rstNextBurnId = "SELECT MAX(`burn_id`) FROM `pmc_dsc_src_burn`";
$rstNextBurnId=mysql_query($query_rstNextBurnId) or die('Oups!<br>' . mysql_error());
$burn_id = (mysql_result($rstNextBurnId, 0)) + 1;
mysql_free_result($rstNextBurnId);

$usr_id = $_SESSION['usr_id'];

$query_rstRecorders = "SELECT * FROM `pmc_dsc_recorders` ORDER BY `recorder_id` DESC";
$rstRecorders = mysql_query($query_rstRecorders) or die('Oups!<br>' . mysql_error());
$totalRecorders = mysql_num_rows($rstRecorders);

$recorder_id = '';

$burn_date = date("Y-m-d");

$burn_closed = '0';

$burn_notes = '';

$errMsg = '';

if (isset($_POST['new_disc']))     {$new_disc = $_POST['new_disc'];}
if (isset($_POST['burn_id']))     {$burn_id = $_POST['burn_id'];}
if (isset($_POST['usr_id']))     {$usr_id = $_POST['usr_id'];}
if (isset($_POST['disc_id']))     {$disc_id = $_POST['disc_id'];}
if (isset($_POST['recorder_id']))     {$recorder_id = $_POST['recorder_id'];}
if (isset($_POST['burn_date']))     {$burn_date = block_tags(trim($_POST['burn_date']));}
if (isset($_POST['burn_closed']))     {$burn_closed = $_POST['burn_closed'];}
if (isset($_POST['burn_notes']))     {$burn_notes = block_tags(trim($_POST['burn_notes']));}
?>
<DIV CLASS="pg_title">
<?=$lnMMyDiscs . ' - ' . $lnMDiscsRecSessions . ' - ' . $lnMDiscsRecNewSession?>
</DIV>
<DIV CLASS="pg_subtitle">
&nbsp;&nbsp;
</DIV>
<DIV CLASS="pg_content">
<B>STEP 2: ADD SESSION</B><BR><BR>
<?php
if (isset($_POST['continue'])) {
  $err = '0';
  if (block_tags(trim($_POST['burn_date'])) == '') {$errMsg = 'date is empty!'; $err = '1';}
  if ($err == '0') {
    $burn_multi_session = '1';
    if ($new_disc == '1' && $burn_closed == '1') {$burn_multi_session = '0';}
    $query_add_session = "INSERT INTO `pmc_dsc_src_burn` (burn_id, usr_id, disc_id, recorder_id, burn_date, burn_multi_session, burn_closed, burn_notes) VALUES ('".$burn_id."', '".$usr_id."', '".$disc_id."', '".$recorder_id."', '".$burn_date."', '".$burn_multi_session."', '".$burn_closed."', '".$burn_notes."')";
    mysql_query($query_add_session) or die('Oups!<br>' . mysql_error());
    echo 'Added session to disc!';
    if ($burn_closed == '1') {echo '<BR><BR>PS: You closed this disc, you can not add any more sessions.<BR>';}
    echo '<BR><BR>';
    if ($new_disc == '0') {
      $query_rstDest1 = "SELECT * FROM `pmc_usr_dsc_col` WHERE `usr_id` = '".$usr_id."' AND `disc_id` = '".$disc_id."' LIMIT 1";
      $rstDest1 = mysql_query($query_rstDest1) or die('Oups!<br>' . mysql_error());
      $totalDest1 = mysql_num_rows($rstDest1);
      mysql_free_result($rstDest1);
      
      $query_rstDest2 = "SELECT * FROM `pmc_usr_dsc_give` WHERE `usr_id` = '".$usr_id."' AND `disc_id` = '".$disc_id."' LIMIT 1";
      $rstDest2 = mysql_query($query_rstDest2) or die('Oups!<br>' . mysql_error());
      $totalDest2 = mysql_num_rows($rstDest2);
      mysql_free_result($rstDest2);
      
      $query_rstDest3 = "SELECT * FROM `pmc_usr_dsc_drop` WHERE `usr_id` = '".$usr_id."' AND `disc_id` = '".$disc_id."' LIMIT 1";
      $rstDest3 = mysql_query($query_rstDest3) or die('Oups!<br>' . mysql_error());
      $totalDest3 = mysql_num_rows($rstDest3);
      mysql_free_result($rstDest3);
      $disc_source = '';
      if ($totalDest1 != '0') {$disc_source = '1';}
      else if ($totalDest2 != '0') {$disc_source = '2';}
      else if ($totalDest3 != '0') {$disc_source = '3';}
      echo '<A CLASS="default" HREF="'.PMC_ROOT.'dsc_brn_3.php?disc_id='.$disc_id.'&amp;disc_source='.$disc_source.'">modify</A> ';
      echo '&nbsp;or&nbsp;<A CLASS="default" HREF="'.PMC_ROOT.'">finish</A>';
    }
    else {
      echo '<A CLASS="default" HREF="'.PMC_ROOT.'dsc_brn_3.php?disc_id='.$disc_id.'&amp;new_disc='.$new_disc.'">continue</A> ';
    }
  }
  else {
    echo $errMsg . '<BR>';
    require_once INC_DIR . 'dsc_brn_2_form.inc.php';
    
  }
} // IF POST
else {
require_once INC_DIR . 'dsc_brn_2_form.inc.php';
} // IF NOT POST
?>
</DIV>