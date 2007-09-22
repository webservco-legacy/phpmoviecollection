<?php
	$s_keyword = '';
	if ( isset($_POST['keyword']) )
		$s_keyword = stripslashes($_POST['keyword']);
?>
<form action="test.php" method="post">
<input name="keyword" type="text" value="<?php print htmlspecialchars($s_keyword); ?>" size="80" />
<input type="submit" />
</form>

<pre>
<?php

	require_once 'parse_model.php';


	$o = new parse_model();
	$o->b_debug = TRUE;
	$o->b_default_and = TRUE;

	if ( $s_keyword != '' )
	{
		$o->parse($s_keyword);
		//print "Message to user: [$o->s_error_msg]\n\n";
	}

?>
</pre>