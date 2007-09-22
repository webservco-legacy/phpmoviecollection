<?php
$query = "TRUNCATE TABLE `$tname`";
mysql_query($query) or die('<DIV CLASS="adm_msg">Oups!<BR>' . mysql_error() . '</DIV>');
?>
<DIV CLASS="adm_msg">
Table <B><?=$tname?></B> is empty!
</DIV>