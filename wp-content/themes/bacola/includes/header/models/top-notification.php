<?php
if ( ! function_exists( 'bacola_top_notification' ) ) {
	function bacola_top_notification(){
		$topheadertext = get_theme_mod('bacola_top_header_notice','0'); 
		
		if($topheadertext == '1'){ ?>
			<aside class="store-notice">
				<div class="container">
					<?php echo bacola_sanitize_data(get_theme_mod('bacola_top_header_notice_text')); ?>
				</div>
			</aside>
		<?php }

	}
}