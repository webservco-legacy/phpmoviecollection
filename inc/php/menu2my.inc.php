<?=$menu2_hdr?>
<?=$menu2_pre?>
<?=menu0($lnMDiscsCollection, 'my_discs.php?dsc=col', $_SESSION['usr_level'], 2);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0($lnMDiscsNonCollection, 'my_discs.php?dsc=other', $_SESSION['usr_level'], 2);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0($lnMDiscsAdd, 'add_disc.php', $_SESSION['usr_level'], 2);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0($lnMDiscsMod, 'mod_disc.php', $_SESSION['usr_level'], 2);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0($lnMDiscsRecSessions, 'my_discs_ses.php', $_SESSION['usr_level'], 2);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0($lnMDiscsModel, 'dsc_mod.php', $_SESSION['usr_level'], 2);?>
<?=$menu2_suf?>
<?=$menu2_ftr?>