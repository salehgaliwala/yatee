<?php
/*======
*
* Kirki Settings
*
======*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kirki' ) ) {
	return;
}

Kirki::add_config(
	'bacola_customizer', array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	)
);

/*======
*
* Sections
*
======*/
$sections = array(
	'shop_settings' => array (
		esc_attr__( 'Shop Settings', 'bacola-core' ),
		esc_attr__( 'You can customize the shop settings.', 'bacola-core' ),
	),
	
	'blog_settings' => array (
		esc_attr__( 'Blog Settings', 'bacola-core' ),
		esc_attr__( 'You can customize the blog settings.', 'bacola-core' ),
	),

	'header_settings' => array (
		esc_attr__( 'Header Settings', 'bacola-core' ),
		esc_attr__( 'You can customize the header settings.', 'bacola-core' ),
	),

	'main_color' => array (
		esc_attr__( 'Main Color', 'bacola-core' ),
		esc_attr__( 'You can customize the main color.', 'bacola-core' ),
	),

	'elementor_templates' => array (
		esc_attr__( 'Elementor Templates', 'bacola-core' ),
		esc_attr__( 'You can customize the elementor templates.', 'bacola-core' ),
	),
	
	'map_settings' => array (
		esc_attr__( 'Map Settings', 'bacola-core' ),
		esc_attr__( 'You can customize the map settings.', 'bacola-core' ),
	),

	'footer_settings' => array (
		esc_attr__( 'Footer Settings', 'bacola-core' ),
		esc_attr__( 'You can customize the footer settings.', 'bacola-core' ),
	),
	
	'bacola_widgets' => array (
		esc_attr__( 'Bacola Widgets', 'bacola-core' ),
		esc_attr__( 'You can customize the bacola widgets.', 'bacola-core' ),
	),

	'gdpr_settings' => array (
		esc_attr__( 'GDPR Settings', 'bacola-core' ),
		esc_attr__( 'You can customize the GDPR settings.', 'bacola-core' ),
	),

	'newsletter_settings' => array (
		esc_attr__( 'Newsletter Settings', 'bacola-core' ),
		esc_attr__( 'You can customize the Newsletter Popup settings.', 'bacola-core' ),
	),

);

foreach ( $sections as $section_id => $section ) {
	$section_args = array(
		'title' => $section[0],
		'description' => $section[1],
	);

	if ( isset( $section[2] ) ) {
		$section_args['type'] = $section[2];
	}

	if( $section_id == "colors" ) {
		Kirki::add_section( str_replace( '-', '_', $section_id ), $section_args );
	} else {
		Kirki::add_section( 'bacola_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
	}
}


/*======
*
* Fields
*
======*/
function bacola_customizer_add_field ( $args ) {
	Kirki::add_field(
		'bacola_customizer',
		$args
	);
}

	/*====== Header ==================================================================================*/
		/*====== Header Panels ======*/
		Kirki::add_panel (
			'bacola_header_panel',
			array(
				'title' => esc_html__( 'Header Settings', 'bacola-core' ),
				'description' => esc_html__( 'You can customize the header from this panel.', 'bacola-core' ),
			)
		);

		$sections = array (
			'header_logo' => array(
				esc_attr__( 'Logo', 'bacola-core' ),
				esc_attr__( 'You can customize the logo which is on header..', 'bacola-core' )
			),
		
			'header_general' => array(
				esc_attr__( 'Header General', 'bacola-core' ),
				esc_attr__( 'You can customize the header.', 'bacola-core' )
			),

			'header_preloader' => array(
				esc_attr__( 'Preloader', 'bacola-core' ),
				esc_attr__( 'You can customize the loader.', 'bacola-core' )
			),
			
			'header_color' => array(
				esc_attr__( 'Header Style', 'bacola-core' ),
				esc_attr__( 'You can customize the color.', 'bacola-core' )
			),
			
			'header_location_style' => array(
				esc_attr__( 'Location Style', 'bacola-core' ),
				esc_attr__( 'You can customize the style.', 'bacola-core' )
			),
			
			'header_search_style' => array(
				esc_attr__( 'Search Style', 'bacola-core' ),
				esc_attr__( 'You can customize the style.', 'bacola-core' )
			),
			
			'header_button_style' => array(
				esc_attr__( 'Button Style', 'bacola-core' ),
				esc_attr__( 'You can customize the style.', 'bacola-core' )
			),
			
			'header_sidebar_menu_style' => array(
				esc_attr__( 'Sidebar Menu Style', 'bacola-core' ),
				esc_attr__( 'You can customize the style.', 'bacola-core' )
			),
			
			'header_mobile_sidebar_menu_style' => array(
				esc_attr__( 'Mobile Sidebar Menu Style', 'bacola-core' ),
				esc_attr__( 'You can customize the style.', 'bacola-core' )
			),
			
		);

		foreach ( $sections as $section_id => $section ) {
			$section_args = array(
				'title' => $section[0],
				'description' => $section[1],
				'panel' => 'bacola_header_panel',
			);

			if ( isset( $section[2] ) ) {
				$section_args['type'] = $section[2];
			}

			Kirki::add_section( 'bacola_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
		}
		
		/*====== Logo ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bacola_logo',
				'label' => esc_attr__( 'Logo', 'bacola-core' ),
				'description' => esc_attr__( 'You can upload a logo.', 'bacola-core' ),
				'section' => 'bacola_header_logo_section',
				'choices' => array(
					'save_as' => 'id',
				),
			)
		);
		
		/*====== Logo ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bacola_mobile_logo',
				'label' => esc_attr__( 'Mobile Logo', 'bacola-core' ),
				'description' => esc_attr__( 'You can upload a logo for the mobile.', 'bacola-core' ),
				'section' => 'bacola_header_logo_section',
				'choices' => array(
					'save_as' => 'id',
				),
			)
		);
		
		/*====== Logo Description ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_logo_desc',
				'label' => esc_attr__( 'Set Logo Description', 'bacola-core' ),
				'description' => esc_attr__( 'You can set logo description.', 'bacola-core' ),
				'section' => 'bacola_header_logo_section',
				'default' => 'Online Grocery Shopping Center',
			)
		);
		
		/*====== Logo Text ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_logo_text',
				'label' => esc_attr__( 'Set Logo Text', 'bacola-core' ),
				'description' => esc_attr__( 'You can set logo as text.', 'bacola-core' ),
				'section' => 'bacola_header_logo_section',
				'default' => 'Bacola',
			)
		);

		/*====== Logo Size ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'slider',
				'settings'    => 'bacola_logo_size',
				'label'       => esc_html__( 'Logo Size', 'bacola-core' ),
				'description' => esc_attr__( 'You can set size of the logo.', 'bacola-core' ),
				'section'     => 'bacola_header_logo_section',
				'default'     => 164,
				'transport'   => 'auto',
				'choices'     => [
					'min'  => 20,
					'max'  => 400,
					'step' => 1,
				],
				'output' => [
				[
					'element' => '.site-header .header-main .site-brand img.desktop-logo',
					'property'    => 'width',
					'units' => 'px',
				], ],
			)
		);
		
		/*====== Mobil Logo Size ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'slider',
				'settings'    => 'bacola_mobil_logo_size',
				'label'       => esc_html__( 'Mobile Logo Size', 'bacola-core' ),
				'description' => esc_attr__( 'You can set size of the mobil logo.', 'bacola-core' ),
				'section'     => 'bacola_header_logo_section',
				'default'     => 93,
				'transport'   => 'auto',
				'choices'     => [
					'min'  => 20,
					'max'  => 300,
					'step' => 1,
				],
				'output' => [
				[
					'element' => '.site-header .header-main .site-brand img.mobile-logo',
					'property'    => 'width',
					'units' => 'px',
				], ],
			)
		);
		
		/*====== Sidebar Logo Size ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'slider',
				'settings'    => 'bacola_sidebar_logo_size',
				'label'       => esc_html__( 'Sidebar Logo Size', 'bacola-core' ),
				'description' => esc_attr__( 'You can set size of the sidebar logo.', 'bacola-core' ),
				'section'     => 'bacola_header_logo_section',
				'default'     => 127,
				'transport'   => 'auto',
				'choices'     => [
					'min'  => 20,
					'max'  => 300,
					'step' => 1,
				],
				'output' => [
				[
					'element' => '.site-canvas .canvas-header .site-brand img',
					'property'    => 'width',
					'units' => 'px',
				], ],
			)
		);
		
		bacola_customizer_add_field(
			array (
			'type'        => 'select',
			'settings'    => 'bacola_header_type',
			'label'       => esc_html__( 'Header Type', 'bacola-core' ),
			'section'     => 'bacola_header_general_section',
			'default'     => 'type-1',
			'priority'    => 10,
			'choices'     => array(
				'type1' => esc_attr__( 'Type 1', 'bacola-core' ),
				'type2' => esc_attr__( 'Type 2', 'bacola-core' ),
			),
			) 
		);

		/*====== Middle Sticky Header Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_middle_sticky_header',
				'label' => esc_attr__( 'Middle Sticky Header', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of the header on the mobile.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '0',
			)
		);

		/*====== Mobile Sticky Header Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_mobile_sticky_header',
				'label' => esc_attr__( 'Mobile Sticky Header', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of the header on the mobile.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Location Filter Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_location_filter',
				'label' => esc_attr__( 'Location Filter', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of the location filter on the header.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '0',
			)
		);

		/*====== Location Filter Popup Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_location_filter_popup',
				'label' => esc_attr__( 'Popup Location Filter', 'bacola-core' ),
				'description' => esc_attr__( 'Enable popup location.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bacola_location_filter',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Search Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_header_search',
				'label' => esc_attr__( 'Header Search', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of the search on the header.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Ajax Search Form ======*/
		if ( class_exists( 'DGWT_WC_Ajax_Search' )){
			bacola_customizer_add_field (
				array(
					'type' => 'toggle',
					'settings' => 'bacola_ajax_search_form',
					'label' => esc_attr__( 'Ajax Search Form Search Holder', 'bacola-core' ),
					'description' => esc_attr__( 'Replace the search bar which is on the search holder.', 'bacola-core' ),
					'section' => 'bacola_header_general_section',
					'default' => '0',
					'required' => array(
						array(
						  'setting'  => 'bacola_header_search',
						  'operator' => '==',
						  'value'    => '1',
						),
					),
				)
			);
		}
		
		/*====== Header Cart Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_header_cart',
				'label' => esc_attr__( 'Header Cart', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of the mini cart on the header.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '0',
			)
		);

		/*====== Header Mini Cart Type ======*/
		bacola_customizer_add_field(
			array (
			'type'        => 'radio-buttonset',
			'settings'    => 'bacola_header_mini_cart_type',
			'label'       => esc_html__( 'Mini Cart Type', 'bacola-core' ),
			'section'     => 'bacola_header_general_section',
			'default'     => 'default',
			'priority'    => 10,
			'choices'     => array(
				'sidecart' => esc_attr__( 'Side Cart', 'bacola-core' ),
				'default' => esc_attr__( 'Default', 'bacola-core' ),
			),
			'required' => array(
				array(
				  'setting'  => 'bacola_header_cart',
				  'operator' => '==',
				  'value'    => '1',
				),
			),
			) 
		);
		
		/*====== Header Mini Cart Notice ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_header_mini_cart_notice',
				'label' => esc_attr__( 'Mini Cart Notice', 'bacola-core' ),
				'description' => esc_attr__( 'You can add a text for the mini cart.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_header_cart',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Account Icon ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_header_account',
				'label' => esc_attr__( 'Account Icon / Login', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable User Login/Signup on the header.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Header Sidebar ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_header_sidebar',
				'label' => esc_attr__( 'Sidebar Menu', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable Sidebar Menu', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '0',
			)
		);

		/*====== Header Sidebar Collapse ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_header_sidebar_collapse',
				'label' => esc_attr__( 'Disable Collapse on Frontpage', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable Sidebar Collapse on Home Page.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bacola_header_sidebar',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Top Header Notice Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_top_header_notice',
				'label' => esc_attr__( 'Top Header Notice', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable the top header notice.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Top Header Notice Text ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bacola_top_header_notice_text',
				'label' => esc_attr__( 'Header Top Notice Text', 'bacola-core' ),
				'description' => esc_attr__( 'You can add a text for the top header notice.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => 'Due to the <strong>COVID 19</strong> epidemic, orders may be processed with a slight delay',
				'required' => array(
					array(
					  'setting'  => 'bacola_top_header_notice',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Top Header Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_top_header',
				'label' => esc_attr__( 'Top Header', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable the top header.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '0',
			)
		);
		
		/*====== Top Header Bar Text ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_top_header_text_icon',
				'label' => esc_attr__( 'Top Header Text Icon', 'bacola-core' ),
				'description' => esc_attr__( 'You can set an icon. for example: secure', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => 'secure',
				'required' => array(
					array(
					  'setting'  => 'bacola_top_header',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Top Header Bar Text ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bacola_top_header_text',
				'label' => esc_attr__( 'Top Header Text', 'bacola-core' ),
				'description' => esc_attr__( 'You can add a text for the top bar text.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => '100% Secure delivery without contacting the courier',
				'required' => array(
					array(
					  'setting'  => 'bacola_top_header',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Top Header Content Text ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bacola_top_header_content_text',
				'label' => esc_attr__( 'Top Header Content Text', 'bacola-core' ),
				'description' => esc_attr__( 'You can add a content text for the top bar.', 'bacola-core' ),
				'section' => 'bacola_header_general_section',
				'default' => 'Need help? Call Us: <strong style="color: #2bbef9;">+ 0020 500</strong>',
				'required' => array(
					array(
					  'setting'  => 'bacola_top_header',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);

		/*====== PreLoader Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_preloader',
				'label' => esc_attr__( 'Enable Loader', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable the loader.', 'bacola-core' ),
				'section' => 'bacola_header_preloader_section',
				'default' => '0',
			)
		);
		
		/*====== Top Header Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_top_bg_color',
				'label' => esc_attr__( 'Top Header Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  background.', 'bacola-core' ),
				'section' => 'bacola_header_color_section',
			)
		);

		/*====== Top Header Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#3e445a',
				'settings' => 'bacola_top_color',
				'label' => esc_attr__( 'Top Header Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_header_color_section',
			)
		);
		
		/*====== Top Header Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#2bbef9',
				'settings' => 'bacola_top_hvrcolor',
				'label' => esc_attr__( 'Top Header Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for hover color.', 'bacola-core' ),
				'section' => 'bacola_header_color_section',
			)
		);

		/*====== Header Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_bg_color',
				'label' => esc_attr__( 'Header Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  background.', 'bacola-core' ),
				'section' => 'bacola_header_color_section',
			)
		);
		
		/*====== Header Font Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#3e445a',
				'settings' => 'bacola_color',
				'label' => esc_attr__( 'Header Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font color.', 'bacola-core' ),
				'section' => 'bacola_header_color_section',
			)
		);

		/*====== Header Font BG Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#f0faff',
				'settings' => 'bacola_header_font_background_hover_color',
				'label' => esc_attr__( 'Header Font Background Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font background.', 'bacola-core' ),
				'section' => 'bacola_header_color_section',
			)
		);

		/*====== Header Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#2bbef9',
				'settings' => 'bacola_hvr_color',
				'label' => esc_attr__( 'Header Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for hover color.', 'bacola-core' ),
				'section' => 'bacola_header_color_section',
			)
		);
		
		/*====== Top Header Typography ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bacola_top_header_size',
				'label'       => esc_attr__( 'Top Header Typography', 'bacola-core' ),
				'section'     => 'bacola_header_color_section',
				'default'     => [
					'font-family'    => '',
					'variant'        => '',
					'font-size'      => '12px',
					'line-height'    => '',
					'letter-spacing' => '',
					'text-transform' => '',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => '.site-header .header-top ',
					],
				],
			)
		);
		
		/*====== Header Typography ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bacola_header_size',
				'label'       => esc_attr__( 'Header Typography', 'bacola-core' ),
				'section'     => 'bacola_header_color_section',
				'default'     => [
					'font-family'    => '',
					'variant'        => '',
					'font-size'      => '15px',
					'line-height'    => '',
					'letter-spacing' => '',
					'text-transform' => '',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => '.site-header .all-categories + .primary-menu .menu > .menu-item > a, nav.site-menu.primary-menu.horizontal .menu > .menu-item > a, .site-header .primary-menu .menu .sub-menu .menu-item > a',
					],
				],		
			)
		);
		
		/*======  Location Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_lct_bg_color',
				'label' => esc_attr__( 'Location Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  background.', 'bacola-core' ),
				'section' => 'bacola_header_location_style_section',
			)
		);
		
		/*======  Location Background Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_lct_bg_hvrcolor',
				'label' => esc_attr__( 'Location Background Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for hover background.', 'bacola-core' ),
				'section' => 'bacola_header_location_style_section',
			)
		);
		
		/*======  Location Border Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#d9d9e9',
				'settings' => 'bacola_lct_brdr_color',
				'label' => esc_attr__( 'Location Border Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  Border.', 'bacola-core' ),
				'section' => 'bacola_header_location_style_section',
			)
		);
		
		/*======  Location Border Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#d9d9e9',
				'settings' => 'bacola_lct_brdr_hvrcolor',
				'label' => esc_attr__( 'Location Border Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for hover  Border.', 'bacola-core' ),
				'section' => 'bacola_header_location_style_section',
			)
		);
		
		/*======  Location Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#3e445a',
				'settings' => 'bacola_lct_color',
				'label' => esc_attr__( ' Location Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_header_location_style_section',
			)
		);
		
		/*======  Location Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#3e445a',
				'settings' => 'bacola_lct_hvrcolor',
				'label' => esc_attr__( ' Location Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for hover color.', 'bacola-core' ),
				'section' => 'bacola_header_location_style_section',
			)
		);
		
		/*======  Location Second Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#233a95',
				'settings' => 'bacola_lct_scnd_color',
				'label' => esc_attr__( ' Location Second Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_header_location_style_section',
			)
		);
		
		/*======  Location Second Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#233a95',
				'settings' => 'bacola_lct_scnd_hvrcolor',
				'label' => esc_attr__( ' Location Second Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for hover color.', 'bacola-core' ),
				'section' => 'bacola_header_location_style_section',
			)
		);
		
		/*======  Location Arrow Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#233a95',
				'settings' => 'bacola_lct_arrow_color',
				'label' => esc_attr__( ' Location Arrow Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_header_location_style_section',
			)
		);
		
		/*====== Location Typography ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bacola_header_lct_size',
				'label'       => esc_attr__( 'Location Typography', 'bacola-core' ),
				'section'     => 'bacola_header_location_style_section',
				'default'     => [
					'font-family'    => '',
					'variant'        => '',
					'font-size'      => '',
					'line-height'    => '',
					'letter-spacing' => '',
					'text-transform' => '',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => '.site-location a .location-description , .site-location a .current-location ',
					],
				],
			)
		);
		
		/*======  Search Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#f3f4f7',
				'settings' => 'bacola_search_bg_color',
				'label' => esc_attr__( 'Search Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  background.', 'bacola-core' ),
				'section' => 'bacola_header_search_style_section',
			)
		);
		
		/*======  Search Border Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#f3f4f7',
				'settings' => 'bacola_search_brdrcolor',
				'label' => esc_attr__( 'Search Border Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_search_style_section',
			)
		);
		
		/*======  Search Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#202435',
				'settings' => 'bacola_search_color',
				'label' => esc_attr__( 'Search Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_search_style_section',
			)
		);
		
		/*======  Search Icon Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#202435',
				'settings' => 'bacola_search_icon_color',
				'label' => esc_attr__( 'Search Icon Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_search_style_section',
			)
		);
		
		/*======  Login Button Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_login_btn_bg_color',
				'label' => esc_attr__( 'Login Button Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  background.', 'bacola-core' ),
				'section' => 'bacola_header_button_style_section',
			)
		);
		
		/*======  Login Button Border Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#e2e4ec',
				'settings' => 'bacola_login_btn_brdrcolor',
				'label' => esc_attr__( 'Login Button Border Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  border color.', 'bacola-core' ),
				'section' => 'bacola_header_button_style_section',
			)
		);
		
		/*======  Login Button Icon Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#3e445a',
				'settings' => 'bacola_login_btn_color',
				'label' => esc_attr__( 'Login Button Icon Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for icon color.', 'bacola-core' ),
				'section' => 'bacola_header_button_style_section',
			)
		);
		
		/*======  Price Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#202435',
				'settings' => 'bacola_price_color',
				'label' => esc_attr__( 'Price Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for price color.', 'bacola-core' ),
				'section' => 'bacola_header_button_style_section',
			)
		);
		
		/*======  Cart Icon Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff1ee',
				'settings' => 'bacola_crt_bg_color',
				'label' => esc_attr__( 'Cart Icon Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  background.', 'bacola-core' ),
				'section' => 'bacola_header_button_style_section',
			)
		);
		
		/*====== Cart Icon Border Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff1ee',
				'settings' => 'bacola_crt_brdrcolor',
				'label' => esc_attr__( 'Cart Icon Border Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  border color.', 'bacola-core' ),
				'section' => 'bacola_header_button_style_section',
			)
		);
		
		/*======  Cart Icon  Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#ea2b0f',
				'settings' => 'bacola_crt_color',
				'label' => esc_attr__( 'Cart Icon Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for icon color.', 'bacola-core' ),
				'section' => 'bacola_header_button_style_section',
			)
		);
		
		/*======  Cart Count Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#ea2b0f',
				'settings' => 'bacola_crt_count_bg_color',
				'label' => esc_attr__( 'Cart Count Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  background.', 'bacola-core' ),
				'section' => 'bacola_header_button_style_section',
			)
		);
		
		/*======  Cart Count Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_crt_count_color',
				'label' => esc_attr__( 'Cart Count Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_button_style_section',
			)
		);
		
		/*======  Sidebar Menu Main Title Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#2bbef9',
				'settings' => 'bacola_sidebar_title_bg',
				'label' => esc_attr__( 'Sidebar Title Background', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bacola-core' ),
				'section' => 'bacola_header_sidebar_menu_style_section',
			)
		);
		
		/*======  Sidebar Menu Main Title Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_sidebar_title_color',
				'label' => esc_attr__( 'Sidebar Title Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_sidebar_menu_style_section',
			)
		);
		
		/*======  Sidebar Menu Main Title Arrow Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_title_arrow_color',
				'label' => esc_attr__( 'Main Title Arrow Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_sidebar_menu_style_section',
			)
		);
		
		/*======  Sidebar Menu Second Main Title Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#edeef5',
				'settings' => 'bacola_title_second_bg',
				'label' => esc_attr__( 'Second Main Title Background', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bacola-core' ),
				'section' => 'bacola_header_sidebar_menu_style_section',
			)
		);
		
		/*======  Sidebar Menu Second Main Title Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#71778e',
				'settings' => 'bacola_title_second_color',
				'label' => esc_attr__( 'Second Main Title Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_sidebar_menu_style_section',
			)
		);
		
		/*======  Sidebar Menu Second Main Title Border Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_title_second_brdrcolor',
				'label' => esc_attr__( 'Second Main Title Border Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_sidebar_menu_style_section',
			)
		);
		
		
		/*======  Sidebar Menu Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_sidebar_bg',
				'label' => esc_attr__( 'Sidebar Menu Background', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bacola-core' ),
				'section' => 'bacola_header_sidebar_menu_style_section',
			)
		);
		
		/*======  Sidebar Menu Border Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#e4e5ee',
				'settings' => 'bacola_sidebar_brdrcolor',
				'label' => esc_attr__( 'Sidebar Menu Border Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for border color.', 'bacola-core' ),
				'section' => 'bacola_header_sidebar_menu_style_section',
			)
		);
		
		/*======  Sidebar Menu Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#3e445a',
				'settings' => 'bacola_sidebar_color',
				'label' => esc_attr__( 'Sidebar Menu Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_sidebar_menu_style_section',
			)
		);
		
		/*======  Sidebar Menu Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#2bbef9',
				'settings' => 'bacola_sidebar_hvrcolor',
				'label' => esc_attr__( 'Sidebar Menu Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_sidebar_menu_style_section',
			)
		);
		
		/*====== Sidebar Menu Typography ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bacola_header_sidebar_size',
				'label'       => esc_attr__( 'Sidebar Menu Typography', 'bacola-core' ),
				'section'     => 'bacola_header_sidebar_menu_style_section',
				'default'     => [
					'font-family'    => '',
					'variant'        => '',
					'font-size'      => '13px',
					'line-height'    => '',
					'letter-spacing' => '',
					'text-transform' => '',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => '.menu-list li.link-parent > a , .site-header .all-categories > a ',
					],
				],
			)
		);
		
	/*====== Mobile Sidebar Menu Style ======*/	
		
		/*======  Mobile Sidebar Menu Header Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#202435',
				'settings' => 'bacola_mobile_sidebar_menu_header_color',
				'label' => esc_attr__( 'Mobile Sidebar Menu Header Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_mobile_sidebar_menu_style_section',
			)
		);
		
		/*======  Mobile Sidebar Menu Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#3e445a',
				'settings' => 'bacola_mobile_sidebar_menu_color',
				'label' => esc_attr__( 'Mobile Sidebar Menu Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_mobile_sidebar_menu_style_section',
			)
		);
		
		/*======  Mobile Sidebar Menu Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#2bbef9',
				'settings' => 'bacola_mobile_sidebar_menu_hvrcolor',
				'label' => esc_attr__( 'Mobile Sidebar Menu Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_mobile_sidebar_menu_style_section',
			)
		);
		
		/*======  Mobile Sidebar Menu Border Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#edeef5',
				'settings' => 'bacola_mobile_sidebar_menu_brdrcolor',
				'label' => esc_attr__( 'Mobile Sidebar Menu Border Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for border color.', 'bacola-core' ),
				'section' => 'bacola_header_mobile_sidebar_menu_style_section',
			)
		);
		
		/*======  Mobile Sidebar Menu Copyright Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#9b9bb4',
				'settings' => 'bacola_mobile_sidebar_menu_copyright_color',
				'label' => esc_attr__( 'Mobile Sidebar Menu Copyright Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font-color.', 'bacola-core' ),
				'section' => 'bacola_header_mobile_sidebar_menu_style_section',
			)
		);

	/*====== SHOP ====================================================================================*/
		/*====== Shop Panels ======*/
		Kirki::add_panel (
			'bacola_shop_panel',
			array(
				'title' => esc_html__( 'Shop Settings', 'bacola-core' ),
				'description' => esc_html__( 'You can customize the shop from this panel.', 'bacola-core' ),
			)
		);

		$sections = array (
			'shop_general' => array(
				esc_attr__( 'General', 'bacola-core' ),
				esc_attr__( 'You can customize shop settings.', 'bacola-core' )
			),
			
			'shop_single' => array(
				esc_attr__( 'Product Detail', 'bacola-core' ),
				esc_attr__( 'You can customize the product single settings.', 'bacola-core' )
			),
			
			'shop_banner' => array(
				esc_attr__( 'Banner', 'bacola-core' ),
				esc_attr__( 'You can customize the banner.', 'bacola-core' )
			),
			
			'mobile_menu' => array(
				esc_attr__( 'Mobile Bottom Menu Style ', 'bacola-core' ),
				esc_attr__( 'You can customize the mobile menu.', 'bacola-core' )
			),

			'my_account' => array(
				esc_attr__( 'My Account', 'bacola-core' ),
				esc_attr__( 'You can customize the my account page.', 'bacola-core' )
			),

			'free_shipping_bar' => array(
				esc_attr__( 'Free Shipping Bar ', 'bacola-core' ),
				esc_attr__( 'You can customize the free shipping bar settings.', 'bacola-core' )
			),
			
		);

		foreach ( $sections as $section_id => $section ) {
			$section_args = array(
				'title' => $section[0],
				'description' => $section[1],
				'panel' => 'bacola_shop_panel',
			);

			if ( isset( $section[2] ) ) {
				$section_args['type'] = $section[2];
			}

			Kirki::add_section( 'bacola_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
		}
		
		/*====== Shop Layouts ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'bacola_shop_layout',
				'label' => esc_attr__( 'Layout', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose a layout for the shop.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => 'left-sidebar',
				'choices' => array(
					'left-sidebar' => esc_attr__( 'Left Sidebar', 'bacola-core' ),
					'full-width' => esc_attr__( 'Full Width', 'bacola-core' ),
					'right-sidebar' => esc_attr__( 'Right Sidebar', 'bacola-core' ),
				),
			)
		);

		/*====== Shop Width ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'bacola_shop_width',
				'label' => esc_attr__( 'Shop Page Width', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose a layout for the shop page.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => 'boxed',
				'choices' => array(
					'boxed' => esc_attr__( 'Boxed', 'bacola-core' ),
					'wide' => esc_attr__( 'Wide', 'bacola-core' ),
				),
			)
		);

		bacola_customizer_add_field(
			array (
			'type'        => 'radio-buttonset',
			'settings'    => 'bacola_product_box_type',
			'label'       => esc_html__( 'Shop Product Box Type', 'bacola-core' ),
			'section'     => 'bacola_shop_general_section',
			'default'     => 'type1',
			'priority'    => 10,
			'choices'     => array(
				'type1' => esc_attr__( 'Type 1', 'bacola-core' ),
				'type2' => esc_attr__( 'Type 2', 'bacola-core' ),
				'type4' => esc_attr__( 'Type 4', 'bacola-core' ),
			),
			) 
		);

		bacola_customizer_add_field(
			array (
			'type'        => 'radio-buttonset',
			'settings'    => 'bacola_paginate_type',
			'label'       => esc_html__( 'Pagination Type', 'bacola-core' ),
			'section'     => 'bacola_shop_general_section',
			'default'     => 'default',
			'priority'    => 10,
			'choices'     => array(
				'default' => esc_attr__( 'Default', 'bacola-core' ),
				'loadmore' => esc_attr__( 'Load More', 'bacola-core' ),
				'infinite' => esc_attr__( 'Infinite', 'bacola-core' ),
			),
			) 
		);
		
		/*====== Quantity Box Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_quantity_box',
				'label' => esc_attr__( 'Quantity Box', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable quantity box for the product box.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Ajax on Shop Page ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_ajax_on_shop',
				'label' => esc_attr__( 'Ajax on Shop Page', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable Ajax for the shop page.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Grid-List Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_grid_list_view',
				'label' => esc_attr__( 'Grid List View', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable grid list view on shop page.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Perpage Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_perpage_view',
				'label' => esc_attr__( 'Perpage View', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable perpage view on shop page.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Atrribute Swatches ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_attribute_swatches',
				'label' => esc_attr__( 'Attribute Swatches', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable the attribute types (Color - Button - Images).', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Quick View Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_quick_view_button',
				'label' => esc_attr__( 'Quick View Button', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of the quick view button.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Wishlist Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_wishlist_button',
				'label' => esc_attr__( 'Custom Wishlist Button', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of the wishlist button.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Ajax Notice Shop ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_shop_notice_ajax_addtocart',
				'label' => esc_attr__( 'Added to Cart Ajax Notice', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of the ajax notice feature.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Mobile Bottom Menu======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_mobile_bottom_menu',
				'label' => esc_attr__( 'Mobile Bottom Menu', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable the bottom menu on mobile.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Mobile Bottom Menu Edit Toggle======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_mobile_bottom_menu_edit_toggle',
				'label' => esc_attr__( 'Mobile Bottom Menu Edit', 'bacola-core' ),
				'description' => esc_attr__( 'Edit the mobile bottom menu.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bacola_mobile_bottom_menu',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
				
			)
			
		);
		
		/*====== Mobile Menu Repeater ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'repeater',
				'settings' => 'bacola_mobile_bottom_menu_edit',
				'label' => esc_attr__( 'Mobile Bottom Menu Edit', 'bacola-core' ),
				'description' => esc_attr__( 'Edit the mobile bottom menu.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'required' => array(
					array(
					  'setting'  => 'bacola_mobile_bottom_menu_edit_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
				'fields' => array(
					'mobile_menu_type' => array(
						'type' => 'select',
						'label' => esc_attr__( 'Select Type', 'bacola-core' ),
						'description' => esc_attr__( 'You can select a type', 'bacola-core' ),
						'default' => 'default',
						'choices' => array(
							'default' => esc_attr__( 'Default', 'bacola-core' ),
							'search' => esc_attr__( 'Search', 'bacola-core' ),
							'filter' => esc_attr__( 'Filter', 'bacola-core' ),
							'category' => esc_attr__( 'category', 'bacola-core' ),
						),
					),
				
					'mobile_menu_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Icon', 'bacola-core' ),
						'description' => esc_attr__( 'You can set an icon. for example; "store"', 'bacola-core' ),
					),
					'mobile_menu_text' => array(
						'type' => 'text',
						'label' => esc_attr__( ' Text', 'bacola-core' ),
						'description' => esc_attr__( 'You can enter a text.', 'bacola-core' ),
					),
					'mobile_menu_url' => array(
						'type' => 'text',
						'label' => esc_attr__( 'URL', 'bacola-core' ),
						'description' => esc_attr__( 'You can set url for the item.', 'bacola-core' ),
					),
				),
				
			)
		);

		/*====== Product Stock Quantity ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_stock_quantity',
				'label' => esc_attr__( 'Stock Quantity', 'bacola-core' ),
				'description' => esc_attr__( 'Show stock quantity on the label.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Product Min/Max Quantity ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_min_max_quantity',
				'label' => esc_attr__( 'Min/Max Quantity', 'bacola-core' ),
				'description' => esc_attr__( 'Enable the additional quantity setting fields in product detail page.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Category Description ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_category_description_after_content',
				'label' => esc_attr__( 'Category Desc After Content', 'bacola-core' ),
				'description' => esc_attr__( 'Add the category description after the products.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Catalog Mode - Disable Add to Cart ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_catalog_mode',
				'label' => esc_attr__( 'Catalog Mode', 'bacola-core' ),
				'description' => esc_attr__( 'Disable Add to Cart button on the shop page.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);	

		/*====== Recently Viewed Products ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_recently_viewed_products',
				'label' => esc_attr__( 'Recently Viewed Products', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable Recently Viewed Products.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);

		/*====== Recently Viewed Products Coulmn ======*/
		bacola_customizer_add_field(
			array (
				'type'        => 'radio-buttonset',
				'settings'    => 'bacola_recently_viewed_products_column',
				'label'       => esc_html__( 'Recently Viewed Products Column', 'bacola-core' ),
				'section'     => 'bacola_shop_general_section',
				'default'     => '4',
				'priority'    => 10,
				'choices'     => array(
					'6' => esc_attr__( '6', 'bacola-core' ),
					'5' => esc_attr__( '5', 'bacola-core' ),
					'4' => esc_attr__( '4', 'bacola-core' ),
					'3' => esc_attr__( '3', 'bacola-core' ),
					'2' => esc_attr__( '2', 'bacola-core' ),
				),
				'required' => array(
					array(
					  'setting'  => 'bacola_recently_viewed_products',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			) 
		);

		/*====== Min Order Amount ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_min_order_amount_toggle',
				'label' => esc_attr__( 'Min Order Amount', 'bacola-core' ),
				'description' => esc_attr__( 'Enable Min Order Amount.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Min Order Amount Value ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_min_order_amount_value',
				'label' => esc_attr__( 'Min Order Value', 'bacola-core' ),
				'description' => esc_attr__( 'Set amount to specify a minimum order value.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_min_order_amount_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);

		/*====== Product Image Size ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'dimensions',
				'settings' => 'bacola_product_image_size',
				'label' => esc_attr__( 'Product Image Size', 'bacola-core' ),
				'description' => esc_attr__( 'You can set size of the product image for the shop page.', 'bacola-core' ),
				'section' => 'bacola_shop_general_section',
				'default' => array(
					'width' => '',
					'height' => '',
				),
			)
		);

		/*====== Shop Single Image Column ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'slider',
				'settings'    => 'bacola_shop_single_image_column',
				'label'       => esc_html__( 'Image Column', 'bacola-core' ),
				'section'     => 'bacola_shop_single_section',
				'default'     => 5,
				'transport'   => 'auto',
				'choices'     => [
					'min'  => 3,
					'max'  => 12,
					'step' => 1,
				],
			)
		);

		/*====== Shop Single Type ======*/
		bacola_customizer_add_field(
			array (
			'type'        => 'radio-buttonset',
			'settings'    => 'bacola_single_type',
			'label'       => esc_html__( 'Type (Product Detail)', 'bacola-core' ),
			'section'     => 'bacola_shop_single_section',
			'default'     => 'type1',
			'priority'    => 10,
			'choices'     => array(
				'type1' => esc_attr__( 'Type 1', 'bacola-core' ),
				'type2' => esc_attr__( 'Type 2', 'bacola-core' ),
				'type3' => esc_attr__( 'Type 3', 'bacola-core' ),
				'type4' => esc_attr__( 'Type 4', 'bacola-core' ),
			),
			) 
		);
		
		/*====== Shop Single Gallery Type ======*/
		bacola_customizer_add_field(
			array (
			'type'        => 'radio-buttonset',
			'settings'    => 'bacola_single_gallery_type',
			'label'       => esc_html__( 'Gallery Type (Product Detail)', 'bacola-core' ),
			'section'     => 'bacola_shop_single_section',
			'default'     => 'horizontal',
			'priority'    => 10,
			'choices'     => array(
				'horizontal' => esc_attr__( 'Horizontal', 'bacola-core' ),
				'vertical' => esc_attr__( 'Vertical', 'bacola-core' ),
			),
			) 
		);

		/*====== Shop Single Full width ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_single_full_width',
				'label' => esc_attr__( 'Full Width', 'bacola-core' ),
				'description' => esc_attr__( 'Stretch the single product page content.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Shop Single Image Zoom  ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_single_image_zoom',
				'label' => esc_attr__( 'Image Zoom', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of the zoom feature.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Product360 View ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_shop_single_product360',
				'label' => esc_attr__( 'Product360 View', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable Product 360 View.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);
		
		/*====== Shop Single Compare  ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_compare_button',
				'label' => esc_attr__( 'Compare', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of the compare button.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Shop Single Ajax Add To Cart ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_shop_single_ajax_addtocart',
				'label' => esc_attr__( 'Ajax Add to Cart', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable ajax add to cart button.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Mobile Sticky Single Cart ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_mobile_single_sticky_cart',
				'label' => esc_attr__( 'Mobile Sticky Add to Cart', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable sticky cart button on mobile.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Buy Now Single ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_shop_single_buy_now',
				'label' => esc_attr__( 'Buy Now Button', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable Buy Now button.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Related By Tags ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_related_by_tags',
				'label' => esc_attr__( 'Related Products with Tags', 'bacola-core' ),
				'description' => esc_attr__( 'Display the related products by tags.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Single Product Stock Progress Bar ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_shop_single_stock_progress_bar',
				'label' => esc_attr__( 'Stock Progress Bar', 'bacola-core' ),
				'description' => esc_attr__( 'Display the stock progress bar if stock management is enabled.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);
		
		/*====== Single Product Time Countdown ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_shop_single_time_countdown',
				'label' => esc_attr__( 'Time Countdown', 'bacola-core' ),
				'description' => esc_attr__( 'Display the sale time countdown.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Order on WhatsApp ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_shop_single_orderonwhatsapp',
				'label' => esc_attr__( 'Order on WhatsApp', 'bacola-core' ),
				'description' => esc_attr__( 'Enable the button on the product detail page.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);
		
		/*====== Order on WhatsApp Number======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_shop_single_whatsapp_number',
				'label' => esc_attr__( 'WhatsApp Number', 'bacola-core' ),
				'description' => esc_attr__( 'You can add a phone number for order on WhatsApp.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_shop_single_orderonwhatsapp',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);

		/*====== Move Review Tab ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_shop_single_review_tab_move',
				'label' => esc_attr__( 'Move Review Tab', 'bacola-core' ),
				'description' => esc_attr__( 'Move the review tab out of tabs', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Shop Single Social Share ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_shop_social_share',
				'label' => esc_attr__( 'Social Share (Product Detail)', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable social share buttons.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Shop Single Social Share ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'multicheck',
				'settings'    => 'bacola_shop_single_share',
				'section'     => 'bacola_shop_single_section',
				'default'     => array('facebook','twitter', 'pinterest', 'linkedin', 'reddit', 'whatsapp'  ),
				'priority'    => 10,
				'choices'     => [
					'facebook'  => esc_html__( 'Facebook', 	'bacola-core' ),
					'twitter' 	=> esc_html__( 'Twitter', 	'bacola-core' ),
					'pinterest' => esc_html__( 'Pinterest', 'bacola-core' ),
					'linkedin'  => esc_html__( 'Linkedin', 	'bacola-core' ),
					'reddit'  	=> esc_html__( 'Reddit', 	'bacola-core' ),
					'whatsapp'  => esc_html__( 'Whatsapp', 	'bacola-core' ),
				],
				'required' => array(
					array(
					  'setting'  => 'bacola_shop_social_share',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		

		/*====== Shop Single Featured Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_shop_single_featured_toggle',
				'label' => esc_attr__( 'Featured List', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable the featured list.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '0',
			)
		);

		/*====== Shop Single Featured Title ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_shop_single_featured_title',
				'label' => esc_attr__( 'Set Title', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a title.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_shop_single_featured_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Shop Single Featured List ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'repeater',
				'settings' => 'bacola_single_featured_list',
				'label' => esc_attr__( 'Featured List', 'bacola-core' ),
				'description' => esc_attr__( 'You can create the featured list.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'row_label' => array (
					'type' => 'field',
					'field' => 'link_text',
				),
				'required' => array(
					array(
					  'setting'  => 'bacola_shop_single_featured_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
				'fields' => array(
					'featured_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Featured Icon', 'bacola-core' ),
						'description' => esc_attr__( 'Icon example; klbth-icon-dollar.', 'bacola-core' ),
					),
					'featured_text' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Featured Content', 'bacola-core' ),
						'description' => esc_attr__( 'You can enter a text.', 'bacola-core' ),
					),
				),
			)
		);

		/*====== Product Related Post Column ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bacola_shop_related_post_column',
				'label' => esc_attr__( 'Related Post Column', 'bacola-core' ),
				'description' => esc_attr__( 'You can control related post column with this option.', 'bacola-core' ),
				'section' => 'bacola_shop_single_section',
				'default' => '4',
				'choices' => array(
					'5' => esc_attr__( '5 Columns', 'bacola-core' ),
					'4' => esc_attr__( '4 Columns', 'bacola-core' ),
					'3' => esc_attr__( '3 Columns', 'bacola-core' ),
					'2' => esc_attr__( '2 Columns', 'bacola-core' ),
				),
			)
		);

		
		/*====== Shop Banner Image======*/
		bacola_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bacola_shop_banner_image',
				'label' => esc_attr__( 'Image', 'bacola-core' ),
				'description' => esc_attr__( 'You can upload an image.', 'bacola-core' ),
				'section' => 'bacola_shop_banner_section',
				'choices' => array(
					'save_as' => 'id',
				),
			)
		);
		
		/*====== Shop Banner Title ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_shop_banner_title',
				'label' => esc_attr__( 'Set Title', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a title.', 'bacola-core' ),
				'section' => 'bacola_shop_banner_section',
				'default' => '',
			)
		);
		
		/*====== Shop Banner Subtitle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bacola_shop_banner_subtitle',
				'label' => esc_attr__( 'Set Subtitle', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a subtitle.', 'bacola-core' ),
				'section' => 'bacola_shop_banner_section',
				'default' => '',
			)
		);
		
		/*====== Shop Banner Desc ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_shop_banner_desc',
				'label' => esc_attr__( 'Description', 'bacola-core' ),
				'description' => esc_attr__( 'Add a description.', 'bacola-core' ),
				'section' => 'bacola_shop_banner_section',
				'default' => '',
			)
		);

		/*====== Shop Banner URL ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_shop_banner_button_url',
				'label' => esc_attr__( 'Set URL', 'bacola-core' ),
				'description' => esc_attr__( 'Set an url for the button', 'bacola-core' ),
				'section' => 'bacola_shop_banner_section',
				'default' => '#',
			)
		);
		

		/*====== Banner Repeater For each category ======*/
		add_action( 'init', function() {
			bacola_customizer_add_field (
				array(
					'type' => 'repeater',
					'settings' => 'bacola_shop_banner_each_category',
					'label' => esc_attr__( 'Banner For Categories', 'bacola-core' ),
					'description' => esc_attr__( 'You can set banner for each category.', 'bacola-core' ),
					'section' => 'bacola_shop_banner_section',
					'fields' => array(
						
						'category_id' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'Select Category', 'bacola-core' ),
							'description' => esc_html__( 'Set a category', 'bacola-core' ),
							'priority'    => 10,
							'choices'     => Kirki_Helper::get_terms( array('taxonomy' => 'product_cat') )
						),
						
						'category_image' =>  array(
							'type' => 'image',
							'label' => esc_attr__( 'Image', 'bacola-core' ),
							'description' => esc_attr__( 'You can upload an image.', 'bacola-core' ),
						),
						
						'category_title' => array(
							'type' => 'text',
							'label' => esc_attr__( 'Set Title', 'bacola-core' ),
							'description' => esc_attr__( 'You can set a title.', 'bacola-core' ),
						),
						
						'category_subtitle' => array(
							'type' => 'text',
							'label' => esc_attr__( 'Set Subtitle', 'bacola-core' ),
							'description' => esc_attr__( 'You can set a subtitle.', 'bacola-core' ),
						),
			
						'category_desc' => array(
							'type' => 'text',
							'label' => esc_attr__( 'Description', 'bacola-core' ),
							'description' => esc_attr__( 'Add a description.', 'bacola-core' ),
						),
						
						'category_button_url' => array(
							'type' => 'text',
							'label' => esc_attr__( 'Set URL', 'bacola-core' ),
							'description' => esc_attr__( 'Set an url for the button', 'bacola-core' ),
						),
					),
				)
			);
		} );
		
		/*======  Mobile Menu Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_mobile_menu_bg_color',
				'label' => esc_attr__( 'Mobile Menu Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a Background.', 'bacola-core' ),
				'section' => 'bacola_mobile_menu_section',
			)
		);
		
		/*======  Mobile Menu Icon Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#a7a7b5',
				'settings' => 'bacola_mobile_menu_icon_color',
				'label' => esc_attr__( 'Mobile Menu Icon Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color.', 'bacola-core' ),
				'section' => 'bacola_mobile_menu_section',
			)
		);
		
		/*======  Mobile Menu Icon Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#a7a7b5',
				'settings' => 'bacola_mobile_menu_icon_hvrcolor',
				'label' => esc_attr__( 'Mobile Menu Icon Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color.', 'bacola-core' ),
				'section' => 'bacola_mobile_menu_section',
			)
		);
		
		/*======  Mobile Menu Font Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#a7a7b5',
				'settings' => 'bacola_mobile_menu_color',
				'label' => esc_attr__( 'Mobile Menu Font Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color.', 'bacola-core' ),
				'section' => 'bacola_mobile_menu_section',
			)
		);
		
		/*======  Mobile Menu Font Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#a7a7b5',
				'settings' => 'bacola_mobile_menu_hvr_color',
				'label' => esc_attr__( 'Mobile Menu Font Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color.', 'bacola-core' ),
				'section' => 'bacola_mobile_menu_section',
			)
		);
		
		/*====== Mobile Menu Font Style ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bacola_mobile_menu_size',
				'label'       => esc_attr__( 'Mobile Menu Font Style', 'bacola-core' ),
				'section'     => 'bacola_mobile_menu_section',
				'default'     => [
					'font-family'    => '',
					'variant'        => '',
					'font-size'      => '10px',
					'line-height'    => '',
					'letter-spacing' => '',
					'text-transform' => '',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => '.site-header .header-mobile-nav .menu-item a span',
					],
				],		
			)
		);

		/*====== My Account Layouts ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'bacola_my_account_layout',
				'label' => esc_attr__( 'Layout', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose a layout for the login form.', 'bacola-core' ),
				'section' => 'bacola_my_account_section',
				'default' => 'default',
				'choices' => array(
					'default' => esc_attr__( 'Default', 'bacola-core' ),
					'logintab' => esc_attr__( 'Login Tab', 'bacola-core' ),
				),
			)
		);

		/*====== Registration Form First Name ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bacola_registration_first_name',
				'label' => esc_attr__( 'Register - First Name', 'bacola-core' ),
				'section' => 'bacola_my_account_section',
				'default' => 'hidden',
				'choices' => array(
					'hidden' => esc_attr__( 'Hidden', 'bacola-core' ),
					'visible' => esc_attr__( 'Visible', 'bacola-core' ),
					'optional' => esc_attr__( 'Optional', 'bacola-core' ),
				),
			)
		);
		
		/*====== Registration Form Last Name ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bacola_registration_last_name',
				'label' => esc_attr__( 'Register - Last Name', 'bacola-core' ),
				'section' => 'bacola_my_account_section',
				'default' => 'hidden',
				'choices' => array(
					'hidden' => esc_attr__( 'Hidden', 'bacola-core' ),
					'visible' => esc_attr__( 'Visible', 'bacola-core' ),
					'optional' => esc_attr__( 'Optional', 'bacola-core' ),
				),
			)
		);
		
		/*====== Registration Form Billing Company ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bacola_registration_billing_company',
				'label' => esc_attr__( 'Register - Billing Company', 'bacola-core' ),
				'section' => 'bacola_my_account_section',
				'default' => 'hidden',
				'choices' => array(
					'hidden' => esc_attr__( 'Hidden', 'bacola-core' ),
					'visible' => esc_attr__( 'Visible', 'bacola-core' ),
					'optional' => esc_attr__( 'Optional', 'bacola-core' ),
				),
			)
		);
		
		/*====== Registration Form Billing Phone ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bacola_registration_billing_phone',
				'label' => esc_attr__( 'Register - Billing Phone', 'bacola-core' ),
				'section' => 'bacola_my_account_section',
				'default' => 'hidden',
				'choices' => array(
					'hidden' => esc_attr__( 'Hidden', 'bacola-core' ),
					'visible' => esc_attr__( 'Visible', 'bacola-core' ),
					'optional' => esc_attr__( 'Optional', 'bacola-core' ),
				),
			)
		);
		

	/*====== Free Shipping Settings =======================================================*/
	
		/*====== Free Shipping ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_free_shipping',
				'label' => esc_attr__( 'Free shipping bar', 'bacola-core' ),
				'section' => 'bacola_free_shipping_bar_section',
				'default' => '0',
			)
		);
		
		/*====== Free Shipping Goal Amount ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shipping_progress_bar_amount',
				'label' => esc_attr__( 'Goal Amount', 'bacola-core' ),
				'description' => esc_attr__( 'Amount to reach 100% defined in your currency absolute value. For example: 300', 'bacola-core' ),
				'section' => 'bacola_free_shipping_bar_section',
				'default' => '100',
				'required' => array(
					array(
					  'setting'  => 'bacola_free_shipping',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Free Shipping Location Cart Page ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shipping_progress_bar_location_card_page',
				'label' => esc_attr__( 'Cart page', 'bacola-core' ),
				'section' => 'bacola_free_shipping_bar_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bacola_free_shipping',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Free Shipping Location Mini cart ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shipping_progress_bar_location_mini_cart',
				'label' => esc_attr__( 'Mini cart', 'bacola-core' ),
				'section' => 'bacola_free_shipping_bar_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bacola_free_shipping',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Free Shipping Location Checkout page ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shipping_progress_bar_location_checkout',
				'label' => esc_attr__( 'Checkout page', 'bacola-core' ),
				'section' => 'bacola_free_shipping_bar_section',
				'default' => '0',
				'required' => array(
					array(
					  'setting'  => 'bacola_free_shipping',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Free Shipping Message Initial ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'shipping_progress_bar_message_initial',
				'label' => esc_attr__( 'Initial Message', 'bacola-core' ),
				'description' => esc_attr__( 'Message to show before reaching the goal. Use shortcode [remainder] to display the amount left to reach the minimum.', 'bacola-core' ),
				'section' => 'bacola_free_shipping_bar_section',
				'default' => 'Add [remainder] to cart and get free shipping!',
				'required' => array(
					array(
					  'setting'  => 'bacola_free_shipping',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Free Shipping Message Success ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'shipping_progress_bar_message_success',
				'label' => esc_attr__( 'Success message', 'bacola-core' ),
				'description' => esc_attr__( 'Message to show after reaching 100%.', 'bacola-core' ),
				'section' => 'bacola_free_shipping_bar_section',
				'default' => 'Your order qualifies for free shipping!',
				'required' => array(
					array(
					  'setting'  => 'bacola_free_shipping',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);

	/*====== Blog Settings =======================================================*/
		/*====== Layouts ======*/
		
		bacola_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'bacola_blog_layout',
				'label' => esc_attr__( 'Layout', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose a layout.', 'bacola-core' ),
				'section' => 'bacola_blog_settings_section',
				'default' => 'right-sidebar',
				'choices' => array(
					'left-sidebar' => esc_attr__( 'Left Sidebar', 'bacola-core' ),
					'full-width' => esc_attr__( 'Full Width', 'bacola-core' ),
					'right-sidebar' => esc_attr__( 'Right Sidebar', 'bacola-core' ),
				),
			)
		);
		
		/*====== Main color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#233a95',
				'settings' => 'bacola_main_color',
				'label' => esc_attr__( 'Main Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can customize the main color.', 'bacola-core' ),
				'section' => 'bacola_main_color_section',
			)
		);

		/*====== Secondary color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#2bbef9',
				'settings' => 'bacola_second_color',
				'label' => esc_attr__( 'Second Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can customize the secondary color.', 'bacola-core' ),
				'section' => 'bacola_main_color_section',
			)
		);

		/*====== Price Font color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#d51243',
				'settings' => 'bacola_price_font_color',
				'label' => esc_attr__( 'Price Font Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can customize the price font color.', 'bacola-core' ),
				'section' => 'bacola_main_color_section',
			)
		);

		/*====== Color Danger ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#ed174a',
				'settings' => 'bacola_color_danger',
				'label' => esc_attr__( 'Color Danger', 'bacola-core' ),
				'description' => esc_attr__( 'You can customize the color danger.', 'bacola-core' ),
				'section' => 'bacola_main_color_section',
			)
		);
		
		/*====== Color Danger Dark======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#be143c',
				'settings' => 'bacola_color_danger_dark',
				'label' => esc_attr__( 'Color Danger Dark', 'bacola-core' ),
				'description' => esc_attr__( 'You can customize the color danger dark.', 'bacola-core' ),
				'section' => 'bacola_main_color_section',
			)
		);
		
		/*====== Color Success======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#00b853',
				'settings' => 'bacola_color_success',
				'label' => esc_attr__( 'Color Success', 'bacola-core' ),
				'description' => esc_attr__( 'You can customize the color success.', 'bacola-core' ),
				'section' => 'bacola_main_color_section',
			)
		);
		
		/*====== Color Rating======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#ffcd00',
				'settings' => 'bacola_color_rating',
				'label' => esc_attr__( 'Color Rating', 'bacola-core' ),
				'description' => esc_attr__( 'You can customize the color rating.', 'bacola-core' ),
				'section' => 'bacola_main_color_section',
			)
		);

	/*====== Elementor Templates =======================================================*/
		/*====== Before Shop Elementor Templates ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'select',
				'settings'    => 'bacola_before_main_shop_elementor_template',
				'label'       => esc_html__( 'Before Shop Elementor Template', 'bacola-core' ),
				'section'     => 'bacola_elementor_templates_section',
				'default'     => '',
				'placeholder' => esc_html__( 'Select a template from elementor templates ', 'bacola-core' ),
				'choices'     => bacola_get_elementorTemplates('section'),
				
			)
		);
		
		/*====== After Shop Elementor Templates ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'select',
				'settings'    => 'bacola_after_main_shop_elementor_template',
				'label'       => esc_html__( 'After Shop Elementor Template', 'bacola-core' ),
				'section'     => 'bacola_elementor_templates_section',
				'default'     => '',
				'placeholder' => esc_html__( 'Select a template from elementor templates ', 'bacola-core' ),
				'choices'     => bacola_get_elementorTemplates('section'),
				
			)
		);
		
		/*====== Before Header Elementor Templates ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'select',
				'settings'    => 'bacola_before_main_header_elementor_template',
				'label'       => esc_html__( 'Before Header Elementor Template', 'bacola-core' ),
				'section'     => 'bacola_elementor_templates_section',
				'default'     => '',
				'placeholder' => esc_html__( 'Select a template from elementor templates, If you want to show any content before products ', 'bacola-core' ),
				'choices'     => bacola_get_elementorTemplates('section'),
				
			)
		);
	
		/*====== After Header Elementor Templates ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'select',
				'settings'    => 'bacola_after_main_header_elementor_template',
				'label'       => esc_html__( 'After Header Elementor Template', 'bacola-core' ),
				'section'     => 'bacola_elementor_templates_section',
				'default'     => '',
				'placeholder' => esc_html__( 'Select a template from elementor templates ', 'bacola-core' ),
				'choices'     => bacola_get_elementorTemplates('section'),
				
			)
		);
		
		/*====== Before Footer Elementor Template ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'select',
				'settings'    => 'bacola_before_main_footer_elementor_template',
				'label'       => esc_html__( 'Before Footer Elementor Template', 'bacola-core' ),
				'section'     => 'bacola_elementor_templates_section',
				'default'     => '',
				'placeholder' => esc_html__( 'Select a template from elementor templates, If you want to show any content before products ', 'bacola-core' ),
				'choices'     => bacola_get_elementorTemplates('section'),
				
			)
		);
		
		/*====== After Footer Elementor  Template ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'select',
				'settings'    => 'bacola_after_main_footer_elementor_template',
				'label'       => esc_html__( 'After Footer Elementor Templates', 'bacola-core' ),
				'section'     => 'bacola_elementor_templates_section',
				'default'     => '',
				'placeholder' => esc_html__( 'Select a template from elementor templates, If you want to show any content before products ', 'bacola-core' ),
				'choices'     => bacola_get_elementorTemplates('section'),
				
			)
		);

		/*====== Templates Repeater For each category ======*/
		add_action( 'init', function() {
			bacola_customizer_add_field (
				array(
					'type' => 'repeater',
					'settings' => 'bacola_elementor_template_each_shop_category',
					'label' => esc_attr__( 'Template For Categories', 'bacola-core' ),
					'description' => esc_attr__( 'You can set template for each category.', 'bacola-core' ),
					'section' => 'bacola_elementor_templates_section',
					'fields' => array(
						
						'category_id' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'Select Category', 'bacola-core' ),
							'description' => esc_html__( 'Set a category', 'bacola-core' ),
							'priority'    => 10,
							'default'     => '',
							'choices'     => Kirki_Helper::get_terms( array('taxonomy' => 'product_cat') )
						),
						
						'bacola_before_main_shop_elementor_template_category' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'Before Shop Elementor Template', 'bacola-core' ),
							'choices'     => bacola_get_elementorTemplates('section'),
							'default'     => '',
							'placeholder' => esc_html__( 'Select a template from elementor templates, If you want to show any content before products ', 'bacola-core' ),
						),
						
						'bacola_after_main_shop_elementor_template_category' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'After Shop Elementor Template', 'bacola-core' ),
							'choices'     => bacola_get_elementorTemplates('section'),
						),
						
						'bacola_before_main_header_elementor_template_category' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'Before Header Elementor Template', 'bacola-core' ),
							'choices'     => bacola_get_elementorTemplates('section'),
						),
						
						'bacola_after_main_header_elementor_template_category' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'After Header Elementor Template', 'bacola-core' ),
							'choices'     => bacola_get_elementorTemplates('section'),
						),
						
						'bacola_before_main_footer_elementor_template_category' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'Before Footer Elementor Template', 'bacola-core' ),
							'choices'     => bacola_get_elementorTemplates('section'),
						),
						
						'bacola_after_main_footer_elementor_template_category' => array(
							'type'        => 'select',
							'label'       => esc_html__( 'After Footer Elementor Template', 'bacola-core' ),
							'choices'     => bacola_get_elementorTemplates('section'),
						),
						

					),
				)
			);
		} );


		/*====== Map Settings ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_mapapi',
				'label' => esc_attr__( 'Google Map Api key', 'bacola-core' ),
				'description' => esc_attr__( 'Add your google map api key', 'bacola-core' ),
				'section' => 'bacola_map_settings_section',
				'default' => '',
			)
		);
		
	/*====== Bacola Widgets ======*/
		/*====== Widgets Panels ======*/
		Kirki::add_panel (
			'bacola_widgets_panel',
			array(
				'title' => esc_html__( 'Bacola Widgets', 'bacola-core' ),
				'description' => esc_html__( 'You can customize the bacola widgets.', 'bacola-core' ),
			)
		);

		$sections = array (
			
			'social_list' => array(
				esc_attr__( 'Social List', 'bacola-core' ),
				esc_attr__( 'You can customize the social list widget.', 'bacola-core' )
			),
		);

		foreach ( $sections as $section_id => $section ) {
			$section_args = array(
				'title' => $section[0],
				'description' => $section[1],
				'panel' => 'bacola_widgets_panel',
			);

			if ( isset( $section[2] ) ) {
				$section_args['type'] = $section[2];
			}

			Kirki::add_section( 'bacola_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
		}

		/*====== Social List Widget ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'repeater',
				'settings' => 'bacola_social_list_widget',
				'label' => esc_attr__( 'Social List Widget', 'bacola-core' ),
				'description' => esc_attr__( 'You can set social icons.', 'bacola-core' ),
				'section' => 'bacola_social_list_section',
				'fields' => array(
					'social_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Icon', 'bacola-core' ),
						'description' => esc_attr__( 'You can set an icon. for example; "facebook"', 'bacola-core' ),
					),

					'social_url' => array(
						'type' => 'text',
						'label' => esc_attr__( 'URL', 'bacola-core' ),
						'description' => esc_attr__( 'You can set url for the item.', 'bacola-core' ),
					),

				),
			)
		);
		
	/*====== Footer ======*/
		/*====== Footer Panels ======*/
		Kirki::add_panel (
			'bacola_footer_panel',
			array(
				'title' => esc_html__( 'Footer Settings', 'bacola-core' ),
				'description' => esc_html__( 'You can customize the footer from this panel.', 'bacola-core' ),
			)
		);

		$sections = array (
			'footer_subscribe' => array(
				esc_attr__( 'Subscribe', 'bacola-core' ),
				esc_attr__( 'You can customize the subscribe area.', 'bacola-core' )
			),
			
			'footer_featured_box' => array(
				esc_attr__( 'Featured Box', 'bacola-core' ),
				esc_attr__( 'You can customize the featured box section.', 'bacola-core' )
			),
			
			'footer_contact' => array(
				esc_attr__( 'Contact Details', 'bacola-core' ),
				esc_attr__( 'You can customize the contact details section.', 'bacola-core' )
			),
			
			'footer_general' => array(
				esc_attr__( 'Footer General', 'bacola-core' ),
				esc_attr__( 'You can customize the footer settings.', 'bacola-core' )
			),
			
			'footer_style' => array(
				esc_attr__( 'Footer Style', 'bacola-core' ),
				esc_attr__( 'You can customize the footer settings.', 'bacola-core' )
			),
			
		);

		foreach ( $sections as $section_id => $section ) {
			$section_args = array(
				'title' => $section[0],
				'description' => $section[1],
				'panel' => 'bacola_footer_panel',
			);

			if ( isset( $section[2] ) ) {
				$section_args['type'] = $section[2];
			}

			Kirki::add_section( 'bacola_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
		}

		
		/*====== Subcribe Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_footer_subscribe_area',
				'label' => esc_attr__( 'Subcribe', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable subscribe section.', 'bacola-core' ),
				'section' => 'bacola_footer_subscribe_section',
				'default' => '0',
			)
		);
		
		/*====== Subcribe FORM ID======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_footer_subscribe_formid',
				'label' => esc_attr__( 'Subscribe Form Id.', 'bacola-core' ),
				'description' => esc_attr__( 'You can find the form id in Dashboard > Mailchimp For Wp > Form.', 'bacola-core' ),
				'section' => 'bacola_footer_subscribe_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_footer_subscribe_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subscribe Title ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bacola_footer_subscribe_title',
				'label' => esc_attr__( 'Title', 'bacola-core' ),
				'description' => esc_attr__( 'You can set text for subscribe section.', 'bacola-core' ),
				'section' => 'bacola_footer_subscribe_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_footer_subscribe_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subscribe Subtitle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_footer_subscribe_subtitle',
				'label' => esc_attr__( 'Subtitle', 'bacola-core' ),
				'description' => esc_attr__( 'You can set text for subscribe section.', 'bacola-core' ),
				'section' => 'bacola_footer_subscribe_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_footer_subscribe_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subscribe Desc ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bacola_footer_subscribe_desc',
				'label' => esc_attr__( 'Description', 'bacola-core' ),
				'description' => esc_attr__( 'You can set text for subscribe section.', 'bacola-core' ),
				'section' => 'bacola_footer_subscribe_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_footer_subscribe_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subscribe Image ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bacola_footer_subscribe_image',
				'label' => esc_attr__( 'Image', 'bacola-core' ),
				'description' => esc_attr__( 'You can upload an image.', 'bacola-core' ),
				'section' => 'bacola_footer_subscribe_section',
				'choices' => array(
					'save_as' => 'id',
				),
				'required' => array(
					array(
					  'setting'  => 'bacola_footer_subscribe_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subscribe Typography ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bacola_subscribe_size',
				'label'       => esc_attr__( 'Subscribe Typography', 'bacola-core' ),
				'section'     => 'bacola_footer_subscribe_section',
				'default'     => [
					'font-family'    => '',
					'variant'        => '',
					'font-size'      => '',
					'line-height'    => '',
					'letter-spacing' => '',
					'text-transform' => '',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => '.site-footer .footer-subscribe .subscribe-content , .site-footer .footer-subscribe .entry-subtitle , .site-footer .footer-subscribe .entry-title , .site-footer .footer-subscribe .entry-teaser p',
					],
				],
			)
		);
		
		/*====== Subscribe Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#233a95',
				'settings' => 'bacola_subscribe_bg',
				'label' => esc_attr__( 'Subscribe Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  background.', 'bacola-core' ),
				'section' => 'bacola_footer_subscribe_section',
			)
		);
		
		/*====== Subscribe  Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_subscribe_color',
				'label' => esc_attr__( 'Subscribe  Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_subscribe_section',
			)
		);
		
		/*====== Subscribe Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_subscribe_hvrcolor',
				'label' => esc_attr__( 'Subscribe Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_subscribe_section',
			)
		);
		
		/*====== Featured Box ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'repeater',
				'settings' => 'bacola_footer_featured_box',
				'label' => esc_attr__( 'Featured Box', 'bacola-core' ),
				'description' => esc_attr__( 'You can create featured box.', 'bacola-core' ),
				'section' => 'bacola_footer_featured_box_section',
				'fields' => array(
					'featured_text' => array(
						'type' => 'textarea',
						'label' => esc_attr__( 'Featured Content', 'bacola-core' ),
						'description' => esc_attr__( 'You can enter a text.', 'bacola-core' ),
					),
					
					'featured_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Featured Icon', 'bacola-core' ),
						'description' => esc_attr__( 'set an icon.', 'bacola-core' ),
					),
				),
			)
		);
		
		/*====== Contact Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_footer_contact_area',
				'label' => esc_attr__( 'Contact Section', 'bacola-core' ),
				'description' => esc_attr__( 'Disable or Enable the contact section.', 'bacola-core' ),
				'section' => 'bacola_footer_contact_section',
				'default' => '0',
			)
		);
		
		/*====== Contact Phone Icon======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_footer_phone_icon',
				'label' => esc_attr__( 'Phone Icon', 'bacola-core' ),
				'description' => esc_attr__( 'You can set an icon.', 'bacola-core' ),
				'section' => 'bacola_footer_contact_section',
				'default' => 'klbth-icon-phone-call',
				'required' => array(
					array(
					  'setting'  => 'bacola_footer_contact_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Contact Phone Title======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_footer_phone_title',
				'label' => esc_attr__( 'Phone Title', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a title.', 'bacola-core' ),
				'section' => 'bacola_footer_contact_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_footer_contact_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Contact Phone Subtitle======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_footer_phone_subtitle',
				'label' => esc_attr__( 'Phone Subtitle', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a subtitle.', 'bacola-core' ),
				'section' => 'bacola_footer_contact_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_footer_contact_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Contact APP Title======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_footer_app_title',
				'label' => esc_attr__( 'APP Title', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a title.', 'bacola-core' ),
				'section' => 'bacola_footer_contact_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_footer_contact_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Contact APP Subtitle======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_footer_app_subtitle',
				'label' => esc_attr__( 'APP Subtitle', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a subtitle.', 'bacola-core' ),
				'section' => 'bacola_footer_contact_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_footer_contact_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Contact APP Image ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'repeater',
				'settings' => 'bacola_footer_app_image',
				'label' => esc_attr__( 'APP IMAGE', 'bacola-core' ),
				'description' => esc_attr__( 'You can set the app images.', 'bacola-core' ),
				'section' => 'bacola_footer_contact_section',
				'fields' => array(
					'app_image' => array(
						'type' => 'image',
						'label' => esc_attr__( 'Image', 'bacola-core' ),
						'description' => esc_attr__( 'You can upload an image.', 'bacola-core' ),
					),
					
					'app_url' => array(
						'type' => 'text',
						'label' => esc_attr__( 'URL', 'bacola-core' ),
						'description' => esc_attr__( 'set an url for the image.', 'bacola-core' ),
					),
				),
				'required' => array(
					array(
					  'setting'  => 'bacola_footer_contact_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Contact Social List ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'repeater',
				'settings' => 'bacola_footer_social_list',
				'label' => esc_attr__( 'Social List', 'bacola-core' ),
				'description' => esc_attr__( 'You can set social icons.', 'bacola-core' ),
				'section' => 'bacola_footer_contact_section',
				'fields' => array(
					'social_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Icon', 'bacola-core' ),
						'description' => esc_attr__( 'You can set an icon. for example; "facebook"', 'bacola-core' ),
					),

					'social_url' => array(
						'type' => 'text',
						'label' => esc_attr__( 'URL', 'bacola-core' ),
						'description' => esc_attr__( 'You can set url for the item.', 'bacola-core' ),
					),

				),
			)
		);
		
		/*====== Copyright ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_copyright',
				'label' => esc_attr__( 'Copyright', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a copyright text for the footer.', 'bacola-core' ),
				'section' => 'bacola_footer_general_section',
				'default' => '',
			)
		);
		
		/*====== Subscribe Image ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bacola_footer_payment_image',
				'label' => esc_attr__( 'Image', 'bacola-core' ),
				'description' => esc_attr__( 'You can upload an image.', 'bacola-core' ),
				'section' => 'bacola_footer_general_section',
				'choices' => array(
					'save_as' => 'id',
				),
			)
		);

		/*====== Payment Image URL ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_footer_payment_image_url',
				'label' => esc_attr__( 'Set Payment URL', 'bacola-core' ),
				'description' => esc_attr__( 'Set an url for the payment image', 'bacola-core' ),
				'section' => 'bacola_footer_general_section',
				'default' => '#',
			)
		);

		/*====== Footer Column ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'bacola_footer_column',
				'label' => esc_attr__( 'Footer Column', 'bacola-core' ),
				'description' => esc_attr__( 'You can set footer column.', 'bacola-core' ),
				'section' => 'bacola_footer_general_section',
				'default' => '5columns',
				'choices' => array(
					'6columns' => esc_attr__( '6 Columns', 'bacola-core' ),
					'5columns' => esc_attr__( '5 Columns', 'bacola-core' ),
					'4columns' => esc_attr__( '4 Columns', 'bacola-core' ),
					'3columns' => esc_attr__( '3 Columns', 'bacola-core' ),
				),
			)
		);
		
		/*======Footer Menu Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_footer_menu',
				'label' => esc_attr__( 'Footer Menu', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of the footer menu on the footer.', 'bacola-core' ),
				'section' => 'bacola_footer_general_section',
				'default' => '0',
			)
		);
		
		/*====== Back to top  ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_scroll_to_top',
				'label' => esc_attr__( 'Back To Top Button', 'bacola' ),
				'section' => 'bacola_footer_general_section',
				'default' => '0',
			)
		);
		
		
		/*====== Footer Featured Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#f7f8fd',
				'settings' => 'bacola_featured_bg_color',
				'label' => esc_attr__( 'Footer Featured Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  background.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);

		/*====== Footer Featured Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#000000',
				'settings' => 'bacola_featured_color',
				'label' => esc_attr__( 'Footer Featured Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Featured Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#000000',
				'settings' => 'bacola_featured_hvrcolor',
				'label' => esc_attr__( 'Footer Featured Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#f7f8fd',
				'settings' => 'bacola_footer_bg_color',
				'label' => esc_attr__( 'Footer Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  background.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);

		/*====== Footer Header Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#202435',
				'settings' => 'bacola_footer_header_color',
				'label' => esc_attr__( 'Footer Header Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Header Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#202435',
				'settings' => 'bacola_footer_header_hvrcolor',
				'label' => esc_attr__( 'Footer Header Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#71778e',
				'settings' => 'bacola_footer_color',
				'label' => esc_attr__( 'Footer Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#71778e',
				'settings' => 'bacola_footer_hvrcolor',
				'label' => esc_attr__( 'Footer Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Phone Icon Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_footer_phone_icon_bg',
				'label' => esc_attr__( 'Footer Phone Icon Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Phone Icon Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#202435',
				'settings' => 'bacola_footer_phone_icon_color',
				'label' => esc_attr__( 'Footer Phone Icon Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Contact Background ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_footer_contact_background',
				'label' => esc_attr__( 'Footer Contact Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Contact Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#202435',
				'settings' => 'bacola_footer_contact_phone_color',
				'label' => esc_attr__( 'Footer Contact Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Contact Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#202435',
				'settings' => 'bacola_footer_contact_phone_hvrcolor',
				'label' => esc_attr__( 'Footer Contact Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Contact Second Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#202435',
				'settings' => 'bacola_footer_contact_color',
				'label' => esc_attr__( 'Footer Contact Second Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Contact Second Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#202435',
				'settings' => 'bacola_footer_contact_hvrcolor',
				'label' => esc_attr__( 'Footer Contact Second Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Social Icon Background Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_footer_social_icon_bg',
				'label' => esc_attr__( 'Footer Social Icon Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Social Icon Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#233a95',
				'settings' => 'bacola_footer_social_icon_color',
				'label' => esc_attr__( 'Footer Social Icon Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		
		/*====== Footer General Background ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'bacola_footer_general_background',
				'label' => esc_attr__( 'Footer General Background Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for background.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer General Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#9b9bb4',
				'settings' => 'bacola_footer_general_color',
				'label' => esc_attr__( 'Footer General Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a font color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer General Hover Color ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#9b9bb4',
				'settings' => 'bacola_footer_general_hvrcolor',
				'label' => esc_attr__( 'Footer General Hover Color', 'bacola-core' ),
				'description' => esc_attr__( 'You can set a color for  color.', 'bacola-core' ),
				'section' => 'bacola_footer_style_section',
			)
		);
		
		/*====== Footer Typography ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bacola_footer_size',
				'label'       => esc_attr__( 'Footer Typography', 'bacola-core' ),
				'section'     => 'bacola_footer_style_section',
				'default'     => [
					'font-family'    => '',
					'variant'        => '',
					'font-size'      => '',
					'line-height'    => '',
					'letter-spacing' => '',
					'text-transform' => '',
					
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => '.site-footer .footer-widgets .widget , .klbfooterwidget h4.widget-title',
					],
				],
			)
		);
		
		/*====== Footer Featured Typography ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bacola_footer_featured_size',
				'label'       => esc_attr__( 'Footer Featured Typography', 'bacola-core' ),
				'section'     => 'bacola_footer_style_section',
				'default'     => [
					'font-family'    => '',
					'variant'        => '',
					'font-size'      => '',
					'line-height'    => '',
					'letter-spacing' => '',
					'text-transform' => '',
					
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => '.site-footer .footer-iconboxes .iconbox .iconbox-icon , .site-footer .footer-iconboxes .iconbox .iconbox-detail span ',
					],
				],
			)
		);
		
		/*====== Footer Contact Typography ======*/
		bacola_customizer_add_field (
			array(
				'type'        => 'typography',
				'settings' => 'bacola_footer_contact_size',
				'label'       => esc_attr__( 'Footer Contact Typography', 'bacola-core' ),
				'section'     => 'bacola_footer_style_section',
				'default'     => [
					'font-family'    => '',
					'variant'        => '',
					'font-size'      => '',
					'line-height'    => '',
					'letter-spacing' => '',
					'text-transform' => '',
					
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => '.site-footer .footer-contacts .site-phone .entry-title, .site-footer .footer-contacts .site-phone span , .site-footer .footer-contacts .site-mobile-app .app-content .entry-title , .site-footer .footer-contacts .site-mobile-app .app-content span',
					],
				],
			)
		);

		/*====== GDPR Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_gdpr_toggle',
				'label' => esc_attr__( 'Enable GDPR', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of GDPR.', 'bacola-core' ),
				'section' => 'bacola_gdpr_settings_section',
				'default' => '0',
			)
		);

		/*====== GDPR Image======*/
		bacola_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'bacola_gdpr_image',
				'label' => esc_attr__( 'Image', 'bacola-core' ),
				'description' => esc_attr__( 'You can upload an image.', 'bacola-core' ),
				'section' => 'bacola_gdpr_settings_section',
				'choices' => array(
					'save_as' => 'id',
				),
				'required' => array(
					array(
					  'setting'  => 'bacola_gdpr_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== GDPR Text ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bacola_gdpr_text',
				'label' => esc_attr__( 'GDPR Text', 'bacola-core' ),
				'section' => 'bacola_gdpr_settings_section',
				'default' => 'In order to provide you a personalized shopping experience, our site uses cookies. <br><a href="#">cookie policy</a>.',
				'required' => array(
					array(
					  'setting'  => 'bacola_gdpr_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== GDPR Expire Date ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_gdpr_expire_date',
				'label' => esc_attr__( 'GDPR Expire Date', 'bacola-core' ),
				'section' => 'bacola_gdpr_settings_section',
				'default' => '15',
				'required' => array(
					array(
					  'setting'  => 'bacola_gdpr_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== GDPR Button Text ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_gdpr_button_text',
				'label' => esc_attr__( 'GDPR Button Text', 'bacola-core' ),
				'section' => 'bacola_gdpr_settings_section',
				'default' => 'Accept Cookies',
				'required' => array(
					array(
					  'setting'  => 'bacola_gdpr_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);

		/*====== Newsletter Toggle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'bacola_newsletter_popup_toggle',
				'label' => esc_attr__( 'Enable Newsletter', 'bacola-core' ),
				'description' => esc_attr__( 'You can choose status of Newsletter Popup.', 'bacola-core' ),
				'section' => 'bacola_newsletter_settings_section',
				'default' => '0',
			)
		);
		
		
		/*====== Newsletter Title ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_newsletter_popup_title',
				'label' => esc_attr__( 'Newsletter Title', 'bacola-core' ),
				'section' => 'bacola_newsletter_settings_section',
				'default' => 'Subscribe To Newsletter',
				'required' => array(
					array(
					  'setting'  => 'bacola_newsletter_popup_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Newsletter Subtitle ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'bacola_newsletter_popup_subtitle',
				'label' => esc_attr__( 'Newsletter Subtitle', 'bacola-core' ),
				'section' => 'bacola_newsletter_settings_section',
				'default' => 'Subscribe to the Bacola mailing list to receive updates on new arrivals, special offers and our promotions.',
				'required' => array(
					array(
					  'setting'  => 'bacola_newsletter_popup_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subcribe Popup FORM ID======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_newsletter_popup_formid',
				'label' => esc_attr__( 'Newsletter Form Id.', 'bacola-core' ),
				'description' => esc_attr__( 'You can find the form id in Dashboard > Mailchimp For Wp > Form.', 'bacola-core' ),
				'section' => 'bacola_newsletter_settings_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'bacola_newsletter_popup_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subcribe Popup Expire Date ======*/
		bacola_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'bacola_newsletter_popup_expire_date',
				'label' => esc_attr__( 'Newsletter Expire Date', 'bacola-core' ),
				'section' => 'bacola_newsletter_settings_section',
				'default' => '15',
				'required' => array(
					array(
					  'setting'  => 'bacola_newsletter_popup_toggle',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);