<HR COLOR="#ededed">
<?php require THEME_DIR . $_SESSION['usr_theme_dir'] . '/footer.inc.php'; ?>
<HR COLOR="#ededed">
<?php
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$endtime = $time;
$totaltime = ($endtime - $begintime);
echo '<BR>parse time: ' .$totaltime. ' seconds.';

require_once INC_DIR . 'dbclose.inc.php';
?>

</BODY>
</HTML>