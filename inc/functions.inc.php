<?php
/* --------------------------------------------------------------------------------------------------------------
    EMAIL VALIDATION
    --------------------------------------------------------------------------------------------------------------*/
function isEmail($email) { 
    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
}
/* --------------------------------------------------------------------------------------------------------------
    //EMAIL VALIDATION
    --------------------------------------------------------------------------------------------------------------*/
/* --------------------------------------------------------------------------------------------------------------
    BLOCK HTML/PHP TAGS 
    --------------------------------------------------------------------------------------------------------------*/
//originally  by JeremysFilms.com 
function block_tags($string){
    $replaced_string = str_ireplace('<','&#60;',$string);
    $replaced_string = str_ireplace('>','&#62;',$replaced_string);
return $replaced_string;
}
/* --------------------------------------------------------------------------------------------------------------
    //BLOCK HTML/PHP TAGS 
    --------------------------------------------------------------------------------------------------------------*/
/* --------------------------------------------------------------------------------------------------------------
    GENEREATE HTML HEADER CONTENT
    --------------------------------------------------------------------------------------------------------------*/
function genhead() {
    global $page_title
?>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">

    <LINK REL="icon" TYPE="image/ico" HREF="<?=PMC_ROOT?>favicon.ico">

    <LINK REL="shortcut icon" TYPE="image/ico" HREF="<?=PMC_ROOT?>favicon.ico">
    
    <TITLE><?=$page_title?></TITLE>

    <META NAME="title" CONTENT="<?=$page_title?>">
    
    <META NAME="author" CONTENT="Radu Maier, Ingrid Codila">
    
    <META NAME="subject" CONTENT="<?=$page_title?>">
    
    <META NAME="description" CONTENT="<?=SITE_DESCRIPTION?>">
    
    <META NAME="keywords" CONTENT="<?=SITE_KEYWORDS?>">
    
    <META NAME="copyright" CONTENT="© 2007 The Underground Beat">
    
    <META NAME="designer" CONTENT="Radu Maier, Ingrid Codila">
    
    <META NAME="revisit-after" CONTENT="7 Days">
    
    <META NAME="distribution" CONTENT="Global">
    
    <META NAME="robots" CONTENT="index,follow">
    
    <SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript" SRC="<?=INC_URL?>jsfunc.js"></SCRIPT>

<?php
}
/* --------------------------------------------------------------------------------------------------------------
    //GENEREATE HTML HEADER CONTENT
    --------------------------------------------------------------------------------------------------------------*/
/* --------------------------------------------------------------------------------------------------------------
    MENU
    --------------------------------------------------------------------------------------------------------------*/
function menu0 ($name, $link, $current_level, $required_level) {
    if ($current_level >= $required_level) {
        echo '<A HREF="' . PMC_ROOT . $link . '">' . $name . '</A>';
    }
    else {
        echo $name;
    }
}
/* --------------------------------------------------------------------------------------------------------------
    //MENU
    --------------------------------------------------------------------------------------------------------------*/
/* --------------------------------------------------------------------------------------------------------------
    PARSE A STRING FOR SEARCH
    --------------------------------------------------------------------------------------------------------------*/
function searchparse($string){
//trim
$dostring  = trim($string);
// cut out unwanted characters
$unwanted = array('\"', '+');
$dostring = str_replace($unwanted, ' ', $dostring);
// block tags
$dostring = str_ireplace("<","&#60;",$dostring);
$dostring = str_ireplace(">","&#62;",$dostring);
// ignore common words
$dostring = str_ireplace(" the","",$dostring);
$dostring = str_ireplace(" or","",$dostring);
$dostring = str_ireplace(" and","",$dostring);

$words = str_word_count($dostring, 1, "\'1234567890");
if (count($words) != '0') {$search_string = implode("|", $words);}
else {$search_string = 'qwerty';}
return $search_string;
}
/* --------------------------------------------------------------------------------------------------------------
    //PARSE A STRING FOR SEARCH 
    --------------------------------------------------------------------------------------------------------------*/
?>
