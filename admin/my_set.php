<?php
require_once '../inc/config.inc.php';
require_once INC_DIR . 'php1.inc.php';

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch($action) {
            case "thm": {
                $page_title = SITE_TITLE . ' - ' . $lnMAdmin . ' - ' . $lnMChangeTheme;
                $stats_page = 'my_set_thm';
                $required = 'thm.inc.php';
                break;
            }
            case "lang": {
                $page_title = SITE_TITLE . ' - ' . $lnMAdmin . ' - ' . $lnMChangeLang;
                $stats_page = 'my_set_lang';
                $required = 'lang.inc.php';
                break;
            }
            case "temp": {
                $page_title = SITE_TITLE . ' - ' . $lnMAdmin . ' - ' . $lnMTemp;
                $stats_page = 'my_set_temp';
                $required = 'temp.inc.php';
                break;
            }            
            default: {
                $page_title = SITE_TITLE . ' - ' . $lnMAdmin;
                $stats_page = 'my_set';
                $required = 'set.inc.php';
                break;
            }
        }
    } // IF ACTION
    else {
            $page_title = SITE_TITLE . ' - ' . $lnMAdmin;
            $stats_page = 'my_set';
            $required = 'set.inc.php';
    }

require_once INC_DIR . 'php2.inc.php';
?>
<?php 
if ($_SESSION['usr_level'] >= 2) {
    require_once ADM_PG_DIR . $required;
}
else {
    echo $lnAccessDenied;
}
?>
<?php require_once INC_DIR . 'php3.inc.php'; ?>