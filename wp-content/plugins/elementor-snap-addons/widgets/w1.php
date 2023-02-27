<?php
namespace ElementorBanner\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class W1 extends Widget_Base {

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
        return 'Section 1 Brasabeer';
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
        return __( 'Section 1 Brasabeer', 'elementor-banner' );
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
                'label' => __( 'Section 1 Brasabeer', 'elementor-banner' ),
            ]
        );

        

        $this->add_control(
            'caption_title',
            [
                'label' => __( 'Title', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Text', 'elementor-banner' ),
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

         $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'elementor-banner' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Text', 'elementor-banner' ),
            ]
        );
       

        $this->add_control(
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
      
        $target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
        $link = $settings['button_link']['url'];
        ?>

<div class="w2-wrapper">
    <div class="custom-container">
        <div class="w2">
            <div class="content row justify-content-center">
                <div class="col-lg-6">
                    <h2><?php echo $settings['caption_title'] ?></h2>
                    <p><?php echo $settings['caption_text'] ?></p>
                    <a href="<?php echo  $link ?> <?php echo  $target ?> <?php echo $nofollow ?>"
                        class="btn btn-outline-light"><?php echo $settings['button_text'] ?></a>
                </div>
            </div>

            <div class="d-none d-md-block">
                <ul class="products justify-content-center">
                    <?php   foreach ( $settings['gallery'] as $image ) { ?>
                    <li><a href="<?php echo $image['url'] ?>">
                            <div class="product-item">
                                <div class="product-img"><img src="<?php echo $image['url'] ?>" alt=""></div>
                                <span>
                                    <h3>Crisp & Balanced</h3><small>Learn More<i
                                            class="fas fa-arrow-right ml-2"></i></small>
                                </span>
                            </div>
                        </a></li>
                    <?php
		                    }
                        ?>
                </ul>
            </div>

            <div class="d-block d-md-none productsm">
                <div class="owl-carousel owl-theme CarouselOwlProduct">
                    <?php   foreach ( $settings['gallery'] as $image ) {
                        
                        ?>
                    <div class="item"><a href="#">
                            <div class="product-item">
                                <div class="product-img"><img src="images/corona-extra_180x.webp" alt=""></div>
                                <span>
                                    <h3>Crisp & Balanced</h3><small>Learn More<i
                                            class="fas fa-arrow-right ml-2"></i></small>
                                </span>
                            </div>
                        </a>
                    </div>
                    <?php
		              }
                    ?>


                </div>
            </div>
            <div class="ourCervezas__crown-wrap">
                <div class="ourCervezas__crown">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1072.59 606.27">
                        <defs>
                            <mask id="a" x="0" y="0" width="1072.59" height="606.27" maskUnits="userSpaceOnUse">
                                <g data-name="6fyhrk43vb">
                                    <path data-name="1gesf10tra" d="M.5.6h1072.58v606.26H.5z" fill-rule="evenodd"
                                        fill="#fff" transform="translate(-.5 -.6)"></path>
                                </g>
                            </mask>
                        </defs>
                        <g mask="url(#a)">
                            <path
                                d="M870.5 591.21c-13.16 0-23.5-11.27-23.5-23.45 0-13.14 10.34-24.38 23.5-24.38s23.44 11.24 23.44 24.38c.02 12.18-10.29 23.45-23.44 23.45zm-164.28 0h-.92c-12.19 0-23.43-11.27-23.43-23.45 0-13.14 11.24-24.38 23.43-24.38h.92c12.27 0 23.5 11.24 23.5 24.38 0 12.18-11.24 23.45-23.5 23.45zm-169.82 0c-13.12 0-23.49-11.27-23.49-23.45 0-13.14 10.37-24.38 23.49-24.38s23.48 11.24 23.48 24.38c.02 12.18-10.31 23.45-23.46 23.45zm-168.92 0c-13.16 0-24.41-11.27-24.41-23.45a24.82 24.82 0 0124.43-24.36c12.23 0 23.43 11.24 23.43 24.38 0 12.16-11.2 23.43-23.43 23.43zm-166.13 0c-13.14 0-23.44-11.27-23.44-23.45 0-13.14 10.3-24.38 23.44-24.38s23.46 11.24 23.46 24.38c.02 12.18-10.31 23.45-23.44 23.45zm669.15-65.67H105.66v80.72h861.52v-80.72zM536.42 178.32h-1c-15.89-1-30-17.85-30-39.42 0-20.67 14.09-37.56 30-37.56h1c16.91 0 30 15.94 30 37.56s-13.12 39.42-30 39.42zm482.35 48.79c-11.23-16-26.27-25.35-47.84-27.24-8.42 1-15-1.87-21.58-7.49-12.21-22.52-36.63-30.95-68.54-26.28-15-17.84-36.59-21.61-59.09-19.72-19.71-21.58-42.23-23.43-65.73-18.74-26.25-16.93-50.67-22.54-70.36-12.22-32.84-13.13-62-8.45-85.39 7.53-8.47-17.85-19.72-31-38.47-38.5v-21.6h30V31.92h-30V0h-52.56v31.92h-30.95v30.93h30.95v21.6c-18.77 7.53-31.92 20.66-39.43 38.5-24.41-16-51.61-20.66-84.47-7.53-21.59-10.31-45-4.71-70.38 12.22-23.45-4.69-46-2.84-66.62 18.74-23.48-1.89-43.19 1.88-59.13 19.72-31.9-4.67-55.38 3.76-68.49 26.29a25.78 25.78 0 01-21.58 7.48c-20.67 1.89-36.64 11.28-47 27.25-3.74 16 .94 27.2 15 29 22.52 6.59 45 13.14 64.74 25.35 12.19 3.78 25.35 0 37.55-7.49 51.6-41.3 111.68-76 181.11-96.69 10.34-3.72 16.91 0 13.14 10.34-27.19 21.59-47.85 48.8-59.12 84.46 0 10.34 6.59 15 22.53 14.08 11.27-3.74 20.65-2.83 28.14 1.89 10.32 2.8 18.78-.94 26.26-16.89 6.59-46.93 35.67-78.83 77-101.36 18.76-1.89 27.2 5.64 24.39 23.46-15 16.89-27.23 34.7-31.91 53.48.93 17.83 11.25 24.42 26.28 18.79 9.39 0 16.85-7.53 22.53-23.5a40.32 40.32 0 0135.6-21.57c14.15.94 28.18 7.5 35.71 21.57 5.59 16 12.19 23.5 20.64 23.5 16.91 5.63 26.3-1 27.2-18.79-4.65-18.78-15.9-36.59-31.85-53.48-1.91-17.82 6.52-25.34 25.31-23.46 41.28 22.53 69.46 54.43 77 101.36 5.64 15.95 15 19.7 24.38 16.89 8.46-4.72 17.85-5.63 30-1.89q22.58 1.43 22.57-14.08c-12.25-35.66-32-62.87-59.15-84.46-3.78-10.34 1.87-14.06 13.13-10.34 69.52 20.71 128.64 55.44 181.21 96.74 11.24 7.49 24.39 11.27 37.54 7.49 18.77-12.21 40.35-18.76 63.8-25.35 14.09-1.85 18.79-13.09 15.93-29.06zm47.85 41.29c-8.42-2.8-14.06-2.8-18.78.92-19.65 16-37.5 25.35-51.6 26.31-15 .91-25.31 5.65-31.91 15l-15 13.13c-.94 2.83-6.6 6.61-25.35 8.46-3.73 2.84-14.07 8.46-10.32 14.08a140.46 140.46 0 0116.91 28.1c4.68 19.71.95 41.26-17.85 61-6.55 8.47-15.92 11.27-28.16 9.42-5.58-.93-13.12-4.72-13.12-11.25 1-7.54 3.74-13.16 10.32-17.88 12.2-15.95 12.2-29.05-1-40.31q-14.07-7.11-28.14 0c-18.77 8.43-21.58 24.36-9.38 40.31 0 4.72-.93 10.34-3.75 17.88-4.71 9.36-13.16 11.25-23.5 10.32-17.78-9.41-26.23-26.29-23.42-54.45 7.52-13.14 16.9-25.33 27.23-34.69q-16.89-28.2-45.09-42.26c-18.77 9.4-34.71 23.46-45 42.26 9.37 11.2 17.82 21.55 22.55 34.69 1.83 16.88.92 32.84-12.23 48.79-12.19 8.44-23.45 13.14-35.63 5.66-8.51-8.49-8.51-17.86-3.79-28.2 8.45-13.11 7.51-26.25-4.72-36.58-9.34-7.47-20.63-6.56-29.08 0-12.17 9.4-11.26 20.63-.94 36.58a25.6 25.6 0 01-1.88 15.05c-9.35 20.63-23.45 17.81-40.36 11.25-29.06-29.09 10.36-107-2.78-109.8-25.34-6.57-47-17.84-61-37.54-14.12-30-32.87-30-47 0-14.08 18.76-36.58 31-61 37.54-12.18 2.84-15.91 13.14-10.28 21.59 35.63 30 35.63 58.16 7.49 88.21-16.92 6.56-31 7.5-40.38-11.25-2.79-4.71-2.79-9.39-.88-16.91 9.32-14.09 10.28-27.19-1.91-34.72-9.38-6.56-19.7-7.47-31 0-11.28 9.4-11.28 23.47-2.83 36.58 2.83 9.4 2.83 18.8-3.74 27.24-13.15 6.56-23.47 3.74-35.66-4.7-13.14-16.88-14.09-31.91-12.18-48.79 4.7-14.06 13.09-25.33 21.53-35.66-9.35-17.82-24.38-31.89-45-43.18a152.57 152.57 0 00-45 43.18c11.27 10.33 20.63 21.6 27.24 35.66 3.75 27.22-4.73 45.05-22.54 53.49-11.29 1.89-19.72 0-24.38-11.27-1-5.63-2.81-11.25-2.81-16 12.19-15.95 8.43-31.88-9.39-40.31-9.41-4.74-18.8-4.74-29.12 0-12.17 11.26-13.12 24.36-1.87 40.31 7.47 4.72 11.28 10.34 11.28 16 .91 8.44-6.6 12.23-13.14 13.16-12.24 1.85-20.66-1.89-27.23-9.42-20.63-19.71-23.46-41.26-18.78-62.85a120.4 120.4 0 0117.85-26.28c4.67-5.62-6.57-13.13-11.27-14.08-18.79-3.74-24.41-5.63-24.41-8.46l-14-14.06c-8.48-8.41-19.72-13.15-32.84-14.06-14.12-1-32.88-10.32-52.59-26.31-4.67-3.72-11.27-3.72-17.8-.92-6.57 5.65-7.54 12.22-4.71 17.84 73.18 64.76 97.61 140.79 104.16 180.18h861.52c6.57-39.42 31-115.45 103.22-179.26 3.74-6.57 2.81-13.14-3.78-18.78zm-961 238.36h861.56v-21.6H105.66v21.59z"
                                fill="#fdc125" fill-rule="evenodd"></path>
                        </g>
                    </svg>
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