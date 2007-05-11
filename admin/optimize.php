<?php
$optimize_query = "OPTIMIZE TABLE `pmc_dsc_burn` , `pmc_dsc_categ` , `pmc_dsc_ddb` , `pmc_dsc_discs` , `pmc_dsc_lend` , `pmc_dsc_mnf` , `pmc_dsc_recorders` , `pmc_dsc_types` , `pmc_mov_titles` , `pmc_mus_artists` , `pmc_mus_songs` , `pmc_mus_titles` , `pmc_mus_tt` , `pmc_set_countries` , `pmc_set_lang` , `pmc_set_lists` , `pmc_set_names` , `pmc_set_people` , `pmc_set_settings` , `pmc_set_themes` , `pmc_set_usr` , `pmc_var_logins` , `pmc_var_stats`"
$flush_logins_query = "TRUNCATE TABLE `pmc_var_logins`";
$flush_stats_query = "TRUNCATE TABLE `pmc_var_stats`";
?>