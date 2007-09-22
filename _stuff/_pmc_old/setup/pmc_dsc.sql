-- -- -- -- -- -- -- -- -- --
-- pmc_dsc_mnf
-- -- -- -- -- -- -- -- -- --
--  DISC MANUFACTURERS
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_dsc_mnf`;
CREATE TABLE `pmc_dsc_mnf` (
    `mnf_id` int(5) unsigned NOT NULL,
    `mnf_tt` varchar(60) NOT NULL,
    `mnf_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`mnf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `pmc_dsc_mnf` VALUES (1, 'TRAXDATA', '');
INSERT INTO `pmc_dsc_mnf` VALUES (2, 'HP', '');
INSERT INTO `pmc_dsc_mnf` VALUES (3, 'EMTEC', '');
INSERT INTO `pmc_dsc_mnf` VALUES (4, 'LG', '');

-- -- -- -- -- -- -- -- -- --
-- pmc_dsc_recorders
-- -- -- -- -- -- -- -- -- --
--  CD/DVD Recorders
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_dsc_recorders`;
CREATE TABLE `pmc_dsc_recorders` (
    `recorder_id` int(5) unsigned NOT NULL,
    `mnf_id` int(5) unsigned NOT NULL,
    `recorder_name` varchar(60) NOT NULL,
    `recorder_model` varchar(30) NOT NULL,
    `recorder_sernum` varchar(60) NOT NULL,
    `recorder_type` varchar(30) NOT NULL,
    `recorder_firmware` varchar(10) NOT NULL,
    `recorder_buffer` double(6,2) unsigned NOT NULL,
    `recorder_date` date NOT NULL,
    `recorder_serial` varchar(15) NOT NULL,
    `recorder_read_speed` varchar(15) NOT NULL,
    `recorder_write_speed` varchar(15) NOT NULL,
    `recorder_read_cd_text` tinyint(1) unsigned NOT NULL,
    `recorder_read_c2_pointers` tinyint(1) unsigned NOT NULL,
    `recorder_read_cd-r` tinyint(1) unsigned NOT NULL,
    `recorder_read_cd-rw` tinyint(1) unsigned NOT NULL,
    `recorder_read_dvd-rom` tinyint(1) unsigned NOT NULL,
    `recorder_read_dvd-ram` tinyint(1) unsigned NOT NULL,
    `recorder_read_dvd-r` tinyint(1) unsigned NOT NULL,
    `recorder_read_dvd-rw` tinyint(1) unsigned NOT NULL,
    `recorder_read_dvd-r_dl` tinyint(1) unsigned NOT NULL,
    `recorder_read_dvd_plus_r` tinyint(1) unsigned NOT NULL,
    `recorder_read_dvd_plus_rw` tinyint(1) unsigned NOT NULL,
    `recorder_read_dvd_plus_r_dl` tinyint(1) unsigned NOT NULL,
    `recorder_read_bd-rom` tinyint(1) unsigned NOT NULL,
    `recorder_read_bd-r` tinyint(1) unsigned NOT NULL,
    `recorder_read_db-re` tinyint(1) unsigned NOT NULL,
    `recorder_read_hd_dvd-rom` tinyint(1) unsigned NOT NULL,
    `recorder_read_hd_dvd-r` tinyint(1) unsigned NOT NULL,
    `recorder_read_hd_dvd-rw` tinyint(1) unsigned NOT NULL,
    `recorder_read_hd_burn` tinyint(1) unsigned NOT NULL,
    `recorder_read_digital_audio` tinyint(1) unsigned NOT NULL,
    `recorder_read_cd_plus_g` tinyint(1) unsigned NOT NULL,
    `recorder_read_video_cd` tinyint(1) unsigned NOT NULL,
    `recorder_write_cd-r` tinyint(1) unsigned NOT NULL,
    `recorder_write_cd-rw` tinyint(1) unsigned NOT NULL,
    `recorder_write_dvd-r` tinyint(1) unsigned NOT NULL,
    `recorder_write_dvd-rw` tinyint(1) unsigned NOT NULL,
    `recorder_write_dvd-r_dl` tinyint(1) unsigned NOT NULL,
    `recorder_write_dvd_plus_r` tinyint(1) unsigned NOT NULL,
    `recorder_write_dvd_plus_rw` tinyint(1) unsigned NOT NULL,
    `recorder_write_dvd_plus_r_dl` tinyint(1) unsigned NOT NULL,
    `recorder_write_dvd-ram` tinyint(1) unsigned NOT NULL,
    `recorder_write_bd-r` tinyint(1) unsigned NOT NULL,
    `recorder_write_bd-re` tinyint(1) unsigned NOT NULL,
    `recorder_write_hd_dvd-r` tinyint(1) unsigned NOT NULL,
    `recorder_write_hd_dvd-rw` tinyint(1) unsigned NOT NULL,
    `recorder_write_hd-burn-r` tinyint(1) unsigned NOT NULL,
    `recorder_write_hd-burn-rw` tinyint(1) unsigned NOT NULL,
    `recorder_bup` tinyint(1) unsigned NOT NULL,
    `recorder_mount_rainer` tinyint(1) unsigned NOT NULL,
    `recorder_solid_burn` tinyint(1) unsigned NOT NULL,
    `recorder_labelflash` tinyint(1) unsigned NOT NULL,
    `recorder_modes` varchar(110) NOT NULL,
    `recorder_dvd_region_protection_control` varchar(10) NOT NULL,
    `recorder_dvd_region` tinyint(1) unsigned NOT NULL,
    `recorder_dvd_changes_user` tinyint(1) unsigned NOT NULL,
    `recorder_dvd_changes_vendor` tinyint(1) unsigned NOT NULL,
    `recorder_dvd_css` tinyint(1) unsigned NOT NULL,
    `recorder_dvd_cprm` tinyint(1) unsigned NOT NULL,
    `recorder_dvd_aacs` tinyint(1) unsigned NOT NULL,
    `recorder_dvd_vcps` tinyint(1) unsigned NOT NULL,
    `recorder_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`recorder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `pmc_dsc_recorders` VALUES (1,4,'Recorder 1','GSA-H10N','HL-DT-ST DVDRAM GSA-H10N','DVD-RAM Recorder','JL10',2048.00,'0000-00-00','K2766M32318','','48x',1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,1,0,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,1,0,0,0,'Packet, TAO, DAO, SAO, RAW SAO, RAW DAO, RAW SAO 16, RAW SAO 96, RAW DAO 16, RAW DAO 96','RPC II',0,5,4,1,1,0,0,'old recorder. not used anymore');
INSERT INTO `pmc_dsc_recorders` VALUES (2,4,'Recorder 2','GSA-H12N','HL-DT-ST DVDRAM GSA-H12N','DVD-RAM Recorder','UL01',2048.00,'0000-00-00','K2G69QB4705','','48x',1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,1,0,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,1,0,0,0,'Packet, TAO, DAO, SAO, RAW SAO, RAW DAO, RAW SAO 16, RAW SAO 96, RAW DAO 16, RAW DAO 96','RPC II',0,5,4,1,1,0,0,'notes');

-- -- -- -- -- -- -- -- -- --
-- pmc_dsc_types
-- -- -- -- -- -- -- -- -- --
--  DISC TYPES
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_dsc_types`;
CREATE TABLE `pmc_dsc_types` (
  `dtype_id` int(5) unsigned NOT NULL,
  `dtype_tt` varchar(60) NOT NULL,
  `dtype_notes` varchar(150) NOT NULL,
  PRIMARY KEY (`dtype_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `pmc_dsc_types` VALUES (1, 'CD-R', 'Standard CD');
INSERT INTO `pmc_dsc_types` VALUES (2, 'CD-RW', 'Re-writable CD');
INSERT INTO `pmc_dsc_types` VALUES (3, 'DVD-R', 'Standard DVD');
INSERT INTO `pmc_dsc_types` VALUES (4, 'DVD-RW', 'Re-writable DVD');
INSERT INTO `pmc_dsc_types` VALUES (5, 'CD-R 23', '8 cm CD');

-- -- -- -- -- -- -- -- -- --
-- pmc_dsc_ddb
-- -- -- -- -- -- -- -- -- --
--  DISC_DATABSE
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_dsc_ddb`;
CREATE TABLE `pmc_dsc_ddb` (
    `ddb_id` int(5) unsigned NOT NULL,
    `dtype_id` tinyint(1) unsigned NOT NULL,
    `ddb_name` varchar(60) NOT NULL,
    `ddb_manufacturer` tinyint(1) unsigned NOT NULL,
    `ddb_time` time NOT NULL,
    `ddb_capacity` double(6,2) unsigned NOT NULL,
    `ddb_speed` tinyint(2) unsigned NOT NULL,
    `ddb_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`ddb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `pmc_dsc_ddb` VALUES (1, 1, 'TRAXDATA CD-R 80', 1, '01:20:00', 700.00, 52, 'silver');
INSERT INTO `pmc_dsc_ddb` VALUES (2, 3, 'TRAXDATA DVD-R 16x', 1, '02:00:00', 4398.00, 16, 'silver');
INSERT INTO `pmc_dsc_ddb` VALUES (3, 3, 'HP DVD-R 8x', 2, '02:00:00', 4398.00, 8, 'pink');
INSERT INTO `pmc_dsc_ddb` VALUES (4, 5, 'MINI CD', 0, '00:23:00', 200.00, 16, 'white');
INSERT INTO `pmc_dsc_ddb` VALUES (5, 1, 'TRAXDATA CD-R 80', 1, '01:20:00', 700.00, 52, 'black');
INSERT INTO `pmc_dsc_ddb` VALUES (6, 4, 'EMTEC DVD-RW', 3, '02:00:00', 4398.00, 0, '');

-- -- -- -- -- -- -- -- -- --
-- pmc_dsc_discs
-- -- -- -- -- -- -- -- -- --
--  USER's DISCS
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_dsc_discs`;
CREATE TABLE `pmc_dsc_discs` (
   `disc_id` int(5) unsigned NOT NULL,
   `usr_id` int(5) unsigned NOT NULL,
   `ddb_id` tinyint(1) unsigned NOT NULL,
   `categ_id` tinyint(1) unsigned NOT NULL,
   `disc_cat_number` int(5) unsigned zerofill NOT NULL,
   `disc_format` tinyint(1) unsigned NOT NULL,
   `disc_tt_the` tinyint(1) unsigned NOT NULL,
   `disc_tt` varchar(60) NOT NULL,
   `disc_keep` tinyint(1) unsigned NOT NULL,
   `disc_dvd_region` tinyint(1) unsigned NOT NULL,
   `disc_dvd_menus` tinyint(1) unsigned NOT NULL,
   `disc_dvd_audio` varchar(150) NOT NULL,
   `disc_dvd_subtitles` varchar(150) NOT NULL,
   `disc_dvd_extra` varchar(150) NOT NULL,
   `disc_notes` varchar(150) NOT NULL,
   PRIMARY KEY (`disc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `pmc_dsc_discs` VALUES (1, 0, 3, 3, 00000, 1, 0, 'SuSE Linux 10.0-0 Promo DVD i386', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (2, 0, 5, 2, 00000, 1, 0, 'Fragile', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (3, 0, 5, 3, 00000, 1, 0, 'Slackware 10 CD3', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (4, 0, 5, 3, 00000, 1, 0, 'Slackware 10 CD4', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (5, 0, 5, 2, 00000, 1, 0, 'The Dark', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (6, 0, 4, 3, 00000, 1, 0, 'Slax', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (7, 0, 5, 2, 00000, 1, 0, 'Lake House', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (8, 0, 3, 2, 00000, 3, 0, 'Anca Nunta 1', 0, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (9, 0, 3, 2, 00000, 3, 0, 'Anca Nunta 2', 0, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (10, 0, 5, 5, 00000, 1, 0, 'Lake stuff', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (11, 0, 5, 2, 00000, 1, 0, 'Silent Hill', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (12, 0, 5, 2, 00000, 1, 0, 'The Skeleton Key', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (13, 0, 3, 2, 00000, 1, 0, 'Lord Of The Rings Extended', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (14, 0, 1, 3, 00000, 1, 0, 'Windows 98 SE', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (15, 0, 2, 3, 00000, 1, 0, 'Kit dump', 0, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (16, 0, 2, 3, 00000, 1, 0, 'Kit ok', 0, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (17, 0, 2, 1, 00000, 1, 0, 'Media', 0, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (18, 0, 2, 1, 00000, 1, 0, 'Media (Casi)', 0, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (19, 0, 2, 5, 00000, 1, 0, 'Devel (old)', 0, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (20, 0, 2, 2, 00000, 1, 0, 'Asian horror 1', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (21, 0, 2, 2, 00000, 1, 0, 'Asian horror 2 (DUMP)', 0, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (22, 0, 1, 5, 00000, 1, 0, 'Tutor', 0, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (23, 0, 2, 3, 00000, 1, 0, 'Slackware 11.0', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (24, 0, 2, 2, 00000, 1, 0, 'Horror 1', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (25, 0, 1, 2, 00000, 1, 0, 'Boondock Saints', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (26, 0, 1, 1, 00000, 1, 0, 'Colinde Anca mp3', 0, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (27, 0, 2, 2, 00000, 1, 0, 'Movies misc. (Horror 3)', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (28, 0, 2, 2, 00000, 1, 0, 'Alien', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (29, 0, 2, 2, 00000, 1, 0, 'Horror 2', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (30, 0, 2, 2, 00000, 1, 0, 'Asian horror 3', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (31, 0, 2, 2, 00000, 3, 0, 'Constantine DVD1', 1, 0, 1, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (32, 0, 2, 2, 00000, 3, 0, 'Constantine DVD2', 1, 0, 1, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (33, 0, 2, 2, 00000, 3, 0, 'The Diary Of ...', 1, 0, 1, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (34, 0, 6, 5, 00000, 1, 0, 'Backup temp', 0, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (35, 0, 2, 2, 00000, 1, 0, 'Animation Movies', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (36, 0, 2, 2, 00000, 1, 0, 'The Omen', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (37, 0, 2, 3, 00000, 1, 0, 'Kit windows + ghost', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (38, 0, 2, 5, 00000, 1, 0, 'DEVEL_4', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (39, 0, 2, 2, 00000, 1, 0, 'Ju-On', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (40, 0, 2, 5, 00000, 1, 0, 'DEVEL_2', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (41, 0, 1, 2, 00000, 1, 0, 'Catwoman', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (42, 0, 2, 2, 00000, 1, 0, 'Horror 4', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (43, 0, 2, 5, 00000, 1, 0, 'DEVEL_1', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (44, 0, 2, 5, 00000, 1, 0, 'DEVEL_3', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (45, 0, 1, 2, 00000, 1, 0, 'Hellraiser Vi', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (46, 0, 2, 2, 00000, 1, 0, 'Re-Animator', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (47, 0, 2, 2, 00000, 1, 0, 'Asian horror 2 (NEW)', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (48, 0, 1, 2, 00000, 1, 0, 'Bedazzled', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (49, 0, 2, 2, 00000, 1, 0, 'Ringu', 1, 0, 0, '', '', '', '');
INSERT INTO `pmc_dsc_discs` VALUES (50, 0, 1, 2, 00000, 1, 0, 'Mean Machine', 1, 0, 0, '', '', '', '');

-- -- -- -- -- -- -- -- -- --
-- pmc_dsc_burn
-- -- -- -- -- -- -- -- -- --
--  BURN SESSIONS
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_dsc_burn`;
CREATE TABLE `pmc_dsc_burn` (
    `burn_id` int(5) unsigned NOT NULL,
    `disc_id` tinyint(1) unsigned NOT NULL,
    `recorder_id` tinyint(1) unsigned NOT NULL,
    `burn_date` date NOT NULL,
    `burn_ms` tinyint(1) unsigned NOT NULL,
    `burn_closed` tinyint(1) unsigned NOT NULL,
    `burn_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`burn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `pmc_dsc_burn` VALUES (1, 1, 1, '2006-09-16', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (2, 2, 1, '2006-09-16', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (3, 3, 1, '2006-09-16', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (4, 4, 1, '2006-09-16', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (5, 5, 1, '2006-09-16', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (6, 6, 1, '2006-09-17', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (7, 7, 1, '2006-09-28', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (8, 8, 1, '2006-09-29', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (9, 9, 1, '2006-09-29', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (10, 10, 1, '2006-10-12', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (11, 11, 1, '2006-10-16', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (12, 12, 1, '2006-10-16', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (13, 13, 1, '2006-10-18', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (14, 14, 1, '2006-11-19', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (15, 15, 1, '2006-11-19', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (16, 16, 1, '2006-11-28', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (17, 17, 1, '2006-11-27', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (18, 18, 1, '2006-11-27', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (19, 19, 1, '2006-11-28', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (20, 20, 1, '2006-12-04', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (21, 21, 1, '2006-12-08', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (22, 22, 1, '2006-12-11', 1, 0, '');
INSERT INTO `pmc_dsc_burn` VALUES (23, 23, 1, '2006-12-14', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (24, 24, 1, '2006-12-18', 1, 0, '');
INSERT INTO `pmc_dsc_burn` VALUES (25, 25, 1, '2006-12-18', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (26, 26, 1, '2006-12-23', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (27, 27, 1, '2007-01-10', 1, 0, '');
INSERT INTO `pmc_dsc_burn` VALUES (28, 28, 1, '2007-01-16', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (29, 29, 1, '2007-01-16', 1, 0, '');
INSERT INTO `pmc_dsc_burn` VALUES (30, 30, 1, '2007-01-17', 1, 0, '');
INSERT INTO `pmc_dsc_burn` VALUES (31, 31, 1, '2007-01-23', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (32, 32, 1, '2007-01-23', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (33, 33, 1, '2007-01-27', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (34, 34, 1, '2007-01-27', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (35, 35, 1, '2007-01-30', 1, 0, '');
INSERT INTO `pmc_dsc_burn` VALUES (36, 36, 1, '2007-02-01', 1, 0, '');
INSERT INTO `pmc_dsc_burn` VALUES (37, 37, 1, '2007-02-12', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (38, 38, 1, '2007-03-02', 1, 0, '');
INSERT INTO `pmc_dsc_burn` VALUES (39, 39, 1, '2007-03-02', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (40, 40, 1, '2007-03-02', 1, 0, '');
INSERT INTO `pmc_dsc_burn` VALUES (41, 41, 1, '2007-03-03', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (42, 42, 1, '2007-03-03', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (43, 43, 1, '2007-03-10', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (44, 44, 1, '2007-03-10', 1, 0, '');
INSERT INTO `pmc_dsc_burn` VALUES (45, 45, 1, '2007-03-13', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (46, 46, 1, '2007-03-13', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (47, 47, 1, '2007-03-13', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (48, 48, 1, '2007-03-13', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (49, 49, 1, '2007-03-14', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (50, 50, 1, '2007-03-21', 0, 1, '');
INSERT INTO `pmc_dsc_burn` VALUES (51, 22, 1, '2006-12-12', 1, 0, 'tutor');
INSERT INTO `pmc_dsc_burn` VALUES (52, 24, 1, '2007-01-16', 1, 1, 'horror1');
INSERT INTO `pmc_dsc_burn` VALUES (53, 29, 1, '2007-01-17', 1, 0, 'horror2');
INSERT INTO `pmc_dsc_burn` VALUES (54, 30, 1, '2007-01-20', 1, 0, 'asian3');
INSERT INTO `pmc_dsc_burn` VALUES (55, 30, 1, '2007-01-23', 1, 0, 'asian 3');
INSERT INTO `pmc_dsc_burn` VALUES (56, 29, 1, '2007-01-30', 1, 0, 'horror 2');
INSERT INTO `pmc_dsc_burn` VALUES (57, 29, 1, '2007-02-01', 1, 1, 'horror 2');
INSERT INTO `pmc_dsc_burn` VALUES (58, 35, 1, '2007-02-15', 1, 0, 'animation');
INSERT INTO `pmc_dsc_burn` VALUES (59, 27, 1, '2007-03-01', 1, 0, 'horror 3');
INSERT INTO `pmc_dsc_burn` VALUES (60, 40, 1, '2007-03-03', 1, 0, 'devel 2');
INSERT INTO `pmc_dsc_burn` VALUES (61, 36, 1, '2007-03-03', 1, 0, 'omen');
INSERT INTO `pmc_dsc_burn` VALUES (62, 30, 1, '2007-03-03', 1, 0, 'asian 3');
INSERT INTO `pmc_dsc_burn` VALUES (63, 38, 1, '2007-03-03', 1, 0, 'devel 4');
INSERT INTO `pmc_dsc_burn` VALUES (64, 44, 1, '2007-03-14', 1, 0, 'devel 3');
INSERT INTO `pmc_dsc_burn` VALUES (65, 40, 1, '2007-03-14', 1, 0, 'devel 2');
INSERT INTO `pmc_dsc_burn` VALUES (66, 38, 1, '2007-03-21', 1, 0, 'devel 4');
INSERT INTO `pmc_dsc_burn` VALUES (67, 30, 1, '2007-03-13', 1, 1, 'asian 3');

-- -- -- -- -- -- -- -- -- --
-- pmc_dsc_categ
-- -- -- -- -- -- -- -- -- --
--  DISC_CATEGORIES
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_dsc_categ`;
CREATE TABLE `pmc_dsc_categ` (
    `categ_id` int(5) unsigned NOT NULL,
    `categ_tt` varchar(6) NOT NULL,
    `categ_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`categ_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `pmc_dsc_categ` VALUES (1, 'movies', 'movies');
INSERT INTO `pmc_dsc_categ` VALUES (2, 'media', 'music (audio & video)');
INSERT INTO `pmc_dsc_categ` VALUES (3, 'soft', 'software');
INSERT INTO `pmc_dsc_categ` VALUES (4, 'dvd', 'dvd video');
INSERT INTO `pmc_dsc_categ` VALUES (5, 'other', 'documents, etc');

-- -- -- -- -- -- -- -- -- --
-- pmc_dsc_lend
-- -- -- -- -- -- -- -- -- --
--  LENDING_HISTORY
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_dsc_lend`;
CREATE TABLE `pmc_dsc_lend` (
    `lend_id` int(5) unsigned NOT NULL,
    `people_id` int(5) unsigned NOT NULL,
    `lend_date` date NOT NULL,
    `lend_return_date` date NOT NULL,
    `lend_keep` tinyint(1) unsigned NOT NULL,
    `lend_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`lend_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;