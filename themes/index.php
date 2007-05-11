<?php
$dir = "./";
$i = '1';
if (is_dir($dir)) {
   if ($dh = opendir($dir)) {
       while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != "..") {
                if (filetype($dir . $file) == 'dir') {
                    $themes[$i] = $file;
                    $i++;
                }
            }
       }
       closedir($dh);
   }
}
?>
<?=count($themes)?> themes:<BR>
<?php
for ($i=1; $i <= count($themes); $i++) {
?>
<?=$i?> - <B><?=$themes[$i]?></B><BR>
<?php
}
?>