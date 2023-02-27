<?php
    global $WCMp;

    $is_method_taxable_array = array(
        'none'      => __( 'None', 'dc-woocommerce-multi-vendor' ),
        'taxable'   => __( 'Taxable' , 'dc-woocommerce-multi-vendor' )
    );

    $calculation_type = array(
        'class' => __( 'Per class: Charge shipping for each shipping class individually', 'dc-woocommerce-multi-vendor' ),
        'order' => __( 'Per order: Charge shipping for the most expensive shipping class', 'dc-woocommerce-multi-vendor' ),
    );
?>
<div class="collapse wcmp-modal-dialog" id="wcmp_shipping_method_edit_container">
    <div class="wcmp-modal">
        <div class="wcmp-modal-content">
            <section class="wcmp-modal-main" role="main">
                <header class="wcmp-modal-header page_collapsible modal_head" id="wcmp_shipping_method_edit_general_head">
                    <h1><?php _e( 'Edit Shipping Methods', 'dc-woocommerce-multi-vendor' ); ?></h1>
                    <button class="modal-close modal-close-link dashicons dashicons-no-alt">
                        <span class="screen-reader-text"><?php _e( 'Close modal panel', 'dc-woocommerce-multi-vendor' ); ?></span>
                    </button>  
                </header>
                <article class="modal_body" id="wcmp_shipping_method_edit_form_general_body"> 
                    <form method="post" id="wcmp-vendor-edit-shipping-form">
                    <input id="method_id_selected" class="form-control" type="hidden" name="method_id"> 
                    <input id="instance_id_selected" class="form-control" type="hidden" name="instance_id"> 
                    <input id="zone_id_selected" class="form-control" type="hidden" name="zone_id"> 
                    <div id="shipping-form-fields" class="shipping_form"></div>
                    
                    <?php do_action( 'wcmp_vendor_shipping_methods_edit_form_fields', get_current_user_id() ); ?>
                </form>
                </article>
                <footer class="modal_footer" id="wcmp_shipping_method_edit_general_footer">
                    <div class="inner">
                        <button class="btn btn-default update-shipping-method" id="wcmp_shipping_method_edit_button"><?php _e( 'Save changes', 'dc-woocommerce-multi-vendor' ); ?></button>
                    </div>
                </footer> 
            </section>   
        </div>
    </div>
    <div class="wcmp-modal-backdrop modal-close"></div>
</div>