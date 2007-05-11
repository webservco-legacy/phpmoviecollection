<!-- DB MOVIES TT########## ########## ########## ########## ########## ########## ##########-->
<?php
switch($stats_page) {
    case "pmc_mov_tt": {
?>
<FORM NAME="ttss" ID="ttss" ACTION="" METHOD="post">
<?=$menu3_hdr?>
<?=$menu3_pre?>
<SELECT CLASS="items_box" NAME="tts" ID="tts" SIZE="1">
<OPTION VALUE="0"<?php if ($tts == '0') {echo ' SELECTED';} ?>>all</OPTION>
<OPTION VALUE="09"<?php if ($tts == '09') {echo ' SELECTED';} ?>>09</OPTION>
<OPTION VALUE="a"<?php if ($tts == 'a') {echo ' SELECTED';} ?>>A</OPTION>
<OPTION VALUE="b"<?php if ($tts == 'b') {echo ' SELECTED';} ?>>B</OPTION>
<OPTION VALUE="c"<?php if ($tts == 'c') {echo ' SELECTED';} ?>>C</OPTION>
<OPTION VALUE="d"<?php if ($tts == 'd') {echo ' SELECTED';} ?>>D</OPTION>
<OPTION VALUE="e"<?php if ($tts == 'e') {echo ' SELECTED';} ?>>E</OPTION>
<OPTION VALUE="f"<?php if ($tts == 'f') {echo ' SELECTED';} ?>>F</OPTION>
<OPTION VALUE="g"<?php if ($tts == 'g') {echo ' SELECTED';} ?>>G</OPTION>
<OPTION VALUE="h"<?php if ($tts == 'h') {echo ' SELECTED';} ?>>H</OPTION>
<OPTION VALUE="i"<?php if ($tts == 'i') {echo ' SELECTED';} ?>>I</OPTION>
<OPTION VALUE="j"<?php if ($tts == 'j') {echo ' SELECTED';} ?>>J</OPTION>
<OPTION VALUE="k"<?php if ($tts == 'k') {echo ' SELECTED';} ?>>K</OPTION>
<OPTION VALUE="l"<?php if ($tts == 'l') {echo ' SELECTED';} ?>>L</OPTION>
<OPTION VALUE="m"<?php if ($tts == 'm') {echo ' SELECTED';} ?>>M</OPTION>
<OPTION VALUE="n"<?php if ($tts == 'n') {echo ' SELECTED';} ?>>N</OPTION>
<OPTION VALUE="o"<?php if ($tts == 'o') {echo ' SELECTED';} ?>>O</OPTION>
<OPTION VALUE="p"<?php if ($tts == 'p') {echo ' SELECTED';} ?>>P</OPTION>
<OPTION VALUE="q"<?php if ($tts == 'q') {echo ' SELECTED';} ?>>Q</OPTION>
<OPTION VALUE="r"<?php if ($tts == 'r') {echo ' SELECTED';} ?>>R</OPTION>
<OPTION VALUE="s"<?php if ($tts == 's') {echo ' SELECTED';} ?>>S</OPTION>
<OPTION VALUE="t"<?php if ($tts == 't') {echo ' SELECTED';} ?>>T</OPTION>
<OPTION VALUE="u"<?php if ($tts == 'u') {echo ' SELECTED';} ?>>U</OPTION>
<OPTION VALUE="v"<?php if ($tts == 'v') {echo ' SELECTED';} ?>>V</OPTION>
<OPTION VALUE="w"<?php if ($tts == 'w') {echo ' SELECTED';} ?>>W</OPTION>
<OPTION VALUE="x"<?php if ($tts == 'x') {echo ' SELECTED';} ?>>X</OPTION>
<OPTION VALUE="y"<?php if ($tts == 'y') {echo ' SELECTED';} ?>>Y</OPTION>
<OPTION VALUE="z"<?php if ($tts == 'z') {echo ' SELECTED';} ?>>Z</OPTION>
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
Show&nbsp;
<SELECT CLASS="items_box" NAME="items" ID="items" SIZE="1">
    <OPTION VALUE="1"<?php if ($rowsPerPage == '1') {echo ' SELECTED';} ?>>1</OPTION>
    <OPTION VALUE="5"<?php if ($rowsPerPage == '5') {echo ' SELECTED';} ?>>5</OPTION>
    <OPTION VALUE="10"<?php if ($rowsPerPage == '10') {echo ' SELECTED';} ?>>10</OPTION>
    <OPTION VALUE="15"<?php if ($rowsPerPage == '15') {echo ' SELECTED';} ?>>15</OPTION>
    <OPTION VALUE="20"<?php if ($rowsPerPage == '20') {echo ' SELECTED';} ?>>20</OPTION>
    <OPTION VALUE="25"<?php if ($rowsPerPage == '25') {echo ' SELECTED';} ?>>25</OPTION>
	<OPTION VALUE="30"<?php if ($rowsPerPage == '30') {echo ' SELECTED';} ?>>30</OPTION>
	<OPTION VALUE="35"<?php if ($rowsPerPage == '35') {echo ' SELECTED';} ?>>35</OPTION>
	<OPTION VALUE="40"<?php if ($rowsPerPage == '40') {echo ' SELECTED';} ?>>40</OPTION>
	<OPTION VALUE="45"<?php if ($rowsPerPage == '45') {echo ' SELECTED';} ?>>45</OPTION>
	<OPTION VALUE="50"<?php if ($rowsPerPage == '50') {echo ' SELECTED';} ?>>50</OPTION>
	<OPTION VALUE="100"<?php if ($rowsPerPage == '100') {echo ' SELECTED';} ?>>100</OPTION>
	<OPTION VALUE="150"<?php if ($rowsPerPage == '150') {echo ' SELECTED';} ?>>150</OPTION>
	<OPTION VALUE="200"<?php if ($rowsPerPage == '200') {echo ' SELECTED';} ?>>200</OPTION>
	<OPTION VALUE="250"<?php if ($rowsPerPage == '250') {echo ' SELECTED';} ?>>250</OPTION>
</SELECT>
&nbsp;items per page
<?=$menu3_suf?>
<?=$menu3_pre?>
<INPUT TYPE="submit" CLASS="items_go" NAME="go" ID="go" VALUE="Go">
<?=$menu3_suf?>
<?=$menu3_ftr?>
</FORM>
<?php
        break;
    }
?>
<!-- DB MOVIES YEAR ########## ########## ########## ########## ########## ########## ##########-->
<?php
    case "pmc_mov_yr": {
?>
<?php
$query_rstMovYr = "SELECT DISTINCT(`movie_year`) FROM `pmc_mov_titles` ORDER BY `movie_year` ASC;";
$rstMovYr = mysql_query($query_rstMovYr) or die('Oups!<br>' . mysql_error());
$totalRows_rstMovYr = mysql_num_rows($rstMovYr);
?>
<FORM NAME="years" ID="years" ACTION="" METHOD="post">
<?=$menu3_hdr?>
<?=$menu3_pre?>
<SELECT CLASS="items_box" NAME="tty" ID="tty" SIZE="1">
    <OPTION VALUE="0"<?php if ($tty == '0') {echo ' SELECTED';} ?>>all</OPTION>
<?php
for ($i=1; $i<=mysql_num_rows($rstMovYr); $i++) {
    $row_rstMovYr = mysql_fetch_assoc($rstMovYr);
?>
    <OPTION VALUE="<?=$row_rstMovYr['movie_year']?>"<?php if ($tty == $row_rstMovYr['movie_year']) {echo ' SELECTED';} ?>><?=$row_rstMovYr['movie_year']?></OPTION>
<?php
}
mysql_free_result($rstMovYr);
?>    
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
Show&nbsp;
<SELECT CLASS="items_box" NAME="items" ID="items" SIZE="1">
    <OPTION VALUE="1"<?php if ($rowsPerPage == '1') {echo ' SELECTED';} ?>>1</OPTION>
    <OPTION VALUE="5"<?php if ($rowsPerPage == '5') {echo ' SELECTED';} ?>>5</OPTION>
    <OPTION VALUE="10"<?php if ($rowsPerPage == '10') {echo ' SELECTED';} ?>>10</OPTION>
    <OPTION VALUE="15"<?php if ($rowsPerPage == '15') {echo ' SELECTED';} ?>>15</OPTION>
    <OPTION VALUE="20"<?php if ($rowsPerPage == '20') {echo ' SELECTED';} ?>>20</OPTION>
    <OPTION VALUE="25"<?php if ($rowsPerPage == '25') {echo ' SELECTED';} ?>>25</OPTION>
	<OPTION VALUE="30"<?php if ($rowsPerPage == '30') {echo ' SELECTED';} ?>>30</OPTION>
	<OPTION VALUE="35"<?php if ($rowsPerPage == '35') {echo ' SELECTED';} ?>>35</OPTION>
	<OPTION VALUE="40"<?php if ($rowsPerPage == '40') {echo ' SELECTED';} ?>>40</OPTION>
	<OPTION VALUE="45"<?php if ($rowsPerPage == '45') {echo ' SELECTED';} ?>>45</OPTION>
	<OPTION VALUE="50"<?php if ($rowsPerPage == '50') {echo ' SELECTED';} ?>>50</OPTION>
	<OPTION VALUE="100"<?php if ($rowsPerPage == '100') {echo ' SELECTED';} ?>>100</OPTION>
	<OPTION VALUE="150"<?php if ($rowsPerPage == '150') {echo ' SELECTED';} ?>>150</OPTION>
	<OPTION VALUE="200"<?php if ($rowsPerPage == '200') {echo ' SELECTED';} ?>>200</OPTION>
	<OPTION VALUE="250"<?php if ($rowsPerPage == '250') {echo ' SELECTED';} ?>>250</OPTION>
</SELECT>
&nbsp;items per page
<?=$menu3_suf?>
<?=$menu3_pre?>
<INPUT TYPE="submit" CLASS="items_go" NAME="go" ID="go" VALUE="Go">
<?=$menu3_suf?>
<?=$menu3_ftr?>
</FORM>
<?php
        break;
    }
?>
<!-- DB MOVIES CT########## ########## ########## ########## ########## ########## ##########-->
<?php
    case "pmc_mov_ct": {
?>
<?php
$query_rstMovCt = "SELECT * FROM `pmc_mov_categ` ORDER BY `categ_id` ASC;";
$rstMovCt = mysql_query($query_rstMovCt) or die('Oups!<br>' . mysql_error());
$totalRows_rstMovCt = mysql_num_rows($rstMovCt);
?>
<FORM NAME="ttcs" ID="ttcs" ACTION="" METHOD="post">
<?=$menu3_hdr?>
<?=$menu3_pre?>
<SELECT CLASS="items_box" NAME="ttc" ID="ttc" SIZE="1">
    <OPTION VALUE="all"<?php if ($ttc == 'all') {echo ' SELECTED';} ?>>all</OPTION>
    <OPTION VALUE="0"<?php if ($ttc == '0') {echo ' SELECTED';} ?>>none</OPTION>
<?php
for ($i=1; $i<=mysql_num_rows($rstMovCt); $i++) {
    $row_rstMovCt = mysql_fetch_assoc($rstMovCt);
?>
    <OPTION VALUE="<?=$row_rstMovCt['categ_id']?>"<?php if ($ttc == $row_rstMovCt['categ_id']) {echo ' SELECTED';} ?>><?=$row_rstMovCt['categ_title']?></OPTION>
<?php
}
mysql_free_result($rstMovCt);
?>    
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
Show&nbsp;
<SELECT CLASS="items_box" NAME="items" ID="items" SIZE="1">
    <OPTION VALUE="1"<?php if ($rowsPerPage == '1') {echo ' SELECTED';} ?>>1</OPTION>
    <OPTION VALUE="5"<?php if ($rowsPerPage == '5') {echo ' SELECTED';} ?>>5</OPTION>
    <OPTION VALUE="10"<?php if ($rowsPerPage == '10') {echo ' SELECTED';} ?>>10</OPTION>
    <OPTION VALUE="15"<?php if ($rowsPerPage == '15') {echo ' SELECTED';} ?>>15</OPTION>
    <OPTION VALUE="20"<?php if ($rowsPerPage == '20') {echo ' SELECTED';} ?>>20</OPTION>
    <OPTION VALUE="25"<?php if ($rowsPerPage == '25') {echo ' SELECTED';} ?>>25</OPTION>
	<OPTION VALUE="30"<?php if ($rowsPerPage == '30') {echo ' SELECTED';} ?>>30</OPTION>
	<OPTION VALUE="35"<?php if ($rowsPerPage == '35') {echo ' SELECTED';} ?>>35</OPTION>
	<OPTION VALUE="40"<?php if ($rowsPerPage == '40') {echo ' SELECTED';} ?>>40</OPTION>
	<OPTION VALUE="45"<?php if ($rowsPerPage == '45') {echo ' SELECTED';} ?>>45</OPTION>
	<OPTION VALUE="50"<?php if ($rowsPerPage == '50') {echo ' SELECTED';} ?>>50</OPTION>
	<OPTION VALUE="100"<?php if ($rowsPerPage == '100') {echo ' SELECTED';} ?>>100</OPTION>
	<OPTION VALUE="150"<?php if ($rowsPerPage == '150') {echo ' SELECTED';} ?>>150</OPTION>
	<OPTION VALUE="200"<?php if ($rowsPerPage == '200') {echo ' SELECTED';} ?>>200</OPTION>
	<OPTION VALUE="250"<?php if ($rowsPerPage == '250') {echo ' SELECTED';} ?>>250</OPTION>
</SELECT>
&nbsp;items per page
<?=$menu3_suf?>
<?=$menu3_pre?>
<INPUT TYPE="submit" CLASS="items_go" NAME="go" ID="go" VALUE="Go">
<?=$menu3_suf?>
<?=$menu3_ftr?>
</FORM>
<?php
        break;
    }
?>
<!-- DB MOVIES SR########## ########## ########## ########## ########## ########## ##########-->
<?php
    case "pmc_mov_sra": {
?>
<?php
$query_rstMovCt = "SELECT * FROM `pmc_mov_categ` ORDER BY `categ_id` ASC;";
$rstMovCt = mysql_query($query_rstMovCt) or die('Oups!<br>' . mysql_error());
$totalRows_rstMovCt = mysql_num_rows($rstMovCt);

$query_rstMovHcat = "SELECT * FROM `pmc_mov_horror_categ` ORDER BY `horror_categ_id` ASC;";
$rstMovHcat = mysql_query($query_rstMovHcat) or die('Oups!<br>' . mysql_error());
$totalRows_rstMovHcat = mysql_num_rows($rstMovHcat);

$query_rstMovHScat = "SELECT * FROM `pmc_mov_horror_subcateg` ORDER BY `horror_subcateg_id` ASC;";
$rstMovHScat = mysql_query($query_rstMovHScat) or die('Oups!<br>' . mysql_error());
$totalRows_rstMovHScat = mysql_num_rows($rstMovHScat);

$query_rstMovGnr = "SELECT * FROM `pmc_mov_genres` ORDER BY `movie_genre_id` ASC;";
$rstMovGnr = mysql_query($query_rstMovGnr) or die('Oups!<br>' . mysql_error());
$totalRows_rstMovGnr = mysql_num_rows($rstMovGnr);

$query_rstMovCountry = "SELECT DISTINCT(`country_iso`) FROM `pmc_mov_tt_countries` ORDER BY `country_iso` ASC;";
$rstMovCountry = mysql_query($query_rstMovCountry) or die('Oups!<br>' . mysql_error());
$totalRows_rstMovCountry = mysql_num_rows($rstMovCountry);

$query_rstMovLang = "SELECT DISTINCT(`lang_index`) FROM `pmc_mov_tt_langs` ORDER BY `lang_index` ASC;";
$rstMovLang = mysql_query($query_rstMovLang) or die('Oups!<br>' . mysql_error());
$totalRows_rstMovLang = mysql_num_rows($rstMovLang);

$query_rstMovYr = "SELECT DISTINCT(`movie_year`) FROM `pmc_mov_titles` ORDER BY `movie_year` ASC;";
$rstMovYr = mysql_query($query_rstMovYr) or die('Oups!<br>' . mysql_error());
$totalRows_rstMovYr = mysql_num_rows($rstMovYr);

?>
<script type="text/JavaScript">
var s_hcateg=new Array();
var s_hcateg_values=new Array();
var s_hcateg_select = 0;

var s_hsubcateg=new Array();
var s_hsubcateg_values=new Array();
var s_hsubcateg_select = 0;

function redirect(){
	var id_cat= document.movsearch.s_categ.value;
	for (m=temp.options.length-1;m>0;m--)
		temp.options[m]=null
	for (n=temp2.options.length-1;n>0;n--)
		temp2.options[n]=null
    var j=0;
    var k=0;
	if (id_cat!=0){
		var list = s_hcateg[id_cat];
        var list2 = s_hsubcateg[id_cat];
		var sel_index=0;
        var sel_index2=0;
		for (i=0;i<list.length;i++){	
			if (s_hcateg_values[id_cat][i]==s_hcateg_select)
				sel_index=j;
			temp.options[j]=new Option(s_hcateg[id_cat][i],s_hcateg_values[id_cat][i]);
			j++;
		}
        for (q=0;q<list2.length;q++){	
			if (s_hsubcateg_values[id_cat][q]==s_hsubcateg_select)
				sel_index2=k;
			temp2.options[k]=new Option(s_hsubcateg[id_cat][q],s_hsubcateg_values[id_cat][q]);
			k++;
		}
		temp.options[sel_index].selected=true;
        temp2.options[sel_index2].selected=true;
	}
}
</script>
<FORM NAME="movsearch" ID="movsearch" ACTION="<?=$stats_page?>.php" METHOD="post">
<?=$menu3_hdr?>
<INPUT TYPE="hidden" NAME="s_page" ID="s_page" VALUE="1">
<?=$menu3_pre?>
category:&nbsp;
<SELECT CLASS="form_search_select" NAME="s_categ" ID="s_categ" SIZE="1" onChange="redirect()">
    <OPTION VALUE="0"<?php if ($s_categ == '0') {echo ' SELECTED';} ?>>all</OPTION>
<?php
for ($i=1; $i<=mysql_num_rows($rstMovCt); $i++) {
    $row_rstMovCt = mysql_fetch_assoc($rstMovCt);
?>
    <OPTION VALUE="<?=$row_rstMovCt['categ_id']?>"<?php if ($s_categ == $row_rstMovCt['categ_id']) {echo ' SELECTED';} ?>><?=$row_rstMovCt['categ_title']?></OPTION>
<?php
}
mysql_free_result($rstMovCt);
?>    
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
horror category:&nbsp;
<SELECT CLASS="form_search_select" NAME="s_hcateg" ID="s_hcateg" SIZE="1">
    <OPTION VALUE="0"<?php if ($s_hcateg == '0') {echo ' SELECTED';} ?>>all/none</OPTION>
<script>
s_hcateg[1]=new Array();
s_hcateg_values[1]=new Array();
s_hcateg[1][0]='all/none';
s_hcateg_values[1][0]='0';
<?php
for ($i=1; $i<=mysql_num_rows($rstMovHcat); $i++) {
    $row_rstMovHcat = mysql_fetch_assoc($rstMovHcat);
?>
s_hcateg[1][<?=$i?>]='<?=$row_rstMovHcat['horror_categ_title']?>';
s_hcateg_values[1][<?=$i?>]='<?=$row_rstMovHcat['horror_categ_id']?>';
<?php } mysql_free_result($rstMovHcat); ?>
var temp=document.movsearch.s_hcateg;
	s_hcateg_select=0;
	redirect();
</script>
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
horror subcategory:&nbsp;
<SELECT CLASS="form_search_select" NAME="s_hsubcateg" ID="s_hsubcateg" SIZE="1">
    <OPTION VALUE="0"<?php if ($s_hsubcateg == '0') {echo ' SELECTED';} ?>>all/none</OPTION>
<script>
s_hsubcateg[1]=new Array();
s_hsubcateg_values[1]=new Array();
s_hsubcateg[1][0]='all/none';
s_hsubcateg_values[1][0]='0';
<?php
for ($j=1; $j<=mysql_num_rows($rstMovHScat); $j++) {
    $row_rstMovHScat = mysql_fetch_assoc($rstMovHScat);
?>
s_hsubcateg[1][<?=$j?>]='<?=$row_rstMovHScat['horror_subcateg_title']?>';
s_hsubcateg_values[1][<?=$j?>]='<?=$row_rstMovHScat['horror_subcateg_id']?>';
<?php } mysql_free_result($rstMovHScat); ?>
var temp2=document.movsearch.s_hsubcateg;
	s_hsubcateg_select=0;
	redirect();
</script>
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
genre:&nbsp;
<SELECT CLASS="form_search_select" NAME="s_genre" ID="s_genre" SIZE="1">
    <OPTION VALUE="0"<?php if ($s_genre == '0') {echo ' SELECTED';} ?>>all</OPTION>
<?php
for ($i=1; $i<=mysql_num_rows($rstMovGnr); $i++) {
    $row_rstMovGnr = mysql_fetch_assoc($rstMovGnr);
?>
    <OPTION VALUE="<?=$row_rstMovGnr['movie_genre_id']?>"<?php if ($s_genre == $row_rstMovGnr['movie_genre_id']) {echo ' SELECTED';} ?>><?=$row_rstMovGnr['genre_title']?></OPTION>
<?php
}
mysql_free_result($rstMovGnr);
?>
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
country:&nbsp;
<SELECT CLASS="form_search_select" NAME="s_country" ID="s_country" SIZE="1">
    <OPTION VALUE="0"<?php if ($s_country == '0') {echo ' SELECTED';} ?>>all</OPTION>
<?php
for ($i=1; $i<=mysql_num_rows($rstMovCountry); $i++) {
    $row_rstMovCountry = mysql_fetch_assoc($rstMovCountry);
    $query_rstCountry = "SELECT `country_printable_name` FROM `pmc_set_countries` WHERE `country_iso` = '".$row_rstMovCountry['country_iso']."' LIMIT 1";
    $rstCountry = mysql_query($query_rstCountry) or die('Oups!<br>' . mysql_error());
    $row_rstCountry = mysql_fetch_assoc($rstCountry);
?>
    <OPTION VALUE="<?=$row_rstMovCountry['country_iso']?>"<?php if ($s_country == $row_rstMovCountry['country_iso']) {echo ' SELECTED';} ?>><?=$row_rstCountry['country_printable_name']?></OPTION>
<?php
    mysql_free_result($rstCountry);
}
mysql_free_result($rstMovCountry);
?>
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
language:&nbsp;
<SELECT CLASS="form_search_select" NAME="s_lang" ID="s_lang" SIZE="1">
    <OPTION VALUE="0"<?php if ($s_lang == '0') {echo ' SELECTED';} ?>>all</OPTION>
<?php
for ($i=1; $i<=mysql_num_rows($rstMovLang); $i++) {
    $row_rstMovLang = mysql_fetch_assoc($rstMovLang);
    $query_rstLang = "SELECT `lang_name` FROM `pmc_set_lang` WHERE `lang_index` = '".$row_rstMovLang['lang_index']."' LIMIT 1";
    $rstLang = mysql_query($query_rstLang) or die('Oups!<br>' . mysql_error());
    $row_rstLang = mysql_fetch_assoc($rstLang);
?>
    <OPTION VALUE="<?=$row_rstMovLang['lang_index']?>"<?php if ($s_lang == $row_rstMovLang['lang_index']) {echo ' SELECTED';} ?>><?=$row_rstLang['lang_name']?></OPTION>
<?php
    mysql_free_result($rstLang);
}
mysql_free_result($rstMovLang);
?>
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
year:&nbsp;
<SELECT CLASS="form_search_select" NAME="s_year" ID="s_year" SIZE="1">
    <OPTION VALUE="0"<?php if ($s_year == '0') {echo ' SELECTED';} ?>>all</OPTION>
<?php
for ($i=1; $i<=mysql_num_rows($rstMovYr); $i++) {
    $row_rstMovYr = mysql_fetch_assoc($rstMovYr);
?>
    <OPTION VALUE="<?=$row_rstMovYr['movie_year']?>"<?php if ($s_year == $row_rstMovYr['movie_year']) {echo ' SELECTED';} ?>><?=$row_rstMovYr['movie_year']?></OPTION>
<?php
}
mysql_free_result($rstMovYr);
?>    
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
type:&nbsp;
<SELECT CLASS="form_search_select" NAME="s_type" ID="s_type" SIZE="1">
    <OPTION VALUE="0"<?php if ($s_type == '0') {echo ' SELECTED';} ?>>all</OPTION>
    <OPTION VALUE="1"<?php if ($s_type == '1') {echo ' SELECTED';} ?>>feature</OPTION>
    <OPTION VALUE="2"<?php if ($s_type == '2') {echo ' SELECTED';} ?>>short</OPTION>
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
release:&nbsp;
<SELECT CLASS="form_search_select" NAME="s_release" ID="s_release" SIZE="1">
    <OPTION VALUE="0"<?php if ($s_release == '0') {echo ' SELECTED';} ?>>all</OPTION>
    <OPTION VALUE="1"<?php if ($s_release == '1') {echo ' SELECTED';} ?>>theatre</OPTION>
    <OPTION VALUE="2"<?php if ($s_release == '2') {echo ' SELECTED';} ?>>video</OPTION>
    <OPTION VALUE="3"<?php if ($s_release == '3') {echo ' SELECTED';} ?>>television</OPTION>
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
color:&nbsp;
<SELECT CLASS="form_search_select" NAME="s_color" ID="s_color" SIZE="1">
    <OPTION VALUE="0"<?php if ($s_color == '0') {echo ' SELECTED';} ?>>all</OPTION>
    <OPTION VALUE="1"<?php if ($s_color == '1') {echo ' SELECTED';} ?>>color</OPTION>
    <OPTION VALUE="2"<?php if ($s_color == '2') {echo ' SELECTED';} ?>>black & white</OPTION>
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
imdb rating &#62;=:&nbsp;
<SELECT CLASS="form_search_select" NAME="s_rating" ID="s_rating" SIZE="1">
    <OPTION VALUE="0"<?php if ($s_rating == '0') {echo ' SELECTED';} ?>>all</OPTION>
    <OPTION VALUE="1"<?php if ($s_rating == '1') {echo ' SELECTED';} ?>>1</OPTION>
    <OPTION VALUE="2"<?php if ($s_rating == '2') {echo ' SELECTED';} ?>>2</OPTION>
    <OPTION VALUE="3"<?php if ($s_rating == '3') {echo ' SELECTED';} ?>>3</OPTION>
    <OPTION VALUE="4"<?php if ($s_rating == '4') {echo ' SELECTED';} ?>>4</OPTION>
    <OPTION VALUE="5"<?php if ($s_rating == '5') {echo ' SELECTED';} ?>>5</OPTION>
    <OPTION VALUE="6"<?php if ($s_rating == '6') {echo ' SELECTED';} ?>>6</OPTION>
    <OPTION VALUE="7"<?php if ($s_rating == '7') {echo ' SELECTED';} ?>>7</OPTION>
    <OPTION VALUE="8"<?php if ($s_rating == '8') {echo ' SELECTED';} ?>>8</OPTION>
    <OPTION VALUE="9"<?php if ($s_rating == '9') {echo ' SELECTED';} ?>>9</OPTION>
    <OPTION VALUE="10"<?php if ($s_rating == '10') {echo ' SELECTED';} ?>>10</OPTION>
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
keywords:&nbsp;
<INPUT CLASS="search_form_text" TYPE="text" NAME="s_string" ID="s_string" SIZE="20" MAXLENGTH="30" VALUE="<?=stripslashes($s_string)?>" />
<?=$menu3_suf?>
<?=$menu3_pre?>
items per page:&nbsp;
<SELECT CLASS="search_form_select" NAME="items" ID="items" SIZE="1">
    <OPTION VALUE="1"<?php if ($rowsPerPage == '1') {echo ' SELECTED';} ?>>1</OPTION>
    <OPTION VALUE="5"<?php if ($rowsPerPage == '5') {echo ' SELECTED';} ?>>5</OPTION>
    <OPTION VALUE="10"<?php if ($rowsPerPage == '10') {echo ' SELECTED';} ?>>10</OPTION>
    <OPTION VALUE="15"<?php if ($rowsPerPage == '15') {echo ' SELECTED';} ?>>15</OPTION>
    <OPTION VALUE="20"<?php if ($rowsPerPage == '20') {echo ' SELECTED';} ?>>20</OPTION>
    <OPTION VALUE="25"<?php if ($rowsPerPage == '25') {echo ' SELECTED';} ?>>25</OPTION>
	<OPTION VALUE="30"<?php if ($rowsPerPage == '30') {echo ' SELECTED';} ?>>30</OPTION>
	<OPTION VALUE="35"<?php if ($rowsPerPage == '35') {echo ' SELECTED';} ?>>35</OPTION>
	<OPTION VALUE="40"<?php if ($rowsPerPage == '40') {echo ' SELECTED';} ?>>40</OPTION>
	<OPTION VALUE="45"<?php if ($rowsPerPage == '45') {echo ' SELECTED';} ?>>45</OPTION>
	<OPTION VALUE="50"<?php if ($rowsPerPage == '50') {echo ' SELECTED';} ?>>50</OPTION>
	<OPTION VALUE="100"<?php if ($rowsPerPage == '100') {echo ' SELECTED';} ?>>100</OPTION>
	<OPTION VALUE="150"<?php if ($rowsPerPage == '150') {echo ' SELECTED';} ?>>150</OPTION>
	<OPTION VALUE="200"<?php if ($rowsPerPage == '200') {echo ' SELECTED';} ?>>200</OPTION>
	<OPTION VALUE="250"<?php if ($rowsPerPage == '250') {echo ' SELECTED';} ?>>250</OPTION>
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
<INPUT CLASS="search_form_go" TYPE="submit" NAME="Search" ID="Search" VALUE="Search">
<?=$menu3_suf?>
<?=$menu3_ftr?>
</FORM>
<?php
        break;
    }
?>
<!-- DB MOVIES SR########## ########## ########## ########## ########## ########## ##########-->
<?php
    case "pmc_mov_sr": {
?>
<FORM NAME="movsearch" ID="movsearch" ACTION="<?=$stats_page?>.php" METHOD="post">
<?=$menu3_hdr?>
<INPUT TYPE="hidden" NAME="s_page" ID="s_page" VALUE="1">
<?=$menu3_pre?>
<?=$menu3_pre?>
keywords:&nbsp;
<INPUT CLASS="search_form_text" TYPE="text" NAME="s_string" ID="s_string" SIZE="20" MAXLENGTH="30" VALUE="<?=stripslashes($s_string)?>" />
<?=$menu3_suf?>
<?=$menu3_pre?>
items per page:&nbsp;
<SELECT CLASS="search_form_select" NAME="items" ID="items" SIZE="1">
    <OPTION VALUE="1"<?php if ($rowsPerPage == '1') {echo ' SELECTED';} ?>>1</OPTION>
    <OPTION VALUE="5"<?php if ($rowsPerPage == '5') {echo ' SELECTED';} ?>>5</OPTION>
    <OPTION VALUE="10"<?php if ($rowsPerPage == '10') {echo ' SELECTED';} ?>>10</OPTION>
    <OPTION VALUE="15"<?php if ($rowsPerPage == '15') {echo ' SELECTED';} ?>>15</OPTION>
    <OPTION VALUE="20"<?php if ($rowsPerPage == '20') {echo ' SELECTED';} ?>>20</OPTION>
    <OPTION VALUE="25"<?php if ($rowsPerPage == '25') {echo ' SELECTED';} ?>>25</OPTION>
	<OPTION VALUE="30"<?php if ($rowsPerPage == '30') {echo ' SELECTED';} ?>>30</OPTION>
	<OPTION VALUE="35"<?php if ($rowsPerPage == '35') {echo ' SELECTED';} ?>>35</OPTION>
	<OPTION VALUE="40"<?php if ($rowsPerPage == '40') {echo ' SELECTED';} ?>>40</OPTION>
	<OPTION VALUE="45"<?php if ($rowsPerPage == '45') {echo ' SELECTED';} ?>>45</OPTION>
	<OPTION VALUE="50"<?php if ($rowsPerPage == '50') {echo ' SELECTED';} ?>>50</OPTION>
	<OPTION VALUE="100"<?php if ($rowsPerPage == '100') {echo ' SELECTED';} ?>>100</OPTION>
	<OPTION VALUE="150"<?php if ($rowsPerPage == '150') {echo ' SELECTED';} ?>>150</OPTION>
	<OPTION VALUE="200"<?php if ($rowsPerPage == '200') {echo ' SELECTED';} ?>>200</OPTION>
	<OPTION VALUE="250"<?php if ($rowsPerPage == '250') {echo ' SELECTED';} ?>>250</OPTION>
</SELECT>
<?=$menu3_suf?>
<?=$menu3_pre?>
<INPUT CLASS="search_form_go" TYPE="submit" NAME="Search" ID="Search" VALUE="Search">
<?=$menu3_suf?>
<?=$menu3_ftr?>
</FORM>
<?php
        break;
    }
?>
<!-- END: -->
<?php
    default: {
        break;
    }
}
?>