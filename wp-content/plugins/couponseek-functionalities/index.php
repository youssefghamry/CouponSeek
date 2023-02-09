<?php
/**
 * Plugin Name: CouponSeek Functionalities
 * Plugin URI: http://www.subsolardesigns.com
 * Description: Adds the functionalities of the CouponSeek theme
 * Version: 1.2.1
 * Author: Subsolar Designs
 * Author URI: http://www.subsolardesigns.com
 * Text Domain: couponseek
 * Domain Path: language
*/	



/**
 * Elementor Widgets
 */
require_once( plugin_dir_path( __FILE__ ) . 'couponseek-elementor-widgets.php' );

require_once( plugin_dir_path( __FILE__ ) . 'inc/hooks.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/helpers.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/post-types.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/static-admin.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/mailchimp-integration/mailchimp-integration-init.php' );

/**
*  ACF Google Font Picker Field
*/
if ( class_exists('acf') ) {
	require_once( plugin_dir_path( __FILE__ ) . 'acf-font-picker/acf-google_font_selector.php' );
}

/**
*  ACF Settings
*/
if ( class_exists('acf') ) {
	require_once( plugin_dir_path( __FILE__ ) . 'couponseek-general-settings.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'inc/custom-styles.php' );
}

/**
*  ACF Fields
*/
if ( class_exists('acf') ) {
	require_once( plugin_dir_path( __FILE__ ) . 'inc/acf-fields/acf-fields.php' );
}


/**
 * One Click Demo Install
 */

include_once( plugin_dir_path( __FILE__ ) . 'inc/demo-import/demo-import.php');