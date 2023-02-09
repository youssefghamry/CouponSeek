<?php if ( ! defined( 'ABSPATH' ) ) { die(); }
/**
 * Include static files: javascript and css
 */

if ( !is_admin() ) {	

	return;
	
}

// ACF CSS Edits
wp_enqueue_style(
	'couponseek_acf-custom-css',
	get_template_directory_uri() . '/inc/admin/assets/css/acf.css',
	array(),
	'1.0'
);

// Select 2 CSS
wp_enqueue_style(
	'select2',
	get_template_directory_uri() . '/inc/admin/assets/css/select2.min.css',
	array(),
	'1.0'
);

// Unyson CSS Edits
wp_enqueue_style(
	'couponseek_unyson-custom-css',
	get_template_directory_uri() . '/inc/admin/assets/css/unyson-edit.css',
	array(),
	'1.0'
);

// WooCommerce Edits
wp_enqueue_style(
	'woocommerce-custom-css',
	get_template_directory_uri() . '/inc/admin/assets/css/woocommerce.css',
	array(),
	'1.0'
);

// WC Vendors Edits
wp_enqueue_style(
	'wc_vendors-custom-css',
	get_template_directory_uri() . '/inc/admin/assets/css/wc-vendors.css',
	array(),
	'1.0'
);

// Select 2 JS
wp_enqueue_script(
	'select2',
	get_template_directory_uri() . '/inc/admin/assets/js/select2.full.min.js',
	array( 'jquery' ),
	'1.0'
);

// Custom scripts
wp_enqueue_script(
	'couponseek_fw-theme-admin-script',
	get_template_directory_uri() . '/inc/admin/assets/js/scripts.js',
	array( 'jquery' ),
	'1.0',
	true
);


// Localization
$theme_settings_url = '<a href="' . admin_url('themes.php?page=theme-general-settings') . '" target="_blank">' . esc_html__('Appearance > Theme Settings > General' ,'couponseek') . '</a>';

wp_localize_script( 'couponseek_fw-theme-admin-script', 'couponseek_admin', array(
		'gooleapi_error' => sprintf( __( 'Please enter your Google Maps API Key in the <strong>Google API Key</strong> field in %s. If the problem still persists, see the JavaScript console of your browser for technical details.', 'couponseek' ), $theme_settings_url )
	)
);