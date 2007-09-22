<FORM ENCTYPE="multipart/form-data" CLASS="my_dsc_new_form" NAME="my_dsc_new_form" ID="my_dsc_new_form" ACTION="" METHOD="post">
<INPUT TYPE="hidden" NAME="disc_id" ID="disc_id" VALUE="<?=$disc_id?>">
<INPUT TYPE="hidden" NAME="usr_id" ID="usr_id" VALUE="<?=$usr_id?>">
Disc Model:&nbsp;
<SELECT CLASS="my_dsc_new_form_sel" NAME="ddb_id" ID="ddb_id" SIZE="1">
<?php
for ($i=1; $i<=$totalDdb; $i++) {
  $row_rstDdb = mysql_fetch_assoc($rstDdb);
?>
<OPTION VALUE="<?=$row_rstDdb['ddb_id']?>"<?php if ($ddb_id == $row_rstDdb['ddb_id']) {echo ' SELECTED';} ?>><?=$row_rstDdb['ddb_name']?>&nbsp;(<?=$row_rstDdb['ddb_notes']?>)</OPTION>
<?php
}
mysql_free_result($rstDdb);
?>
</SELECT>
&nbsp;<A CLASS="default" HREF="Javascript:loadProgram('<?=PMC_ROOT?>dsc_mod.php?act=add&amp;popup=1','new_disc_model','300','600','50','50','no');">new</A>
<BR>
Disc Format:&nbsp;
<SELECT CLASS="my_dsc_new_form_sel" NAME="disc_format" ID="disc_format" SIZE="1">
<?php
for ($j=1; $j<=$totalDiscFormats; $j++) {
  $row_rstDiscFormats = mysql_fetch_assoc($rstDiscFormats);
?>
<OPTION VALUE="<?=$row_rstDiscFormats['format_id']?>"<?php if ($disc_format == $row_rstDiscFormats['format_id']) {echo ' SELECTED';} ?>><?=$row_rstDiscFormats['format_tt']?></OPTION>
<?php
}
mysql_free_result($rstDiscFormats);
?>
</SELECT>
<INPUT TYPE="hidden" NAME="disc_source" ID="disc_source" VALUE="<?=$disc_source?>">
<BR>
Disc Title:
<INPUT CLASS="my_dsc_new_form_txt" TYPE="text" NAME="disc_tt_the" ID="disc_tt_the" SIZE="3" MAXLENGTH="3" VALUE="<?=$disc_tt_the?>" />
&nbsp;
<INPUT CLASS="my_dsc_new_form_txt" TYPE="text" NAME="disc_tt" ID="disc_tt" SIZE="40" MAXLENGTH="60" VALUE="<?=$disc_tt?>" />
<BR>
Notes:
<INPUT CLASS="my_dsc_new_form_txt" TYPE="text" NAME="disc_notes" ID="disc_notes" SIZE="40" MAXLENGTH="150" VALUE="<?=$disc_notes?>" />
<BR>
<INPUT TYPE="submit" CLASS="my_dsc_new_form_sub" NAME="continue" ID="continue" VALUE="Continue">
</FORM>