<?php if ( ! defined( 'ABSPATH' ) ) { die(); }
/**
 * Include static files: javascript and css
 */

add_action('admin_enqueue_scripts', '_action_couponseek_functionalities_enqueue_admin_scripts');

if( !function_exists('_action_couponseek_functionalities_enqueue_admin_scripts') ) {
	function _action_couponseek_functionalities_enqueue_admin_scripts() {
		// Main Script
		wp_enqueue_script(
			'couponseek_functionalities_admin_scripts-js',
			plugins_url( '../assets/js/admin.js', __FILE__ ),
			array( 'jquery' ),
			'1.0',
			true
		);
	}
}
