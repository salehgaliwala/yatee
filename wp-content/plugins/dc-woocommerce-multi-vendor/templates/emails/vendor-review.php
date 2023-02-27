<?php
/**
 * The template for displaying demo plugin content.
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/emails/vendor-review.php
 *
 * @author 		WC Marketplace
 * @package 	dc-product-vendor/Templates
 * @version   0.0.1
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_name  = isset( $customer_name ) ? $customer_name : '';
$review = isset( $review ) ? $review : '';
$rating = isset( $rating ) ? absint( $rating ) : '';

do_action( 'woocommerce_email_header', $email_heading ); ?>

<div style="font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; margin-bottom: 40px;">
        <h2><?php _e( 'Review details', 'dc-woocommerce-multi-vendor' ); ?></h2>
        <ul>
            <li><?php printf( esc_html__( "Customer Name : %s", 'dc-woocommerce-multi-vendor' ), '<strong>' . $customer_name . '</strong>' ); ?>
            </li>
            <?php if( !empty( $rating ) ){ ?>
            <li>
                <?php printf( esc_html__( "Rating : %s out of 5", 'dc-woocommerce-multi-vendor' ), '<strong>' . $rating . '</strong>' ); ?>
            </li>
            <?php } ?>
            <li>
            <?php printf( esc_html__( "Comment : %s", 'dc-woocommerce-multi-vendor' ), '<strong>' . $review . '</strong>' ); ?>
            </li>
        </ul>
</div>
<?php do_action( 'wcmp_email_footer' ); ?>