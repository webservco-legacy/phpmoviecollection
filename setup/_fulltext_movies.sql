SELECT *, MATCH (`movie_official_title`, `movie_informal_title`) AGAINST ('dead') AS `relevance` FROM `pmc_mov_titles` WHERE MATCH (`movie_official_title`, `movie_informal_title`) AGAINST ('dead') AND `movie_year` = '2004' AND `movie_type` = '1' AND `categ_id` = '0'  ORDER BY `relevance` DESC;
/* CREATE FULLTEXT INDEX `search_index` ON `pmc_mov_titles` (`movie_official_title`, `movie_informal_title`); */

SELECT * FROM `pmc_mov_titles` WHERE `movie_official_title` LIKE '%day%evil%' OR `movie_informal_title` LIKE '%day%evil%';

SELECT *, MATCH (`movie_official_title`, `movie_informal_title`) AGAINST ('day evil') AS `relevance` FROM `pmc_mov_titles` WHERE MATCH (`movie_official_title`, `movie_informal_title`) AGAINST ('day evil');
SELECT * FROM `pmc_mov_titles` WHERE `movie_official_title` REGEXP 'day|evil' OR `movie_informal_title` REGEXP 'day|evil';