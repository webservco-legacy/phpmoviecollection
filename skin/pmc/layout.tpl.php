<?php echo '<?xml version="1.0" encoding="utf-8" standalone="no"?>'."\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_SESSION['pmc_usr_lang']; ?>" lang="<?php echo $_SESSION['pmc_usr_lang']; ?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="content-language" content="<?php echo $_SESSION['pmc_usr_lang']; ?>" />
  <link rel="icon" type="image/ico" href="<?php echo $_SESSION['pmc_usr_skin_url']; ?>favicon.ico" />
  <link rel="shortcut icon" type="image/ico" href="<?php echo $_SESSION['pmc_usr_skin_url']; ?>favicon.ico" />
  <title><?php echo _APP_NAME . _APP_SEP . $title; ?></title>
  <meta name="title" content="<?php echo _APP_NAME . _APP_SEP . $title; ?>" />
  <meta name="subject" content="<?php echo _APP_NAME . _APP_SEP . $title; ?>" />
  <meta name="description" content="<?php echo _APP_NAME . _APP_SEP . $title; ?>" />
  <meta name="keywords" content="<?php echo _APP_NAME; ?>, pmc" />
  <meta name="copyright" content="<?php echo _APP_AUTH; ?>" />
  <meta name="designer" content="<?php echo _APP_AUTH; ?>" />
  <meta name="publisher" content="<?php echo _APP_AUTH; ?>" />
  <meta name="author" content="<?php echo _APP_AUTH; ?>" />
  <meta name="rating" content="General" />
  <meta name="distribution" content="Global" />
  <meta name="robots" content="Index, Follow" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <link rel="stylesheet" type="text/css" charset="utf-8" href="<?php echo $_SESSION['pmc_usr_skin_url']; ?>style.css" />
</head>
<body>

<div id="layout">

  <div id="container_hdr">
    <div id="header">
      <div id="logo">
        <a href="<?php echo _APP_URL; ?>" title="<?php echo _APP_NAME; ?>"><img src="<?php echo $_SESSION['pmc_usr_skin_url']; ?>graphics/logo.jpg" title="<?php echo _APP_NAME; ?>" alt="<?php echo _APP_NAME; ?>" /></a>
      </div>
      <div id="hdr">
        <div id="usr"><?php echo $mod_usr;?></div>
        <div id="mnu0"><?php echo $mod_apptt; ?></div>
        <div id="mnu1"><?php echo $mod_mnu; ?></div>
      </div>
    </div>
  </div>
  
  <div id="container_msg">
    <div id="msg"><div id="message"><?php echo $msg; ?></div></div>
  </div>

  <div id="container_cnt">
    <div class="colmask">
      <div class="colmid">
        <div class="colleft">
          <div class="col1wrap">
            <div class="col1">
              <?php echo $page; ?>
            </div>
          </div>
          <div class="col2">
            <?php echo $mod_login;?>
            <?php echo $mod_lst;?>
            <?php echo $mod_src;?>
            <?php echo $mod_imdb;?>
            <?php echo $mod_adm;?>
          </div>
          <div class="col3">
            <?php echo $mod_sts;?>
            <?php echo $mod_gen;?>
    			</div>
    		</div>
    	</div>
    </div>
    <div id="clear"></div>
  </div>

  <div id="container_ftr">
    <div id="footer">
      <?php echo _APP_NAME; ?>&#160;<?php echo _APP_CPY; ?>
    </div>
  </div>

</div>
</body>
</html>