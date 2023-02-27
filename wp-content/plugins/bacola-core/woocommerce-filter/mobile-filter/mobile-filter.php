<?php
/*************************************************
* Mobile Filter
*************************************************/
add_action('bacola_mobile_bottom_menu', 'bacola_mobile_filter'); 
function bacola_mobile_filter() { 

	$mobilebottommenu = get_theme_mod('bacola_mobile_bottom_menu','0');
	if($mobilebottommenu == '1'){

?>

	<?php $edittoggle = get_theme_mod('bacola_mobile_bottom_menu_edit_toggle','0'); ?>
	<?php if($edittoggle == '1'){ ?>
		<nav class="header-mobile-nav">
			<div class="mobile-nav-wrapper">
				<ul>
					<?php $editrepeater = get_theme_mod('bacola_mobile_bottom_menu_edit'); ?>
					
					<?php foreach($editrepeater as $e){ ?>
						<?php if($e['mobile_menu_type'] == 'filter'){ ?>
							<?php if(is_shop()){ ?>
								<li class="menu-item">
									<a href="#" class="filter-toggle">
										<i class="klbth-icon-<?php echo esc_attr($e['mobile_menu_icon']); ?>"></i>
										<span><?php echo esc_html($e['mobile_menu_text']); ?></span>
									</a>
								</li>
							<?php } ?>
						<?php } elseif($e['mobile_menu_type'] == 'search'){ ?>
							<li class="menu-item">
								<a href="#" class="search">
									<i class="klbth-icon-<?php echo esc_attr($e['mobile_menu_icon']); ?>"></i>
									<span><?php echo esc_html($e['mobile_menu_text']); ?></span>
								</a>
							</li>
						<?php } elseif($e['mobile_menu_type'] == 'category'){ ?>
							<?php if(!is_shop()){ ?>
								<li class="menu-item">
									<a href="#" class="categories">
										<i class="klbth-icon-<?php echo esc_attr($e['mobile_menu_icon']); ?>"></i>
										<span><?php echo esc_html($e['mobile_menu_text']); ?></span>
									</a>
								</li>
							<?php } ?>
						<?php } else { ?>
							<li class="menu-item">
								<a href="<?php echo esc_url($e['mobile_menu_url']); ?>" class="user">
									<i class="klbth-icon-<?php echo esc_attr($e['mobile_menu_icon']); ?>"></i>
									<span><?php echo esc_html($e['mobile_menu_text']); ?></span>
								</a>
							</li>
						<?php } ?>
					<?php } ?>
				
				</ul>
			</div>
		</nav>
	<?php } else { ?>
		<nav class="header-mobile-nav">
			<div class="mobile-nav-wrapper">
				<ul>
					<li class="menu-item">
						<?php if(!is_shop()){ ?>
							<a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="store">
								<i class="klbth-icon-store"></i>
								<span><?php esc_html_e('Store','bacola-core'); ?></span>
							</a>
						<?php } else { ?>
							<a href="<?php echo esc_url( home_url( "/" ) ); ?>" class="store">
								<i class="klbth-icon-home"></i>
								<span><?php esc_html_e('Home','bacola-core'); ?></span>
							</a>
						<?php } ?>
					</li>

					<?php if(is_shop()){ ?>
						<li class="menu-item">
							<a href="#" class="filter-toggle">
								<i class="klbth-icon-filter"></i>
								<span><?php esc_html_e('Filter','bacola-core'); ?></span>
							</a>
						</li>
					<?php } ?>

					<li class="menu-item">
						<a href="#" class="search">
							<i class="klbth-icon-search"></i>
							<span><?php esc_html_e('Search','bacola-core'); ?></span>
						</a>
					</li>
					
					<?php if ( function_exists( 'tinv_url_wishlist_default' ) ) { ?>
						<li class="menu-item">
							<a href="<?php echo tinv_url_wishlist_default(); ?>" class="wishlist">
								<i class="klbth-icon-heart-1"></i>
								<span><?php esc_html_e('Wishlist','bacola-core'); ?></span>
							</a>
						</li>
					<?php } ?>
					
					<li class="menu-item">
						<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" class="user">
							<i class="klbth-icon-user"></i>
							<span><?php esc_html_e('Account','bacola-core'); ?></span>
						</a>
					</li>

					<?php $sidebarmenu = get_theme_mod('bacola_header_sidebar','0'); ?>
					<?php if($sidebarmenu == '1'){ ?>
						<?php if(!is_shop()){ ?>
							<li class="menu-item">
								<a href="#" class="categories">
									<i class="klbth-icon-menu-thin"></i>
									<span><?php esc_html_e('Categories','bacola-core'); ?></span>
								</a>
							</li>
						<?php } ?>
					<?php } ?>

				</ul>
			</div><!-- mobile-nav-wrapper -->
		</nav><!-- header-mobile-nav -->
	<?php } ?>
	
<?php }

    
}