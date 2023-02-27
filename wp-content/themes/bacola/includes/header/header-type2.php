<header id="masthead" class="header-type2 site-header desktop-shadow-disable mobile-shadow-enable mobile-nav-enable" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
	<?php if(get_theme_mod('bacola_top_header',0) == 1){ ?>
		<div class="header-top header-wrapper hide-mobile">
			<div class="container">
				<div class="column column-left">
					<nav class="site-menu horizontal">
						<?php 
							wp_nav_menu(array(
							'theme_location' => 'top-left-menu',
							'container' => '',
							'fallback_cb' => 'show_top_menu',
							'menu_id' => '',
							'menu_class' => 'menu',
							'echo' => true,
							"walker" => '',
							'depth' => 0 
							));
						?>
					</nav><!-- site-menu -->
				</div><!-- column-left -->
				
				<div class="column column-right">

					<div class="topbar-notice">
						<i class="klbth-icon-<?php echo esc_attr(get_theme_mod('bacola_top_header_text_icon')); ?>"></i>
						<span><?php echo esc_html(get_theme_mod('bacola_top_header_text')); ?></span>
					</div>

					<div class="text-content">
						<?php echo bacola_sanitize_data(get_theme_mod('bacola_top_header_content_text')); ?>
					</div>

					<div class="header-switchers">
						<nav class="store-language site-menu horizontal">
							<?php 
								wp_nav_menu(array(
								'theme_location' => 'top-right-menu',
								'container' => '',
								'fallback_cb' => 'show_top_menu',
								'menu_id' => '',
								'menu_class' => 'menu',
								'echo' => true,
								"walker" => '',
								'depth' => 0 
								));
							?>
						</nav><!-- site-menu -->
					</div><!-- header-switchers -->

				</div><!-- column-right -->
			</div><!-- container -->
		</div><!-- header-top -->
	<?php } ?>
	
	<div class="header-main header-wrapper">
		<div class="container">
			<div class="column column-left">
				<div class="header-buttons hide-desktop">
					<div class="header-canvas button-item">
						<a href="#">
							<i class="klbth-icon-menu-thin"></i>
						</a>
					</div><!-- button-item -->
				</div><!-- header-buttons -->
				<div class="site-brand">
					<a href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
						<?php if (get_theme_mod( 'bacola_logo' )) { ?>
							<?php $size = get_theme_mod( 'bacola_logo_size', array( 'width' => '164', 'height' => '44') ); ?>
							<img class="desktop-logo hide-mobile" src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'bacola_logo' )) ); ?>" width="<?php echo esc_attr( $size["width"] ); ?>" height="<?php echo esc_attr( $size["height"] ); ?>" alt="<?php bloginfo("name"); ?>">
						<?php } elseif (get_theme_mod( 'bacola_logo_text' )) { ?>
							<span class="brand-text hide-mobile"><?php echo esc_html(get_theme_mod( 'bacola_logo_text' )); ?></span>
						<?php } else { ?>
							<img class="desktop-logo hide-mobile default-brand" src="<?php echo get_template_directory_uri(); ?>/assets/images/bacola-logo.png" width="164" height="44" alt="<?php bloginfo("name"); ?>">
						<?php } ?>

						<?php if (get_theme_mod( 'bacola_mobile_logo' )) { ?>
							<img class="mobile-logo hide-desktop" src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'bacola_mobile_logo' )) ); ?>" alt="<?php bloginfo("name"); ?>" class="mobile-logo hide-desktop">
						<?php } else { ?>
							<img class="mobile-logo hide-desktop" src="<?php echo get_template_directory_uri(); ?>/assets/images/bacola-logo-mobile.png" alt="<?php bloginfo("name"); ?>" class="mobile-logo hide-desktop">   
						<?php } ?>
						<?php if(get_theme_mod('bacola_logo_desc')){ ?>
							<span class="brand-description"><?php echo esc_html(get_theme_mod('bacola_logo_desc')); ?></span>
						<?php } ?>
					</a>
				</div><!-- site-brand -->
			</div><!-- column -->
			<div class="column column-right hide-mobile">
				<nav class="site-menu primary-menu horizontal">
					<?php
						wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'container' => '',
						'fallback_cb' => 'show_top_menu',
						'menu_id' => '',
						'menu_class' => 'menu',
						'echo' => true,
						"walker" => new bacola_main_walker(),
						'depth' => 0 
						));
					?>
				</nav><!-- site-menu -->
			</div>

		</div><!-- container -->
	</div><!-- header-main -->



	<div class="header-nav header-wrapper hide-mobile">
		<div class="container">
		

		</div><!-- container -->
	</div><!-- header-nav -->

	<?php do_action('bacola_mobile_bottom_menu'); ?>
</header><!-- site-header -->