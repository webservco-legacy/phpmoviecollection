<?php
error_reporting(E_ALL);

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$begintime = $time;

require_once INC_DIR . 'dbopen.inc.php';
require_once INC_DIR . 'functions.inc.php';
require_once INC_DIR . 'ubmydate.php';

// START SESSION
session_start();
// CHECK USER AND DEFINE SETTINGS
$_SESSION['visit_date'] = date("Y-m-d");
$_SESSION['visit_time'] = date("H:i:s");

require_once INC_DIR . 'get.inc.php';

if (!isset($_SESSION['logged_in'])) {
    session_regenerate_id();
    
    $_SESSION['usr_id'] = '0';
    $_SESSION['usr_level'] = '0';
    $_SESSION['user_alias'] = 'Visitor';

    // DEFAULT THEME
    $_SESSION['usr_theme_dir'] = DEFAULT_THEME;
    require_once THEME_DIR . $_SESSION['usr_theme_dir'] . '/' . $_SESSION['usr_theme_dir'] . '.info.php';
    require_once THEME_DIR . $_SESSION['usr_theme_dir'] . '/theme.inc.php';
    $_SESSION['usr_theme_name'] = $theme_name;
    $_SESSION['usr_theme_version'] = $theme_version;
    $_SESSION['usr_theme_author'] = $theme_author;
    $_SESSION['usr_theme_notes'] = $theme_notes;

    // DEFAULT LANGUAGE
    $_SESSION['usr_lang_index'] = DEFAULT_LANG;
    
    require_once INC_DIR . 'login.inc.php';
} // if session
else if (isset($_SESSION['logged_in'])) {
    $user_login_status = 'logged in earlier';
    // user is logged in
} // else session
// END SESSION

// LANGUAGE
$req_lang = '/' . $_SESSION['usr_lang_index'] . '.inc.php';
require_once LN_DIR . $_SESSION['usr_lang_index'] . $req_lang;

// THEME
require_once THEME_DIR . $_SESSION['usr_theme_dir'] . '/' . $_SESSION['usr_theme_dir'] . '.info.php';
require_once THEME_DIR . $_SESSION['usr_theme_dir'] . '/theme.inc.php';
?>