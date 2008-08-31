SELECT SQL_CALC_FOUND_ROWS mov_tt
FROM pmmc_mov_tt
WHERE
mov_imdb IS NOT NULL
AND mov_tt IS NOT NULL
AND mov_aka IS NOT NULL
AND mov_year IS NOT NULL
AND mov_country IS NOT NULL
AND mov_language IS NOT NULL
AND mov_dir IS NOT NULL
AND mov_wrt IS NOT NULL
AND mov_tag IS NOT NULL
AND mov_plot IS NOT NULL
AND mov_cast REGEXP 'simon'

ORDER BY
mov_tt
-- mov_year
-- mov_date
ASC

LIMIT 0, 3
;

SELECT FOUND_ROWS() as totalitems;


get:
cat_id
sort
order


config:
items_per_page