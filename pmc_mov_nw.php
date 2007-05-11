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

$query_rstMoviesTT = "SELECT * FROM `pmc_mov_titles` ORDER BY `movie_id` DESC LIMIT 10";
$rstMoviesTT = mysql_query($query_rstMoviesTT) or die('Oups!<br>' . mysql_error());
$row_rstMoviesTT = mysql_fetch_assoc($rstMoviesTT);
$totalRows_rstMoviesTT = mysql_num_rows($rstMoviesTT);

// ########## ########## ########## ########## ########## ########## ########## ########## ##########

$page_title = SITE_TITLE . ' - ' . 'DB Movies - Latest Additions';
$stats_page = 'pmc_mov_nw';
require_once INC_DIR . 'html.inc.php';
?>
<?php require THEME_DIR . $_SESSION['usr_theme_dir'] . '/header.inc.php';?>
<HR COLOR="#ededed">
<?=$stats_page?>
<!--########## ########## ########## ########## ########## ########## ########## ########## ##########-->
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
</TABLE>
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