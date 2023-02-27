<?php

/*
 * The template for displaying visitors map dashboard widget
 * Override this template by copying it to yourtheme/dc-product-vendor/vendor-dashboard/dashboard-widgets/wcmp_vendor_visitors_map.php
 *
 * @author 	WC Marketplace
 * @package 	WCMp/Templates
 * @version   3.0.0
 */
if (!defined('ABSPATH')) {
    // Exit if accessed directly
    exit;
}
global $WCMp;
do_action('before_wcmp_vendor_visitors_map');
?>
<div class="vendor_visitors_map">
    <div class="col-sm-4 col-md-3">
        <table id="visitor_data_stats" class="table table-bordered"></table>
    </div>
    <div class="col-sm-8 col-md-9">
        <div id="vmap" style="height: 270px;"></div>
    </div>
</div>
<?php 
do_action('after_wcmp_vendor_visitors_map');