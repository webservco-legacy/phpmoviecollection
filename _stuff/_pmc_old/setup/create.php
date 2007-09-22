<?php
error_reporting(E_ALL);
include './../include/config.inc.php';
include './../include/dbopen.inc.php';
$tname = "xxx";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<HTML>

<HEAD>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">

	<TITLE>The Underground Beat - Admin - Create MySQL table: <?=$tname?></TITLE>

	<META NAME="author" CONTENT="Radu Maier">
	
	<META NAME="keywords" CONTENT="underbeat, oi moroi, moroi, underground, beat, The Underground Beat, Underground Beat">
	
	<META NAME="description" CONTENT="The Underground Beat">
</HEAD>

<BODY BGCOLOR="#EDEDED">
    <DIV ALIGN="center">
<?php
$query = "CREATE TABLE $tname ( ".
		 "`id` INT(5) UNSIGNED NOT NULL, ".
         "`col_main_owner` VARCHAR(30) NOT NULL, ".
         "`col_main_started` DATE NOT NULL, ".
         "`col_main_movies` TINYINT(1) UNSIGNED NOT NULL, ".
         "`col_main_music` TINYINT(1) UNSIGNED NOT NULL, ".
		 "PRIMARY KEY (`id`) ". 
		 ") ENGINE=MyISAM DEFAULT CHARSET=latin1";
	
mysql_query($query) or die('<FONT COLOR="#990000"><B>Oups!<BR>' . mysql_error() . '</B></FONT>');

echo 'Table <B>' . $tname . '</B> created!';
?>
    </DIV>
</BODY>
</HTML>
<?php
include './../include/dbclose.inc.php';
?>