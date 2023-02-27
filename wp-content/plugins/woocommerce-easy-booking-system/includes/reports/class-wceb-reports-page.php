<?php

namespace EasyBooking;

/**
*
* Admin: Reports page.
* @version 3.0.6
*
**/

defined( 'ABSPATH' ) || exit;

class Reports_Page {

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'add_reports_page' ), 10 );

	}

	/**
	*
	* Add reports page into "Easy Booking" menu
	*
	**/
	public function add_reports_page() {

		// Create a "Reports" page inside "Easy Booking" menu
		$reports_page = add_submenu_page(
			'easy-booking',
			esc_html__( 'Reports', 'woocommerce-easy-booking-system' ),
			esc_html__( 'Reports', 'woocommerce-easy-booking-system' ),
			apply_filters( 'easy_booking_settings_capability', 'manage_options', 'easy-booking-reports' ),
			'easy-booking-reports',
			array( $this, 'display_reports_page' ),
			1
		);

		// Load scripts on this page only
		add_action( 'admin_print_scripts-'. $reports_page, array( $this, 'load_reports_scripts' ) );

	}

	/**
	*
	* Load HTML for reports page.
	*
	**/
	public function display_reports_page() {
		include_once( 'views/html-wceb-reports-page.php' );
	}

	/**
	*
	* Load CSS and JS for reports page.
	*
	**/
	public function load_reports_scripts() {

		wp_enqueue_script(
			'easy_booking_reports',
			wceb_get_file_path( 'admin', 'wceb-reports', 'js' ),
			array( 'jquery', 'pickadate', 'select2', 'wc-enhanced-select', 'jquery-tiptip', 'wc-admin-meta-boxes' ),
			'1.0',
			true
		);

		// Easy Booking styles
		wp_enqueue_style(
			'easy_booking_reports_styles',
			wceb_get_file_path( 'admin', 'wceb-reports', 'css' ),
			array( 'picker', 'woocommerce_admin_styles' ),
			1.0
		);

		// Action hook to load extra scripts on the reports page
		do_action( 'easy_booking_load_report_scripts' );

	}

}

new Reports_Page();