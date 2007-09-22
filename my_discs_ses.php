<?php
require_once './inc/config.inc.php';
require_once INC_DIR . 'php1.inc.php';

        if (isset($_GET['act'])) {
            $act = $_GET['act'];
            switch($act) {
                case "add": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsRecSessions . ' - ' . $lnMDiscsRecNewSession;
                    $stats_page = 'my_dsc_ses_add';
                    $required = 'my_dsc_ses_add.inc.php';
                    break;
                }
                case "view": {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsRecSessions . ' - ' . $lnMDiscsRecViewSessions;
                    $stats_page = 'my_dsc_ses_view';
                    $required = 'my_dsc_ses_view.inc.php';
                    break;
                }
                default: {
                    $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsRecSessions;
                    $stats_page = 'my_dsc_ses';
                    $required = 'my_dsc_ses.inc.php';
                    break;
                }
            }
        }
        else {
            $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs;
            $stats_page = 'my_dsc_ses';
            $required = 'my_dsc_ses.inc.php';
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