<?php
namespace ElementorBanner\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class CustomPost extends Widget_Base {

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
        return 'Custom Post';
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
        return __( 'Custom Post', 'elementor-banner' );
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
                'label' => __( 'Custom Post', 'elementor-banner' ),
            ]
        );

        

        $this->add_control(
            'postCaption',
            [
                'label' => __( 'Post Section Title', 'elementor-banner' ),
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
        );
        $this->add_control(
            'noPost',
            [
                'label' => __( 'No of post', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'No of Post', 'elementor-banner' ),
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
      
        $this->add_inline_editing_attributes( 'postCaption', 'advanced' );
        $this->add_inline_editing_attributes( 'backgroundImage', 'advanced' );
        $this->add_inline_editing_attributes( 'noPost', 'advanced' );
        ?>
<div class="section w2" style="background-image:url(<?php echo $settings['backgroundImage']  ?>">
    <div class="container-fluid">
        <div class="text-center mb-5">
            <!--<h2>laatste nieuws.</h2>
            <h6>MACK GYM NIJMEGEN</h6>-->
            <?php echo $settings['postCaption']  ?>
            <hr>
        </div>
        <div class="owl-carousel owl-theme CarouselOwl">
            <div class="item">
                <?php
                    $index = 1;
                    $defaults = array(
                        'numberposts'      => $settings['noPost'],                               
                        'post_type'        => 'post',
                    );
                    $latest_posts = get_posts( $defaults ); 
                    foreach ( $latest_posts as $p ) {   
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'single-post-thumbnail' );
            ?>
                <a href="#" class="d-block">
                    <div class="content">
                        <div class="table-div">
                            <div class="table-cell">
                                <small><?php echo get_the_date('F j, Y',$p->ID) ?></small>
                                <h5><?php echo get_the_title($p->ID) ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="embed-responsive embed-responsive-16by9">
                        <div class="full-img"><img src="<?php echo $image[0] ?>">
                        </div>
                    </div>
                </a>
                <?php if($index % 2 == 0 ) : ?>
            </div>
            <div class="item">
                <?php endif; ?>
                <?php $index++; } ?>
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