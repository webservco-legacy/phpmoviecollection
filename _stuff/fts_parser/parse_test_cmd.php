
PostgreSQL TSearch2 Parse Test

Supports: AND OR NOT ( ) and phrases surrounded with double quotes "like this",
nesting is supported, spaces between keywords will default to AND.

Test Keyword Search Phrase: <?php
	$s_keyword = trim(fgets(STDIN));

	require_once 'parse_model.php';


	$o = new parse_model();
	$o->b_debug = TRUE;
	$o->b_default_and = TRUE;

	if ( $s_keyword != '' )
	{
		$o->parse($s_keyword);
		print "Message to user: [$o->s_error_msg]\n\n";
	}

?>