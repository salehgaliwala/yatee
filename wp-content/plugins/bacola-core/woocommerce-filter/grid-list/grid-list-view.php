<?php 
/*************************************************
* Catalog Ordering
*************************************************/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); 
add_action( 'klb_catalog_ordering', 'woocommerce_catalog_ordering', 30 ); 

add_action( 'woocommerce_before_shop_loop', 'bacola_catalog_ordering_start', 30 );
function bacola_catalog_ordering_start(){
?>

	<div class="before-shop-loop">
		<div class="shop-view-selector">
		<?php if(get_theme_mod('bacola_grid_list_view','0') == '1'){ ?>
		
			<?php if(bacola_shop_view() == 'list_view') { ?>
				<a href="<?php echo esc_url(add_query_arg('shop_view','list_view')); ?>" class="shop-view active">
					<i class="klbth-icon-list-grid"></i>
				</a>
				<a href="<?php echo esc_url(add_query_arg(array('column' => '2', 'shop_view' => 'grid_view'))); ?>" class="shop-view">
					<i class="klbth-icon-2-grid"></i>
				</a>
				<a href="<?php echo esc_url(add_query_arg(array('column' => '3', 'shop_view' => 'grid_view'))); ?>" class="shop-view">
					<i class="klbth-icon-3-grid"></i>
				</a>
				<a href="<?php echo esc_url(add_query_arg(array('column' => '4', 'shop_view' => 'grid_view'))); ?>" class="shop-view">
					<i class="klbth-icon-4-grid"></i>
				</a>
			<?php } else { ?>
				<a href="<?php echo esc_url(add_query_arg('shop_view','list_view')); ?>" class="shop-view">
					<i class="klbth-icon-list-grid"></i>
				</a>
				<?php if(bacola_get_column_option() == 2){ ?>
					<a href="<?php echo esc_url(add_query_arg(array('column' => '2', 'shop_view' => 'grid_view'))); ?>" class="shop-view active">
						<i class="klbth-icon-2-grid"></i>
					</a>
					<a href="<?php echo esc_url(add_query_arg(array('column' => '3', 'shop_view' => 'grid_view'))); ?>" class="shop-view">
						<i class="klbth-icon-3-grid"></i>
					</a>
					<a href="<?php echo esc_url(add_query_arg(array('column' => '4', 'shop_view' => 'grid_view'))); ?>" class="shop-view">
						<i class="klbth-icon-4-grid"></i>
					</a>
				<?php } elseif(bacola_get_column_option() == 3){ ?>
					<a href="<?php echo esc_url(add_query_arg(array('column' => '2', 'shop_view' => 'grid_view'))); ?>" class="shop-view">
						<i class="klbth-icon-2-grid"></i>
					</a>
					<a href="<?php echo esc_url(add_query_arg(array('column' => '3', 'shop_view' => 'grid_view'))); ?>" class="shop-view active">
						<i class="klbth-icon-3-grid"></i>
					</a>
					<a href="<?php echo esc_url(add_query_arg(array('column' => '4', 'shop_view' => 'grid_view'))); ?>" class="shop-view">
						<i class="klbth-icon-4-grid"></i>
					</a>
				<?php } else { ?>
					<a href="<?php echo esc_url(add_query_arg(array('column' => '2', 'shop_view' => 'grid_view'))); ?>" class="shop-view">
						<i class="klbth-icon-2-grid"></i>
					</a>
					<a href="<?php echo esc_url(add_query_arg(array('column' => '3', 'shop_view' => 'grid_view'))); ?>" class="shop-view">
						<i class="klbth-icon-3-grid"></i>
					</a>
					<a href="<?php echo esc_url(add_query_arg(array('column' => '4', 'shop_view' => 'grid_view'))); ?>" class="shop-view active">
						<i class="klbth-icon-4-grid"></i>
					</a>
				<?php } ?>

			<?php } ?>
		<?php } ?>
		</div>
		
		<div class="mobile-filter">
			<a href="#" class="filter-toggle">
				<i class="klbth-icon-filter"></i>
				<span><?php esc_html_e('Filter Products','bacola-core'); ?></span>
			</a>
		</div>
		
		<!-- For get orderby from loop -->
		<?php do_action('klb_catalog_ordering'); ?>
		
		
		<!-- For perpage option-->
		<?php if(get_theme_mod('bacola_perpage_view','0') == '1'){ ?>
			<?php $perpage = isset($_GET['perpage']) ? $_GET['perpage'] : ''; ?>
			<?php $defaultperpage = wc_get_default_products_per_row() * wc_get_default_product_rows_per_page(); ?>
			<?php $options = array($defaultperpage,$defaultperpage*2,$defaultperpage*3,$defaultperpage*4); ?>
			<form class="products-per-page product-filter" method="get">
				<span class="perpage-label"><?php esc_html_e('Show','bacola-core'); ?></span>
				<?php if (bacola_get_body_class('bacola-ajax-shop-on')) { ?>
					<select name="perpage" class="perpage filterSelect" data-class="select-filter-perpage">
				<?php } else { ?>
					<select name="perpage" class="perpage filterSelect" data-class="select-filter-perpage" onchange="this.form.submit()">
				<?php } ?>
					<?php for( $i=0; $i<count($options); $i++ ) { ?>
					<option value="<?php echo esc_attr($options[$i]); ?>" <?php echo esc_attr($perpage == $options[$i] ? 'selected="selected"' : ''); ?>><?php echo esc_html($options[$i]); ?></option>
					<?php } ?>

				</select>
				<?php wc_query_string_form_fields( null, array( 'perpage', 'submit', 'paged', 'product-page' ) ); ?>
			</form>
		<?php } ?>
	</div>


	<?php echo bacola_remove_klb_filter(); ?>
	<?php wp_enqueue_style( 'klb-remove-filter'); ?>
<?php

}