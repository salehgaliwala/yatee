<?php


function admin_user_messages_write_message($content) {

    global $wpdb;
    global $current_user;
    get_currentuserinfo();
    $role = get_user_role();
    
        include('admin_user_messages_settings.php');    
     
    $table_name = $wpdb->prefix . 'admin_user_message';
    $table_users = $wpdb->prefix . 'users';
     
	if(isset($_POST['submitted'])) {
		$fromSender = $_POST['fromSender'];
		$toReceiver = $_POST['toReceiver'];
		$subject = $_POST['subject'];
		$messagetext = $_POST['messagetext'];
		$todayDate = date('Y-m-d');
		$timestamp = time() + 3600;
		$timeSend = date("H:i:s",$timestamp); 
		
		$query = "INSERT INTO $table_name (auto, sender, receiver, time, date, message, status, subject)
		VALUES ('','{$fromSender}','{$toReceiver}', '$timeSend', '{$todayDate}', '$messagetext', '0', '$subject')";

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
		
	}
	
	if(!isset($_POST['submitted'])) {
		
		
		$queryReceiverMail = "SELECT user_email FROM $table_users WHERE ID = '$toReceiver'";
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
?>    


	<script>
		
		function setReceiver (x) {
			document.getElementById("toReceiver").value = x;
		}

		function sendMessage () {
			if (document.getElementById("toReceiver").value == '') {
				alert ("Es ist noch kein Empfaenger angeben.");
				document.getElementById("toReceiver").focus();
				return;
			}
			if (document.getElementById("subject").value == '') {
				alert ("Es ist noch kein Betreff angeben.");
				document.getElementById("subject").focus();
				return;
			}
			if (document.getElementById("messagetext").value == '') {
				alert ("Es ist noch keine Nachricht angeben.");
				document.getElementById("messagetext").focus();
				return;
			}
			document.writeMessage.submit();
		}
		
	</script>



 
    <form name="writeMessage" action="<?php the_permalink(); ?>" method="post">		
<?php
	if ($role == 'administrator' ) {
?>
        <input type="hidden" value="" id="toReceiver" name="toReceiver">
<?php
	} else {	
?>
        <input type="hidden" value="1" id="toReceiver" name="toReceiver">	
<?php
	}
?>				
	<input type="hidden" value="<?php echo $current_user->ID; ?>" id="fromSender" name="fromSender">
	<input type="hidden" name="submitted" id="submitted" value="true" />


				
		<table border="0" cellpadding="5" cellspacing="5">
			
			<tr>
				<td><a href="<?php echo 'http://' . $aum_btn_back_to_inbox; ?>"><?php echo $aum_term_link_inbox; ?></a> | <span class="nav_strong"><?php echo $aum_term_link_post_a_message; ?></span> | <a href="<?php echo 'http://' . $aum_btn_back_to_send_msg; ?>"><?php echo $aum_term_link_sent_messages; ?></a></td>
			
			</tr>
			
			
			<tr valign="top">
 
				<td>				
					<table border="0" cellpadding="0" cellspacing="0">
						<tr valign="top">
							<td><?php echo $aum_term_to; ?>: </td>
							<td></td>
							<td>
<?php


 



								if( current_user_can('administrator') ) {
?>
									<select style="width:40%" id="userselection" name="usersselection" size="5" onclick="setReceiver(this.value);">							
<?php   
									
									//displays users
									
									/*$blogusers = get_users_of_blog();
									if ($blogusers) {
									  foreach ($blogusers as $bloguser) {
									    $user = get_userdata($bloguser->user_id);
									    echo '<option value=' . $user->ID . '>' . $user->display_name . '</option>';
									  }
									}
									*/
									
									
									
									$blogusers = get_users('blog_id=1&orderby=nicename&role=subscriber');
									foreach ($blogusers as $user) {
									    echo '<option value=' . $user->ID . '>' . $user->display_name . '</option>';
									    
									}
									
    
?>
							
							
							
							
							
									
<?php
								} else {
									// "Michael Karsten";
?>
									<select style="width:40%" class='aum_text' id="userselection" name="usersselection" size="5" onclick="setReceiver(this.value);">	
<?php
									$admin = get_users('blog_id=1&orderby=nicename&role=administrator');
									foreach ($admin as $auser) {
									    echo '<option value=' . $auser->ID . '>' . $auser->display_name . '</option>';
									    
									}
								}
?>
							</select>
							</td>
						</tr>
						<tr valign="top">
							<td><?php echo $aum_term_subject; ?>:</td>
							<td></td>
							<td><input type="text" class='aum_text' value="" id="subject" name="subject" style="width:70%"></td>
						</tr>
						<tr valign="top">
							<td><?php echo $aum_term_msg; ?>:</td>
							<td></td>
							<td><textarea name="messagetext" id="messagetext" class='aum_text' cols="80" rows="10" style="width:100%"></textarea></td>
						</tr>
						<tr valign="top">
							<td>&nbsp;</td>
							<td colspan="2"><input type="button" class='aum_button' value="<?php echo $aum_btn_send_msg_text; ?>" onclick="sendMessage();"></td>
						</tr>
					</table>					
					
				</td>
			</tr>
		</table>		
    </form>
    
<?php
	}
}
add_shortcode( 'admin_user_messages_write_message', 'admin_user_messages_write_message' );
?>