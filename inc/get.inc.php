<?php
if (isset($_GET['theme'])) {
    if($_SESSION['usr_id'] != '0' && $_SESSION['usr_level'] >= '2') {
        $new_theme = $_GET['theme'];
        $query_new_theme = "UPDATE `pmc_set_usr` SET `usr_theme` = '".$new_theme."' WHERE `usr_id` = '".$_SESSION['usr_id']."'";
        mysql_query($query_new_theme) or die('Oups!<br>' . mysql_error());
        $_SESSION['usr_theme_dir'] = $new_theme;
        require_once THEME_DIR . $_SESSION['usr_theme_dir'] . '/' . $_SESSION['usr_theme_dir'] . '.info.php';
        require_once THEME_DIR . $_SESSION['usr_theme_dir'] . '/theme.inc.php';
        $_SESSION['usr_theme_name'] = $theme_name;
        $_SESSION['usr_theme_version'] = $theme_version;
        $_SESSION['usr_theme_author'] = $theme_author;
        $_SESSION['usr_theme_notes'] = $theme_notes;
    }
}
if (isset($_GET['ln'])) {
    if($_SESSION['usr_id'] != '0' && $_SESSION['usr_level'] >= '2') {
        $new_lang = $_GET['ln'];
        $query_new_lang = "UPDATE `pmc_set_usr` SET `lang_index` = '".$new_lang."' WHERE `usr_id` = '".$_SESSION['usr_id']."'";
        mysql_query($query_new_lang) or die('Oups!<br>' . mysql_error());
        $_SESSION['usr_lang_index'] = $new_lang;
    }
}
?>