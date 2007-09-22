<?php
$query_rstMyPId = "SELECT `people_id` FROM `pmc_set_usr` WHERE `usr_id` = '".$usr_id."'";
$rstMyPId=mysql_query($query_rstMyPId) or die('Oups!<br>' . mysql_error());
$my_people_id = mysql_result($rstMyPId, 0);
mysql_free_result($rstMyPId);
      
$query_rstPeople = "SELECT * FROM `pmc_set_people` WHERE `people_id` != '".$my_people_id."' ORDER BY `people_id` ASC";
$rstPeople = mysql_query($query_rstPeople) or die('Oups!<br>' . mysql_error());
$totalPeople = mysql_num_rows($rstPeople);
?>
<FORM ENCTYPE="multipart/form-data" CLASS="dsc_mag_2_form" NAME="dsc_mag_2_form" ID="dsc_mag_2_form" ACTION="" METHOD="post">
<INPUT TYPE="hidden" NAME="mag_id" ID="mag_id" VALUE="<?=$mag_id?>">
<INPUT TYPE="hidden" NAME="usr_id" ID="usr_id" VALUE="<?=$usr_id?>">
<INPUT TYPE="hidden" NAME="disc_id" ID="disc_id" VALUE="<?=$disc_id?>">
magazine_id:&nbsp;
<INPUT CLASS="dsc_mag_2_form_txt" TYPE="text" NAME="magazine_id" ID="magazine_id" SIZE="1" MAXLENGTH="5" VALUE="<?=$magazine_id?>" />
<BR>
issue_id:&nbsp;
<INPUT CLASS="dsc_mag_2_form_txt" TYPE="text" NAME="issue_id" ID="issue_id" SIZE="1" MAXLENGTH="5" VALUE="<?=$issue_id?>" />
<BR>
<SCRIPT LANGUAGE="JavaScript" SRC="<?=JS_URL?>CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" ID="dp_js">
var cal1 = new CalendarPopup("dp_div");
</SCRIPT>
Date:&nbsp;
<INPUT CLASS="dsc_mag_2_form_txt" TYPE="text" NAME="mag_date" ID="mag_date" SIZE="10" MAXLENGTH="10" VALUE="<?=$mag_date?>" />
&nbsp;
<A CLASS="default" HREF="#" onClick="cal1.select(document.forms['dsc_mag_2_form'].mag_date,'dp_link','yyyy-MM-dd'); return false;" NAME="dp_link" ID="dp_link">select</A>
&nbsp;
<A CLASS="default" HREF="JavaScript:nodate(document.forms['dsc_mag_2_form'].mag_date);" NAME="dp_link_0" ID="dp_link_0">can't remember</A>
<BR>
Notes:&nbsp;
<INPUT CLASS="dsc_mag_2_form_txt" TYPE="text" NAME="mag_notes" ID="mag_notes" SIZE="40" MAXLENGTH="150" VALUE="<?=$mag_notes?>" />
<BR>
<INPUT TYPE="submit" CLASS="dsc_mag_2_form_sub" NAME="continue" ID="continue" VALUE="Continue">
</FORM>
<DIV ID="dp_div" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>