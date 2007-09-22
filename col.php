<?php
require_once './inc/config.inc.php';
require_once INC_DIR . 'php1.inc.php';

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $query_rstOneCollector = "SELECT `usr_display` FROM `pmc_set_usr` WHERE `usr_id` = '".$user_id."' LIMIT 1";
        $rstOneCollector=mysql_query($query_rstOneCollector) or die('Oups!<br>' . mysql_error());
        $ColUserName = mysql_result($rstOneCollector, 0);
        mysql_free_result($rstOneCollector);
        $page_title = SITE_TITLE . ' - ' . $ColUserName . $lnMUsersCollection;
        $stats_page = 'col_usr';
        $required = 'colusr.inc.php';
    } // IF ACTION
    else {
            $page_title = SITE_TITLE . ' - ' . $lnMAllCollections;
            $stats_page = 'col';
            $required = 'col.inc.php';
    }
    
require_once INC_DIR . 'php2.inc.php';
?>
<?php 
if ($_SESSION['usr_level'] >= 1) {
    require_once PG_DIR . $required;
}
else {
    echo $lnAccessDenied;
}
?>

<?php require_once INC_DIR . 'php3.inc.php'; ?>