<?php

class StoreChat extends WCMp_Elementor_TagBase {

    /**
     * Class constructor
     *
     * @since 3.7
     *
     * @param array $data
     */
    public function __construct( $data = [] ) {
        parent::__construct( $data );
    }

    /**
     * Tag name
     *
     * @since 3.7
     *
     * @return string
     */
    public function get_name() {
        return 'wcmp-store-chat-tag';
    }

    /**
     * Tag title
     *
     * @since 3.7
     *
     * @return string
     */
    public function get_title() {
        return __( 'Store Chat Button', 'dc-woocommerce-multi-vendor' );
    }

    /**
     * Render tag
     *
     * @since 3.7
     *
     * @return void
     */
    public function render() {
        global $product;
        if (wcmp_is_store_page()) {
            $vendor_id = wcmp_find_shop_page_vendor();
        } else {
            $vendor = get_wcmp_product_vendors($product->get_id());
            $vendor_id = $vendor->id;
        }
        $enable_vendor_chat = !empty(get_user_meta($vendor_id, 'vendor_chat_enable', true)) ? get_user_meta($vendor_id, 'vendor_chat_enable', true) : '';
        if( get_live_chat_settings('enable_chat') != 'Enable' ) {
            esc_html_e( 'Chat module is not active', 'dc-woocommerce-multi-vendor' );
            return;
        }
        esc_html_e('Chat Now', 'dc-woocommerce-multi-vendor');
    }
}
