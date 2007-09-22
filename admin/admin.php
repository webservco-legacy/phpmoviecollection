<?php
require_once '../inc/config.inc.php';
require_once INC_DIR . 'php1.inc.php';

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch($action) {
            case "adm": {
                $page_title = SITE_TITLE . ' - ' . $lnMAdmin;
                $stats_page = 'admin';
                $required = 'adm.inc.php';
                break;
            }
            default: {
                $page_title = SITE_TITLE . ' - ' . $lnMAdmin;
                $stats_page = 'admin';
                $required = 'adm.inc.php';
                break;
            }
        }
    } // IF ACTION
    else {
            $page_title = SITE_TITLE . ' - ' . $lnMAdmin;
            $stats_page = 'admin';
            $required = 'adm.inc.php';
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