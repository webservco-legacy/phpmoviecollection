<?php if (!isset($_SESSION['logged_in'])) { ?>
not logged  in
<?php } 
else { ?>
show all, but active according to rights, and bold current selection<BR>
<A CLASS="menu_0_0" HREF="<?=PMC_ROOT?>index.php">Home</A> |
<A CLASS="menu_0_0" HREF="<?=PMC_ROOT?>help.php">Help</A> |
<A CLASS="menu_0_0" HREF="<?=PMC_ROOT?>about.php">About</A>
<BR>
<A CLASS="menu_0_0" HREF="<?=PMC_ROOT?>pmc.php">PMC Database</A> |
<BR>
<A CLASS="menu_1_0">All Collections</A> |
<BR>
<A CLASS="menu_2_0">My Collection</A> |
<A CLASS="menu_2_0">My Discs</A> |
<A CLASS="menu_2_0">Loans</A> |
<A CLASS="menu_2_0">Stats</A> |
<A CLASS="menu_2_0">Settings</A> |
<A CLASS="menu_2_0">Add/(edit)</A>
<BR>
<A CLASS="menu_3_0">Users Admin</A> |
<A CLASS="menu_3_0">PMC Admin</A> |
<A CLASS="menu_3_0">Database admin</A> |
<A CLASS="menu_3_0">Themes</A>
<?php } ?>