<?php
error_reporting(E_ALL);

require_once './inc/config.inc.php';
require_once INC_DIR . 'functions.inc.php';

session_start();
if (isset($_SESSION['logged_in'])) {
    $_SESSION = array();
    /* // cookie removal code by  powerlord at spamless dot vgmusic dot com */
    //powerlord at spamless dot vgmusic dot com (19-Nov-2002 07:41)
    //This code might be a bit better for expiring session cookies, in case your domain, path, and/or secure session cookie settings are changed.
    $CookieInfo = session_get_cookie_params();
    if ( (empty($CookieInfo['domain'])) && (empty($CookieInfo['secure'])) ) {
        setcookie(session_name(), '', time()-3600, $CookieInfo['path']);
    }
    elseif (empty($CookieInfo['secure'])) {
        setcookie(session_name(), '', time()-3600, $CookieInfo['path'], $CookieInfo['domain']);
    }
    else {
        setcookie(session_name(), '', time()-3600, $CookieInfo['path'], $CookieInfo['domain'], $CookieInfo['secure']);
    }
    unset($_COOKIE[session_name()]);
    /* // cookie removal code by  powerlord at spamless dot vgmusic dot com */

    session_destroy();
    $site_root = PMC_ROOT;
    header("Location: $site_root");
    exit;
}
else {
    session_destroy();
    $site_root = PMC_ROOT;
    header("Location: $site_root");
    exit;
}   
?>