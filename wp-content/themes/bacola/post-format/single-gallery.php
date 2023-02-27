<div class="col col-12 site-element">
	<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
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
		<div class="content-align">
			<div class="entry-wrapper">

				<div class="entry-meta top">
					<span class="meta-item entry-published" itemprop="datePublished">
						<a href="<?php the_permalink(); ?>" itemprop="url"><?php echo get_the_date(); ?></a>
					</span>
					
					<?php if(has_category()){ ?>
						<span class="category"><?php the_category(', '); ?></span>
					<?php } ?>
					
					<?php the_tags( '<span class="tags">', ', ', ' </span>'); ?>
					
					<?php if ( is_sticky()) {
						printf( '<span class="sticky">%s</span>', esc_html__('Featured', 'bacola' ) );
					} ?>
				</div>
				
				<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<div class="entry-content">
					<div class="klb-post">
						<?php the_content(); ?>
						<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'bacola' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
					</div>
				</div>

			</div>
		</div>
	</article>
</div>