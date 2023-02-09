<?php if ( ! defined( 'ABSPATH' ) ) { die(); }

/**
 * Theme Includes
 */
require_once(get_theme_file_path('/inc/init.php'));

/**
 * TGM Plugin Activation
 */
{
	require_once(get_theme_file_path('/TGM-Plugin-Activation/class-tgm-plugin-activation.php'));
	
	/** @internal */
	function _action_couponseek_register_required_plugins() {
		tgmpa( array(
			array(
				'name'      => esc_html__('Elementor', 'couponseek'),
				'slug'      => 'elementor',
				'required'  => true,
			),
			array(
				'name'      			=> esc_html__('Advanced Custom Fields Pro', 'couponseek'),
				'slug'      			=> 'advanced-custom-fields-pro',
				'source'    			=> get_template_directory() . '/TGM-Plugin-Activation/plugins/advanced-custom-fields-pro.zip',
				'version' 				=> '5.9.6',
				'required'  			=> true,
			),
			array(
				'name'					=> esc_html__('WooCommerce', 'couponseek'),
				'slug'					=> 'woocommerce',
				'required' 				=> true,
				'version' 				=> '',
				'external_url' 			=> ''
			),
			array(
				'name'					=> esc_html__('One Click Demo Import', 'couponseek'),
				'slug'					=> 'one-click-demo-import',
				'required' 				=> false,
				'version' 				=> '',
				'external_url' 			=> ''
			),
			array(
				'name'     				=> esc_html__('Envato Market', 'couponseek'),
				'slug'     				=> 'envato-market',
				'source'   				=> get_template_directory() . '/TGM-Plugin-Activation/plugins/envato-market.zip',
				'required' 				=> false,
				'version' 				=> '',
				'external_url' 			=> ''
			),
			array(
				'name'     				=> esc_html__('WC Vendors', 'couponseek'),
				'slug'     				=> 'wc-vendors',
				'required' 				=> true,
				'version' 				=> '',
				'external_url' 			=> ''
			),
			array(
				'name'     				=> esc_html__('Contact Form 7', 'couponseek'),
				'slug'     				=> 'contact-form-7',
				'required' 				=> false,
				'version' 				=> '',
				'external_url' 			=> ''
			),
			array(
				'name'     				=> esc_html__('Subsolar Twitter Widget', 'couponseek'),
				'slug'     				=> 'subsolar-twitter-widget',
				'source'   				=> get_template_directory() . '/TGM-Plugin-Activation/plugins/subsolar-twitter-widget.zip',
				'required' 				=> false,
				'version' 				=> '1.0',
				'external_url' 			=> ''
			),
			array(
				'name'     				=> esc_html__('Subsolar SVG Icons', 'couponseek'),
				'slug'     				=> 'subsolar-svg-icons',
				'source'   				=> get_template_directory() . '/TGM-Plugin-Activation/plugins/subsolar-svg-icons.zip',
				'required' 				=> false,
				'version' 				=> '1.2.1',
				'external_url' 			=> ''
			),
			array(
				'name'     				=> esc_html__('CouponSeek Functionalities', 'couponseek'),
				'slug'     				=> 'couponseek-functionalities',
				'source'   				=> get_template_directory() . '/TGM-Plugin-Activation/plugins/couponseek-functionalities.zip',
				'required' 				=> true,
				'version' 				=> '1.2.1',
				'external_url' 			=> ''
			),
			array(
				'name'     				=> esc_html__('CouponSeek Social Share', 'couponseek'),
				'slug'     				=> 'couponseek-social-share',
				'source'   				=> get_template_directory() . '/TGM-Plugin-Activation/plugins/couponseek-social-share.zip',
				'required' 				=> false,
				'version' 				=> '1.0.4',
				'external_url' 			=> ''
			),
		) );

	}
	add_action( 'tgmpa_register', '_action_couponseek_register_required_plugins' );
}

/**
*  Content Width
*/

if ( ! isset( $content_width ) ) {
	$content_width = 2000;
}