<?php
/**
* ./lang/ro/lang.inc.php (Romanian Language file)
*
* <I> .lang.inc.php</I>
* <BR>This is the file
* <BR>for the Romanian
* <BR>language
*
* @author     Radu Maier <radu@rudisoft.net>
* @copyright  Copyright (c) 2008, Radu Maier
* @license    http://opensource.org/licenses/gpl-2.0.php
* @version    20:56 2008-09-07
* @since      19:27 2008-08-19
* @access     public
* @package    pmc
* @subpackage Internationalization
* @todo       stuff
*/

/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../../lib/404.php';}
/**
* Setup
*/
$lang['set']['x'] = '';

/**
* User status
*/
$lang['usr_status'][1] = 'Neautentificat';
$lang['usr_status'][2] = 'Campuri necompletate';
$lang['usr_status'][3] = 'Date incorecte';
$lang['usr_status'][4] = 'Cont suspendat';
$lang['usr_status'][5] = 'Autentificare reu&#351;it&#259;';
$lang['usr_status'][6] = 'Autentificat';
$lang['usr_status'][7] = 'Cod de verificare incorect';
$lang['usr_status'][8] = 'Multiple submits';
$lang['usr_status'][9] = 'Possible intrusion attempt';
/**
* General
*/
$lang['pmc']['welcome']  = 'Bun venit';
$lang['pmc']['order']    = 'Ordine';
$lang['pmc']['pic']      = 'Imagine';
$lang['pmc']['ttpre']    = 'Prefix Titlu';
$lang['pmc']['tt']       = 'Titlu';
$lang['pmc']['desc']     = 'Descriere';
$lang['pmc']['items']    = 'Articole';
$lang['pmc']['add']      = 'Ad&#259;ugare';
$lang['pmc']['mod']      = 'Modificare';
$lang['pmc']['del']      = '&#350;tergere';
$lang['pmc']['save_mod'] = 'Salvare modific&#259;ri';
$lang['pmc']['select']   = 'Selecta&#355;i';
$lang['pmc']['year']     = 'An';
$lang['pmc']['country']  = '&#354;ara';
$lang['pmc']['language'] = 'Limba';
$lang['pmc']['notes']    = 'Noti&#355;e';
$lang['pmc']['page']     = 'Pagina';
$lang['pmc']['of']       = 'din';
$lang['pmc']['sortby']   = 'Sortare dup&#259;';
$lang['pmc']['order']    = 'Ordonare';
$lang['pmc']['ordera']   = 'Ascendent&#259;';
$lang['pmc']['orderd']   = 'Descendent&#259;';
$lang['pmc']['ok']       = 'Ok';
$lang['pmc']['url']      = 'Adresa';
$lang['pmc']['captcha']  = 'Cod de verificare';
$lang['pmc']['today']    = 'ast&#259;zi';
$lang['pmc']['yesterday'] = 'ieri';
$lang['pmc']['ago1']      = 'acum';
$lang['pmc']['ago2']      = 'zile';
/**
* Administration
*/
$lang['adm']['adm'] = 'Administrare';
/**
* Categories
*/
$lang['categ']['categ']     = 'Categorie';
$lang['categ']['categs']    = 'Categorii';
$lang['categ']['add']       = 'Ad&#259;ugare Categorie';
$lang['categ']['view']      = 'Detalii Categorie';
$lang['categ']['viewall']   = 'Vizualizare Categorii';
$lang['categ']['allcategs'] = 'Toate Categoriile';
/**
* Movies
*/
$lang['movie']['movie']    = 'Film';
$lang['movie']['movies']   = 'Filme';
$lang['movie']['details']  = 'Detalii Film';
$lang['movie']['add']      = 'Ad&#259;ugare Film';
$lang['movie']['imdb']     = 'Id IMDb';
$lang['movie']['aka']      = 'Titluri alternative';
$lang['movie']['director'] = 'Regizor';
$lang['movie']['writer']   = 'Scenarist';
$lang['movie']['tagline']  = 'Tagline';
$lang['movie']['plot']     = 'Sinopsis';
$lang['movie']['cast']     = 'Distribu&#355;ia';
$lang['movie']['list']     = 'Lista filme';
/**
* Genres
*/
$lang['genre']['genres'] = 'Genuri';
/**
* IMDb
*/
$lang['imdb']['imdb']  = 'IMDb';
$lang['imdb']['url']   = 'URL IMDb';
$lang['imdb']['fetch'] = 'Preluare';
/**
* Settings
*/
$lang['set']['set']  = 'Setare';
$lang['set']['sets'] = 'Set&#259;ri';
$lang['set']['lang'] = 'Limba implicit&#259; a aplica&#355;iei';
$lang['set']['skin'] = 'Skin-ul implicit al aplica&#355;iei';
$lang['set']['pcat'] = 'Marimea maxima a imaginilor categoriilor';
$lang['set']['pmov'] = 'Marimea maxima a imaginilor filmelor';
$lang['set']['imov'] = 'Num&#259;r de filme afi&#351;ate pe o pagin&#259;';
$lang['set']['iusr'] = 'Num&#259;r de utilizatori afi&#351;a&#355;i pe o pagin&#259;';
/**
* Users
*/
$lang['usr']['usrs']    = 'Utilizatori';
$lang['usr']['add']     = 'Ad&#259;ugare Utilizator';
$lang['usr']['view']    = 'Detalii Utilizator';
$lang['usr']['viewall'] = 'Vizualizare Utilizatori';
$lang['usr']['name']    = 'Alias';
$lang['usr']['fname']   = 'Prenume';
$lang['usr']['lname']   = 'Nume';
$lang['usr']['mail1']   = 'E-mail';
$lang['usr']['mail2']   = 'E-mail din nou';
$lang['usr']['pass1']   = 'Parola';
$lang['usr']['pass2']   = 'Parola din nou';
$lang['usr']['pass1n']  = 'Noua parol&#259;';
$lang['usr']['pass2n']  = 'Noua parol&#259; din nou';
$lang['usr']['level']   = 'Nivel de acces';
$lang['usr']['lvl'][0]  = 'Vizitator';
$lang['usr']['lvl'][1]  = 'Utilizator';
$lang['usr']['lvl'][2]  = 'Utilizator VIP';
$lang['usr']['lvl'][3]  = 'Administrator';
$lang['usr']['lvl'][4]  = 'Colec&#355;ionar';
$lang['usr']['lvl'][5]  = 'Root';
$lang['usr']['status']  = 'Stare';
$lang['usr']['stat'][0] = 'Blocat';
$lang['usr']['stat'][1] = 'Activ';
$lang['usr']['login']   = 'Login';
$lang['usr']['logout']  = 'Logout';
$lang['usr']['status']  = 'Status';
$lang['usr']['vfirst']  = 'Prima vizit&#259;';
$lang['usr']['vtotal']  = 'vizite &#238;n total';
$lang['usr']['vlast']   = 'Ultima vizit&#259;';
/**
* Vizualization
*/
$lang['view']['view'] = 'Vizualizare';
/**
* Search
*/
$lang['search']['search']   = 'C&#259;utare';
$lang['search']['reset']    = 'Resetare';
$lang['search']['imdb']     = 'C&#259;utare IMDb';
$lang['search']['simple']   = 'C&#259;utare simpl&#259;';
$lang['search']['advanced'] = 'C&#259;utare avansat&#259;';
$lang['search']['results']  = 'Rezultatele c&#259;ut&#259;rii';
$lang['search']['exact']    = 'Potrivire exact&#259;';
$lang['search']['aprox']    = 'Toate cuvintele';
$lang['search']['regexp']   = 'Orice cuv&#226;nt';
$lang['search']['after']    = 'C&#259;utare dup&#259;';
/**
* Language
*/
$lang['lang']['lang']       = 'Limba';
$lang['lang']['langs']      = 'Limbi';
$lang['lang']['trans']      = 'Traduc&#259;tor';
$lang['lang']['current']    = 'Limba curent&#259;';
/**
* Skins
*/
$lang['skin']['skin']       = 'Skin';
$lang['skin']['skins']      = 'Skinuri';
$lang['skin']['auth']       = 'Traduc&#259;tor';
$lang['skin']['current']    = 'Skinul curent';
/**
* User list
*/
$lang['list']['mylist']     = 'Lista mea';
$lang['list']['view']       = 'Vizualizare list&#259;';
$lang['list']['add']        = 'Ad&#259;ugare';
$lang['list']['del']        = '&#350;tergere';
$lang['list']['save']       = 'Salvare';
$lang['list']['clear']      = '&#350;tergere';
$lang['list']['load']       = '&#206;nc&#259;rcare';
$lang['list']['isempty']    = 'Lista este goal&#259;';
$lang['list']['onetitle']   = 'Un titlu';
$lang['list']['titles']     = 'titluri';
/**
* Statistics
*/
$lang['stats']['stats']     = 'Statistici';
$lang['stats']['movies']    = 'Total filme';
$lang['stats']['newmovies'] = 'Filme noi';
$lang['stats']['users']     = 'Total utilizatori';
?>