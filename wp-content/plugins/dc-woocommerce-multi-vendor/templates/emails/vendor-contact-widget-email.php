<?php
/**
 * The template for displaying vendor contact email via customer.
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/emails/vendor-contact-widget-email.php
 *
 * @author 	WC Marketplace
 * @package 	dc-product-vendor/Templates
 * @version   3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $WCMp;
$text_align = is_rtl() ? 'right' : 'left';
$name = isset( $object['name'] ) ? $object['name'] : '';
$message = isset( $object['message'] ) ? $object['message'] : '';
$post_id = isset( $object['post_id'] ) ? $object['post_id'] : '';
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>
<p style="text-align:<?php echo $text_align; ?>;" ><?php printf(__( 'Hello %s,<br>A customer is trying to contact you. Details are as follows:', 'dc-woocommerce-multi-vendor' ),  $vendor->page_title ); ?></p>
<div style="font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; margin-bottom: 40px;">
        <h2><?php esc_html_e( 'Customer details', 'dc-woocommerce-multi-vendor' ); ?></h2>
        <ul>
            <?php
            if ($post_id) {
                $product = wc_get_product($post_id);
                ?>
                <li><strong><?php esc_html_e( 'Product Name', 'dc-woocommerce-multi-vendor' ); ?>:</strong> <span class="text"><?php echo esc_html($product->get_name()); ?></span></li><?php
            }
            ?>
            <li><strong><?php esc_html_e( 'Name', 'dc-woocommerce-multi-vendor' ); ?>:</strong> <span class="text"><?php echo esc_html($name); ?></span></li>
            <li><strong><?php esc_html_e( 'Message', 'dc-woocommerce-multi-vendor' ); ?>:</strong> <span class="text"><?php echo esc_html($message); ?></span></li>
        </ul>
</div>

<?php do_action( 'wcmp_email_footer' ); ?>
