<?php
require_once './inc/config.inc.php';
$popup = '0';
if (isset($_GET['popup'])) {$popup = $_GET['popup'];}
require_once INC_DIR . 'php1.inc.php';
        if (isset($_GET['act'])) {
            $act = $_GET['act'];
            switch($act) {
                case "add": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsModel . ' - ' . $lnMDiscsModelAdd;
                    $stats_page = 'dsc_mod_add';
                    $required = 'dsc_mod_add.inc.php';
                    break;
                }
                case "view": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsModel . ' - ' . $lnMDiscsModelView;
                    $stats_page = 'dsc_mod_view';
                    $required = 'dsc_mod_view.inc.php';
                    break;
                }
                default: {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsModel;
                    $stats_page = 'dsc_mod';
                    $required = 'dsc_mod.inc.php';
                    break;
                }
            }
        }
        else {
            $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsModel;
            $stats_page = 'dsc_mod';
            $required = 'dsc_mod.inc.php';
        }

if ($popup == '0') {require_once INC_DIR . 'php2.inc.php';} else {require_once INC_DIR . 'php2pop.inc.php';}
?>
<?php 
if ($_SESSION['usr_level'] >= 2) {
    require_once PG_DIR . $required;
}
else {
    echo $lnAccessDenied;
}
?>
<?php if ($popup == '0') {require_once INC_DIR . 'php3.inc.php';} else {require_once INC_DIR . 'php3pop.inc.php';} ?>