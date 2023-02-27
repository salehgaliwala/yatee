<?php

namespace Elementor;

class Bacola_Vendor_Grid_Widget extends Widget_Base {

    public function get_name() {
        return 'bacola-vendor-grid';
    }
    public function get_title() {
        return 'Vendor Grid (K)';
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
		
        $this->add_control( 'display_items',
            [
                'label' => esc_html__( 'Display Item count', 'bacola-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '6',
                'description'=> 'Display items.',
				'label_block' => true,
            ]
        );
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		//var_dump($settings);

		$output = '';
		

		$vendors = get_wcmp_vendors();
		//$vendors = krsort($vendors);
		$i = 1;
		if ($vendors && is_array($vendors)) {
			echo '<div class="klb-stores-grid">';
			echo '<div class="row">';
			foreach ($vendors as $vendor_id) {
				
				$vendor = get_wcmp_vendor($vendor_id->id);
				$imagem = wp_get_attachment_url( $vendor->profile_image ); 
				if($vendor ==  FALSE)
					continue;
				$vendor_products = $vendor->get_products_ids();
				
				/*if($i <= $settin	gs['display_items'] && !get_user_meta($vendor->id, '_vendor_turn_off', true)){
					echo '<div class="col-sm-12 col-md-3 col-lg-3 wow fadeInUp">';
					echo '<div class="item">';
					echo '<div class="row">';
					if($imagem){
					echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 logo-img">';
					echo '<a href="'.esc_url($vendor->permalink).'"><img class="img-responsive" src="'.esc_url($imagem).'" alt="'.esc_attr($vendor_id->user_data->display_name).'"></a>';
					echo '</div>';
					}
					echo '<div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">';
					echo '<h3><a href="'.esc_url($vendor->permalink).'">'.esc_html($vendor_id->user_data->display_name).'</a></h3>';
					echo '<p>'.bacola_sanitize_data($vendor->description).'</p>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
				$i++;*/

				if($i <= $settings['display_items'] && !get_user_meta($vendor->id, '_vendor_turn_off', true)){
					echo '<div class="col-sm-12 col-md-3 col-lg-3 wow fadeInUp">';
					echo '<div class="item">';
					
					if($imagem){
					echo '<div logo-img">';
					echo '<a href="'.esc_url($vendor->permalink).'"><img class="img-responsive" src="'.esc_url($imagem).'" alt="'.esc_attr($vendor_id->user_data->display_name).'"></a>';
					echo '</div>';
					}
					
					echo '<h3><a href="'.esc_url($vendor->permalink).'">'.esc_html($vendor_id->user_data->first_name).' '.esc_html($vendor_id->user_data->last_name).'</a></h3>';
					echo '<h4>'.get_user_meta($vendor_id,'_vendor_city',true).'</h4>';
					echo '<h5><strong>'.get_user_meta($vendor_id->id,'avg_rating',true).'</strong> ('.get_user_meta($vendor_id->id,'rating_count',true).' Avis )</h5>';
					echo '<p>'.bacola_sanitize_data($vendor->description).'</p>';
					echo '<hr style="border-top: 1px solid #0000001A;margin: 20px 0px;"/>';
					echo '<h6>'.count($vendor_products).' produits en vente</h4>';
					echo '</div>';
					echo '</div>';
					
				}
				$i++;
			}
			echo '</div>';
			echo '</div>';
		}
	


	}

}
