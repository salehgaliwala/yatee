<?php

namespace Elementor;

class Bacola_Home_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'bacola-home-slider';
    }
    public function get_title() {
        return 'Home Slider (K)';
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
		
		$this->add_control( 'slider_type',
			[
				'label' => esc_html__( 'Slider Type', 'bacola-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-type' => esc_html__( 'Select Type', 'bacola-core' ),
					'type1'	  => esc_html__( 'Type 1', 'bacola-core' ),
					'type2'	  => esc_html__( 'Type 2', 'bacola-core' ),
					'type3'	  => esc_html__( 'Type 3', 'bacola-core' ),
				],
			]
		);

		$this->add_control( 'auto_play',
			[
				'label' => esc_html__( 'Auto Play', 'bacola-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'bacola-core' ),
				'label_off' => esc_html__( 'False', 'bacola-core' ),
				'return_value' => 'true',
				'default' => 'false',
			]
		);

        $this->add_control( 'auto_speed',
            [
                'label' => esc_html__( 'Auto Speed', 'chakta' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '1600',
                'pleaceholder' => esc_html__( 'Set auto speed.', 'chakta' ),
				'condition' => ['auto_play' => 'true']
            ]
        );
		
		$this->add_control( 'dots',
			[
				'label' => esc_html__( 'Dots', 'bacola-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'bacola-core' ),
				'label_off' => esc_html__( 'False', 'bacola-core' ),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		
		$this->add_control( 'arrows',
			[
				'label' => esc_html__( 'Arrows', 'bacola-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'bacola-core' ),
				'label_off' => esc_html__( 'False', 'bacola-core' ),
				'return_value' => 'true',
				'default' => 'false',
			]
		);

        $this->add_control( 'slide_speed',
            [
                'label' => esc_html__( 'Slide Speed', 'bacola-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '1200',
                'pleaceholder' => esc_html__( 'Set slide speed.', 'bacola-core' ),
            ]
        );
		
		$this->add_control( 'equal_height',
			[
				'label' => esc_html__( 'Equal Height', 'bacola-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'bacola-core' ),
				'label_off' => esc_html__( 'False', 'bacola-core' ),
				'return_value' => 'true',
				'default' => 'false',
			]
		);

		$defaultbg = plugins_url( 'images/slider-image.jpg', __DIR__ );
		
		$repeater = new Repeater();
        $repeater->add_control( 'slider_image',
            [
                'label' => esc_html__( 'Image', 'bacola-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control( 'slider_title',
            [
                'label' => esc_html__( 'Item Title', 'chakta' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Gerthesim Tend Inder Prosur',
                'pleaceholder' => esc_html__( 'Enter item title here.', 'chakta' )
            ]
        );
		
        $repeater->add_control( 'slider_subtitle',
            [
                'label' => esc_html__( 'Item Subtitle', 'chakta' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Only this week. Don’t miss...',
                'pleaceholder' => esc_html__( 'Enter item subtitle here.', 'chakta' )
            ]
        );
		
        $repeater->add_control( 'slider_second_subtitle',
            [
                'label' => esc_html__( 'Item Second Subtitle', 'chakta' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Exclusive Offer',
                'pleaceholder' => esc_html__( 'Enter item subtitle here.', 'chakta' )
            ]
        );
		
        $repeater->add_control( 'slider_offer',
            [
                'label' => esc_html__( 'Item Offer', 'chakta' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '-20% Off',
                'pleaceholder' => esc_html__( 'Add an offer for the item.', 'chakta' )
            ]
        );
		
        $repeater->add_control( 'slider_price_text',
            [
                'label' => esc_html__( 'Item Price Text', 'chakta' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'from',
                'pleaceholder' => esc_html__( 'Add the price text.', 'chakta' )
            ]
        );
		
        $repeater->add_control( 'slider_price',
            [
                'label' => esc_html__( 'Item Price', 'chakta' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '$7.99',
                'pleaceholder' => esc_html__( 'Add a price.', 'chakta' )
            ]
        );

        $repeater->add_control( 'slider_btn_title',
            [
                'label' => esc_html__( 'Button Title', 'chakta' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'chakta' )
            ]
        );
        $repeater->add_control( 'slider_btn_link',
            [
                'label' => esc_html__( 'Button Link', 'chakta' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'Place URL here', 'chakta' )
            ]
        );
		
        $this->add_control( 'slider_items',
            [
                'label' => esc_html__( 'Slide Items', 'bacola-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slider_image' => ['url' => $defaultbg],
                        'slider_title' => 'Gerthesim Tend Inder Prosur',
                        'slider_subtitle' => 'Only this week. Don’t miss...',
                        'slider_second_subtitle' => 'Exclusive Offer',
                        'slider_offer' => '-20% Off',
                        'slider_price_text' => 'from',
                        'slider_price' => '$7.99',
                        'slider_btn_title' => 'Shop Now',
                        'slider_btn_link' => '#',
                    ],
                    [
                        'slider_image' => ['url' => $defaultbg],
                        'slider_title' => 'Gerthesim Tend Inder Prosur',
                        'slider_subtitle' => 'Only this week. Don’t miss...',
                        'slider_second_subtitle' => 'Exclusive Offer',
                        'slider_offer' => '-20% Off',
                        'slider_price_text' => 'from',
                        'slider_price' => '$7.99',
                        'slider_btn_title' => 'Shop Now',
                        'slider_btn_link' => '#',
                    ],
                    [
                        'slider_image' => ['url' => $defaultbg],
                        'slider_title' => 'Gerthesim Tend Inder Prosur',
                        'slider_subtitle' => 'Only this week. Don’t miss...',
                        'slider_second_subtitle' => 'Exclusive Offer',
                        'slider_offer' => '-20% Off',
                        'slider_price_text' => 'from',
                        'slider_price' => '$7.99',
                        'slider_btn_title' => 'Shop Now',
                        'slider_btn_link' => '#',
                    ],

                ]
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
		
		$this->add_control( 'content_heading',
            [
                'label' => esc_html__( 'CONTENT', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
		
		$this->add_responsive_control( 'home_padding',
            [
                'label' => esc_html__( 'Padding', 'bacola-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
		
		$this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'title_color',
           [
               'label' => esc_html__( 'Title Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .content-main .entry-title' => 'color: {{VALUE}};']
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
                'selectors' => [ '{{WRAPPER}} .content-main .entry-title' => 'font-size: {{SIZE}}px;' ],
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
                    '{{WRAPPER}} .content-main .entry-title' => 'padding-left: {{SIZE}}{{UNIT}}',
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
                    ' {{WRAPPER}} .content-main .entry-title' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
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
                'selectors' => ['{{WRAPPER}} .content-main .entry-title ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .content-main .entry-title'
            ]
        );
		
		$this->add_control( 'subtitle_heading',
            [
                'label' => esc_html__( 'SUBTITLE', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'subtitle_color',
           [
               'label' => esc_html__( 'Subtitle Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .content-text' => 'color: {{VALUE}};']
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
                'selectors' => [ '{{WRAPPER}}  .content-text' => 'font-size: {{SIZE}}px;' ],
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
                    '{{WRAPPER}} .content-text' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
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
                    ' {{WRAPPER}} .content-text' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
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
                'selectors' => ['{{WRAPPER}} .content-text ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .content-text'
            ]
        );
		
		$this->add_control( 'second_subtitle_heading',
            [
                'label' => esc_html__( 'SECOND SUBTITLE', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'second_subtitle_color',
           [
               'label' => esc_html__( 'Second Subtitle Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .content-header .content-description ' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'second_subtitle_size',
            [
                'label' => esc_html__( 'Second Subtitle Size', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .content-header .content-description' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'second_subtitle_left',
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
                    '{{WRAPPER}} .content-header .content-description' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'second_subtitle_top',
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
                    ' {{WRAPPER}} .content-header .content-description' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'second_subtitle_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .content-header .content-description ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'second_subtitle_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .content-header .content-description'
            ]
        );
		
		$this->add_control( 'offer_heading',
            [
                'label' => esc_html__( 'OFFER', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'offer_bg',
           [
               'label' => esc_html__( 'Offer Background Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .module-slider .content-header .content-discount::before' => 'background: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'offer_color',
           [
               'label' => esc_html__( 'Offer Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .content-header .content-discount ' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'offer_size',
            [
                'label' => esc_html__( 'Offer Size', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .content-header .content-discount' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'offer_left',
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
                    '{{WRAPPER}} .content-header .content-discount' => 'margin-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'offer_top',
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
                    ' {{WRAPPER}} .content-header .content-discount' => 'margin-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'offer_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}}  .content-header .content-discount ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'offer_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .content-header .content-discount'
            ]
        );
		
		$this->add_control( 'price_text_heading',
            [
                'label' => esc_html__( 'PRICE TEXT', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'price_text_color',
           [
               'label' => esc_html__( 'Price Text Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .content-footer .price-text ' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'price_text_size',
            [
                'label' => esc_html__( 'Price Text Size', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .content-footer .price-text' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'price_text_left',
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
                    '{{WRAPPER}}  .content-footer .price-text' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'price_text_top',
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
                    ' {{WRAPPER}} .content-footer ' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'price_text_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}}  .content-footer .price-text ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_text_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .content-footer .price-text'
            ]
        );
		
		$this->add_control( 'price_heading',
            [
                'label' => esc_html__( 'PRICE', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'price_color',
           [
               'label' => esc_html__( 'Price Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .content-footer .price ' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'price_size',
            [
                'label' => esc_html__( 'Price Size', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .content-footer .price' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'price_left',
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
                    '{{WRAPPER}}  .content-footer .price' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'price_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}}  .content-footer .price ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
     	
		/*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('btn_styling',
            [
                'label' => esc_html__( ' Button Style', 'bacola-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
		
		$this->add_responsive_control( 'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'bacola-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}}  a.button.button-secondary.rounded' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],              
            ]
        );
  	    
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} a.button.button-secondary.rounded '
            ]
        );
        
		$this->add_responsive_control( 'btn_left',
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
                    '{{WRAPPER}}  a.button.button-secondary.rounded' => 'margin-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'bacola-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} a.button.button-secondary.rounded ' => 'color: {{VALUE}};']
            ]
        );
       
	    $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'bacola-core' ),
                'selector' => '{{WRAPPER}} a.button.button-secondary.rounded ',
            ]
        );
        
		$this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'bacola-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}}  a.button.button-secondary.rounded ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'],
            ]
        );
       
		$this->add_control( 'btn_bgclr',
           [
               'label' => esc_html__( 'Background Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
					'{{WRAPPER}} a.button.button-secondary.rounded' => 'background-color: {{VALUE}};'
               ]
           ]
        );
		
		$this->add_control( 'brn_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}}  a.button.button-secondary.rounded ' => 'opacity: {{VALUE}} ;']
            ]
        );
       

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( $settings['slider_items'] ) {

			$equalheight = $settings['equal_height'] == true ? 'equal-height' : '';
			
			if($settings['slider_type'] == 'type3'){
				$slidertype = 'full-width wide';
			} elseif($settings['slider_type'] == 'type2'){
				$slidertype = 'full-width';
			} else {
				$slidertype = '';
			}

			
			echo '<div class="site-module module-slider '.esc_attr($slidertype).' '.esc_attr($equalheight).'">';
			echo '<div class="module-body">';
			echo '<div class="slider-wrapper">';
			echo '<svg class="preloader" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>';
			echo '<div class="site-slider" data-slideshow="1" data-slidespeed="'.esc_attr($settings['slide_speed']).'" data-autoplay="'.esc_attr($settings['auto_play']).'" data-autospeed="'.esc_attr($settings['auto_speed']).'" data-dots="'.esc_attr($settings['dots']).'" data-arrows="'.esc_attr($settings['arrows']).'">';
			
			

			foreach ( $settings['slider_items'] as $item ) {
				$target = $item['slider_btn_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $item['slider_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
				echo '<div>';
				echo '<div class="slider-item">';

				echo '<div class="content-wrapper">';
				echo '<div class="content-header">';
				echo '<div class="content-description">'.esc_html($item['slider_second_subtitle']).'</div>';
				if($item['slider_offer']){
				echo '<div class="content-discount">'.esc_html($item['slider_offer']).'</div>';
				}
				echo '</div>';
				echo '<div class="content-main">';
				echo '<h3 class="entry-title">'.esc_html($item['slider_title']).'</h3>';
				echo '<div class="content-text">'.esc_html($item['slider_subtitle']).'</div>';
				echo '</div>';
				echo '<div class="content-footer">';
				echo '<span class="price-text">'.esc_html($item['slider_price_text']).' </span>';
				echo '<span class="price">'.esc_html($item['slider_price']).'</span>';
				echo '</div>';
				if($item['slider_btn_title']){
				echo '<a href="'.esc_url($item['slider_btn_link']['url']).'" class="button button-secondary rounded" '.esc_attr($target.$nofollow).'>'.esc_html($item['slider_btn_title']).' <i class="klbth-icon-right-arrow"></i></a>';
				}
				echo '</div>';
				echo '<div class="image-wrapper">';
				echo '<img src="'.esc_url($item['slider_image']['url']).'" alt="bacola">';
				echo '</div>';
				echo '<a href="'.esc_url($item['slider_btn_link']['url']).'" class="overlay-link"></a>';

				echo '</div>';
				echo '</div>';
				
			}


			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
	}

}

