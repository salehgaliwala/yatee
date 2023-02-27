<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<?php if(get_theme_mod('bacola_single_type') == 'type2' || get_theme_mod('bacola_single_type') == 'type4' || bacola_get_option() == 'type2' || bacola_get_option() == 'type4'){ ?>
	<?php $single_type = 'no-bg'; ?>
<?php } elseif(get_theme_mod('bacola_single_type') == 'type3' || bacola_get_option() == 'type3'){ ?>	
	<?php $single_type = 'single-gray single-type3'; ?>
<?php } else { ?>
	<?php $single_type = 'single-gray'; ?>
<?php } ?>

<div class="shop-content single-content <?php echo esc_attr($single_type); ?>">
	<div class="container">
		<?php woocommerce_breadcrumb(); ?>	
		
		<div class="single-wrapper">

			<?php
				/**
				 * woocommerce_before_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action( 'woocommerce_before_main_content' );
			?>

				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>

					<?php wc_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php
				/**
				 * woocommerce_after_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
			?>

		</div>
	</div>
</div>

<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
