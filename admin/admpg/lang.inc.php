<?php $langs = lsdir(LN_DIR); ?>
<DIV CLASS="pg_title">
<?=$lnMChangeLang?>
</DIV>
<BR>
<DIV CLASS="pg_subtitle">
<?=$lnTotalLangs?>:&nbsp;<?=count($langs)?>
</DIV>
<BR>
<?php for ($i=1; $i <= count($langs); $i++) { ?>
<DIV CLASS="lang_div">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" ALIGN="center">
<TR>
    <TD CLASS="lang_td_1">
        <?php
        $this_l_index      = $lnNoInfo;
        $this_l_name       = $lnNoInfo;
        $this_l_local_name = $lnNoInfo;
        $this_l_translator = $lnNoInfo;
        $this_l_charset    = $lnNoInfo;
        if (is_file(LN_DIR . $langs[$i] . '/' . $langs[$i] . '.info.php')) { 
            require LN_DIR . $langs[$i] . '/' . $langs[$i] . '.info.php';
            $this_l_index      = $LangIndex;
            $this_l_name       = $LangName;
            $this_l_local_name = $LangLocalName;
            $this_l_translator = $LangTranslator;
            $this_l_charset    = $LangCharset;
        }
        ?>
        <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" ALIGN="center">
        <TR>
            <TD CLASS="lang_td_1_1">
                <?=$lnLnIndex?>:&nbsp
            </TD>
            <TD CLASS="lang_td_1_2">
                <?=$langs[$i]?>
            </TD>
        </TR>
        <TR>
            <TD CLASS="lang_td_1_1">
                <?=$lnLnName?>:&nbsp
            </TD>
            <TD CLASS="lang_td_1_2">
                <?=$this_l_name?>
            </TD>
        </TR>
        <TR>
            <TD CLASS="lang_td_1_1">
                <?=$lnLnLocalName?>:&nbsp
            </TD>
            <TD CLASS="lang_td_1_2">
                <?=$this_l_local_name?>
            </TD>
        </TR>
        <TR>
            <TD CLASS="lang_td_1_1">
                <?=$lnLnTranslator?>:&nbsp
            </TD>
            <TD CLASS="lang_td_1_2">
                <?=$this_l_translator?>
            </TD>
        </TR>
        <TR>
            <TD CLASS="lang_td_1_1">
                <?=$lnLnCharset?>:&nbsp
            </TD>
            <TD CLASS="lang_td_1_2">
                <?=$this_l_charset?>
            </TD>
        </TR>
        </TABLE>
        <BR>
        &#91;&nbsp;<?php if($langs[$i] == $_SESSION['usr_lang_index']) {echo $lnCurrentLang;} else {echo '<A CLASS="default" HREF="' . ADM_URL . 'my_set.php?action=lang&amp;ln=' . $langs[$i] . '">' . $lnSelect . '</A>';}?>&nbsp;&#93;
    </TD>
</TR>
</TABLE>
</DIV>
<?php } ?>
<BR CLEAR="both">