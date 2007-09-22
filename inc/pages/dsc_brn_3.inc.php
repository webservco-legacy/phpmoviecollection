<?php
$disc_target = '';
$usr_id = $_SESSION['usr_id'];
$today = date("Y-m-d");

if (isset($_GET['disc_source'])) {$disc_source = $_GET['disc_source'];}
if (isset($_GET['disc_target'])) {$disc_target = $_GET['disc_target'];}
if (isset($_POST['disc_target'])) {$disc_target = $_POST['disc_target'];}
if (isset($_POST['new_disc'])) {$new_disc = $_POST['new_disc'];}
if (isset($_POST['disc_id'])) {$disc_id = $_POST['disc_id'];}
?>
<DIV CLASS="pg_title">
<?=$lnMMyDiscs . ' - ' . $lnMDiscsTarget?>
</DIV>
<DIV CLASS="pg_subtitle">
&nbsp;&nbsp;
</DIV>
<DIV CLASS="pg_content">
<B>STEP 3: CHOOSE DISC DESTINATION</B><BR><BR>
<?php
if (isset($_GET['continue'])) {
  $errMsg = '';
  switch($disc_target) {
    case "col": {
      if ($disc_source == '1') {
        $query_rstFormValues = "SELECT * FROM `pmc_usr_dsc_col` WHERE `usr_id` = '".$_SESSION['usr_id']."' AND `disc_id` = '".$disc_id."' LIMIT 1";
        $rstFormValues = mysql_query($query_rstFormValues) or die('Oups!<br>' . mysql_error());
        $row_rstFormValues = mysql_fetch_assoc($rstFormValues);
        $dsc_col_id = $row_rstFormValues['dsc_col_id'];
        $categ_id = $row_rstFormValues['categ_id'];
        $disc_cat_number = $row_rstFormValues['disc_cat_number'];
        $usr_col_date = $row_rstFormValues['usr_col_date'];
        $disc_notes = $row_rstFormValues['disc_notes'];
        mysql_free_result($rstFormValues);
        
        $query_rstNexCatIndex = "SELECT `categ_index` FROM `pmc_dsc_categ` WHERE `categ_id` = '".$row_rstFormValues['categ_id']."'";
        $rstNexCatIndex=mysql_query($query_rstNexCatIndex) or die('Oups!<br>' . mysql_error());
        $disc_cat_index = mysql_result($rstNexCatIndex, 0);
        mysql_free_result($rstNexCatIndex);
      } // if target = source
      else {
        $query_rstNextId = "SELECT MAX(`dsc_col_id`) FROM `pmc_usr_dsc_col`";
        $rstNextId=mysql_query($query_rstNextId) or die('Oups!<br>' . mysql_error());
        $next_id = (mysql_result($rstNextId, 0)) + 1;
        mysql_free_result($rstNextId);

        $dsc_col_id = $next_id;
        $categ_id = '';

        $query_rstNextCatNr = "SELECT MAX(`disc_cat_number`) FROM `pmc_usr_dsc_col` WHERE `categ_id` = '1'";
        $rstNextCatNr=mysql_query($query_rstNextCatNr) or die('Oups!<br>' . mysql_error());
        $next_catnr = (mysql_result($rstNextCatNr, 0)) + 1;
        mysql_free_result($rstNextCatNr);
        // originally by matthew dot somerville at trinity dot oxford dot ac dot uk
        // from php.net
        $disc_cat_number = substr("0000$next_catnr",-5);
      
        $query_rstNexCatIndex = "SELECT `categ_index` FROM `pmc_dsc_categ` WHERE `categ_id` = '1'";
        $rstNexCatIndex=mysql_query($query_rstNexCatIndex) or die('Oups!<br>' . mysql_error());
        $disc_cat_index = mysql_result($rstNexCatIndex, 0);
        mysql_free_result($rstNexCatIndex);
      
        $usr_col_date = $today;
        $disc_notes = '';
      } //if target not = source

        if (isset($_POST['continue'])) {
          if (isset($_POST['dsc_col_id']))     {$dsc_col_id = $_POST['dsc_col_id'];}
          if (isset($_POST['usr_id']))     {$usr_id = $_POST['usr_id'];}
          if (isset($_POST['disc_id']))     {$disc_id = $_POST['disc_id'];}
          if (isset($_POST['categ_id']))     {$categ_id = $_POST['categ_id'];}
          if (isset($_POST['disc_cat_number']))     {$disc_cat_number = $_POST['disc_cat_number'];}
          if (isset($_POST['usr_col_date']))     {$usr_col_date = block_tags(trim($_POST['usr_col_date']));}
          if (isset($_POST['disc_notes']))     {$disc_notes = block_tags(trim($_POST['disc_notes']));}
          $err = '0';
          if (block_tags(trim($_POST['usr_col_date'])) == '') {$errMsg = 'date is empty!'; $err = '1';}
          if ($err == '0') {
            if ($disc_source == '1') {
              $query_mod_target = "UPDATE `pmc_usr_dsc_col` SET usr_id = '".$usr_id."', disc_id = '".$disc_id."', categ_id = '".$categ_id."', disc_cat_number = '".$disc_cat_number."', usr_col_date = '".$usr_col_date."', disc_notes = '".$disc_notes."' WHERE `dsc_col_id` = '".$dsc_col_id."'";
              mysql_query($query_mod_target) or die('Oups!<br>' . mysql_error());
              echo 'modified';
            } // same source
            else {
              $query_add_target = "INSERT INTO `pmc_usr_dsc_col` (dsc_col_id, usr_id, disc_id, categ_id, disc_cat_number, usr_col_date, disc_notes) VALUES ('".$dsc_col_id."', '".$usr_id."', '".$disc_id."', '".$categ_id."', '".$disc_cat_number."', '".$usr_col_date."', '".$disc_notes."')";
              mysql_query($query_add_target) or die('Oups!<br>' . mysql_error());
              if ($disc_source != '0') {
                $table_suf = '';
                switch($disc_source) {
                  case "1": {$table_suf = 'col';break;}
                  case "2": {$table_suf = 'give';break;}
                  case "3": {$table_suf = 'drop';break;}
                  default: {$table_suf = '';break;}
                }
                $query_drop_source = "DELETE from `pmc_usr_dsc_".$table_suf."` WHERE `usr_id` = '".$usr_id."' AND `disc_id` = '".$disc_id."' LIMIT 1";
                mysql_query($query_drop_source) or die('Oups!<br>' . mysql_error());
              }
              echo 'finished!';
            } // not same source
          } // if no error
          else {
            echo $errMsg . '<BR>';
            require_once INC_DIR . 'dsc_brn_3_form2col.inc.php';
          }
        } // if post
        else {require_once INC_DIR . 'dsc_brn_3_form2col.inc.php';}
      break;
    }
    case "giv": {
      if ($disc_source == '2') {
        $query_rstFormValues = "SELECT * FROM `pmc_usr_dsc_give` WHERE `usr_id` = '".$_SESSION['usr_id']."' AND `disc_id` = '".$disc_id."' LIMIT 1";
        $rstFormValues = mysql_query($query_rstFormValues) or die('Oups!<br>' . mysql_error());
        $row_rstFormValues = mysql_fetch_assoc($rstFormValues);
        $dsc_give_id = $row_rstFormValues['dsc_give_id'];
        $people_id = $row_rstFormValues['people_id'];
        $disc_price = $row_rstFormValues['disc_price'];
        $usr_give_date = $row_rstFormValues['usr_give_date'];
        $give_notes = $row_rstFormValues['give_notes'];
        mysql_free_result($rstFormValues);
      }
      else {
        $query_rstNextId = "SELECT MAX(`dsc_give_id`) FROM `pmc_usr_dsc_give`";
        $rstNextId=mysql_query($query_rstNextId) or die('Oups!<br>' . mysql_error());
        $next_id = (mysql_result($rstNextId, 0)) + 1;
        mysql_free_result($rstNextId);

        $dsc_give_id = $next_id;
     
        $people_id = '';
        $disc_price = '0.00';
        $usr_give_date = $today;
        $give_notes = '';
      }
        if (isset($_POST['continue'])) {
          if (isset($_POST['dsc_give_id']))     {$dsc_give_id = $_POST['dsc_give_id'];}
          if (isset($_POST['usr_id']))     {$usr_id = $_POST['usr_id'];}
          if (isset($_POST['disc_id']))     {$disc_id = $_POST['disc_id'];}
          if (isset($_POST['people_id']))     {$people_id = $_POST['people_id'];}
          if (isset($_POST['disc_price']))     {$disc_price = block_tags(trim($_POST['disc_price']));}
          if (isset($_POST['usr_give_date']))     {$usr_give_date = block_tags(trim($_POST['usr_give_date']));}
          if (isset($_POST['give_notes']))     {$give_notes = block_tags(trim($_POST['give_notes']));}
          $err = '0';
          if (block_tags(trim($_POST['disc_price'])) == '') {$errMsg = 'price is empty!'; $err = '1';}
          if (block_tags(trim($_POST['usr_give_date'])) == '') {$errMsg = 'date is empty!'; $err = '1';}
          if ($err == '0') {
            if ($disc_source == '2') {
              $query_mod_target = "UPDATE `pmc_usr_dsc_give` SET usr_id = '".$usr_id."', disc_id = '".$disc_id."', people_id = '".$people_id."', disc_price = '".$disc_price."', usr_give_date = '".$usr_give_date."', give_notes = '".$give_notes."' WHERE `dsc_give_id` = '".$dsc_give_id."'";
              mysql_query($query_mod_target) or die('Oups!<br>' . mysql_error());
              echo 'modified';
            } // same source
            else {
              $query_add_target = "INSERT INTO `pmc_usr_dsc_give` (dsc_give_id, usr_id, disc_id, people_id, disc_price, usr_give_date, give_notes) VALUES ('".$dsc_give_id."', '".$usr_id."', '".$disc_id."', '".$people_id."', '".$disc_price."', '".$usr_give_date."', '".$give_notes."')";
            mysql_query($query_add_target) or die('Oups!<br>' . mysql_error());
            if ($disc_source != '0') {
              $table_suf = '';
              switch($disc_source) {
                case "1": {$table_suf = 'col';break;}
                case "2": {$table_suf = 'give';break;}
                case "3": {$table_suf = 'drop';break;}
                default: {$table_suf = '';break;}
              }
              $query_drop_source = "DELETE from `pmc_usr_dsc_".$table_suf."` WHERE `usr_id` = '".$usr_id."' AND `disc_id` = '".$disc_id."' LIMIT 1";
              mysql_query($query_drop_source) or die('Oups!<br>' . mysql_error());
            }
            echo 'finished!';
            }
          }
          else {
            echo $errMsg . '<BR>';
            require_once INC_DIR . 'dsc_brn_3_form2giv.inc.php';
          }
        } // if post
        else {require_once INC_DIR . 'dsc_brn_3_form2giv.inc.php';}
      break;
    }
    case "drp": {
      if ($disc_source == '3') {
        $query_rstFormValues = "SELECT * FROM `pmc_usr_dsc_drop` WHERE `usr_id` = '".$_SESSION['usr_id']."' AND `disc_id` = '".$disc_id."' LIMIT 1";
        $rstFormValues = mysql_query($query_rstFormValues) or die('Oups!<br>' . mysql_error());
        $row_rstFormValues = mysql_fetch_assoc($rstFormValues);
        $dsc_drop_id = $row_rstFormValues['dsc_drop_id'];
        $usr_drop_date = $row_rstFormValues['usr_drop_date'];
        $drop_notes = $row_rstFormValues['drop_notes'];
        mysql_free_result($rstFormValues);
      }
      else {
        $query_rstNextId = "SELECT MAX(`dsc_drop_id`) FROM `pmc_usr_dsc_drop`";
        $rstNextId=mysql_query($query_rstNextId) or die('Oups!<br>' . mysql_error());
        $next_id = (mysql_result($rstNextId, 0)) + 1;
        mysql_free_result($rstNextId);

        $dsc_drop_id = $next_id;
     
        $usr_drop_date = $today;
        $drop_notes = '';
      }
        if (isset($_POST['continue'])) {
          if (isset($_POST['dsc_drop_id']))     {$dsc_drop_id = $_POST['dsc_drop_id'];}
          if (isset($_POST['usr_id']))     {$usr_id = $_POST['usr_id'];}
          if (isset($_POST['disc_id']))     {$disc_id = $_POST['disc_id'];}
          if (isset($_POST['usr_drop_date']))     {$usr_drop_date = block_tags(trim($_POST['usr_drop_date']));}
          if (isset($_POST['drop_notes']))     {$drop_notes = block_tags(trim($_POST['drop_notes']));}
          $err = '0';
          if (block_tags(trim($_POST['usr_drop_date'])) == '') {$errMsg = 'date is empty!'; $err = '1';}
          if ($err == '0') {
            if ($disc_source == '3') {
              $query_mod_target = "UPDATE `pmc_usr_dsc_drop` SET usr_id = '".$usr_id."', disc_id = '".$disc_id."', usr_drop_date = '".$usr_drop_date."', drop_notes = '".$drop_notes."' WHERE `dsc_drop_id` = '".$dsc_drop_id."'";
              mysql_query($query_mod_target) or die('Oups!<br>' . mysql_error());
              echo 'modified';
            }
            else {
              $query_add_target = "INSERT INTO `pmc_usr_dsc_drop` (dsc_drop_id, usr_id, disc_id, usr_drop_date, drop_notes) VALUES ('".$dsc_drop_id."', '".$usr_id."', '".$disc_id."', '".$usr_drop_date."', '".$drop_notes."')";
              mysql_query($query_add_target) or die('Oups!<br>' . mysql_error());
              if ($disc_source != '0') {
                $table_suf = '';
                switch($disc_source) {
                  case "1": {$table_suf = 'col';break;}
                  case "2": {$table_suf = 'give';break;}
                  case "3": {$table_suf = 'drop';break;}
                  default: {$table_suf = ''; break;}
                }
                $query_drop_source = "DELETE from `pmc_usr_dsc_".$table_suf."` WHERE `usr_id` = '".$usr_id."' AND `disc_id` = '".$disc_id."' LIMIT 1";
                mysql_query($query_drop_source) or die('Oups!<br>' . mysql_error());
              }
              echo 'finished!';
            }
          }
          else {
            echo $errMsg . '<BR>';
            require_once INC_DIR . 'dsc_brn_3_form2drp.inc.php';
          }
        } // if post
        else {require_once INC_DIR . 'dsc_brn_3_form2drp.inc.php';}
      break;
    }
    default: {
      break;
    }
  }
}
else {
  require_once INC_DIR . 'dsc_brn_3_form1.inc.php';
}
?>
</DIV>