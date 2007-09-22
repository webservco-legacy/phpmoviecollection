<?php
$query_rstTempList = "SELECT `list_id` FROM `pmc_usr_lists` WHERE `list_type` = '2' LIMIT 1";
$rstTempList = mysql_query($query_rstTempList) or die('Oups!<br>' . mysql_error());
$totalTemp = mysql_num_rows($rstTempList);
if ($totalTemp != '0') {
    $row_rstTempList = mysql_fetch_assoc($rstTempList);
    $templist_id = $row_rstTempList['list_id'];
}
else {
    $templist_id = '0';
}
mysql_free_result($rstTempList);

$query_rstWishList = "SELECT `list_id` FROM `pmc_usr_lists` WHERE `list_type` = '3' LIMIT 1";
$rstWishList = mysql_query($query_rstWishList) or die('Oups!<br>' . mysql_error());
$totalWish = mysql_num_rows($rstWishList);
if ($totalWish != '0') {
    $row_rstWishList = mysql_fetch_assoc($rstWishList);
    $wishlist_id = $row_rstWishList['list_id'];
}
else {
    $wishlist_id = '0';
}
mysql_free_result($rstWishList); 

$query_rstLookList = "SELECT `list_id` FROM `pmc_usr_lists` WHERE `list_type` = '4' LIMIT 1";
$rstLookList = mysql_query($query_rstLookList) or die('Oups!<br>' . mysql_error());
$totalWish = mysql_num_rows($rstLookList);
if ($totalWish != '0') {
    $row_rstLookList = mysql_fetch_assoc($rstLookList);
    $looklist_id = $row_rstLookList['list_id'];
}
else {
    $looklist_id = '0';
}
mysql_free_result($rstLookList); 
?>
<?=$menu2_hdr?>
<?=$menu2_pre?>
<?=menu0($lnMLists, 'list.php?user_id='.$user_id . '&amp;list=movies', $_SESSION['usr_level'], 1);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?php if ($templist_id != '0') { ?>
<?=menu0($lnMTempList, 'movies.php?user_id='.$user_id . '&amp;list_id=' . $templist_id, $_SESSION['usr_level'], 1);?>
<?php } else echo $lnMTempList;?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?php if ($wishlist_id != '0') { ?>
<?=menu0($lnMWishList, 'movies.php?user_id='.$user_id . '&amp;list_id=' . $wishlist_id, $_SESSION['usr_level'], 1);?>
<?php } else echo $lnMWishList;?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?php if ($looklist_id != '0') { ?>
<?=menu0($lnMLookList, 'movies.php?user_id='.$user_id . '&amp;list_id=' . $looklist_id, $_SESSION['usr_level'], 1);?>
<?php } else echo $lnMLookList;?>
<?=$menu2_suf?>
<?=$menu2_ftr?>