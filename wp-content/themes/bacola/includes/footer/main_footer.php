<?php
if ( ! function_exists( 'bacola_main_footer_function' ) ) {
	function bacola_main_footer_function(){
		
	?>
		<footer class="site-footer">
			<?php $subscribe = get_theme_mod('bacola_footer_subscribe_area',0); ?>
			<?php if($subscribe == 1){ ?>
				<div class="footer-subscribe">
					<div class="container">
						<div class="row">
							<div class="col-12 col-lg-5">
								<div class="subscribe-content">
									<h6 class="entry-subtitle"><?php echo bacola_sanitize_data(get_theme_mod('bacola_footer_subscribe_title')); ?></h6>
									<h3 class="entry-title"><?php echo bacola_sanitize_data(get_theme_mod('bacola_footer_subscribe_subtitle')); ?></h3>
									<div class="entry-teaser">
										<p><?php echo bacola_sanitize_data(get_theme_mod('bacola_footer_subscribe_desc')); ?></p>
									</div>
									<div class="form-wrapper">
										<?php echo do_shortcode('[mc4wp_form id="'.get_theme_mod('bacola_footer_subscribe_formid').'"]'); ?>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-7">
								<?php if(get_theme_mod( 'bacola_footer_subscribe_image' )){ ?>
									<div class="subscribe-image"><img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'bacola_footer_subscribe_image' )) ); ?>" alt="<?php esc_attr_e('subscribe','bacola'); ?>"></div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
	
			<?php $featured_box = get_theme_mod('bacola_footer_featured_box'); ?>
			<?php if($featured_box){ ?>
				<div class="footer-iconboxes">
					<div class="container">
						<div class="row">
							<?php foreach($featured_box as $featured){ ?>
								<div class="col col-12 col-md-6 col-lg-3">
									<div class="iconbox">
										<div class="iconbox-icon"><i class="<?php echo esc_attr($featured['featured_icon']); ?>"></i></div>
										<div class="iconbox-detail">
											<span><?php echo esc_html($featured['featured_text']); ?></span>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>
	
			<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) || is_active_sidebar( 'footer-4' )) { ?>
				<div class="footer-widgets border-enable">
					<div class="container">
						<div class="row">
							<?php if(get_theme_mod('bacola_footer_column') == '3columns'){ ?>
								<div class="col col-12 col-lg-4">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</div>
								<div class="col col-12 col-lg-4">
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</div>
								<div class="col col-12 col-lg-4">
									<?php dynamic_sidebar( 'footer-3' ); ?>
								</div>
							<?php } elseif(get_theme_mod('bacola_footer_column') == '4columns'){ ?>
								<div class="col col-12 col-lg-3">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</div>
								<div class="col col-12 col-lg-3">
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</div>
								<div class="col col-12 col-lg-3">
									<?php dynamic_sidebar( 'footer-3' ); ?>
								</div>
								<div class="col col-12 col-lg-3">
									<?php dynamic_sidebar( 'footer-4' ); ?>
								</div>
							<?php } else { ?>
								<div class="col col-12 col-lg-3 col-five">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</div>
								<div class="col col-12 col-lg-3 col-five">
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</div>
								<div class="col col-12 col-lg-3 col-five">
									<?php dynamic_sidebar( 'footer-3' ); ?>
								</div>
								<div class="col col-12 col-lg-3 col-five">
									<?php dynamic_sidebar( 'footer-4' ); ?>
								</div>
								<div class="col col-12 col-lg-3 col-five">
									<?php dynamic_sidebar( 'footer-5' ); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>
	
			<?php if(get_theme_mod('bacola_footer_contact_area',0) == 1){ ?>
				<div class="footer-contacts">
					<div class="container">
					
						<div class="column column-left">
							<div class="site-phone">
								<div class="phone-icon"><i class="<?php echo esc_html(get_theme_mod('bacola_footer_phone_icon')); ?>"></i></div>
								<div class="phone-detail">
									<h4 class="entry-title"><?php echo esc_html(get_theme_mod('bacola_footer_phone_title')); ?></h4>
									<span><?php echo esc_html(get_theme_mod('bacola_footer_phone_subtitle')); ?></span>
								</div>
							</div>
						</div>
						
						<div class="column column-right">
							<div class="site-mobile-app">
								<div class="app-content">
									<h6 class="entry-title"><?php echo esc_html(get_theme_mod('bacola_footer_app_title')); ?></h6>
									<span><?php echo esc_html(get_theme_mod('bacola_footer_app_subtitle')); ?></span>
								</div>
								<?php $appimage = get_theme_mod('bacola_footer_app_image'); ?>
								<?php if($appimage){ ?>
								<div class="app-buttons">
									<?php foreach($appimage as $app){ ?>
										<a href="<?php echo esc_url($app['app_url']); ?>" class="google-play">
											<img src="<?php echo esc_url( bacola_get_image($app['app_image'])); ?>" alt="<?php esc_attr_e('app','bacola'); ?>">
										</a>
									<?php } ?>
								</div>
								<?php } ?>
							</div>
	
							<?php $footersocial = get_theme_mod('bacola_footer_social_list'); ?>
							<?php if(!empty($footersocial)){ ?>
								<div class="site-social">
									<ul>
										<?php foreach($footersocial as $f){ ?>
											<li><a href="<?php echo esc_url($f['social_url']); ?>" target="_blank"><i class="klbth-icon-<?php echo esc_attr($f['social_icon']); ?>"></i></a></li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>
		
			<div class="footer-bottom border-enable">
				<div class="container">
					<div class="site-copyright">
						<?php if(get_theme_mod( 'bacola_copyright' )){ ?>
							<p><?php echo bacola_sanitize_data(get_theme_mod( 'bacola_copyright' )); ?></p>
						<?php } else { ?>
							<p><?php esc_html_e('Copyright 2022.KlbTheme . All rights reserved','bacola'); ?></p>
						<?php } ?>
					</div>
					
					<?php if(get_theme_mod('bacola_footer_menu',0) == '1'){ ?>
						<nav class="site-menu footer-menu">
							<?php 
							wp_nav_menu(array(
							'theme_location' => 'footer-menu',
							'container' => '',
							'fallback_cb' => 'show_top_menu',
							'menu_id' => '',
							'menu_class' => 'menu',
							'echo' => true,
							"walker" => '',
							'depth' => 0 
							));
							?>
						</nav>
					<?php } ?>
					<?php if(get_theme_mod('bacola_footer_payment_image')){ ?>
						<div class="site-payments"><a href="<?php echo esc_url(get_theme_mod('bacola_footer_payment_image_url')); ?>"><img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod('bacola_footer_payment_image'))); ?>" alt="<?php esc_attr_e('payment','bacola'); ?>"></a></div>
					<?php } ?>
				</div>
			</div>
			
		</footer>
	<?php }
}

add_action('bacola_main_footer','bacola_main_footer_function', 10);