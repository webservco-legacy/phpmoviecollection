-- -- -- -- -- -- -- -- -- --
-- pmc_set_settings
-- -- -- -- -- -- -- -- -- --
--  SETTINGS
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_set_settings`;
CREATE TABLE `pmc_set_settings` (
    `setting_id` int(5) unsigned NOT NULL,
    `setting_name` varchar(30) NOT NULL,
    `setting_value` varchar(30) NOT NULL,
    PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- -- -- -- -- -- -- -- -- --
-- pmc_set_themes
-- -- -- -- -- -- -- -- -- --
--  THEME LIST
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_set_themes`;
CREATE TABLE `pmc_set_themes` (
    `theme_id` int(5) unsigned NOT NULL,
    `theme_dir` varchar(8) NOT NULL,
    `theme_name` varchar(30) NOT NULL,
    `theme_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`theme_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- -- -- -- -- -- -- -- -- --
-- pmc_set_lang
-- -- -- -- -- -- -- -- -- --
--  LANGUAGES
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_set_lang`;
CREATE TABLE `pmc_set_lang` (
    `lang_id` int(5) unsigned NOT NULL,
    `lang_index` char(2) NOT NULL,
    `lang_name` varchar(80) NOT NULL,
    `lang_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- -- -- -- -- -- -- -- -- --
-- -- -- -- -- -- -- -- -- --
-- pmc_set_usr
-- -- -- -- -- -- -- -- -- --
--  USERS
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_set_usr`;
CREATE TABLE `pmc_set_usr` (
    `usr_id` int(5) unsigned NOT NULL,
    `people_id` int(5) unsigned NOT NULL,
    `usr_login` varchar(20) NOT NULL,
    `usr_pass` varchar(20) NOT NULL,
    `usr_level` tinyint(1) unsigned NOT NULL, /*  3 root,  2 collector,  1 user,  0 guest - SET COLLECTORS HERE - make a `rights` table to set who has access to what */
    `usr_status` tinyint(1) unsigned NOT NULL,
    `theme_id` int(5) unsigned NOT NULL,
    `lang_id` int(5) unsigned NOT NULL,
    PRIMARY KEY (`usr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- #################################################################################
--
-- -- -- -- -- -- -- -- -- --
-- pmc_set_people
-- -- -- -- -- -- -- -- -- --
--  COLLECTORS, LOANERS, USERS
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_set_people`;
CREATE TABLE `pmc_set_people` (
    `people_id` int(5) unsigned NOT NULL,
    `people_first_name` varchar(15) NOT NULL,
    `people_middle_name` varchar(15) NOT NULL,
    `people_last_name` varchar(15) NOT NULL,
    `people_nick_name` varchar(30) NOT NULL,
    `people_address` varchar(150) NOT NULL,  
    `people_city` varchar(30) NOT NULL,
    `people_country` smallint(3) unsigned NOT NULL,
    `people_phone` varchar(12) NOT NULL,
    `people_email` varchar(30) NOT NULL,
    `people_www` varchar(90) NOT NULL,
    `people_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`people_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- -- -- -- -- -- -- -- -- --
-- pmc_set_logins
-- -- -- -- -- -- -- -- -- --
--  USER LOGINS
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_set_logins`;
CREATE TABLE `pmc_set_logins` (
    `login_id` int(5) unsigned NOT NULL,
    `usr_id` int(5) unsigned NOT NULL,
    `login_date` date NOT NULL,
    `login_time` time NOT NULL,                
    `stats_id` int(5) NOT NULL,
    PRIMARY KEY (`login_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- -- -- -- -- -- -- -- -- --
-- pmc_set_stats
-- -- -- -- -- -- -- -- -- --
--  TRAFFIC STATS
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_set_stats`;
CREATE TABLE `pmc_set_stats` (
    `stats_id` int(5) unsigned NOT NULL,
    `stats_page` varchar(110) NOT NULL,        
    `stats_ip` varchar(20) NOT NULL,           
    `stats_date` date NOT NULL,                
    `stats_time` time NOT NULL,                
    `stats_browser` varchar(110) NOT NULL,     
    `stats_host` varchar(110) NOT NULL,        
    `stats_referer` varchar(110) NOT NULL,     
    `stats_requesturi` varchar(110) NOT NULL,  
    `usr_id` int(5) NOT NULL,
    PRIMARY KEY (`stats_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -- -- -- -- -- -- -- -- --
-- pmc_set_lists
-- -- -- -- -- -- -- -- -- --
--  USER'S LISTS
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_set_lists`;
CREATE TABLE `pmc_set_lists` (
    `list_id` int(5) unsigned NOT NULL,
    `usr_id` int(5) unsigned NOT NULL,
    `list_type` tinyint(1) unsigned NOT NULL, /* music, movies, music+movies, etc  */
    `list_usr_categ` varchar(30) NOT NULL, /* user's category */
    `list_the` tinyint(1) unsigned NOT NULL,
    `list_tt` varchar(110) NOT NULL,
    `list_start_date` date NOT NULL,
    `list_end_date` date NOT NULL,
    `list_display` tinyint(1) unsigned NOT NULL,
    `list_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- -- -- -- -- -- -- -- -- --
-- pmc_set_names
-- -- -- -- -- -- -- -- -- --
--  NAMES OF PEOPLE INVOLVED IN MUSIC AND FILM
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_set_names`;
CREATE TABLE `pmc_set_names` (
    `name_id` int(5) unsigned NOT NULL,
    `name_music` tinyint(1) unsigned NOT NULL,
    `name_film` tinyint(1) unsigned NOT NULL,
    `name_first_name` varchar(15) NOT NULL,
    `name_middle_name` varchar(15) NOT NULL,
    `name_last_name` varchar(15) NOT NULL,
    `name_nick_name` varchar(30) NOT NULL,
    `name_country` smallint(3) unsigned NOT NULL,
    `name_born` date NOT NULL,
    `name_died` date NOT NULL,
    `name_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`name_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;