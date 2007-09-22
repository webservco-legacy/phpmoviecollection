<?php
require_once './inc/config.inc.php';
require_once INC_DIR . 'php1.inc.php';

    if (isset($_GET['user_id']) && isset($_GET['list_id'])) {
        $user_id = $_GET['user_id'];
        $list_id = $_GET['list_id'];
        
        if ($user_id != '0' && $list_id != '0') {
                $query_rstList = "SELECT * FROM `pmc_usr_lists` WHERE `list_id` = '".$list_id."' AND `usr_id` = '".$user_id."' LIMIT 1";
                $rstList=mysql_query($query_rstList) or die('Oups!<br>' . mysql_error());
                $row_rstList = mysql_fetch_assoc($rstList);
                
                if ($row_rstList['list_the'] == '1') {$list_name = 'The ' . $row_rstList['list_tt'];} else {$list_name = $row_rstList['list_tt'];}
                $list_notes = $row_rstList['list_notes'];
                
                $query_rstOneCollector = "SELECT `usr_display` FROM `pmc_set_usr` WHERE `usr_id` = '".$user_id."' LIMIT 1";
                $rstOneCollector=mysql_query($query_rstOneCollector) or die('Oups!<br>' . mysql_error());
                $ColUserName = mysql_result($rstOneCollector, 0);
                mysql_free_result($rstOneCollector);
        
                $query_rstMovListX = "SELECT * FROM `pmc_usr_mov`, `pmc_mov_titles` WHERE pmc_usr_mov.list_id = '".$list_id."' AND pmc_usr_mov.movie_id = pmc_mov_titles.movie_id ORDER BY pmc_mov_titles.movie_informal_title ASC";
                $rstMovListX = mysql_query($query_rstMovListX) or die('Oups!<br>' . mysql_error());
                $totalMovListX = mysql_num_rows($rstMovListX);
                
                $s_page = 1;
                if(isset($_GET['s_page'])) { $s_page = $_GET['s_page']; }
                
                $rowsPerPage = 5;
                if(isset($_POST['items'])) { $rowsPerPage = $_POST['items']; }
                else if(isset($_GET['items'])) { $rowsPerPage = $_GET['items']; }

                $offset = ($s_page - 1) * $rowsPerPage;

                $query_rstMovList = $query_rstMovListX . " LIMIT $offset, $rowsPerPage";
                $rstMovList = mysql_query($query_rstMovList) or die('Oups!<br>' . mysql_error());
                $totalMovList = mysql_num_rows($rstMovList);
                
                $page_title = SITE_TITLE . ' - ' . $ColUserName . $lnMUsersCollection . ' - ' . $lnMMovies . ' - ' . $list_name;
                $stats_page = 'movies';
        }
        else {
            $redirect = PMC_ROOT . 'index.php';
            header("Location: $redirect");
        }
    } // IF ACTION 1
    else if (isset($_GET['user_id']) && isset($_GET['sublist_id'])) {
        $user_id = $_GET['user_id'];
        $list_id = $_GET['sublist_id'];
        
        if ($user_id != '0' && $list_id != '0') {
                $query_rstList = "SELECT * FROM `pmc_usr_sublists` WHERE `sublist_id` = '".$list_id."' LIMIT 1";
                $rstList=mysql_query($query_rstList) or die('Oups!<br>' . mysql_error());
                $row_rstList = mysql_fetch_assoc($rstList);
                
                if ($row_rstList['sublist_the'] != '') {$list_name = $row_rstList['sublist_the'] . '&nbsp;' . $row_rstList['sublist_tt'];} else {$list_name = $row_rstList['sublist_tt'];}
                $list_notes = $row_rstList['sublist_notes'];
                
                $query_rstOneCollector = "SELECT `usr_display` FROM `pmc_set_usr` WHERE `usr_id` = '".$user_id."' LIMIT 1";
                $rstOneCollector=mysql_query($query_rstOneCollector) or die('Oups!<br>' . mysql_error());
                $ColUserName = mysql_result($rstOneCollector, 0);
                mysql_free_result($rstOneCollector);
        
                $query_rstMovListX = "SELECT * FROM `pmc_usr_mov`, `pmc_mov_titles` WHERE pmc_usr_mov.sublist_id = '".$list_id."' AND pmc_usr_mov.movie_id = pmc_mov_titles.movie_id ORDER BY pmc_mov_titles.movie_informal_title ASC";
                $rstMovListX = mysql_query($query_rstMovListX) or die('Oups!<br>' . mysql_error());
                $totalMovListX = mysql_num_rows($rstMovListX);
                
                $s_page = 1;
                if(isset($_GET['s_page'])) { $s_page = $_GET['s_page']; }
                
                $rowsPerPage = 5;
                if(isset($_POST['items'])) { $rowsPerPage = $_POST['items']; }
                else if(isset($_GET['items'])) { $rowsPerPage = $_GET['items']; }

                $offset = ($s_page - 1) * $rowsPerPage;
                
                $query_rstMovList = $query_rstMovListX . " LIMIT $offset, $rowsPerPage";
                $rstMovList = mysql_query($query_rstMovList) or die('Oups!<br>' . mysql_error());
                $totalMovList = mysql_num_rows($rstMovList);
        
                $page_title = SITE_TITLE . ' - ' . $ColUserName . $lnMUsersCollection . ' - ' . $lnMMovies . ' - ' . $list_name;
                $stats_page = 'movies';
        }
        else {
            $redirect = PMC_ROOT . 'index.php';
            header("Location: $redirect");
        }
    } // IF ACTION 2
    else {
        $redirect = PMC_ROOT . 'index.php';
        header("Location: $redirect");
    }
    
require_once INC_DIR . 'php2.inc.php';
?>
<?php 
if ($_SESSION['usr_level'] >= 1) {
?>
<DIV CLASS="pg_title">
<?=$ColUserName . $lnMUsersCollection . ' - ' . $lnMMovies . ' - ' . $list_name?>
</DIV>
<DIV CLASS="pg_subtitle">
<?php
$query_rstSubList = "SELECT * FROM `pmc_usr_sublists` WHERE `list_id` = '".$list_id."' ORDER BY `sublist_tt` ASC";
$rstSubList = mysql_query($query_rstSubList) or die('Oups!<br>' . mysql_error());
$totalSubList = mysql_num_rows($rstSubList);

//
$totalMovAllSublists = '0';
if ($totalSubList != '0') {
    for ($k=1; $k<=$totalSubList; $k++) {
        //$row2_rstSubList = mysql_fetch_assoc($rstSubList);
        $row_rstSubList = mysql_fetch_assoc($rstSubList);
        
        $query_rstMovSubList = "SELECT * FROM `pmc_usr_mov` WHERE `sublist_id` = '".$row_rstSubList['sublist_id']."' ORDER BY `sublist_id` ASC";
        $rstMovSubList = mysql_query($query_rstMovSubList) or die('Oups!<br>' . mysql_error());
        $totalMovSubList[$k] = mysql_num_rows($rstMovSubList);
        mysql_free_result($rstMovSubList);
        
    }
    $totalMovAllSublists = array_sum($totalMovSubList);
}
//
?>
<TABLE CELLPADDING="0" CELLSPACING="0" ALIGN="center" BORDER="0">
<?php
if (isset($_GET['user_id']) && isset($_GET['list_id'])) {
?>
<TR>
    <TD CLASS="list_tt_01">
        <?=$lnLsTotalSubLists?>&#58;
    </TD>
    <TD CLASS="list_tt_02">
        <?=$totalSubList?>
    </TD>
</TR>
<TR>
    <TD CLASS="list_tt_01">
        <?=$lnLsTitlesSubLists?>&#58;
    </TD>
    <TD CLASS="list_tt_02">
        <?=$totalMovAllSublists?><?php $totalMovListAndSublists = $totalMovAllSublists + $totalMovListX;?>
    </TD>
</TR>
<TR>
    <TD CLASS="list_tt_01">
        <?=$lnLsTitlesList?>&#58;
    </TD>
    <TD CLASS="list_tt_02">
        <?=$totalMovListX?>
    </TD>
</TR>
<TR>
    <TD CLASS="list_tt_01">
        <?=$lnLsTotalTitles?>&#58;
    </TD>
    <TD CLASS="list_tt_02">
        <?=$totalMovListAndSublists?>
    </TD>
</TR>
<?php
}
else if (isset($_GET['user_id']) && isset($_GET['sublist_id'])) {
?>
<TR>
    <TD CLASS="list_tt_01">
        <?=$lnLsTitlesList?>&#58;
    </TD>
    <TD CLASS="list_tt_02">
        <?=$totalMovList?>
    </TD>
</TR>
<?php
}
?>
</TABLE>
</DIV>
<DIV CLASS="pg_content">
<?php
if ($s_page == '1') {
?>
<?php
if (!isset($_GET['sublist_id'])) {
if ($totalSubList != '0') {
    for ($j=1; $j<=$totalSubList; $j++) {
        //$row_rstSubList = mysql_fetch_assoc($rstSubList);
        $query_rstMovThisSubList = "SELECT * FROM `pmc_usr_mov` WHERE `sublist_id` = '".$row_rstSubList['sublist_id']."' ORDER BY `sublist_id` ASC";
        $rstMovThisSubList = mysql_query($query_rstMovThisSubList) or die('Oups!<br>' . mysql_error());
        $totalMovThisSubList = mysql_num_rows($rstMovThisSubList);
        mysql_free_result($rstMovThisSubList);
?>
<TABLE CLASS="movie_list" CELLPADDING="0" CELLSPACING="1" ALIGN="<?=$defaultTableAlign?>">
<TR>
    <TD CLASS="movie_sublist_type">
        &nbsp;sublist&nbsp;
    </TD>
    <TD CLASS="movie_sublist_pic">
        <?php
        $query_rstListPosters = "SELECT `list_pic_file` FROM `pmc_usr_list_pics` WHERE `sublist_id` = '".$row_rstSubList['sublist_id']."' AND `list_pic_usr` = '".$user_id."' AND `list_pic_type` = '1'";
        $rstListPosters=mysql_query($query_rstListPosters) or die('Oups!<br>' . mysql_error());
        if (mysql_num_rows($rstListPosters) != '0') {
            $mov_poster_nr = rand(1, mysql_num_rows($rstListPosters));
            $movie_poster_path = PIC_DIR . 'sublists/';
            $movie_poster_file = mysql_result($rstListPosters, $mov_poster_nr - 1);
?>
        <IMG SRC="<?=INC_URL?>ubthumb.php?imgfile=<?=$movie_poster_path . $movie_poster_file?>&amp;max_size=100" BORDER="0" HSPACE="0" VSPACE="0" />
<?php
        }
        else {
?>
        <IMG SRC="<?=INC_URL?>image.php?picture=blank&amp;old_width=10&amp;old_height=10&amp;new_width=75&amp;new_height=100&amp;fontSize=9&amp;fontFace=<?=$defaultFontGDFace?>&amp;x_f=5&amp;y_f=45&amp;color1=0x00&amp;color2=0x00&amp;color3=0x00&amp;text=<?=$lnNoImageGD?>" BORDER="0" HSPACE="0" VSPACE="0" />
<?php
        }
        ?>
    </TD>
    <TD CLASS="movie_sublist_tt">
        <TABLE CELLPADDING="0" CELLSPACING="1" ALIGN="center">
        <TR>
            <TD CLASS="movie_sublist_tt_01">
                &nbsp;<A CLASS="list_st" HREF="<?=PMC_ROOT?>movies.php?user_id=<?=$user_id?>&amp;sublist_id=<?=$row_rstSubList['sublist_id']?>"><?=$row_rstSubList['sublist_tt']?></A>&nbsp;
            </TD>
        </TR>
        <TR>
            <TD CLASS="movie_sublist_tt_02">
                &nbsp;&#91;<?=$row_rstSubList['sublist_notes']?>&#93;&nbsp;
            </TD>
        </TR>
        <TR>
            <TD CLASS="movie_sublist_tt_03">
                &nbsp;<?=$lnLsTotalTitles?>&#58;&nbsp;<?=$totalMovThisSubList?>&nbsp;
            </TD>
        </TR>
        </TABLE>
    </TD>
    <TD CLASS="movie_sublist_yr">
        &nbsp;
    </TD>
    <TD CLASS="movie_sublist_imdb">
        &nbsp;
    </TD>
</TR>
</TABLE>
<BR>
<?php
    } // FOR SUBLISTS
} // IF SUBLISTS
mysql_free_result($rstSubList);
}
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
for ($i=1; $i<=$totalMovList; $i++) {
    $row_rstMovList = mysql_fetch_assoc($rstMovList);
    if ($row_rstMovList['movie_title_the'] != '') {
        $movie_official_title  = $row_rstMovList['movie_title_the'] . '&nbsp;' . $row_rstMovList['movie_official_title'];
    }
    else {
        $movie_official_title  = $row_rstMovList['movie_official_title'];
    }
    $movie_informal_title = $row_rstMovList['movie_informal_title'];
?>
<TABLE CLASS="movie_list" CELLPADDING="0" CELLSPACING="1" ALIGN="<?=$defaultTableAlign?>">
<TR>
    <TD CLASS="movie_mov_type">
        &nbsp;title&nbsp;
    </TD>
    <TD CLASS="movie_mov_pic">
        <?php
        $query_rstMovPosters = "SELECT `movie_pic_file` FROM `pmc_mov_tt_pics` WHERE `movie_id` = '".$row_rstMovList['movie_id']."' AND `movie_pic_usr` = '".$user_id."' AND `movie_pic_type` = '1'";
        $rstMovPosters=mysql_query($query_rstMovPosters) or die('Oups!<br>' . mysql_error());
        if (mysql_num_rows($rstMovPosters) != '0') {
            $mov_poster_nr = rand(1, mysql_num_rows($rstMovPosters));
            $movie_poster_path = PIC_DIR . 'movies/';
            $movie_poster_file = mysql_result($rstMovPosters, $mov_poster_nr - 1);
?>
        <IMG SRC="<?=INC_URL?>ubthumb.php?imgfile=<?=$movie_poster_path . $movie_poster_file?>&amp;max_size=100" BORDER="0" HSPACE="0" VSPACE="0" />
<?php
        }
        else {
?>
        <IMG SRC="<?=INC_URL?>image.php?picture=blank&amp;old_width=10&amp;old_height=10&amp;new_width=75&amp;new_height=100&amp;fontSize=9&amp;fontFace=<?=$defaultFontGDFace?>&amp;x_f=5&amp;y_f=45&amp;color1=0x00&amp;color2=0x00&amp;color3=0x00&amp;text=<?=$lnNoImageGD?>" BORDER="0" HSPACE="0" VSPACE="0" />
<?php
        }
        ?>
    </TD>
    <TD CLASS="movie_mov_tt">
        <TABLE CELLPADDING="0" CELLSPACING="1" ALIGN="center">
        <TR>
            <TD CLASS="movie_mov_tt_01">
                &nbsp;<?=$movie_official_title?>&nbsp;
            </TD>
        </TR>
        <TR>
            <TD CLASS="movie_mov_tt_02">
                &nbsp;&#91;<?=$movie_informal_title?>&#93;&nbsp;
            </TD>
        </TR>
        <TR>
            <TD CLASS="movie_mov_tt_03">
                &nbsp;<?=$row_rstMovList['mov_usr_ext']?>&nbsp;
            </TD>
        </TR>
        </TABLE>
    </TD>
    <TD CLASS="movie_mov_yr">
        &nbsp;<?=$row_rstMovList['movie_year']?>&nbsp;
    </TD>
    <TD CLASS="movie_mov_imdb">
        &nbsp;<?php
        if ($row_rstMovList['movie_imdb_id'] != '') {echo '&nbsp;' . '<A CLASS="default" HREF="http://www.imdb.com/title/tt' . $row_rstMovList['movie_imdb_id'] . '/" TARGET="_blank">'. $row_rstMovList['movie_imdb_rating'] . '</A>';}
        else {echo '&nbsp;' . $row_rstMovList['movie_imdb_rating'];}
        ?>&nbsp;
    </TD>
</TR>
</TABLE>
<BR>
<?php
} // FOR
mysql_free_result($rstMovList);
?>
<?php
$maxPage = ceil($totalMovListX/$rowsPerPage);

if ($s_page > 1)
{
    $page = $s_page - 1;

    if (isset($_GET['list_id'])) {
        $prev = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "movies.php?user_id=".$user_id."&amp;list_id=".$list_id."&amp;s_page=$page&amp;items=$rowsPerPage\">" . "&#60;" . "</A>&nbsp;";
    
        $first = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "movies.php?user_id=".$user_id."&amp;list_id=".$list_id."&amp;s_page=1&amp;items=$rowsPerPage\">" . "&#60;&#60;" . "</A>&nbsp;";
    }
    else if (isset($_GET['sublist_id'])) {
        $prev = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "movies.php?user_id=".$user_id."&amp;sublist_id=".$list_id."&amp;s_page=$page&amp;items=$rowsPerPage\">" . "&#60;" . "</A>&nbsp;";
    
        $first = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "movies.php?user_id=".$user_id."&amp;sublist_id=".$list_id."&amp;s_page=1&amp;items=$rowsPerPage\">" . "&#60;&#60;" . "</A>&nbsp;";
    }    

} 
else
{
    $prev  = "&nbsp;" . "&#60;" . "&nbsp;";
    $first = "&nbsp;" . "&#60;&#60;" . "&nbsp;";
}

if ($s_page < $maxPage)
{
    $page = $s_page + 1;
    if (isset($_GET['list_id'])) {
        $next = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "movies.php?user_id=".$user_id."&amp;list_id=".$list_id."&amp;s_page=$page&amp;items=$rowsPerPage\">" . "&#62;" . "</A>&nbsp;";
    
        $last = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "movies.php?user_id=".$user_id."&amp;list_id=".$list_id."&amp;s_page=$maxPage&amp;items=$rowsPerPage\">" . "&#62;&#62;" . "</A>&nbsp;";
    }
    else if (isset($_GET['sublist_id'])) {
        $next = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "movies.php?user_id=".$user_id."&amp;sublist_id=".$list_id."&amp;s_page=$page&amp;items=$rowsPerPage\">" . "&#62;" . "</A>&nbsp;";
    
        $last = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "movies.php?user_id=".$user_id."&amp;sublist_id=".$list_id."&amp;s_page=$maxPage&amp;items=$rowsPerPage\">" . "&#62;&#62;" . "</A>&nbsp;";
    }
} 
else
{
    $next = "&nbsp;" . "&#62;" . "&nbsp;";
    $last = "&nbsp;" . "&#62;&#62;" . "&nbsp;";
}

echo $first . "&nbsp;" . $prev . "&nbsp;" . "Page" . " <B>$s_page</B> " . "of" . " <B>$maxPage</B>" . "&nbsp;" . $next . "&nbsp;" . $last;
?>
</DIV>
<?php    
} // IF USR_LEVEL
else {
    echo $lnAccessDenied;
}
?>

<?php require_once INC_DIR . 'php3.inc.php'; ?>