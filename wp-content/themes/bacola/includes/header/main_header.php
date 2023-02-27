<?php

/*************************************************
## Bacola Theme options
*************************************************/

require_once get_template_directory() . '/includes/header/models/canvas-menu.php';
require_once get_template_directory() . '/includes/header/models/top-notification.php';

add_action('bacola_main_header','bacola_canvas_menu',10);
add_action('bacola_main_header','bacola_top_notification',20);
add_action('bacola_main_header','bacola_main_header_function',30);

if ( ! function_exists( 'bacola_main_header_function' ) ) {
	function bacola_main_header_function(){

		if(get_theme_mod('bacola_header_type') == 'type1'){
			get_template_part( 'includes/header/header-type1' );
		} else {
			get_template_part( 'includes/header/header-type2' );
		}
		
	}
}



?>
