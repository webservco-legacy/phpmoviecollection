<?php

$s_page = 1;
if(isset($_GET['s_page'])) { $s_page = $_GET['s_page']; }
                
$rowsPerPage = 5;
if(isset($_POST['items'])) { $rowsPerPage = $_POST['items']; }
else if(isset($_GET['items'])) { $rowsPerPage = $_GET['items']; }

$offset = ($s_page - 1) * $rowsPerPage;

$categ = '';
$categ_option = '';
$categ_link = '';
$categ_tt = $lnMDiscsAllCollections;
if(isset($_GET['categ'])) {
  $categ = $_GET['categ'];
  $categ_option = " AND `categ_id` = '".$categ."'";
  $categ_link = '&amp;categ=' . $categ;
  
  if ($categ != '0') {
    $query_rstColCateg = "SELECT * FROM `pmc_dsc_categ` WHERE categ_id = '".$categ."' LIMIT 1";
    $rstColCateg = mysql_query($query_rstColCateg) or die('Oups!<br>' . mysql_error());
    $row_rstColCateg = mysql_fetch_assoc($rstColCateg);
    mysql_free_result($rstColCateg);
    $categ_tt = $row_rstColCateg['categ_tt'];
  }
  else if ($categ == '0') {
    $categ_tt = $lnMDiscsNoColCateg;
  }
}

$query_rstDiscsX = "SELECT * FROM `pmc_usr_dsc_col` WHERE `usr_id` = '".$_SESSION['usr_id']."'".$categ_option." ORDER BY `categ_id` ASC, `disc_cat_number` ASC, `dsc_col_id` ASC";
$rstDiscsX = mysql_query($query_rstDiscsX) or die('Oups!<br>' . mysql_error());
$totalDiscsX = mysql_num_rows($rstDiscsX);
mysql_free_result($rstDiscsX);

$query_rstDiscs = $query_rstDiscsX . " LIMIT $offset, $rowsPerPage";
$rstDiscs = mysql_query($query_rstDiscs) or die('Oups!<br>' . mysql_error());
$totalDiscs = mysql_num_rows($rstDiscs);
?>
<SCRIPT>
/* 
http://www.netlobo.com
*/
function toggleLayer( whichLayer )
{
  var elem, vis;
  if( document.getElementById ) // this is the way the standards work
    elem = document.getElementById( whichLayer );
  else if( document.all ) // this is the way old msie versions work
      elem = document.all[whichLayer];
  else if( document.layers ) // this is the way nn4 works
    elem = document.layers[whichLayer];
  vis = elem.style;
  // if the style.display value is blank we try to figure it out here
  if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)
    vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';
  vis.display = (vis.display==''||vis.display=='block')?'none':'block';
}
</SCRIPT>
<DIV CLASS="pg_title">
<?=$lnMMyDiscs . ' - ' . $lnMDiscsCollection . ' - ' . $categ_tt?>
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
    
    $query_rstDiscCateg = "SELECT * FROM `pmc_dsc_categ` WHERE categ_id = '".$row_rstDiscs['categ_id']."' LIMIT 1";
    $rstDiscCateg = mysql_query($query_rstDiscCateg) or die('Oups!<br>' . mysql_error());
    $row_rstDiscCateg = mysql_fetch_assoc($rstDiscCateg);
    mysql_free_result($rstDiscCateg);
    
    $disc_souce_index = $row_rstOneDisc['disc_source'];
    switch($disc_souce_index) {
      case "1": {
        $disc_source = 'burn';
        $disc_source_display = $lnMdSrcBurn;
        break;
      }
      case "2": {
        $disc_source = 'get';
        $disc_source_display = $lnMdSrcGet;
        break;
      }
      case "3": {
        $disc_source = 'mag';
        $disc_source_display = $lnMdSrcMag;
        break;
      }
      case "4": {
        $disc_source = 'oth';
        $disc_source_display = $lnMdSrcOther;
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
    
    $query_rstDiscStatus = "SELECT * FROM `pmc_usr_dsc_lend` WHERE dsc_col_id = '".$row_rstDiscs['dsc_col_id']."' AND `lend_return_date` = '0000-00-00'";
    $rstDiscStatus = mysql_query($query_rstDiscStatus) or die('Oups!<br>' . mysql_error());
    $row_rstDiscStatus = mysql_fetch_assoc($rstDiscStatus);
    $lend_status_index = mysql_num_rows($rstDiscStatus);
    mysql_free_result($rstDiscStatus);
    if ($lend_status_index == '0') {$lend_status = $lnMdStatus1;} else {$lend_status = $lnMdStatus0;}
    
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
          &nbsp;<?php if ($row_rstDiscs['categ_id'] != '0') {echo $row_rstDiscCateg['categ_tt'];} else {echo $lnMdNoCategory;}?>&nbsp;
          </TD>
        </TR>
        <TR>
          <TD CLASS="dsc_catnum">
          &nbsp;<?php if ($row_rstDiscs['categ_id'] != '0') {echo $row_rstDiscCateg['categ_index'] . '-' . $row_rstDiscs['disc_cat_number'];} else {echo $lnMdNoCatNumber;}?>&nbsp;
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
            &nbsp;<?php MyDate($row_rstDiscs['usr_col_date'], "dd/mm/yyyy");?>&nbsp;
          </TD>
        </TR>
        <TR>
          <TD CLASS="dsc_status_1">
            &nbsp;<?=$lnMdStatus?>:
          </TD>
          <TD CLASS="dsc_status_2">
            &nbsp;<?=$lend_status?>&nbsp;
          </TD>
        </TR>
        <TR>
          <TD CLASS="dsc_blank_1">
            &nbsp;<?=$row_rstDiscs['dsc_col_id']?>&nbsp;
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
            &nbsp;<A CLASS="default" HREF="javascript:toggleLayer('dsc_hidden_<?=$i?>');"><?=$lnShowHide?></A>&nbsp;
          </TD>
        </TR>
        </TABLE>
      </TD>
    </TR>
    </TABLE>
  </TD>
</TR>
</TABLE>
<DIV CLASS="disc_contents" ID="dsc_hidden_<?=$i?>">
<TABLE CLASS="dsc_cont" CELLPADDING="0" CELLSPACING="0" ALIGN="<?=$defaultTableAlign?>">
<TR>
  <TD CLASS="disc_contents_def">
    <TABLE CELLPADDING="0" CELLSPACING="0" ALIGN="center">
<?php
// CONTENTS MOVIES
    $query_rstDiscContMovies = "SELECT * FROM `pmc_usr_mov` WHERE disc_id = '".$row_rstDiscs['disc_id']."'";
    $rstDiscContMovies = mysql_query($query_rstDiscContMovies) or die('Oups!<br>' . mysql_error());
    $total_DiscContMovies = mysql_num_rows($rstDiscContMovies);
    if ($total_DiscContMovies != '0') {
      $DiscContMoviesStatus = '1';
?>
    <TR>
      <TD CLASS="dsc_cont_movies">
      <B><?=$lnMMovies?></B> (<?=$total_DiscContMovies?>):<BR>
      <?php
      for ($j=1; $j<=$total_DiscContMovies; $j++) {
        $row_rstDiscContMovies = mysql_fetch_assoc($rstDiscContMovies);
        
        $query_rstDiscContMovieTT = "SELECT * FROM `pmc_mov_titles` WHERE movie_id = '".$row_rstDiscContMovies['movie_id']."' LIMIT 1";
        $rstDiscContMovieTT = mysql_query($query_rstDiscContMovieTT) or die('Oups!<br>' . mysql_error());
        $row_rstDiscContMovieTT = mysql_fetch_assoc($rstDiscContMovieTT);
        mysql_free_result($rstDiscContMovieTT);
        ?>
        <?=$row_rstDiscContMovieTT['movie_official_title']?><BR>
        <?php
      }
?>
      </TD>
    </TR>
<?php
    }
    else {
      $DiscContMoviesStatus = '0';
    }
    mysql_free_result($rstDiscContMovies);
?>
<?php
if ($DiscContMoviesStatus == '0') {
?>
    <TR>
      <TD CLASS="disc_contents_def">
        <?=$lnNoInfo?>
      </TD>
    </TR>
<?php
}
?>
    </TABLE>
  </TD>
</TR>
</TABLE>
</DIV>
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

    $prev = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "my_discs.php?dsc=col$categ_link&amp;s_page=$page&amp;items=$rowsPerPage\">" . "&#60;" . "</A>&nbsp;";
    
    $first = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "my_discs.php?dsc=col$categ_link&amp;s_page=1&amp;items=$rowsPerPage\">" . "&#60;&#60;" . "</A>&nbsp;";
    

} 
else
{
    $prev  = "&nbsp;" . "&#60;" . "&nbsp;";
    $first = "&nbsp;" . "&#60;&#60;" . "&nbsp;";
}

if ($s_page < $maxPage)
{
    $page = $s_page + 1;

    $next = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "my_discs.php?dsc=col$categ_link&amp;s_page=$page&amp;items=$rowsPerPage\">" . "&#62;" . "</A>&nbsp;";
    
    $last = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "my_discs.php?dsc=col$categ_link&amp;s_page=$maxPage&amp;items=$rowsPerPage\">" . "&#62;&#62;" . "</A>&nbsp;";
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
