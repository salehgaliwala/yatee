<?php
/**
 * The template for displaying report abuse via customer.
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/emails/report-abuse-email.php
 *
 * @author 	WC Marketplace
 * @package 	dc-product-vendor/Templates
 * @version   3.3.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $WCMp;
$text_align = is_rtl() ? 'right' : 'left';
$name = isset( $object['name'] ) ? $object['name'] : '';
$message = isset( $object['msg'] ) ? $object['msg'] : '';
$product = wc_get_product( absint( $object['product_id'] ) );
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>
<p style="text-align:<?php echo $text_align; ?>;" ><?php printf(esc_html__( 'A customer is reporting an abuse on the product - %s (ID: #%s). Details are as follows:', 'dc-woocommerce-multi-vendor' ), $product->get_title(), $product->get_id() ); ?></p>
<div style="font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; margin-bottom: 40px;">
        <h2><?php _e( 'Product details', 'dc-woocommerce-multi-vendor' ); ?></h2>
        <ul>
            <li><strong><?php _e( 'Product', 'dc-woocommerce-multi-vendor' ); ?>:</strong> <span class="text"><?php echo $product->get_title(); ?></span></li>
            <li><strong><?php _e( 'Vendor', 'dc-woocommerce-multi-vendor' ); ?>:</strong> <span class="text"><?php echo $vendor->page_title; ?></span></li>
        </ul>
        <h2><?php _e( 'Customer details', 'dc-woocommerce-multi-vendor' ); ?></h2>
        <ul>
            <li><strong><?php _e( 'Name', 'dc-woocommerce-multi-vendor' ); ?>:</strong> <span class="text"><?php echo $name; ?></span></li>
            <li><strong><?php _e( 'Message', 'dc-woocommerce-multi-vendor' ); ?>:</strong> <span class="text"><?php echo $message; ?></span></li>
        </ul>
</div>

<?php do_action( 'wcmp_email_footer' ); ?>
