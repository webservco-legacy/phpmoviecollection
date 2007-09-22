<DIV CLASS="user">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
<TR>
    <TD>
        <?=$lnWelcome?>&nbsp;<?=$_SESSION['user_alias']?>!&nbsp;
    </TD>
    <TD>
<?php if (!isset($_SESSION['logged_in'])) { ?>
        <FORM ENCTYPE="multipart/form-data" CLASS="login_form" NAME="login_form" ID="login_form" ACTION="" METHOD="post">
        <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
        <TR>
            <TD>
            &nbsp;
            </TD>
            <TD>
                <INPUT TYPE="text" CLASS="login_box" NAME="usr_login" ID="usr_login" SIZE="10" MAXLENGTH="20" VALUE="" />
            </TD>
            <TD>
                <INPUT TYPE="password" CLASS="login_box" NAME="usr_pass" ID="usr_pass" SIZE="10" MAXLENGTH="20" VALUE="" />
            </TD>
            <TD>
                <INPUT TYPE="submit" CLASS="login_button" NAME="login" ID="login" VALUE="login">
            </TD>
        </TR>
        </TABLE>
        </FORM>
<?php } 
else { ?>
<A CLASS="default" HREF="<?=PMC_ROOT?>logout.php">logout</A>
<?php } ?>
    </TD>
</TR>
</TABLE>
</DIV>