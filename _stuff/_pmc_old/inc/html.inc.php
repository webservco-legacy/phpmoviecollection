<?php
// START SESSION
session_start();
// CHECK USER AND DEFINE SETTINGS
$_SESSION['visit_date'] = date("Y-m-d");
$_SESSION['visit_time'] = date("H:i:s");

if (!isset($_SESSION['logged_in'])) {
    session_regenerate_id();
    
    $_SESSION['usr_id'] = '0';
    $_SESSION['usr_level'] = '0';
    $_SESSION['user_alias'] = 'Visitor';

    // DEFAULT THEME
    $query_default_theme = "SELECT * FROM `pmc_set_themes` WHERE `theme_id` = '".DEFAULT_THEME."'";
    $rst_default_theme   = mysql_query($query_default_theme) or die('Oups!<br>' . mysql_error());
    $row_default_theme = mysql_fetch_assoc($rst_default_theme);
    $_SESSION['usr_theme_name'] = $row_default_theme['theme_name'];
    $_SESSION['usr_theme_dir'] = $row_default_theme['theme_dir'];
    $_SESSION['usr_theme_notes'] = $row_default_theme['theme_notes'];
    mysql_free_result($rst_default_theme);

    // DEFAULT LANGUAGE
    $_SESSION['usr_lang_index'] = DEFAULT_LANG;
}

// START STATISTICS
require_once INC_DIR . 'stats.inc.php';
// END STATISTICS

if (!isset($_SESSION['logged_in'])) {
   require_once INC_DIR . 'login.inc.php';
} // if session
else if (isset($_SESSION['logged_in'])) {
    $user_login_status = 'logged in earlier';
    // user is logged in
} // else session
// END SESSION

// LIMBA
$query_lang = "SELECT * FROM `pmc_set_lang` WHERE `lang_index` = '".$_SESSION['usr_lang_index']."' LIMIT 1";
$rst_lang   = mysql_query($query_lang) or die('Oups!<br>' . mysql_error());
$lang = mysql_fetch_assoc($rst_lang);

// THEME
require_once THEME_DIR . $_SESSION['usr_theme_dir'] . '/theme.inc.php';
?>