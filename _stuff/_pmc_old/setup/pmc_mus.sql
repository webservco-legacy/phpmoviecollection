-- -- -- -- -- -- -- -- -- --
-- pmc_mus_artists
-- -- -- -- -- -- -- -- -- --
--  ARTIST NAMES
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_mus_artists`;
CREATE TABLE `pmc_mus_artists` (
    `artist_id` int(5) unsigned NOT NULL,
    `artist_pre` varchar(110) NOT NULL,
    `artist_and` tinyint(1) unsigned NOT NULL,
    `artist_the` tinyint(1) unsigned NOT NULL,
    `artist_name` varchar(110) NOT NULL,
    `artist_band` tinyint(1) unsigned NOT NULL,
    `name_id` int(5) unsigned NOT NULL,
    `artist_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`artist_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- -- -- -- -- -- -- -- -- --
-- pmc_mus_titles
-- -- -- -- -- -- -- -- -- --
--  TITLES
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_mus_titles`;
CREATE TABLE `pmc_mus_titles` (
    `title_id` int(5) unsigned NOT NULL,
    `artist_type` tinyint(1) unsigned NOT NULL, /*  0 one // 1 va // 2 collab // 3 split */
    `artist_id1` int(5) unsigned NOT NULL,
    `artist_id2` int(5) unsigned NOT NULL,
    `title_the` tinyint(1) unsigned NOT NULL,
    `title_tt` varchar(110) NOT NULL,
    `title_label` tinyint(1) unsigned NOT NULL,
    `title_year` year(4) NOT NULL,
    `title_type` tinyint(1) unsigned NOT NULL,
    `title_cover` varchar(30) NOT NULL,
    `title_extended` tinyint(1) unsigned NOT NULL,
    `title_date` date NOT NULL,
    `title_venue` varchar(150) NOT NULL,
    `title_location` varchar(150) NOT NULL,
    `title_discs` tinyint(2) unsigned NOT NULL,
    `title_format_1` tinyint(1) unsigned NOT NULL,
    `title_format_2` tinyint(1) unsigned NOT NULL,
    `title_notes` varchar(150) NOT NULL,
    `title_added` date NOT NULL,
    PRIMARY KEY (`title_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- -- -- -- -- -- -- -- -- --
-- pmc_mus_songs
-- -- -- -- -- -- -- -- -- --
--  INDIVIDUAL SONGS
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_mus_songs`;
CREATE TABLE `pmc_mus_songs` (
    `song_id` int(5) unsigned NOT NULL,
    `title_id` int(5) unsigned NOT NULL,
    `artist_type` tinyint(1) unsigned NOT NULL, /*  0 one // 1 va // 2 collab // 3 split */
    `artist_id1` int(5) unsigned NOT NULL,
    `artist_id2` int(5) unsigned NOT NULL,
    `song_disc` tinyint(2) unsigned NOT NULL,
    `song_nr` int(3) unsigned NOT NULL,
    `song_the` tinyint(1) unsigned NOT NULL,
    `song_tt` varchar(110) NOT NULL,
    `song_time` time NOT NULL,
    `composer` int(5) unsigned NOT NULL,
    `song_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`song_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- -- -- -- -- -- -- -- -- --
-- pmc_mus_tt
-- -- -- -- -- -- -- -- -- --
--  USER'S TITLES
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_mus_tt`;
CREATE TABLE `pmc_mus_tt` (
    `tt_id` int(5) unsigned NOT NULL,
    `usr_id` int(5) unsigned NOT NULL,
    `list_id` int(5) unsigned NOT NULL,
    `title_id` int(5) unsigned NOT NULL,
    `disc_id` int(5) unsigned NOT NULL,
    `tt_format_1` tinyint(1) unsigned NOT NULL,
    `tt_format_2` tinyint(1) unsigned NOT NULL,
    `tt_type` tinyint(1) unsigned NOT NULL, /* original,  bootleg, etc */
    `tt_compression` tinyint(1) unsigned NOT NULL,
    `tt_mode` tinyint(1) unsigned NOT NULL,
    `tt_sample_rate` tinyint(1) unsigned NOT NULL,
    `tt_bitrate_type` tinyint(1) unsigned NOT NULL,
    `tt_bitrate` int(4) unsigned NOT NULL,
    `tt_crc` tinyint(1) unsigned NOT NULL,
    `tt_condition` tinyint(1) unsigned NOT NULL,
    `tt_size` double(6,2) NOT NULL,
    `tt_date` date NOT NULL,
    `tt_notes` varchar(150) NOT NULL,    
    PRIMARY KEY (`tt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;