<?php
$ses_disc_id = '';
if (isset($_POST['ses_disc_id'])) {$ses_disc_id = $_POST['ses_disc_id'];}

$query_rstExistingDiscs = "SELECT * FROM `pmc_dsc_discs` WHERE `usr_id` = '".$_SESSION['usr_id']."' AND `disc_source` = '1' ORDER BY `disc_tt` ASC";
$rstExistingDiscs = mysql_query($query_rstExistingDiscs) or die('Oups!<br>' . mysql_error());
$totalExistingDiscs = mysql_num_rows($rstExistingDiscs);
?>
<DIV CLASS="pg_title">
<?=$lnMMyDiscs . ' - ' . $lnMDiscsRecSessions . ' - ' . $lnMDiscsRecViewSessions?>
</DIV>
<DIV CLASS="pg_subtitle">
&nbsp;
</DIV>
<DIV CLASS="pg_content">
<?php
if (isset($_POST['continue'])) {
?>
<?php
  $query_rstThisDisc = "SELECT * FROM `pmc_dsc_discs` WHERE `usr_id` = '".$_SESSION['usr_id']."' AND `disc_id` = '".$ses_disc_id."' LIMIT 1";
  $rstThisDisc = mysql_query($query_rstThisDisc) or die('Oups!<br>' . mysql_error());
  $row_rstThisDisc = mysql_fetch_assoc($rstThisDisc);
  mysql_free_result($rstThisDisc);
  
  $query_rstBurnSessions = "SELECT * FROM `pmc_dsc_src_burn` WHERE `usr_id` = '".$_SESSION['usr_id']."' AND `disc_id` = '".$ses_disc_id."' ORDER BY `burn_date` ASC";
  $rstBurnSessions = mysql_query($query_rstBurnSessions) or die('Oups!<br>' . mysql_error());
  $totalBurnSessions = mysql_num_rows($rstBurnSessions);
?>
<B>Disc Info:</B><BR><BR>
disc_id = <?=$ses_disc_id?> / <?=$row_rstThisDisc['disc_tt_the']?>&nbsp;<?=$row_rstThisDisc['disc_tt']?>
<BR>
Sessions:
<BR>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="3" ALIGN="center">
<TR>
  <TD>
    nr.
  </TD>
  <TD>
    recorder
  </TD>
  <TD>
    date
  </TD>
  <TD>
    closed
  </TD>
  <TD>
    notes
  </TD>
</TR>
<?php  
  $disc_multisession = '';
  $disc_closed = '';
  for ($j=1; $j<=$totalBurnSessions; $j++) {
    $row_rstBurnSessions = mysql_fetch_assoc($rstBurnSessions);
    if ($j == $totalBurnSessions) {
      if ($row_rstBurnSessions['burn_multi_session'] == '1') {$disc_multisession = 'yes';} else {$disc_multisession = 'no';}
      if ($row_rstBurnSessions['burn_closed'] == '1') {$disc_closed = 'yes';} else {$disc_closed = 'no';}
    }
?>
<TR>
  <TD>
    <?=$j?>
  </TD>
  <TD>
    <?=$row_rstBurnSessions['recorder_id']?>
  </TD>
  <TD>
    <?=$row_rstBurnSessions['burn_date']?>
  </TD>
  <TD>
    <?=$row_rstBurnSessions['burn_closed']?>
  </TD>
  <TD>
    <?=$row_rstBurnSessions['burn_notes']?>
  </TD>
</TR>
<?php
  }
  mysql_free_result($rstBurnSessions);
?>
</TABLE>
multisession: <?=$disc_multisession?>
<BR>
closed: <?=$disc_closed?>
<BR><BR>
<?php
$cont_msg = 'disc is open, you can add another session!';
$cont_ok  = 1;
if ($disc_closed == 'yes') {
  $cont_msg = 'Disc is closed, you can\'t add another session';
  $cont_ok  = 0;
}
?>
<?=$cont_msg?>
<BR>
<?php if ($cont_ok == '1') { ?>
<A CLASS="default" HREF="<?=PMC_ROOT?>dsc_brn_2.php?disc_id=<?=$ses_disc_id?>&amp;new_disc=0">continue</A>
<?php } ?>
&nbsp;&nbsp;&nbsp;
<A CLASS="default" HREF="<?=PMC_ROOT?>my_discs_ses.php?act=view">go back</A>
<?php
}
else {
?>
<B>STEP 1: SELECT DISC</B><BR><BR>
Select an existing disc to view session information:
<BR>
<FORM ENCTYPE="multipart/form-data" CLASS="my_dsc_ses_add_form" NAME="my_dsc_ses_add_form" ID="my_dsc_ses_add_form" ACTION="" METHOD="post">
<SELECT CLASS="my_dsc_ses_add_form_sel" NAME="ses_disc_id" ID="ses_disc_id" SIZE="1">
<?php
for ($i=1; $i<=$totalExistingDiscs; $i++) {
    $row_rstExistingDiscs = mysql_fetch_assoc($rstExistingDiscs);
?>
<OPTION VALUE="<?=$row_rstExistingDiscs['disc_id']?>"<?php if ($ses_disc_id == $row_rstExistingDiscs['disc_id']) {echo ' SELECTED';} ?>>[<?=$row_rstExistingDiscs['disc_id']?>]&nbsp;<?=$row_rstExistingDiscs['disc_tt']?></OPTION>
<?php    
}
mysql_free_result($rstExistingDiscs);
?>
</SELECT>
<BR>
<INPUT TYPE="submit" CLASS="my_dsc_ses_add_form_sub" NAME="continue" ID="continue" VALUE="Continue">
</FORM>
<BR><BR>
Or, <A CLASS="default" HREF="<?=PMC_ROOT?>add_disc.php?add=burn">create a new disc</A>
<?php
}
?>
</DIV>