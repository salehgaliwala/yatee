<?php
namespace ElementorBanner\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class W3 extends Widget_Base {

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
        return 'W5';
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
        return __( 'W5', 'elementor-banner' );
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
                'label' => __( 'W5 content', 'elementor-banner' ),
            ]
        );

        

        $this->add_control(
            'title_left',
            [
                'label' => __( 'Title section left', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Text', 'elementor-banner' ),
            ]
        );

        $this->add_control(
            'text_left',
            [
                'label' => __( 'TEXT section left', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Text', 'elementor-banner' ),
            ]
        );
        $this->add_control(

            'image_right',

            [

                'label' => __( 'Image Right', 'elementor-banner' ),

                'type' => \Elementor\Controls_Manager::MEDIA,

                'default' => [

                    'url' => \Elementor\Utils::get_placeholder_image_src(),

                ]

            ]

        );

        $this->add_control(
            'title_right',
            [
                'label' => __( 'Title section Right', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Text', 'elementor-banner' ),
            ]
        );

         $this->add_control(
            'text_right',
            [
                'label' => __( 'TEXT section right', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Text', 'elementor-banner' ),
            ]
        );
        $this->add_control(

            'image_left',

            [

                'label' => __( 'Image Left', 'elementor-banner' ),

                'type' => \Elementor\Controls_Manager::MEDIA,

                'default' => [

                    'url' => \Elementor\Utils::get_placeholder_image_src(),

                ]

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

<div class="w4-wrapper">
    <div class="custom-container">
        <div class="w4">
            <div class="image"><img src="<?php echo get_template_directory_uri() ?>/images/la-vida-seal.svg" alt="">
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-6">
                        <div class="item">
                            <a href="#" class="d-block">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="full-img"><img src="<?php echo $settings['image_left']['url'] ?>"
                                            alt="<?php echo $settings['image_left']['alt'] ?>"></div>
                                </div>
                                <div class="content">
                                    <h5><?php echo $settings['title_left'] ?></h5>
                                    <h2><?php echo $settings['text_left'] ?></h2>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="item">
                            <a href="#" class="d-block">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="full-img"><img src="<?php echo $settings['image_right']['url'] ?>"
                                            alt="<?php echo $settings['image_right']['alt'] ?>"></div>
                                </div>
                                <div class="content">
                                    <h5><?php echo $settings['title_right'] ?></h5>
                                    <h2><?php echo $settings['text_right'] ?></h2>
                                </div>
                            </a>
                        </div>
                    </div>
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

    }
}