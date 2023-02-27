<?php

function bacola_add_elementor_page_settings_controls( $page ) {

	$page->add_control( 'bacola_elementor_hide_page_header',
		[
			'label'          => esc_html__( 'Hide Header', 'bacola-core' ),
            'type'           => \Elementor\Controls_Manager::SWITCHER,
			'label_on'       => esc_html__( 'Yes', 'bacola-core' ),
			'label_off'      => esc_html__( 'No', 'bacola-core' ),
			'return_value'   => 'yes',
			'default'        => 'no',
		]
	);
	
	$page->add_control( 'bacola_elementor_hide_page_footer',
		[
			'label'          => esc_html__( 'Hide Footer', 'bacola-core' ),
			'type'           => \Elementor\Controls_Manager::SWITCHER,
			'label_on'       => esc_html__( 'Yes', 'bacola-core' ),
			'label_off'      => esc_html__( 'No', 'bacola-core' ),
			'return_value'   => 'yes',
			'default'        => 'no',
		]
	);

	$page->add_control(
		'page_width',
		[
			'label' => __( 'Width', 'bacola-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'devices' => [ 'desktop' ],
			'size_units' => [ 'px'],
			'range' => [
				'px' => [
					'min' => 1100,
					'max' => 1650,
					'step' => 5,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 1200,
			],
			'selectors' => [
				'{{WRAPPER}} .container' => 'max-width: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .elementor-section.elementor-section-boxed>.elementor-container' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		]
	);

}

add_action( 'elementor/element/wp-page/document_settings/before_section_end', 'bacola_add_elementor_page_settings_controls' );