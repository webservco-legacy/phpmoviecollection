<?php
	/*
	 * Full Text Search Parser for TSearch2 and PostgreSQL
	 *
	 * Converts a human readable search string into a TSearch2 query with
	 * ILIKE phrases.
	 *
	 * Copyright (c) 2006, Digital Stratum, Inc.
	 * All rights reserved.
	 *
	 * Redistribution and use in source and binary forms, with or without
	 * modification, are permitted provided that the following conditions
	 * are met:
	 *
	 * 1. Redistributions of source code must retain the above copyright
	 *    notice, this list of conditions and the following disclaimer.
	 *
	 * 2. Redistributions in binary form must reproduce the above copyright
	 *    notice, this list of conditions and the following disclaimer in
	 *    the documentation and/or other materials provided with the
	 *    distribution.
	 *
	 * 3. Neither the name of Digital Stratum, Inc. nor the names of its
	 *    contributors may be used to endorse or promote products derived
	 *    from this software without specific prior written permission.
	 *
	 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
	 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
	 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
	 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
	 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
	 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
	 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS
	 * OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
	 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
	 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF
	 * THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
	 * DAMAGE.
	 */


	/*
	 * Parse Class for PHP4.
	 *
	 * Accepts a string to be parsed and returns the TSearch2 and ILIKE
	 * parts, as well as a list of keywords and any error messages to
	 * the user if invalid input was found.
	 *
	 * Example:
	 *

		require_once 'parse_model_php4.php';

		// Get input into $s_keyword via form post or command line...
		$s_keyword = 'computer programmer ("c++" or php)';

		$o = new parse_model();
		$o->b_debug = TRUE;
		$o->b_default_and = TRUE;

		if ( $s_keyword != '' )
		{
			$o->parse($s_keyword);
			print "Message to user: [$o->s_error_msg]\n\n";
		}
	 */
class
parse_model
{
	// Lexeme of each token.
	var $s_token_string;

	// Current and Previous Token
	var $i_token;
	var $i_prev_token;

	// Lookahead array for supporting default values
	// between tokens.  Mostly used for a default "AND"
	// between to keywords.
	var $a_lookahead;
	var $b_default_and;

	// True if there was a syntax error.
	var $b_syntax_error;

	// Stop Words
	var $a_stopwords;

	// Last two logical tokens.
	var $a_expr;

	// Input text and current position in text.
	var $s_keyword;
	var $i_index;
	var $b_read_eof;

	// Track parens for the ilike string.
	var $s_ilike_paren;

	// Field to use for the ILIKE clause.
	var $s_ilike_field;

	// Output search strings.
	var $a_keywords;
	var $s_tsearch;
	var $s_ilike;
	var $s_error_msg;
	var $s_error_tok;
	var $i_error_pos;

	// Enable debug information.
	var $b_debug;

	// TOKEN TYPES
	var $a_tokens = array(
		'BEGINFILE',
		'ENDFILE',
		'ERROR',
		'KEYWORD',
		'ANDOP',
		'OROP',
		'NOTOP',
		'LPAREN',
		'RPAREN',
		'DQUOTE'
		);


	/*
	 * Constructor - initialize the scanner and parser.
	 */
	function
	parse_model($s_ilike_field = 'fulltext')
	{
		// Scanner States
		define('P_START', 	0);
		define('P_INWORD',	1);
		define('P_DONE',	2);

		// Bookkeeping Tokens
		define('P_BEGINFILE',	0);
		define('P_ENDFILE',		1);
		define('P_ERROR',		2);

		// Reserved Word Tokens

		// Multicharacter Tokens
		define('P_KEYWORD',		3);

		// Special Symbol Tokens
		define('P_ANDOP',	4);
		define('P_OROP',	5);
		define('P_NOTOP',	6);
		define('P_LPAREN',	7);
		define('P_RPAREN',	8);
		define('P_DQUOTE',	9);

		// End of File (input data)
		define('P_EOF',		-1);

		// Lexeme of each token.
		$this->s_token_string = '';

		// Current and Previous Token
		$this->i_token = 0;
		$this->i_prev_token = P_BEGINFILE;

		// Lookahead array for supporting default values
		// between tokens.  Mostly used for a default "AND"
		// between to keywords.
		$this->a_lookahead = array();
		$this->b_default_and = FALSE;

		// True if there was a syntax error.
		$this->b_syntax_error = FALSE;

		// Stop Words
		$this->stop_words();

		// Last two logical tokens.
		$this->a_expr = array('last' => '', 'not' => '');

		// Input text and current position in text.
		$this->s_keyword = '';
		$this->i_index = 0;
		$this->b_read_eof = FALSE;

		// Track parens for the ilike string.
		$this->s_ilike_paren = '';

		// Field for matching the ILIKE clause.
		$this->s_ilike_field = $s_ilike_field;

		// Output search strings.
		$this->a_keywords = array();
		$this->s_tsearch = '';
		$this->s_ilike = '';
		$this->s_error_msg = '';
		$this->s_error_tok = '';
		$this->i_error_pos = $this->i_index;

		$this->b_debug = FALSE;

		return;
	}
	// parse_model()


	/*
	 * Parse the keyword string and generate the output.
	 */
	function
	parse($s_original)
	{
		$this->s_keyword = strtolower($s_original);

		if ( $this->b_debug )
			print "\nIn:\t\t\t[$this->s_keyword]\n";

		// Remove everything not a-z 0-9 ( ) " + -
		// TSearch2 operators must NEVER be allowed to be passed: & | !
		$this->s_keyword = preg_replace('/[^a-zA-Z0-9()"+-]/', ' ', $this->s_keyword);

		if ( $this->b_debug )
			print "Strip1 (illegals):\t[$this->s_keyword]\n";

		// Remove single characters. (the surrounding SPACE is required here!)
		if ( preg_match('/ \w{1} /', " $this->s_keyword ") )
		{
			$this->s_error_msg = "Syntax Error: No single characters allowed in keyword search.";

			if ( $this->b_debug )
				print "\n$this->s_error_msg\n\n";
			else
				return FALSE;
		}

		$this->s_keyword = preg_replace('/ \w{1} /', '   ', " $this->s_keyword ");

		if ( $this->b_debug )
			print "Strip2 (singles):\t[$this->s_keyword]\n";


		if ( strlen($this->s_keyword) < 2 )
		{
			$this->s_error_msg = "Syntax Error: Keyword search is too small.";

			if ( $this->b_debug )
				print "$this->s_error_msg\n";

			return FALSE;
		}


		// Convert word operators to TSearch2 operators.
		$this->s_keyword = preg_replace('/\band\b/', '&  ', $this->s_keyword);
		$this->s_keyword = preg_replace('/\bor\b/',  '| ', $this->s_keyword);
		$this->s_keyword = preg_replace('/\bnot\b/', '!  ', $this->s_keyword);

		if ( $this->b_debug )
			print "Converted Operators:\t[$this->s_keyword]\n";

		$this->s_keyword = trim($this->s_keyword);


		if ( $this->b_debug )
		{
			print "\nTokens Found:\n";
			while ( ($this->i_token = $this->get_token()) != P_ENDFILE )
				print 'Type: ' . $this->a_tokens[$this->i_token] . "\t$this->s_token_string\n";
		}

		// Make sure scanner is reset.
		$this->i_index = 0;
		$this->b_read_eof = FALSE;

		// Initial attachement of ILIKE clause.
		$this->s_ilike = 'AND (';

		if ( $this->b_debug )
			print "\nParse Results:\n";


		// Prime the parser.
		$this->i_token = $this->get_token();

		// Possible starting tokens.
		switch ( $this->i_token )
		{
		case P_KEYWORD : $this->expr(); break;
		case P_LPAREN : $this->expr(); break;
		case P_DQUOTE : $this->expr(); break;
		case P_NOTOP : $this->expr(); break;
		}

		if ( $this->i_token != P_ENDFILE )
		{
			$this->syntax_error();
			return FALSE;
		}

		else if ( $this->b_syntax_error == TRUE )
			return FALSE;


		// Close the ILIKE clause if there was at least one phrase.
		if ( strpos($this->s_ilike, $this->s_ilike_field) == FALSE )
			$this->s_ilike = '';
		else
			$this->s_ilike .= ')';

		if ( $this->b_debug )
		{
			print "TSearch2:\t[$this->s_tsearch]\n";
			print "ILIKE:\t\t[$this->s_ilike]\n";

			print "Keywords:\t";
			foreach ( $this->a_keywords as $s_word )
				print "[$s_word] ";
			print "\n\n";
		}


		// Check for stop-word only searches.
		$b_keyword_only = TRUE;

		foreach ( $this->a_keywords as $s_wordpharse )
		{
			$a_words = explode(' ', $s_wordpharse);

			foreach ( $a_words as $s_word )
			{
				if ( !isset($this->a_stopwords[$s_word]) )
				{
					$b_keyword_only = FALSE;
					break 2;
				}
			}
		}

		if ( $b_keyword_only == TRUE )
		{
			if ( $this->b_debug )
				print "Syntax Error: Search string contains only stop words.\n\n";

			$this->s_error_msg = "Syntax Error: Keywords used in keyword search are too vague.";
			return FALSE;
		}


		return TRUE;
	}
	// parse()


	/*
	 * Display a syntax error.
	 */
	function
	syntax_error()
	{
		$this->b_syntax_error = TRUE;

		if ( $this->b_debug )
		{
			print "Syntax Error at Character " . ($this->i_index - strlen($this->s_token_string) + 1) .
				": Unexpected Token -> [$this->i_token] Token String: [$this->s_token_string]\n";
			print "$this->s_keyword\n" . str_repeat(' ', $this->i_index - strlen($this->s_token_string)) . "^\n";
		}

		// Only save the first error, since most other errors will be caused by this one.
		if ( $this->s_error_msg == '' )
		{
			if ( $this->i_token == P_ANDOP )
				$s_token_string = "and";
			else if ( $this->i_token == P_OROP )
				$s_token_string = "or";
			else if ( $this->i_token == P_NOTOP )
				$s_token_string = "not";
			else
				$s_token_string = $this->s_token_string;

			$this->s_error_msg = "Syntax Error in Keyword Phrase at Character " .
				($this->i_index - strlen($this->s_token_string) + 1) . ": Unexpected [$s_token_string]";

			$this->s_error_tok = $s_token_string;
			$this->i_error_pos = $this->i_index - strlen($this->s_token_string) + 1;
		}

		return;
	}
	// syntax_error()


	/*
	 * Match an expected token and read the next token.
	 */
	function
	match($i_expected)
	{
		$this->i_prev_token = $this->i_token;

		if ( $this->i_token == $i_expected )
		{
			// If there is a lookahead value, use that instead of
			// a new token from the scanner.
			if ( count($this->a_lookahead) > 0 )
				$this->i_token = array_shift($this->a_lookahead);
			else
				$this->i_token = $this->get_token();
		}
		else
			$this->syntax_error();

		return;
	}
	// match()


	/*
	 * Match a quoted keyword phrase.
	 */
	function
	quote_keywords()
	{
		$this->s_tsearch .= '(';

		// If this is the first ILIKE expression, don't include a connecting operator.
		// Adding open parens has been delayed till now so they can go after the
		// logical connnection operator (AND or OR).
		if ( strpos($this->s_ilike, $this->s_ilike_field) == FALSE )
			$this->s_ilike .= " {$this->s_ilike_paren} {$this->s_ilike_field} {$this->a_expr['not']} ILIKE '%";
		else
			$this->s_ilike .= " {$this->a_expr['last']} $this->s_ilike_paren {$this->s_ilike_field} {$this->a_expr['not']} ILIKE '%";

		$this->s_ilike_paren = '';

		$this->match(P_DQUOTE);

		$s_phrase = '';

		do
		{
			// If this phrase is has NOT applied to it, invert the tsearch component.
			if ( $this->a_expr['not'] == 'NOT' )
				$this->s_tsearch .= $this->s_token_string . '|';
			else
				$this->s_tsearch .= $this->s_token_string . '&';

			$this->s_ilike .= "$this->s_token_string ";
			$s_phrase .= $this->s_token_string . ' ';
			$this->match(P_KEYWORD);

		} while ( $this->i_token == P_KEYWORD );

		$this->s_tsearch = substr($this->s_tsearch, 0, -1) . ')';
		$this->s_ilike = rtrim($this->s_ilike) . "%' ";
		$this->a_keywords[] = trim($s_phrase);

		$this->match(P_DQUOTE);

		// Check for default values between phrases.
		if ( $this->b_default_and == TRUE && ($this->i_token == P_KEYWORD || $this->i_token == P_DQUOTE) )
		{
			// Save the keyword and inject a default "AND" token.
			$this->a_lookahead[] = $this->i_token;
			$this->i_token = P_ANDOP;
		}

		return;
	}
	// quote_keywords()


	/*
	 * Match an expression.
	 */
	function
	expr()
	{
		$this->simple_expr();

		// Prevent double NOT.
		while ( $this->i_token == P_NOTOP && ($this->i_prev_token == P_BEGINFILE ||
		$this->i_prev_token == P_ANDOP || $this->i_prev_token == P_OROP || $this->i_prev_token == P_LPAREN) )
		{
			$this->s_tsearch .= '!';
			$this->a_expr['not'] = 'NOT';

			$this->match(P_NOTOP);

			$this->simple_expr();
		}

		return;
	}
	// expr()


	/*
	 * Match a simple expression.
	 */
	function
	simple_expr()
	{
		$this->factor();

		while ( ($this->i_token == P_ANDOP) || ($this->i_token == P_OROP) )
		{
			$this->a_expr['not'] = '';

			switch ( $this->i_token )
			{
			case P_ANDOP :
				$this->s_tsearch .= '&';
				$this->a_expr['last'] = 'AND';
				break ;

			case P_OROP :
				$this->s_tsearch .= '|';
				$this->a_expr['last'] = 'OR';
				break ;

			}

			$this->match($this->i_token);

			$this->factor();
		}

		return;
	}
	// simple_expr()


	/*
	 * Match a factor.
	 */
	function
	factor()
	{
		switch ( $this->i_token )
		{
		case P_KEYWORD :

			$this->s_tsearch .= $this->s_token_string;
			$this->a_keywords[] = $this->s_token_string;
			$this->match(P_KEYWORD);

			// Check for default-and between keywords or between a
			// keyword and the start of an expression.
			if ( $this->b_default_and == TRUE &&
			($this->i_token == P_KEYWORD || $this->i_token == P_DQUOTE || $this->i_token == P_LPAREN) )
			{
				// Save the keyword and inject a default "AND" token.
				$this->a_lookahead[] = $this->i_token;
				$this->i_token = P_ANDOP;
			}

			break;

		case P_LPAREN :

			$this->s_tsearch .= '(';
			$this->s_ilike_paren .= '(';
			$this->match(P_LPAREN);

			$this->expr();

			$this->s_tsearch .= ')';

			// If there were no double-quoted values in the expression, prevent empty ()
			// in the ILIKE string.
			if ( $this->s_ilike_paren == '(' )
				$this->s_ilike_paren ='';
			else
				$this->s_ilike .= ')';

			$this->match(P_RPAREN);

			// Check for default-and between the close of an expression and a keyword.
			if ( $this->b_default_and == TRUE && ($this->i_token == P_KEYWORD || $this->i_token == P_DQUOTE) )
			{
				// Save the keyword and inject a default "AND" token.
				$this->a_lookahead[] = $this->i_token;
				$this->i_token = P_ANDOP;
			}

			break;

		case P_DQUOTE :

			$this->quote_keywords();
			break;

		case P_NOTOP :

			break;

		default :
			$this->syntax_error();
			$this->i_token = $this->get_token();
			break;
		}

		return;
	}
	// factor()


	/*
	 *
	 * SCANNER
	 *
	 */


	/*
	 * Gets the next token from the input data.
	 */
	function
	get_token()
	{
		$this->s_token_string = '';
		$i_state = P_START;

		while ( $i_state != P_DONE )
		{
			$i_char = $this->get_next_char();
			$b_save = TRUE;

			switch ( $i_state )
			{
			case P_START :

				if ( $this->is_keyword_char($i_char) )
					$i_state = P_INWORD;

				else if ( $i_char == 32 )
					$b_save = FALSE;

				else
				{
					$i_state = P_DONE;

					switch ( $i_char )
					{
					case P_EOF :
						$b_save = FALSE;
						$i_current_token = P_ENDFILE;
						break;

					case 38 :	// &
						$i_current_token = P_ANDOP;
						break;

					case 124 :	// |
						$i_current_token = P_OROP;
						break;

					case 33 :	// !
						$i_current_token = P_NOTOP;
						break;

					case 34 :	// "
						$i_current_token = P_DQUOTE;
						break;

					case 40 :	// (
						$i_current_token = P_LPAREN;
						break;

					case 41 :	// )
						$i_current_token = P_RPAREN;
						break;

					default :
						$i_current_token = P_ERROR;
						break;
					}
				}

				break;

			case P_INWORD :

				if ( !$this->is_keyword_char($i_char) )
				{
					// Backup in the input.
					$this->unget_next_char();
					$b_save = FALSE;
					$i_state = P_DONE;
					$i_current_token = P_KEYWORD;
				}

				break;

			case P_DONE :
			default :
				// Should never happen
				if ( $this->b_debug )
					print "Scanner Bug: state=[$i_state]\n";

				$i_state = P_DONE;
				$i_current_token = P_ERROR;
				break;
			}

			if ( $b_save == TRUE )
				$this->s_token_string .= chr($i_char);

		}

		return $i_current_token;
	}
	// get_token()


	/*
	 * Get the next character of the input data.
	 */
	function
	get_next_char()
	{
		if ( $this->i_index < strlen($this->s_keyword) )
			$i_char = ord($this->s_keyword[$this->i_index++]);
		else
		{
			// Indicate that the end of file marker was actaully read.
			$this->b_read_eof = TRUE;
			$i_char = P_EOF;
		}

		return $i_char;
	}
	// get_next_char()


	/*
	 * Backtrack one character of the input data.
	 */
	function
	unget_next_char()
	{
		// If we have not actually *read* the P_EOF, then backup.
		if ( $this->b_read_eof == FALSE )
			$this->i_index--;

		return;
	}
	// unget_next_char()


	/*
	 * Determines if a character is a valid keyword character.
	 */
	function
	is_keyword_char($i_char)
	{
		if (
			($i_char >= 97 && $i_char <= 122) ||	// a - z
			$i_char == 43 || $i_char == 45 ||		// + and -
			($i_char >= 48 && $i_char <= 57)		// 0 - 9
		)
			return TRUE;

		return FALSE;
	}
	// is_keyword_char()


	/*
	 * Build an array of stop words.
	 *
	 * Must be the same list as in /usr/local/pgsql/share/contrib/english.stop
	 */
	function
	stop_words()
	{
		$this->a_stopwords = array(
		'i'				=> 'i',
		'me'			=> 'me',
		'my'			=> 'my',
		'myself'		=> 'myself',
		'we'			=> 'we',
		'our'			=> 'our',
		'ours'			=> 'ours',
		'ourselves'		=> 'ourselves',
		'you'			=> 'you',
		'your'			=> 'your',
		'yours'			=> 'yours',
		'yourself'		=> 'yourself',
		'yourselves'	=> 'yourselves',
		'he'			=> 'he',
		'him'			=> 'him',
		'his'			=> 'his',
		'himself'		=> 'himself',
		'she'			=> 'she',
		'her'			=> 'her',
		'hers'			=> 'hers',
		'herself'		=> 'herself',
		'it'			=> 'it',
		'its'			=> 'its',
		'itself'		=> 'itself',
		'they'			=> 'they',
		'them'			=> 'them',
		'their'			=> 'their',
		'theirs'		=> 'theirs',
		'themselves'	=> 'themselves',
		'what'			=> 'what',
		'which'			=> 'which',
		'who'			=> 'who',
		'whom'			=> 'whom',
		'this'			=> 'this',
		'that'			=> 'that',
		'these'			=> 'these',
		'those'			=> 'those',
		'am'			=> 'am',
		'is'			=> 'is',
		'are'			=> 'are',
		'was'			=> 'was',
		'were'			=> 'were',
		'be'			=> 'be',
		'been'			=> 'been',
		'being'			=> 'being',
		'have'			=> 'have',
		'has'			=> 'has',
		'had'			=> 'had',
		'having'		=> 'having',
		'do'			=> 'do',
		'does'			=> 'does',
		'did'			=> 'did',
		'doing'			=> 'doing',
		'a'				=> 'a',
		'an'			=> 'an',
		'the'			=> 'the',
		'and'			=> 'and',
		'but'			=> 'but',
		'if'			=> 'if',
		'or'			=> 'or',
		'because'		=> 'because',
		'as'			=> 'as',
		'until'			=> 'until',
		'while'			=> 'while',
		'of'			=> 'of',
		'at'			=> 'at',
		'by'			=> 'by',
		'for'			=> 'for',
		'with'			=> 'with',
		'about'			=> 'about',
		'against'		=> 'against',
		'between'		=> 'between',
		'into'			=> 'into',
		'through'		=> 'through',
		'during'		=> 'during',
		'before'		=> 'before',
		'after'			=> 'after',
		'above'			=> 'above',
		'below'			=> 'below',
		'to'			=> 'to',
		'from'			=> 'from',
		'up'			=> 'up',
		'down'			=> 'down',
		'in'			=> 'in',
		'out'			=> 'out',
		'on'			=> 'on',
		'off'			=> 'off',
		'over'			=> 'over',
		'under'			=> 'under',
		'again'			=> 'again',
		'further'		=> 'further',
		'then'			=> 'then',
		'once'			=> 'once',
		'here'			=> 'here',
		'there'			=> 'there',
		'when'			=> 'when',
		'where'			=> 'where',
		'why'			=> 'why',
		'how'			=> 'how',
		'all'			=> 'all',
		'any'			=> 'any',
		'both'			=> 'both',
		'each'			=> 'each',
		'few'			=> 'few',
		'more'			=> 'more',
		'most'			=> 'most',
		'other'			=> 'other',
		'some'			=> 'some',
		'such'			=> 'such',
		'no'			=> 'no',
		'nor'			=> 'nor',
		'not'			=> 'not',
		'only'			=> 'only',
		'own'			=> 'own',
		'same'			=> 'same',
		'so'			=> 'so',
		'than'			=> 'than',
		'too'			=> 'too',
		'very'			=> 'very',
		's'				=> 's',
		't'				=> 't',
		'can'			=> 'can',
		'will'			=> 'will',
		'just'			=> 'just',
		'don'			=> 'don',
		'should'		=> 'should',
		'now'			=> 'now');

		return;
	}
	// stop_words()


}
// parse_model
?>