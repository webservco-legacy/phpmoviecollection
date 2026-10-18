<?php
//
?>
<?php

$s_page = 1;
if(isset($_GET['s_page'])) { $s_page = $_GET['s_page']; }
                
$rowsPerPage = 5;
if(isset($_POST['items'])) { $rowsPerPage = $_POST['items']; }
else if(isset($_GET['items'])) { $rowsPerPage = $_GET['items']; }

$offset = ($s_page - 1) * $rowsPerPage;

$query_rstListsX = "SELECT * FROM `pmc_usr_lists` WHERE `usr_id` = '".$user_id."' AND `list_type` = '1' AND `list_display` = '1' ORDER BY `list_tt` ASC";
$rstListsX = mysql_query($query_rstListsX) or die('Oups!<br>' . mysql_error());
$totalListsX = mysql_num_rows($rstListsX);
mysql_free_result($rstListsX);

$query_rstLists = $query_rstListsX . " LIMIT $offset, $rowsPerPage";
$rstLists = mysql_query($query_rstLists) or die('Oups!<br>' . mysql_error());
$totalLists = mysql_num_rows($rstLists);

$query_rstAllMov = "SELECT * FROM `pmc_usr_mov` WHERE `usr_id` = '".$user_id."'";
$rstAllMov = mysql_query($query_rstAllMov) or die('Oups!<br>' . mysql_error());
$totalMovies = mysql_num_rows($rstAllMov);
mysql_free_result($rstAllMov);
?>
<DIV CLASS="pg_title">
<?=$ColUserName . $lnMUsersCollection . ' - ' . $lnMMovies?>
</DIV>
<DIV CLASS="pg_subtitle">
<TABLE CELLPADDING="0" CELLSPACING="0" ALIGN="center" BORDER="0">
<TR>
    <TD CLASS="list_tt_01">
        <?=$lnLsTotalLists?>&#58;
    </TD>
    <TD CLASS="list_tt_02">
        <?=$totalListsX?>
    </TD>
</TR>
<TR>
    <TD CLASS="list_tt_01">
        <?=$lnLsTotalTitles?>&#58;
    </TD>
    <TD CLASS="list_tt_02">
        <?=$totalMovies?>
    </TD>
</TR>
</TABLE>
</DIV>
<BR>
<DIV CLASS="pg_content">
<?php
if ($s_page == '1') {
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
for ($i=1; $i<=$totalLists; $i++) {
    $row_rstLists = mysql_fetch_assoc($rstLists);
    $query_rstSubList = "SELECT * FROM `pmc_usr_sublists` WHERE list_id = '".$row_rstLists['list_id']."'";
    $rstSubList = mysql_query($query_rstSubList) or die('Oups!<br>' . mysql_error());
    $totalSubLists = mysql_num_rows($rstSubList);
    mysql_free_result($rstSubList);
    
    $query_rstMovList = "SELECT * FROM `pmc_usr_mov`, `pmc_mov_titles` WHERE pmc_usr_mov.list_id = '".$row_rstLists['list_id']."' AND pmc_usr_mov.movie_id = pmc_mov_titles.movie_id ORDER BY pmc_mov_titles.movie_informal_title ASC";
    $rstMovList = mysql_query($query_rstMovList) or die('Oups!<br>' . mysql_error());
    $totalMovList = mysql_num_rows($rstMovList);
    mysql_free_result($rstMovList);
    
    $query_rstMovSubList = "SELECT * FROM `pmc_usr_mov`, `pmc_mov_titles` WHERE pmc_usr_mov.sublist_id = '".$row_rstLists['list_id']."' AND pmc_usr_mov.movie_id = pmc_mov_titles.movie_id ORDER BY pmc_mov_titles.movie_informal_title ASC";
    $rstMovSubList = mysql_query($query_rstMovSubList) or die('Oups!<br>' . mysql_error());
    $totalMovSubList = mysql_num_rows($rstMovSubList);
    mysql_free_result($rstMovSubList);
    
    $totalMov = $totalMovList + $totalMovSubList;
    
    if ($row_rstLists['list_the'] != '') {
        $list_title = $row_rstLists['list_the'] . '&nbsp;' . $row_rstLists['list_tt'];
    }
    else {
        $list_title = $row_rstLists['list_tt'];
    }
?>
<TABLE CLASS="movie_list" CELLPADDING="0" CELLSPACING="1" ALIGN="<?=$defaultTableAlign?>">
<TR>
    <TD CLASS="movie_list_pic">
        <?php
        $query_rstListPosters = "SELECT `list_pic_file` FROM `pmc_usr_list_pics` WHERE `list_id` = '".$row_rstLists['list_id']."' AND `list_pic_usr` = '".$user_id."' AND `list_pic_type` = '1'";
        $rstListPosters=mysql_query($query_rstListPosters) or die('Oups!<br>' . mysql_error());
        if (mysql_num_rows($rstListPosters) != '0') {
            $mov_poster_nr = rand(1, mysql_num_rows($rstListPosters));
            $movie_poster_path = PIC_DIR . 'lists/';
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
    <TD CLASS="movie_list_tt">
        <TABLE CELLPADDING="0" CELLSPACING="0" ALIGN="center">
        <TR>
            <TD CLASS="movie_list_tt_01">
                &nbsp;<A CLASS="list_tt" HREF="<?=PMC_ROOT?>movies.php?user_id=<?=$user_id?>&amp;list_id=<?=$row_rstLists['list_id']?>"><?=$list_title?></A>&nbsp;
            </TD>
        </TR>
        <TR>
            <TD CLASS="movie_list_tt_02">
                &nbsp;<?php if ($row_rstLists['list_notes'] != '') {echo '&#91;' . $row_rstLists['list_notes'] . '&#93;';} else {echo '&nbsp';} ?>&nbsp;
            </TD>
        </TR>
        </TABLE>
    </TD>
    <TD CLASS="movie_list_dt">
        <TABLE CELLPADDING="0" CELLSPACING="0" ALIGN="center">
        <TR>
            <TD CLASS="movie_list_dt_01">
                <?=$lnLsTotalTitles?>:
            </TD>
            <TD CLASS="movie_list_dt_02">
                <?=$totalMov?>
            </TD>
        </TR>
        <TR>
            <TD CLASS="movie_list_dt_01">
                <?=$lnLsTotalSubLists?>:
            </TD>
            <TD CLASS="movie_list_dt_02">
                <?=$totalSubLists?>
            </TD>
        </TR>
        <TR>
            <TD CLASS="movie_list_dt_01">
                <?=$lnLsTitlesList?>:
            </TD>
            <TD CLASS="movie_list_dt_02">
                <?=$totalMovList?>
            </TD>
        </TR>
        <TR>
            <TD CLASS="movie_list_dt_01">
                <?=$lnLsTitlesSubLists?>:
            </TD>
            <TD CLASS="movie_list_dt_02">
                <?=$totalMovSubList?>
            </TD>
        </TR>
        </TABLE>
    </TD>
</TR>
</TABLE>
<BR>
<?php    
}
mysql_free_result($rstLists);
?>
<?php
$maxPage = ceil($totalListsX/$rowsPerPage);

if ($s_page > 1)
{
    $page = $s_page - 1;

    $prev = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "list.php?user_id=".$user_id."&amp;list=movies&amp;s_page=$page&amp;items=$rowsPerPage\">" . "&#60;" . "</A>&nbsp;";
    
    $first = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "list.php?user_id=".$user_id."&amp;list=movies&amp;s_page=1&amp;items=$rowsPerPage\">" . "&#60;&#60;" . "</A>&nbsp;";
    

} 
else
{
    $prev  = "&nbsp;" . "&#60;" . "&nbsp;";
    $first = "&nbsp;" . "&#60;&#60;" . "&nbsp;";
}

if ($s_page < $maxPage)
{
    $page = $s_page + 1;

    $next = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "list.php?user_id=".$user_id."&amp;list=movies&amp;s_page=$page&amp;items=$rowsPerPage\">" . "&#62;" . "</A>&nbsp;";
    
    $last = "&nbsp;<A CLASS=\"default\" HREF=\"" . PMC_ROOT . "list.php?user_id=".$user_id."&amp;list=movies&amp;s_page=$maxPage&amp;items=$rowsPerPage\">" . "&#62;&#62;" . "</A>&nbsp;";
} 
else
{
    $next = "&nbsp;" . "&#62;" . "&nbsp;";
    $last = "&nbsp;" . "&#62;&#62;" . "&nbsp;";
}

echo $first . "&nbsp;" . $prev . "&nbsp;" . "Page" . " <B>$s_page</B> " . "of" . " <B>$maxPage</B>" . "&nbsp;" . $next . "&nbsp;" . $last;
?>
</DIV>
