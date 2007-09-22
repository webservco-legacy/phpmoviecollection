<?php
require_once './inc/config.inc.php';
require_once INC_DIR . 'php1.inc.php';

$page_title = SITE_TITLE . ' - ' . $lnMMyDiscs . ' - ' . $lnMDiscsAdd;
$stats_page = 'add_dsc';
//$required = 'add_dsc.inc.php';

require_once INC_DIR . 'php2pop.inc.php';
?>
<?php 
if ($_SESSION['usr_level'] >= 2) {
?>
<A CLASS="default" HREF="Javascript:closeProgram();">close and refresh</A>
<?php
}
else {
    echo $lnAccessDenied;
}
?>
<?php require_once INC_DIR . 'php3pop.inc.php'; ?>