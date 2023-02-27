<?php

/*************************************************
## bacola Metabox
*************************************************/

if ( ! function_exists( 'rwmb_meta' ) ) {
  function rwmb_meta( $key, $args = '', $post_id = null ) {
   return false;
  }
 }

add_filter( 'rwmb_meta_boxes', 'bacola_register_page_meta_boxes' );

function bacola_register_page_meta_boxes( $meta_boxes ) {
	
$prefix = 'klb_';
$meta_boxes = array();


/* ----------------------------------------------------- */
// Product Data
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id' => 'klb_product_settings',
	'title' => esc_html__('Product Data','bacola'),
	'pages' => array( 'product' ),
	'context' => 'side',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'		=> esc_html__('Type','bacola'),
			'id'		=> $prefix . 'product_type',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		
		array(
			'name'		=> esc_html__('MFG','bacola'),
			'id'		=> $prefix . 'product_mfg',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		
		array(
			'name'		=> esc_html__('LIFE','bacola'),
			'id'		=> $prefix . 'product_life',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		
		array(
			'name'		=> esc_html__('Badge Type','bacola'),
			'id'		=> $prefix . 'product_badge_type',
			'type'		=> 'select',
			'options'	=> array(
				'type1'		=> esc_html__('Type 1','bacola'),
				'type2'		=> esc_html__('Type 2','bacola'),
				'type3'		=> esc_html__('Type 3','bacola'),
				'type4'		=> esc_html__('Type 4','bacola'),
				'type5'		=> esc_html__('Type 5','bacola'),
			),
			'multiple'	=> false,
			'std'		=> array( 'no' ),
			'sanitize_callback' => 'none'
		),
		
		array(
			'name'		=> esc_html__('Badge if on sale','bacola'),
			'id'		=> $prefix . 'product_badge',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
				
	)
);

/* ----------------------------------------------------- */
// Blog Post Slides Metabox
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id'		=> 'klb-blogmeta-gallery',
	'title'		=> esc_html__('Blog Post Image Slides','bacola'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> esc_html__('Blog Post Slider Images','bacola'),
			'desc'	=> esc_html__('Upload unlimited images for a slideshow - or only one to display a single image.','bacola'),
			'id'	=> $prefix . 'blogitemslides',
			'type'	=> 'image_advanced',
		)
		
	)
);

/* ----------------------------------------------------- */
// Blog Audio Post Settings
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'klb-blogmeta-audio',
	'title' => esc_html('Audio Settings','bacola'),
	'pages' => array( 'post'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(	
		array(
			'name'		=> esc_html('Audio Code','bacola'),
			'id'		=> $prefix . 'blogaudiourl',
			'desc'		=> esc_html__('Enter your Audio URL(Oembed) or Embed Code.','bacola'),
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
			'sanitize_callback' => 'none'
		),
	)
);



/* ----------------------------------------------------- */
// Blog Video Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'klb-blogmeta-video',
	'title'		=> esc_html__('Blog Video Settings','bacola'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'		=> esc_html__('Video Type','bacola'),
			'id'		=> $prefix . 'blog_video_type',
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> esc_html__('Youtube','bacola'),
				'vimeo'			=> esc_html__('Vimeo','bacola'),
				'own'			=> esc_html__('Own Embed Code','bacola'),
			),
			'multiple'	=> false,
			'std'		=> array( 'no' ),
			'sanitize_callback' => 'none'
		),
		array(
			'name'	=> bacola_sanitize_data(__('Embed Code<br />(Audio Embed Code is possible, too)','bacola')),
			'id'	=> $prefix . 'blog_video_embed',
			'desc'	=> bacola_sanitize_data(__('Just paste the ID of the video (E.g. http://www.youtube.com/watch?v=<strong>GUEZCxBcM78</strong>) you want to show, or insert own Embed Code. <br />This will show the Video <strong>INSTEAD</strong> of the Image Slider.<br /><strong>Of course you can also insert your Audio Embedd Code!</strong>','bacola')),
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "8"
		)
	)
);

return $meta_boxes;
}
