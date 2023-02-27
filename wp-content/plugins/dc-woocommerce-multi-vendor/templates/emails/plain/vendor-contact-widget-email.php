<?php
/**
 * The template for displaying vendor contact email via customer.
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/emails/plain/vendor-contact-widget-email.php
 *
 * @author 	WC Marketplace
 * @package 	dc-product-vendor/Templates
 * @version   3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $WCMp;
$name = isset( $object['name'] ) ? $object['name'] : '';
$message = isset( $object['message'] ) ? $object['message'] : '';
$post_id = isset( $object['post_id'] ) ? $object['post_id'] : '';
echo $email_heading . "\n\n"; 
printf(__( "Hello %s,\n\nA customer is trying to contact you. Details are as follows:", 'dc-woocommerce-multi-vendor' ),  $vendor->page_title); 
echo "****************************************************\n\n";
if ($post_id) {
    $product = wc_get_product($post_id);
    echo __( 'Product Name', 'dc-woocommerce-multi-vendor' ).' : '.$product->get_name();
    echo "\n";
}
echo __( 'Name', 'dc-woocommerce-multi-vendor' ).' : '.$name;
echo "\n";
echo __( 'Message', 'dc-woocommerce-multi-vendor' ).' : '.$message;

echo apply_filters( 'wcmp_email_footer_text', get_option( 'wcmp_email_footer_text' ) );