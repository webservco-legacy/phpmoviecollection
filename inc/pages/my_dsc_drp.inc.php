<?php
$s_page = 1;
if(isset($_GET['s_page'])) { $s_page = $_GET['s_page']; }
                
$rowsPerPage = 5;
if(isset($_POST['items'])) { $rowsPerPage = $_POST['items']; }
else if(isset($_GET['items'])) { $rowsPerPage = $_GET['items']; }

$offset = ($s_page - 1) * $rowsPerPage;

$query_rstDiscsX = "SELECT * FROM `pmc_usr_dsc_drop` WHERE `usr_id` = '".$_SESSION['usr_id']."' ORDER BY `dsc_drop_id` ASC";
$rstDiscsX = mysql_query($query_rstDiscsX) or die('Oups!<br>' . mysql_error());
$totalDiscsX = mysql_num_rows($rstDiscsX);
mysql_free_result($rstDiscsX);

$query_rstDiscs = $query_rstDiscsX . " LIMIT $offset, $rowsPerPage";
$rstDiscs = mysql_query($query_rstDiscs) or die('Oups!<br>' . mysql_error());
$totalDiscs = mysql_num_rows($rstDiscs);
?>
<DIV CLASS="pg_title">
<?=$lnMMyDiscs . ' - ' . $lnMDiscsDrop?>
</DIV>
<DIV CLASS="pg_subtitle">
<TABLE CELLPADDING="0" CELLSPACING="0" ALIGN="center" BORDER="0">
<TR>
    <TD CLASS="dsc_tt_01">
        <?=$lnMdTotalDiscs?>&#58;
    </TD>
    <TD CLASS="dsc_tt_02">
        <?=$totalDiscsX?>
    </TD>
</TR>
</TABLE>
</DIV>
<BR>
<DIV CLASS="pg_content">
<?php
if ($s_page == '1' && $totalDiscsX != '0') {
?>
<FORM NAME="items_form" ID="items_form" ACTION="" METHOD="post">
<SELECT CLASS="form_items_box" NAME="items" ID="items" SIZE="1">
    <OPTION VALUE="1"<?php if ($rowsPerPage == '1') {echo ' SELECTED';} ?>>1</OPTION>
    <OPTION VALUE="5"<?php if ($rowsPerPage == '5') {echo ' SELECTED';} ?>>5</OPTION>
    <OPTION VALUE="10"<?php if ($rowsPerPage == '10') {echo ' SELECTED';} ?>>10</OPTION>
    <OPTION VALUE="15"<?php if ($rowsPerPage == '15') {echo ' SELECTED';} ?>>15</OPTION>
    <OPTION VALUE="20"<?php if ($rowsPerPage == '20') {echo ' SELECTED';} ?>>20</OPTION>
    <OPTION VALUE="25"<?php if ($rowsPerPage == '25') {echo ' SELECTED';} ?>>25</OPTION>
	<OPTION VALUE="30"<?php if ($rowsPerPage == '30') {echo ' SELECTED';} ?>>30</OPTION>
	<OPTION VALUE="35"<?php if ($rowsPerPage == '35') {echo ' SELECTED';} ?>>35</OPTION>
	<OPTION VALUE="40"<?php if ($rowsPerPage == '40') {echo ' SELECTED';} ?>>40</OPTION>
	<OPTION VALUE="45"<?php if ($rowsPerPage == '45') {echo ' SELECTED';} ?>>45</OPTION>
	<OPTION VALUE="50"<?php if ($rowsPerPage == '50') {echo ' SELECTED';} ?>>50</OPTION>
	<OPTION VALUE="100"<?php if ($rowsPerPage == '100') {echo ' SELECTED';} ?>>100</OPTION>
	<OPTION VALUE="150"<?php if ($rowsPerPage == '150') {echo ' SELECTED';} ?>>150</OPTION>
	<OPTION VALUE="200"<?php if ($rowsPerPage == '200') {echo ' SELECTED';} ?>>200</OPTION>
	<OPTION VALUE="250"<?php if ($rowsPerPage == '250') {echo ' SELECTED';} ?>>250</OPTION>
</SELECT>
<INPUT TYPE="submit" CLASS="form_items_go" NAME="go" ID="go" VALUE="Go">
</FORM>
<?php
}
?>
<?php
for ($i=1; $i<=$totalDiscs; $i++) {
    $row_rstDiscs = mysql_fetch_assoc($rstDiscs);
    
    $query_rstOneDisc = "SELECT * FROM `pmc_dsc_discs` WHERE disc_id = '".$row_rstDiscs['disc_id']."' LIMIT 1";
    $rstOneDisc = mysql_query($query_rstOneDisc) or die('Oups!<br>' . mysql_error());
    $row_rstOneDisc = mysql_fetch_assoc($rstOneDisc);
    mysql_free_result($rstOneDisc);

    $disc_souce_index = $row_rstOneDisc['disc_source'];
    switch($disc_souce_index) {
      case "1": {
        $disc_source = 'burn';
        $disc_source_display = $lnMdSrcBurn;
        break;
      }
      default: {
        $disc_source = 'no_source';
        $disc_source_display = $lnMdNoSrc;
        break;
      }
    }
    
    $query_rstDiscFormat = "SELECT * FROM `pmc_dsc_formats` WHERE format_id = '".$row_rstOneDisc['disc_format']."' LIMIT 1";
    $rstDiscFormat = mysql_query($query_rstDiscFormat) or die('Oups!<br>' . mysql_error());
    $row_rstDiscFormat = mysql_fetch_assoc($rstDiscFormat);
    mysql_free_result($rstDiscFormat);
    
    $query_rstDiscDDB = "SELECT * FROM `pmc_dsc_ddb` WHERE ddb_id = '".$row_rstOneDisc['ddb_id']."' LIMIT 1";
    $rstDiscDDB = mysql_query($query_rstDiscDDB) or die('Oups!<br>' . mysql_error());
    $row_rstDiscDDB = mysql_fetch_assoc($rstDiscDDB);
    mysql_free_result($rstDiscDDB);
    
    $query_rstDiscType = "SELECT * FROM `pmc_dsc_types` WHERE dtype_id = '".$row_rstDiscDDB['dtype_id']."' LIMIT 1";
    $rstDiscType = mysql_query($query_rstDiscType) or die('Oups!<br>' . mysql_error());
    $row_rstDiscType = mysql_fetch_assoc($rstDiscType);
    mysql_free_result($rstDiscType);

    if ($row_rstOneDisc['disc_tt_the'] != '') {
        $disc_title = $row_rstOneDisc['disc_tt_the'] . '&nbsp;' . $row_rstOneDisc['disc_tt'];
    }
    else {
        $disc_title = $row_rstOneDisc['disc_tt'];
    }
    

?>
<BR>
<TABLE CLASS="dsc" CELLPADDING="0" CELLSPACING="0" ALIGN="<?=$defaultTableAlign?>">
<TR>
  <TD CLASS="default">
    <TABLE CELLPADDING="0" CELLSPACING="0" ALIGN="center">
    <TR>
      <TD CLASS="dsc_title">
        &nbsp;<?=$disc_title?>&nbsp;
      </TD>
      <TD CLASS="default">
        <TABLE CELLPADDING="0" CELLSPACING="0" ALIGN="center">
        <TR>
          <TD CLASS="dsc_categ">
          &nbsp;
          </TD>
        </TR>
        <TR>
          <TD CLASS="dsc_catnum">
          &nbsp;
          </TD>
        </TR>
        </TABLE>
      </TD>
    </TR>
    </TABLE>
  </TD>
</TR>
<TR>
  <TD CLASS="default">
    <TABLE CELLPADDING="0" CELLSPACING="0" ALIGN="center">
    <TR>
      <TD CLASS="default">
        <TABLE CELLPADDING="0" CELLSPACING="0" ALIGN="center">
        <TR>
          <TD CLASS="dsc_source_1">
            &nbsp;<?=$lnMdSource?>:
          </TD>
          <TD CLASS="dsc_source_2">
            &nbsp;<?=$disc_source_display?>&nbsp;
          </TD>
        </TR>
        
        <TR>
          <TD CLASS="dsc_type_1">
            &nbsp;<?=$lnMdType?>:
          </TD>
          <TD CLASS="dsc_type_2">
            &nbsp;<?=$row_rstDiscType['dtype_tt']?>&nbsp;
          </TD>
        </TR>
        <TR>
          <TD CLASS="dsc_format_1">
            &nbsp;<?=$lnMdFormat?>:
          </TD>
          <TD CLASS="dsc_format_2">
            &nbsp;<?=$row_rstDiscFormat['format_tt']?>&nbsp;
          </TD>
        </TR>
        <TR>
          <TD CLASS="dsc_model_1">
            &nbsp;<?=$lnMdModel?>:
          </TD>
          <TD CLASS="dsc_model_2">
            &nbsp;<?=$row_rstDiscDDB['ddb_name']?>&nbsp;
          </TD>
        </TR>
        </TABLE>
      </TD>
      <TD CLASS="default">
        <TABLE CELLPADDING="0" CELLSPACING="0" ALIGN="center">
        <TR>
          <TD CLASS="dsc_date_1">
            &nbsp;<?=$lnMdDate?>:
          </TD>
          <TD CLASS="dsc_date_2">
            &nbsp;<?php MyDate($row_rstDiscs['usr_drop_date'], "dd/mm/yyyy");?>&nbsp;
          </TD>
        </TR>
        <TR>
          <TD CLASS="dsc_status_1">
            &nbsp;<?=$lnMdStatus?>:
          </TD>
          <TD CLASS="dsc_status_2">
            &nbsp;<?//=$lend_status?>&nbsp;
          </TD>
        </TR>
        <TR>
          <TD CLASS="dsc_blank_1">
            &nbsp;<?=$row_rstDiscs['dsc_drop_id']?>&nbsp;
          </TD>
          <TD CLASS="dsc_blank_2">
            &nbsp;<?=$row_rstOneDisc['disc_id']?>&nbsp;
          </TD>
        </TR>
        <TR>
          <TD CLASS="dsc_cont_sh_1">
            &nbsp;<?=$lnMdContents?>:
          </TD>
          <TD CLASS="dsc_cont_sh_2">
            &nbsp;
          </TD>
        </TR>
        </TABLE>
      </TD>
    </TR>
    </TABLE>
  </TD>
</TR>
</TABLE>
<BR>
<?php    
}
mysql_free_result($rstDiscs);
?>
<?php
$maxPage = ceil($totalDiscsX/$rowsPerPage);
if ($s_page > 1)
{
    $page = $s_page - 1;

    $prev = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "my_discs.php?dsc=drop&amp;s_page=$page&amp;items=$rowsPerPage\">" . "&#60;" . "</A>&nbsp;";
    
    $first = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "my_discs.php?dsc=drop&amp;s_page=1&amp;items=$rowsPerPage\">" . "&#60;&#60;" . "</A>&nbsp;";
    

} 
else
{
    $prev  = "&nbsp;" . "&#60;" . "&nbsp;";
    $first = "&nbsp;" . "&#60;&#60;" . "&nbsp;";
}

if ($s_page < $maxPage)
{
    $page = $s_page + 1;

    $next = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "my_discs.php?dsc=drop&amp;s_page=$page&amp;items=$rowsPerPage\">" . "&#62;" . "</A>&nbsp;";
    
    $last = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "my_discs.php?dsc=drop&amp;s_page=$maxPage&amp;items=$rowsPerPage\">" . "&#62;&#62;" . "</A>&nbsp;";
} 
else
{
    $next = "&nbsp;" . "&#62;" . "&nbsp;";
    $last = "&nbsp;" . "&#62;&#62;" . "&nbsp;";
}
if ($totalDiscsX != '0') {
  echo $first . "&nbsp;" . $prev . "&nbsp;" . "Page" . " <B>$s_page</B> " . "of" . " <B>$maxPage</B>" . "&nbsp;" . $next . "&nbsp;" . $last;
}
?>
</DIV>
