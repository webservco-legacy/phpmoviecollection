<?php
/*
need: 
newfile ex 'mov_12.jpg'
picfile ex 'MV5BMTk2MjIxMjgwNF5BMl5BanBnXkFtZTcwNDAzNTgzMQ@@.jpg'
$cnt['page']['mov_imdb'] returned by pmc_get_imdb


get array with imdb pictures (main picture first)
imdb_pics = pmc_get_imdb_pics($cnt['page']['mov_pics_url']);

show a thumbnail for a picture:
<img src="http://rudisoft.ilive.ro/pmctest/lib/imdbpic.php?pic=MV5BMTMwMDkxNTIzMl5BMl5BanBnXkFtZTcwNjY5NzkyMQ@@.jpg" height="150" />

write a picture:
if(!pmc_save_imdb_pics('tester.jpg','MV5BMTk2MjIxMjgwNF5BMl5BanBnXkFtZTcwNDAzNTgzMQ@@.jpg')) {echo 'error';} else {echo 'ok';}
*/
?>