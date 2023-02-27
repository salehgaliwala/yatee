<?php


function admin_user_answer_message($content) {

    global $wpdb;
    global $current_user;
    get_currentuserinfo();
    
        include('admin_user_messages_settings.php');

	$table_name = $wpdb->prefix . 'admin_user_message';
	$table_users = $wpdb->prefix . 'users';  
    
    	if(isset($_POST['submitted'])) {
            $messageIdAnswer = $_POST['messageIdAnswer']; 
            $query = "SELECT * FROM $table_name WHERE auto = '$messageIdAnswer'";
            $result = mysql_query($query);
        }

      	if(isset($_POST['submittedAnswer'])) {
            $sender = $_POST['sender']; 
            $receiver = $_POST['receiver']; 
            $subject = $_POST['subject'];
            $answer = $_POST['answerTextarea'];
            $subjectOldAndNew = $_POST['subjectOldAndNew'];
            $todayDate = date('Y-m-d');
            $timestamp = time() + 3600;
            $timeSend = date("H:i:s",$timestamp);

            

            
            $query = "INSERT INTO $table_name (auto, sender, receiver, time, date, message, status, subject)
            VALUES ('','{$sender}','{$receiver}', '{$timeSend}', '{$todayDate}', '{$answer}', '0', '{$subjectOldAndNew}')";

            $wpdb->query($query);
		
	    echo "<span>" . $aum_term_msg_successfull_sent . "</span>";
            echo "<p>&nbsp;</p>";

	    
?>
    <script>
	function gotoInbox() {
	    document.location.href = "<?php echo 'http://' . $aum_btn_back_to_inbox; ?>";
	}
    </script>
<?php
            
            echo "<input type='button' class='aum_button' value='" . $aum_btn_back_to_inbox_text . "' onclick='gotoInbox();'>";
            echo "<p>&nbsp;</p>";
            
            $queryReceiverMail = "SELECT user_email FROM $table_users WHERE ID = '$receiver'";
            $resultReceiverMail = mysql_query($queryReceiverMail);
            
            while($rowReceiverMail = mysql_fetch_row($resultReceiverMail)) {
                
                $siteurl = site_url();
		$utext = utf8_decode($aum_mail_message);
                
                $mailtext = '
                                        
                                        
                        <head>
			    <title></title>
			</head>
			 
			 
			<style>
			    font-family:calibri, verdana, arial, helvetica;
			    font-size:14px;
			</style>
			
			<body>
			 
 
			 
			' . nl2br($utext) .'
			
			<br><br>
			
			<a href="' . $siteurl . '">' . $siteurl . '</a>
			 
			</body>
			</html>
                
                ';			
                                        
                $empfaenger = $rowReceiverMail[0]; //Mailadresse
		$absender   = $aum_mail_sender_mail;
		$betreff    = "Neue Nachricht auf " . $siteurl;
		$antwortan  = $aum_mail_sender_mail;
		 
		$header  = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
		 
		$header .= "From: $absender\r\n";
		$header .= "Reply-To: $antwortan\r\n";
		// $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
		$header .= "X-Mailer: PHP ". phpversion();
		 
		mail( $empfaenger,
		      $betreff,
		      $mailtext,
		      $header);                
                
                
                
                
                
                
                
                
            }
                    
        }

?>





    <script>
        
        function sendAnswerIntoDb() {
            
            //alert (document.getElementById("subjectOldAndNew").value);
            
            if (document.getElementById("subjectOldAndNew").value == '') {
                alert ('Bitte gib einen Betreff fuer Deine Nachricht an.');
                document.getElementById("subjectOldAndNew").focus();
                return;
            } else {
             	document.getElementById("sender").value = '<?php echo $current_user->ID; ?>';
                //document.getElementById("receiver").value = '<?php echo $receiverNew; ?>';
                document.getElementById("subject").value = '<?php echo $subjectName ?>';
                document.sendAnswerIntoDbForm.submit();   
            }
        }
        
    </script>




    
    <form name="sendAnswerIntoDbForm" action="<?php the_permalink(); ?>" method="post">
        <input type="hidden" name="sender" id="sender" value="">
        <input type="hidden" name="receiver" id="receiver" value="">
        <input type="hidden" name="subject" id="subject" value="">
	<input type="hidden" name="submittedAnswer" id="submittedAnswer" value="true">
        

    
    
    
<?php
    	if(isset($_POST['submitted'])) {
?>        
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

                            while($row = mysql_fetch_row($result)) {
                                    $querySender = "SELECT user_nicename FROM $table_users WHERE ID = '$row[1]'";
				    $resultSender = mysql_query($querySender);
                                    $subjectName = $row[7];
                                    $receiverNew = $row[1];
                                    //echo "test: " . $receiverNew;
?>
<script>
	    document.getElementById("receiver").value = '<?php echo $receiverNew; ?>';
</script>

<?php
                                    
                                    
                                    
                                    

                                        while($rowSender = mysql_fetch_row($resultSender)) {
                                                echo $aum_term_msg_from . ": ";
                                                echo $rowSender[0];
                                                $senderName = $rowSender[0];
                                        }
                                        
                                        echo "<br>";
                                        echo $aum_term_sent_date . ": ";
                                        
                                        $d    =    explode("-",$row[4]);
                                        echo $d[2] . "." . $d[1] . "." . $d[0];
                                        echo " - " . $row[3];
                                                                
                                        echo "<br><br>";
                                        
                                        $row7input = htmlspecialchars($row[7]);
                                        //$row7input2 = htmlentities($row7input);
                                        //echo $row7input;
                                       
                                        //echo "Betreff: <input type=text name=subjectOldAndNew id=subjectOldAndNew value=" . $row[7] . ">";
                                        echo $aum_term_subject . ": <input type=text name=subjectOldAndNew id=subjectOldAndNew value='' class=aum_text>";
                                        echo "<br>";
                                        echo $aum_term_msg . ":<br>";
                                        echo "<textarea class=aum_text cols=80 rows=10 style=width:100% name=answerTextarea id=answerTextarea>";
                                        echo "--- " . $aum_term_msg . " ---\n";
                                        echo $aum_term_subject . ": " . $row[7] . "\n";
                                        echo $aum_term_sent_date . ": ";
                                        $d    =    explode("-",$row[4]);
                                        echo $d[2] . "." . $d[1] . "." . $d[0];
                                        echo " um " . $row[3] . "\n";
                                        echo "Gesendet von: " . $senderName . "\n\n";
                                        $utext = str_replace("<br />", "<br />\n", $row[5]);
                                        echo $utext;
                                        echo "</textarea><br>";
                                        echo "<input type=button class='aum_button' value='" . $aum_btn_send_answer_text . "' onclick='sendAnswerIntoDb();'>";
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
?>






<?php
}
add_shortcode( 'admin_user_answer_message', 'admin_user_answer_message' );
?>