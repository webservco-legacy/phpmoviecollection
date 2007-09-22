<?php
require_once INC_DIR . 'collectors.inc.php';
?>
<?=$menu2_hdr?>
<?php
for ($i=1; $i<=$totalRows_rstCollectors; $i++) {
    $row_rstCollectors = mysql_fetch_assoc($rstCollectors);
    $colUsrId = $row_rstCollectors['usr_id'];
    $colUsrDisplay = $row_rstCollectors['usr_display'];
?>
<?=$menu2_pre?>
<?=menu0($colUsrDisplay, 'col.php?user_id=' . $colUsrId, $_SESSION['usr_level'], 1);?>
<?=$menu2_suf?>
<?php
}
mysql_free_result($rstCollectors);
?>
<?=$menu2_ftr?>