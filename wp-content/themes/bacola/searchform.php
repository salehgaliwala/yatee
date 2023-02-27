<?php
/**
 * searchform.php
 * @package WordPress
 * @subpackage Bacola
 * @since Bacola 1.0
 * 
 */
 ?>
<div class="search_form">
	<form class="search-form" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<input class="form_control" type="text" name="s" placeholder="<?php esc_attr_e('Search...', 'bacola') ?>" autocomplete="off">
		<button type="submit"><i class="klbth-icon-search"></i></button>
	</form>
</div>