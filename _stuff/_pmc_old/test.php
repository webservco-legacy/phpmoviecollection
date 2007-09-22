<?php
$s_page=0;
if(isset($_GET['s_page']) && isset($_POST['s_page'])) { $s_page = $_GET['s_page']; }
else if(!isset($_GET['s_page']) && isset($_POST['s_page'])) { $s_page = $_POST['s_page']; }
?>
<SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript">
function submitf(form, url)
{
	var myform;
	myform = document.all(form);
	myform.action=url;
	myform.submit();
}
</SCRIPT>
<FORM NAME="movsearch" ID="movsearch" ACTION="test.php" METHOD="post">
<INPUT TYPE="hidden" NAME="s_page" ID="s_page" VALUE="1">
<INPUT CLASS="search_form_go" TYPE="submit" NAME="Search" ID="Search" VALUE="Search">
</FORM>
<BR>
<?php $last = "&nbsp;<A CLASS=\"default\" HREF=\"#\" onClick=\"javascript:submitf('movsearch','test.php?s_page=25')\">" . "&#62;&#62;" . "</A>&nbsp;";?>
<?=$last?>
<BR>
<?=$s_page?>