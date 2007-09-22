<?php
$query_rstMyPId = "SELECT `people_id` FROM `pmc_set_usr` WHERE `usr_id` = '".$usr_id."'";
$rstMyPId=mysql_query($query_rstMyPId) or die('Oups!<br>' . mysql_error());
$my_people_id = mysql_result($rstMyPId, 0);
mysql_free_result($rstMyPId);
      
$query_rstPeople = "SELECT * FROM `pmc_set_people` WHERE `people_id` != '".$my_people_id."' ORDER BY `people_id` ASC";
$rstPeople = mysql_query($query_rstPeople) or die('Oups!<br>' . mysql_error());
$totalPeople = mysql_num_rows($rstPeople);
?>
<FORM ENCTYPE="multipart/form-data" CLASS="dsc_get_2_form" NAME="dsc_get_2_form" ID="dsc_get_2_form" ACTION="" METHOD="post">
<INPUT TYPE="hidden" NAME="get_id" ID="get_id" VALUE="<?=$get_id?>">
<INPUT TYPE="hidden" NAME="usr_id" ID="usr_id" VALUE="<?=$usr_id?>">
<INPUT TYPE="hidden" NAME="disc_id" ID="disc_id" VALUE="<?=$disc_id?>">
Person:&nbsp;
<SELECT CLASS="dsc_get_2_form_sel" NAME="people_id" ID="people_id" SIZE="1">
<OPTION VALUE="0"<?php if ($people_id == '0') {echo ' SELECTED';} ?>>[] Not a person [Shop/Market/Etc]</OPTION>
<?php
for ($i=1; $i<=$totalPeople; $i++) {
  $row_rstPeople = mysql_fetch_assoc($rstPeople);
?>
<OPTION VALUE="<?=$row_rstPeople['people_id']?>"<?php if ($people_id == $row_rstPeople['people_id']) {echo ' SELECTED';} ?>><?=$row_rstPeople['people_nick_name']?>&nbsp;(<?=$row_rstPeople['people_first_name']?>&nbsp;<?=$row_rstPeople['people_last_name']?>)</OPTION>
<?php
}
mysql_free_result($rstPeople);
?>
</SELECT>
<BR>
<SCRIPT LANGUAGE="JavaScript" SRC="<?=JS_URL?>CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" ID="dp_js">
var cal1 = new CalendarPopup("dp_div");
</SCRIPT>
Date:&nbsp;
<INPUT CLASS="dsc_get_2_form_txt" TYPE="text" NAME="get_date" ID="get_date" SIZE="10" MAXLENGTH="10" VALUE="<?=$get_date?>" />
&nbsp;
<A CLASS="default" HREF="#" onClick="cal1.select(document.forms['dsc_get_2_form'].get_date,'dp_link','yyyy-MM-dd'); return false;" NAME="dp_link" ID="dp_link">select</A>
&nbsp;
<A CLASS="default" HREF="JavaScript:nodate(document.forms['dsc_get_2_form'].get_date);" NAME="dp_link_0" ID="dp_link_0">can't remember</A>
<BR>
Price:&nbsp;
<INPUT CLASS="dsc_get_2_form_txt" TYPE="text" NAME="get_price" ID="get_price" SIZE="7" MAXLENGTH="7" VALUE="<?=$get_price?>" />
<BR>
Notes:&nbsp;
<INPUT CLASS="dsc_get_2_form_txt" TYPE="text" NAME="get_notes" ID="get_notes" SIZE="40" MAXLENGTH="150" VALUE="<?=$get_notes?>" />
<BR>
<INPUT TYPE="submit" CLASS="dsc_get_2_form_sub" NAME="continue" ID="continue" VALUE="Continue">
</FORM>
<DIV ID="dp_div" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>