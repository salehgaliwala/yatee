<?php
/**
 * The template for displaying vendor dashboard
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/vendor_message_to_buyer.php
 *
 * @author 		WC Marketplace
 * @package 	WCMp/Templates
 * @version   2.3.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
?>
<table style="width:100%; color: #737373; border: 1px solid #e4e4e4; background:none;" border="0" cellpadding="8" cellspacing="0">
    <tbody>
        <tr>
            <th style="padding:10px 10px; background:none; border-right: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; width:50%;" align="left" valign="top"><?php echo esc_html_e('Tracking Details', 'dc-woocommerce-multi-vendor'); ?></th>
        </tr>
        <tr>
            <td style="padding:10px 10px; background:none; border-right: 1px solid #e4e4e4; border-bottom: 1px solid #e4e4e4; width:50%;" align="left" valign="top">
                <p><strong><?php echo esc_html_e('Tracking ID', 'dc-woocommerce-multi-vendor'); ?> </strong><br>
                    <?php echo $tracking_id; ?> </p>
                <p><strong><?php echo esc_html_e('Tracking URL', 'dc-woocommerce-multi-vendor'); ?> </strong> <br>
                <a href=<?php echo $tracking_url; ?>><?php echo $tracking_url; ?></a>
                </p>
            </td>
        </tr>                           
    </tbody>
</table>




