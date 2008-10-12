<h1><?php echo $lang['usr']['view']; ?></h1>

<div class="clearer"></div>
<div class="dname"><?php echo $lang['usr']['name']; ?></div><div class="dvalue"><?php echo $cnt['usr_name']; ?>&#160;(<?php echo $cnt['usr_fname']; ?>&#160;<?php echo $cnt['usr_lname']; ?>)</div>

<div class="clearer"></div>
<div class="dname"><?php echo $lang['skin']['skin']; ?></div><div class="dvalue"><?php echo $cnt['usr_skin']; ?></div>

<div class="clearer"></div>
<div class="dname"><?php echo $lang['pmc']['language']; ?></div><div class="dvalue"><?php echo $cnt['usr_lang']; ?></div>

<div class="clearer"></div>
<div class="dname"><?php echo $lang['usr']['status']; ?></div><div class="dvalue"><?php echo $lang['usr']['stat'][$cnt['usr_status']]; ?></div>