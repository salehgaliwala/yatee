<?php
/**
 * 404.php
 * @package WordPress
 * @subpackage Bacola
 * @since Bacola 1.0
 */
?>

<?php get_header(); ?>

<div class="module-border hide-mobile">
	<div class="container">
		<div class="module-border--inner"></div>
	</div>
</div>

<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) { ?>

<div class="page-not-found">
	<div class="page-not-found--inner">
		<h1 class="entry-title"><?php esc_html_e('404','bacola'); ?></h1>
		<h2 class="entry-subtitle"><?php esc_html_e('That page can\'t be found','bacola'); ?></h2>
		<div class="entry-description">
			<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try to search for what you are looking for?','bacola'); ?></p>
		</div>

		<?php get_search_form(); ?>
		
		<a href="<?php echo esc_url( home_url('/') ); ?>" class="button button-primary"><?php esc_html_e('Go To Homepage','bacola'); ?></a>
	</div>
</div>
<?php } ?>
<?php get_footer(); ?>