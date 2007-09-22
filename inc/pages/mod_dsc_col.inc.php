<?php
$query_rstExistingDiscs = "SELECT * FROM `pmc_usr_dsc_col` WHERE `usr_id` = '".$_SESSION['usr_id']."' ORDER BY `disc_id` ASC";
$rstExistingDiscs = mysql_query($query_rstExistingDiscs) or die('Oups!<br>' . mysql_error());
$totalExistingDiscs = mysql_num_rows($rstExistingDiscs);
?>
<DIV CLASS="pg_title">
<?=$lnMMyDiscs . ' - ' . $lnMDiscsMod . ' - ' . $lnMDiscsModCol?>
</DIV>
<DIV CLASS="pg_subtitle">
&nbsp;
</DIV>
<DIV CLASS="pg_content">
<B>SELECT DISC</B><BR><BR>
Select an existing disc from collection to modify:
<BR>
<FORM ENCTYPE="multipart/form-data" CLASS="mod_dsc_col_form" NAME="mod_dsc_col_form" ID="mod_dsc_col_form" ACTION="<?=PMC_ROOT?>dsc_brn_3.php" METHOD="get">
<INPUT TYPE="hidden" NAME="disc_source" ID="disc_source" VALUE="1">
<SELECT CLASS="mod_dsc_col_form_sel" NAME="disc_id" ID="disc_id" SIZE="1">
<?php
for ($i=1; $i<=$totalExistingDiscs; $i++) {
    $row_rstExistingDiscs = mysql_fetch_assoc($rstExistingDiscs);
    
    $query_rstThisDiscDsc = "SELECT * FROM `pmc_dsc_discs` WHERE `usr_id` = '".$_SESSION['usr_id']."' AND `disc_id` = '".$row_rstExistingDiscs['disc_id']."' LIMIT 1";
    $rstThisDiscDsc = mysql_query($query_rstThisDiscDsc) or die('Oups!<br>' . mysql_error());
    $row_rstThisDiscDsc = mysql_fetch_assoc($rstThisDiscDsc);
    mysql_free_result($rstThisDiscDsc);
?>
<OPTION VALUE="<?=$row_rstExistingDiscs['disc_id']?>">[<?=$row_rstThisDiscDsc['disc_id']?>]&nbsp;<?=$row_rstThisDiscDsc['disc_tt']?></OPTION>
<?php    
}
mysql_free_result($rstExistingDiscs);
?>
</SELECT>
<BR>
<INPUT TYPE="submit" CLASS="mod_dsc_col_form_sub" NAME="next" ID="next" VALUE="Continue">
</FORM>
</DIV>