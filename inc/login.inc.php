<?php
if (isset($_POST['usr_login']) && isset($_POST['usr_pass'])) {
    if (block_tags(trim($_POST['usr_login'])) != '' && block_tags(trim($_POST['usr_pass'])) != '') {
        $usr_login = block_tags(trim($_POST['usr_login']));
        $usr_pass  = block_tags(trim($_POST['usr_pass']));
        $query_verif = "SELECT * FROM `pmc_set_usr` WHERE `usr_login` = '$usr_login' AND `usr_pass` = '$usr_pass' LIMIT 1";
        $rst_verif   = mysql_query($query_verif) or die('Oups!<br>' . mysql_error());
        if (mysql_num_rows($rst_verif) == 1) {
            $row_rst_verif = mysql_fetch_assoc($rst_verif);
            
            if ($row_rst_verif['usr_status'] == '0') {
                $user_login_status = 'this account is disabled';
            } // suspended account
            else {
                $_SESSION['logged_in']      = true;
                $_SESSION['usr_id']         = $row_rst_verif['usr_id'];
                $_SESSION['usr_level']      = $row_rst_verif['usr_level'];
                $_SESSION['people_id']      = $row_rst_verif['people_id'];
                $theme_id                   = $row_rst_verif['theme_id'];
                $_SESSION['usr_lang_index'] = $row_rst_verif['lang_index'];
                
                $query_usr_theme = "SELECT * FROM `pmc_set_themes` WHERE `theme_id` = '".$theme_id."'";
                $rst_usr_theme   = mysql_query($query_usr_theme) or die('Oups!<br>' . mysql_error());
                $row_usr_theme   = mysql_fetch_assoc($rst_usr_theme);
                $_SESSION['usr_theme_name']  = $row_usr_theme['theme_name'];
                $_SESSION['usr_theme_dir']   = $row_usr_theme['theme_dir'];
                $_SESSION['usr_theme_notes'] = $row_usr_theme['theme_notes'];
                mysql_free_result($rst_usr_theme);

            
                // get user data
                $query_user_data = "SELECT * FROM `pmc_set_people` WHERE `people_id` = '".$_SESSION['people_id']."' LIMIT 1";
                $rst_user_data   = mysql_query($query_user_data) or die ('Oups!<br>' . mysql_error());
                if (mysql_num_rows($rst_user_data) == 1) {
                    $row_user_data = mysql_fetch_assoc($rst_user_data);
                    $_SESSION['user_name']  = $row_user_data['people_first_name'] . '&nbsp;' . $row_user_data['people_last_name'];
                    $_SESSION['user_alias'] = $row_user_data['people_nick_name'];
                } 
                else {die('can not find this person');}
                mysql_free_result($rst_user_data);
            
                // get and update current login info
                $query_last_login_id            = "SELECT MAX(login_id) FROM `pmc_var_logins` WHERE `usr_id` = '".$_SESSION['usr_id']."'";
                $rst_last_login_id              = mysql_query($query_last_login_id) or die('Oups!<br>' . mysql_error());
                $_SESSION['user_last_login_id'] = mysql_result($rst_last_login_id, 0);
                mysql_free_result($rst_last_login_id);
                
                $query_last_login = "SELECT `login_date`, `login_time` FROM `pmc_var_logins` WHERE `login_id` = '".$_SESSION['user_last_login_id']."' LIMIT 1";
                $rst_last_login   = mysql_query($query_last_login) or die ('Oups!<br>' . mysql_error());
                if (mysql_num_rows($rst_last_login) == 1) {
                    $row_last_login = mysql_fetch_assoc($rst_last_login);
                    $_SESSION['user_last_login_date'] = $row_last_login['login_date'];
                    $_SESSION['user_last_login_time'] = $row_last_login['login_time'];
                }
                else {  // first login
                    $_SESSION['user_last_login_id']   = '0';
                    $_SESSION['user_last_login_date'] = '0000-00-00';
                    $_SESSION['user_last_login_time'] = '00:00:00';
                }
                mysql_free_result($rst_last_login);
            
                // total logins
                $query_total_logins            = "SELECT COUNT(`login_id`) FROM `pmc_var_logins` WHERE `usr_id` = '".$_SESSION['usr_id']."'";
                $rst_total_logins              = mysql_query($query_total_logins) or die('Oups!<br>' . mysql_error());
                $_SESSION['user_total_logins'] = (mysql_result($rst_total_logins, 0)) + 1;
                mysql_free_result($rst_total_logins);

                // insert new login info
                if (isset($_SERVER['REMOTE_ADDR'])) {$statsip = $_SERVER['REMOTE_ADDR'];} else {$statsip = 'n/a';}
                $query_rstStatsId = "SELECT MAX(`stats_id`) FROM `pmc_var_stats` WHERE `stats_ip` = '".$statsip."' AND `stats_date` = '".$_SESSION['visit_date']."' AND `stats_time` = '".$_SESSION['visit_time']."' LIMIT 1";
                $rstStatsId       = mysql_query($query_rstStatsId) or die('Oups!<br>' . mysql_error());
                $stats_id         = mysql_result($rstStatsId, 0);
                mysql_free_result($rstStatsId);
            
                $query_rstId  = "SELECT MAX(login_id) FROM `pmc_var_logins`";
                $rstId        = mysql_query($query_rstId) or die('Oups!<br>' . mysql_error());
                $new_login_id = (mysql_result($rstId, 0)) + 1;
                mysql_free_result($rstId);

                $query_new_login = "INSERT INTO `pmc_var_logins` (login_id, usr_id, login_date, login_time, stats_id) VALUES ('".$new_login_id."', '".$_SESSION['usr_id']."', '".$_SESSION['visit_date']."', '".$_SESSION['visit_time']."', '".$stats_id."')";
                $rst_visits      = mysql_query($query_new_login) or die('Oups!<br>' . mysql_error());
        
                $user_login_status = 'login ok';
            }
        } // if match
        else { 
            $user_login_status = 'no match'; 
        } // else, not match
        mysql_free_result($rst_verif);
    } //if usr & pass
    else {
        $user_login_status = 'empty strings';
    } // usr and pass empty strings
} //if login submitted
else {
    $user_login_status = 'not submitted';
} //if login NOT submitted
?>