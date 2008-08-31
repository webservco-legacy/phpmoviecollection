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
TRUNCATE TABLE pmmc_mov_tt;

-- --------------------------------------------------------------------------------
-- GENRES
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmmc_mov_gen;
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Action');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Adventure');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Animation');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Biography');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Comedy');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Crime');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Documentary');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Drama');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Family');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Fantasy');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Film-Noir');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Game-Show');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('History');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Horror');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Music');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Musical');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Mystery');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('News');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Reality-TV');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Romance');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Sci-Fi');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Short');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Sport');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Talk-Show');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Thriller');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('War');
INSERT INTO pmmc_mov_gen (gen_tt) VALUES ('Western');


-- --------------------------------------------------------------------------------
-- GENRES - MOVIES RELATIONS
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmmc_mov_rel;

-- ////////////////////////////////////////////////////////////////////////////////
-- PART TWO: USERS AND SETTINGS
-- ////////////////////////////////////////////////////////////////////////////////

-- --------------------------------------------------------------------------------
-- USERS
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmmc_set_usr;

-- ADMIN
INSERT INTO pmmc_set_usr (usr_name, usr_fname, usr_lname, usr_mail, usr_pass, usr_skin, usr_lang, usr_level, usr_status, usr_date) VALUES ('Root', 'Radu', 'Maier', 'radu@rudisoft.net', 'REDACTED', 'pmmc', 'ro', '3', '1', '2008-08-22');
-- --------------------------------------------------------------------------------
-- SETTINGS
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmmc_set_cfg;
-- DEFAULT LANGUAGE
INSERT INTO pmmc_set_cfg (cfg_set, cfg_val) VALUES ('LANG', 'ro');
-- DEFAULT SKIN
INSERT INTO pmmc_set_cfg (cfg_set, cfg_val) VALUES ('SKIN', 'pmmc');
-- CATEGOY PICTURE MAX SIZE
INSERT INTO pmmc_set_cfg (cfg_set, cfg_val) VALUES ('PCAT', '80');
-- MOVIE PICTURE MAX SIZE
INSERT INTO pmmc_set_cfg (cfg_set, cfg_val) VALUES ('PMOV', '80');
-- --------------------------------------------------------------------------------
-- USER LISTS
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmmc_set_lst;

-- ////////////////////////////////////////////////////////////////////////////////
-- PART TREE: STATISTICS
-- ////////////////////////////////////////////////////////////////////////////////

-- --------------------------------------------------------------------------------
-- LOGIN HISTORY
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmmc_var_log;