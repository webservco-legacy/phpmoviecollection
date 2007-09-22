<?php
/* ********** ********** ********** START EDITING  ********** ********** ********** */
$dbhost = 'localhost';
$dbuser = 'pmc';
$dbpass = 'REDACTED';
$dbname = 'underbeat_00';

// SITE ROOT
define("PMC_ROOT","http://86.123.192.163:1980/pmc/");
define("PMC_DIR","d:/home/devel/server/htdocs/pmc/");

/* ********** ********** ********** STOP EDITING  ********** ********** ********** */

// HEADER STUFF
define("SITE_TITLE","PhpMyCollection");
define("SITE_DESCRIPTION","description");
define("SITE_KEYWORDS","keywords");

// ADMIN
define("ADM_DIR",PMC_DIR . "admin/");
define("ADM_URL",PMC_ROOT . "admin/");

define("ADM_PG_DIR",ADM_DIR . "admpg/");
define("ADM_PG_URL",ADM_URL . "admpg/");

// INCLUDES
define("INC_DIR",PMC_DIR . "inc/");
define("INC_URL",PMC_ROOT . "inc/");

// PHP
define("PHP_DIR",INC_DIR . "php/");
define("PHP_URL",INC_URL . "php/");

//JAVASCRIPT
define("JS_DIR",INC_DIR . "js/");
define("JS_URL",INC_URL . "js/");

// PAGES
define("PG_DIR",INC_DIR . "pages/");
define("PG_URL",INC_URL . "pages/");

// FONTS
define("TTF_DIR",INC_DIR . "fonts/");
//define("TTF_URL",INC_URL . "fonts/");

// GRAPHICS
define("GRAPH_DIR",INC_DIR . "graphics/");
//define("GRAPH_URL",INC_URL . "graphics/");

//VAR - PICTURES
define("PIC_DIR",PMC_DIR . "var/pictures/");
define("PIC_URL",PMC_ROOT . "var/pictures/");

// THEMES
define("THEME_DIR",PMC_DIR . "themes/");
define("THEME_URL",PMC_ROOT . "themes/");
define("DEFAULT_THEME","simple");

// LANGUAGES
define("LN_DIR",PMC_DIR . "langs/");
//define("LN_URL",PMC_ROOT . "langs/");
define("DEFAULT_LANG","en");
?>