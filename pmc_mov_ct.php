<?php
error_reporting(E_ALL);

// START PAGE EXECUTION COUNTER
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$begintime = $time;

require_once './inc/config.inc.php';
require_once INC_DIR . 'functions.inc.php';
require INC_DIR . 'dbopen.inc.php';
// ########## ########## ########## ########## ########## ########## ########## ########## ##########
$ttc       = 'all';
$queryFill = " ";

if (isset($_POST['ttc']) || isset($_GET['ttc'])) {
    if (isset($_POST['ttc'])) {$ttc = $_POST['ttc'];}
    else if (isset($_GET['ttc'])) {$ttc = $_GET['ttc'];}
    if ($ttc == 'all') {
        $queryFill = " ";
    }
    else {
        $queryFill = " WHERE `categ_id` = '".$ttc."' ";
    }
}

$query_rstMovies = "SELECT * FROM `pmc_mov_titles`" . $queryFill . "ORDER BY `movie_informal_title` ASC";
$rstMovies = mysql_query($query_rstMovies) or die('Oups!<br>' . mysql_error());
$row_rstMovies = mysql_fetch_assoc($rstMovies);
$totalRows_rstMovies = mysql_num_rows($rstMovies);

$s_page = 1;
if(isset($_POST['ttc']) && isset($_GET['s_page'])) { $s_page = 1; }
else if(!isset($_POST['ttc']) && isset($_GET['s_page'])) { $s_page = $_GET['s_page']; }

$rowsPerPage = 10;
if(isset($_POST['ttc']) && isset($_GET['items'])) {$rowsPerPage = 10;}
if(isset($_GET['items'])) { $rowsPerPage = $_GET['items']; }
if(isset($_POST['items'])) { $rowsPerPage = $_POST['items']; }

$offset = ($s_page - 1) * $rowsPerPage;

$query_rstMoviesTT = "SELECT * FROM `pmc_mov_titles`" . $queryFill . "ORDER BY `movie_informal_title` ASC LIMIT $offset, $rowsPerPage";
$rstMoviesTT = mysql_query($query_rstMoviesTT) or die('Oups!<br>' . mysql_error());
$row_rstMoviesTT = mysql_fetch_assoc($rstMoviesTT);
$totalRows_rstMoviesTT = mysql_num_rows($rstMoviesTT);

// ########## ########## ########## ########## ########## ########## ########## ########## ##########

$page_title = SITE_TITLE . ' - ' . 'DB Movies by category';
$stats_page = 'pmc_mov_ct';
require_once INC_DIR . 'html.inc.php';
?>
<?php require THEME_DIR . $_SESSION['usr_theme_dir'] . '/header.inc.php';?>
<HR COLOR="#ededed">
<?=$stats_page?>
<!--########## ########## ########## ########## ########## ########## ########## ########## ##########-->
<BR>
<?php if ($totalRows_rstMovies == '0') {echo 'no titles';}
else {
 ?>
<?=$totalRows_rstMovies?> titles / <?=$rowsPerPage?> per page
<BR>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" ALIGN="center">
<TR>
    <TD CLASS="movies_tt_h">
        Informal title
    </TD>
    <TD CLASS="movies_year_h">
        Title
    </TD>
    <TD CLASS="movies_year_h">
        Year
    </TD>
    <TD CLASS="movies_imdb_h">
        IMDb
    </TD>
</TR>
<TR>
    <TD CLASS="movies_sp" COLSPAN="4">
        &nbsp;
    </TD>
</TR>
<?php do { ?>
<TR>
    <TD CLASS="movies_tt_inf">
        &nbsp;<?=$row_rstMoviesTT['movie_informal_title']?>
        &nbsp;
    </TD>
    <TD CLASS="movies_tt">
        &nbsp;
        <?php 
        if ($row_rstMoviesTT['movie_details'] == '1') {
            $lnk_p = '<A CLASS="default" HREF="'. PMC_ROOT . 'my_mov_det.php?movie_id='. $row_rstMoviesTT['movie_id'] . '">';
            $lnk_s = '</A>';
        }
        else {
            $lnk_p = '';
            $lnk_s = '';
        }
        ?>
        <?=$lnk_p?>
        <?php
        if ($row_rstMoviesTT['movie_title_the'] != '') {echo $row_rstMoviesTT['movie_title_the'] . '&nbsp;';}
        echo $row_rstMoviesTT['movie_official_title'];
        ?><?=$lnk_s?>&nbsp;
    </TD>
    <TD CLASS="movies_year">
        &nbsp;<?=$row_rstMoviesTT['movie_year']?>&nbsp;
    </TD>
    <TD CLASS="movies_imdb">
    <?php
    if ($row_rstMoviesTT['movie_imdb_id'] != '') {echo '&nbsp;' . '<A CLASS="default" HREF="http://www.imdb.com/title/tt' . $row_rstMoviesTT['movie_imdb_id'] . '/" TARGET="_blank">'. $row_rstMoviesTT['movie_imdb_rating'] . '</A>';}
    else {echo '&nbsp;' . $row_rstMoviesTT['movie_imdb_rating'];}
    ?>
    </TD>
</TR>
<TR>
    <TD CLASS="movies_sp" COLSPAN="4">
        &nbsp;
    </TD>
</TR>
<?php } while ($row_rstMoviesTT = mysql_fetch_assoc($rstMoviesTT));?>
<TR>
    <TD CLASS="movies_nav" COLSPAN="4">
<?php
$maxPage = ceil($totalRows_rstMovies/$rowsPerPage);

if ($s_page > 1)
{
    $page = $s_page - 1;
    $prev = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "pmc_mov_ct.php?ttc=$ttc&amp;s_page=$page&amp;items=$rowsPerPage\">" . "&#60;" . "</A>&nbsp;";
    
    $first = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "pmc_mov_ct.php?ttc=$ttc&amp;s_page=1&amp;items=$rowsPerPage\">" . "&#60;&#60;" . "</A>&nbsp;";
} 
else
{
    $prev  = "&nbsp;" . "&#60;" . "&nbsp;";
    $first = "&nbsp;" . "&#60;&#60;" . "&nbsp;";
}

if ($s_page < $maxPage)
{
    $page = $s_page + 1;
    $next = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "pmc_mov_ct.php?ttc=$ttc&amp;s_page=$page&amp;items=$rowsPerPage\">" . "&#62;" . "</A>&nbsp;";
    
    $last = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "pmc_mov_ct.php?ttc=$ttc&amp;s_page=$maxPage&amp;items=$rowsPerPage\">" . "&#62;&#62;" . "</A>&nbsp;";
} 
else
{
    $next = "&nbsp;" . "&#62;" . "&nbsp;";
    $last = "&nbsp;" . "&#62;&#62;" . "&nbsp;";
}

echo $first . "&nbsp;" . $prev . "&nbsp;" . "Page" . " <B>$s_page</B> " . "of" . " <B>$maxPage</B>" . "&nbsp;" . $next . "&nbsp;" . $last;

mysql_free_result($rstMovies);
mysql_free_result($rstMoviesTT);
?>
    </TD>
</TR>
</TABLE>
<BR>
<?php } ?>
<!--########## ########## ########## ########## ########## ########## ########## ########## ##########-->
<HR COLOR="#ededed">
<?php require THEME_DIR . $_SESSION['usr_theme_dir'] . '/footer.inc.php';?>
<?php
// START PAGE EXECUTION COUNTER
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$endtime = $time;
$totaltime = ($endtime - $begintime);
echo '<BR>parse time: ' .$totaltime. ' seconds.';
?>
</BODY>
</HTML>
<?php require INC_DIR . 'dbclose.inc.php'; ?>