<?php $themes = lsdir(THEME_DIR); ?>
<DIV CLASS="pg_title">
<?=$lnMChangeTheme?>
</DIV>
<BR>
<DIV CLASS="pg_subtitle">
<?=$lnTotalThemes?>:&nbsp;<?=count($themes)?>
</DIV>
<BR>
<?php for ($i=1; $i <= count($themes); $i++) { ?>
<DIV CLASS="thm_div">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" ALIGN="center">
<TR>
    <TD CLASS="thm_td_1">
        <?php
        $this_name    = $lnNoInfo;
        $this_version = $lnNoInfo;
        $this_author  = $lnNoInfo;
        $this_notes   = $lnNoInfo;
        if (is_file(THEME_DIR . $themes[$i] . '/' . $themes[$i] . '.info.php')) { 
            require THEME_DIR . $themes[$i] . '/' . $themes[$i] . '.info.php';
            $this_name    = $theme_name;
            $this_version = $theme_version;
            $this_author  = $theme_author;
            $this_notes   = $theme_notes;
            
        }
        ?>
        <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" ALIGN="center">
        <TR>
            <TD CLASS="thm_td_1_1">
                <?=$lnThDir?>:&nbsp
            </TD>
            <TD CLASS="thm_td_1_2">
                <?=$themes[$i]?>
            </TD>
        </TR>
        <TR>
            <TD CLASS="thm_td_1_1">
                <?=$lnThName?>:&nbsp
            </TD>
            <TD CLASS="thm_td_1_2">
                <?=$this_name?>
            </TD>
        </TR>
        <TR>
            <TD CLASS="thm_td_1_1">
                <?=$lnThVersion?>:&nbsp
            </TD>
            <TD CLASS="thm_td_1_2">
                <?=$this_version?>
            </TD>
        </TR>
        <TR>
            <TD CLASS="thm_td_1_1">
                <?=$lnThAuthor?>:&nbsp
            </TD>
            <TD CLASS="thm_td_1_2">
                <?=$this_author?>
            </TD>
        </TR>
        <TR>
            <TD CLASS="thm_td_1_1">
                <?=$lnThNotes?>:&nbsp
            </TD>
            <TD CLASS="thm_td_1_2">
                <?=$this_notes?>
            </TD>
        </TR>
        </TABLE>
        <BR>
        &#91;&nbsp;<?php if($themes[$i] == $_SESSION['usr_theme_dir']) {echo $lnCurrentTheme;} else {echo '<A CLASS="default" HREF="' . ADM_URL . 'my_set.php?action=thm&amp;theme=' . $themes[$i] . '">' . $lnSelect . '</A>';}?>&nbsp;&#93;
    </TD>
</TR>
<TR>
    <TD CLASS="thm_td_2">
        <?php if (is_file(THEME_DIR . $themes[$i] . '/theme.png')) { ?>
        <IMG SRC="<?=THEME_URL . $themes[$i] . '/theme.png'?>" WIDTH="200" HEIGHT="150" BORDER="0" HSPACE="0" VSPACE="0" />
        <?php } else { ?>
        <IMG SRC="<?=INC_URL?>image.php?picture=blank&amp;old_width=10&amp;old_height=10&amp;new_width=200&amp;new_height=150&amp;fontSize=<?=$defaultFontGDSize?>&amp;fontFace=<?=$defaultFontGDFace?>&amp;x_f=50&amp;y_f=50&amp;color1=0x00&amp;color2=0x00&amp;color3=0x00&amp;text=<?=$lnNoImageGD?>" WIDTH="200" HEIGHT="150" BORDER="0" HSPACE="0" VSPACE="0" />
        <?php } ?>
    </TD>
</TR>
</TABLE>
</DIV>
<?php } ?>
<BR CLEAR="both">