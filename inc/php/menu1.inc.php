<?php
switch($stats_page) {
    // HOME
    case "index": 
    case "index": {
         break;
    }
    // PMC DATABASE
    case "index": {
        break;
    }
    // ALL COLLECTIONS
    case "col":
    case "col_usr":
    case "list":
    case "list_movies":
    case "list_tvshows":
    case "list_music":
    case "list_software":
    case "list_games":
    case "movies": {
        require_once PHP_DIR . 'menu1col.inc.php';
        break;
    }
    // MY COLLECTION
    case "my":
    case "my_dsc":
    case "my_dsc_col":
    case "my_dsc_other":
    case "my_dsc_give":
    case "my_dsc_sell":
    case "my_dsc_drop":
    case "add_dsc":
    case "add_dsc_brn":
    case "add_dsc_brn_2":
    case "add_dsc_brn_3":
    case "add_dsc_buy":
    case "add_dsc_mag":
    case "add_dsc_mag_2":
    case "add_dsc_get":
    case "add_dsc_get_2":
    case "add_dsc_oth":
    case "add_dsc_oth_2":
    case "mod_dsc":
    case "mod_dsc_col":
    case "mod_dsc_giv":
    case "mod_dsc_drp":
    case "my_dsc_ses":
    case "my_dsc_ses_add":
    case "my_dsc_ses_view":
    case "dsc_mod":
    case "dsc_mod_add":
    case "dsc_mod_view": {
        require_once PHP_DIR . 'menu1my.inc.php';
        break;
    }
    // ADMIN
    case "admin":
    case "my_set":
    case "my_set_thm":    
    case "my_set_lang":
    case "my_set_temp": {
        require_once PHP_DIR . 'menu1adm.inc.php';
        break;
    }
    // HELP
    case "index": {
        break;
    }
    // ABOUT
    case "index": {
        break;
    }
    default: {
        break;
    }
}
?>