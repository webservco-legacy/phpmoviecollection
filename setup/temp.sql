-- phpMyAdmin SQL Dump
-- version 2.11.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 07, 2008 at 10:41 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: 'temp'
--

-- --------------------------------------------------------

--
-- Table structure for table 'pmc_mov_cat'
--

DROP TABLE IF EXISTS pmc_mov_cat;
CREATE TABLE pmc_mov_cat (
  cat_id int(5) unsigned NOT NULL auto_increment,
  cat_pic varchar(30) collate utf8_unicode_ci NOT NULL,
  cat_tt varchar(50) collate utf8_unicode_ci NOT NULL,
  cat_ord int(5) unsigned NOT NULL,
  cat_desc varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (cat_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table 'pmc_mov_cat'
--

INSERT INTO pmc_mov_cat VALUES(1, 'cat_1.jpg', 'Prima categorie', 1, 'Testare UTF-8. Descrierea primei categorii. Poate fi şi un text mai lung de până la 255 de caractere');
INSERT INTO pmc_mov_cat VALUES(2, 'cat_2.jpg', 'Categoria numărul 2', 2, 'Aplicaţia are suport 100% pentru UTF-8. Adică e ok să scrii şţâăî ÎĂÂŢŞ!!!');
INSERT INTO pmc_mov_cat VALUES(3, 'cat_3.jpg', 'A treia categorie', 3, 'Categorie goală, să vedem ce se întâmplă');

-- --------------------------------------------------------

--
-- Table structure for table 'pmc_mov_gen'
--

DROP TABLE IF EXISTS pmc_mov_gen;
CREATE TABLE pmc_mov_gen (
  gen_id int(5) unsigned NOT NULL auto_increment,
  gen_tt varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (gen_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table 'pmc_mov_gen'
--

INSERT INTO pmc_mov_gen VALUES(1, 'Action');
INSERT INTO pmc_mov_gen VALUES(2, 'Adventure');
INSERT INTO pmc_mov_gen VALUES(3, 'Animation');
INSERT INTO pmc_mov_gen VALUES(4, 'Biography');
INSERT INTO pmc_mov_gen VALUES(5, 'Comedy');
INSERT INTO pmc_mov_gen VALUES(6, 'Crime');
INSERT INTO pmc_mov_gen VALUES(7, 'Documentary');
INSERT INTO pmc_mov_gen VALUES(8, 'Drama');
INSERT INTO pmc_mov_gen VALUES(9, 'Family');
INSERT INTO pmc_mov_gen VALUES(10, 'Fantasy');
INSERT INTO pmc_mov_gen VALUES(11, 'Film-Noir');
INSERT INTO pmc_mov_gen VALUES(12, 'Game-Show');
INSERT INTO pmc_mov_gen VALUES(13, 'History');
INSERT INTO pmc_mov_gen VALUES(14, 'Horror');
INSERT INTO pmc_mov_gen VALUES(15, 'Music');
INSERT INTO pmc_mov_gen VALUES(16, 'Musical');
INSERT INTO pmc_mov_gen VALUES(17, 'Mystery');
INSERT INTO pmc_mov_gen VALUES(18, 'News');
INSERT INTO pmc_mov_gen VALUES(19, 'Reality-TV');
INSERT INTO pmc_mov_gen VALUES(20, 'Romance');
INSERT INTO pmc_mov_gen VALUES(21, 'Sci-Fi');
INSERT INTO pmc_mov_gen VALUES(22, 'Short');
INSERT INTO pmc_mov_gen VALUES(23, 'Sport');
INSERT INTO pmc_mov_gen VALUES(24, 'Talk-Show');
INSERT INTO pmc_mov_gen VALUES(25, 'Thriller');
INSERT INTO pmc_mov_gen VALUES(26, 'War');
INSERT INTO pmc_mov_gen VALUES(27, 'Western');

-- --------------------------------------------------------

--
-- Table structure for table 'pmc_mov_rel'
--

DROP TABLE IF EXISTS pmc_mov_rel;
CREATE TABLE pmc_mov_rel (
  rel_id int(5) unsigned NOT NULL auto_increment,
  mov_id int(5) unsigned NOT NULL,
  gen_id int(5) unsigned NOT NULL,
  PRIMARY KEY  (rel_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table 'pmc_mov_rel'
--

INSERT INTO pmc_mov_rel VALUES(1, 1, 1);
INSERT INTO pmc_mov_rel VALUES(2, 2, 2);
INSERT INTO pmc_mov_rel VALUES(3, 3, 3);
INSERT INTO pmc_mov_rel VALUES(4, 4, 4);
INSERT INTO pmc_mov_rel VALUES(5, 5, 5);
INSERT INTO pmc_mov_rel VALUES(6, 6, 14);
INSERT INTO pmc_mov_rel VALUES(7, 7, 15);
INSERT INTO pmc_mov_rel VALUES(8, 8, 8);
INSERT INTO pmc_mov_rel VALUES(9, 9, 7);
INSERT INTO pmc_mov_rel VALUES(10, 10, 1);
INSERT INTO pmc_mov_rel VALUES(11, 10, 8);
INSERT INTO pmc_mov_rel VALUES(12, 10, 10);
INSERT INTO pmc_mov_rel VALUES(13, 10, 14);
INSERT INTO pmc_mov_rel VALUES(14, 10, 25);
INSERT INTO pmc_mov_rel VALUES(15, 11, 5);
INSERT INTO pmc_mov_rel VALUES(16, 11, 6);
INSERT INTO pmc_mov_rel VALUES(17, 11, 25);
INSERT INTO pmc_mov_rel VALUES(18, 12, 5);
INSERT INTO pmc_mov_rel VALUES(19, 12, 14);
INSERT INTO pmc_mov_rel VALUES(20, 12, 20);
INSERT INTO pmc_mov_rel VALUES(21, 13, 2);
INSERT INTO pmc_mov_rel VALUES(22, 13, 3);
INSERT INTO pmc_mov_rel VALUES(23, 13, 5);
INSERT INTO pmc_mov_rel VALUES(24, 13, 9);
INSERT INTO pmc_mov_rel VALUES(25, 13, 10);
INSERT INTO pmc_mov_rel VALUES(26, 13, 20);

-- --------------------------------------------------------

--
-- Table structure for table 'pmc_mov_tt'
--

DROP TABLE IF EXISTS pmc_mov_tt;
CREATE TABLE pmc_mov_tt (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table 'pmc_mov_tt'
--

INSERT INTO pmc_mov_tt VALUES(1, 1, 'mov_1.unknown', '', '', 'Arabic (Egypt) هىلقهي ةشهثق', '', 0000, '', '', '', '', '', '', '', '', '2008-09-06', '19:48:51');
INSERT INTO pmc_mov_tt VALUES(2, 1, 'mov_2.unknown', '', '', 'Chinese (PRC) 噢噢你代尔', '', 0000, '', '', '', '', '', '', '', '', '2008-09-06', '19:49:17');
INSERT INTO pmc_mov_tt VALUES(3, 1, 'mov_3.unknown', '', '', 'German ümlaut ÜÄÖüäö', '', 0000, '', '', '', '', '', '', '', '', '2008-09-06', '19:49:55');
INSERT INTO pmc_mov_tt VALUES(4, 1, 'mov_4.unknown', '', '', 'Hebrew ןמערןג צשןקר', '', 0000, '', '', '', '', '', '', '', '', '2008-09-06', '19:50:30');
INSERT INTO pmc_mov_tt VALUES(5, 1, 'mov_5.unknown', '', '', 'Hungarian őúűáé ŰÁÉŐÚ', '', 0000, '', '', '', '', '', '', '', '', '2008-09-06', '19:51:13');
INSERT INTO pmc_mov_tt VALUES(6, 1, 'mov_6.unknown', '', '', 'Japanese　印g利dまいえｒ', '', 0000, '', '', '', '', '', '', '', '', '2008-09-06', '19:51:36');
INSERT INTO pmc_mov_tt VALUES(7, 1, 'mov_7.unknown', '', '', 'Hindi गलुीग् सोगाी', '', 0000, '', '', '', '', '', '', '', '', '2008-09-06', '19:52:12');
INSERT INTO pmc_mov_tt VALUES(8, 1, 'mov_8.unknown', '', '', 'Romanian ăîşţâ ÂŢŞÎĂ', '', 0000, '', '', '', '', '', '', '', '', '2008-09-06', '19:52:35');
INSERT INTO pmc_mov_tt VALUES(9, 1, 'mov_9.unknown', '', '', 'Russian штпкшв ьфшук', '', 0000, '', '', '', '', '', '', '', '', '2008-09-06', '19:53:08');
INSERT INTO pmc_mov_tt VALUES(10, 2, 'mov_10.jpg', '0360486', '', 'Constantine', 'Constantine, Hellblazer, John Constantine: Hellblazer', 2005, 'USA, Germany', 'English, Filipino, Tagalog', 'Francis Lawrence', 'Jamie Delano, Garth Ennis', 'Hell wants him. Heaven won''t take him. Earth needs him.', 'Based on the DC/Vertigo comic book Hellblazer and written by Kevin Brodbin, Mark Bomback and Frank Capello, Constantine tells the story of irreverent supernatural detective John Constantine (Keanu Reeves), who has literally been to hell and back.', 'Keanu Reeves, Rachel Weisz, Shia LaBeouf, Djimon Hounsou, Max Baker, Pruitt Taylor Vince, Gavin Rossdale, Tilda Swinton, Peter Stormare, Jesse Ramirez, José Zúñiga, Francis Guinan, Larry Cedar, April Grace, Suzanne Whang', '', '2008-09-06', '19:55:00');
INSERT INTO pmc_mov_tt VALUES(11, 2, 'mov_11.jpg', '0208092', '', 'Snatch.', 'Diamonds, Lock, Stock... and Six Stolen Diamonds, Snatch, Snatch''d, The Guy Ritchie Project', 2000, 'UK, USA', 'English, Russian', 'Guy Ritchie', 'Guy Ritchie', 'Stealin'' Stones and Breakin'' Bones', 'Unscrupulous boxing promoters, violent bookmakers, a Russian gangster, incompetent amateur robbers, and supposedly Jewish jewelers fight to track down a priceless stolen diamond.', 'Ade, William Beck, Andy Beckwith, Ewen Bremner, Jason Buckham, Mickey Cantwell, Nikki Collins, Teena Collins, Charles Cork, James Cunningham, Sorcha Cusack, Mickey Dee, Benicio Del Toro, Sam Douglas, Dennis Farina', '', '2008-09-06', '19:56:11');
INSERT INTO pmc_mov_tt VALUES(12, 2, 'mov_12.jpg', '0365748', '', 'Shaun of the Dead', 'Shaun of the Dead, Tea-Time of the Dead', 2004, 'UK, France', 'English', 'Edgar Wright', 'Simon Pegg  and, Edgar Wright', 'It''s just one of those days when you''re feeling a little...dead.', 'A man decides to turn his moribund life around by winning back his ex-girlfriend, reconciling his relationship with his mother, and dealing with an entire community that has returned from the dead to eat the living.', 'Simon Pegg, Kate Ashfield, Nick Frost, Lucy Davis, Dylan Moran, Nicola Cunningham, Keir Mills, Matt Jaynes, Gavin Ferguson, Peter Serafinowicz, Horton Jupiter, Tim Baggaley, Arvind Doshi, Rafe Spall, Sonnell Dadral', '', '2008-09-06', '19:58:10');
INSERT INTO pmc_mov_tt VALUES(13, 2, 'mov_13.jpg', '0126029', '', 'Shrek', '{AKA}', 2001, 'USA', 'English', 'Andrew Adamson, Vicky Jenson', 'William Steig , Ted Elliott', 'The greatest fairy tale never told.', 'An ogre, in order to regain his swamp, travels along with an annoying donkey in order to bring a princess to a scheming lord, wishing himself King.', 'Mike Myers, Eddie Murphy, Cameron Diaz, John Lithgow, Vincent Cassel, Peter Dennis, Clive Pearse, Jim Cummings, Bobby Block, Chris Miller, Cody Cameron, Kathleen Freeman, Michael Galasso, Christopher Knights, Simon J. Smith', '', '2008-09-06', '23:17:33');

-- --------------------------------------------------------

--
-- Table structure for table 'pmc_set_cfg'
--

DROP TABLE IF EXISTS pmc_set_cfg;
CREATE TABLE pmc_set_cfg (
  cfg_id int(5) unsigned NOT NULL auto_increment,
  cfg_set varchar(150) collate utf8_unicode_ci NOT NULL,
  cfg_val varchar(150) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (cfg_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table 'pmc_set_cfg'
--

INSERT INTO pmc_set_cfg VALUES(1, 'LANG', 'ro');
INSERT INTO pmc_set_cfg VALUES(2, 'SKIN', 'pmc');
INSERT INTO pmc_set_cfg VALUES(3, 'PCAT', '80');
INSERT INTO pmc_set_cfg VALUES(4, 'PMOV', '80');
INSERT INTO pmc_set_cfg VALUES(5, 'IMOV', '10');
INSERT INTO pmc_set_cfg VALUES(6, 'IUSR', '10');

-- --------------------------------------------------------

--
-- Table structure for table 'pmc_set_lst'
--

DROP TABLE IF EXISTS pmc_set_lst;
CREATE TABLE pmc_set_lst (
  lst_id int(5) unsigned NOT NULL auto_increment,
  usr_id int(5) unsigned NOT NULL,
  mov_id int(5) unsigned NOT NULL,
  lst_date date NOT NULL,
  lst_time time NOT NULL,
  PRIMARY KEY  (lst_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table 'pmc_set_lst'
--


-- --------------------------------------------------------

--
-- Table structure for table 'pmc_set_usr'
--

DROP TABLE IF EXISTS pmc_set_usr;
CREATE TABLE pmc_set_usr (
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
-- Dumping data for table 'pmc_set_usr'
--

INSERT INTO pmc_set_usr VALUES(1, 'Root', 'Radu', 'Maier', 'radu@rudisoft.net', '061d29b46787481e3f3b39523a2918f3', 'pmc', 'ro', 5, 1, '2008-08-22');

-- --------------------------------------------------------

--
-- Table structure for table 'pmc_var_log'
--

DROP TABLE IF EXISTS pmc_var_log;
CREATE TABLE pmc_var_log (
  log_id int(5) unsigned NOT NULL auto_increment,
  usr_id int(5) unsigned NOT NULL,
  log_date date NOT NULL,
  log_time time NOT NULL,
  PRIMARY KEY  (log_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table 'pmc_var_log'
--

