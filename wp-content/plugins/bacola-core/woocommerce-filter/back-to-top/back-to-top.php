<?php
/*************************************************
## Scripts
*************************************************/
function bacola_back_to_top_scripts() {
	wp_enqueue_script( 'klb-back-to-top',   plugins_url( 'js/back-to-top.js', __FILE__ ), false, '1.0');
	wp_enqueue_style( 'klb-back-to-top',    plugins_url( 'css/back-to-top.css', __FILE__ ), false, '1.0');
}
add_action( 'wp_enqueue_scripts', 'bacola_back_to_top_scripts' );

// **********************************************************************//
// ! Back to top 
// **********************************************************************//

add_action( 'wp_footer', 'bacola_back_top_btn' );

if( ! function_exists( 'bacola_back_top_btn' ) ) {
	function bacola_back_top_btn() {

		?>
		<a href="#" class="scrollToTop" aria-label="<?php esc_html_e( 'Scroll to top button', 'bacola' ); ?>"></a>
		<?php
	}
}