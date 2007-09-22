<?php
$query_rstThisDiscDsc = "SELECT * FROM `pmc_dsc_discs` WHERE `usr_id` = '".$_SESSION['usr_id']."' AND `disc_id` = '".$disc_id."' LIMIT 1";
$rstThisDiscDsc = mysql_query($query_rstThisDiscDsc) or die('Oups!<br>' . mysql_error());
$row_rstThisDiscDsc = mysql_fetch_assoc($rstThisDiscDsc);
mysql_free_result($rstThisDiscDsc);
?>
<FORM ENCTYPE="multipart/form-data" CLASS="dsc_brn_3_form2drp" NAME="dsc_brn_3_form2drp" ID="dsc_brn_3_form2drp" ACTION="" METHOD="post">
Selected Disc: <?=$row_rstThisDiscDsc['disc_tt']?>
<BR>
Selected target: Drop
<BR><BR>
<INPUT TYPE="hidden" NAME="dsc_drop_id" ID="dsc_drop_id" VALUE="<?=$dsc_drop_id?>">
<INPUT TYPE="hidden" NAME="usr_id" ID="usr_id" VALUE="<?=$usr_id?>">
<INPUT TYPE="hidden" NAME="disc_id" ID="disc_id" VALUE="<?=$disc_id?>">

<SCRIPT LANGUAGE="JavaScript" SRC="<?=JS_URL?>CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" ID="dp_js">
var cal1 = new CalendarPopup("dp_div");
</SCRIPT>
Date:&nbsp;
<INPUT CLASS="dsc_brn_3_form2drp_txt" TYPE="text" NAME="usr_drop_date" ID="usr_drop_date" SIZE="10" MAXLENGTH="10" VALUE="<?=$usr_drop_date?>" />
&nbsp;
<A CLASS="default" HREF="#" onClick="cal1.select(document.forms['dsc_brn_3_form2drp'].usr_drop_date,'dp_link','yyyy-MM-dd'); return false;" NAME="dp_link" ID="dp_link">select</A>
<BR>
Notes:&nbsp;
<INPUT CLASS="dsc_brn_3_form2drp_txt" TYPE="text" NAME="drop_notes" ID="drop_notes" SIZE="40" MAXLENGTH="150" VALUE="<?=$drop_notes?>" />
<BR>
<INPUT TYPE="submit" CLASS="dsc_brn_3_form2drp_sub" NAME="continue" ID="continue" VALUE="Continue">
</FORM>
<DIV ID="dp_div" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>