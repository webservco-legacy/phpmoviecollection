-- -- -- -- -- -- -- -- -- --
-- pmc_set_menu
-- -- -- -- -- -- -- -- -- --
--  MENU
-- -- -- -- -- -- -- -- -- --
DROP TABLE IF EXISTS `pmc_set_menu`;
CREATE TABLE `pmc_set_menu` (
    `menu_id` int(5) unsigned NOT NULL,
    `menu_name` varchar(30) NOT NULL,
    `menu_link` varchar(30) NOT NULL,
    PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;