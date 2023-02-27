<?php

 

function admin_user_read_message($content) {
    global $wpdb;
    global $current_user;
    get_currentuserinfo();
    
        include('admin_user_messages_settings.php');

	$table_name = $wpdb->prefix . 'admin_user_message';
	$table_users = $wpdb->prefix . 'users';  
    
	if(isset($_POST['submitted'])) {
            $messageId = $_POST['messageId'];
            
            $query = "SELECT * FROM $table_name WHERE auto = '$messageId'";
            //echo $query;
            $result = $wpdb->get_results($query);
            
            
	    $_referer = $_SERVER["HTTP_REFERER"];
	   // echo $_referer;
	    if ($_referer == 'http://<?php echo $aum_btn_read_message ?>') {
		//do nothing
	    } else {
		$querySetReadStatus = "UPDATE $table_name SET status='1'  WHERE auto='$messageId'";

		//$resultSetReadStatus = mysql_query($querySetReadStatus);		
       $resultSetReadStatus = $wpdb->query($wpdb->prepare($querySetReadStatus));
	    }


	    
	    

                                    
        }
?>

    <script>
        
        function sendAnswerMessage() {
            document.getElementById("messageIdAnswer").value = "<?php echo $messageId ?>";
            document.sendAnswerMessageForm.submit();
        }
        
    </script>
    
    <form name="sendAnswerMessageForm" action="http://<?php echo $aum_btn_answer_message?>" method="post">
        <input type="hidden" name="messageIdAnswer" id="messageIdAnswer" value="">
        <input type="hidden" name="submitted" id="submitted" value="true">
            
    </form>
        
    <table border="0" cellpadding="0" cellspacing="0">
	
	
		<tr>
			<td><a href="<?php echo 'http://' . $aum_btn_back_to_inbox; ?>"><?php echo $aum_term_link_inbox; ?></a> | <a href="<?php echo 'http://' . $aum_btn_post_message; ?>"><?php echo $aum_term_link_post_a_message; ?></a> | <a href="<?php echo 'http://' . $aum_btn_back_to_send_msg; ?>"><?php echo $aum_term_link_sent_messages; ?></a></td>
			
		</tr>
	
	
	
        <tr valign="top">
 
 
            <td>
                <table border="0" cellpadding="0" cellspacing="0">
 
                    <tr valign="top">
                        <td>
                            
                            

                                
                                

                            
                            
<?php                        
                            foreach ($results as $row){
                            
                                    $querySender = "SELECT user_nicename FROM $table_users WHERE ID = '$row[1]'";
				                    $resultSender = $wpdb->get_results($querySender);                                        
                                        while($resultSender= mysql_fetch_row($resultSender)) {
                                                echo $aum_term_msg_from . ": ";
                                                echo $rowSender[0];
                                        }
                                        
                                        echo "<br>";
                                        echo $aum_term_sent_date . ": ";
                                        
                                        $d    =    explode("-",$row[4]);
                                        echo $d[2] . "." . $d[1] . "." . $d[0];
                                        echo " - " . $row[3];
                                                                
                                        echo "<br><br>";
                                        echo $aum_term_subject . ": " . $row[7];
                                        echo "<br><br>";
                                        echo $aum_term_msg . ": <br>";
                                        echo "<form>";
                                        echo "<textarea cols=80 rows=10 class='aum_text' readonly style=width:100% id=messagetext>";
                                        $utext = str_replace("<br />", "<br />\n", $row[5]);
                                        echo $utext;
                                        echo "</textarea><br>";


					    $_referer = $_SERVER["HTTP_REFERER"];
					    $compare_ref = "http://" . $aum_btn_back_to_send_msg;
					 
					    if ($_referer == $compare_ref) {
 
						echo "<input type=button class='aum_button' value='" . $aum_btn_back_to_inbox_text . "' onclick='history.back(-1);'>";
					    } else {
						echo "<input type=button class='aum_button' value='" . $aum_btn_send_answer_text . "' onclick='sendAnswerMessage();'>";
					    }
					    
					echo "</form>";
					
			
					    
                            }
?>




                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>    
        
        
        
        
        
<?php        
}
add_shortcode( 'admin_user_read_message', 'admin_user_read_message' );
?>