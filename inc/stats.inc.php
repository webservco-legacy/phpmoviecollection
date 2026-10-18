<?php
if (isset($_SERVER['REMOTE_ADDR'])) {$stats_ip = $_SERVER['REMOTE_ADDR'];}
else {$stats_ip = 'n/a';}

if (isset($_SERVER['HTTP_USER_AGENT'])) {$stats_browser = $_SERVER['HTTP_USER_AGENT'];}
else {$stats_browser = 'n/a';}

if (isset($_SERVER['REMOTE_HOST'])) {$stats_host = $_SERVER['REMOTE_HOST'];}
else {$stats_host = 'n/a';}

if (isset($_SERVER['HTTP_REFERER'])) {$stats_referer = $_SERVER['HTTP_REFERER'];}
else {$stats_referer = 'n/a';}

if (isset($_SERVER['REQUEST_URI'])) {$stats_requesturi = $_SERVER['REQUEST_URI'];}
else {$stats_requesturi = 'n/a';}

//  WARNING !!!     IP IGNORING BELOW
if ($stats_ip != '88.158.183.248') {
    $query_rstId = "SELECT MAX(`stats_id`) FROM `pmc_var_stats`";
    $rstId=mysql_query($query_rstId) or die('Oups!<br>' . mysql_error());
    $stats_id = (mysql_result($rstId, 0)) + 1;

    $query = "INSERT INTO `pmc_var_stats` (stats_id, usr_id, lang_index, stats_page, stats_ip, stats_date, stats_time, stats_browser, stats_host, stats_referer, stats_requesturi) VALUES ('".$stats_id."', '".$_SESSION['usr_id']."', '".$_SESSION['usr_lang_index']."', '".$stats_page."', '".$stats_ip."', '".$_SESSION['visit_date']."', '".$_SESSION['visit_time']."', '".$stats_browser."', '".$stats_host."', '".$stats_referer."', '".$stats_requesturi."')";
    mysql_query($query) or die('Oups!<br>' . mysql_error());
}
?>