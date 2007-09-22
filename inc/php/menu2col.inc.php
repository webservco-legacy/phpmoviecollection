<?=$menu2_hdr?>
<?=$menu2_pre?>
<?=menu0($lnMMovies, 'list.php?user_id='.$user_id . '&amp;list=movies', $_SESSION['usr_level'], 1);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0($lnMTVShows, 'list.php?user_id='.$user_id . '&amp;list=tvshows', $_SESSION['usr_level'], 1);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0($lnMMusic, 'list.php?user_id='.$user_id . '&amp;list=music', $_SESSION['usr_level'], 1);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0($lnMSoftware, 'list.php?user_id='.$user_id . '&amp;list=software', $_SESSION['usr_level'], 1);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0($lnMGames, 'list.php?user_id='.$user_id . '&amp;list=games', $_SESSION['usr_level'], 1);?>
<?=$menu2_suf?>
<?=$menu2_ftr?>