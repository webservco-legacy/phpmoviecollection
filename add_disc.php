<?php
require_once './inc/config.inc.php';
require_once INC_DIR . 'php1.inc.php';

        if (isset($_GET['add'])) {
            $add = $_GET['add'];
            switch($add) {
                case "burn": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsAdd . ' - ' . $lnMDiscsAddBurn;
                    $stats_page = 'add_dsc_brn';
                    $required = 'add_dsc_brn.inc.php';
                    break;
                }
                case "get": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsAdd . ' - ' . $lnMDiscsAddGet;
                    $stats_page = 'add_dsc_get';
                    $required = 'add_dsc_get.inc.php';
                    break;
                }
                case "mag": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsAdd . ' - ' . $lnMDiscsAddMag;
                    $stats_page = 'add_dsc_mag';
                    $required = 'add_dsc_mag.inc.php';
                    break;
                }
                case "other": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsAdd . ' - ' . $lnMDiscsAddOther;
                    $stats_page = 'add_dsc_oth';
                    $required = 'add_dsc_oth.inc.php';
                    break;
                }
                default: {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsAdd;
                    $stats_page = 'add_dsc';
                    $required = 'add_dsc.inc.php';
                    break;
                }
            }
        }
        else {
            $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsAdd;
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