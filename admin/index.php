<?php
require_once '../inc/config.inc.php';
$redirect = ADM_URL . 'admin.php';
header("Location: $redirect");
exit;
?>