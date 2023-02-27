<?php
/**
 * The template for displaying vendor dashboard for non-vendors
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/shortcode/non_vendor_dashboard.php
 *
 * @author 		WC Marketplace
 * @package 	WCMm/Templates
 * @version   2.2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $woocommerce, $WCMp;
$user = wp_get_current_user();
if ($user && !in_array('dc_pending_vendor', $user->roles) && !in_array('administrator', $user->roles)) {
    add_filter('wcmp_vendor_registration_submit', function ($text) {
        return __('Apply to become a vendor', 'dc-woocommerce-multi-vendor');
    });
    echo '<div class="woocommerce">';
    echo do_shortcode('[vendor_registration]');
    echo '</div>';
}

if ($user && in_array('administrator', $user->roles)) {
    ?>
    <div class="container">
        <div class="well text-center wcmp-non-vendor-notice">
            <p><?php echo sprintf(__('You have logged in as Administrator. Please <a href="%s">log out</a> and then view this page.', 'dc-woocommerce-multi-vendor'), wc_logout_url()); ?></p>
        </div>
    </div>
    <?php
}