SELECT DISTINCT pmc_mov_titles.*
FROM `pmc_mov_titles`, `pmc_mov_aka`, `pmc_mov_tt_horror_categ`, `pmc_mov_tt_horror_subcateg`, `pmc_mov_tt_genres`, `pmc_mov_tt_countries`, `pmc_mov_tt_langs` 
WHERE (pmc_mov_titles.movie_id = pmc_mov_tt_genres.movie_id AND pmc_mov_tt_genres.movie_genre_id /*= '14'*/!= '0')

AND (pmc_mov_titles.movie_id = pmc_mov_tt_countries.movie_id AND pmc_mov_tt_countries.country_iso /*= 'US'*/!= '')
AND (pmc_mov_titles.movie_id = pmc_mov_tt_langs.movie_id AND pmc_mov_tt_langs.lang_index /*= 'kd'*/!= '')
AND pmc_mov_titles.categ_id /*= '1'*/!= '0'
AND pmc_mov_titles.movie_year /*= '1987'*/!= '0000'
AND pmc_mov_titles.movie_type /*= '1'*/!= '0'
AND pmc_mov_titles.movie_release /*= '1'*/!= '0'
AND pmc_mov_titles.movie_color /*= '1'*/!= '0'
AND pmc_mov_titles.movie_imdb_rating /*>= '7.8'*/>= '0'
AND (pmc_mov_titles.movie_official_title REGEXP 'evil|dead|wood' 
	OR pmc_mov_titles.movie_informal_title REGEXP 'evil'
	OR (pmc_mov_titles.movie_id = pmc_mov_aka.movie_id AND pmc_mov_aka.movie_aka_title REGEXP 'white'));
