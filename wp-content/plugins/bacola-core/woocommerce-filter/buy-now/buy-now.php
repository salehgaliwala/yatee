<?php
/*************************************************
## Buy Now Button For Single Product
*************************************************/
function bacola_add_buy_now_button_single(){
	global $product;
    printf( '<button id="buynow" type="submit" name="bacola-buy-now" value="%d" class="buy_now_button button">%s</button>', $product->get_ID(), esc_html__( 'Buy Now', 'bacola-core' ) );
}
add_action( 'woocommerce_after_add_to_cart_button', 'bacola_add_buy_now_button_single' );

/*************************************************
## Handle for click on buy now
*************************************************/
function bacola_handle_buy_now(){
	if ( !isset( $_REQUEST['bacola-buy-now'] ) ){
		return false;
	}

	WC()->cart->empty_cart();

	$product_id = absint( $_REQUEST['bacola-buy-now'] );
    $quantity = absint( $_REQUEST['quantity'] );

	if ( isset( $_REQUEST['variation_id'] ) ) {

		$variation_id = absint( $_REQUEST['variation_id'] );
		WC()->cart->add_to_cart( $product_id, 1, $variation_id );

	}else{
        WC()->cart->add_to_cart( $product_id, $quantity );
	}

	wp_safe_redirect( wc_get_checkout_url() );
	exit;
}
add_action( 'wp_loaded', 'bacola_handle_buy_now' );