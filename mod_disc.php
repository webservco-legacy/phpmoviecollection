<?php
require_once './inc/config.inc.php';
require_once INC_DIR . 'php1.inc.php';

        if (isset($_GET['mod'])) {
            $mod = $_GET['mod'];
            switch($mod) {
                case "col": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsMod . ' - ' . $lnMDiscsModCol;
                    $stats_page = 'mod_dsc_col';
                    $required = 'mod_dsc_col.inc.php';
                    break;
                }
                case "giv": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsMod . ' - ' . $lnMDiscsModGiv;
                    $stats_page = 'mod_dsc_giv';
                    $required = 'mod_dsc_giv.inc.php';
                    break;
                }
                case "drp": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsMod . ' - ' . $lnMDiscsModDrp;
                    $stats_page = 'mod_dsc_drp';
                    $required = 'mod_dsc_drp.inc.php';
                    break;
                }
                default: {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsMod;
                    $stats_page = 'mod_dsc';
                    $required = 'mod_dsc.inc.php';
                    break;
                }
            }
        }
        else {
            $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsMod;
            $stats_page = 'mod_dsc';
            $required = 'mod_dsc.inc.php';
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