New Disc Model Form
<FORM ENCTYPE="multipart/form-data" CLASS="dsc_mod_form" NAME="dsc_mod_form" ID="dsc_mod_form" ACTION="" METHOD="post">
<INPUT TYPE="hidden" NAME="ddb_id" ID="ddb_id" VALUE="<?=$ddb_id?>">
Disc Type:&nbsp;
<SELECT CLASS="dsc_mod_form_sel" NAME="dtype_id" ID="dtype_id" SIZE="1">
<?php
for ($i=1; $i<=$totalDTypes; $i++) {
  $row_rstDTypes = mysql_fetch_assoc($rstDTypes);
?>
<OPTION VALUE="<?=$row_rstDTypes['dtype_id']?>"<?php if ($dtype_id == $row_rstDTypes['dtype_id']) {echo ' SELECTED';} ?>><?=$row_rstDTypes['dtype_tt']?>&nbsp;(<?=$row_rstDTypes['dtype_notes']?>)</OPTION>
<?php
}
mysql_free_result($rstDTypes);
?>
</SELECT>
<BR>
Model Name:&nbsp;
<INPUT CLASS="dsc_mod_form_txt" TYPE="text" NAME="ddb_name" ID="ddb_name" SIZE="40" MAXLENGTH="60" VALUE="<?=$ddb_name?>" />
<BR>
Disc Manufacturer:&nbsp;
<SELECT CLASS="dsc_mod_form_sel" NAME="ddb_mnf_id" ID="ddb_mnf_id" SIZE="1">
<?php
for ($i=1; $i<=$totalDMnf; $i++) {
  $row_rstDMnf = mysql_fetch_assoc($rstDMnf);
?>
<OPTION VALUE="<?=$row_rstDMnf['mnf_id']?>"<?php if ($ddb_mnf_id == $row_rstDMnf['mnf_id']) {echo ' SELECTED';} ?>><?=$row_rstDMnf['mnf_tt']?></OPTION>
<?php
}
mysql_free_result($rstDMnf);
?>
</SELECT>
<BR>
Disc Time:
<INPUT CLASS="dsc_mod_form_txt" TYPE="text" NAME="ddb_time" ID="ddb_time" SIZE="8" MAXLENGTH="8" VALUE="<?=$ddb_time?>" />
<BR>
Disc Capacity:&nbsp;
<INPUT CLASS="dsc_mod_form_txt" TYPE="text" NAME="ddb_capacity" ID="ddb_capacity" SIZE="7" MAXLENGTH="7" VALUE="<?=$ddb_capacity?>" />
&nbsp;Mb
<BR>
Disc Recording Speed:&nbsp;
<INPUT CLASS="dsc_mod_form_txt" TYPE="text" NAME="ddb_speed" ID="ddb_speed" SIZE="2" MAXLENGTH="2" VALUE="<?=$ddb_speed?>" />
&nbsp;X
<BR>
Notes:&nbsp;
<INPUT CLASS="dsc_mod_form_txt" TYPE="text" NAME="ddb_notes" ID="ddb_notes" SIZE="40" MAXLENGTH="150" VALUE="<?=$ddb_notes?>" />
<BR>
<INPUT TYPE="submit" CLASS="my_dsc_new_form_sub" NAME="continue" ID="continue" VALUE="Continue">
</FORM>