<?php
namespace ElementorBanner;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Banner {

    /**
     * Instance
     *
     * @since 1.0.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    /**
     * Include Widgets files
     *
     * Load widgets files
     *
     * @since 1.2.0
     * @access private
     */
    private function include_widgets_files() {
        require_once( __DIR__ . '/widgets/banner.php' );
        require_once( __DIR__ . '/widgets/w1.php' );
        require_once( __DIR__ . '/widgets/custompost.php' );
        require_once( __DIR__ . '/widgets/w3.php' );
        require_once( __DIR__ . '/widgets/customgallery.php' );
        require_once( __DIR__ . '/widgets/timetable.php' );
         require_once( __DIR__ . '/widgets/w5.php' );
          require_once( __DIR__ . '/widgets/shop.php' );
            require_once( __DIR__ . '/widgets/test.php' );
    }

    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets() {
        // Its is now safe to include Widgets files
        $this->include_widgets_files();

        // Register Widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Banner() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\W1() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\CustomPost() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\W3() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\customGallery() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\timeTable() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\W5() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\shop() );
          \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\test() );
    }

    /**
     * widget_scripts
     *
     * Load required plugin core files.
     *
     * @since 1.2.0
     * @access public
     */
    public function widget_scripts() {
        wp_register_script( 'elementor-banner', plugins_url( '/assets/js/banner.js', __FILE__ ), [ 'jquery' ], false, true );
    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct() {

        // Register widget scripts
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

        // Register widgets
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
    }
}

// Instantiate Plugin Class
Banner::instance();