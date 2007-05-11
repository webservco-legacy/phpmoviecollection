<?php
error_reporting(E_ALL);
include './../include/config.inc.php';
include './../include/dbopen.inc.php';
if (!isset($_GET['table'])) {die('table = ?');}
$tname = $_GET['table'];
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
$query = "DROP TABLE `" . $tname. "`";
	
mysql_query($query) or die('<FONT COLOR="#990000"><B>Oups!<BR>' . mysql_error() . '</B></FONT>');

echo 'Table <B>' . $tname . '</B> dropped!';
?>
    </DIV>
</BODY>
</HTML>
<?php
include './../include/dbclose.inc.php';
?>