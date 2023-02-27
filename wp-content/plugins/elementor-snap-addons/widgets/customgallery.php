<?php
namespace ElementorBanner\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class customGallery extends Widget_Base {

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
        return 'Custom Galeery';
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
        return __( 'Custom Gallery', 'elementor-banner' );
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
                'label' => __( 'Custom Gallery', 'elementor-banner' ),
                
            ]
        );

        
        $this->add_control(
            'w3caption',
            [
                'label' => __( 'Section Title', 'elementor-banner' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Text', 'elementor-banner' ),
            ]
        );
        

        $this->add_control(
			'gallery',
			[
				'label' => __( 'Add Images', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
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
<div class="section w2"
    style="background:url(<?php echo get_template_directory_uri() ?>/images/gal/Mack_Gym_Boxing_Nijmegen_dames_04.jpg);">
    <div class="container">
        <div class="text-center mb-3">
            <!-- <h2>GALLERY.</h2>
            <h6>MACK GYM NIJMEGEN</h6>-->
            <?php echo $settings['w3caption'] ?>
            <hr>
        </div>
        <div class="row">
            <?php
        foreach ( $settings['gallery'] as $image ) {
            ?>

            <div class="col-6 col-sm-6 col-lg-3 mt-4"><a href="<?php echo $image['url'] ?>" data-fancybox="gallery"><img
                        src="<?php echo $image['url'] ?>" alt="" class="img-crop" data-crop-image-ratio="0.6"></a></div>
            <?php
		    }
            ?>
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