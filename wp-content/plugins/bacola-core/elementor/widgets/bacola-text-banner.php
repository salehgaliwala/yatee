<?php

namespace Elementor;

class Bacola_Text_Banner_Widget extends Widget_Base {

    public function get_name() {
        return 'bacola-text-banner';
    }
    public function get_title() {
        return 'Text Banner (K)';
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
				'label' => esc_html__( 'Content', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control( 'banner_type',
			[
				'label' => esc_html__( 'Banner Type', 'bacola-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-type' => esc_html__( 'Select Type', 'bacola-core' ),
					'type1'	  => esc_html__( 'Type 1', 'bacola-core' ),
					'type2'	  => esc_html__( 'Type 2', 'bacola-core' ),
				],
			]
		);

        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'bacola-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Super discount for your <strong>first purchase.</strong>',
                'description'=> 'Add a title.',
				'label_block' => true,
            ]
        );
		
        $this->add_control( 'coupon_code',
            [
                'label' => esc_html__( 'Coupon Code', 'bacola-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'FREE25BAC',
                'description'=> 'Add a coupon code.',
				'label_block' => true,
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'bacola-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Use discount code in checkout!',
                'description'=> 'Add a subtitle.',
				'label_block' => true,
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
        $this->add_control( 'btn_link',
            [
                'label' => esc_html__( 'Button Link', 'bacola-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'Place URL here', 'bacola-core' ),
            ]
        );
		
		/*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
		
		$this->end_controls_section();
		$this->start_controls_section('bacola_styling',
            [
                'label' => esc_html__( ' Style', 'bacola-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
		
		$this->add_responsive_control( 'text_banner_alignment',
            [
                'label' => esc_html__( 'Alignment', 'sosso' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .module-banner.simple-text a , {{WRAPPER}} .module-purchase-banner a' => 'text-align: {{VALUE}};'],
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'sosso' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'sosso' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'sosso' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
				'condition' => ['banner_type' => ['type2']]
                
            ]
        );
		
		$this->add_control( 'bg_color',
           [
               'label' => esc_html__( 'Background Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#ffeef2',
               'selectors' => [
					'{{WRAPPER}} .module-banner.simple-text a' => 'background-color: {{value}};',
					'{{WRAPPER}} .module-purchase-banner a' => 'background-color: {{value}};',
               ]
           ]
        );
		
		$this->add_control( 'background_hvr',
           [
               'label' => esc_html__( 'Background Hover Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
					'{{WRAPPER}} .module-banner.simple-text a:hover' => 'background-color: {{value}};',
					'{{WRAPPER}} .module-purchase-banner a:hover' => 'background-color: {{value}};',
               ]
           ]
        );
		
		$this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'title_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .module-purchase-banner .purchase-text , {{WRAPPER}} .module-banner.simple-text a' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_control( 'text_color',
           [
               'label' => esc_html__( 'Title Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#ed174a',
               'selectors' => ['{{WRAPPER}} .module-body .purchase-text , {{WRAPPER}} .module-body a' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'title_hvrcolor',
           [
               'label' => esc_html__( 'Title Hover Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}}  .module-body .purchase-text:hover , {{WRAPPER}} .module-body a:hover' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'title_size',
            [
                'label' => esc_html__( 'Title Size', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .module-body .purchase-text , {{WRAPPER}} .module-body a' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_control( 'second_title_color',
           [
               'label' => esc_html__( 'Second Title Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .module-purchase-banner .purchase-text strong , {{WRAPPER}} .module-body a strong' => 'color: {{VALUE}};'],
			  
           ]
        );
		
		$this->add_control( 'second_title_hvrcolor',
           [
               'label' => esc_html__( 'Second Title Hover Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}}  .module-purchase-banner .purchase-text strong:hover , {{WRAPPER}} .module-body a strong:hover' => 'color: {{VALUE}};'],
			   
		   ]
        );
		
		$this->add_control( 'second_title_size',
            [
                'label' => esc_html__( 'Second Title Size', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .module-body strong , {{WRAPPER}} .module-body a strong ' => 'font-size: {{SIZE}}px;' ],
				
				
            ]
        );
		
		$this->add_responsive_control( 'title_left',
            [
                'label' => esc_html__( 'Left', 'bacola-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .module-body .purchase-text , {{WRAPPER}} .module-banner.simple-text a' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'title_top',
            [
                'label' => esc_html__( 'Top', 'bacola-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    ' {{WRAPPER}} .module-body .purchase-text , {{WRAPPER}} .module-banner.simple-text a ' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .module-body .purchase-text , {{WRAPPER}} .module-banner.simple-text a',
			]
		);
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => ' {{WRAPPER}} .module-body .purchase-text , {{WRAPPER}} .module-body a',
				
            ]
        );
		
		$this->add_control( 'coupon_heading',
            [
                'label' => esc_html__( 'COUPON', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cpn_border',
                'label' => esc_html__( 'Border', 'bacola-core' ),
                'selector' => '{{WRAPPER}} .module-purchase-banner .purchase-code',
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_responsive_control( 'cpn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'bacola-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .module-purchase-banner .purchase-code ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'],
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_control( 'coupon_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .purchase-code' => 'opacity: {{VALUE}};'],
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_control( 'coupon_color',
           [
               'label' => esc_html__( 'Coupon Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .purchase-code' => 'color: {{VALUE}};'],
			   'condition' => ['banner_type' => ['type1','select-type']]
           ]
        );
		
		$this->add_control( 'coupon_hvrcolor',
           [
               'label' => esc_html__( 'Coupon Hover Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .purchase-code:hover' => 'color: {{VALUE}};'],
			   'condition' => ['banner_type' => ['type1','select-type']]
           ]
        );
		
		$this->add_control( 'coupon_size',
            [
                'label' => esc_html__( 'Size', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .purchase-code' => 'font-size: {{SIZE}}px;' ],
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_responsive_control( 'coupon_left',
            [
                'label' => esc_html__( 'Left', 'bacola-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .purchase-code' => 'margin-left: {{SIZE}}{{UNIT}}',
                ],
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_responsive_control( 'coupon_top',
            [
                'label' => esc_html__( 'Top', 'bacola-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .purchase-code' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'coupon_text_shadow',
				'selector' => '{{WRAPPER}} .purchase-code',
				'condition' => ['banner_type' => ['type1','select-type']]
			]
		);
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coupon_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .purchase-code',
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_control( 'subtitle_heading',
            [
                'label' => esc_html__( 'SUBTITLE', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_control( 'subtitle_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .purchase-description' => 'opacity: {{VALUE}};'],
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_control( 'subtitle_color',
           [
               'label' => esc_html__( 'Subtitle Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .purchase-description' => 'color: {{VALUE}};'],
			   'condition' => ['banner_type' => ['type1','select-type']]
           ]
        );
		
		$this->add_control( 'subtitle_hvrcolor',
           [
               'label' => esc_html__( 'Subtitle Hover Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .purchase-description:hover' => 'color: {{VALUE}};'],
			   'condition' => ['banner_type' => ['type1','select-type']]
           ]
        );
		
		$this->add_control( 'subtitle_size',
            [
                'label' => esc_html__( 'Subtitle Size', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .purchase-description' => 'font-size: {{SIZE}}px;' ],
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_responsive_control( 'subtitle_left',
            [
                'label' => esc_html__( 'Left', 'bacola-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .purchase-description' => 'padding-left: {{SIZE}}{{UNIT}}',
                ],
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_responsive_control( 'subtitle_top',
            [
                'label' => esc_html__( 'Top', 'bacola-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .purchase-description' => 'padding-top: {{SIZE}}{{UNIT}}',
                ],
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'subtitle_text_shadow',
				'selector' => '{{WRAPPER}} .purchase-description',
				'condition' => ['banner_type' => ['type1','select-type']]
			]
		);
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .purchase-description',
				'condition' => ['banner_type' => ['type1','select-type']]
            ]
        );
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$target = $settings['btn_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['btn_link']['nofollow'] ? ' rel="nofollow"' : '';

		if($settings['banner_type'] == 'type2'){

			echo '<div class="site-module module-banner simple-text">';
			echo '<div class="module-body">';
			echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).'>'.bacola_sanitize_data($settings['title']).'</a>';
			echo '</div>';
			echo '</div>';
		} else {
			echo '<div class="site-module module-purchase-banner">';
			echo '<div class="module-body">';
			echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).'>';
			echo '<span class="purchase-text">'.bacola_sanitize_data($settings['title']).'</span>';
			echo '<span class="purchase-code">'.esc_html($settings['coupon_code']).'</span>';
			echo '<span class="purchase-description">'.esc_html($settings['subtitle']).'</span>';
			echo '</a>';
			echo '</div>';
			echo '</div>';
		}

	}

}
