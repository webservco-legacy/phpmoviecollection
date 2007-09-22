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
    //case "col_usr":
    case "list":
    case "list_movies":
    case "movies": {
        require_once PHP_DIR . 'menu3mov.inc.php';
        break;
    }
    // MY COLLECTION
    case "my_dsc_other":
    case "my_dsc_give":
    case "my_dsc_sell":
    case "my_dsc_drop": {
        require_once PHP_DIR . 'menu3my.inc.php';
        break;
    }
    case "add_dsc":
    case "add_dsc_brn":
    case "add_dsc_buy":
    case "add_dsc_mag":
    case "add_dsc_mag_2":
    case "add_dsc_get":
    case "add_dsc_get_2":
    case "add_dsc_oth":
    case "add_dsc_oth_2": {
        require_once PHP_DIR . 'menu3adddisc.inc.php';
        break;
    }
    case "mod_dsc":
    case "mod_dsc_col":
    case "mod_dsc_giv":
    case "mod_dsc_drp":
    case "add_dsc_brn_3": {
        require_once PHP_DIR . 'menu3moddisc.inc.php';
        break;
    }    
    case "my_dsc_col": {
        require_once PHP_DIR . 'menu3my_dsc_col.inc.php';
        break;
    }
    case "my_dsc_ses":
    case "my_dsc_ses_add":
    case "my_dsc_ses_view":
    case "add_dsc_brn_2": {
        require_once PHP_DIR . 'menu3my_dsc_ses.inc.php';
        break;
    }
    case "dsc_mod":
    case "dsc_mod_add":
    case "dsc_mod_view": {
        require_once PHP_DIR . 'menu3my_dsc_mod.inc.php';
        break;
    }
    // ADMIN
    case "my_set":
    case "my_set_thm":
    case "my_set_lang":
    case "my_set_temp": {
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