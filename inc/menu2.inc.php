<!-- DB MUSIC ########## ########## ########## ########## ########## ########## ##########-->
<?php
switch($stats_page) {
    case "pmc_mus":
    case "pmc_mus_ar":
    case "pmc_mus_tt":
    case "pmc_mus_sr":
    case "pmc_mus_nw": {
?>
<?=$menu2_hdr?>
<?=$menu2_pre?>
<?=menu0('Browse by artist', 'pmc_mus_ar.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Browse by title', 'pmc_mus_tt.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Search', 'pmc_mus_sr.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('New additions', 'pmc_mus_nw.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_ftr?>
<?php
        break;
    }
    default: {
        break;
    }
}
?>
<!-- DB MOVIES ########## ########## ########## ########## ########## ########## ##########-->
<?php
switch($stats_page) {
    case "pmc_mov":
    case "pmc_mov_tt":
    case "pmc_mov_yr":
    case "pmc_mov_ct":
    case "pmc_mov_sr":
    case "pmc_mov_sra":
    case "pmc_mov_nw": {
?>
<?=$menu2_hdr?>
<?=$menu2_pre?>
<?=menu0('Browse by title', 'pmc_mov_tt.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Browse by year', 'pmc_mov_yr.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Browse by category', 'pmc_mov_ct.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Search', 'pmc_mov_sr.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Advanced Search', 'pmc_mov_sra.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('New additions', 'pmc_mov_nw.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_ftr?>
<?php
        break;
    }
    default: {
        break;
    }
}
?>
<!-- ALL/MY MUSIC ########## ########## ########## ########## ########## ########## ##########-->
<?php
switch($stats_page) {
    case "my_mus":
    case "my_mus_ar":
    case "my_mus_tt":
    case "my_mus_sr":
    case "my_mus_nw":
    case "my_mus_wl": {
?>
<?=$menu2_hdr?>
<?=$menu2_pre?>
<?=menu0('Browse by artist', 'my_mus_ar.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Browse by title', 'my_mus_tt.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Search', 'my_mus_sr.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('New additions', 'my_mus_nw.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Wishlist', 'my_mus_wl.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_ftr?>
<?php
        break;
    }
    default: {
        break;
    }
}
?>
<!-- ALL/MY MOVIES ########## ########## ########## ########## ########## ########## ##########-->
<?php
switch($stats_page) {
    case "my_mov":
    case "my_mov_tt":
    case "my_mov_yr":
    case "my_mov_ct":
    case "my_mov_sr":
    case "my_mov_nw":
    case "my_mov_wl": {
?>
<?=$menu2_hdr?>
<?=$menu2_pre?>
<?=menu0('Browse by title', 'my_mov_tt.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Browse by year', 'my_mov_yr.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Browse by category', 'my_mov_ct.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Search', 'my_mov_sr.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('New additions', 'my_mov_nw.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_pre?>
<?=menu0('Wishlist', 'my_mov_wl.php', $_SESSION['usr_level'], 0);?>
<?=$menu2_suf?>
<?=$menu2_ftr?>
<?php
        break;
    }
    default: {
        break;
    }
}
?>