<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
  
    <TITLE>diacr</TITLE>

</HEAD>
<BODY>

<?php
if (isset($_POST['ok'])) {
echo '<PRE>';
print_r($_POST);
echo '</PRE>';
echo '<HR>';

$string = $_POST['sir'];
$new = htmlentities($string, ENT_NOQUOTES, 'ISO-8859-1');
$new = str_ireplace('&amp;','&',$new);
$new = str_ireplace('&copy;','&#169;',$new);
$new = str_ireplace('&deg;','&#176;',$new);

$new = str_replace('&acirc;','&#226;',$new);
$new = str_replace('&Acirc;','&#194;',$new);
$new = str_replace('&icirc;','&#238;',$new);
$newx = str_replace('&Icirc;','&#206;',$new);

echo 'post = ' . $_POST['sir'];
echo '<HR>';
echo 'new = ' . $newx;
}
?>

<script language="JavaScript">
<!--
function Diacr(lit) { 
    document.dic.sir.value=document.dic.sir.value+lit; 
    document.dic.sir.focus(); 
    document.dic.ok.value=("OKAY");
}
// -->
</script>
<form method="POST" action="" name="dic">
<a href="#" class="diacr" onclick="JavScript:Diacr('&#169;')">&#169;</a>
<a href="#" class="diacr" onclick="JavScript:Diacr('&#176;')">&#176;</a>
&nbsp;|&nbsp;
<a href="#" class="diacr" onclick="JavScript:Diacr('&#226;')">&#226;</a>
<a href="#" class="diacr" onclick="JavScript:Diacr('&#194;')">&#194;</a>
&nbsp;|&nbsp;
<a href="#" class="diacr" onclick="JavScript:Diacr('&#259;')">&#259;</a>
<a href="#" class="diacr" onclick="JavScript:Diacr('&#258;')">&#258;</a>
&nbsp;|&nbsp;
<a href="#" class="diacr" onclick="JavScript:Diacr('&#238;')">&#238;</a>
<a href="#" class="diacr" onclick="JavScript:Diacr('&#206;')">&#206;</a>
&nbsp;|&nbsp;
<a href="#" class="diacr" onclick="JavScript:Diacr('&#351;')">&#351;</a>
<a href="#" class="diacr" onclick="JavScript:Diacr('&#350;')">&#350;</a>
&nbsp;|&nbsp;
<a href="#" class="diacr" onclick="JavScript:Diacr('&#355;')">&#355;</a>
<a href="#" class="diacr" onclick="JavScript:Diacr('&#354;')">&#354;</a>
<BR>
<input type="text" name="sir" size="20" style="background-color: #000000; color: #FFFFFF" />
<BR>
<input type="submit" value="OK" name="ok" />
<input type="reset" value="CLEAR" name="cancel" />
</form>
<script src="./ToolTip.js"></script><script>initTip();</script>
</BODY>
</HTML>