<?php

/*
Plugin Name: Couposeek Social Share
Plugin URI: http://www.subsolardesigns.com
Description: Adds Social Share Buttons to Posts
Version: 1.0.4
Author: Subsolar Designs
Author URI: http://www.subsolardesigns.com
Text Domain: couponseek
*/	


/**
 * Show Share Buttons
 */

if ( ! function_exists( 'couponseek_social_share_buttons' ) ) {
	function couponseek_social_share_buttons(){

		global $post; ?>
		<div class="ElementHeading">
			<div class="element-title font-heading"><?php esc_html_e('Share:', 'couponseek-social-share'); ?></div>
		</div>
		
		<div class="SocialShare single-post-footer-content is-shareable" data-post-url="<?php echo esc_url(get_permalink($post->ID)); ?>">
			<a href="#" class="facebook" title="<?php esc_attr_e('Share on Facebook', 'couponseek-social-share'); ?>"><i class="fab fa-facebook"></i></a>
			<a href="#" class="twitter" title="<?php esc_attr_e('Share on Twitter', 'couponseek-social-share'); ?>"><i class="fab fa-twitter"></i></a>
			<a href="#" class="pinterest" title="<?php esc_attr_e('Share on Pinterest', 'couponseek-social-share'); ?>"><i class="fab fa-pinterest-p"></i></a>
		</div>

		<?php	
	}
}

/**
 * Show Share Buttons
 */

add_action('wp_enqueue_scripts', '_action_ssd_social_scripts');

if ( ! function_exists( '_action_ssd_social_scripts' ) ) {
	function _action_ssd_social_scripts(){

		// simpleLightbox
		wp_enqueue_script(
			'couponseek-social-share-script',
			plugin_dir_url(__FILE__) . 'assets/js/scripts.js',
			array( 'jquery' ),
			'1.0',
			true
		);

	}
}


/**
 * Localization
 */

add_action( 'plugins_loaded', '_action_ssd_i18n');

if ( ! function_exists( '_action_ssd_i18n' ) ) {
	function _action_ssd_i18n() {
		load_plugin_textdomain( 'couponseek-social-share', false, dirname( plugin_basename( __FILE__ ) ) . '/language/' );
	}
}

