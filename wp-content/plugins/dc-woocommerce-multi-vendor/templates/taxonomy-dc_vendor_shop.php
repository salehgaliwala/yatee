<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template.
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/taxonomy-dc_vendor_shop.php
 *
 * @author 		WC Marketplace
 * @package 	WCMp/Templates
 * @version   	3.7
 */
global $WCMp;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
// Get vendor 
$vendor_id = wcmp_find_shop_page_vendor();
$vendor = get_wcmp_vendor($vendor_id);
if(!$vendor){
    // Redirect if not vendor
    wp_safe_redirect(get_permalink( woocommerce_get_page_id( 'shop' ) ));
    exit();
}
$is_block = get_user_meta($vendor->id, '_vendor_turn_off' , true);
if($is_block) {
	get_header( 'shop' ); ?>
	<?php
		/**
		 * wcmp_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		if ( apply_filters( 'wcmp_load_default_vendor_store', false ) ) {
			do_action( 'woocommerce_before_main_content' );
		} else {
			do_action( 'wcmp_before_main_content' );
		}
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php

		if ( apply_filters( 'wcmp_load_default_vendor_store', false ) ) {
			do_action( 'woocommerce_archive_description' );
		} else {
			do_action( 'wcmp_archive_description' );
		}

		do_action( 'woocommerce_archive_description' ); 
		$block_vendor_desc = apply_filters('wcmp_blocked_vendor_text', __('Site Administrator has blocked this vendor', 'dc-woocommerce-multi-vendor'), $vendor);
		?>
		<p class="blocked_desc">
			<?php echo esc_html($block_vendor_desc); ?>
		<p>
		<?php
		/**
		 * wcmp_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */

		if ( apply_filters( 'wcmp_load_default_vendor_store', false ) ) {
			do_action( 'woocommerce_after_main_content' );
		} else {
			do_action( 'wcmp_after_main_content' );
		}
	?>

	<?php
		/**
		 * wcmp_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		// deprecated since version 3.0.0 with no alternative available
		// do_action( 'wcmp_sidebar' );
	?>

<?php get_footer( 'shop' ); 
	
} else {
	if ( apply_filters( 'wcmp_load_default_vendor_store', false ) ) {
		wc_get_template( 'archive-product.php' );
	} else {
		$WCMp->template->get_store_template('wcmp-archive-page-vendor.php');
	}
}