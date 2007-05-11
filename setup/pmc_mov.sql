-- -- -- -- -- -- -- -- -- --
-- pmc_mov_lang
-- -- -- -- -- -- -- -- -- --
--  MOVIE LANGUAGES
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_mov_lang`;
CREATE TABLE `pmc_mov_lang` (
    `language_id` int(5) unsigned NOT NULL,
    `movie_id` int(5) unsigned NOT NULL,
    `movie_language` varchar(30) NOT NULL,
    PRIMARY KEY (`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -- -- -- -- -- -- -- -- --
-- pmc_mov_titles
-- -- -- -- -- -- -- -- -- --
--  MOVIE_TITLES
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_mov_titles`;
CREATE TABLE `pmc_mov_titles` (
    `movie_id` int(5) unsigned NOT NULL,
    `movie_title_the` varchar(3) NOT NULL,
    `movie_offical_title` varchar(110) NOT NULL,
    `movie_informal_title` varchar(110) NOT NULL,
    `movie_year` year(4) NOT NULL,
    `movie_type` tinyint(1) unsigned NOT NULL,
    `movie_release` tinyint(1) unsigned NOT NULL,
    `movie_color` tinyint(1) unsigned NOT NULL,
    `movie_country` smallint(3) unsigned NOT NULL,
    `movie_imdb_id` int(7) unsigned zerofill NOT NULL,
    `movie_imdb_rating` double(3,1) NOT NULL,
    `movie_jmdb_id` int(10) unsigned NOT NULL,
    `movie_poster` varchar(30) NOT NULL,
    `movie_details` tinyint(1) unsigned NOT NULL,
    `movie_add_date` date NOT NULL,
    `movie_add_usr` int(5) unsigned NOT NULL,
    `movie_notes` varchar(150) NOT NULL,
    PRIMARY KEY (`movie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `pmc_mov_titles` VALUES (1, '0', 'Back to the Future', 'Back to the Future I', 0000, 1, 0, 1, '', 0088763, 8.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (2, '0', 'Back to the Future Part II', 'Back to the Future II', 0000, 1, 0, 1, '', 0096874, 7.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (3, '0', 'Back to the Future Part III', 'Back to the Future III', 0000, 1, 0, 1, '', 0099088, 6.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (4, '0', 'Cats & Dogs', 'Cats & Dogs', 0000, 1, 0, 1, '', 0239395, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (5, '0', 'Ghost', 'Ghost', 0000, 1, 0, 1, '', 0099653, 6.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (6, '0', 'Harry Potter and the Chamber of Secrets', 'Harry Potter II', 0000, 1, 0, 1, '', 0295297, 7.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (7, '0', 'Harry Potter and the Prisoner of Azkaban', 'Harry Potter III', 0000, 1, 0, 1, '', 0304141, 7.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (8, '0', 'Siu nin Wong Fei Hung ji Tit Ma Lau', 'Iron Monkey', 0000, 1, 0, 1, '', 0108148, 7.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (9, '0', '50 First Dates', '50 First Dates', 0000, 1, 0, 1, '', 0343660, 6.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (10, 'The', 'Lost World: Jurassic Park', 'Jurassic Park II', 0000, 1, 0, 1, '', 0119567, 5.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (11, 'The', 'Lord of the Rings: The Fellowship of the Ring', 'Lord of the Rings I', 0000, 1, 0, 1, '', 0120737, 8.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (12, 'The', 'Lord of the Rings: The Two Towers', 'Lord of the Rings II', 0000, 1, 0, 1, '', 0167261, 8.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (13, 'The', 'Lord of the Rings: The Return of the King', 'Lord of the Rings III', 0000, 1, 0, 1, '', 0167260, 8.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (14, 'The', 'Matrix', 'Matrix I', 0000, 1, 0, 1, '', 0133093, 8.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (15, 'The', 'Matrix Reloaded', 'Matrix II', 0000, 1, 0, 1, '', 0234215, 7.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (16, 'The', 'Matrix Revolutions', 'Matrix III', 0000, 1, 0, 1, '', 0242653, 6.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (17, 'The', 'Mummy', 'Mummy I', 0000, 1, 0, 1, '', 0120616, 6.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (18, 'The', 'New Guy', 'New Guy', 0000, 1, 0, 1, '', 0241760, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (19, 'The', 'Passion of the Christ', 'Passion of the Christ', 0000, 1, 0, 1, '', 0335345, 7.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (20, '0', 'Pirates of the Caribbean: The Curse of the Black Pearl', 'Pirates of the Caribbean I', 0000, 1, 0, 1, '', 0325980, 8.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (21, '0', 'Reign of Fire', 'Reign of Fire', 0000, 1, 0, 1, '', 0253556, 5.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (22, 'The', 'Scorpion King', 'Scorpion King', 0000, 1, 0, 1, '', 0277296, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (23, '0', 'Siu lam juk kau', 'Shaolin Soccer', 0000, 1, 0, 1, '', 0286112, 7.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (24, '0', 'Snatch.', 'Snatch', 0000, 1, 0, 1, '', 0208092, 8.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (25, '0', 'Taxi 2', 'Taxi II', 0000, 1, 0, 1, '', 0183869, 6.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (26, '0', 'Taxi 3', 'Taxi III', 0000, 1, 0, 1, '', 0295721, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (27, 'The', 'Time Machine', 'Time Machine', 0000, 1, 0, 1, '', 0268695, 5.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (28, '0', 'Vertical Limit', 'Vertical Limit', 0000, 1, 0, 1, '', 0190865, 5.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (29, '0', 'White Chicks', 'White Chicks', 0000, 1, 0, 1, '', 0381707, 4.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (30, 'The', 'AristoCats', 'AristoCats', 0000, 1, 0, 1, '', 0065421, 6.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (31, '0', 'A Fly in the Pink', 'Pink Panther: A Fly in the Pink', 0000, 2, 0, 1, '', 0067107, 5.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (32, '0', 'Dinosaur', 'Dinosaur', 0000, 1, 0, 1, '', 0130623, 6.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (33, '0', 'Finding Nemo', 'Finding Nemo', 0000, 1, 0, 1, '', 0266543, 8.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (34, '0', 'Ice Age', 'Ice Age I', 0000, 1, 0, 1, '', 0268380, 7.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (35, 'The', 'Jungle Book', 'Jungle Book I', 0000, 1, 0, 1, '', 0061852, 7.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (36, '0', 'J&#251;bei ninp&#251;ch&#244;', 'Ninja Scroll', 0000, 1, 0, 1, '', 0107692, 7.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (37, '0', 'Shrek', 'Shrek I', 0000, 1, 0, 1, '', 0126029, 8.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (38, '0', 'Shrek 2', 'Shrek II', 0000, 1, 0, 1, '', 0298148, 7.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (39, '0', 'Treasure Planet', 'Treasure Planet', 0000, 1, 0, 1, '', 0133240, 6.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (40, '0', 'Night of the Living Bread', 'Night of the Living Bread', 0000, 2, 0, 1, '', 0133313, 6.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (41, '0', 'Bride of the Gorilla', 'Bride of the Gorilla', 0000, 1, 0, 1, '', 0043360, 3.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (42, '0', 'Rock ''n'' Roll Frankenstein', 'Rock ''n'' Roll Frankenstein', 0000, 1, 0, 1, '', 0183717, 4.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (43, 'The', 'Mad Monster', 'Mad Monster, The', 0000, 1, 0, 1, '', 0035009, 2.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (44, '0', 'White Zombie', 'White Zombie', 0000, 1, 0, 1, '', 0023694, 6.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (45, '0', 'Night of the Living Dead', 'Night of the Living Dead', 0000, 1, 0, 1, '', 0063350, 7.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (46, 'The', 'Brain That Wouldn''t Die', 'Brain That Wouldn''t Die', 0000, 1, 0, 1, '', 0052646, 3.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (47, '0', 'Dementia', 'Dementia', 0000, 1, 0, 1, '', 0047976, 6.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (48, 'The', 'Good Book', 'Good Book', 0000, 1, 0, 1, '', 0198520, 6.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (49, '0', '28 Days Later...', '28 Days Later', 0000, 1, 0, 1, '', 0289043, 7.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (50, '0', 'American Nightmare', 'American Nightmare', 0000, 1, 0, 1, '', 0247164, 4.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (51, '0', 'Beyond Re-Animator', 'Re-Animator III', 0000, 1, 0, 1, '', 0222812, 5.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (52, 'The', 'Blair Witch Project', 'Blair Witch I', 0000, 1, 0, 1, '', 0185937, 6.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (53, '0', 'Book of Shadows: Blair Witch 2', 'Blair Witch II', 0000, 1, 0, 1, '', 0229260, 4.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (54, '0', 'Bone Sickness', 'Bone Sickness', 0000, 1, 0, 1, '', 0433346, 4.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (55, '0', 'Boogeyman', 'Boogeyman', 0000, 1, 0, 1, '', 0357507, 4.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (56, '0', 'Cabin Fever', 'Cabin Fever', 0000, 1, 0, 1, '', 0303816, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (57, '0', 'Jennifer''s Shadow', 'Jennifer''s Shadow', 0000, 1, 0, 1, '', 0382761, 4.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (58, '0', 'Cube Zero', 'Cube 0', 0000, 1, 0, 1, '', 0377713, 5.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (59, '0', 'Cube', 'Cube I', 0000, 1, 0, 1, '', 0123755, 7.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (60, '0', 'Cube<SUP>2</SUP>: Hypercube', 'Cube II', 0000, 1, 0, 1, '', 0285492, 5.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (61, '0', 'Darkness', 'Darkness', 0000, 1, 0, 1, '', 0273517, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (62, '0', 'Dawn of the Dead', 'Dawn of the Dead remake', 0000, 1, 0, 1, '', 0363547, 7.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (63, '0', 'Dead Birds', 'Dead Birds', 0000, 1, 0, 1, '', 0377749, 5.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (64, '0', 'Death Valley: The Revenge of Bloody Bill', 'Death Valley: The Revenge of Bloody Bill', 0000, 1, 0, 1, '', 0403885, 3.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (65, '0', 'Demoni 2', 'Demons 2', 0000, 1, 0, 1, '', 0090930, 4.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (66, '0', 'Event Horizon', 'Event Horizon', 0000, 1, 0, 1, '', 0119081, 5.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (67, '0', 'Within the Woods', 'Evil Dead 0', 0000, 2, 0, 1, '', 0078503, 6.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (68, 'The', 'Evil Dead', 'Evil Dead I', 0000, 1, 0, 1, '', 0083907, 7.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (69, '0', 'Evil Dead II', 'Evil Dead II', 0000, 1, 0, 1, '', 0092991, 7.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (76, '0', 'Hellraiser: Inferno', 'Hellraiser V', 0000, 1, 0, 1, '', 0229440, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (70, '0', 'Army Of Darkness', 'Evil Dead III', 0000, 1, 0, 1, '', 0106308, 7.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (71, '0', 'Faust: Love of the Damned', 'Faust: Love of the Damned', 0000, 1, 0, 1, '', 0223268, 4.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (72, '0', 'Freddy vs. Jason', 'A Nightmare on Elm Street VIII', 0000, 1, 0, 1, '', 0329101, 5.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (73, '0', 'Friday the 13<SUP>th</SUP>', 'Friday the 13th I', 0000, 1, 0, 1, '', 0080761, 6.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (74, '0', 'Ghost Ship', 'Ghost Ship', 0000, 1, 0, 1, '', 0288477, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (75, '0', 'Hellraiser III: Hell on Earth', 'Hellraiser III', 0000, 1, 0, 1, '', 0104409, 4.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (77, '0', 'Honogurai mizu no soko kara', 'Dark Water', 0000, 1, 0, 1, '', 0308379, 7.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (78, '0', 'House of the Dead', 'House of the Dead I', 0000, 1, 0, 1, '', 0317676, 2.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (79, '0', 'Infested', 'Infested', 0000, 1, 0, 1, '', 0287497, 2.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (80, '0', 'Jason X', 'Friday the 13th X', 0000, 1, 0, 1, '', 0211443, 4.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (81, '0', 'Jeepers Creepers', 'Jeepers Creepers I', 0000, 1, 0, 1, '', 0263488, 5.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (82, '0', 'Jeepers Creepers II', 'Jeepers Creepers II', 0000, 1, 0, 1, '', 0301470, 5.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (83, '0', 'Gin gwai', 'Eye, The', 0000, 1, 0, 1, '', 0325655, 6.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (84, 'The', 'Nightmare Before Christmas', 'Nightmare Before Christmas', 0000, 1, 0, 1, '', 0107688, 7.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (85, '0', 'Pet Sematary', 'Pet Sematary', 0000, 1, 0, 1, '', 0098084, 6.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (86, '0', 'Phantoms', 'Phantoms', 0000, 1, 0, 1, '', 0119891, 4.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (87, '0', 'Demon Island', 'Demon Island', 0000, 1, 0, 1, '', 0201844, 2.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (88, '0', 'Resident Evil', 'Resident Evil I', 0000, 1, 0, 1, '', 0120804, 6.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (89, '0', 'Shaun of the Dead', 'Shaun of the Dead', 0000, 1, 0, 1, '', 0365748, 7.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (90, '0', 'Shutter', 'Shutter', 0000, 1, 0, 1, '', 0440803, 7.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (91, '0', 'Signs', 'Signs', 0000, 1, 0, 1, '', 0286106, 6.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (92, 'The', 'Sixth Sense', 'Sixth Sense', 0000, 1, 0, 1, '', 0167404, 8.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (93, '0', 'Sleepy Hollow', 'Sleepy Hollow', 0000, 1, 0, 1, '', 0162661, 7.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (94, '0', 'Stigmata', 'Stigmata', 0000, 1, 0, 1, '', 0145531, 6.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (95, 'The', 'Texas Chainsaw Massacre', 'Texas Chainsaw Massacre remake', 0000, 1, 0, 1, '', 0324216, 5.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (96, '0', 'Thir13en Ghosts', 'Thir13en Ghosts', 0000, 1, 0, 1, '', 0245674, 4.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (97, '0', 'Undead', 'Undead', 0000, 1, 0, 1, '', 0339840, 5.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (98, '0', 'Underworld', 'Underworld', 0000, 1, 0, 1, '', 0320691, 6.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (99, '0', 'Van Helsing', 'Van Helsing', 0000, 1, 0, 1, '', 0338526, 5.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (100, '0', 'Pi', 'Pi', 0000, 1, 0, 1, '', 0138704, 7.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (101, '0', 'Hellboy', 'Hellboy', 0000, 1, 0, 1, '', 0167190, 6.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (102, '0', 'Shriek If You Know What I Did Last Friday the Thirteenth', 'Shriek If You Know What I Did Last Friday the Thirteenth', 0000, 1, 0, 1, '', 0212235, 3.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (103, 'The', 'Amityville Horror', 'Amityville Horror I', 0000, 1, 0, 1, '', 0078767, 5.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (104, 'The', 'Amityville Horror', 'Amityville Horror remake', 0000, 1, 0, 1, '', 0384806, 5.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (105, '0', 'Ju-on: The Curse', 'Ju-on I', 0000, 1, 0, 1, '', 0330500, 6.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (106, '0', 'Shao Lin jiang shi', 'Shaolin vs. Evil Dead', 0000, 1, 0, 1, '', 0467488, 4.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (107, 'The', 'Ring Two', 'Ring remake: Ring II', 0000, 1, 0, 1, '', 0377109, 5.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (108, 'The', 'Ring', 'Ring remake: Ring I', 0000, 1, 0, 1, '', 0298130, 7.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (109, '0', 'Dominion: Prequel to the Exorcist', 'Exorcist V', 0000, 1, 0, 1, '', 0449086, 5.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (110, '0', 'Dracula', 'Dracula', 0000, 1, 0, 1, '', 0021814, 7.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (111, '0', 'Scared to Death', 'Scared to Death', 0000, 1, 0, 1, '', 0039800, 3.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (112, '0', 'Frankenstein', 'Frankenstein', 0000, 1, 0, 1, '', 0021884, 8.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (113, '0', 'Maniac', 'Maniac', 0000, 1, 0, 1, '', 0025465, 2.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (114, 'The', 'Monster Walks', 'Monster Walks', 0000, 1, 0, 1, '', 0023236, 4.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (115, '0', 'Cup of My Blood', 'Cup of My Blood', 0000, 1, 0, 1, '', 0446673, 4.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (116, '0', 'Fear of the Dark', 'Fear of the Dark', 0000, 1, 0, 1, '', 0308252, 5.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (117, 'The', 'Relic', 'Relic', 0000, 1, 0, 1, '', 0120004, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (118, 'The', 'Haunted Mansion', 'Haunted Mansion', 0000, 1, 0, 1, '', 0338094, 4.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (119, 'The', 'Forgotten', 'Forgotten', 0000, 1, 0, 1, '', 0356618, 5.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (120, '0', 'Boo', 'Boo', 0000, 1, 0, 1, '', 0385560, 4.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (121, '0', 'Dark Water', 'Dark Water remake', 0000, 1, 0, 1, '', 0382628, 5.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (122, 'The', 'Prophecy: Uprising', 'Prophecy: Uprising', 0000, 1, 0, 1, '', 0365658, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (123, '0', 'Hellraiser: Deader', 'Hellraiser VII', 0000, 1, 0, 1, '', 0337636, 4.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (124, '0', 'Stir of Echoes', 'Stir of Echoes', 0000, 1, 0, 1, '', 0164181, 7.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (125, '0', 'Monster Man', 'Monster Man', 0000, 1, 0, 1, '', 0365513, 5.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (126, '0', '''Salem''s Lot', 'Salem''s Lot', 0000, 1, 0, 1, '', 0355987, 6.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (127, '0', 'Dracula', 'Dracula', 0000, 1, 0, 1, '', 0103874, 7.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (128, '0', 'Voyage of the Unicorn', 'Voyage of the Unicorn', 0000, 1, 0, 1, '', 0249326, 6.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (129, '0', 'Darkness Falls', 'Darkness Falls', 0000, 1, 0, 1, '', 0282209, 4.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (130, 'The', 'Descent', 'Descent', 0000, 1, 0, 1, '', 0435625, 7.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (131, '0', 'Resident Evil: Apocalypse', 'Resident Evil II', 0000, 1, 0, 1, '', 0318627, 5.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (132, '0', 'Seven Days to Live', 'Seven Days to Live', 0000, 1, 0, 1, '', 0221928, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (133, '0', 'House on Haunted Hill', 'House on Haunted Hill', 0000, 1, 0, 1, '', 0185371, 5.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (134, '0', 'Jumanji', 'Jumanji', 0000, 1, 0, 1, '', 0113497, 6.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (135, '0', 'Doom', 'Doom', 0000, 1, 0, 1, '', 0419706, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (136, '0', 'Exorcist: The Beginning', 'Exorcist IV', 0000, 1, 0, 1, '', 0204313, 5.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (137, '0', 'Land of the Dead', 'Land of the Dead', 0000, 1, 0, 1, '', 0418819, 6.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (138, '0', 'Jisatsu saakuru', 'Suicide Club', 0000, 1, 0, 1, '', 0312843, 6.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (139, '0', 'Silent Warnings', 'Silent Warnings', 0000, 1, 0, 1, '', 0348031, 4.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (140, '0', 'Dog Soldiers', 'Dog Soldiers', 0000, 1, 0, 1, '', 0280609, 6.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (141, '0', 'Haute tension', 'Haute tension', 0000, 1, 0, 1, '', 0338095, 6.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (142, '0', 'Fallen', 'Fallen', 0000, 1, 0, 1, '', 0119099, 6.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (143, '0', '"Rose Red"', 'Rose Red', 0000, 1, 0, 1, '', 0259153, 6.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (144, 'The', 'Breed', 'Breed', 0000, 1, 0, 1, '', 0265104, 4.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (145, 'The', 'Gathering', 'Gathering', 0000, 1, 0, 1, '', 0294594, 5.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (146, '0', 'Halloween: Resurrection', 'Halloween VIII', 0000, 1, 0, 1, '', 0220506, 4.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (147, '0', 'A Nightmare on Elm Street', 'A Nightmare on Elm Street I', 0000, 1, 0, 1, '', 0087800, 7.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (148, '0', 'A Nightmare on Elm Street Part 2: Freddy''s Revenge', 'A Nightmare on Elm Street II', 0000, 1, 0, 1, '', 0089686, 4.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (149, '0', 'A Nightmare on Elm Street 3: Dream Warriors', 'A Nightmare on Elm Street III', 0000, 1, 0, 1, '', 0093629, 5.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (150, '0', 'A Nightmare on Elm Street 4: The Dream Master', 'A Nightmare on Elm Street IV', 0000, 1, 0, 1, '', 0095742, 4.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (151, '0', 'A Nightmare on Elm Street: The Dream Child', 'A Nightmare on Elm Street V', 0000, 1, 0, 1, '', 0097981, 4.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (152, '0', 'Freddy''s Dead: The Final Nightmare', 'A Nightmare on Elm Street VI', 0000, 1, 0, 1, '', 0101917, 4.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (153, '0', 'New Nightmare', 'A Nightmare on Elm Street VII', 0000, 1, 0, 1, '', 0111686, 6.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (154, '0', 'Ghosts of Mars', 'Ghosts of Mars', 0000, 1, 0, 1, '', 0228333, 4.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (155, '0', 'Halloween H20: 20 Years Later', 'Halloween VII', 0000, 1, 0, 1, '', 0120694, 5.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (156, '0', 'Halloween', 'Halloween I', 0000, 1, 0, 1, '', 0077651, 7.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (157, '0', 'Bats', 'Bats', 0000, 1, 0, 1, '', 0200469, 3.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (158, '0', 'Bless the Child', 'Bless the Child', 0000, 1, 0, 1, '', 0163983, 4.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (159, '0', '&#212;dishon', 'Audition', 0000, 1, 0, 1, '', 0235198, 7.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (160, '0', 'Cursed', 'Cursed', 0000, 1, 0, 1, '', 0257516, 4.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (161, 'The', 'Exorcist', 'Exorcist I', 0000, 1, 0, 1, '', 0070047, 8.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (162, '0', 'Exorcist II: The Heretic', 'Exorcist II', 0000, 1, 0, 1, '', 0076009, 3.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (163, '0', 'Alien', 'Alien I', 0000, 1, 0, 1, '', 0078748, 8.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (164, '0', 'Aliens', 'Alien II', 0000, 1, 0, 1, '', 0090605, 8.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (165, '0', 'Alien<SUP>3</SUP>', 'Alien III', 0000, 1, 0, 1, '', 0103644, 6.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (166, '0', 'Alien: Resurrection', 'Alien IV', 0000, 1, 0, 1, '', 0118583, 6.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (167, '0', 'AVP: Alien vs. Predator', 'Alien V', 0000, 1, 0, 1, '', 0370263, 5.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (168, '0', 'Silent Hill', 'Silent Hill', 0000, 1, 0, 1, '', 0384537, 6.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (169, '0', 'Constantine', 'Constantine', 0000, 1, 0, 1, '', 0360486, 6.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (170, 'The', 'Lake House', 'Lake House', 0000, 1, 0, 1, '', 0410297, 6.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (171, 'The', 'Hot Chick', 'Hot Chick', 0000, 1, 0, 1, '', 0302640, 5.6, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (172, 'The', 'Boondock Saints', 'Boondock Saints', 0000, 1, 0, 1, '', 0144117, 7.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (173, '0', 'Snow White and the Seven Dwarfs', 'Snow White and the Seven Dwarfs', 0000, 1, 0, 1, '', 0029583, 7.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (174, '0', 'Beauty and the Beast', 'Beauty and the Beast', 0000, 1, 0, 1, '', 0101414, 7.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (175, 'The', 'Diary of Ellen Rimbauer', 'Rose Red prequel', 0000, 1, 0, 1, '', 0350811, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (176, '0', 'An American Werewolf in London', 'An American Werewolf in London', 0000, 1, 0, 1, '', 0082010, 7.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (177, '0', 'Jurassic Park', 'Jurassic Park I', 0000, 1, 0, 1, '', 0107290, 7.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (178, '0', 'Man-Thing', 'Man-Thing', 0000, 1, 0, 1, '', 0290747, 4.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (179, '0', 'Nosferatu, eine Symphonie des Grauens', 'Nosferatu, eine Symphonie des Grauens', 0000, 1, 0, 1, '', 0013442, 8.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (180, '0', 'Amityville II: The Possession', 'Amityville Horror II', 0000, 1, 0, 1, '', 0083550, 4.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (181, 'The', 'Omen', 'Omen I', 0000, 1, 0, 1, '', 0075005, 7.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (182, '0', 'Damien: Omen II', 'Omen II', 0000, 1, 0, 1, '', 0077394, 5.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (183, 'The', 'Final Conflict', 'Omen III', 0000, 1, 0, 1, '', 0082377, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (184, 'The', 'Grudge', 'Ju-On remake: Grudge I', 0000, 1, 0, 1, '', 0391198, 5.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (185, 'The', 'Grudge 2', 'Ju-On remake: Grudge II', 0000, 1, 0, 1, '', 0433386, 4.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (186, '0', 'Pulse', 'Pulse remake', 0000, 1, 0, 1, '', 0454919, 4.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (187, '0', 'Death Tunnel', 'Death Tunnel', 0000, 1, 0, 1, '', 0418627, 2.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (188, '0', 'Fr&#225;giles', 'Fragile', 0000, 1, 0, 1, '', 0422272, 6.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (189, '0', 'They', 'They', 0000, 1, 0, 1, '', 0283632, 4.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (190, 'The', 'Dark', 'Dark', 0000, 1, 0, 1, '', 0411267, 5.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (191, 'The', 'Skeleton Key', 'Skeleton Key', 0000, 1, 0, 1, '', 0397101, 6.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (192, '0', 'Half Light', 'Half Light', 0000, 1, 0, 1, '', 0412798, 6.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (193, 'The', 'Exorcism of Emily Rose', 'Exorcism of Emily Rose', 0000, 1, 0, 1, '', 0404032, 6.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (194, '0', 'BloodRayne', 'BloodRayne', 0000, 1, 0, 1, '', 0383222, 2.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (195, '0', 'House of the Dead II: Dead Aim', 'House of the Dead II', 0000, 1, 0, 1, '', 0435665, 3.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (196, '0', 'J horaa shiataa 1: Kansen', 'J-Horror Theater Vol.1: Infection', 0000, 1, 0, 1, '', 0418778, 6.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (197, '0', 'J horaa shiataa 2: Yogen', 'J-Horror Theater Vol.2: Premonition', 0000, 1, 0, 1, '', 0419280, 6.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (198, '0', 'J horaa shiataa 3: Rinne', 'J-Horror Theater Vol.3: Reincarnation', 0000, 1, 0, 1, '', 0456630, 6.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (199, '0', 'Janghwa, Hongryeon', 'A Tale of Two Sisters', 0000, 1, 0, 1, '', 0365376, 7.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (200, '0', 'Kairo', 'Pulse', 0000, 1, 0, 1, '', 0286751, 6.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (201, '0', 'Chello hongmijoo ilga salinsagan', 'Cello', 0000, 1, 0, 1, '', 0475532, 6.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (202, '0', 'Ju-on: The Grudge 2', 'Ju-on IV', 0000, 1, 0, 1, '', 0367913, 6.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (203, '0', 'Ringu 0: B&#226;sudei', 'Ring 0: Birthday', 0000, 1, 0, 1, '', 0235712, 6.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (204, '0', 'Ringu', 'Ring I', 0000, 1, 0, 1, '', 0178868, 7.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (205, '0', 'Ringu 2', 'Ring II', 0000, 1, 0, 1, '', 0218553, 6.1, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (206, '0', 'Ju-on: The Grudge', 'Ju-on III', 0000, 1, 0, 1, '', 0364385, 6.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (207, '0', 'Chakushin ari', 'One Missed Call I', 0000, 1, 0, 1, '', 0366292, 6.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (208, '0', 'Chakushin ari 2', 'One Missed Call II', 0000, 1, 0, 1, '', 0451010, 5.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (209, '0', 'Plan 9 from Outer Space', 'Plan 9 from Outer Space', 0000, 1, 0, 1, '', 0052077, 3.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (210, '0', 'Gone Nutty', 'Ice Age: Gone Nutty', 0000, 2, 0, 1, '', 0342965, 7.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (211, '0', 'Mike''s New Car', 'Monsters Inc.: Mike''s New Car', 0000, 2, 0, 1, '', 0323250, 7.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (212, 'The', 'Chubbchubbs!', 'Chubbchubbs!', 0000, 2, 0, 1, '', 0331218, 7.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (213, '0', 'Shrek in the Swamp Karaoke Dance Party', 'Shrek: Shrek in the Swamp Karaoke Dance Party', 0000, 2, 0, 1, '', 0307461, 7.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (214, '0', 'Exorcism: The Possession of Gail Bowers', 'Exorcism: The Possession of Gail Bowers', 0000, 1, 0, 1, '', 0490919, 3.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (215, '0', 'Ju-on: The Curse 2', 'Ju-on II', 0000, 1, 0, 1, '', 0330501, 5.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (216, '0', 'Gakk&#244; no kaidan G: 4444444444', 'Ju-on 0 - 4444444444', 0000, 2, 0, 1, '', 0330312, 8.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (217, '0', 'Gakk&#244; no kaidan G: Katasumi', 'Ju-on 0 - In The Corner', 0000, 2, 0, 1, '', 0330312, 8.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (218, 'The', 'Little Mermaid', 'Little Mermaid', 0000, 1, 0, 1, '', 0097757, 7.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (219, 'The', 'Exorcist III: Legion', 'Exorcist III', 0000, 1, 0, 1, '', 0099528, 5.7, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (220, '0', 'Prince of Darkness', 'Prince of Darkness', 0000, 1, 0, 1, '', 0093777, 6.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (221, '0', 'Catwoman', 'Catwoman', 0000, 1, 0, 1, '', 0327554, 3.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (222, 'The', 'Calling', 'Calling', 0000, 1, 0, 1, '', 0218067, 4.2, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (223, '0', 'White Noise', 'White Noise', 0000, 1, 0, 1, '', 0375210, 5.3, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (224, '0', 'D-day - Eoneunnal kabjagi cheotbeonjjae iyagi', 'Roommates: 4 Horror Tales', 0000, 1, 0, 1, '', 0927595, 5.5, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (225, '0', 'Hellraiser: Hellseeker', 'Hellraiser VI', 0000, 1, 0, 1, '', 0274546, 4.9, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (226, '0', 'Oyayubi sagashi', 'Vanished', 0000, 1, 0, 1, '', 0781449, 0.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (227, '0', 'Omen IV: The Awakening', 'Omen IV', 0000, 1, 0, 1, '', 0102585, 3.4, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (228, '0', 'Re-Animator', 'Re-Animator I', 0000, 1, 0, 1, '', 0089885, 7.0, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (229, '0', 'Bride of Re-Animator', 'Re-Animator II', 0000, 1, 0, 1, '', 0099180, 5.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (230, '0', 'Bedazzled', 'Bedazzled', 0000, 1, 0, 1, '', 0230030, 5.8, 0, '', 0, '2007-03-14', 0, '');
INSERT INTO `pmc_mov_titles` VALUES (231, '0', 'Bunhongsin', 'The Red Shoes', 0000, 1, 0, 1, '', 0468683, 5.6, 0, '', 0, '2007-03-14', 0, '');
