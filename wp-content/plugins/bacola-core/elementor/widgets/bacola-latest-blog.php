<?php

namespace Elementor;

class Bacola_Latest_Blog_Widget extends Widget_Base {
    use Bacola_Helper;

    public function get_name() {
        return 'bacola-latest-blog';
    }
    public function get_title() {
        return 'Lateste Posts (K)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'bacola' ];
    }

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'bacola-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
				
		$this->add_control( 'column',
			[
				'label' => esc_html__( 'Column', 'bacola-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'col-lg-4',
				'options' => [
					'select-column' => esc_html__( 'Select Column', 'bacola-core' ),
					'col-lg-6'	  => esc_html__( '2 Columns', 'bacola-core' ),
					'col-lg-4' 	  => esc_html__( '3 Columns', 'bacola-core' ),
					'col-lg-3'	  => esc_html__( '4 Columns', 'bacola-core' ),
				],
			]
		);
		
        $this->add_control( 'post_count',
            [
                'label' => esc_html__( 'Posts Per Page', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default' => 3
            ]
        );
		
        $this->add_control( 'category_filter',
            [
                'label' => esc_html__( 'Category', 'naturally' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->bacola_get_categories(),
                'description' => 'Select Category(s)',
				'label_block' => true,
            ]
        );
		
        $this->add_control( 'post_filter',
            [
                'label' => esc_html__( 'Specific Post(s)', 'naturally' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->bacola_get_posts(),
                'description' => 'Select Specific Post(s)',
				'label_block' => true,
            ]
        );
		
        $this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'bacola-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'bacola-core' ),
                    'DESC' => esc_html__( 'Descending', 'bacola-core' )
                ],
                'default' => 'DESC'
            ]
        );
		
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'bacola-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'id' => esc_html__( 'Post ID', 'bacola-core' ),
                    'menu_order' => esc_html__( 'Menu Order', 'bacola-core' ),
                    'rand' => esc_html__( 'Random', 'bacola-core' ),
                    'date' => esc_html__( 'Date', 'bacola-core' ),
                    'title' => esc_html__( 'Title', 'bacola-core' ),
                ],
                'default' => 'date',
            ]
        );
		
		$this->add_control(
			'disable_pagination',
			[
				'label' => esc_html__('Disable Pagination', 'bacola-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'bacola-core' ),
				'label_off' => esc_html__( 'No', 'bacola-core' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
        $this->add_control( 'image_width',
            [
                'label' => esc_html__( 'Image Width', 'bacola-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '370',
                'pleaceholder' => esc_html__( 'Set the product image width.', 'bacola-core' )
            ]
        );
		
        $this->add_control( 'image_height',
            [
                'label' => esc_html__( 'Image Height', 'bacola-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '260',
                'pleaceholder' => esc_html__( 'Set the product image height.', 'bacola-core' )
            ]
        );

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();		
		$output = '';
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
	
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $settings['post_count'],
			'order'          => 'DESC',
			'post_status'    => 'publish',
			'paged' 			=> $paged,
            'post__in'       => $settings['post_filter'],
            'order'          => $settings['order'],
			'orderby'        => $settings['orderby'],
            'category__in'     => $settings['category_filter'],
		);
		
		$output .= '<div class="site-module module-blog">';
		$output .= '<div class="module-body">';
		$output .= '<div class="row">';

		
		$count = 1;
		$loop = new \WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				global $product;
				global $post;
				global $woocommerce;
			
				$id = get_the_ID();
				
				$att=get_post_thumbnail_id();
				$image_src = wp_get_attachment_image_src( $att, 'full' );
				$image_src = $image_src[0];
				if($settings['image_width'] && $settings['image_height']){
					$imageresize = bacola_resize( $image_src, $settings['image_width'], $settings['image_height'], true, true, true );  
				} else {
					$imageresize = $image_src;
				}

				$taxonomy = strip_tags( get_the_term_list($post->ID, 'category', '', ', ', '') );

				$output .= '<div class="col-12 '.esc_attr($settings['column']).'">';
				$output .= '<article class="post">';
				if($image_src){
				$output .= '<figure class="post-thumbnail">';
				$output .= '<a href="'.get_permalink().'"><img src="'.esc_url($imageresize).'" alt="'.the_title_attribute( 'echo=0' ).'"></a>';
				$output .= '</figure>';
				}
				$output .= '<div class="post-wrapper">';
				$output .= '<div class="entry-category">';
				$output .= '<a href="'.get_permalink().'">'.$taxonomy.'</a>';
				$output .= '</div>';
				$output .= '<h2 class="entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
				$output .= '<div class="entry-meta">';
				$output .= '<span class="meta-item entry-published" itemprop="datePublished">';
				$output .= '<a href="'.get_permalink().'" itemprop="url">'.get_the_date('j M Y').'</a>';
				$output .= '</span>';
				if(get_comments_number() > 1) {
				$output .= '<span class="meta-item entry-comments"><a href="#">'.get_comments_number().' '.esc_html__('comments','bacola-core').'</a> </span>';
				} else {
				$output .= '<span class="meta-item entry-comments"><a href="#">'.get_comments_number().' '.esc_html__('comment','bacola-core').'</a> </span>';
				}

				$output .= '<span class="meta-item entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">';
				$output .= '<span class="meta-separator">'.esc_html__('by','bacola-core').' </span>';
				$output .= '<a href="'.get_permalink().'" rel="author" class="url fn n" itemprop="url">';
				$output .= '<span itemprop="name">'.get_the_author().'</span>';
				$output .= '</a>';
				$output .= '</span>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</article>';
				$output .= '</div>';
				
			endwhile;
		
			if($settings['disable_pagination'] != 'yes'){
				ob_start();
				get_template_part( 'post-format/pagination' );
				$output .= '<div class="col-12">'. ob_get_clean().'</div>';
			}
		
		}
		wp_reset_postdata();
		

		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

		
		echo $output;
	}

}
