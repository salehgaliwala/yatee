<?php

/*************************************************
## Styles and Scripts
*************************************************/ 
define('KLB_INDEX_JS', plugin_dir_url( __FILE__ )  . '/js');
define('KLB_INDEX_CSS', plugin_dir_url( __FILE__ )  . '/css');

function klb_scripts() {
	wp_register_script( 'klb-location-filter', 	 plugins_url(   '/taxonomy/js/location-filter.js', __FILE__ ), true );
	wp_register_script( 'jquery-socialshare',    KLB_INDEX_JS . '/jquery-socialshare.js', array('jquery'), '1.0', true);
	wp_register_script( 'klb-social-share', 	 KLB_INDEX_JS . '/custom/social_share.js', array('jquery'), '1.0', true);
	wp_register_script( 'klb-gdpr', 	  		 KLB_INDEX_JS . '/custom/gdpr.js', array('jquery'), '1.0', true);

	if (function_exists('get_wcmp_vendor_settings') && is_user_logged_in()) {
		if(is_vendor_dashboard()){
			wp_deregister_script( 'bootstrap');
			wp_deregister_script( 'jquery-nice-select');
		}
	}
}
add_action( 'wp_enqueue_scripts', 'klb_scripts' );

/*----------------------------
  Elementor Get Templates
 ----------------------------*/
if ( ! function_exists( 'bacola_get_elementorTemplates' ) ) {
    function bacola_get_elementorTemplates( $type = null )
    {
        if ( class_exists( '\Elementor\Plugin' ) ) {

            $args = [
                'post_type' => 'elementor_library',
                'posts_per_page' => -1,
            ];

            $templates = get_posts( $args );
            $options = array();

            if ( !empty( $templates ) && !is_wp_error( $templates ) ) {

				$options['0'] = esc_html__('Set a Template','bacola-core');

                foreach ( $templates as $post ) {
                    $options[ $post->ID ] = $post->post_title;
                }
            } else {
                $options = array(
                    '' => esc_html__( 'No template exist.', 'bacola-core' )
                );
            }

            return $options;
        }
    }
}


/*----------------------------
  Single Share
 ----------------------------*/
add_action( 'woocommerce_single_product_summary', 'bacola_social_share', 70);
function bacola_social_share(){
	$socialshare = get_theme_mod( 'bacola_shop_social_share', '0' );

	if($socialshare == '1'){
		wp_enqueue_script('jquery-socialshare');
		wp_enqueue_script('klb-social-share');
	
	   $single_share_multicheck = get_theme_mod('bacola_shop_single_share',array( 'facebook', 'twitter', 'pinterest', 'linkedin', 'reddit', 'whatsapp'));
	   
	   echo '<div class="product-share">';
		   echo '<div class="social-share site-social style-1">';
			   echo '<ul class="social-container">';
					if(in_array('facebook', $single_share_multicheck)){
						echo '<li><a href="#" class="facebook"><i class="klbth-icon-facebook"></i></a></li>';
					}
					if(in_array('twitter', $single_share_multicheck)){
						echo '<li><a href="#" class="twitter"><i class="klbth-icon-twitter"></i></a></li>';
					}
					if(in_array('pinterest', $single_share_multicheck)){
						echo '<li><a href="#" class="pinterest"><i class="klbth-icon-pinterest"></i></a></li>';
					}
					if(in_array('linkedin', $single_share_multicheck)){
						echo '<li><a href="#" class="linkedin"><i class="klbth-icon-linkedin"></i></a></li>';
					}
					if(in_array('reddit', $single_share_multicheck)){
						echo '<li><a href="#" class="reddit"><i class="klbth-icon-reddit"></i></a></li>';
					}
					if(in_array('whatsapp', $single_share_multicheck)){
						echo '<li><a href="#" class="whatsapp"><i class="klbth-icon-whatsapp"></i></a></li>';
					}
				echo '</ul>';
			echo '</div>';
		echo '</div>';

	}

}

/*----------------------------
  Single Add To wishlist
 ----------------------------*/
add_action( 'woocommerce_single_product_summary', 'bacola_single_add_to_wishlist', 35);
add_action( 'quickview-wishlist-compare', 'bacola_single_add_to_wishlist', 35);
add_action( 'listview-wishlist-compare', 'bacola_single_add_to_wishlist', 35);
function bacola_single_add_to_wishlist(){
	$wishlist = get_theme_mod( 'bacola_wishlist_button', '0' );
	$compare = get_theme_mod( 'bacola_compare_button', '0' );

	if($wishlist || $compare){
		echo '<div class="product-actions">';
		if($wishlist == '1' && function_exists('run_tinv_wishlist')){
			echo do_shortcode('[ti_wishlists_addtowishlist]');
		}
		if($compare == '1' && function_exists( 'woosc_init' )){
		echo do_shortcode('[woosc]');
		}
		echo '</div>';
	}

}

/*----------------------------
  Single Product Data (type,mfg,life)
 ----------------------------*/
add_action( 'woocommerce_single_product_summary', 'bacola_single_product_data', 36);
function bacola_single_product_data(){
	
	$type = get_post_meta( get_the_ID(), 'klb_product_type', true );
	$year = get_post_meta( get_the_ID(), 'klb_product_mfg', true );
	$life = get_post_meta( get_the_ID(), 'klb_product_life', true );
	
	if($type || $year || $life){
		echo '<div class="product-checklist">';
		echo '<ul>';
		if($type){
		echo '<li>'.esc_html__('Type:','bacola-core').' '.esc_html($type).'</li>';
		}
		if($year){
		echo '<li>'.esc_html__('MFG:','bacola-core').' '.esc_html($year).'</li>';
		}
		if($life){
		echo '<li>'.esc_html__('LIFE:','bacola-core').' '.esc_html($life).'</li>';
		}
		echo '</ul>';
		echo '</div>';
	}

}

/*----------------------------
  Update Cart When Quantity changed on CART PAGE.
 ----------------------------*/
add_action( 'woocommerce_after_cart', 'bacola_update_cart' );
function bacola_update_cart() {
    echo '<script>
	
	var timeout;
	
    jQuery(document).ready(function($) {

		var timeout;

		$(\'.woocommerce\').on(\'change\', \'input.qty\', function(){

			if ( timeout !== undefined ) {
				clearTimeout( timeout );
			}

			timeout = setTimeout(function() {
				$("[name=\'update_cart\']").trigger("click");
			}, 1000 ); // 1 second delay, half a second (500) seems comfortable too

		});

    });
    </script>';
}

/*----------------------------
  Disable Crop Image WCMP
 ----------------------------*/
add_filter('wcmp_frontend_dash_upload_script_params', 'bacola_crop_function');
function bacola_crop_function( $image_script_params ) {
	$image_script_params['canSkipCrop'] = true;
	return $image_script_params;
}
