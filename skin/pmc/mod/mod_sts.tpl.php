<div id="mod_sts">
<!--<h2><?php //echo $lang['stats']['stats']; ?></h2>-->
<?php
$today = date("Y-m-d");
$ttm = pmc_qry_result(pmc_qry_exec("SELECT COUNT(mov_id) FROM pmc_mov_tt"));
$tnm = pmc_qry_result(pmc_qry_exec("SELECT COUNT(mov_id) FROM pmc_mov_tt WHERE DATEDIFF('{$today}', mov_date) = '0'"));
$ttu = pmc_qry_result(pmc_qry_exec("SELECT COUNT(usr_id) FROM pmc_set_usr"));
?>
<?php echo $lang['stats']['movies']; ?>:&#160;<a href="<?php echo _APP_URL; ?>view/movies" title="<?php echo $lang['movie']['list']; ?>"><?php echo $ttm; ?></a>&#160;(<?php echo $tnm; ?>&#160;<?php echo $lang['stats']['newmovies']; ?>)<br />
<?php if($_SESSION['pmc_usr_level'] == 0) { ?>
<?php echo $lang['stats']['users']; ?>:&#160;<?php echo $ttu; ?>
<?php } ?>
</div>