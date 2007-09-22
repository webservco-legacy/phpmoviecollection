<FORM ENCTYPE="multipart/form-data" CLASS="dsc_brn_2_form" NAME="dsc_brn_2_form" ID="dsc_brn_2_form" ACTION="" METHOD="post">
<INPUT TYPE="hidden" NAME="new_disc" ID="new_disc" VALUE="<?=$new_disc?>">
<INPUT TYPE="hidden" NAME="burn_id" ID="burn_id" VALUE="<?=$burn_id?>">
<INPUT TYPE="hidden" NAME="usr_id" ID="usr_id" VALUE="<?=$usr_id?>">
<INPUT TYPE="hidden" NAME="disc_id" ID="disc_id" VALUE="<?=$disc_id?>">
Recorder:&nbsp;
<SELECT CLASS="dsc_brn_2_form_sel" NAME="recorder_id" ID="recorder_id" SIZE="1">
<?php
for ($i=1; $i<=$totalRecorders; $i++) {
  $row_rstRecorders = mysql_fetch_assoc($rstRecorders);
?>
<OPTION VALUE="<?=$row_rstRecorders['recorder_id']?>"<?php if ($recorder_id == $row_rstRecorders['recorder_id']) {echo ' SELECTED';} ?>><?=$row_rstRecorders['recorder_name']?>&nbsp;(<?=$row_rstRecorders['recorder_model']?>)</OPTION>
<?php
}
mysql_free_result($rstRecorders);
?>
</SELECT>
<BR>
<SCRIPT LANGUAGE="JavaScript" SRC="<?=JS_URL?>CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" ID="dp_js">
var cal1 = new CalendarPopup("dp_div");
</SCRIPT>
Date:&nbsp;
<INPUT CLASS="dsc_brn_2_form_txt" TYPE="text" NAME="burn_date" ID="burn_date" SIZE="10" MAXLENGTH="10" VALUE="<?=$burn_date?>" />
&nbsp;
<A CLASS="default" HREF="#" onClick="cal1.select(document.forms['dsc_brn_2_form'].burn_date,'dp_link','yyyy-MM-dd'); return false;" NAME="dp_link" ID="dp_link">select</A>
&nbsp;
<A CLASS="default" HREF="JavaScript:nodate(document.forms['dsc_brn_2_form'].burn_date);" NAME="dp_link_0" ID="dp_link_0">can't remember</A>
<BR>
Close disc:&nbsp;
<INPUT CLASS="dsc_brn_2_form_chk" TYPE="checkbox" NAME="burn_closed" ID="burn_closed" VALUE="1"<?php if ($burn_closed == '1') {echo ' CHECKED';} ?>>
<BR>
Notes:&nbsp;
<INPUT CLASS="dsc_brn_2_form_txt" TYPE="text" NAME="burn_notes" ID="burn_notes" SIZE="40" MAXLENGTH="150" VALUE="<?=$burn_notes?>" />
<BR>
<INPUT TYPE="submit" CLASS="dsc_brn_2_form_sub" NAME="continue" ID="continue" VALUE="Continue">
</FORM>
<DIV ID="dp_div" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>