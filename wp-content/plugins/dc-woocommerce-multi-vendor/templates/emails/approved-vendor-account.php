<?php
/**
 * The template for displaying demo plugin content.
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/emails/approved-vendor-account.php
 *
 * @author 		WC Marketplace
 * @package 	dc-product-vendor/Templates
 * @version   0.0.1
 */
 
global $WCMp;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>
<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>
<p><?php printf( esc_html__( "Congratulations! Your vendor application on %s has been approved!", 'dc-woocommerce-multi-vendor' ), get_option( 'blogname' ) ); ?></p>
<p>
	<?php _e( "Application status: Approved",  'dc-woocommerce-multi-vendor' ); ?><br/>
	<?php printf( esc_html__( "Applicant Username: %s",  'dc-woocommerce-multi-vendor' ), $user_login ); ?>
</p>
<p><?php _e('You have been cleared for landing! Congratulations and welcome aboard!', 'dc-woocommerce-multi-vendor') ?> <p>
<?php do_action( 'wcmp_email_footer' );?>