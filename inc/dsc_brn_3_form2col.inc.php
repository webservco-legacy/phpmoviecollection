<?php
$query_rstDiscCateg = "SELECT * FROM `pmc_dsc_categ` ORDER BY `categ_id` ASC";
$rstDiscCateg = mysql_query($query_rstDiscCateg) or die('Oups!<br>' . mysql_error());
$totalDiscCateg = mysql_num_rows($rstDiscCateg);

$query_rstDiscCateg2 = "SELECT * FROM `pmc_dsc_categ` ORDER BY `categ_id` ASC";
$rstDiscCateg2 = mysql_query($query_rstDiscCateg2) or die('Oups!<br>' . mysql_error());
$totalDiscCateg2 = mysql_num_rows($rstDiscCateg2);

$query_rstThisDiscDsc = "SELECT * FROM `pmc_dsc_discs` WHERE `usr_id` = '".$_SESSION['usr_id']."' AND `disc_id` = '".$disc_id."' LIMIT 1";
$rstThisDiscDsc = mysql_query($query_rstThisDiscDsc) or die('Oups!<br>' . mysql_error());
$row_rstThisDiscDsc = mysql_fetch_assoc($rstThisDiscDsc);
mysql_free_result($rstThisDiscDsc);
?>
<SCRIPT LANGUAGE="JavaScript">
function calcnum(){
var categid = document.dsc_brn_3_form2col.categ_id.options[document.dsc_brn_3_form2col.categ_id.selectedIndex].value;
<?php
for ($js=1; $js<=$totalDiscCateg2; $js++) {
  $row_rstDiscCateg2 = mysql_fetch_assoc($rstDiscCateg2);
?>
if (categid == <?=$js?>){
<?php
$query_rstCatNrJs = "SELECT MAX(`disc_cat_number`) FROM `pmc_usr_dsc_col` WHERE `categ_id` = '".$js."'";
$rstCatNrJs=mysql_query($query_rstCatNrJs) or die('Oups!<br>' . mysql_error());
$catnrjs = (mysql_result($rstCatNrJs, 0)) + 1;
$catnrjsx = substr("0000$catnrjs",-5);
mysql_free_result($rstCatNrJs);
?>
document.dsc_brn_3_form2col.disc_cat_index.value = '<?=$row_rstDiscCateg2['categ_index']?>';
document.dsc_brn_3_form2col.disc_cat_number.value = '<?=$catnrjsx?>';
}
<?php
}
?>
}
</SCRIPT>
<FORM ENCTYPE="multipart/form-data" CLASS="dsc_brn_3_form2col" NAME="dsc_brn_3_form2col" ID="dsc_brn_3_form2col" ACTION="" METHOD="post">
Selected Disc: <?=$row_rstThisDiscDsc['disc_tt']?>
<BR>
Selected target: Collection
<BR><BR>
<INPUT TYPE="hidden" NAME="new_disc" ID="new_disc" VALUE="<?=$new_disc?>">
<INPUT TYPE="hidden" NAME="dsc_col_id" ID="dsc_col_id" VALUE="<?=$dsc_col_id?>">
<INPUT TYPE="hidden" NAME="usr_id" ID="usr_id" VALUE="<?=$usr_id?>">
<INPUT TYPE="hidden" NAME="disc_id" ID="disc_id" VALUE="<?=$disc_id?>">
Disc Category:
<SELECT CLASS="dsc_brn_3_form2col_sel" NAME="categ_id" ID="categ_id" SIZE="1" onchange="calcnum()" />
<?php
for ($i=1; $i<=$totalDiscCateg; $i++) {
  $row_rstDiscCateg = mysql_fetch_assoc($rstDiscCateg);
?>
<OPTION VALUE="<?=$row_rstDiscCateg['categ_id']?>"<?php if ($categ_id == $row_rstDiscCateg['categ_id']) {echo ' SELECTED';} ?>><?=$row_rstDiscCateg['categ_tt']?>&nbsp;(<?=$row_rstDiscCateg['categ_notes']?>)</OPTION>
<?php
}
mysql_free_result($rstDiscCateg);
?>
</SELECT>
<BR>
Catalog Number:&nbsp;
<INPUT CLASS="dsc_brn_3_form2col_txt_ro" TYPE="text" NAME="disc_cat_index" ID="disc_cat_index" SIZE="3" MAXLENGTH="3" VALUE="<?=$disc_cat_index?>" READONLY />
-
<INPUT CLASS="dsc_brn_3_form2col_txt" TYPE="text" NAME="disc_cat_number" ID="disc_cat_number" SIZE="5" MAXLENGTH="5" VALUE="<?=$disc_cat_number?>" />
<BR>
<SCRIPT LANGUAGE="JavaScript" SRC="<?=JS_URL?>CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" ID="dp_js">
var cal1 = new CalendarPopup("dp_div");
</SCRIPT>
Date:&nbsp;
<INPUT CLASS="dsc_brn_3_form2col_txt" TYPE="text" NAME="usr_col_date" ID="usr_col_date" SIZE="10" MAXLENGTH="10" VALUE="<?=$usr_col_date?>" />
&nbsp;
<A CLASS="default" HREF="#" onClick="cal1.select(document.forms['dsc_brn_3_form2col'].usr_col_date,'dp_link','yyyy-MM-dd'); return false;" NAME="dp_link" ID="dp_link">select</A>

<BR>
Notes:&nbsp;
<INPUT CLASS="dsc_brn_3_form2col_txt" TYPE="text" NAME="disc_notes" ID="disc_notes" SIZE="40" MAXLENGTH="150" VALUE="<?=$disc_notes?>" />
<BR>
<INPUT TYPE="submit" CLASS="dsc_brn_3_form2col_sub" NAME="continue" ID="continue" VALUE="Continue">
&nbsp;
<INPUT TYPE="reset" CLASS="dsc_brn_3_form2col_sub" NAME="reset" ID="reset" VALUE="Reset">
</FORM>
<DIV ID="dp_div" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>