<?php
require_once './inc/config.inc.php';
require_once INC_DIR . 'php1.inc.php';
  
if (isset($_GET['disc_id']) && isset($_GET['new_disc'])) {
  $disc_id = $_GET['disc_id'];
  $new_disc = $_GET['new_disc'];
  $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsRecNewSession;
  $stats_page = 'add_dsc_brn_2';
  $required = 'dsc_brn_2.inc.php';
}
else {
  $page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsRecNewSession;
  $stats_page = 'add_dsc_brn_2';
  $required = 'add_dsc_brn.inc.php';
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