<?php
require_once './inc/config.inc.php';
require_once INC_DIR . 'php1.inc.php';

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $query_rstOneCollector = "SELECT `usr_display` FROM `pmc_set_usr` WHERE `usr_id` = '".$user_id."' LIMIT 1";
        $rstOneCollector=mysql_query($query_rstOneCollector) or die('Oups!<br>' . mysql_error());
        $ColUserName = mysql_result($rstOneCollector, 0);
        mysql_free_result($rstOneCollector);
        
        if (isset($_GET['list'])) {
            $list = $_GET['list'];
            switch($list) {
                case "movies": {
                    $page_title = SITE_TITLE . ' - ' . $ColUserName . $lnMUsersCollection . ' - ' . $lnMMovies;
                    $stats_page = 'list_movies';
                    $required = 'listmovies.inc.php';
                    break;
                }
                case "tvshows": {
                    $page_title = SITE_TITLE . ' - ' . $ColUserName . $lnMUsersCollection . ' - ' . $lnMTVShows;
                    $stats_page = 'list_tvshows';
                    $required = 'listtvshows.inc.php';
                    break;
                }
                case "music": {
                    $page_title = SITE_TITLE . ' - ' . $ColUserName . $lnMUsersCollection . ' - ' . $lnMMusic;
                    $stats_page = 'list_music';
                    $required = 'listmusic.inc.php';
                    break;
                }
                case "software": {
                    $page_title = SITE_TITLE . ' - ' . $ColUserName . $lnMUsersCollection . ' - ' . $lnMSoftware;
                    $stats_page = 'list_software';
                    $required = 'listsoftware.inc.php';
                    break;
                }
                case "games": {
                    $page_title = SITE_TITLE . ' - ' . $ColUserName . $lnMUsersCollection . ' - ' . $lnMGames;
                    $stats_page = 'list_games';
                    $required = 'listgames.inc.php';
                    break;
                }
                default: {
                    $page_title = SITE_TITLE . ' - ' . $ColUserName . $lnMUsersCollection;
                    $stats_page = 'list';
                    $required = 'list.inc.php';
                }
            }
        }
        else {
            $page_title = SITE_TITLE . ' - ' . $ColUserName . $lnMUsersCollection;
            $stats_page = 'list';
            $required = 'list.inc.php';
        }
    } // IF ACTION
    else {
            $page_title = SITE_TITLE . ' - ' . $lnMAllCollections;
            $stats_page = 'list';
            $required = 'list.inc.php';
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