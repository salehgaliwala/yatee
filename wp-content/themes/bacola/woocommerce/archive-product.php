<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

// Elementor `archive` location
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {

	if ( ! bacola_is_pjax() ) {
	    get_header( 'shop' );
	}
	?>
	
	<div class="container">
	
		<?php woocommerce_breadcrumb(); ?>
	
		<?php bacola_do_action( 'bacola_before_main_shop'); ?>
	
		<?php do_action( 'woocommerce_archive_description' ); ?>
	
			<?php if( get_theme_mod( 'bacola_shop_layout' ) == 'full-width' || bacola_get_option() == 'full-width') { ?>
				<div class="row content-wrapper">
					<div class="col-12 col-md-12 col-lg-12 content-primary">
						<?php get_template_part( 'includes/woocommerce/banner' ); ?>
					
						<?php do_action( 'woocommerce_before_main_content' ); ?>
	
						<?php
						if ( woocommerce_product_loop() ) {
							do_action( 'woocommerce_before_shop_loop' );
	
							woocommerce_product_loop_start();
	
							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();
	
									do_action( 'woocommerce_shop_loop' );
	
									wc_get_template_part( 'content', 'product' );
								}
							}
	
							woocommerce_product_loop_end();
	
							do_action( 'woocommerce_after_shop_loop' );
						} else {
							do_action( 'woocommerce_no_products_found' );
						}
						?>
	
						<?php do_action( 'woocommerce_after_main_content' ); ?>
					</div>
					<div id="sidebar" class="col-12 col-md-3 col-lg-3 content-secondary site-sidebar hide-desktop">
						<div class="site-scroll">
							<div class="sidebar-inner">
	
								<div class="sidebar-mobile-header">
									<h3 class="entry-title"><?php esc_html_e('Filter Products','bacola'); ?></h3>
	
									<div class="close-sidebar">
										<i class="klbth-icon-x"></i>
									</div>
								</div>
	
								<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
									<?php dynamic_sidebar( 'shop-sidebar' ); ?>
								<?php } ?>
	
							</div>
						</div>
					</div>
				</div>
			<?php } elseif( get_theme_mod( 'bacola_shop_layout' ) == 'right-sidebar' || bacola_get_option() == 'right-sidebar') { ?>
				<div class="row content-wrapper sidebar-right">
					<div class="col-12 col-md-12 col-lg-12 content-primary">
						<?php get_template_part( 'includes/woocommerce/banner' ); ?>
					
						<?php do_action( 'woocommerce_before_main_content' ); ?>
	
						<?php
						if ( woocommerce_product_loop() ) {
							do_action( 'woocommerce_before_shop_loop' );
	
							woocommerce_product_loop_start();
	
							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();
	
									do_action( 'woocommerce_shop_loop' );
	
									wc_get_template_part( 'content', 'product' );
								}
							}
	
							woocommerce_product_loop_end();
	
							do_action( 'woocommerce_after_shop_loop' );
						} else {
							do_action( 'woocommerce_no_products_found' );
						}
						?>
	
						<?php do_action( 'woocommerce_after_main_content' ); ?>
					</div>
					<div id="sidebar" class="col-12 col-md-3 col-lg-3 content-secondary site-sidebar">
						<div class="site-scroll">
							<div class="sidebar-inner">
	
								<div class="sidebar-mobile-header">
									<h3 class="entry-title"><?php esc_html_e('Filter Products','bacola'); ?></h3>
	
									<div class="close-sidebar">
										<i class="klbth-icon-x"></i>
									</div>
								</div>
	
								<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
									<?php dynamic_sidebar( 'shop-sidebar' ); ?>
								<?php } ?>
	
							</div>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
					<div class="row content-wrapper sidebar-left">
						<div class="col-12 col-md-12 col-lg-12 content-primary">
							<?php get_template_part( 'includes/woocommerce/banner' ); ?>
						
							<?php do_action( 'woocommerce_before_main_content' ); ?>
	
							<?php
							if ( woocommerce_product_loop() ) {
								do_action( 'woocommerce_before_shop_loop' );
	
								woocommerce_product_loop_start();
	
								if ( wc_get_loop_prop( 'total' ) ) {
									while ( have_posts() ) {
										the_post();
	
										do_action( 'woocommerce_shop_loop' );
	
										wc_get_template_part( 'content', 'product' );
									}
								}
	
								woocommerce_product_loop_end();
	
								do_action( 'woocommerce_after_shop_loop' );
							} else {
								do_action( 'woocommerce_no_products_found' );
							}
							?>
	
							<?php do_action( 'woocommerce_after_main_content' ); ?>
						</div>
						<div id="sidebar" class="col-12 col-md-3 col-lg-3 content-secondary site-sidebar">
							<div class="site-scroll">
								<div class="sidebar-inner">
	
									<div class="sidebar-mobile-header">
										<h3 class="entry-title"><?php esc_html_e('Filter Products','bacola'); ?></h3>
	
										<div class="close-sidebar">
											<i class="klbth-icon-x"></i>
										</div>
									</div>
	
									<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
										<?php dynamic_sidebar( 'shop-sidebar' ); ?>
									<?php } ?>
	
								</div>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="row content-wrapper">
						<div class="col-12 col-md-12 col-lg-12 content-primary">
							<?php get_template_part( 'includes/woocommerce/banner' ); ?>
						
							<?php do_action( 'woocommerce_before_main_content' ); ?>
	
							<?php
							if ( woocommerce_product_loop() ) {
								do_action( 'woocommerce_before_shop_loop' );
	
								woocommerce_product_loop_start();
	
								if ( wc_get_loop_prop( 'total' ) ) {
									while ( have_posts() ) {
										the_post();
	
										do_action( 'woocommerce_shop_loop' );
	
										wc_get_template_part( 'content', 'product' );
									}
								}
	
								woocommerce_product_loop_end();
	
								do_action( 'woocommerce_after_shop_loop' );
							} else {
								do_action( 'woocommerce_no_products_found' );
							}
							?>
	
							<?php do_action( 'woocommerce_after_main_content' ); ?>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
	
		<?php bacola_do_action( 'bacola_after_main_shop'); ?>
		
	</div>
	
	<?php
	
		if ( ! bacola_is_pjax() ) {
			get_footer( 'shop' );
		}
}