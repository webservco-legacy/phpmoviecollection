<?php
$query_rstNextGetId = "SELECT MAX(`get_id`) FROM `pmc_dsc_src_get`";
$rstNextGetId=mysql_query($query_rstNextGetId) or die('Oups!<br>' . mysql_error());
$get_id = (mysql_result($rstNextGetId, 0)) + 1;
mysql_free_result($rstNextGetId);

$usr_id = $_SESSION['usr_id'];

$people_id = '0';

$get_date = date("Y-m-d");

$get_price = '0.00';

$get_notes = '';

$errMsg = '';

if (isset($_POST['get_id']))     {$get_id = $_POST['get_id'];}
if (isset($_POST['usr_id']))     {$usr_id = $_POST['usr_id'];}
if (isset($_POST['disc_id']))     {$disc_id = $_POST['disc_id'];}
if (isset($_POST['people_id']))     {$people_id = $_POST['people_id'];}
if (isset($_POST['get_date']))     {$get_date = block_tags(trim($_POST['get_date']));}
if (isset($_POST['get_price']))     {$get_price = block_tags(trim($_POST['get_price']));}
if (isset($_POST['get_notes']))     {$get_notes = block_tags(trim($_POST['get_notes']));}
?>
<DIV CLASS="pg_title">

<?=$lnMMyDiscs . ' - ' . $lnMDiscsAdd . ' - ' . $lnMDiscsAddGet?>
</DIV>
<DIV CLASS="pg_subtitle">
&nbsp;&nbsp;
</DIV>
<DIV CLASS="pg_content">
<B>STEP 2: WHERE DID YOU GET IT?</B><BR><BR>
<?php
if (isset($_POST['continue'])) {
  $err = '0';
  if (block_tags(trim($_POST['get_date'])) == '') {$errMsg = 'date is empty!'; $err = '1';}
  if ($err == '0') {
    $query_add_get = "INSERT INTO `pmc_dsc_src_get` (get_id, usr_id, disc_id, people_id, get_date, get_price, get_notes) VALUES ('".$get_id."', '".$usr_id."', '".$disc_id."', '".$people_id."', '".$get_date."', '".$get_price."', '".$get_notes."')";
    mysql_query($query_add_get) or die('Oups!<br>' . mysql_error());
    echo 'Added disc source!';
    echo '<BR><BR>';
    echo '<A CLASS="default" HREF="'.PMC_ROOT.'dsc_brn_3.php?disc_id='.$disc_id.'&amp;new_disc=1">continue</A> ';
  }
  else {
    echo $errMsg . '<BR>';
    require_once INC_DIR . 'dsc_get_2_form.inc.php';
    
  }
} // IF POST
else {
require_once INC_DIR . 'dsc_get_2_form.inc.php';
} // IF NOT POST
?>
</DIV>