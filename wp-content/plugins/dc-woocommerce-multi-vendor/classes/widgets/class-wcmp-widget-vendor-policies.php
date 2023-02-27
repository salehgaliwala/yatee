<?php

if (!defined('ABSPATH')) {
    exit;
}

class WCMp_Widget_Vendor_Policies extends WC_Widget {

    public $vendor_term_id;

    public function __construct() {
        $this->widget_cssclass = 'wcmp_vendor_widget_policy';
        $this->widget_description = __('Displays vendor policies on the vendor shop page.', 'dc-woocommerce-multi-vendor');
        $this->widget_id = 'wcmp_vendor_widget_policy';
        $this->widget_name = __('WCMp: Vendor\'s Policies',     'dc-woocommerce-multi-vendor');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'std' => __('Vendor Policies', 'dc-woocommerce-multi-vendor'),
                'label' => __('Title', 'dc-woocommerce-multi-vendor'),
            ),
            'shipping' => array(
                'type' => 'checkbox',
                'std' => 1,
                'label' => __('Shipping Policy', 'dc-woocommerce-multi-vendor'),
            ),
			'refund'       => array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __('Refund Policy', 'dc-woocommerce-multi-vendor'),
			),
            'cancel'       => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => __('Cancellation/Return/Exchange Policy', 'dc-woocommerce-multi-vendor'),
            ),
        );
        parent::__construct();
    }

    public function widget($args, $instance) {
        global $WCMp;
        $content = '';
        $store_id = wcmp_find_shop_page_vendor();
        $vendor = get_wcmp_vendor($store_id);
        if ((!wcmp_is_store_page() && !$vendor)) {
            return;
        }

        $this->widget_start($args, $instance);

        do_action($this->widget_cssclass . '_top', $vendor);
        
        $shipping = isset($instance['shipping']) ? $instance['shipping'] : $this->settings['shipping']['std'];
        $refund = isset( $instance['refund'] ) ? $instance['refund'] : $this->settings['refund']['std'];
        $cancel = isset( $instance['cancel'] ) ? $instance['cancel'] : $this->settings['cancel']['std'];

        $policies = $this->get_wcmp_vendor_policies($vendor);

        if(!empty($policies)) {

            $content .= '<div class="wcmp-product-policies">';
            if(isset($policies['shipping_policy']) && !empty($policies['shipping_policy']) && $shipping) {
                $content .='<div class="wcmp-shipping-policies policy">
                    <h2 class="wcmp_policies_heading heading">'. esc_html_e('Shipping Policy', 'dc-woocommerce-multi-vendor').'</h2>
                    <div class="wcmp_policies_description description" >'.$policies['shipping_policy'].'</div>
                </div>';
            } 
            if(isset($policies['refund_policy']) && !empty($policies['refund_policy']) && $refund){ 
                $content .='<div class="wcmp-refund-policies policy">
                    <h2 class="wcmp_policies_heading heading heading">'. esc_html_e('Refund Policy', 'dc-woocommerce-multi-vendor').'</h2>
                    <div class="wcmp_policies_description description">'.$policies['refund_policy'].'</div>
                </div>';
            } 
            if(isset($policies['cancellation_policy']) && !empty($policies['cancellation_policy']) && $cancel){ 
                $content .='<div class="wcmp-cancellation-policies policy">
                    <h2 class="wcmp_policies_heading heading">'. esc_html_e('Cancellation / Return / Exchange Policy', 'dc-woocommerce-multi-vendor').'</h2>
                    <div class="wcmp_policies_description description" >'.$policies['cancellation_policy'].'</div>
                </div>';
            }
            $content .='</div>';
        }
        echo $content; 

        do_action($this->widget_cssclass . '_bottom', $vendor);
        
        $this->widget_end($args);
    }

    function get_wcmp_vendor_policies($vendor = 0) {
        $policies = array();
        $shipping_policy = get_wcmp_vendor_settings('shipping_policy');
        $refund_policy = get_wcmp_vendor_settings('refund_policy');
        $cancellation_policy = get_wcmp_vendor_settings('cancellation_policy');
        if (apply_filters('wcmp_vendor_can_overwrite_policies', true) && $vendor) {
            $shipping_policy = get_user_meta($vendor->id, '_vendor_shipping_policy', true) ? get_user_meta($vendor->id, '_vendor_shipping_policy', true) : $shipping_policy;
            $refund_policy = get_user_meta($vendor->id, '_vendor_refund_policy', true) ? get_user_meta($vendor->id, '_vendor_refund_policy', true) : $refund_policy;
            $cancellation_policy = get_user_meta($vendor->id, '_vendor_cancellation_policy', true) ? get_user_meta($vendor->id, '_vendor_cancellation_policy', true) : $cancellation_policy;
        }
        if (!empty($shipping_policy)) {
            $policies['shipping_policy'] = $shipping_policy;
        }
        if (!empty($refund_policy)) {
            $policies['refund_policy'] = $refund_policy;
        }
        if (!empty($cancellation_policy)) {
            $policies['cancellation_policy'] = $cancellation_policy;
        }
        return $policies;
    }
    
}