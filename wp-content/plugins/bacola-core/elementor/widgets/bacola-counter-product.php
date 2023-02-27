<?php

namespace Elementor;

class Bacola_Counter_Product_Widget extends Widget_Base {
    use Bacola_Helper;

    public function get_name() {
        return 'bacola-counter-product';
    }
    public function get_title() {
        return 'Counter Product (K)';
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
		
        // Posts Per Page
        $this->add_control( 'post_count',
            [
                'label' => esc_html__( 'Posts Per Page', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => count( get_posts( array('post_type' => 'product', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default' => 1
            ]
        );
		
        $this->add_control( 'cat_filter',
            [
                'label' => esc_html__( 'Filter Category', 'bacola-core' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->bacola_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'default' => '',
				'label_block' => true,
            ]
        );
		
        $this->add_control( 'post_include_filter',
            [
                'label' => esc_html__( 'Include Post', 'bacola-core' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->bacola_cpt_get_post_title('product'),
                'description' => 'Select Post(s) to Include',
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

		$this->add_control( 'on_sale',
			[
				'label' => esc_html__( 'On Sale Products?', 'bacola-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'bacola-core' ),
				'label_off' => esc_html__( 'False', 'bacola-core' ),
				'return_value' => 'true',
				'default' => 'false',
			]
		);
		
		$this->add_control( 'featured',
			[
				'label' => esc_html__( 'Featured Products?', 'bacola-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'bacola-core' ),
				'label_off' => esc_html__( 'False', 'bacola-core' ),
				'return_value' => 'true',
				'default' => 'false',
			]
		);
		
		$this->add_control( 'best_selling',
			[
				'label' => esc_html__( 'Best Selling Products?', 'bacola-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'bacola-core' ),
				'label_off' => esc_html__( 'False', 'bacola-core' ),
				'return_value' => 'true',
				'default' => 'false',
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
			'post_type' => 'product',
			'posts_per_page' => $settings['post_count'],
			'order'          => 'DESC',
			'post_status'    => 'publish',
			'paged' 			=> $paged,
            'post__in'       => $settings['post_include_filter'],
            'order'          => $settings['order'],
			'orderby'        => $settings['orderby']
		);
	
		if($settings['cat_filter']){
			$args['tax_query'][] = array(
				'taxonomy' 	=> 'product_cat',
				'field' 	=> 'term_id',
				'terms' 	=> $settings['cat_filter']
			);
		}

		if($settings['best_selling']== 'true'){
			$args['meta_key'] = 'total_sales';
			$args['orderby'] = 'meta_value_num';
		}

		if($settings['featured'] == 'true'){
			$args['tax_query'] = array( array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => array( 'featured' ),
					'operator' => 'IN',
			) );
		}
		
		if($settings['on_sale'] == 'true'){
			$args['meta_key'] = '_sale_price';
			$args['meta_value'] = array('');
			$args['meta_compare'] = 'NOT IN';
		}
			
		$output .= '<div class="site-module module-counter-product">';
		$output .= '<div class="module-body">';
		$output .= '<div class="klb-counter-product">';
		$output .= '<div class="counter-product">';
		$output .= '<div class="products">';

		$loop = new \WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				global $product;
				global $post;
				global $woocommerce;
			
				$id = get_the_ID();
				$allproduct = wc_get_product( get_the_ID() );

				$cart_url = wc_get_cart_url();
				$price = $allproduct->get_price_html();
				$weight = $product->get_weight();
				$stock_status = $product->get_stock_status();
				$stock_text = $product->get_availability();
				$rating = wc_get_rating_html($product->get_average_rating());
				$ratingcount = $product->get_review_count();
				$wishlist = get_theme_mod( 'bacola_wishlist_button', '0' );
				$compare = get_theme_mod( 'bacola_compare_button', '0' );
				$quickview = get_theme_mod( 'bacola_quick_view_button', '0' );
				$managestock = $product->managing_stock();
				$total_sales = $product->get_total_sales();
				$stock_quantity = $product->get_stock_quantity();
				$sale_price_dates_to    = ( $date = get_post_meta( $id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
			
				if($managestock) {
				$progress_percentage = floor($total_sales / (($total_sales + $stock_quantity) / 100)); // yuvarlama
				}
				
				$att=get_post_thumbnail_id();
				$image_src = wp_get_attachment_image_src( $att, 'full' );
				$image_src = $image_src[0];
				

				$output .= '<div class="product">';
				if($sale_price_dates_to){
				$output .= '<div class="deals-header">';
				$output .= '<h4 class="entry-title">'.bacola_sanitize_data(__('Deals of the <strong>week!</strong>','bacola-core')).'</h4>';
				$output .= '<div class="deals-counter">';
				$output .= '<div class="countdown" data-date="'.esc_attr($sale_price_dates_to).'">';
				$output .= '<div class="count-item days"></div>';
				$output .= '<span>:</span>';
				$output .= '<div class="count-item hours"></div>';
				$output .= '<span>:</span>';
				$output .= '<div class="count-item minutes"></div>';
				$output .= '<span>:</span>';
				$output .= '<div class="count-item second"></div>';
				$output .= '</div>';
				$output .= '<div class="deals-counter-text">'.esc_html__('Remains until the end of the offer','bacola-core').'</div>';
				$output .= '</div>';
				$output .= '</div>';
				}
				$output .= '<div class="product-wrapper">';
				$output .= '<div class="thumbnail-wrapper">';
				
				if ( $product->is_on_sale() && $product->is_type( 'variable' ) ) {
				$percentage = ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price( 'min' )) * 100);
				$output .= '<div class="deal-discount">'.$percentage.'%</div>';
				} elseif( $product->is_on_sale() && $product->get_regular_price() ) {
				$percentage = ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100);
				$output .= '<div class="deal-discount">'.$percentage.'%</div>';
				}
									
				$output .= '<a href="'.get_permalink().'">';
				$output .= '<img src="'.esc_url($image_src).'" alt="'.the_title_attribute( 'echo=0' ).'">';
				$output .= '</a>';
				$output .= '</div>';
				$output .= '<div class="content-wrapper">';

				$output .= '<div class="counter-product-header">';
				$output .= '<span class="price">';
				$output .= $price;
				$output .= '</span>';
				$output .= '</div>';
									
				$output .= '<h3 class="product-title"><a href="'.get_permalink().'" title="'.the_title_attribute( 'echo=0' ).'">'.get_the_title().'</a></h3>';
				$output .= '<div class="product-meta">';
				if($weight){
				$output .= '<div class="product-unit"> '.$weight.' '.get_option('woocommerce_weight_unit').'</div>';
				}
				if($stock_status == 'instock'){
				$output .= '<div class="product-available in-stock">'.$stock_text['availability'].'</div>';
				} else {
				$output .= '<div class="product-available outof-stock">'.$stock_text['availability'].'</div>';
				}
				$output .= '</div>';
				
				if($ratingcount){
				$output .= '<div class="product-rating">';
				$output .= $rating;
				$output .= '<div class="count-rating">'.esc_html($ratingcount).' <span class="rating-text">'.esc_html__('Ratings','bacola-core').'</span></div>';
				$output .= '</div>';
				}
				
				if($managestock) {
				$output .= '<div class="product-count">';
				$output .= '<div class="product-pcs">';
				$output .= esc_html__('Available :','bacola-core').' <span>'.esc_html($stock_quantity).'</span>';
				$output .= '</div>';
				$output .= '<div class="product-progress">';
				$output .= '<span class="progress" style="width: '.esc_attr($progress_percentage).'%;"></span>';
				$output .= '</div>';
				$output .= '</div>';
				}
				
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';

			endwhile;
		}
		wp_reset_postdata();

		$output .= '</div>';
		$output .= '</div>';
		
		echo $output;
	}

}
