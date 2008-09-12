<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="content-language" content="en" />
  <link rel="icon" type="image/ico" href="<?php echo $_SESSION['pmc_usr_skin_url']; ?>favicon.ico" />
  <link rel="shortcut icon" type="image/ico" href="<?php echo $_SESSION['pmc_usr_skin_url']; ?>favicon.ico" />
  <title><?php echo _APP_NAME . _APP_SEP . $title; ?></title>
  <meta name="title" content="<?php echo _APP_NAME . _APP_SEP . $title; ?>" />
  <meta name="subject" content="<?php echo _APP_NAME . _APP_SEP . $title; ?>" />
  <meta name="description" content="<?php echo _APP_NAME . _APP_SEP . $title; ?>" />
  <meta name="keywords" content="<?php echo _APP_NAME; ?>, pmc" />
  <meta name="copyright" content="&copy; 2008 Radu Maier" />
  <meta name="designer" content="Radu Maier" />
  <meta name="publisher" content="Radu Maier" />
  <meta name="author" content="Radu Maier" />
  <meta name="rating" content="General" />
  <meta name="distribution" content="Global" />
  <meta name="robots" content="Index, Follow" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <link rel="stylesheet" type="text/css" charset="utf-8" href="<?php echo $_SESSION['pmc_usr_skin_url']; ?>style.css" />
</head>
<body>
  <div id="layout">
    <div id="container_hdr">
      <div id="logo">
        <a href="<?php echo _APP_URL; ?>" title="<?php echo _APP_NAME; ?>"><img src="<?php echo $_SESSION['pmc_usr_skin_url']; ?>logo.png" title="<?php echo _APP_NAME; ?>" alt="<?php echo _APP_NAME; ?>"></a>
      </div>
      <div id="hdr">
        <div id="usr">
          <?php echo $mod_usr;?>
        </div>
        <div id="mnu0">
        {mnu0}
        </div>
        <div id="mnu1">
        {mnu1}
        </div>
      </div>
    </div>
    <div id="container_msg">
      <div id="msg">
        <?php echo $msg; ?>
      </div>
    </div>
    <div id="container_cnt">
      <div id="cnt_left">
        <?php echo $mod_login;?>
        <?php echo $mod_lst;?>
        <?php echo $mod_src;?>
        <?php echo $mod_imdb;?>
      </div>
      <div id="cnt_right">
        <?php echo $mod_sts;?>
        <?php echo $mod_gen;?>
      </div>
      <div id="cnt_page">
        <?php echo $page; ?>
      </div>
    </div>
    <div id="container_ftr">
      <div id="ftr">
        {FOOTER}
          <!--<pre>-->
          <?php //print_r($_SESSION); ?>
          <?php //print_r($_GET); ?>
          <?php //print_r($_SERVER); ?>
          <?php //print_r($_FILES); ?>
          <?php //print_r($_POST); ?>
          <?php //print_r(error_get_last()); ?>
          <!--</pre>-->
      </div>
    </div>
  </div>
</body>
</html>
