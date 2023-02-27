<?php
namespace ElementorBanner\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class W5 extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'W5 Carousel';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'W5 Carousel', 'elementor-banner' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fa fa-picture';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'general' ];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.1.0
     *
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'caption_text',
            [
                'label' => __( 'Text on the image', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Text', 'elementor-banner' ),
            ]
        );

       $repeater = new \Elementor\Repeater();

		

		$repeater->add_control(
			'carousel_content', [
				'label' => __( 'Content', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Carousel' , 'plugin-domain' ),
				'show_label' => false,
			]
		);

       $repeater->add_control(
            'carousel_image',
            [
                'label' => __( 'Choose Background Image', 'elementor-banner' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'h1_text',
            [
                'label' => __( 'h1 text', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Text', 'elementor-banner' ),
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => __( 'Button text', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Text', 'elementor-banner' ),
            ]
        );

         $repeater->add_control(
			'button_link',
			[
				'label' => __( 'Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
       
        $this->add_control(
			'list',
			[
				'label' => __( 'Carousel Items ', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'carousel_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
                        'h1_text' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
                        'button_text' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' )
					],
					[
						'carousel_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
                        'h1_text' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
                        'button_text' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' )
					],
				],
				'list_h1' => '{{{ list_h1 }}}',
			]
		);
       
        

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.1.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();      
        $target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
        $link = $settings['button_link']['url'];
        ?>

<div class="w5-wrapper">
    <div class="custom-container">
        <div class="owl-carousel owl-theme CarouselOwllg">
            <?php if ( $settings['list'] ) { 
                        foreach (  $settings['list'] as $item ) {
                      ?>

            <div class="item">
                <div class="w5-content clearfix">
                    <div class="w5-image">
                        <div class="embed-responsive embed-responsive-16by9">
                            <div class="full-img"><img src="<?php echo $item['carousel_image']['url'] ?>"
                                    alt="<?php echo $item['image']['alt'] ?>"></div>
                        </div>
                    </div>
                    <div class="content">
                        <h3><?php echo $item['h1_text'] ?></h3>
                        <p><?php echo $item['carousel_content'] ?></p>
                        <a href="<?php echo $link  ?>"
                            class="btn btn-outline-light"><?php echo $item['button_text'] ?></a>
                    </div>
                </div>
            </div>
            <?php  } 
            }        ?>
        </div>
    </div>
</div>




<?php
    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.1.0
     *
     * @access protected
     */
    protected function _content_template() {
?>
<div class="w5-wrapper">
    <div class="custom-container">
        <div class="owl-carousel owl-theme CarouselOwllg">
            <# if ( settings.list.length ) { #>
                <# _.each( settings.list, function( item ) { #>

                    <div class="item">
                        <div class="w5-content clearfix">
                            <div class="w5-image">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <div class="full-img"><img src="{{{ item.carousel_image.url }}}"
                                            alt="{{{ item.carousel_image.alt }}}"></div>
                                </div>
                            </div>
                            <div class="content">
                                <h3>{{{ item.h1_text }}}</h3>
                                <p>{{{ item.carousel_content}}}</p>
                                <a href="{{{ item.button_link }}}"
                                    class="btn btn-outline-light">{{{ item.button_text}}}</a>
                            </div>
                        </div>
                    </div>
                    <# }); #>
                        <# } #>
        </div>
    </div>
</div>
<?php

}
}