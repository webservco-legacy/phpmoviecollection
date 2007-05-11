<!-- PMC Database ########## ########## ########## ########## ########## ########## ##########-->
<?php
switch($stats_page) {
    case "pmc": 
    case "pmc_mus":
    case "pmc_mus_ar":
    case "pmc_mus_tt":
    case "pmc_mus_sr":
    case "pmc_mus_nw":
    case "pmc_mov":
    case "pmc_mov_tt":
    case "pmc_mov_yr":
    case "pmc_mov_ct":
    case "pmc_mov_sr":
    case "pmc_mov_sra":
    case "pmc_mov_nw":
    case "pmc_sft":
    case "pmc_gms": {
?>
<?=$menu1_hdr?>
<?=$menu1_pre?>
<?=menu0('Music', 'pmc_mus.php', $_SESSION['usr_level'], 0);?>
<?=$menu1_suf?>
<?=$menu1_pre?>
<?=menu0('Movies', 'pmc_mov.php', $_SESSION['usr_level'], 0);?>
<?=$menu1_suf?>
<?=$menu1_pre?>
<?=menu0('Software', 'pmc_sft.php', $_SESSION['usr_level'], 0);?>
<?=$menu1_suf?>
<?=$menu1_pre?>
<?=menu0('Games', 'pmc_gms.php', $_SESSION['usr_level'], 0);?>
<?=$menu1_suf?>
<?=$menu1_ftr?>
<?php
        break;
    }
    default: {
        break;
    }
}
?>
<!-- ALL COLLECTIONS ########## ########## ########## ########## ########## ########## ##########-->
<?php
switch($stats_page) {
    case "my": 
    case "my_mus":
    case "my_mus_ar":
    case "my_mus_tt":
    case "my_mus_sr":
    case "my_mus_nw":
    case "my_mus_wl":
    case "my_mov":
    case "my_mov_tt":
    case "my_mov_yr":
    case "my_mov_ct":
    case "my_mov_sr":
    case "my_mov_nw":
    case "my_mov_wl":
    case "my_sft":
    case "my_gms": {
?>
<?=$menu1_hdr?>
<?=$menu1_pre?>
<?=menu0('Music', 'my_mus.php', $_SESSION['usr_level'], 0);?>
<?=$menu1_suf?>
<?=$menu1_pre?>
<?=menu0('Movies', 'my_mov.php', $_SESSION['usr_level'], 0);?>
<?=$menu1_suf?>
<?=$menu1_pre?>
<?=menu0('Software', 'my_sft.php', $_SESSION['usr_level'], 0);?>
<?=$menu1_suf?>
<?=$menu1_pre?>
<?=menu0('Games', 'my_gms.php', $_SESSION['usr_level'], 0);?>
<?=$menu1_suf?>
<?=$menu1_ftr?>
<?php
        break;
    }
    default: {
        break;
    }
}
?>