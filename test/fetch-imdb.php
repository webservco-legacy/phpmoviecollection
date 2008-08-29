<?php
/** fetch-script: imdb.com
*
* $Id: fetch-imdb.php,v 1.17 2006/01/31 18:03:12 michasch Exp $
*
* create your own fetch-scripts for other webpages like this one
* but please don't make any changes at this file, always make first
* a copy of it.
*
* please send us your fetch-scripts, so we can add them to the
* powermovielist! you can also export them with the export-settings-feature
*
* @package fetch
*
* Corrected on 03 March 2007 by users reaper, harryjon35, raven and Ales.
* Corrected on 05 April 2007 by reaper, to correct Director change on IMDB.com.
*/

//LAST MODIFIED by Nardak 5th July 2007 e-mail pml-at-nardak-dot-net 
//Last Modified by Steven 25 July 2007 e-mail reaper-at-sgrim-dot-us

//first check if the class exists already, if so return and don't include it again
if(class_exists("pmlfetch_imdb")) return;

//IMPORTANT: the class-name (pmlfetch_*) has to be the same as the file-name (fetch-*.php)
class pmlfetch_imdb extends pml_fetch {

    /**
     * FieldNames
     * IMPORTANT: Add new fields here and in function DoFetch
     *
     * @access private
     **/
    var $FieldNames = array("Title",
                            "Year",
                            "Poster",
                            "Director",
                            "Genre",
                            "Rating",
                            "Starring",
                            "Plot",
                            "Release",
                            "Runtime",
                            "MPAA",
                            "Akas",
                            "Country",
                            "imdbid");
    /**
     * actorLimit
     * @access private
     * @var int
     **/
    var $actorLimit;
    /**
     * actorLimit
     * @access private
     * @var int
     **/
    var $akaCountry;

    /**
     * doSearch - perform the search on the page to fetch from
     *
     * @param &$out return-string: the HTML-code displayed when searching
     * @param $SearchString string: the string sent to the page to search for
     * @param $EntryUrl string: url used for links in HTML-code
     * @access public
     * @return const PML_FETCH_SEARCHERROR, PML_FETCH_SEARCHDONE or PML_FETCH_EXACTMATCH
     **/
    function doSearch(&$out, $SearchString, $EntryUrl) {

        $out .= $GLOBALS['strSearchingInfoFor'] ." <b>". $SearchString . "</b> ... ";
        //$Name = rawurlencode($SearchString);
        //$Name = str_replace("%20", "+", $SearchString);

        //Modified July 5th 2007 to comply with imdb url changes
        $data = "GET /find?s=all&q=". rawurlencode($SearchString) .";tt=on;mx=20 HTTP/1.0\r\n";

        $data .= "Accept: text/html, image/png, image/x-xbitmap, image/gif, image/jpeg, */*\r\n";
        $data .= "Referer: http://akas.imdb.com/Find\r\n";
        $data .= "Content-type: application/x-www-form-urlencoded\r\n";
        $data .= "Accept-Encoding: *;q=0\r\n";
        $data .= "User-Agent: Mozilla/4.0 (compatible; MSIE 5.5; Windows 98; Win 9x 4.90)\r\n";
        $data .= "Host: akas.imdb.com\r\n";
        $data .= "Connection: Keep-Alive\r\n";
        $data .= "Cache-Control: no-cache\r\n";
        $data .= "\r\n";

    $site = $this->FetchPage($data, "akas.imdb.com:80");

    $sections = preg_split("/Names \(Exact Matches\)/i", $site);
    // $sections[0]: part with movie matches
    // [1]: part with actor matches
    $site = $sections[0];

        //when you use the search-form on imdb.com and you search for a title that was exactly found
        //imdb uses a 302-found-page to redirect to the Title-page of this movie.
        //if this happens, we can use this imdb-id too
        if(strstr($site, "HTTP/1.0 302") || strstr($site, "HTTP/1.1 302")) { //exact match?
            $out .= $GLOBALS['strExactMatch'];
            ereg('\/title\/tt([0-9]+)\/', $site, $x);
            $this->FetchID = $x[1];          //save the id in $FetchID
            return(PML_FETCH_EXACTMATCH); //return to editentry that it can fetch now the data - search is allready done
        }


    //Modified July 5th 2007 to comply with imdb format changes
    $tlBlocks = preg_match_all('/(<b>P?o?p?u?l?a?r? ?Titles.*?<\/b>).*?<\/p>/msi', $site, $categoryBlocks);
    if ($tlBlocks > 0) {
        //$categoryBlocks contain movies from "Popular Titles" and/or "Exact Matches" and/or "Partial Matches"
        $currentBlock = 0;
            $SearchData = array();
            // remove text "Titles" and () from the category-names
        $categoryBlocks[1] = preg_replace('/(Titles \()|\)|;/i','',$categoryBlocks[1]);
            //Modified July 5th 2007 to comply with imdb format changes
               foreach($categoryBlocks[0] as $block){
            preg_match_all('/<td.*?><a href=\"\/title\/tt([0-9]+)\/.*?\">(.*?)<\/a>(.*?)<\/td>/i', $block, $imdbMovies);
                foreach($imdbMovies[1] as $key => $value){
                    $SearchData[] = array("id"   => $value,
                                             "name" => $imdbMovies[2][$key],
                                             "help" => str_replace("&#160;aka","<br>&nbsp;&nbsp;&nbsp;&nbsp;",strip_tags($imdbMovies[3][$key])),
                                             "cat"  => '- ' . $categoryBlocks[1][$currentBlock]);
                }
            $currentBlock++;
               }

    }
    else {
            $out .= $GLOBALS['strErrNothingFoundEnterNewString'];
            return(PML_FETCH_SEARCHDONE);
    }

        $out .= $GLOBALS['strFoundMore'];
        //print out all the movies found:
        $out .= "<table>";

        $Page = basename(__FILE__);
        $Page = substr($Page, 6);
        $Page = substr($Page, 0, -4);

        $LastCat = "";
        foreach($SearchData as $Dat) {
            if($Dat['cat']!=$LastCat) {
                $out .= "<tr class='top'><td colspan=2 align='left'>$Dat[cat]</td></tr>\n";
                $j=1;
            }
            $LastCat = $Dat['cat'];
            $out .= "<tr class='row";
            if($j++%2) $out .= "1"; else $out .= "2";
            $out .= "'><td width='20'>&nbsp;</td><td>";
            $out .= "<a href=\"$EntryUrl&" . urlencode("fid[{$Page}]")."=".urlencode($Dat['id'])."\">$Dat[name]</a>";
            $out .= " - [<a href=\"http://akas.imdb.com/Title?$Dat[id]\" target=_blank>$GLOBALS[strInfo]</a>]\n";
            if(strlen($Dat['help'])>2) $out .= "<i>". $Dat['help'] ."</i>";
            $out .= "</td></tr>\n";
        }
        $out .= "</table>";


        return(PML_FETCH_SEARCHDONE);
    }

    /**
     * GetCachedPage
     *
     * downloaded a given url with a given referrer, uses caching from fetch-class
     *
     * @param string the url to fetch
     * @param string the Referrer (default-value is set here)
     **/
    function GetCachedPage($Url, $Referer="http://akas.imdb.com/") {
        return($this->fetchCachedUrl($Url, "akas.imdb.com", $Referer));
    }

    /**
     * DoFetch - perform the search on the page to fetch from
     *
     * IMPORTANT if you want to add some feilds:
     * if you add new fields, add them to var $FieldNames on top of this file
     *
     * @param string the fetched value (return-string)
     * @param string the FieldName
     * @access public
     * @return const PML_FETCH_ERROR, PML_FETCH_OK or PML_FETCH_ITEMNOTFOUND
     **/
    function DoFetch(&$ret, $FieldName) {
        global $CFG;

        switch($FieldName) {
            case "Title": //fetch Title

                //get this url, cached if allready used:
                $site = $this->GetCachedPage("/title/tt$this->FetchID/", "http://akas.imdb.com/Find");

                //regular-expresstion to filter out the field
                if(!preg_match('/<div id=\"tn15title\">\s*<h1>(.*) <span>/', $site, $x)) {

                    //if eregi fails, print error-message and return error
                    return(PML_FETCH_ERROR);
                }

                //else set $ret (will be returned)
                $ret = $x[1];
                $ret = addslashes($ret);

                //and break
                break;
            case "Year":
                $site = $this->GetCachedPage("/title/tt$this->FetchID/", "http://akas.imdb.com/Find");
                if(!eregi("<span>\(<a href=\"/Sections/Years/([0-9]{4})", $site, $x)) {
                    return(PML_FETCH_ERROR);
                }
                $ret = $x[1];
                if($ret=="") $ret=0;
                break;
            case "Poster":
                $site = $this->GetCachedPage("/title/tt$this->FetchID/", "http://akas.imdb.com/Find");
                if(!preg_match('/<a name="poster".+?<img .*?src="([^"]+)"/is', $site, $x)) {
                    return(PML_FETCH_ERROR);
                }
                $ret = $x[1];
                $ret= addslashes($ret);
                break;
            case "Director":
                $site = $this->GetCachedPage("/title/tt$this->FetchID/", "http://akas.imdb.com/Find");
                if(!preg_match('#Director:</h5>\n[^<]*<a href="/Name?[^"]*">([^<]*)</a>#i', $site, $x)) {
                    return(PML_FETCH_ERROR);
                }
                $ret = $x[1];
                $ret = addslashes($ret);
                break;
            case "Genre":
                $site = $this->GetCachedPage("/title/tt$this->FetchID/", "http://akas.imdb.com/Find");
                if(!preg_match('#Genre:</h5>(.*?)</div>#msi', $site, $gen)) {
                    return(PML_FETCH_ERROR);
                }
                $gen = $gen[1];
                $ret = array();
                while(eregi("<a href=\"/Sections/Genres/[a-zA-Z\\-]*/\">([a-zA-Z\\-]*)</A>", $gen, $x)) {
                        $gen = substr($gen,strpos($gen,$x[0])+strlen($x[0]));
                        $ret[] = addslashes($x[1]);
                }
                if(sizeof($ret)==0) {
                    return(PML_FETCH_ERROR);
                }
                break;
            case "Rating":
                $site = $this->GetCachedPage("/title/tt$this->FetchID/", "http://akas.imdb.com/Find");
                if(!eregi('<B>([0-9]).([0-9])/10</B>.*\(<a href="ratings">[0-9,]+ votes</a>\)', $site, $x)) {
                    return(PML_FETCH_ERROR);
                }
                $ret = $x[1].$x[2];
                $ret = $ret/10;
                break;
            case "Starring":
                $site = $this->GetCachedPage("/title/tt$this->FetchID/", "http://akas.imdb.com/Find");
                $ret = array();
                $i=0;
                while(eregi('<td class="nm"><a href="/name/nm([^"]+)">([^<]*)</a></td>', $site, $x)) { 
                    $i++;
                    if($i>$this->actorLimit) break;
                    $site = substr($site,strpos($site,$x[0])+strlen($x[0]));
                    $ret[] = addslashes($x[2]);
                }
                if(sizeof($ret)==0) {
                    return(PML_FETCH_ERROR);
                }
                break;
            case "Plot":
                $site = $this->GetCachedPage("/title/tt$this->FetchID/plotsummary", "http://akas.imdb.com/title/tt$this->FetchID/");
                if(eregi('<p class="plotpar">([^<]*)<i>', $site, $x)) {
                    //plot exists:
                    $ret = addslashes($x[1]);
                    break;
                }

                //plot doesn't exist, use plot-outline from title-page:
                $site = $this->GetCachedPage("/title/tt$this->FetchID/", "http://akas.imdb.com/Find");
                if (preg_match("#<h5>Plot Outline:</h5>([^<]*)#", $site, $x)) {
                    $ret = addslashes($x[1]);
                    break;
                }

                //plot doesn't exist, use plot-summary from title-page:
                if (preg_match("#<h5>Plot Summary:</h5>([^<]*)#", $site, $x)) {
                    $ret = addslashes($x[1]);
                    break;
                }

                // if there's no plot outline fetch tagline.
                if(!preg_match("#<h5>Tagline:</h5>([^<]*)#", $site, $x)) {
                    $ret = addslashes($x[1]);
                    break;
                }

                //error, no plot found
                return(PML_FETCH_ERROR);

            case "Release":
                $site = $this->GetCachedPage("/title/tt$this->FetchID/releaseinfo", "http://akas.imdb.com/title/tt$this->FetchID/");

                $convert["January"]="01";
                $convert["February"]="02";
                $convert["March"]="03";
                $convert["April"]="04";
                $convert["May"]="05";
                $convert["June"]="06";
                $convert["July"]="07";
                $convert["August"]="08";
                $convert["September"]="09";
                $convert["October"]="10";
                $convert["November"]="11";
                $convert["December"]="12";

                if(!eregi('<a href="/BusinessThisDay[^>]*>([0-9]+) ([A-Za-z]+)</a>', $site, $date)) {
                    return(PML_FETCH_ERROR);
                }

                if(!eregi("<a href=\"/Sections/Years[^>]*>([^<]*)</A>", $site, $year)) {
                    return(PML_FETCH_ERROR);
                }

                $ret = $year[1] . "-" . $convert[$date[2]] . "-" . $date[1];
                break;
            case "imdbid":
                $ret = $this->FetchID;
                break;
            case "Runtime":
                $site = $this->GetCachedPage("/title/tt$this->FetchID/", "http://akas.imdb.com/Find");
                if(!preg_match('#<h5>Runtime:</h5>\n([0-9]+) min#i', $site,$x)) {
                    return(PML_FETCH_ERROR);
                }
                $ret = $x[1];
                $ret = addslashes($ret);
                break;
            case "MPAA":
                $site = $this->GetCachedPage("/title/tt$this->FetchID/", "http://akas.imdb.com/Find");
                if(!preg_match('#<h5><a href="/mpaa">MPAA</a>:</h5> Rated ([^ ]+) for (.+).<br>#i', $site,$x)) {
                    return(PML_FETCH_ERROR);
                }
                $ret = $x[1];
                $ret = addslashes($ret);
                break;
            case "Akas":
                $site = $this->GetCachedPage("/title/tt$this->FetchID/", "http://akas.imdb.com/Find");
                $ret = array();
                if(eregi('<h5>Also Known As</h5>(.*)<h5><a href="/mpaa">MPAA</a>:</h5>',$site, $y)) {
                    $site = $y[0];
                    while(eregi('<i([^>]*)>([^<]*)</i>', $site, $x)) {
                        if(eregi($this->akaCountry, $x[2]))
                            $ret[] = addslashes(str_replace("&#32;", " ", $x[2]));
                        $site = substr($site,strpos($site,$x[0])+strlen($x[0]));
                    }
                }
                if(sizeof($ret)==0) {
                    return(PML_FETCH_ERROR);
                }
                break;
            case "Country":
                $site = $this->GetCachedPage("/title/tt$this->FetchID/", "http://akas.imdb.com/Find");
                $ret = array();
                while(eregi('<a href="/Sections/Countries/([^>]*)>([^<]*)</a>', $site, $x)) {
                    $site = substr($site,strpos($site,$x[0])+strlen($x[0]));
                    $ret[] = addslashes($x[2]);
                }
                if(sizeof($ret)==0) {
                    return(PML_FETCH_ERROR);
                }
                break;
            default:
                return(PML_FETCH_ITEMNOTFOUND);
        }//end switch $FieldName
        if(is_array($ret)) {
            foreach($ret as $k=>$i) {
                $ret[$k] = $this->ReplaceUnicodeChars($i);
            }
        } else {
            $ret = $this->ReplaceUnicodeChars($ret);
        }

        return(PML_FETCH_OK);
    }//end function DoFetch


    /**
     * getUseSettings
     *
     * returns if this field has additional settings
     *
     * @access public
     * @param string the field
     * @return boolean
     **/
    function getUseSettings($field) {
        switch($field) {
            case "Starring":
                return(true);
            case "Akas":
                return(true);
            default:
                return(false);
        }
    }

    /**
     * printSettings
     *
     * print out here the HTML-code for your custom settings
     *
     * @access public
     * @param string the field
     * @param string the current setting from the database
     * @return the HTML-code
     **/
    function printSettings($field, $set) {

        switch($field) {
            case "Starring":
                if($set=="") $set="3";
                $out = "<input type=\"text\" name=\"set{$field}\" size=\"3\" value=\"$set\"> Actors to fetch\n";
                return($out);
            case "Akas":
                if($set=="") $set="USA";
                $out = "<input type=\"text\" name=\"set{$field}\" size=\"32\" value=\"$set\"> Aka(s) to fetch\n";
                return($out);
        }
    }
    /**
     * saveSettings
     *
     * processes the $_GET-stuff and validates it and then moves it into
     * one string that will be saved in the database (only one field is
     * avaliable for saving the data!
     *
     * @access public
     * @param  string the field
     * @return string the string that will be saved in the db
     **/
    function saveSettings($field) {

        switch($field) {
            case "Starring":
                return($_POST['set'.$field]);
            case "Akas":
                return($_POST['set'.$field]);
            default:
                return("");
        }
    }

    /**
     * setSetting
     *
     * will be called from editentry.php bevore calling DoFetch
     * (only if $set is not empty)
     * There shoud the setting be processed and saved into some
     * class-vars...
     *
     * @access public
     * @param  string
     * @param  string the field
     **/
    function setSettings($field, $set) {
        switch($field) {
            case "Starring":
                if($set=="" || $set==0) $set="3";
                $this->actorLimit = $set;
                break;
            case "Akas":
                if($set=="") $set="USA";
                $this->akaCountry = $set;
                break;
        }
    }
}

?>
