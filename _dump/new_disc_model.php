<?php
require_once './inc/config.inc.php';
require_once INC_DIR . 'php1.inc.php';
        if (isset($_GET['popup'])) {
            $popup = $_GET['popup'];
            switch($popup) {
                case "1": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsModel;
                    $stats_page = 'add_dsc_mod';
                    $required = 'add_dsc_mod.inc.php';
                    break;
                }
                case "0": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsModel;
                    $stats_page = 'add_dsc_mod';
                    $required = 'add_dsc_mod.inc.php';
                    break;
                }
                default: {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsModel;
                    $stats_page = 'add_dsc_mod';
                    $required = 'add_dsc_mod.inc.php';
                    break;
                }
            }
        }
        else {
            $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsModel;
            $stats_page = 'add_dsc';
            $required = 'add_dsc.inc.php';
        }

require_once INC_DIR . 'php2.inc.php';
?>
<?php 
if ($_SESSION['usr_level'] >= 2) {
    require_once PG_DIR . $required;
}
else {
    echo $lnAccessDenied;
}
?>
<?php require_once INC_DIR . 'php3.inc.php'; ?>