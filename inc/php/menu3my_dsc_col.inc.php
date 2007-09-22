<?php
$query_rst_dsc_categ = "SELECT * FROM `pmc_dsc_categ`";
$rst_dsc_categ = mysql_query($query_rst_dsc_categ) or die('Oups!<br>' . mysql_error());
$total_dsc_categs = mysql_num_rows($rst_dsc_categ);
?>
<?=$menu2_hdr?>
<?=$menu2_pre?>
<?=menu0($lnMDiscsAllCollections, 'my_discs.php?dsc=col', $_SESSION['usr_level'], 2);?>
<?=$menu2_suf?>
<?php
for ($i=1; $i<=$total_dsc_categs; $i++) {
    $row_rst_dsc_categ = mysql_fetch_assoc($rst_dsc_categ);
?>
<?=$menu2_pre?>
<?=menu0($row_rst_dsc_categ['categ_tt'], 'my_discs.php?dsc=col&amp;categ=' . $row_rst_dsc_categ['categ_id'], $_SESSION['usr_level'], 2);?>
<?=$menu2_suf?>
<?php
}
mysql_free_result($rst_dsc_categ);
?>
<?=$menu2_pre?>
<?=menu0($lnMDiscsNoColCateg, 'my_discs.php?dsc=col&amp;categ=0', $_SESSION['usr_level'], 2);?>
<?=$menu2_suf?>
<?=$menu2_ftr?>