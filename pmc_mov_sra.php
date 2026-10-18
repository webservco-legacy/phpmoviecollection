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
$s_categ = '0';
$s_hcateg = '0';
$s_hsubcateg = '0';
$s_genre = '0';
$s_country = '0';
$s_lang = '0';
$s_year = '0';
$s_type = '0';
$s_release = '0';
$s_color = '0';
$s_rating = '0';
$s_string = '';
$p_string = '';

$q_categ = "!= '0'";
$q_horror_1 = "";
$q_horror_2 = "";
$q_horror_3 = "";
$q_genre="!= '0'";
$q_country="!= '0'";
$q_lang="!= '0'";
$q_year="!= '0000'";
$q_type="!= '0'";
$q_release="!= '0'";
$q_color="!= '0'";
$q_rating=">= '0'";
$q_string = "";

if (isset($_POST['s_categ'])) {
    $s_categ = $_POST['s_categ'];
    $s_hcateg = $_POST['s_hcateg'];
    $s_hsubcateg = $_POST['s_hsubcateg'];
    $s_genre = $_POST['s_genre'];
    $s_country = $_POST['s_country'];
    $s_lang = $_POST['s_lang'];
    $s_year = $_POST['s_year'];
    $s_type = $_POST['s_type'];
    $s_release = $_POST['s_release'];
    $s_color = $_POST['s_color'];
    $s_rating = $_POST['s_rating'];
    $s_string = $_POST['s_string'];
    $p_string = searchparse($s_string);
    
    if ($s_categ == '0') {
        $q_categ = "!= '0'";
        $q_horror_1 = "";
        $q_horror_2 = "";
        $q_horror_3 = "";
    }
    else if ($s_categ == '1') {
        // horror
        $q_categ = "= '1'";
        if ($s_hcateg == '0' && $s_hsubcateg == '0') {
            $q_horror_1 = "`pmc_mov_tt_horror_categ`, `pmc_mov_tt_horror_subcateg`, ";
            $q_horror_2 = " AND pmc_mov_titles.movie_id = pmc_mov_tt_horror_categ.movie_id AND pmc_mov_titles.movie_id = pmc_mov_tt_horror_subcateg.movie_id";
            $q_horror_3 = " AND (pmc_mov_tt_horror_categ.horror_categ_id != '0' AND pmc_mov_tt_horror_subcateg.horror_subcateg_id != '0')";
        }
        if ($s_hcateg == '0' && $s_hsubcateg != '0') {
            $q_horror_1 = "`pmc_mov_tt_horror_categ`, `pmc_mov_tt_horror_subcateg`, ";
            $q_horror_2 = " AND pmc_mov_titles.movie_id = pmc_mov_tt_horror_categ.movie_id AND pmc_mov_titles.movie_id = pmc_mov_tt_horror_subcateg.movie_id";
            $q_horror_3 = " AND (pmc_mov_tt_horror_categ.horror_categ_id != '0' AND pmc_mov_tt_horror_subcateg.horror_subcateg_id = '".$s_hsubcateg."')";
        }
        if ($s_hcateg != '0' && $s_hsubcateg == '0') {
            $q_horror_1 = "`pmc_mov_tt_horror_categ`, `pmc_mov_tt_horror_subcateg`, ";
            $q_horror_2 = " AND pmc_mov_titles.movie_id = pmc_mov_tt_horror_categ.movie_id AND pmc_mov_titles.movie_id = pmc_mov_tt_horror_subcateg.movie_id";
            $q_horror_3 = " AND (pmc_mov_tt_horror_categ.horror_categ_id = '".$s_hcateg."' AND pmc_mov_tt_horror_subcateg.horror_subcateg_id != '0')";
        }
        if ($s_hcateg != '0' && $s_hsubcateg != '0') {
            $q_horror_1 = "`pmc_mov_tt_horror_categ`, `pmc_mov_tt_horror_subcateg`, ";
            $q_horror_2 = " AND pmc_mov_titles.movie_id = pmc_mov_tt_horror_categ.movie_id AND pmc_mov_titles.movie_id = pmc_mov_tt_horror_subcateg.movie_id";
            $q_horror_3 = " AND (pmc_mov_tt_horror_categ.horror_categ_id = '".$s_hcateg."' AND pmc_mov_tt_horror_subcateg.horror_subcateg_id = '".$s_hsubcateg."')";
        }
    }
    else if ($s_categ != '0' && $s_categ != '1') {
        $q_categ = "= '".$s_categ."'";
        $q_horror_1 = "";
        $q_horror_2 = "";
        $q_horror_3 = "";
    }
    if ($s_genre == '0') {$q_genre="!= '0'";} else if ($s_genre != '0') {$q_genre="= '".$s_genre."'";}
    if ($s_country == '0') {$q_country="!= '0'";} else if ($s_country != '0') {$q_country="= '".$s_country."'";}
    if ($s_lang == '0') {$q_lang="!= '0'";} else if ($s_lang != '0') {$q_lang="= '".$s_lang."'";}
    if ($s_year == '0') {$q_year="!= '0000'";} else if ($s_year != '0') {$q_year="= '".$s_year."'";}
    if ($s_type == '0') {$q_type="!= '0'";} else if ($s_type != '0') {$q_type="= '".$s_type."'";}
    if ($s_release == '0') {$q_release="!= '0'";} else if ($s_release != '0') {$q_release="= '".$s_release."'";}
    if ($s_color == '0') {$q_color="!= '0'";} else if ($s_color != '0') {$q_color="= '".$s_color."'";}
    if ($s_rating == '0') {$q_rating=">= '0'";} else if ($s_rating != '0') {$q_rating=">= '".$s_rating."'";}
    if (trim($s_string) == '') {
        $q_string = "";
    }
    else if (trim($s_string) != '') {
        $q_string = " AND (pmc_mov_titles.movie_official_title REGEXP '".$p_string."'".
                    " OR pmc_mov_titles.movie_informal_title REGEXP '".$p_string."'".
                    " OR (pmc_mov_titles.movie_id = pmc_mov_tt_aka.movie_id AND pmc_mov_tt_aka.movie_aka_title REGEXP '".$p_string."'))";
    }
    
}

$the_query = "SELECT DISTINCT pmc_mov_titles.*".
" FROM `pmc_mov_titles`, `pmc_mov_titles_ext`, `pmc_mov_tt_aka`, ".$q_horror_1."`pmc_mov_tt_genres`, `pmc_mov_tt_countries`, `pmc_mov_tt_langs`".
" WHERE pmc_mov_titles.movie_id = pmc_mov_titles_ext.movie_id ".
" AND pmc_mov_titles.categ_id ".$q_categ.$q_horror_2.$q_horror_3.
" AND (pmc_mov_titles.movie_id = pmc_mov_tt_genres.movie_id AND pmc_mov_tt_genres.movie_genre_id ".$q_genre.")".
" AND (pmc_mov_titles.movie_id = pmc_mov_tt_countries.movie_id AND pmc_mov_tt_countries.country_iso ".$q_country.")".
" AND (pmc_mov_titles.movie_id = pmc_mov_tt_langs.movie_id AND pmc_mov_tt_langs.lang_index ".$q_lang.")".
" AND pmc_mov_titles.movie_year ".$q_year.
" AND pmc_mov_titles_ext.movie_type ".$q_type.
" AND pmc_mov_titles_ext.movie_release ".$q_release.
" AND pmc_mov_titles_ext.movie_color ".$q_color.
" AND pmc_mov_titles.movie_imdb_rating ".$q_rating.$q_string." ORDER BY pmc_mov_titles.movie_informal_title ASC";
// ########## ########## ########## ########## ########## ########## ########## ########## ##########

$query_rstMovies = $the_query;
$rstMovies = mysql_query($query_rstMovies) or die('Oups!<br>' . mysql_error() . '<BR>' . $query_rstMovies);
$row_rstMovies = mysql_fetch_assoc($rstMovies);
$totalRows_rstMovies = mysql_num_rows($rstMovies);

$s_page = 1;
if(isset($_GET['s_page']) && isset($_POST['s_page'])) { $s_page = $_GET['s_page']; }
else if(!isset($_GET['s_page']) && isset($_POST['s_page'])) { $s_page = $_POST['s_page']; }

$rowsPerPage = 10;
if(isset($_POST['items'])) { $rowsPerPage = $_POST['items']; }

$offset = ($s_page - 1) * $rowsPerPage;

$query_rstMoviesTT = $the_query . " LIMIT $offset, $rowsPerPage";
$rstMoviesTT = mysql_query($query_rstMoviesTT) or die('Oups!<br>' . mysql_error());
$row_rstMoviesTT = mysql_fetch_assoc($rstMoviesTT);
$totalRows_rstMoviesTT = mysql_num_rows($rstMoviesTT);

// ########## ########## ########## ########## ########## ########## ########## ########## ##########

$page_title = SITE_TITLE . ' - ' . 'DB Movies - Search';
$stats_page = 'pmc_mov_sra';
require_once INC_DIR . 'html.inc.php';
?>
<?php require THEME_DIR . $_SESSION['usr_theme_dir'] . '/header.inc.php';?>
<SCRIPT>
function submitform(url)
{
    var myform;
    myform = document.movsearch;
    myform.action=url;
    myform.submit();
}
</SCRIPT>
<HR COLOR="#ededed">
<?=$stats_page?>
<!--########## ########## ########## ########## ########## ########## ########## ########## ##########-->
<?php
//if (isset($_POST['s_categ'])) {
//echo '<HR><PRE>';
//print_r($_POST);
//echo '</PRE><HR>';
//}
?>
<?=$query_rstMovies?>
<BR><BR>
<?=$query_rstMoviesTT?>
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
    $prev = "&nbsp;<A CLASS=\"default\" HREF=\"javascript:submitform('".PMC_ROOT."pmc_mov_sra.php?s_page=$page')\">" . "&#60;" . "</A>&nbsp;";
    
    $first = "&nbsp;<A CLASS=\"default\" HREF=\"javascript:submitform('".PMC_ROOT."pmc_mov_sra.php?s_page=1')\">" . "&#60;&#60;" . "</A>&nbsp;";
} 
else
{
    $prev  = "&nbsp;" . "&#60;" . "&nbsp;";
    $first = "&nbsp;" . "&#60;&#60;" . "&nbsp;";
}

if ($s_page < $maxPage)
{
    $page = $s_page + 1;
    $next = "&nbsp;<A CLASS=\"default\" HREF=\"javascript:submitform('".PMC_ROOT."pmc_mov_sra.php?s_page=$page')\">" . "&#62;" . "</A>&nbsp;";
    
    $last = "&nbsp;<A CLASS=\"default\" HREF=\"javascript:submitform('".PMC_ROOT."pmc_mov_sra.php?s_page=$maxPage')\">" . "&#62;&#62;" . "</A>&nbsp;";
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
<?php } ?>
<BR>
$p_string = "<?=$p_string?>"
<BR>
$s_page = <?=$s_page?>
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