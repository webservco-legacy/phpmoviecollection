<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="content-language" content="en" />
  <link rel="icon" type="image/ico" href="<?php echo _APP_URL . 'skin/' . _APP_SKIN . '/'; ?>favicon.ico" />
  <link rel="shortcut icon" type="image/ico" href="<?php echo _APP_URL . 'skin/' . _APP_SKIN . '/'; ?>favicon.ico" />
  <title><?php echo _APP_NAME . _APP_SEP . $title; ?></title>
  <meta name="title" content="Title" />
  <meta name="subject" content="Subject" />
  <meta name="description" content="Description" />
  <meta name="keywords" content="key, words" />
  <meta name="copyright" content="&copy; 2008 RudiSoft.Net" />
  <meta name="designer" content="Radu Maier" />
  <meta name="publisher" content="RudiSoft.Net" />
  <meta name="author" content="Radu Maier" />
  <meta name="rating" content="General" />
  <meta name="distribution" content="Global" />
  <meta name="robots" content="Index, Follow" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <link rel="stylesheet" type="text/css" charset="utf-8" href="<?php echo _APP_URL . 'skin/' . _APP_SKIN . '/'; ?>style.css" />
</head>
<body>
  <div id="layout">
    <div id="container_hdr">
      <div id="logo">
        {LOGO}
      </div>
      <div id="hdr">
        <div id="usr">
          <?php echo $mod_usr;?>
        </div>
        {HEADER}
      </div>
    </div>
    <div id="container_msg">
      <div id="msg">
        <?php echo $msg; ?>
      </div>
    </div>
    <div id="container_cnt">
      <div id="cnt_left">
        {LEFT}
      </div>
      <div id="cnt_right">
        {RIGHT}
        <div id="mod_test">
        {TEST MODULE}
        </div>
      </div>
      <div id="cnt_page">
        <?php echo $page; ?>
      </div>
    </div>
    <div id="container_ftr">
      <div id="ftr">
        {FOOTER}
      </div>
    </div>
  </div>
  <pre>
  <?php //print_r($_SESSION); ?>
  <?php //print_r($_GET); ?>
  <?php //print_r($_SERVER); ?>
  <?php //print_r($_FILES); ?>
  <?php //print_r($_POST); ?>
  <?php print_r(error_get_last()); ?>
  </pre>
</body>
</html>
