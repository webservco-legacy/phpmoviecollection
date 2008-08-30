SELECT SQL_CALC_FOUND_ROWS mov_tt
FROM pmmc_mov_tt
WHERE
mov_imdb IS NOT NULL
-- mov_imdb REGEXP '3'
AND
mov_tt IS NOT NULL
-- mov_tt REGEXP 'dead'
AND
mov_aka IS NOT NULL
-- XXX
;

SELECT FOUND_ROWS() as totalitems;