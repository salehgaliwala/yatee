<?php

namespace ElementorBanner\Widgets;



use Elementor\Widget_Base;

use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



/**

 * @since 1.1.0

 */

class Banner extends Widget_Base {



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

        return 'banner';

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

        return __( 'Banner product page', 'elementor-banner' );

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

                'label' => __( 'Banner product pafe', 'elementor-banner' ),

            ]

        );        



        $this->add_control(

            'bannercaption',

            [

                'label' => __( 'Banner Caption', 'elementor-banner' ),

                'type' => Controls_Manager::TEXTAREA,

                'default' => __( 'Caption', 'elementor-banner' ),

            ]

        );   

       



        $this->add_control(

            'banner_image',

            [

                'label' => __( 'Choose Video Placeholder', 'elementor-banner' ),

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
       
        $image_url = $settings['banner_image']['url'];      

        $this->add_inline_editing_attributes( 'bannercaption', 'advanced' );
        $this->add_inline_editing_attributes( 'banner_image')

        ?>

<div class="w1">
    <div class="custom-container">
        <div class="banner-wrapper">
            <div class="banner-content">
                <h2><?php echo nl2br($settings['bannercaption']);?></h2>
            </div>
            <video src="<?php echo  $image_url  ?>" autoplay controls loop muted playsinline controlsList="nodownload"
                class="video-bg"></video>
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