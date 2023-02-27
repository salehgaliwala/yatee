<?php
/**
 * The template for displaying demo plugin content.
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/emails/vendor-new-question.php
 *
 * @author 		WC Marketplace
 * @package 	dc-product-vendor/Templates
 * @version   0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $WCMp;
$text_align = is_rtl() ? 'right' : 'left';
$question = isset( $question ) ? $question : '';
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>
<p style="text-align:<?php echo $text_align; ?>;" >
	<?php printf( esc_html__( "Hi %s,",  'dc-woocommerce-multi-vendor' ), $vendor->page_title ); ?><br><br>
	<?php printf( esc_html__( "A new query has been added by your potential buyer - %s",  'dc-woocommerce-multi-vendor' ), $customer_name ); ?><br>
	<?php printf( esc_html__( "Product Name : %s",  'dc-woocommerce-multi-vendor' ), $product_name ); ?><br>
	<?php printf( esc_html__( "Query : %s",  'dc-woocommerce-multi-vendor' ), $question ); ?><br>
    <?php 
    	$question_link = apply_filters( 'wcmp_vendor_question_redirect_link', esc_url( wcmp_get_vendor_dashboard_endpoint_url(get_wcmp_vendor_settings('wcmp_vendor_products_qnas_endpoint', 'vendor', 'general', 'products-qna'))) ); 
        printf( esc_html__( "You can approve or reject query from here : %s",  'dc-woocommerce-multi-vendor' ), $question_link ); ?><br><br>

        <?php printf( esc_html__( 'Note: Quick replies help to maintain a friendly customer-buyer relationship', 'dc-woocommerce-multi-vendor' )); ?>
</p>

<?php do_action( 'wcmp_email_footer' ); ?>


