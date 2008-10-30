<?php
/**
* ./inc/imdb.inc.php (imdb fetching function)
*
* <I> ./inc/imdb.inc.php</I>
* <BR>This file holds a function that
* <BR>fetches data from imdb based on
* <BR>an id.
* <BR>It uses the BrowserEmulator class by Kai Blankenhorn
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    09:45 2008-10-30
* @since      19:30 2008-08-29
* @access     public
* @package    pmc
* @subpackage Imdb
* @todo       fetch: mpaa, runtime, color, trivia, goofs
*/

/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../lib/404.php';}

/**
* Imdb pictures fetching function
*
* Description
*
* @param string $pics_url url returned by pmc_get_imdb
* @return array imdb pics urls
*/
function pmc_get_imdb_pics($imdb_pics) {
  $pics = array();
  if($imdb_pics == '') {return $pics; exit;}
  $pics_url = 'http://www.imdb.com/media/rm'.$imdb_pics;
  $be = new BrowserEmulator(); 
  $be->addHeaderLine("Referer", "http://www.imdb.com/"); 
  $be->addHeaderLine("Accept-Encoding", "x-compress; x-zip"); 
  $file = $be->fopen($pics_url);
  $i = 0;
  while ($line[$i] = fgets($file, 10240)) {
    $res = strpos($line[$i], '<img alt="" id=current height="80" width="80" src="http://ia.media-imdb.com/images/M/');
    $res2 = strpos($line[$i], '<img alt="" height="80" width="80"');
    if ($res !== false ) {
      $line[$i] = preg_replace("|<img[^>]+src=\"|U", '', $line[$i]);
      $line[$i] = preg_replace("|\" />|U", '', $line[$i]);
      $line[$i] = preg_replace("|._V1.[^>]+.jpg|U", '.jpg', $line[$i]);
      $line[$i] = preg_replace("|http://ia.media-imdb.com/images/M/|U", '', $line[$i]);
      $pics[0] = trim($line[$i]);
    }
    else if ($res2 !== false ) {
      $line[$i] = preg_replace("|<a[^>]+>|U", '', $line[$i]);
      $line[$i] = preg_replace("|</a>|U", '', $line[$i]);
      $line[$i] = preg_replace("|<img[^>]+src=\"|U", '', $line[$i]);
      $line[$i] = preg_replace("|\" />|U", '', $line[$i]);
      $line[$i] = preg_replace("|._V1.[^>]+.jpg|U", '.jpg', $line[$i]);
      $line[$i] = preg_replace("|http://ia.media-imdb.com/images/M/|U", '', $line[$i]);
      $pics[] = trim($line[$i]);
    }
  }
  fclose($file);
  //$pics = implode('-', $pics);
  return $pics;
}
/**
* Imdb fetching function
*
* I've put it in a separate file because was made in a hurry and it is very raw, needing many improvements
*
* @param string $imdb_id id of the movie to be fetched
* @return array imdb data
*/
function pmc_get_imdb($imdb_id) {
  $imdb['pics_url']  = '';
  $imdb['title_the'] = '';
  $imdb['title']     = '{TT}';
  $imdb['typ']       = 0;
  $imdb['aka']       = '{AKA}';
  $imdb['year']      = '{YR}';
  $dirline           = 0;
  $imdb['dir']       = '{DIR}';
  $wrtline           = 0;
  $imdb['wrt']       = '{WRT}';
  $tagline           = 0;
  $imdb['tag']       = '{TAG}';
  $plotline          = 0;
  $imdb['plot']      = '{PLOT}';
  $castline          = 0;
  $imdb['cast']      = '{CAST}';
  $imdb['country']   = '{COUNTRY}';
  $imdb['language']  = '{LANGUAGE}';
  
  if($imdb_id == '') {return $imdb; exit;}
  $imdb_url = 'http://www.imdb.com/title/tt'.$imdb_id.'/';
  $be = new BrowserEmulator(); 
  $be->addHeaderLine("Referer", "http://www.imdb.com/"); 
  $be->addHeaderLine("Accept-Encoding", "x-compress; x-zip"); 
  //$be->addPostData("Submit", "OK"); 
  //$be->addPostData("item", "42"); 
  //$be->setAuth("admin", "secretpass"); 
  // also possible: 
  // $be->setPort(10080); 
  $file = $be->fopen($imdb_url);
  //$response = $be->getLastResponseHeaders(); 
  //print_r($response);

  $i = 0;
  $data = '';
  while ($line[$i] = fgets($file, 10240)) {
      /* picture link */
      if ($i>190 && $i<250) {
        $res = strpos($line[$i], '<a name="poster"');
        if ($res !== false ) {
          $line[$i] = preg_replace("|<img[^>]+/>|U", '', $line[$i]);
          $line[$i] = preg_replace("|<a name=\"poster\" href=\"|U", '', $line[$i]);
          $line[$i] = preg_replace("|\" title=\"[^>]+\"></a>|U", '', $line[$i]);
          $line[$i] = preg_replace("|/rg/action-box-title/primary-photo/media/rm|U", '', $line[$i]);
          $imdb['pics_url'] = trim($line[$i]);
        }
      }
      
      /* title+year+type */
      if ($i>240 && $i<250) {
        $res = strpos($line[$i], '<h1>');
        if ($res !== false ) {
          $line[$i] = strip_tags($line[$i]);

          $typ1 = strpos($line[$i], '(V)');
          $typ2 = strpos($line[$i], '(TV)');
          if ($typ1 !== false ) {$imdb['typ'] = 1;}
          else if ($typ2 !== false ) {$imdb['typ'] = 2;}
          
          $pattern = array('/\(/', '/\)/');
          $replace = array('+', '');
          $line[$i] = preg_replace($pattern, $replace, $line[$i]);
          $liner = explode("+", $line[$i]);
          $imdb['title'] = trim($liner[0]);
          //if(strpos($imdb['title'], 'The ') !== false) {
          if(strpos($imdb['title'], 'The ') === 0) {
          //$imdb['title'] = str_replace('The ', '', $imdb['title']);
            $imdb['title'] = preg_replace("|The |U", '', $imdb['title'], 1);
            $imdb['title_the'] = 'The';
          }
          else if(pmc_string_exists(', La', $imdb['title'])) {
            $imdb['title'] = preg_replace("|, La|U", '', $imdb['title'], 1);
            $imdb['title_the'] = 'La';
          }
          else if(pmc_string_exists(', Il', $imdb['title'])) {
            $imdb['title'] = preg_replace("|, Il|U", '', $imdb['title'], 1);
            $imdb['title_the'] = 'Il';
          }
          else if(pmc_string_exists(', Les', $imdb['title'])) {
            $imdb['title'] = preg_replace("|, Les|U", '', $imdb['title'], 1);
            $imdb['title_the'] = 'Les';
          }
          else if(pmc_string_exists(', Una', $imdb['title'])) {
            $imdb['title'] = preg_replace("|, Una|U", '', $imdb['title'], 1);
            $imdb['title_the'] = 'Una';
          }
          else if(pmc_string_exists(', Os', $imdb['title'])) {
            $imdb['title'] = preg_replace("|, Os|U", '', $imdb['title'], 1);
            $imdb['title_the'] = 'Os';
          }
          else if(pmc_string_exists(', El', $imdb['title'])) {
            $imdb['title'] = preg_replace("|, El|U", '', $imdb['title'], 1);
            $imdb['title_the'] = 'El';
          }
          else if(pmc_string_exists(', Los', $imdb['title'])) {
            $imdb['title'] = preg_replace("|, Los|U", '', $imdb['title'], 1);
            $imdb['title_the'] = 'Los';
          }
          //$imdb['year']  = trim($liner[1]);
          $imdb['year']  = preg_replace("|More at IMDb Pro &raquo;|U", '', $liner[1]);
          $imdb['year']  = preg_replace("|/[^>]|U", '', $imdb['year']);
          $imdb['year']  = trim($imdb['year']);
        }
      }
      /* //title+year */
      
      /* director */
      if($i > 200) {
        if(trim(strip_tags($line[$i])) == 'Director:' || trim(strip_tags($line[$i])) == 'Directors:') {$dirline = $i+1;}
        else if($dirline != 0 && $i == $dirline) {
          $res = strpos($line[$i], '<br/>');
          if ($res !== false ) {
            $dirs = explode("<br/>", trim($line[$i]));
            $dirs = array_diff($dirs, array(''));
            $dir = implode(", ", $dirs);
            $dir = preg_replace("|<[^>]+>more</[^>]+>|U", '', $dir);
            $imdb['dir'] = trim(strip_tags($dir));
          }
          else {$imdb['dir'] = trim(strip_tags($line[$i]));}
        }
      }
      /* //director */
      
      /* writers */
      if($i > 150) {
        $res = strpos($line[$i], '<h5>Writer');
        if ($res !== false ) {$wrtline = $i+1;}
        else if($wrtline != 0 && $i == $wrtline) {
          $wrts = explode("<br/>", trim($line[$i]));
          $wrts = array_diff($wrts, array(''));
          $wrts = preg_replace("|\([^\)]+(.*)\)|U", '', $wrts);
          $wrts = array_unique($wrts);
          $wrt = implode(", ", $wrts);
          $wrt = preg_replace("|<[^>]+>more</[^>]+>|U", '', $wrt);
          $bad = array('  &#38;', '  ...,');
          $wrt = str_replace($bad, '', $wrt);
          $imdb['wrt'] = trim(strip_tags($wrt));
        }
      }
      /* //writers */
      
      /* tagline */
      if($i > 150) {
        $res = strpos($line[$i], '<h5>Tagline:');
        if ($res !== false ) {$tagline = $i+1;}
        else if($tagline != 0 && $i == $tagline) {
          $tag = preg_replace("|<[^>]+>(.*)</[^>]+>|U", '', $line[$i]);
          $imdb['tag'] = trim(strip_tags($tag));
        }
      }
      /* //tagline */
      
      /* plot */
      if($i > 150) {
        $res = strpos($line[$i], '<h5>Plot:');
        if ($res !== false ) {$plotline = $i+1;}
        else if($plotline != 0 && $i == $plotline) {
          $plot = preg_replace("|<[^>]+>(.*)</[^>]+>|U", '', $line[$i]);
          $bad = array('|');
          $plot = str_replace($bad, '', $plot);
          $imdb['plot'] = trim(strip_tags($plot));
        }
      }
      /* //plot */
      
      /* aka */
      if($i > 150) {
      $res = strpos($line[$i], '<h5>Also Known As:');
        if ($res !== false ) {
          $prega1 = "|<[^>]+>(.*)</[^>]+>|U";
          $aka = preg_replace($prega1, '', $line[$i]);
          //$prega2 = "|\&\#(.*)\;|U";
          $aka = str_replace('&#32;', '', $aka);
          $prega3 = "|\((.*)\)|U";
          $aka = preg_replace($prega3, '', $aka);
          $akas = explode("<br>", $aka);
          $takas = count($akas);
          for($m=0;$m<$takas;$m++) {$akas[$m] = trim($akas[$m]);}
          $akas = array_diff($akas, array(''));
          $aka = implode(", ", $akas);
          $imdb['aka'] = trim(strip_tags($aka));
        }
        $data .= $line[$i]; /*take data for country and language */
      }
      /* //aka */
      
      /* cast */
      if($i > 150) {
        $res = strpos($line[$i], '<div class="headerinline"><h3>Cast');
        if ($res !== false ) {
        
        //$cast = $line[$i];
        
           $pregc = '|... </td><td class="char"><a href="/character/(.*)/">(.*)</a>(.*)</td></tr>|U';
           $cast = preg_replace($pregc, '+', $line[$i]);
           $pregc2 = '|... </td><td class="char">(.*)</td>|U';
           $cast = preg_replace($pregc2, '+', $cast);
           $pregc3 = '|<div class="headerinline"><h3>Cast</h3>&nbsp;<small style="position: relative; bottom: 1px">(.*)</small></div>|U';
           $cast = preg_replace($pregc3, '', $cast);
           $pregc4 = '|<form action="/character/create" method="post">(.*)</form>|U';
           $cast = preg_replace($pregc4, '', $cast);
           $pregc5 = '|<[^>]+>more</[^>]+>|U';
           $cast = preg_replace($pregc5, '', $cast);
           $cast = trim(strip_tags($cast));
           $casts = explode("+", $cast);
           $tcasts = count($casts);
           for($j=0;$j<$tcasts;$j++) {$casts[$j] = trim($casts[$j]);}
           $casts = array_diff($casts, array(''));
           $casts = array_unique($casts);
           $imdb['cast'] = implode(", ", $casts);
        }
      }
      /* //cast */
      
      $i++;
      

  }
  fclose($file);
  $resx = strpos($data, '<h5>Country:</h5>');
  if ($resx !== false ) {
    $data = trim(strip_tags($data));
    $imdb1 = strstr($data, 'Country:');
    $imdb2 = strstr($data, 'Language:');
    $imdb3 = strstr($data, 'Color:');

    $imdbc  = str_replace($imdb2, '', $imdb1);
    $imdbc  = str_replace('Country:', '', $imdbc);
    $imdbc = explode("|", $imdbc);
    $timdbc = count($imdbc);
    for($k=0;$k<$timdbc;$k++) {$imdbc[$k] = trim($imdbc[$k]);}
    $imdbc = array_diff($imdbc, array(''));
    $imdb['country'] = implode(", ", $imdbc);
    
    $imdbl = str_replace($imdb3, '', $imdb2);
    $imdbl  = str_replace('Language:', '', $imdbl);
    $imdbl = explode("|", $imdbl);
    $timdbl = count($imdbl);
    for($l=0;$l<$timdbl;$l++) {$imdbl[$l] = trim($imdbl[$l]);}
    $imdbl = array_diff($imdbl, array(''));
    $imdb['language'] = implode(", ", $imdbl);
  }
  /* //country and language */
  
  return $imdb;
}
/**
* Imdb pictures saving function
*
* Description
*
* @param string $file file to be written
* @param string $picfile picture to be written
* @return mixed result
*/
function pmc_save_imdb_pics($newfile,$picfile) {
  if($picfile == '') {return false; exit;}
  else {
    $be = new BrowserEmulator();
    $be->addHeaderLine("Referer", "http://ia.media-imdb.com/"); 
    $be->addHeaderLine("Accept-Encoding", "x-compress; x-zip");
    $file = $be->fopen('http://ia.media-imdb.com/images/M/'.$picfile);
    $pic = '';
    $i = 0;
    while ($line[$i] = fgets($file, 10240)) {$pic .= $line[$i]; $i++;}
    fclose($file);
    if(!$handle = fopen($newfile, 'w')) {return false; exit;}
    else if(fwrite($handle, $pic) === FALSE) {return false; exit;}
    else {
      fclose($handle);
      return true;
    }
  }
}
?>