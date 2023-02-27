<div class="transaction-details">
	<div class="total-balance-wrap">
		<h4><?php _e('Withdrawable Balance', 'dc-woocommerce-multi-vendor');?></h4>
		<div class="wcmp_dashboard_widget_total_transaction"><?php echo wc_price($total_amount);  ?></div>
	</div>
    <?php if($transaction_display_array) : ?>
	<ul class="transaction-list">
	<?php 
		foreach ($transaction_display_array as $key => $value) {
                    //print_r($value);
                    
			echo "<li><p>".$value['transaction_date']."<span class='order-id'><a href=" . esc_url(wcmp_get_vendor_dashboard_endpoint_url(get_wcmp_vendor_settings('wcmp_transaction_details_endpoint', 'vendor', 'general', 'transaction-details'), $key)) . ">#".$key."</a></span></p><span class='pull-right'>".wc_price($value['total_amount'])."</span></li>";	
		}?>
	</ul>
    <?php endif; ?>
</div>
