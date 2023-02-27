<?php

 

function admin_user_messages_inbox($content) {

    global $wpdb;
    global $current_user;
    get_currentuserinfo();
   
   
    include('admin_user_messages_settings.php');
    
    $role = get_user_role();


    $table_name = $wpdb->prefix . 'admin_user_message';
    $table_users = $wpdb->prefix . 'users';    

    if(isset($_POST['pageingSubmitted'])) {
    
	$actualPageOrg = $_POST['actualPage'];
	$userid = $_POST['userid'];
	$actualPage = $actualPageOrg-1;		
	$actualPage = $actualPage * 10;
	$query = "SELECT * FROM $table_name where receiver = '$userid' ORDER BY date DESC, time DESC limit $actualPage,10";
	$result = mysql_query($query);
    } else {
	$query = "SELECT * FROM $table_name WHERE receiver = '$current_user->ID' ORDER BY date DESC, time DESC limit 0,10";
	$result = mysql_query($query);
	$firstCall = "true";
    }
    	$num_rows = mysql_num_rows($result);
	
	/*
	if(!$num_rows) {
	  echo "Folgender Fehler trat bei der Abfrage auf: ".mysql_error();
	}
	*/
    	$queryPageingObject = "SELECT * FROM $table_name WHERE receiver = '$current_user->ID' ORDER BY date DESC, time";
	$resultPageingObject = mysql_query($queryPageingObject);
	$num_rowsPageingObject = mysql_num_rows($resultPageingObject);
	
?>


	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		
		<tr>
			<td><span class="nav_strong"><?php echo $aum_term_link_inbox; ?></span> | <a href="<?php echo 'http://' . $aum_btn_post_message; ?>"><?php echo $aum_term_link_post_a_message; ?></a> | <a href="<?php echo 'http://' . $aum_btn_back_to_send_msg; ?>"><?php echo $aum_term_link_sent_messages; ?></a></td>
			
		</tr>
		
		
		<tr>
			<td>
<?php
				echo $aum_term_quantity_message . ": " . $num_rowsPageingObject;
?>
			</td>
		<tr>
			<td align="right">
<?php
				$pageObjectMailsCount = $num_rowsPageingObject;
				$pageObjectPages = $pageObjectMailsCount / 10;
				$tempzahl = explode(".", $pageObjectPages);
				if (isset($tempzahl[1])) {
				    // Zahl hat nachkommastellen
				    $pageObjectPagesFinal = ceil ($pageObjectPages);
				}
				
				//echo "Anzahl Seiten: " . $pageObjectPagesFinal;
				
				echo  $aum_term_page . ": ";
				
 				$count = 1;
				while($count <= $pageObjectPagesFinal)
				{
					if ($count == $pageObjectPagesFinal) {					
						if ($actualPageOrg == $count) {
							echo $count;	
						} else {
							
							if ($firstCall == 'true' && $count == '1') {	
								echo $count;							
							} else  {	
								echo "<span style='font-weight:bold;'><a href='javascript:setActualPage(" . $count . ")'>" . $count . "</a></span>";
							}
						}
					} else {
						if ($actualPageOrg == $count) {
							echo $count . " | ";	
						} else {	
							if ($firstCall == 'true' && $count == '1') {	
								echo $count . " | ";							
							} else  {
								echo "<span style='font-weight:bold;'><a href='javascript:setActualPage(" . $count . ")'>" . $count . "</a></span>"," | ";
							}
}					
					}
					
					$count++;
				}
?>
			</td>
		</tr>
	</table>
    
    
    
    
    

	

	
	
	
 



	<script>
		
		function showMessage (x) {
			document.getElementById("messageId").value = x;
			document.showMessage.submit();
		}
		
	</script>

	<form name="showMessage" method="post" action='http://<?php echo $aum_btn_read_message ?>'>
		<input type="hidden" name="messageId" id="messageId" value="">
		<input type="hidden" name="submitted" id="submitted" value="true">
	</form>

	
	<script>
	
	function setActualPage (x) {
		

		document.getElementById('actualPage').value = x;
		document.pageingObjectForm.submit()
		
	}
	
	</script>
	<form name="pageingObjectForm" method="Post" action="<?php the_permalink(); ?>">
		<input type="hidden" name="actualPage" id="actualPage" value="">
		<input type="hidden" name="userid" value="<?php echo $current_user->ID ?>">
		<input type="hidden" name="pageingSubmitted" value="true">
	</form>
				
			
	<table>
		<tr valign="top">
 
			<td>
				<table class="aum_table">
					<tr valign="top" style="background-color: <?php echo $aum_tablecolorheader ?>;">
 
						<td class="aum_td"><?php echo $aum_term_From ?>:</td>
						<td class="aum_td"><?php echo $aum_term_subject ?>:</td>
						<td class="aum_td"><?php echo $aum_term_received ?>:</td>
						<td class="aum_td"><?php echo $aum_term_time ?>:</td>

					</tr>
<?php
						if ($num_rows >= '1') {
							while($row = mysql_fetch_row($result)) {
								//finde den Absender Nickname aus der Usertabelle
								$querySender = "SELECT user_nicename FROM $table_users WHERE ID = '$row[1]'";
								$resultSender = mysql_query($querySender);				
?>					
					<tr valign="top">
								<td class="aum_td">
<?php
									while($rowSender = mysql_fetch_row($resultSender)) {
										echo $rowSender[0];
									}
?>

								</td>
								<td class="aum_td">	
<?php
									if (strlen($row[7]) > 45) {
										$cutString = "...";	
									} else {
										$cutString = "";
									}
									
									if ($row[6] == '0') {

?>										
										<a style="font-weight:bold;color:#2d91a7;" href=javascript:showMessage(<?php echo $row[0]; ?>);><?php echo substr($row[7], 0, 45); echo $cutString; ?></a>
<?php
									} else {
										
?>
										<a style="color:#91c8d4" href=javascript:showMessage(<?php echo $row[0]; ?>);><?php echo substr($row[7], 0, 45); echo $cutString; ?></a>
<?php										
									}
?>

								</td>
								<td class="aum_td">
<?php								
								$d    =    explode("-",$row[4]);
								echo $d[2] . "." . $d[1] . "." . $d[0];
?>								
								
								</td>
								<td class="aum_td"><?php echo $row[3]; ?></td>

					</tr>

<?php								
							}
						} else {
?>
						    <tr>
							<td colspan="4" class="aum_td">
							    &nbsp;
							</td>
						    </tr>
<?php							
						}
?>
				</table>
			</td>
		</tr>
	</table>
	
	
	 





        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>












<?php
}
add_shortcode( 'admin_user_messages_inbox', 'admin_user_messages_inbox' );
?>