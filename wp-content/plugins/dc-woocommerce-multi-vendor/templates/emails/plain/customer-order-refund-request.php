<?php
/**
 * The template for displaying report abuse via customer.
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/emails/plain/customer-order-refund-request.php
 *
 * @author 	WC Marketplace
 * @package 	dc-product-vendor/Templates
 * @version   3.3.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $WCMp;

echo $email_heading . "\n\n";

if( $user_type != 'customer' ) {
    echo __( 'Refund details', 'dc-woocommerce-multi-vendor' ) . "\n\n";
    printf( __( "Order ID: #%s",  'dc-woocommerce-multi-vendor' ), $order->get_id()) . "\n";
    printf( __( "Refund Reason: %s",  'dc-woocommerce-multi-vendor' ), $refund_details['refund_reason']) . "\n";
    printf( __( "Additional Information: %s",  'dc-woocommerce-multi-vendor' ), $refund_details['addi_info']) . "\n";
    printf( __( "Refund Status: %s",  'dc-woocommerce-multi-vendor' ), $refund_details['status']) . "\n";
}else{
    printf( __( "Your refund request for order %s is %s",  'dc-woocommerce-multi-vendor' ), $order->get_id(), $refund_details['status'] ) . "\n";
}

echo apply_filters( 'wcmp_email_footer_text', get_option( 'wcmp_email_footer_text' ) ); 