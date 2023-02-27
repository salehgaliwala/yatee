<article id="post-<?php the_ID(); ?>" <?php post_class('klb-article'); ?>>
	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
		<figure class="post-thumbnail">
			<?php  
			$att=get_post_thumbnail_id();
			$image_src = wp_get_attachment_image_src( $att, 'full' );
			$image_src = $image_src[0]; 
			?>
			<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image_src); ?>" alt="<?php the_title_attribute(); ?>"></a>
		</figure>
	<?php } ?>

	<div class="post-wrapper">
		<div class="entry-meta">
			<span class="meta-item entry-published"><i class="klbth-icon-clock"></i><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?> </a></span>

			<?php if(has_category()){ ?>
			  <span class="meta-item entry-published"><i class="klbth-icon-bookmark-empty"></i><?php the_category(', '); ?></span>
			<?php } ?>
			
			<?php the_tags( '<span class="meta-item entry-tags"><i class="klbth-icon-pill"></i>', ', ', ' </span>'); ?>
			
			<?php if ( is_sticky()) {
				printf( '<span class="meta-item sticky">%s</span>', esc_html__('Featured', 'bacola' ) );
			} ?>
		</div>

		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="entry-content">
			<div class="klb-post">
				<?php the_excerpt(); ?>
				<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'bacola' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
			</div>
		</div>
	</div>
</article>