<?php
namespace ElementorBanner\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class timeTable extends Widget_Base {

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
        return 'Carousel Brasbeer';
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
        return __( 'Carousel Brasbeer', 'elementor-banner' );
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
            'section_content',  
            [
                'label' => __( 'Carousel Brasbeer', 'elementor-banner' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

      /*  $this->add_control(
            'w3caption',
            [
                'label' => __( 'Section Title', 'elementor-banner' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Text', 'elementor-banner' ),
            ]
        );

        $this->add_control(
            'btnOneText',
            [
                'label' => __( 'Button One Text', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Button One Text', 'elementor-banner' ),
            ]
        );
        $this->add_control(
            'btnOneLink',
            [
                'label' => __( 'Button One Link', 'elementor-banner' ),
                'type' => Controls_Manager::URL,
                'default' => __( 'Button One Link', 'elementor-banner' ),
            ]
        );

        $this->add_control(
            'w3text',
            [
                'label' => __( 'Section text', 'elementor-banner' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Text', 'elementor-banner' ),
            ]
        );
        
        $this->add_control(
            'backgroundImage',
            [
                'label' => __( 'Choose Background Image', 'elementor-banner' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );*/
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
            'h2_text',
            [
                'label' => __( 'h2 text', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Text', 'elementor-banner' ),
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
												'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
					],
					[
						
						'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
					],
				],
				
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
    
        ?>

<div class="w3-wrapper">
    <div class="custom-container">
        <div class="w3">
            <div class="w3-main">
                <div class="owl-carousel owl-theme CarouselOwllg">
                    <?php if ( $settings['list'] ) { 
                        foreach (  $settings['list'] as $item ) {
                      ?>
                    <div class="item">
                        <div class="w3-content">
                            <div class="w3-image">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="full-img"><img src="<?php echo $item['carousel_image']['url'] ?>"
                                            alt="<?php echo $item['carousel_image']['alt'] ?>"></div>
                                </div>
                            </div>
                            <div class="content">
                                <h4><?php echo $item['h1_text'] ?></h4>
                                <h2><?php echo $item['h2_text'] ?></h2>

                                <?php echo $item['carousel_content'] ?>
                            </div>
                        </div>
                    </div>
                    <?php  } 
            }        ?>
                </div>
            </div>
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
<div class="w3-wrapper">
    <div class="custom-container">
        <div class="w3">
            <div class="w3-main">
                <div class="owl-carousel owl-theme CarouselOwllg">
                    <# if ( settings.list.length ) { #>
                        <# _.each( settings.list, function( item ) { #>
                            <div class="item">
                                <div class="w3-content">
                                    <div class="w3-image">
                                        <div class="embed-responsive embed-responsive-4by3">
                                            <div class="full-img"><img src="{{{ item.carousel_image.url }}}"
                                                    alt="{{{ item.carousel_image.alt }}}"></div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h4>{{{ item.h1_text }}}</h4>
                                        <h2>{{{ item.h2_text }}}</h2>

                                        {{{ item.carousel_content}}}
                                    </div>
                                </div>
                            </div>
                            <# }); #>
                                <# } #>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    }
}