<?php $sidebarmenu = get_theme_mod('bacola_header_sidebar','0'); ?>

<?php if($sidebarmenu == '1'){ ?>
	<div class="all-categories locked">
		<a href="#" data-toggle="collapse" data-target="#all-categories">
			<i class="klbth-icon-menu-thin"></i>
			<span class="text"><?php esc_html_e('ALL CATEGORIES','bacola'); ?></span>
			<?php $total_products = wp_count_posts( 'product' ); ?>
			<?php $total_count = $total_products->publish; ?>
			<?php $total_format = esc_html__('TOTAL %s PRODUCTS','bacola'); ?>
			
			<div class="description"><?php echo sprintf($total_format, $total_count); ?></div>
		</a>
		
		<?php $menu_collapse = is_front_page() && !get_theme_mod('bacola_header_sidebar_collapse') ? 'show' : ''; ?>
		<div class="dropdown-categories collapse <?php echo esc_attr($menu_collapse); ?>" id="all-categories">
			<?php 
			wp_nav_menu(array(
			'theme_location' => 'sidebar-menu',
			'container' => '',
			'fallback_cb' => 'show_top_menu',
			'menu_id' => '',
			'menu_class' => 'menu-list',
			'echo' => true,
			"walker" => new bacola_sidebar_walker(),
			'depth' => 0 
			));
			?>
		</div>
		
	</div>
<?php } ?>