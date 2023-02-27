<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<?php if(!class_exists('Bacola_Elementor_Addons')){ ?>
<div class="before-shop-loop">
<?php } ?>
	<form class="woocommerce-ordering product-filter" method="get">
		<span class="orderby-label hide-desktop"><?php esc_html_e('Sort by','bacola'); ?></span>
		<select name="orderby" class="orderby filterSelect" aria-label="<?php esc_attr_e( 'Shop order', 'bacola' ); ?>" data-class="select-filter-orderby">
			<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
		<input type="hidden" name="paged" value="1" />
		<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
	</form>
<?php if(!class_exists('Bacola_Elementor_Addons')){ ?>
</div>
<?php } ?>