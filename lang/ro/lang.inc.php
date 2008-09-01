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
* @version    20:01 2008-08-31
* @since      19:27 2008-08-19
* @access     public
* @package    phpMyMovieCollection
* @subpackage Internationalization
* @todo       Everything :-)
*/

/**
* Prevent direct file access
*/
if(!defined('_VALID_REQUEST')) {require_once '../../lib/404.php';}
/**
* Language info
*/
$lang_info['name']       = 'Romanian';
$lang_info['local_name'] = 'Rom&#226;ne&#351;te';
$lang_info['tr_name']    = 'Radu Maier';
$lang_info['tr_url']     = 'http://www.rudisoft.net';
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
$lang['pmmc']['order']    = 'Ordine';
$lang['pmmc']['pic']      = 'Imagine';
$lang['pmmc']['ttpre']    = 'Prefix Titlu';
$lang['pmmc']['tt']       = 'Titlu';
$lang['pmmc']['desc']     = 'Descriere';
$lang['pmmc']['items']    = 'Articole';
$lang['pmmc']['add']      = 'Ad&#259;ugare';
$lang['pmmc']['mod']      = 'Modificare';
$lang['pmmc']['del']      = '&#350;tergere';
$lang['pmmc']['save_mod'] = 'Salvare modific&#259;ri';
$lang['pmmc']['select']   = 'Selecta&#355;i';
$lang['pmmc']['year']     = 'An';
$lang['pmmc']['country']  = '&#354;ara';
$lang['pmmc']['language'] = 'Limba';
$lang['pmmc']['notes']    = 'Noti&#355;e';
$lang['pmmc']['page']     = 'Pagina';
$lang['pmmc']['of']       = 'din';
$lang['pmmc']['sortby']   = 'Sortare dup&#259;';
$lang['pmmc']['order']    = 'Ordonare';
$lang['pmmc']['ordera']   = 'Ascendent&#259;';
$lang['pmmc']['orderd']   = 'Descendent&#259;';
$lang['pmmc']['ok']       = 'Ok';
/**
* Users
*/
$lang['usr']['login']  = 'login';
$lang['usr']['logout'] = 'logout';
$lang['usr']['level']  = 'nivel de acces';
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
$lang['categ']['view']      = 'Vizualizare Categorie';
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
$lang['imdb']['fetch'] = 'Preluare date';
/**
* Settings
*/
$lang['set']['sets'] = 'Set&#259;ri';
$lang['set']['lang'] = 'Limba implicit&#259; a aplica&#355;iei';
$lang['set']['skin'] = 'Skin-ul implicit al aplica&#355;iei';
$lang['set']['pcat'] = 'Marimea maxima a imaginilor categoriilor';
$lang['set']['pmov'] = 'Marimea maxima a imaginilor filmelor';
/**
* Users
*/
$lang['usr']['usrs']    = 'Utilizatori';
$lang['usr']['add']     = 'Ad&#259;ugare Utilizator';
$lang['usr']['view']    = 'Detalii Utilizator';
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
$lang['usr']['lvl'][1]  = 'Utilizator';
$lang['usr']['lvl'][2]  = 'Utilizator VIP';
$lang['usr']['lvl'][3]  = 'Administrator';
$lang['usr']['lvl'][4]  = 'Colec&#355;ionar';
$lang['usr']['lvl'][5]  = 'Root';
$lang['usr']['status']  = 'Stare';
$lang['usr']['stat'][0] = 'Blocat';
$lang['usr']['stat'][1] = 'Activ';
/**
* Users
*/
$lang['skin']['skin']   = 'Skin';
?>