<?php
namespace ElementorBanner\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Test extends Widget_Base {

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
        return 'Time Table';
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
        return __( 'Time Table', 'elementor-banner' );
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
                'label' => __( 'Time Table', 'elementor-banner' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

       $this->add_control(
            'w3caption',
            [
                'label' => __( 'Section Title', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
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

        $repeater = new \Elementor\Repeater();

		

		$repeater->add_control(
			'product_name', [
				'label' => __( 'Product Name', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Product Name' , 'plugin-domain' ),
				'show_label' => false,
			]
		);

        $repeater->add_control(
			'product_price', [
				'label' => __( 'Product Price', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Product Price' , 'plugin-domain' ),
				'show_label' => false,
			]
		);

        $repeater->add_control(
			'product_link', [
				'label' => __( 'Product Price', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => __( 'Product Link' , 'plugin-domain' ),
				'show_label' => false,
			]
		);

        $repeater->add_control(
			'product_image', [
				'label' => __( 'Product Price', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => __( 'List Content' , 'plugin-domain' ),
				'show_label' => false,
			]
		);
       
        $this->add_control(
			'list',
			[
				'label' => __( 'Time Table List ', 'plugin-domain' ),
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
        $image_url = $settings['backgroundImage']['url'];
        ?>
<div class="product-list">
    <div class="custom-container">
        <div class="title">
            <div class="container">
                <h2> <?php echo $settings['w3caption'] ?></h2>
                <a href="<?php echo $settings['btnOneLink']['url'] ?>"
                    class="link"><?php echo $settings['btnOneText'] ?><i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="product-wrapper">
            <div class="container">
                <div class="owl-carousel owl-theme CarouselOwl-4">
                    <?php if ( $settings['list'] ) { 
                        foreach (  $settings['list'] as $item ) {
                      ?>
                    <div class="items">
                        <a href="<?php echo $item['product_link']['url'] ?>" class="d-block text-center">
                            <div class="full-img"><img src="<?php echo $item['product_image']['url'] ?>"
                                    alt="<?php echo $item['product_name'] ?>"></div>
                            <h5><?php echo $item['product_name'] ?></h5>
                            <strong class="d-block"><?php echo $item['product_price'] ?></strong>
                        </a>
                    </div>
                    <?php } } ?>
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