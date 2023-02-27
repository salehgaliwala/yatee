<?php
/**
 * The template for displaying vendor orders item band called from vendor-ledger.php template
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/vendor-dashboard/vendor-reports/vendor-ledger.php
 *
 * @author 		WC Marketplace
 * @package 	WCMp/Templates
 * @version   3.4.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $WCMp;
?>
<div class="col-md-12 wcmp-vendor-ledger-wrapper">

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row wcmp-vendor-ledger-report-row">
                <div class="col-md-3 ledger-box-wrap ledger-initial-bal">
                    <div class="widget widget-stats bg-ledger">
                        <div class="stats-icon"><i class="wcmp-font ico-payments-icon"></i></div>
                        <div class="stats-info">
                            <h4><?php _e('Initial Balance', 'dc-woocommerce-multi-vendor'); ?></h4>
                            <span class="number initial-bal-wrap"></span>	
                        </div>
                        <div class="stats-link"></div>
                    </div>
                </div>
                <div class="col-md-3 ledger-box-wrap ledger-total-credit-bal">
                    <div class="widget widget-stats bg-ledger">
                        <div class="stats-icon"><i class="wcmp-font ico-earning-icon"></i></div>
                        <div class="stats-info">
                            <h4><?php _e('Total Credit', 'dc-woocommerce-multi-vendor'); ?></h4>
                            <span class="number total-credit-wrap"></span>	
                        </div>
                        <div class="stats-link"></div>
                    </div>
                </div>
                <div class="col-md-3 ledger-box-wrap ledger-total-debit-bal">
                    <div class="widget widget-stats bg-ledger">
                        <div class="stats-icon"><i class="wcmp-font ico-revenue-icon"></i></div>
                        <div class="stats-info">
                            <h4><?php _e('Total Debit', 'dc-woocommerce-multi-vendor'); ?></h4>
                            <span class="number total-debit-wrap"></span>	
                        </div>
                        <div class="stats-link"></div>
                    </div>
                </div>
                <div class="col-md-3 ledger-box-wrap ledger-total-ending-bal">
                    <div class="widget widget-stats bg-ledger">
                        <div class="stats-icon"><i class="wcmp-font ico-payments-icon"></i></div>
                        <div class="stats-info">
                            <h4><?php _e('Ending Balance', 'dc-woocommerce-multi-vendor'); ?></h4>
                            <span class="number ending-bal-wrap"></span>	
                        </div>
                        <div class="stats-link"></div>
                    </div>
                </div>
            </div>
            <div id="vendor_ledger_date_filter" class="form-inline datatable-date-filder">
                <div class="form-group">
                    <input type="date" id="wcmp_from_date" class="form-control" name="from_date" class=" gap1" placeholder="From" value="<?php echo date('Y-m-01'); ?>"/>
                </div>
                <div class="form-group">
                    <input type="date" id="wcmp_to_date" class="form-control" name="to_date" class="" placeholder="To" value="<?php echo date('Y-m-d'); ?>"/>
                </div>
                <button type="button" name="order_export_submit" id="do_filter"  class="btn btn-default" ><?php _e('Show', 'dc-woocommerce-multi-vendor') ?></button>
            </div>  
            <table class="table table-striped table-bordered" id="wcmp-vendor-ledger" style="width:100%;">
                <thead>
                    <tr>
                    <?php 
                        if($table_headers) :
                            foreach ($table_headers as $key => $header) { ?>
                        <th class="<?php if(isset($header['class'])) echo $header['class']; ?>"><?php if(isset($header['label'])) echo $header['label']; ?></th>         
                        <?php }
                        endif;
                    ?>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function($) {
    var vendor_ledger;
    var columns = [];
    <?php if($table_headers) {
     foreach ($table_headers as $key => $header) { 
        $orderable = 'false'; if($key == 'date') $orderable = 'true'; ?>
        obj = {};
        obj['data'] = '<?php echo esc_js($key); ?>';
        obj['className'] = '<?php echo esc_js($key); ?>';
        obj['orderable'] = '<?php echo esc_js($orderable); ?>';
        columns.push(obj);
     <?php }
        } ?>
    vendor_ledger = $('#wcmp-vendor-ledger').on('xhr.dt', function ( e, settings, json, xhr ) {
        $('.initial-bal-wrap').html(json.initial_bal);
        $('.ending-bal-wrap').html(json.ending_bal);
        $('.total-credit-wrap').html(json.total_credit);
        $('.total-debit-wrap').html(json.total_debit);
    } ).DataTable({
        ordering  : <?php echo isset($table_init['ordering']) ? trim($table_init['ordering']) : 'false'; ?>,
        searching  : <?php echo isset($table_init['searching']) ? trim($table_init['searching']) : 'false'; ?>,
        processing: true,
        serverSide: true,
        responsive: true,
        language: {
            "emptyTable": "<?php echo isset($table_init['emptyTable']) ? trim($table_init['emptyTable']) : __('No transactions found!','dc-woocommerce-multi-vendor'); ?>",
            "processing": "<?php echo isset($table_init['processing']) ? trim($table_init['processing']) : __('Processing...', 'dc-woocommerce-multi-vendor'); ?>",
            "info": "<?php echo isset($table_init['info']) ? trim($table_init['info']) : __('Showing _START_ to _END_ of _TOTAL_ transactions','dc-woocommerce-multi-vendor'); ?>",
            "infoEmpty": "<?php echo isset($table_init['infoEmpty']) ? trim($table_init['infoEmpty']) : __('Showing 0 to 0 of 0 transactions','dc-woocommerce-multi-vendor'); ?>",
            "lengthMenu": "<?php echo isset($table_init['lengthMenu']) ? trim($table_init['lengthMenu']) : __('Number of rows _MENU_','dc-woocommerce-multi-vendor'); ?>",
            "zeroRecords": "<?php echo isset($table_init['zeroRecords']) ? trim($table_init['zeroRecords']) : __('No matching transactions found','dc-woocommerce-multi-vendor'); ?>",
            "search": "<?php echo isset($table_init['search']) ? trim($table_init['search']) : __('Search:','dc-woocommerce-multi-vendor'); ?>",
            "paginate": {
                "next":  "<?php echo isset($table_init['next']) ? trim($table_init['next']) : __('Next','dc-woocommerce-multi-vendor'); ?>",
                "previous":  "<?php echo isset($table_init['previous']) ? trim($table_init['previous']) : __('Previous','dc-woocommerce-multi-vendor'); ?>"
            }
        },
        ajax:{
            url : '<?php echo add_query_arg( 'action', 'wcmp_vendor_banking_ledger_list', $WCMp->ajax_url() ); ?>', 
            type: "post",
            data: function (data) {
                data.from_date = $('#wcmp_from_date').val();
                data.to_date = $('#wcmp_to_date').val();
                data.security = '<?php echo wp_create_nonce('wcmp-ledger'); ?>';
            },
            error: function(xhr, status, error) {
                $("#wcmp-vendor-ledger tbody").append('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty" style="text-align:center;">'+error+' - <a href="javascript:window.location.reload();"><?php _e('Reload', 'dc-woocommerce-multi-vendor'); ?></a></td></tr>');
                $("#wcmp-vendor-ledger_processing").css("display","none");
            }
        },
        columns: columns
    });
    new $.fn.dataTable.FixedHeader( vendor_ledger );
    $(document).on('click', '#vendor_ledger_date_filter #do_filter', function () {
        vendor_ledger.ajax.reload();
    });
});
</script>