<?php

/**
 * Advanced product tab template
 *
  * Override this template by copying it to yourtheme/dc-product-vendor/vendor-dashboard/product-manager/views/html-product-data-advanced.php
 *
 * @author  WC Marketplace
 * @package     WCMp/Templates
 * @version   3.3.0
 */
defined( 'ABSPATH' ) || exit;
?>
<!-- script to select the bookable checkbox -->
<?php if($_POST['_bookable'] == 'yes' || get_post_meta($post->ID, '_bookable',true) == 'yes' ):?>
<script>
jQuery('#_bookable').prop('checked', true);
</script>
<?php endif; ?>
<div role="tabpanel" class="tab-pane fade" id="booking_product_data">
    <div class="row-padding">
        <div class="hide_if_external hide_if_grouped">
            <div class="form-group">
                <label class="control-label col-sm-3 col-md-3"
                    for="_number_of_dates"><?php echo esc_html__( 'Number of dates to select', 'woocommerce-easy-booking-system' ); ?></label>
                <div class="col-md-6 col-sm-9">
                    <!-- <textarea id="_purchase_note" name="_purchase_note" class="form-control"><?php echo isset($_POST['_purchase_note']) ? wc_clean($_POST['_purchase_note']) : esc_html( $product_object->get_purchase_note( 'edit' ) ); ?></textarea>-->
                    <select style="" id="booking_dates" name="_number_of_dates" class="select short booking_dates">
                        <option value="global"
                            <?php echo get_post_meta($post->ID,'_number_of_dates',true) == 'gobal'? 'selected="selected"':'' ?>>
                            Identique aux paramètres globaux</option>
                        <option value="one"
                            <?php echo get_post_meta($post->ID,'_number_of_dates',true) == 'one'? 'selected="selected"':'' ?>>
                            Une</option>
                        <option value="two"
                            <?php echo get_post_meta($post->ID,'_number_of_dates',true) == 'two'? 'selected="selected"':'' ?>>
                            Deux</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="hide_if_external hide_if_grouped">
            <div class="form-group">
                <label class="control-label col-sm-3 col-md-3"
                    for="_booking_duration"><?php echo esc_html__( 'Booking duration', 'woocommerce-easy-booking-system' ) ?></label>
                <div class="col-md-6 col-sm-9">
                    <input type="number" class="booking_duration" style="" name="_booking_duration"
                        id="booking_duration"
                        value="<?php echo isset($_POST['_booking_duration']) ? wc_clean($_POST['_booking_duration']) : get_post_meta($post->ID, '_booking_duration',true); ?>"
                        placeholder="<?php echo esc_html__( 'Same as global settings', 'woocommerce-easy-booking-system' ) ?>"
                        step="1" min="1" max="366">
                </div>
            </div>
        </div>

        <div class="hide_if_external hide_if_grouped">
            <div class="form-group">
                <label class="control-label col-sm-3 col-md-3"
                    for="_booking_min"><?php echo esc_html__( 'Minimum duration', 'woocommerce-easy-booking-system' ) ?></label>
                <div class="col-md-6 col-sm-9">
                    <input type="number" class="booking_min" style="" name="_booking_min" id="booking_min"
                        value="<?php echo isset($_POST['_booking_min']) ? wc_clean($_POST['_booking_min']) : get_post_meta($post->ID, '_booking_min',true); ?>"
                        placeholder="<?php echo esc_html__( 'Same as global settings', 'woocommerce-easy-booking-system' ) ?>"
                        step="1" min="0" max="3650">
                </div>
            </div>
        </div>

        <div class="hide_if_external hide_if_grouped">
            <div class="form-group">
                <label class="control-label col-sm-3 col-md-3"
                    for="_booking_min"><?php echo esc_html__( 'Maximum duration', 'woocommerce-easy-booking-system' ) ?></label>
                <div class="col-md-6 col-sm-9">
                    <input type="number" class="booking_max" style="" name="_booking_max" id="booking_max"
                        value="<?php echo isset($_POST['_booking_min']) ? wc_clean($_POST['_booking_min']) : get_post_meta($post->ID, '_booking_min',true); ?>"
                        placeholder="<?php echo esc_html__( 'Same as global settings', 'woocommerce-easy-booking-system' ) ?>"
                        step="1" min="0" max="3650">
                </div>
            </div>
        </div>

        <div class="hide_if_external hide_if_grouped">
            <div class="form-group">
                <label class="control-label col-sm-3 col-md-3"
                    for="_first_available_date"><?php echo esc_html__( 'First available date', 'woocommerce-easy-booking-system' ) ?></label>
                <div class="col-md-6 col-sm-9">
                    <input type="number" class="first_available_date" style="" name="_first_available_date"
                        id="first_available_date"
                        value="<?php echo isset($_POST['_first_available_date']) ? wc_clean($_POST['_first_available_date']) : get_post_meta($post->ID, '_first_available_date',true); ?>"
                        placeholder="<?php esc_html__( 'Same as global settings', 'woocommerce-easy-booking-system' ) ?>"
                        step="1" min="0" max="3650">
                </div>
            </div>
        </div>
        <div class="hide_if_external hide_if_grouped">
            <div class="form-group">
                <label class="control-label col-sm-3 col-md-3"
                    for="_for_variable_booking"><?php echo esc_html__( 'Prix variable en fonction de séjour', 'woocommerce-easy-booking-system' ) ?></label>
                <div class="col-md-6 col-sm-9">
                    <input type="checkbox" class="_for_variable_booking" style="" name="_for_variable_booking"
                        id="_for_variable_booking"
                        value="1" <?php echo (get_post_meta($post->ID,'_for_variable_booking',true)==1?'checked="checked"':'') ?> 
                        >


                </div>

            </div>
            <div class="row">
                    <div class="col-md-6 col-sm-9">
                        <div class="variable_booking_panel" <?php echo (get_post_meta($post->ID,'_for_variable_booking',true)==1?'style="display:block"':'style="display:none"') ?>>
                            <div id="repeater-container">
                                <button id="add-item"> <?php echo esc_html__( 'Ajouter +', 'woocommerce-easy-booking-system' ) ?></button>
                                
                                 <template id="item-template">
                                      
                                    <div class="item">
                                        <table>
                                             <tr><td> <?php echo esc_html__( 'Days', 'woocommerce-easy-booking-system' ) ?></td><td><?php echo esc_html__( 'Prix', 'woocommerce-easy-booking-system' ) ?></td></tr>
                                            <tr>
                                                <td><input type="number" name="item_days[]" placeholder="<?php echo esc_html__( 'Days', 'woocommerce-easy-booking-system' ) ?>" value=""></td>
                                                <td><input type="text" name="item_price[]" placeholder="<?php echo esc_html__( 'Prix', 'woocommerce-easy-booking-system' ) ?>" value=""></td>
                                                <td> <button class="remove-item"><?php echo esc_html__( 'Retirer -', 'woocommerce-easy-booking-system' ) ?></button> </td>
                                            </tr>
                                        </table>
                                       
                                    </div>
                                </template>
                                <?php 
                                    $multpleDates = get_post_meta($post->ID,'multiple_bookable',true);
                                    $multpleDates = unserialize($multpleDates);
                                    foreach ( $multpleDates as $item => $key) {?>
                                      <div class="item">
                                        <table>
                                              <tr><td> <?php echo esc_html__( 'Days', 'woocommerce-easy-booking-system' ) ?></td><td><?php echo esc_html__( 'Prix', 'woocommerce-easy-booking-system' ) ?></td></tr
                                            <tr>
                                                <td><input type="number" name="item_days[]" placeholder="Days" value="<?php echo $item?>"></td>
                                                <td><input type="text" name="item_price[]" placeholder="price" value="<?php echo $key ?>"></td>
                                                <td> <button class="remove-item"><?php echo esc_html__( 'Retirer -', 'woocommerce-easy-booking-system' ) ?></button> </td>
                                            </tr>
                                        </table>
                                        
                                    </div>
                               
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <input type="hidden" name="booking_product" value="1" />
    </div>
</div>

<script>
jQuery('#add-item').on('click', function(e) {
    e.preventDefault();
    var itemTemplate = jQuery('#item-template').html();
    var newItem = jQuery(itemTemplate);
    jQuery('#repeater-container').append(newItem);
});
jQuery('#repeater-container').on('click', '.remove-item', function() {
    jQuery(this).closest('.item').remove();
});
jQuery(document).ready(function(){
  jQuery('#_for_variable_booking').change(function(){
    if(jQuery(this).prop("checked") == true){
      jQuery('.variable_booking_panel').show();
    }
    else if(jQuery(this).prop("checked") == false){
      jQuery('.variable_booking_panel').hide();
    }
  });
});
</script>