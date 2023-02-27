<?php
/**
 * Admin View: Report by Vendor (with date filters)
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $WCMp;

$vendor = isset($vendor) ? $vendor : '';

?>

<div id="poststuff" class="woocommerce-reports-wide">
	<?php if(!$vendor) { ?>
	<div class="postbox">
		<h3 class="stats_range">
			<ul>
				<?php
					foreach ( $ranges as $range => $name ) {
						echo '<li class="' . ( $current_range == $range ? 'active' : '' ) . '"><a href="' . esc_url( remove_query_arg( array( 'start_date', 'end_date' ), add_query_arg( 'range', $range ) ) ) . '">' . $name . '</a></li>';
					}
				?>
				<li class="custom <?php echo $current_range == 'custom' ? 'active' : ''; ?>">
					<?php esc_html_e( 'Custom', 'dc-woocommerce-multi-vendor' ); ?>
					<form method="GET">
						<div>
							<?php
								// Maintain query string
								foreach ( $_GET as $key => $value ) {
									if ( is_array( $value ) ) {
										foreach ( $value as $v ) {
											echo '<input type="hidden" name="' . esc_attr( sanitize_text_field( $key ) ) . '[]" value="' . esc_attr( sanitize_text_field( $v ) ) . '" />';
										}
									} else {
										echo '<input type="hidden" name="' . esc_attr( sanitize_text_field( $key ) ) . '" value="' . esc_attr( sanitize_text_field( $value ) ) . '" />';
									}
								}
							?>
							<input type="hidden" name="range" value="custom" />
							<input type="date" size="9" placeholder="<?php esc_attr_e('yyyy-mm-dd', 'dc-woocommerce-multi-vendor' ); ?>" value="<?php if ( ! empty( $_GET['start_date'] ) ) echo esc_attr( $_GET['start_date'] ); ?>" name="start_date" class="range_datepicker from" />
							<input type="date" size="9" placeholder="<?php esc_attr_e('yyyy-mm-dd', 'dc-woocommerce-multi-vendor' ); ?>" value="<?php if ( ! empty( $_GET['end_date'] ) ) echo esc_attr( $_GET['end_date'] ); ?>" name="end_date" class="range_datepicker to" />
							<input type="submit" class="button" value="<?php esc_attr_e( 'Go', 'dc-woocommerce-multi-vendor' ); ?>" />
						</div>
					</form>
				</li>
			</ul>
		</h3>
		<div class="left_align pad_left" style="float: left">
			<form method="post" action="">
				<p>
					<select id="vendor" name="vendor" class="ajax_chosen_select_vendor banking_overview_vendor" data-placeholder="<?php esc_attr_e( 'Search for a vendor...', 'dc-woocommerce-multi-vendor' ); ?>" style="min-width:210px;">
						<?php echo $option; ?>
					</select>
					<input type="button" style="vertical-align: top;" class="banking_overview_report_search submit button" value="<?php esc_attr_e( 'Show', 'dc-woocommerce-multi-vendor' ); ?>" />
				</p>
			</form>
		</div>
	</div>
	<?php } ?>
	<div class="sort_banking_table">
		<?php
		$table_headers = apply_filters('wcmp_admin_report_banking_header', array(
		    'status'      => __( 'Status', 'dc-woocommerce-multi-vendor' ),
		    'date'      => __( 'Date', 'dc-woocommerce-multi-vendor' ),
		    'type'      => __( 'Type', 'dc-woocommerce-multi-vendor' ),
		    'reference_id'      => __( 'Reference ID', 'dc-woocommerce-multi-vendor' ),
		    'Credit'      => __( 'Credit', 'dc-woocommerce-multi-vendor' ),
		    'Debit'      => __( 'Debit', 'dc-woocommerce-multi-vendor' ),
		    'balance'      => __( 'Balance', 'dc-woocommerce-multi-vendor' ),
		));
		$headers = array_keys($table_headers);
		if(isset($vendor_all_ledgers)) {
			?>
			<table class='widefat'>
				<thead>
					<tr>
						<?php
							foreach($table_headers as $key => $header)
								echo "<th class='total_row' id=".$key.">".$header."</th>";

						?>
					</tr>
				</thead>
				<tbody>
				<?php
				if ( !empty( $vendor_all_ledgers ) ) {
	                foreach ($vendor_all_ledgers as $ledger ) {
	                    // total credited balance
	                    $total_credit += floatval( $ledger->credit );
	                    // total debited balance
	                    $total_debit += floatval( $ledger->debit );
	                    $order = wc_get_order( $ledger->order_id );
	                    $currency = ( $order ) ? $order->get_currency() : '';
	                    $ref_types = get_wcmp_ledger_types();
	                    $ref_type = isset($ref_types[$ledger->ref_type]) ? $ref_types[$ledger->ref_type] : ucfirst( $ledger->ref_type );
	                    $type = '<mark class="type ' . $ledger->ref_type . '"><span>' . $ref_type . '</span></mark>';
	                    $status = $ledger->ref_status;
	                    if($ref_type == 'Commission') {
	                        $link = admin_url('post.php?post=' . $ledger->order_id . '&action=edit');
	                        $ref_link = '<a href="'.esc_url($link).'">#'.$ledger->order_id.'</a>';
	                    } elseif($ref_type == 'Refund' && $ref_type == 'Withdrawal') {
	                        $com_id = get_post_meta( $ledger->order_id, '_commission_id', true );
	                        $link = admin_url('post.php?post=' . $com_id . '&action=edit');
	                        $ref_link = '<a href="'.esc_url($link).'">#'.$com_id.'</a>';
	                    }
	                    $credit = ( $ledger->credit ) ? wc_price($ledger->credit, array('currency' => $currency)) : '';
	                    $debit = ( $ledger->debit ) ? wc_price($ledger->debit, array('currency' => $currency)) : '';
	                    $banking_datas = apply_filters( 'wcmp_admin_report_banking_details', array( 
	                        'status' => ucfirst( $status ), 
	                        'date' => wcmp_date($ledger->created), 
	                        'type' => $ref_type, 
	                        'reference_id' => $ref_link, 
	                        'Credit' => $credit, 
	                        'Debit' => $debit, 
	                        'balance' => wc_price($ledger->balance, array('currency' => $currency))
	                    ), $ledger );
	                    ?>
						<tr>
							<?php
							foreach($banking_datas as $key => $data) {
								if( in_array($key, $headers) )
									echo "<td class='total_row'>". $data ."</td>";
							}
							?>
						</tr>
						<?php
	                }
	            } else {
	            	echo '<tr><td colspan="3">' . esc_html_e('No records found.', 'dc-woocommerce-multi-vendor') . '</td></tr>';
	            }
	            
				?>
			</tbody>
			</table>
		<?php } ?>
	</div>
</div>
