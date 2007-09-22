<?php
$query_rstCollectors = "SELECT * FROM `pmc_set_usr` WHERE `usr_level` >= '2' ORDER BY `usr_display` ASC";
$rstCollectors = mysql_query($query_rstCollectors) or die('Oups!<br>' . mysql_error());
$totalRows_rstCollectors = mysql_num_rows($rstCollectors);
?>