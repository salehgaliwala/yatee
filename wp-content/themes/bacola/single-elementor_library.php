<?php

/**
* The template for displaying all single posts
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package WordPress
* @subpackage Bacola
* @since 1.0.0
*/

	remove_action( 'bacola_main_header', 'bacola_top_notification', 20 );
	remove_action( 'bacola_main_header', 'bacola_main_header_function', 30 );
	remove_action( 'bacola_main_footer', 'bacola_main_footer_function', 10 );

    get_header();

    while ( have_posts() ) : the_post();
        the_content();
    endwhile;

    get_footer();
?>
