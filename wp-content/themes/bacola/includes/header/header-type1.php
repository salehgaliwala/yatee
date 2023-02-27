<header id="masthead" class="site-header desktop-shadow-disable mobile-shadow-enable mobile-nav-enable" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
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
						<span><?php echo bacola_sanitize_data(get_theme_mod('bacola_top_header_text')); ?></span>
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
							<img class="desktop-logo hide-mobile" src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'bacola_logo' )) ); ?>" alt="<?php bloginfo("name"); ?>">
						<?php } elseif (get_theme_mod( 'bacola_logo_text' )) { ?>
							<span class="brand-text hide-mobile"><?php echo esc_html(get_theme_mod( 'bacola_logo_text' )); ?></span>
						<?php } else { ?>
							<img class="desktop-logo hide-mobile" src="<?php echo get_template_directory_uri(); ?>/assets/images/bacola-logo.png" width="164" height="44" alt="<?php bloginfo("name"); ?>">
						<?php } ?>

						<?php if (get_theme_mod( 'bacola_mobile_logo' )) { ?>
							<img class="mobile-logo hide-desktop" src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'bacola_mobile_logo' )) ); ?>" alt="<?php bloginfo("name"); ?>">
						<?php } else { ?>
							<img class="mobile-logo hide-desktop" src="<?php echo get_template_directory_uri(); ?>/assets/images/bacola-logo-mobile.png" alt="<?php bloginfo("name"); ?>">   
						<?php } ?>
						<?php if(get_theme_mod('bacola_logo_desc')){ ?>
							<span class="brand-description"><?php echo esc_html(get_theme_mod('bacola_logo_desc')); ?></span>
						<?php } ?>
					</a>
				</div><!-- site-brand -->
			</div><!-- column -->
			<div class="column column-center">
				<?php if(get_theme_mod('bacola_location_filter',0) == 1){ ?>
					<div class="header-location site-location hide-mobile">
						<a href="#">
							<span class="location-description"><?php esc_html_e('Your Location','bacola'); ?></span>
							<?php if(bacola_location() == 'all'){ ?>
								<div class="current-location"><?php esc_html_e('Select a Location','bacola'); ?></div>
							<?php } else { ?>
								<div class="current-location activated"><?php echo esc_html(bacola_location()); ?></div>
							<?php } ?>
						</a>
					</div>
				<?php } ?>

				<?php if(get_theme_mod('bacola_header_search',0) == 1){ ?>
					<div class="header-search">
						<?php if(get_theme_mod('bacola_ajax_search_form',0) == 1 && class_exists( 'DGWT_WC_Ajax_Search' )){ ?>
							<?php echo do_shortcode('[wcas-search-form]'); ?>
						<?php } else { ?>
							<?php echo bacola_header_product_search(); ?>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="column column-right">
				<div class="header-buttons">
					<?php $headeraccounticon  = get_theme_mod('bacola_header_account','0'); ?>
					<?php if($headeraccounticon){ ?>
						<div class="header-login button-item bordered">
							<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>">
								<div class="button-icon"><i class="klbth-icon-user"></i></div>
							</a>
						</div>
					<?php } ?>

					<?php $headercart = get_theme_mod('bacola_header_cart','0'); ?>
					<?php if($headercart == '1'){ ?>
						<?php global $woocommerce; ?>
						<?php $carturl = wc_get_cart_url(); ?>
						<div class="header-cart button-item bordered">
							<a href="<?php echo esc_url($carturl); ?>">
								<div class="cart-price"><?php echo WC()->cart->get_cart_subtotal(); ?></div>
								<div class="button-icon"><i class="klbth-icon-shopping-bag"></i></div>
								<span class="cart-count-icon"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'bacola'), $woocommerce->cart->cart_contents_count);?></span>
							</a>
							<div class="cart-dropdown hide">
								<div class="cart-dropdown-wrapper">
									<div class="fl-mini-cart-content">
										<?php woocommerce_mini_cart(); ?>
									</div>

									<?php if(get_theme_mod('bacola_header_mini_cart_notice')){ ?>
										<div class="cart-noticy">
											<?php echo esc_html(get_theme_mod('bacola_header_mini_cart_notice')); ?>
										</div><!-- cart-noticy -->
									<?php } ?>
								</div><!-- cart-dropdown-wrapper -->
							</div><!-- cart-dropdown -->
						</div><!-- button-item -->
					<?php } ?>
				</div><!-- header-buttons -->
			</div><!-- column -->
		</div><!-- container -->
	</div><!-- header-main -->



	<div class="header-nav header-wrapper hide-mobile">
		<div class="container">
		
			<?php get_template_part( 'includes/header/models/sidebar-menu' ); ?>

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
		</div><!-- container -->
	</div><!-- header-nav -->

	<?php do_action('bacola_mobile_bottom_menu'); ?>
</header><!-- site-header -->