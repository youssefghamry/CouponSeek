<?php if ( ! defined( 'ABSPATH' ) ) { die(); }

/**
*  Enqueue Custom CSS
*/
add_action('wp_enqueue_scripts', '_action_couponseek_enqueue_acf_scripts' , 30);

if( !function_exists('_action_couponseek_enqueue_acf_scripts') ) {
	function _action_couponseek_enqueue_acf_scripts() {
		// Custom Styles
		wp_enqueue_style(
			'couponseek_functionalities_custom-css',
			plugins_url( 'assets/css/custom.css', __FILE__ ),
			array(),
			'1.0'
		);
	}
}

/**
 * ACF Theme Settings Page
 */
add_action('acf/init', '_action_couponseek_theme_settings');

if( !function_exists('_action_couponseek_theme_settings') ) {
	function _action_couponseek_theme_settings() {
		if( function_exists('acf_add_options_page') ) {
			acf_add_options_page(array(
				'page_title' 	=> esc_html__('Theme General Settings', 'couponseek'),
				'menu_title'	=> esc_html__('Theme Settings', 'couponseek'),
				'menu_slug' 	=> 'theme-general-settings',
				'parent'	=> 'themes.php',
				'capability'	=> 'edit_posts',
				'autoload'		=> true,
				'redirect'		=> false
			));
		}
	}
}

/**
*  ACF Google Maps API
*/

add_action('acf/init', '_action_couponseek_acf_google_api_key');

if( !function_exists('_action_couponseek_acf_google_api_key') ) {
	function _action_couponseek_acf_google_api_key() {
		$google_api = '';
		if ( couponseek_get_field('google_api_restricted', 'option') ) {
			$google_api = couponseek_get_field('google_api_http', 'option');
		} else {
			$google_api = couponseek_get_field('google_api', 'option');
		}

		acf_update_setting('google_api_key', $google_api);
	}
}

/**
*  ACF Google Maps API Localization
*/

add_filter('acf/fields/google_map/api', '_filter_couponseek_acf_google_api_key_localization');

if( !function_exists('_filter_couponseek_acf_google_api_key_localization') ) {
	function _filter_couponseek_acf_google_api_key_localization($api) {
		if ( isset($api['key']) && preg_match('/(&language=(.*?))(?:&|$)/', $api['key'], $matches) ) {
			if ( $matches[0] && $matches[1] ){
				$api['key'] = str_replace($matches[1], '', $api['key']);
				$api['language'] = $matches[2];
			}
		}
		return $api;
	}
}