-- pmc
-- DATABASE DEFAULT VALUES
-- except user and settings
-- 18:11 2008-09-13

-- ////////////////////////////////////////////////////////////////////////////////
-- PART ONE: ACTUAL COLLECTION
-- ////////////////////////////////////////////////////////////////////////////////

-- --------------------------------------------------------------------------------
-- CATEGORIES
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmc_mov_cat;

-- --------------------------------------------------------------------------------
-- MOVIES
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmc_mov_tt;

-- --------------------------------------------------------------------------------
-- GENRES
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmc_mov_gen;
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Action');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Adventure');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Animation');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Biography');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Comedy');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Crime');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Documentary');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Drama');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Family');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Fantasy');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Film-Noir');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Game-Show');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('History');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Horror');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Music');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Musical');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Mystery');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('News');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Reality-TV');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Romance');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Sci-Fi');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Short');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Sport');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Talk-Show');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Thriller');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('War');
INSERT INTO pmc_mov_gen (gen_tt) VALUES ('Western');


-- --------------------------------------------------------------------------------
-- GENRES - MOVIES RELATIONS
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmc_mov_rel;

-- ////////////////////////////////////////////////////////////////////////////////
-- PART TWO: USERS AND SETTINGS
-- ////////////////////////////////////////////////////////////////////////////////

-- --------------------------------------------------------------------------------
-- USERS
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmc_set_usr;

-- --------------------------------------------------------------------------------
-- SETTINGS
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmc_set_cfg;

-- --------------------------------------------------------------------------------
-- USER LISTS
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmc_set_lst;

-- ////////////////////////////////////////////////////////////////////////////////
-- PART TREE: STATISTICS
-- ////////////////////////////////////////////////////////////////////////////////

-- --------------------------------------------------------------------------------
-- LOGIN HISTORY
-- --------------------------------------------------------------------------------
TRUNCATE TABLE pmc_var_log;