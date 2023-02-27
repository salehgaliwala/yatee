<?php

/*************************************************
## Recently Viewed Products Always
*************************************************/ 
function bacola_track_product_view() {
	if ( ! is_singular( 'product' )) {
		return;
	}

	global $post;

	if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) { // @codingStandardsIgnoreLine.
		$viewed_products = array();
	} else {
		$viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ); // @codingStandardsIgnoreLine.
	}

	// Unset if already in viewed products list.
	$keys = array_flip( $viewed_products );

	if ( isset( $keys[ $post->ID ] ) ) {
		unset( $viewed_products[ $keys[ $post->ID ] ] );
	}

	$viewed_products[] = $post->ID;

	if ( count( $viewed_products ) > 15 ) {
		array_shift( $viewed_products );
	}

	// Store for session only.
	wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}

remove_action( 'template_redirect', 'wc_track_product_view', 20 );
add_action( 'template_redirect', 'bacola_track_product_view', 20 );

/*************************************************
## Recently Viewed Products Loop
*************************************************/ 
function bacola_recently_viewed_product_loop(){
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array(); // @codingStandardsIgnoreLine
	$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );

	if ( empty( $viewed_products) || !is_woocommerce()) {
		return;
	}

	$column = get_theme_mod('bacola_recently_viewed_products_column', 4);

	$args = array(
		'post_type' => 'product',
		'posts_per_page' => $column,
		'post__in'       => $viewed_products,
		'orderby'        => 'post__in',
		'post_status'    => 'publish',
	);
	
	$loop = new WP_Query( $args );
	
	echo '<section class="klb-module site-module recently-viewed">';
	echo '<div class="container">';
	echo '<div class="klb-title module-header">';
	echo '<h4 class="entry-title">'.esc_html__('Recently Viewed Products','bacola-core').'</h4>';
	echo '</div>';
	if(bacola_shop_view() == 'list_view') {
		echo '<div class="products column-1 mobile-column-1 align-inherit">';
	} else {
		echo '<div class="products column-'.esc_attr($column).' mobile-column-2 align-inherit">';
	}

	if ( $loop->have_posts() ) {
		while ( $loop->have_posts() ) : $loop->the_post();
			wc_get_template_part( 'content', 'product' );
		endwhile;
	} else {
		echo esc_html__( 'No products found', 'bacola-core');
	}
	
	echo '</div>';
	echo '</div>';
	echo '</section>';
	
	wp_reset_postdata();	
}
add_action('get_footer','bacola_recently_viewed_product_loop');