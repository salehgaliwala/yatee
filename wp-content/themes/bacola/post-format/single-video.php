<div class="col col-12 site-element">
	<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
		<figure class="entry-media embed-responsive embed-responsive-16by9">
			<?php  
			if (get_post_meta( get_the_ID(), 'klb_blog_video_type', true ) == 'vimeo') {  
			  echo '<iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" height="443" allowFullScreen></iframe>';  
			}  
			else if (get_post_meta( get_the_ID(), 'klb_blog_video_type', true ) == 'youtube') {  
			  echo '<iframe height="450" src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" allowfullscreen></iframe>';  
			}  
			else {  
				echo ' '.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).' '; 
			}  
			?>
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