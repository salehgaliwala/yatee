<?php
/*
 * The template for displaying vendor coupons
 * Override this template by copying it to yourtheme/dc-product-vendor/vendor-dashboard/coupon-manager/coupons.php
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
do_action('before_wcmp_vendor_dashboard_coupon_list_table');
$coupon_list_table_headers = apply_filters('wcmp_datatable_coupon_list_table_headers', array(
    'coupons'      => array('label' => __( 'Coupon(s)', 'dc-woocommerce-multi-vendor' ), 'class' => 'name'),
    'type'    => array('label' => __( 'Coupon type', 'dc-woocommerce-multi-vendor' )),
    'amount'    => array('label' => __( 'Coupon Amount', 'dc-woocommerce-multi-vendor' )),
    'uses_limit'=> array('label' => __( 'Usage / Limit', 'dc-woocommerce-multi-vendor' )),
    'expiry_date'  => array('label' => __( 'Expiry Date', 'dc-woocommerce-multi-vendor' )),
    'actions'  => array('label' => __( 'Actions', 'dc-woocommerce-multi-vendor' )),
), get_current_user_id());
?>
<div class="col-md-12">
    <div class="panel panel-default panel-pading">
        <table id="coupons_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <?php 
                        if($coupon_list_table_headers) :
                            foreach ($coupon_list_table_headers as $key => $header) { ?>
                        <th class="<?php if(isset($header['class'])) echo $header['class']; ?>"><?php if(isset($header['label'])) echo $header['label']; ?></th>         
                            <?php }
                        endif;
                    ?>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        <div class="wcmp-action-container">
            <a href="<?php echo wcmp_get_vendor_dashboard_endpoint_url(get_wcmp_vendor_settings('wcmp_add_coupon_endpoint', 'vendor', 'general', 'add-coupon'));?>" class="btn btn-default"><?php echo __('Add Coupon', 'dc-woocommerce-multi-vendor');?></a>
        </div>
    </div>
</div>
<style>
    .vendor-coupon .row-actions{ visibility: hidden;}
    .vendor-coupon:hover .row-actions{ visibility: visible;}
    span.delete a{color: #a00;}
</style>
<script>
jQuery(document).ready(function($) {
    var vendor_coupons;
    var columns = [];
    <?php if($coupon_list_table_headers) {
     foreach ($coupon_list_table_headers as $key => $header) { ?>
        obj = {};
        obj['data'] = '<?php echo esc_js($key); ?>';
        obj['className'] = '<?php if(isset($header['class'])) echo esc_js($header['class']); ?>';
        columns.push(obj);
     <?php }
        } ?>
    vendor_coupons = $('#coupons_table').DataTable({
        columnDefs: [
            { width: 80, targets: 5 }
        ],
        ordering  : false,
        searching  : false,
        processing: true,
        serverSide: true,
        responsive: true,
        language: {
            emptyTable: "<?php echo trim(__('No coupons found!','dc-woocommerce-multi-vendor')); ?>",
            processing: "<?php echo trim(__('Processing...', 'dc-woocommerce-multi-vendor')); ?>",
            info: "<?php echo trim(__('Showing _START_ to _END_ of _TOTAL_ coupons','dc-woocommerce-multi-vendor')); ?>",
            infoEmpty: "<?php echo trim(__('Showing 0 to 0 of 0 coupons','dc-woocommerce-multi-vendor')); ?>",
            lengthMenu: "<?php echo trim(__('Number of rows _MENU_','dc-woocommerce-multi-vendor')); ?>",
            zeroRecords: "<?php echo trim(__('No matching coupons found','dc-woocommerce-multi-vendor')); ?>",
            paginate: {
                next: "<?php echo trim(__('Next', 'dc-woocommerce-multi-vendor')); ?>",
                previous: "<?php echo trim(__('Previous', 'dc-woocommerce-multi-vendor')); ?>"
            }
        },
        ajax:{
            url : '<?php echo add_query_arg( 'action', 'wcmp_vendor_coupon_list', $WCMp->ajax_url() ); ?>', 
            type: "post",
            data: function (data) {
                data.security = '<?php echo wp_create_nonce('wcmp-coupon'); ?>';
            }, 
            error: function(xhr, status, error) {
                $("#coupons_table tbody").append('<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty" style="text-align:center;">'+error+' - <a href="javascript:window.location.reload();"><?php _e('Reload', 'dc-woocommerce-multi-vendor'); ?></a></td></tr>');
                $("#coupons_table_processing").css("display","none");
            }
        },
        createdRow: function (row, data, index) {
            $(row).addClass('vendor-coupon');
        },
        columns: columns
    });
    new $.fn.dataTable.FixedHeader( vendor_coupons );
});
</script>
<?php do_action('after_wcmp_vendor_dashboard_coupon_list_table'); 