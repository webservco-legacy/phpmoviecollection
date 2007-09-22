<?php
require_once './inc/config.inc.php';
require_once INC_DIR . 'php1.inc.php';

        if (isset($_GET['dsc'])) {
            $dsc = $_GET['dsc'];
            switch($dsc) {
                case "col": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsCollection;
                    $stats_page = 'my_dsc_col';
                    $required = 'my_dsc_col.inc.php';
                    break;
                }
                case "other": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsNonCollection;
                    $stats_page = 'my_dsc_other';
                    $required = 'my_dsc_oth.inc.php';
                    break;
                }
                case "give": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsGive;
                    $stats_page = 'my_dsc_give';
                    $required = 'my_dsc_giv.inc.php';
                    break;
                }
                case "drop": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsDrop;
                    $stats_page = 'my_dsc_drop';
                    $required = 'my_dsc_drp.inc.php';
                    break;
                }
                default: {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs;
                    $stats_page = 'my_dsc';
                    $required = 'my_dsc.inc.php';
                    break;
                }
            }
        }
        else {
            $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs;
            $stats_page = 'my_dsc';
            $required = 'my_dsc.inc.php';
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