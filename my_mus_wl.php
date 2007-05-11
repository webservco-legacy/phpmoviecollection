<?php
error_reporting(E_ALL);

// START PAGE EXECUTION COUNTER
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$begintime = $time;

require_once './inc/config.inc.php';
require_once INC_DIR . 'functions.inc.php';
require INC_DIR . 'dbopen.inc.php';
$page_title = SITE_TITLE . ' - ' . 'Page Title';
$stats_page = 'my_mus_wl';
require_once INC_DIR . 'html.inc.php';
?>
<?php require THEME_DIR . $_SESSION['usr_theme_dir'] . '/header.inc.php';?>
<HR COLOR="#ededed">
<?=$stats_page?>
<HR COLOR="#ededed">
<?php require THEME_DIR . $_SESSION['usr_theme_dir'] . '/footer.inc.php';?>
<?php
// START PAGE EXECUTION COUNTER
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$endtime = $time;
$totaltime = ($endtime - $begintime);
echo '<BR>parse time: ' .$totaltime. ' seconds.';
?>
</BODY>
</HTML>
<?php require INC_DIR . 'dbclose.inc.php'; ?>