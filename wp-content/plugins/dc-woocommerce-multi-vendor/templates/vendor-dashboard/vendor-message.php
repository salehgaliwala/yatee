<?php

/**
 * The template for displaying vendor tools
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/vendor-dashboard/vendor-tools.php
 *
 * @author 	WC Marketplace
 * @package 	WCMp/Templates
 * @version   3.1.5
 */
if (!defined('ABSPATH')) {
    // Exit if accessed directly
    exit;
}

//do_action( 'before_wcmp_vendor_tools_content' );
?>
<div class="col-md-12">
    <div class="panel panel-default panel-pading">
        <div class="wcmp-vendor-tools panel-body">
            <?php echo do_shortcode("[front-end-pm]") ?>
            <?php //do_action( 'wcmp_vendor_dashboard_tools_item' ); ?>
        </div>
    </div>
</div>
<?php
	$user = wp_get_current_user();
    $roles = ( array ) $user->roles;
  //  var_dump($roles);
//do_action( 'after_wcmp_vendor_tools_content' );