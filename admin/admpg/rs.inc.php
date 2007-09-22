<?php
$tname = 'pmc_var_stats';
$query = "TRUNCATE TABLE `$tname`";
mysql_query($query) or die('<DIV CLASS="adm_msg">Oups!<BR>' . mysql_error() . '</DIV>');
?>
<DIV CLASS="adm_msg">
ok
<BR>
<A CLASS="adm_default" HREF="<?=ADM_URL?>admin.php?action=adm"><?=$lnBack?></A>
</DIV>
