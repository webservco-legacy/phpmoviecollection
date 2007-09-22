<?php
$query_rstMyPId = "SELECT `people_id` FROM `pmc_set_usr` WHERE `usr_id` = '".$usr_id."'";
$rstMyPId=mysql_query($query_rstMyPId) or die('Oups!<br>' . mysql_error());
$my_people_id = mysql_result($rstMyPId, 0);
mysql_free_result($rstMyPId);
      
$query_rstPeople = "SELECT * FROM `pmc_set_people` WHERE `people_id` != '".$my_people_id."' ORDER BY `people_id` ASC";
$rstPeople = mysql_query($query_rstPeople) or die('Oups!<br>' . mysql_error());
$totalPeople = mysql_num_rows($rstPeople);

$query_rstThisDiscDsc = "SELECT * FROM `pmc_dsc_discs` WHERE `usr_id` = '".$_SESSION['usr_id']."' AND `disc_id` = '".$disc_id."' LIMIT 1";
$rstThisDiscDsc = mysql_query($query_rstThisDiscDsc) or die('Oups!<br>' . mysql_error());
$row_rstThisDiscDsc = mysql_fetch_assoc($rstThisDiscDsc);
mysql_free_result($rstThisDiscDsc);
?>
<FORM ENCTYPE="multipart/form-data" CLASS="dsc_brn_3_form2giv" NAME="dsc_brn_3_form2giv" ID="dsc_brn_3_form2giv" ACTION="" METHOD="post">
Selected Disc: <?=$row_rstThisDiscDsc['disc_tt']?>
<BR>
Selected target: Give /Sell
<BR><BR>
<INPUT TYPE="hidden" NAME="dsc_give_id" ID="dsc_give_id" VALUE="<?=$dsc_give_id?>">
<INPUT TYPE="hidden" NAME="usr_id" ID="usr_id" VALUE="<?=$usr_id?>">
<INPUT TYPE="hidden" NAME="disc_id" ID="disc_id" VALUE="<?=$disc_id?>">
Person:
<SELECT CLASS="dsc_brn_3_form2giv_sel" NAME="people_id" ID="people_id" SIZE="1">
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
Disc price:&nbsp;
<INPUT CLASS="dsc_brn_3_form2giv_txt" TYPE="text" NAME="disc_price" ID="disc_price" SIZE="7" MAXLENGTH="7" VALUE="<?=$disc_price?>" />
<BR>
<SCRIPT LANGUAGE="JavaScript" SRC="<?=JS_URL?>CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" ID="dp_js">
var cal1 = new CalendarPopup("dp_div");
</SCRIPT>
Date:&nbsp;
<INPUT CLASS="dsc_brn_3_form2giv_txt" TYPE="text" NAME="usr_give_date" ID="usr_give_date" SIZE="10" MAXLENGTH="10" VALUE="<?=$usr_give_date?>" />
&nbsp;
<A CLASS="default" HREF="#" onClick="cal1.select(document.forms['dsc_brn_3_form2giv'].usr_give_date,'dp_link','yyyy-MM-dd'); return false;" NAME="dp_link" ID="dp_link">select</A>
<BR>
Notes:&nbsp;
<INPUT CLASS="dsc_brn_3_form2giv_txt" TYPE="text" NAME="give_notes" ID="give_notes" SIZE="40" MAXLENGTH="150" VALUE="<?=$give_notes?>" />
<BR>
<INPUT TYPE="submit" CLASS="dsc_brn_3_form2giv_sub" NAME="continue" ID="continue" VALUE="Continue">
</FORM>
<DIV ID="dp_div" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>