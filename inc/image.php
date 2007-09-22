<?php
/*
source image must be gif
also you have to know it's W and H
*/
error_reporting(E_ALL);

require_once 'config.inc.php';

$picture = 'blank';
if(isset($_GET['picture'])) {$picture = $_GET['picture'];}
$old_width = '10';
if(isset($_GET['old_width'])) {$old_width = $_GET['old_width'];}
$old_height = '10';
if(isset($_GET['old_height'])) {$old_height = $_GET['old_height'];}
$new_width = '100';
if(isset($_GET['new_width'])) {$new_width = $_GET['new_width'];}
$new_height = '100';
if(isset($_GET['new_height'])) {$new_height = $_GET['new_height'];}
$fontSize = '7';
if(isset($_GET['fontSize'])) { $fontSize = $_GET['fontSize']; }
$fontFace = 'derby';
if(isset($_GET['fontFace'])) {$fontFace = $_GET['fontFace'];}
$x_f = '5';
if(isset($_GET['x_f'])) { $x_f = $_GET['x_f']; }
$y_f = '50';
if(isset($_GET['y_f'])) { $y_f = $_GET['y_f']; }
$color1 = 0;
if(isset($_GET['color1'])) {$color1 = $_GET['color1'];}
$color2 = 0;
if(isset($_GET['color2'])) {$color2 = $_GET['color2'];}
$color3 = 0;
if(isset($_GET['color3'])) {$color3 = $_GET['color3'];}
$text = 'PhpMyCollection';
if(isset($_GET['text'])) { $text = $_GET['text']; }

$font = TTF_DIR . $fontFace . '.ttf';
$imgbg = GRAPH_DIR . $picture . '.gif';
header("Content-type: image/png");
$temppic = imagecreatefromgif($imgbg);
$newpic = imagecreatetruecolor($new_width, $new_height);
imagecopyresampled($newpic, $temppic, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
$fontColor = imagecolorallocate($newpic, $color1, $color2, $color3);
imagettftext($newpic, $fontSize, 0, $x_f, $y_f, $fontColor, $font, $text);
imagepng($newpic);
imagedestroy($newpic);
?>