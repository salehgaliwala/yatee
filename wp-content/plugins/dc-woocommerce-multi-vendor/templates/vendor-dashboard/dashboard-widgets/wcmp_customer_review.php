<?php
/*
 * The template for displaying vendor pending shipping table dashboard widget
 * Override this template by copying it to yourtheme/dc-product-vendor/vendor-dashboard/dashboard-widgets/wcmp_customer_review.php
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
$vendor = get_wcmp_vendor();
if (!$vendor) {
    return;
}
$ratings = wcmp_get_vendor_review_info($vendor->term_id);
?>
<div class="row">
    <!-- <div class="col-md-12">
        <?php //echo wc_get_rating_html($ratings['avg_rating']); ?>
    </div> -->
    <div class="col-md-12 wcmp-comments dash-widget-dt">
        <table id="vendor_reviews" class="wcmp-widget-dt table" width="100%">
            <thead>
                <tr><th></th></tr>
            </thead>
            <tbody class="media-list">
              
            </tbody>
        </table>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    var vendor_reviews;
    vendor_reviews = $('#vendor_reviews').DataTable({
        ordering  : false,
        lengthChange : false,
        pageLength : 5,
        info:     false,
        searching  : false,
        processing: false,
        serverSide: true,
        responsive: true,
        pagingType: 'numbers',
        language: {
            emptyTable: '<div><?php echo trim(__('No reviews found.', 'dc-woocommerce-multi-vendor')); ?></div>'
        },
        preDrawCallback: function( settings ) {
            $('#vendor_reviews thead').hide();
            $('.dataTables_paginate').parent().removeClass('col-sm-7').addClass('col-sm-12').siblings('div').hide();
            var info = this.api().page.info();
            if (info.recordsTotal <= 5) {
                $('.dataTables_paginate').parent().parent().hide();
            }else{
                $('.dataTables_paginate').parent().parent().show();
            }
        },
        ajax:{
            url : '<?php echo add_query_arg( 'action', 'wcmp_vendor_dashboard_reviews_data', $WCMp->ajax_url() ); ?>', 
            type: "post",
            error: function(xhr, status, error) {
                $("#vendor_reviews tbody").append('<tr class="odd"><td valign="top" colspan="1" class="dataTables_empty"><div>'+error+' - <a href="javascript:window.location.reload();"><?php _e('Reload', 'dc-woocommerce-multi-vendor'); ?></div></td></tr>');
                $("#vendor_reviews_processing").css("display","none");
            }
        },
        columns: [{ className: "media" }]

    });
});
</script>