<?PHP

    global $wpdb;
    
    $table_name_settings = $wpdb->prefix . 'admin_user_message_settings';
    
    
    
    $querySettings = "SELECT * FROM $table_name_settings";
    $resultSettings = mysql_query($querySettings);
    
    $num_rowsSettings = mysql_num_rows($resultSettings);
    if ($num_rowsSettings >= '1') {
        while($rowSettings = mysql_fetch_object($resultSettings)) {
            if ($rowSettings->item == 'table_color_header') {
                $aum_tablecolorheader = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'term_quantity_message') {
                $aum_term_quantity_message = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'term_page') {
                $aum_term_page = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'term_From') {
                $aum_term_From = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'term_subject') {
                $aum_term_subject = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'term_received') {
                $aum_term_received = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'term_time') {
                $aum_term_time = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'btn_answer_msg') {
                $aum_btn_answer_msg = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'term_msg_from') {
                $aum_term_msg_from = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'term_msg') {
                $aum_term_msg = $rowSettings->value;
            }
         
            if ($rowSettings->item == 'term_msg_successfull_sent') {
                $aum_term_msg_successfull_sent = $rowSettings->value;
            }
        
            if ($rowSettings->item == 'term_sent_date') {
                $aum_term_sent_date = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'term_to') {
                $aum_term_to = $rowSettings->value;
            }

            if ($rowSettings->item == 'term_link_inbox') {
                $aum_term_link_inbox = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'term_link_post_a_message') {
                $aum_term_link_post_a_message = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'term_link_sent_messages') {
                $aum_term_link_sent_messages = $rowSettings->value;
            }
            
            
//Buttons / http-paths
            if ($rowSettings->item == 'btn_back_to_send_msg') {
                $aum_btn_back_to_send_msg = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'btn_send_answer_text') {
                $aum_btn_send_answer_text = $rowSettings->value;
            }
            
             if ($rowSettings->item == 'btn_post_message') {
                $aum_btn_post_message = $rowSettings->value;
            }           
            
            if ($rowSettings->item == 'btn_send_msg_text') {
                $aum_btn_send_msg_text = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'btn_back_to_inbox_text') {
                $aum_btn_back_to_inbox_text = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'btn_back_to_inbox') {
                $aum_btn_back_to_inbox = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'btn_read_message') {
                $aum_btn_read_message = $rowSettings->value;
            }

            if ($rowSettings->item == 'btn_answer_message') {
                $aum_btn_answer_message = $rowSettings->value;
            }
                        
//Mail settings
            if ($rowSettings->item == 'mail_sender') {
                $aum_mail_sender = $rowSettings->value;
            }

            if ($rowSettings->item == 'mail_sender_mail') {
                $aum_mail_sender_mail = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'mail_subject') {
                $aum_mail_subject = $rowSettings->value;
            }
            
            if ($rowSettings->item == 'mail_message') {
                $aum_mail_message = $rowSettings->value;
            }            
            
            
        }
    }

?>