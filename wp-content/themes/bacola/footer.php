<?php
/**
 * footer.php
 * @package WordPress
 * @subpackage Bacola
 * @since Bacola 1.0
 * 
 */
 ?>
</div><!-- homepage-content -->
</div><!-- site-content -->
</main><!-- site-primary -->

<?php bacola_do_action( 'bacola_before_main_footer'); ?>

<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) { ?>

<?php
        /**
        * Hook: bacola_main_footer
        *
        * @hooked bacola_main_footer_function - 10
        */
        do_action( 'bacola_main_footer' );
	
		?>

<?php } ?>


<?php bacola_do_action( 'bacola_after_main_footer'); ?>

<div class="site-overlay"></div>

<?php wp_footer(); ?>
<?php
	if ( is_product() ){
		$product_id = 4174;

		// We get all the Orders for the given product ID in an arrray
		$orders_ids_array = get_orders_ids_by_product_id( $product_id );
		// from order id we should get 
		foreach($orders_ids_array as $order_id){
			$order = new WC_Order( $order_id );
			$items = $order->get_items();
			foreach ( $items as $item_id => $item ) {
				$start_date = wc_get_order_item_meta( $item_id, '_booking_start_date', true );
				$end_date = wc_get_order_item_meta( $item_id, '_booking_end_date', true );
				$all_dates .= generateDates($start_date,$end_date ).',';
			}	
		}
	
	}
if ( is_product() ){
?>
<script>
jQuery(document).ready(function($) {

    pickerStart.set('disable', [


        // Using a collection of arrays formatted as [YEAR,MONTH,DATE]
        // [2023,3,3], [2023,3,4], [2023,3,5]
        <?php echo $all_dates; ?>


    ])

});
</script>
<?php } ?>
</body>

</html>