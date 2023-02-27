<?php
/**
 * The template for displaying report abuse via customer.
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/emails/customer-order-refund-request.php
 *
 * @author 	WC Marketplace
 * @package 	dc-product-vendor/Templates
 * @version   3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $WCMp;
$text_align = is_rtl() ? 'right' : 'left';

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<div style="font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; margin-bottom: 40px;">
    <?php if( $user_type != 'customer' ) { ?>
		<h2><?php esc_html_e( 'Refund details', 'dc-woocommerce-multi-vendor' ); ?></h2>
		<ul>
				<li><strong><?php _e( 'Order ID', 'dc-woocommerce-multi-vendor' ); ?>:</strong> <span class="text"><a href="<?php echo esc_url( wcmp_get_vendor_dashboard_endpoint_url( get_wcmp_vendor_settings('wcmp_vendor_orders_endpoint', 'vendor', 'general', 'vendor-orders'), $order->get_id() ) ); ?>" target="_blank">#<?php echo $order->get_id(); ?></a></span></li>
                <li><strong><?php printf(esc_html__( 'Admin order link : <a href="%s" title="%s">#%s</a> ', 'dc-woocommerce-multi-vendor' ), admin_url( 'post.php?post=' . absint( $order->get_id() ) . '&action=edit' ) , sanitize_title($order->get_status()), $order->get_order_number()  ); ?></span></li>
        <li><strong><?php _e( 'Refund Reason', 'dc-woocommerce-multi-vendor' ); ?>:</strong> <span class="text"><?php echo $refund_details['refund_reason']; ?></span></li>
        <li><strong><?php _e( 'Additional Information', 'dc-woocommerce-multi-vendor' ); ?>:</strong> <span class="text"><?php echo $refund_details['addi_info']; ?></span></li>
        <li><strong><?php _e( 'Refund Status', 'dc-woocommerce-multi-vendor' ); ?>:</strong> <span class="text"><?php echo $refund_details['status']; ?></span></li>
		</ul>
    <?php }else{ ?>
    <p><?php printf(esc_html__( 'Your refund request for order <a href="%s">#%s</a> is %s', 'dc-woocommerce-multi-vendor' ), esc_url( $order->get_view_order_url() ), $order->get_id(), $refund_details['status'] ); 
			?></p>
    <p><?php printf(esc_html__( 'Reason given by seller is %s', 'dc-woocommerce-multi-vendor' ), $refund_details['admin_reason'] ); 
        ?></p>
    <?php } ?>
</div>

<?php do_action( 'wcmp_email_footer' ); ?>