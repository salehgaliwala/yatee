<?php
/**
 * WCMp Edit Product setup
 *
 * @package  WCMp/classes/products
 * @since    3.3.0
 */
defined( 'ABSPATH' ) || exit;

class WCMp_Products_Edit_Product {

    protected $product_id = '';
    protected $product_object = null;
    protected $post_object = null;
    protected $is_update = false;
    protected $is_spmv = false;
    private $no_cap = false;
    private $error_msg = '';

    public function __construct() {
        global $wp;

        $this->product_id = $wp->query_vars[get_wcmp_vendor_settings( 'wcmp_edit_product_endpoint', 'vendor', 'general', 'edit-product' )];
        $this->product_object = new WC_Product();

        if ( $this->product_id && $this->product_capablity_check( 'edit', $this->product_id ) ) {
            $this->product_object = wc_get_product( $this->product_id );
            $this->post_object = get_post( $this->product_id );
            $this->is_update = true;
        } elseif ( ! $this->product_id && $this->product_capablity_check( 'add' ) ) {
            $this->post_object = $this->create_product_draft( 'product' );
            $this->product_id = $this->post_object ? $this->post_object->ID : '';
            $this->is_update = false;
        } else {
            $this->no_cap = true;
        }
        
        if ( ! $this->no_cap ) {
            do_action( 'after_wcmp_edit_product_endpoint_load', $this->product_id, $this->product_object, $this->post_object );
        }
        // If vendor's have policy overwrite capability, add policy tab to product data tab panel
        if ( get_wcmp_vendor_settings( 'is_policy_on', 'general' ) == 'Enable' && apply_filters( 'wcmp_vendor_can_overwrite_policies', true ) ) {
            add_filter( 'wcmp_product_data_tabs', array( $this, 'add_policy_tab' ) );
            add_action( 'wcmp_product_tabs_content', array( $this, 'policy_tab_content' ) );
        }
        // If vendor's don't have shipping allowed, remove shipping tab
        if ( apply_filters('wcmp_disabled_product_shipping_tab', true) && !wcmp_is_allowed_vendor_shipping() ) {
            add_filter( 'wcmp_product_data_tabs', array( $this, 'remove_shipping_tab' ) );
        }
        //check support for virtual and downloadable
        add_filter( 'wcmp_product_type_options', array( $this, 'wcmp_set_product_type_options' ), 99 );
    }

    private function product_capablity_check( $action = 'add', $product_id = '' ) {
        global $WCMp;
        $current_vendor_id = apply_filters('wcmp_current_vendor_product_capability',get_current_user_id() ) ;
        if ( ! $current_vendor_id ) {
            $this->error_msg = __( 'You do not have permission to view this content. Please contact site administrator.', 'dc-woocommerce-multi-vendor' );
            return false;
        }
        $product_vendor = get_wcmp_product_vendors( $product_id );
        if ( $product_vendor && $current_vendor_id !== $product_vendor->id ) {
            $this->error_msg = __( 'You do not have permission to view this content. Please contact site administrator.', 'dc-woocommerce-multi-vendor' );
            return false;
        }
        if ( ! empty( wcmp_get_product_types() ) ) {
            switch ( $action ) {
                case 'add':
                    if ( ! ( current_vendor_can( 'edit_products' ) ) ) {
                        $this->error_msg = __( 'You do not have enough permission to submit a new coupon. Please contact site administrator.', 'dc-woocommerce-multi-vendor' );
                        return false;
                    }
                    return true;
                case 'edit':
                    if ( $product_id && get_wcmp_product_vendors( $product_id ) ) {
                        $product = wc_get_product( $product_id );
                        if ( $product->get_status() === 'trash' ) {
                            $this->error_msg = __( 'You can&#8217;t edit this item because it is in the Trash. Please restore it and try again.', 'dc-woocommerce-multi-vendor' );
                            return false;
                        }
                        if ( $product->get_status() === 'publish' ) {
                            if ( ! current_vendor_can( 'edit_published_products' ) ) {
                                $this->error_msg = __( 'Sorry, you are not allowed to edit this item.', 'dc-woocommerce-multi-vendor' );
                                return false;
                            }
                        } else {
                            if ( ! current_vendor_can( 'edit_product' ) ) {
                                $this->error_msg = __( 'Sorry, you are not allowed to edit this item.', 'dc-woocommerce-multi-vendor' );
                                return false;
                            }
                        }
                        return true;
                    }
                    $this->error_msg = __( 'You attempted to edit an item that doesn&#8217;t exist. Perhaps it was deleted?', 'dc-woocommerce-multi-vendor' );
                    return false;
            }
        } else {
            $this->error_msg = __( 'No allowed Product types found. Please contact site administrator.', 'dc-woocommerce-multi-vendor' );
        }
        return false;
    }

    private function product_no_caps_notice() {
        ob_start();
        ?>
        <div class="col-md-12">
            <div class="panel panel-default">
                <?php echo $this->error_msg; ?>
            </div>
        </div><?php
        return;
    }

    private function create_product_draft( $post_type ) {
        $user = wp_get_current_user();
        $vendor = get_wcmp_vendor( $user->ID );
        if ( $vendor && $vendor->id ) {
            $post_id = wp_insert_post( array( 'post_title' => __( 'Auto Draft', 'dc-woocommerce-multi-vendor' ), 'post_type' => $post_type, 'post_status' => 'auto-draft' ) );
            return get_post( $post_id );
        }
        return false;
    }

    /**
     * 
     * @return integer product id
     */
    public function get_the_id() {
        return $this->product_id;
    }

    /**
     * Return array of tabs to show.
     * @return array
     */
    public function get_product_data_tabs() {
        $tabs = apply_filters( 'wcmp_product_data_tabs', array(
            'general'        => array(
                'label'    => __( 'General', 'dc-woocommerce-multi-vendor' ),
                'target'   => 'general_product_data',
                'class'    => array( 'hide_if_grouped', 'show_if_simple' ),
                'priority' => 10,
            ),
            'inventory'      => array(
                'label'    => __( 'Inventory', 'dc-woocommerce-multi-vendor' ),
                'target'   => 'inventory_product_data',
                'class'    => array( 'show_if_simple', 'show_if_variable', 'show_if_grouped', 'show_if_external' ),
                'priority' => 20,
            ),
            'shipping'       => array(
                'label'    => __( 'Shipping', 'dc-woocommerce-multi-vendor' ),
                'target'   => 'shipping_product_data',
                'class'    => array( 'hide_if_virtual', 'hide_if_grouped', 'hide_if_external' ),
                'priority' => 30,
            ),
            'linked_product' => array(
                'label'    => __( 'Linked Products', 'dc-woocommerce-multi-vendor' ),
                'target'   => 'linked_product_data',
                'class'    => array(),
                'priority' => 40,
            ),
            'attribute'      => array(
                'label'    => __( 'Attributes', 'dc-woocommerce-multi-vendor' ),
                'target'   => 'product_attributes_data',
                'class'    => array(),
                'priority' => 50,
            ),
            'variations'     => array(
                'p_type'   => 'variable',
                'label'    => __( 'Variations', 'dc-woocommerce-multi-vendor' ),
                'target'   => 'variable_product_options',
                'class'    => array( 'show_if_variable' ),
                'priority' => 60,
            ),
            'advanced'       => array(
                'label'    => __( 'Advanced', 'dc-woocommerce-multi-vendor' ),
                'target'   => 'advanced_product_data',
                'class'    => array(),
                'priority' => 70,
            ),
             'bookings'       => array(
                'label'    => __( 'Bookings', 'woocommerce-easy-booking-system' ),
                'target'   => 'booking_product_data',
                'class'    => array( 'show_if_bookable' ),
                'priority' => 80
            ),
            
            ) );

        // Sort tabs based on priority.
        uasort( $tabs, array( __CLASS__, 'product_data_tabs_sort' ) );
        return $tabs;
    }

    /**
     * Callback to sort product data tabs on priority.
     *
     * @since 3.1.0
     * @param int $a First item.
     * @param int $b Second item.
     *
     * @return bool
     */
    private static function product_data_tabs_sort( $a, $b ) {
        if ( ! isset( $a['priority'], $b['priority'] ) ) {
            return -1;
        }

        if ( $a['priority'] == $b['priority'] ) {
            return 0;
        }

        return $a['priority'] < $b['priority'] ? -1 : 1;
    }

    /**
     * Add policy tab under product data panel
     * 
     * @param ARRAY_A $tabs
     * @return ARRAY_A
     */
    public function add_policy_tab( $product_tabs ) {
        $policy_tab = array(
            'policies' => array(
                'label'    => __( 'Policies', 'dc-woocommerce-multi-vendor' ),
                'target'   => 'product_policy_data',
                'class'    => array(),
                'priority' => 200,
            ),
        );
        return array_merge( $product_tabs, $policy_tab );
    }

    /**
     * Load policy tab contents
     * 
     * @return string
     */
    public function policy_tab_content() {
        global $WCMp;
        $WCMp->template->get_template( 'vendor-dashboard/product-manager/views/html-product-data-policy.php', array( 'self' => $this, 'product_object' => $this->product_object, 'post' => $this->post_object, 'id' => $this->product_id ) );
    }

    /**
     * Remove shipping tab under product data panel
     * 
     * @param ARRAY_A $tabs
     * @return ARRAY_A
     */
    public function remove_shipping_tab( $product_tabs ) {
        if ( isset( $product_tabs['shipping'] ) ) {
            unset( $product_tabs['shipping'] );
        }
        return $product_tabs;
    }

    /**
     * Return array of product type options.
     * @return array
     */
    public function get_product_type_options() {
        return apply_filters( '', array(
            'virtual'      => array(
                'id'            => '_virtual',
                'wrapper_class' => 'show_if_simple',
                'label'         => __( 'Virtual', 'dc-woocommerce-multi-vendor' ),
                'description'   => __( 'Virtual products are intangible and are not shipped.', 'dc-woocommerce-multi-vendor' ),
                'default'       => 'no',
            ),
            'downloadable' => array(
                'id'            => '_downloadable',
                'wrapper_class' => 'show_if_simple',
                'label'         => __( 'Downloadable', 'dc-woocommerce-multi-vendor' ),
                'description'   => __( 'Downloadable products give access to a file upon purchase.', 'dc-woocommerce-multi-vendor' ),
                'default'       => 'no',
            ),
            'wceb_bookable' => array(
            'id'            => '_bookable',
            'wrapper_class' => implode( ' ', $show ),
            'label'         => __( 'Bookable', 'woocommerce-easy-booking-system' ),
            'description'   => __( 'Bookable products require the selection of one or two date(s).', 'woocommerce-easy-booking-system' ),
            'default'       => 'no'
            
            ),           

             ));
    }

    /**
     * Filter callback for finding variation attributes.
     * @param  WC_Product_Attribute $attribute
     * @return bool
     */
    public function filter_variation_attributes( $attribute ) {
        return true === $attribute->get_variation();
    }

    public function output() {
        global $WCMp;

        if ( ! $this->no_cap ) {
            $downloadable_contents = array();
            $downloadable_files = $this->product_object->get_downloads( 'edit' );
            if ( $downloadable_files ) {
                foreach ( $downloadable_files as $key => $file ) {
                    $downloadable_contents[] = array(
                        'key'  => $key,
                        'file' => esc_attr( $file['file'] ),
                        'name' => esc_attr( $file['name'] )
                    );
                }
            }
            $edit_product_params = apply_filters( 'wcmp_advance_product_script_params', array(
                'ajax_url'                            => admin_url( 'admin-ajax.php' ),
                'product_id'                          => $this->product_id,
                'search_products_nonce'               => wp_create_nonce( 'search-products' ),
                'add_attribute_nonce'                 => wp_create_nonce( 'add-attribute' ),
                'save_attributes_nonce'               => wp_create_nonce( 'save-attributes' ),
                'add_variation_nonce'                 => wp_create_nonce( 'add-variation' ),
                'link_variation_nonce'                => wp_create_nonce( 'link-variations' ),
                'delete_variations_nonce'             => wp_create_nonce( 'delete-variations' ),
                'load_variations_nonce'               => wp_create_nonce( 'load-variations' ),
                'save_variations_nonce'               => wp_create_nonce( 'save-variations' ),
                'bulk_edit_variations_nonce'          => wp_create_nonce( 'bulk-edit-variations' ),
                'save_product_nonce'                  => wp_create_nonce( 'save-product' ),
                'product_data_tabs'                   => json_encode( $this->get_product_data_tabs() ),
                'default_product_types'               => json_encode( wcmp_default_product_types() ),
                'product_types'                       => json_encode( wcmp_get_product_types() ),
                'product_type'                        => $this->product_object->get_type(),
                'downloadable_files'                  => json_encode( $downloadable_contents ),
                'attributes'                          => $this->product_object->get_attributes( 'edit' ),
                'custom_attribute'                    => apply_filters( 'vendor_can_add_custom_attribute', true ),
                'new_attribute_prompt'                => esc_js( __( 'Enter a name for the new attribute term:', 'dc-woocommerce-multi-vendor' ) ),
                'remove_attribute'                    => esc_js( __( 'Remove this attribute?', 'dc-woocommerce-multi-vendor' ) ),
                'woocommerce_placeholder_img_src'     => wc_placeholder_img_src(),
                'i18n_link_all_variations'            => esc_js( sprintf( __( 'Are you sure you want to link all variations? This will create a new variation for each and every possible combination of variation attributes (max %d per run).', 'dc-woocommerce-multi-vendor' ), defined( 'WC_MAX_LINKED_VARIATIONS' ) ? WC_MAX_LINKED_VARIATIONS : 50 ) ),
                'i18n_enter_a_value'                  => esc_js( __( 'Enter a value', 'dc-woocommerce-multi-vendor' ) ),
                'i18n_enter_menu_order'               => esc_js( __( 'Variation menu order (determines position in the list of variations)', 'dc-woocommerce-multi-vendor' ) ),
                'i18n_enter_a_value_fixed_or_percent' => esc_js( __( 'Enter a value (fixed or %)', 'dc-woocommerce-multi-vendor' ) ),
                'i18n_delete_all_variations'          => esc_js( __( 'Are you sure you want to delete all variations? This cannot be undone.', 'dc-woocommerce-multi-vendor' ) ),
                'i18n_last_warning'                   => esc_js( __( 'Last warning, are you sure?', 'dc-woocommerce-multi-vendor' ) ),
                'i18n_choose_image'                   => esc_js( __( 'Choose an image', 'dc-woocommerce-multi-vendor' ) ),
                'i18n_set_image'                      => esc_js( __( 'Set variation image', 'dc-woocommerce-multi-vendor' ) ),
                'i18n_variation_added'                => esc_js( __( "variation added", 'dc-woocommerce-multi-vendor' ) ),
                'i18n_variations_added'               => esc_js( __( "variations added", 'dc-woocommerce-multi-vendor' ) ),
                'i18n_no_variations_added'            => esc_js( __( "No variations added", 'dc-woocommerce-multi-vendor' ) ),
                'i18n_remove_variation'               => esc_js( __( 'Are you sure you want to remove this variation?', 'dc-woocommerce-multi-vendor' ) ),
                'i18n_scheduled_sale_start'           => esc_js( __( 'Sale start date (YYYY-MM-DD format or leave blank)', 'dc-woocommerce-multi-vendor' ) ),
                'i18n_scheduled_sale_end'             => esc_js( __( 'Sale end date (YYYY-MM-DD format or leave blank)', 'dc-woocommerce-multi-vendor' ) ),
                'i18n_edited_variations'              => esc_js( __( 'Save changes before changing page?', 'dc-woocommerce-multi-vendor' ) ),
                'i18n_variation_count_single'         => esc_js( __( '%qty% variation', 'dc-woocommerce-multi-vendor' ) ),
                'i18n_variation_count_plural'         => esc_js( __( '%qty% variations', 'dc-woocommerce-multi-vendor' ) ),
                'variations_per_page'                 => absint( apply_filters( 'woocommerce_admin_meta_boxes_variations_per_page', 15 ) ),
                'mon_decimal_point'                   => wc_get_price_decimal_separator(),
                'add_tags'                            => apply_filters( 'wcmp_vendor_can_add_product_tag', true, get_current_vendor_id() ),
                ) );
            wp_localize_script( 'wcmp-advance-product', 'wcmp_advance_product_params', $edit_product_params );
            wp_enqueue_script( 'wcmp-advance-product' );
            do_action( 'wcmp_edit_product_template_load', $this->product_id, $this->product_object, $this->post_object );
            $WCMp->template->get_template( 'vendor-dashboard/product-manager/edit-product.php', array( 'self' => $this, 'product_object' => $this->product_object, 'post' => $this->post_object, 'is_update' => $this->is_update ) );
        } else {
            $this->product_no_caps_notice();
        }
    }

    
    /**
     * Check product is in SPMV product or not
     * 
     * @return boolean
     */
    public function is_spmv() {
        // Is SPMV
        $this->is_spmv = is_product_wcmp_spmv($this->product_id);
        return $this->is_spmv;
    }
    
    /**
     * Get product GTIN term
     * 
     * @return Array object on success, or boolean false on error
     */
    public function get_gtin_term() {
        global $WCMp;
        $gtin_terms = wp_get_post_terms($this->product_id, $WCMp->taxonomy->wcmp_gtin_taxonomy);
        if($gtin_terms && isset($gtin_terms[0])){
            return $gtin_terms[0];
        }
        return false;
    }
    
    /**
     * Get product GTIN No
     * 
     * @return string data
     */
    public function get_gtin_no() {
        return (get_post_meta($this->product_id, '_wcmp_gtin_code', true)) ? get_post_meta($this->product_id, '_wcmp_gtin_code', true) : '';
    }
    
    public function wcmp_set_product_type_options( $option ) {
        global $WCMp;
        foreach ( $option as $key => $val ) {
            if ( ! $WCMp->vendor_caps->vendor_can( $key ) ) {
                unset( $option[$key] );
            }
        }
        return $option;
    }

}
