<?php
if ($disc_source != '0') {
  switch($disc_source) {
    case "1": {
      $source_msg = 'collection';
      break;
    }
    case "2": {
      $source_msg = 'give/sell';
      break;
    }
    case "3": {
      $source_msg = 'drop';
      break;
    }
    default: {
      $source_msg = 'n/a';
      break;
    }
  }
echo 'Disc source: ' . $source_msg;
}
?>

<FORM ENCTYPE="multipart/form-data" CLASS="dsc_brn_3_form1" NAME="dsc_brn_3_form1" ID="dsc_brn_3_form1" ACTION="" METHOD="get">
<?php
if (isset($_GET['new_disc'])) {
?>
<INPUT TYPE="hidden" NAME="new_disc" ID="new_disc" VALUE="<?=$new_disc?>">
<?php
}
else {
?>
<INPUT TYPE="hidden" NAME="disc_source" ID="disc_source" VALUE="<?=$disc_source?>">
<?php
}
?>
<INPUT TYPE="hidden" NAME="disc_id" ID="disc_id" VALUE="<?=$disc_id?>">
Please Select Disc Target:&nbsp;
<SELECT CLASS="dsc_brn_3_sel" NAME="disc_target" ID="disc_target" SIZE="1">
<OPTION VALUE="col"<?php if ($disc_target == 'col') {echo ' SELECTED';} ?>>keep in collection</OPTION>
<OPTION VALUE="giv"<?php if ($disc_target == 'giv') {echo ' SELECTED';} ?>>give it/ sell it</OPTION>
<OPTION VALUE="drp"<?php if ($disc_target == 'drp') {echo ' SELECTED';} ?>>drop it</OPTION>
</SELECT>
<BR>
<INPUT TYPE="submit" CLASS="dsc_brn_2_form_sub" NAME="continue" ID="continue" VALUE="Continue">
</FORM>