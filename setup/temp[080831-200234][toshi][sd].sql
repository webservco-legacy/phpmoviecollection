-- phpMyAdmin SQL Dump
-- version 2.11.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2008 at 08:02 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: 'temp'
--

-- --------------------------------------------------------

--
-- Table structure for table 'pmmc_mov_cat'
--

DROP TABLE IF EXISTS pmmc_mov_cat;
CREATE TABLE pmmc_mov_cat (
  cat_id int(5) unsigned NOT NULL auto_increment,
  cat_pic varchar(30) collate utf8_unicode_ci NOT NULL,
  cat_tt varchar(50) collate utf8_unicode_ci NOT NULL,
  cat_ord int(5) unsigned NOT NULL,
  cat_desc varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (cat_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table 'pmmc_mov_cat'
--

INSERT INTO pmmc_mov_cat VALUES(1, 'cat_1.jpg', 'Categoria landscape', 1, 'landscape');
INSERT INTO pmmc_mov_cat VALUES(2, 'cat_2.jpg', 'Categoria portrait', 2, 'portrait');

-- --------------------------------------------------------

--
-- Table structure for table 'pmmc_mov_gen'
--

DROP TABLE IF EXISTS pmmc_mov_gen;
CREATE TABLE pmmc_mov_gen (
  gen_id int(5) unsigned NOT NULL auto_increment,
  gen_tt varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (gen_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table 'pmmc_mov_gen'
--

INSERT INTO pmmc_mov_gen VALUES(1, 'Action');
INSERT INTO pmmc_mov_gen VALUES(2, 'Adventure');
INSERT INTO pmmc_mov_gen VALUES(3, 'Animation');
INSERT INTO pmmc_mov_gen VALUES(4, 'Biography');
INSERT INTO pmmc_mov_gen VALUES(5, 'Comedy');
INSERT INTO pmmc_mov_gen VALUES(6, 'Crime');
INSERT INTO pmmc_mov_gen VALUES(7, 'Documentary');
INSERT INTO pmmc_mov_gen VALUES(8, 'Drama');
INSERT INTO pmmc_mov_gen VALUES(9, 'Family');
INSERT INTO pmmc_mov_gen VALUES(10, 'Fantasy');
INSERT INTO pmmc_mov_gen VALUES(11, 'Film-Noir');
INSERT INTO pmmc_mov_gen VALUES(12, 'Game-Show');
INSERT INTO pmmc_mov_gen VALUES(13, 'History');
INSERT INTO pmmc_mov_gen VALUES(14, 'Horror');
INSERT INTO pmmc_mov_gen VALUES(15, 'Music');
INSERT INTO pmmc_mov_gen VALUES(16, 'Musical');
INSERT INTO pmmc_mov_gen VALUES(17, 'Mystery');
INSERT INTO pmmc_mov_gen VALUES(18, 'News');
INSERT INTO pmmc_mov_gen VALUES(19, 'Reality-TV');
INSERT INTO pmmc_mov_gen VALUES(20, 'Romance');
INSERT INTO pmmc_mov_gen VALUES(21, 'Sci-Fi');
INSERT INTO pmmc_mov_gen VALUES(22, 'Short');
INSERT INTO pmmc_mov_gen VALUES(23, 'Sport');
INSERT INTO pmmc_mov_gen VALUES(24, 'Talk-Show');
INSERT INTO pmmc_mov_gen VALUES(25, 'Thriller');
INSERT INTO pmmc_mov_gen VALUES(26, 'War');
INSERT INTO pmmc_mov_gen VALUES(27, 'Western');

-- --------------------------------------------------------

--
-- Table structure for table 'pmmc_mov_rel'
--

DROP TABLE IF EXISTS pmmc_mov_rel;
CREATE TABLE pmmc_mov_rel (
  rel_id int(5) unsigned NOT NULL auto_increment,
  mov_id int(5) unsigned NOT NULL,
  gen_id int(5) unsigned NOT NULL,
  PRIMARY KEY  (rel_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table 'pmmc_mov_rel'
--

INSERT INTO pmmc_mov_rel VALUES(1, 1, 1);
INSERT INTO pmmc_mov_rel VALUES(2, 1, 8);
INSERT INTO pmmc_mov_rel VALUES(3, 1, 10);
INSERT INTO pmmc_mov_rel VALUES(4, 1, 14);
INSERT INTO pmmc_mov_rel VALUES(5, 1, 25);
INSERT INTO pmmc_mov_rel VALUES(11, 2, 25);
INSERT INTO pmmc_mov_rel VALUES(10, 2, 6);
INSERT INTO pmmc_mov_rel VALUES(9, 2, 5);
INSERT INTO pmmc_mov_rel VALUES(12, 3, 5);
INSERT INTO pmmc_mov_rel VALUES(13, 3, 14);
INSERT INTO pmmc_mov_rel VALUES(14, 3, 20);
INSERT INTO pmmc_mov_rel VALUES(15, 4, 8);
INSERT INTO pmmc_mov_rel VALUES(16, 4, 17);

-- --------------------------------------------------------

--
-- Table structure for table 'pmmc_mov_tt'
--

DROP TABLE IF EXISTS pmmc_mov_tt;
CREATE TABLE pmmc_mov_tt (
  mov_id int(5) unsigned NOT NULL auto_increment,
  cat_id int(5) unsigned NOT NULL,
  mov_pic varchar(30) collate utf8_unicode_ci NOT NULL,
  mov_imdb varchar(8) collate utf8_unicode_ci NOT NULL,
  mov_tt_pre varchar(5) collate utf8_unicode_ci NOT NULL,
  mov_tt varchar(150) collate utf8_unicode_ci NOT NULL,
  mov_aka varchar(255) collate utf8_unicode_ci NOT NULL,
  mov_year year(4) NOT NULL,
  mov_country varchar(30) collate utf8_unicode_ci NOT NULL,
  mov_language varchar(30) collate utf8_unicode_ci NOT NULL,
  mov_dir varchar(150) collate utf8_unicode_ci NOT NULL,
  mov_wrt varchar(150) collate utf8_unicode_ci NOT NULL,
  mov_tag varchar(255) collate utf8_unicode_ci NOT NULL,
  mov_plot varchar(255) collate utf8_unicode_ci NOT NULL,
  mov_cast varchar(255) collate utf8_unicode_ci NOT NULL,
  mov_notes varchar(255) collate utf8_unicode_ci NOT NULL,
  mov_date date NOT NULL,
  mov_time time NOT NULL,
  PRIMARY KEY  (mov_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table 'pmmc_mov_tt'
--

INSERT INTO pmmc_mov_tt VALUES(1, 1, 'mov_1.jpg', '0360486', '', 'Constantine', 'Constantine, Hellblazer, John Constantine: Hellblazer', 2005, 'USA, Germany', 'English, Filipino, Tagalog', 'Francis Lawrence', 'Jamie Delano, Garth Ennis', 'Hell wants him. Heaven won ''t take him. Earth needs him.', 'Based on the DC/Vertigo comic book Hellblazer and written by Kevin Brodbin, Mark Bomback and Frank Capello, Constantine tells the story of irreverent supernatural detective John Constantine (Keanu Reeves), who has literally been to hell and back.', 'Keanu Reeves, Rachel Weisz, Shia LaBeouf, Djimon Hounsou, Max Baker, Pruitt Taylor Vince, Gavin Rossdale, Tilda Swinton, Peter Stormare, Jesse Ramirez, José Zúñiga, Francis Guinan, Larry Cedar, April Grace, Suzanne Whang', 'Two-Disc Deluxe Edition', '2008-08-30', '08:15:46');
INSERT INTO pmmc_mov_tt VALUES(2, 1, 'mov_2.jpg', '0208092', '', 'Snatch.', 'Diamonds, Lock, Stock... and Six Stolen Diamonds, Snatch, Snatch''d, The Guy Ritchie Project', 2000, 'UK, USA', 'English, Russian', 'Guy Ritchie', 'Guy Ritchie', 'Stealin'' Stones and Breakin'' Bones', 'Unscrupulous boxing promoters, violent bookmakers, a Russian gangster, incompetent amateur robbers, and supposedly Jewish jewelers fight to track down a priceless stolen diamond.', 'Ade, William Beck, Andy Beckwith, Ewen Bremner, Jason Buckham, Mickey Cantwell, Nikki Collins, Teena Collins, Charles Cork, James Cunningham, Sorcha Cusack, Mickey Dee, Benicio Del Toro, Sam Douglas, Dennis Farina', 'Special Edition', '2008-08-30', '09:55:01');
INSERT INTO pmmc_mov_tt VALUES(3, 2, 'mov_3.jpg', '0365748', '', 'Shaun of the Dead', 'Shaun of the Dead, Tea-Time of the Dead', 2004, 'UK, France', 'English', 'Edgar Wright', 'Simon Pegg  and, Edgar Wright', 'It''s just one of those days when you''re feeling a little...dead.', 'A man decides to turn his moribund life around by winning back his ex-girlfriend, reconciling his relationship with his mother, and dealing with an entire community that has returned from the dead to eat the living.', 'Simon Pegg, Kate Ashfield, Nick Frost, Lucy Davis, Dylan Moran, Nicola Cunningham, Keir Mills, Matt Jaynes, Gavin Ferguson, Peter Serafinowicz, Horton Jupiter, Tim Baggaley, Arvind Doshi, Rafe Spall, Sonnell Dadral', '', '2008-08-30', '09:57:44');

-- --------------------------------------------------------

--
-- Table structure for table 'pmmc_set_cfg'
--

DROP TABLE IF EXISTS pmmc_set_cfg;
CREATE TABLE pmmc_set_cfg (
  cfg_id int(5) unsigned NOT NULL auto_increment,
  cfg_set varchar(150) collate utf8_unicode_ci NOT NULL,
  cfg_val varchar(150) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (cfg_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table 'pmmc_set_cfg'
--

INSERT INTO pmmc_set_cfg VALUES(1, 'LANG', 'ro');
INSERT INTO pmmc_set_cfg VALUES(2, 'SKIN', 'pmmc');
INSERT INTO pmmc_set_cfg VALUES(3, 'PCAT', '80');
INSERT INTO pmmc_set_cfg VALUES(4, 'PMOV', '90');

-- --------------------------------------------------------

--
-- Table structure for table 'pmmc_set_lst'
--

DROP TABLE IF EXISTS pmmc_set_lst;
CREATE TABLE pmmc_set_lst (
  lst_id int(5) unsigned NOT NULL auto_increment,
  usr_id int(5) unsigned NOT NULL,
  mov_id int(5) unsigned NOT NULL,
  lst_date date NOT NULL,
  lst_time time NOT NULL,
  PRIMARY KEY  (lst_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table 'pmmc_set_lst'
--


-- --------------------------------------------------------

--
-- Table structure for table 'pmmc_set_usr'
--

DROP TABLE IF EXISTS pmmc_set_usr;
CREATE TABLE pmmc_set_usr (
  usr_id int(5) unsigned NOT NULL auto_increment,
  usr_name varchar(30) collate utf8_unicode_ci NOT NULL,
  usr_fname varchar(30) collate utf8_unicode_ci NOT NULL,
  usr_lname varchar(30) collate utf8_unicode_ci NOT NULL,
  usr_mail varchar(30) collate utf8_unicode_ci NOT NULL,
  usr_pass varchar(32) collate utf8_unicode_ci NOT NULL,
  usr_skin varchar(16) collate utf8_unicode_ci NOT NULL,
  usr_lang char(2) collate utf8_unicode_ci NOT NULL,
  usr_level tinyint(1) unsigned NOT NULL,
  usr_status tinyint(1) unsigned NOT NULL,
  usr_date date NOT NULL,
  PRIMARY KEY  (usr_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table 'pmmc_set_usr'
--

INSERT INTO pmmc_set_usr VALUES(1, 'Root', 'Radu', 'Maier', 'radu@rudisoft.net', '061d29b46787481e3f3b39523a2918f3', 'pmmc', 'ro', 3, 1, '2008-08-22');

-- --------------------------------------------------------

--
-- Table structure for table 'pmmc_var_log'
--

DROP TABLE IF EXISTS pmmc_var_log;
CREATE TABLE pmmc_var_log (
  log_id int(5) unsigned NOT NULL auto_increment,
  usr_id int(5) unsigned NOT NULL,
  log_date date NOT NULL,
  log_time time NOT NULL,
  PRIMARY KEY  (log_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table 'pmmc_var_log'
--

INSERT INTO pmmc_var_log VALUES(1, 1, '2008-08-29', '23:40:27');
INSERT INTO pmmc_var_log VALUES(2, 1, '2008-08-30', '08:13:55');
INSERT INTO pmmc_var_log VALUES(3, 1, '2008-08-31', '00:55:25');
INSERT INTO pmmc_var_log VALUES(4, 1, '2008-08-31', '10:10:42');
INSERT INTO pmmc_var_log VALUES(5, 1, '2008-08-31', '18:31:57');
INSERT INTO pmmc_var_log VALUES(6, 1, '2008-08-31', '18:33:59');
INSERT INTO pmmc_var_log VALUES(7, 1, '2008-08-31', '18:40:05');
INSERT INTO pmmc_var_log VALUES(8, 1, '2008-08-31', '18:53:11');
INSERT INTO pmmc_var_log VALUES(9, 1, '2008-08-31', '18:53:50');
INSERT INTO pmmc_var_log VALUES(10, 1, '2008-08-31', '18:54:16');
INSERT INTO pmmc_var_log VALUES(11, 1, '2008-08-31', '19:06:48');
INSERT INTO pmmc_var_log VALUES(12, 1, '2008-08-31', '19:12:37');
