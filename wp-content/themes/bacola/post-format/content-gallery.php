<article id="post-<?php the_ID(); ?>" <?php post_class('klb-article'); ?>>
	<figure class="entry-media">
		<?php $images = rwmb_meta( 'klb_blogitemslides', 'type=image_advanced&size=medium' ); ?>
		<?php if($images) { ?>
			
			<div class="blog-gallery">
				<?php  foreach ( $images as $image ) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<img src="<?php echo esc_url($image['full_url']); ?>" alt="<?php the_title_attribute(); ?>">
					</a>
				<?php } ?>
			</div>
		<?php } ?>
	</figure>

	<div class="post-wrapper">
		<div class="entry-meta">
			<span class="meta-item entry-published" itemprop="datePublished">
				<a href="<?php the_permalink(); ?>" itemprop="url"><?php echo get_the_date(); ?> </a>
			</span>

			<?php if(has_category()){ ?>
				<span class="meta-item entry-published"><?php the_category(', '); ?></span>
			<?php } ?>
			
			<?php the_tags( '<span class="meta-item entry-tags">', ', ', ' </span>'); ?>
			
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