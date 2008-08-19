-- phpMyMovieCollection
-- DATABASE DEFAULT VALUES

-- ////////////////////////////////////////////////////////////////////////////////
-- PART ONE: ACTUAL COLLECTION
-- ////////////////////////////////////////////////////////////////////////////////

-- --------------------------------------------------------------------------------
-- CATEGORIES
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmmc_mov_cat;


-- --------------------------------------------------------------------------------
-- MOVIES
-- --------------------------------------------------------------------------------
TRUNCATE TABLE IF EXISTS pmmc_mov_tt;
CREATE TABLE pmmc_mov_tt (
  mov_id INT(5) UNSIGNED NOT NULL,
  cat_id INT(5) UNSIGNED NOT NULL,
  mov_pic VARCHAR(30) COLLATE utf8_unicode_ci NOT NULL, -- adjust here to match default settings
  mov_imdb VARCHAR(8) COLLATE utf8_unicode_ci NOT NULL,
  mov_tt_the VARCHAR(5) COLLATE utf8_unicode_ci NOT NULL,
  mov_tt VARCHAR(150) COLLATE utf8_unicode_ci NOT NULL,
  mov_year YEAR NOT NULL,
  mov_dir VARCHAR(150) COLLATE utf8_unicode_ci NOT NULL,
  mov_wrt VARCHAR(150) COLLATE utf8_unicode_ci NOT NULL,
  mov_tag VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  mov_plot VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  mov_cast VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  mov_notes VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  mov_date DATE NOT NULL,
  mov_time TIME NOT NULL,
  PRIMARY KEY  (mov_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------------------------------
-- GENRES
-- --------------------------------------------------------------------------------
DROP TABLE IF EXISTS pmmc_mov_gen;
CREATE TABLE pmmc_mov_gen (
  gen_id INT(5) UNSIGNED NOT NULL,
  gen_tt VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (gen_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------------------------------
-- GENRES - MOVIES RELATIONS
-- --------------------------------------------------------------------------------
DROP TABLE IF EXISTS pmmc_mov_rel;
CREATE TABLE pmmc_mov_rel (
  rel_id INT(5) UNSIGNED NOT NULL,
  mov_id INT(5) UNSIGNED NOT NULL,
  gen_id INT(5) UNSIGNED NOT NULL,
  PRIMARY KEY  (rel_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ////////////////////////////////////////////////////////////////////////////////
-- PART TWO: USERS AND SETTINGS
-- ////////////////////////////////////////////////////////////////////////////////

-- --------------------------------------------------------------------------------
-- USERS
-- --------------------------------------------------------------------------------
DROP TABLE IF EXISTS pmmc_set_usr;
CREATE TABLE pmmc_set_usr (
  usr_id INT(5) UNSIGNED NOT NULL,
  usr_name VARCHAR(30) COLLATE utf8_unicode_ci NOT NULL,
  usr_fname VARCHAR(30) COLLATE utf8_unicode_ci NOT NULL,
  usr_lname VARCHAR(30) COLLATE utf8_unicode_ci NOT NULL,
  usr_mail VARCHAR(30) COLLATE utf8_unicode_ci NOT NULL,
  usr_pass VARCHAR(32) COLLATE utf8_unicode_ci NOT NULL,
  usr_skin VARCHAR(16) COLLATE utf8_unicode_ci NOT NULL,
  usr_lang CHAR(2) COLLATE utf8_unicode_ci NOT NULL,
  usr_level TINYINT(1) UNSIGNED NOT NULL,
  usr_status TINYINT(1) UNSIGNED NOT NULL,
  usr_date DATE NOT NULL,
  PRIMARY KEY  (usr_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------------------------------
-- SETTINGS
-- --------------------------------------------------------------------------------
DROP TABLE IF EXISTS pmmc_set_cfg;
CREATE TABLE pmmc_set_cfg (
  cfg_id INT(5) UNSIGNED NOT NULL,
  cfg_set VARCHAR(150) COLLATE utf8_unicode_ci NOT NULL,
  cfg_val VARCHAR(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (cfg_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------------------------------
-- USER LISTS
-- --------------------------------------------------------------------------------
DROP TABLE IF EXISTS pmmc_set_lst;
CREATE TABLE pmmc_set_lst (
  lst_id INT(5) UNSIGNED NOT NULL,
  usr_id INT(5) UNSIGNED NOT NULL,
  mov_id INT(5) UNSIGNED NOT NULL,
  lst_date DATE NOT NULL,
  lst_time TIME NOT NULL,
  PRIMARY KEY  (lst_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ////////////////////////////////////////////////////////////////////////////////
-- PART TREE: STATISTICS
-- ////////////////////////////////////////////////////////////////////////////////

-- --------------------------------------------------------------------------------
-- LOGIN HISTORY
-- --------------------------------------------------------------------------------
DROP TABLE IF EXISTS pmmc_var_log;
CREATE TABLE pmmc_var_log (
  log_id INT(5) UNSIGNED NOT NULL,
  usr_id INT(5) UNSIGNED NOT NULL,
  log_date DATE NOT NULL,
  log_time TIME NOT NULL,
  PRIMARY KEY  (usr_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;