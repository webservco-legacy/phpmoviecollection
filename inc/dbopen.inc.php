<?php
$dbconn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Oups!<br>' . mysql_error());
mysql_select_db($dbname) or die('Oups!<br>' . mysql_error());
?>