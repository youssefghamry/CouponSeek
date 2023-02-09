<?php if ( ! defined( 'ABSPATH' ) ) { die(); }
/**
 * Include static files: javascript and css
 */

if ( is_admin() ) {

	return;
}

/**
 * Enqueue scripts and styles for the front end.
 */

// Font Awesome CSS
wp_enqueue_style(
	'font-awesome-5',
	get_template_directory_uri() . '/assets/css/fontawesome5.css',
	array(),
	'1.0'
);

// Bootstrap CSS
wp_enqueue_style(
	'bootstrap',
	get_template_directory_uri() . '/assets/css/bootstrap.min.css',
	array(),
	'1.0'
);

// Owl Carousel CSS
wp_enqueue_style(
	'owl-carousel',
	get_template_directory_uri() . '/assets/css/owl.carousel.min.css',
	array(),
	'1.0'
);

// animate CSS
wp_enqueue_style(
	'animatecss',
	get_template_directory_uri() . '/assets/css/animate.custom.css',
	array(),
	'1.0'
);


// simple Lightbox CSS
wp_enqueue_style(
	'simplelightbox',
	get_template_directory_uri() . '/assets/css/simpleLightbox.min.css',
	array(),
	'1.0'
);


// Select2
wp_enqueue_style(
	'select2',
	get_template_directory_uri() . '/assets/css/select2.css',
	array(),
	'1.0'
);

// Perfect Scrollbar
wp_enqueue_style(
	'perfect-scrollbar',
	get_template_directory_uri() . '/assets/css/perfect-scrollbar.custom.css',
	array(),
	'1.0'
);


// Theme Styles
wp_enqueue_style(
	'couponseek_master-css',
	get_template_directory_uri() . '/assets/css/master.css',
	array(),
	'1.0'
);

// Custom CSS
wp_enqueue_style(
	'couponseek_custom-css',
	get_template_directory_uri() . '/assets/css/custom.css',
	array(),
	'1.0'
);

// Bootstrap JS
wp_enqueue_script(
	'bootstrap',
	get_template_directory_uri() . '/assets/js/bootstrap.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// ResizeSensor JS
wp_enqueue_script(
	'resize-sensor',
	get_template_directory_uri() . '/assets/js/ResizeSensor.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Throttledresize Resize JS
wp_enqueue_script(
	'jquery-throttledresize',
	get_template_directory_uri() . '/assets/js/jquery.throttledresize.js',
	array( 'jquery' ),
	'1.0',
	true
);

// WP Comment Reply
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}

// matchHeight JS
wp_enqueue_script(
	'jquery-matchheight',
	get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// simpleLightbox
wp_enqueue_script(
	'jquery-simplelightbox',
	get_template_directory_uri() . '/assets/js/simpleLightbox.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// ClipboardJS Script
wp_enqueue_script(
	'clipboardjs',
	get_template_directory_uri() . '/assets/js/clipboard.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Isotope JS
wp_enqueue_script(
	'isotope',
	get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Slicknav JS
wp_enqueue_script(
	'jquery-slicknav',
	get_template_directory_uri() . '/assets/js/jquery.slicknav.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Coundown JS
wp_enqueue_script(
	'jquery-countdown',
	get_template_directory_uri() . '/assets/js/jquery.countdown.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Owl Carousel
wp_enqueue_script(
	'owl-carousel',
	get_template_directory_uri() . '/assets/js/owl.carousel.min.js',
	array( 'jquery' ),
	'1.0',
	true
);


// Perfect Scrollbar
wp_enqueue_script(
	'perfect-scrollbar',
	get_template_directory_uri() . '/assets/js/perfect-scrollbar.jquery.min.js',
	array( 'jquery' ),
	'1.0',
	true
);


// Modernizr
wp_enqueue_script(
	'modernizr',
	get_template_directory_uri() . '/assets/js/modernizr.js',
	array( 'jquery' ),
	'1.0',
	false
);


// Select2
wp_enqueue_script(
	'select2',
	get_template_directory_uri() . '/assets/js/select2.full.min.js',
	array( 'jquery' ),
	'1.0',
	false
);

// ImagesLoaded
wp_enqueue_script('imagesloaded');

// Datepicker
wp_enqueue_script( 'jquery-ui-datepicker' );

// hoverIntent
wp_enqueue_script('hoverIntent');

// Google Maps
if ( is_singular('product') ) {
	$google_api = '';
	if ( couponseek_get_field('google_api_restricted', 'option') ) {
		$google_api = couponseek_get_field('google_api_http', 'option');
	} else {
		$google_api = couponseek_get_field('google_api', 'option');
	}
	wp_enqueue_script(
		'couponseek_gmapsapi', 
		'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key='. $google_api,
		'jquery',
		'1.0',
		false
		);

	wp_enqueue_script(
		'couponseek_google-map-js',
		get_template_directory_uri() . '/assets/js/google-map.js',
		'jquery',
		'1.0',
		false
		);
}

// Custom scripts
wp_enqueue_script(
	'couponseek_fw-theme-script',
	get_template_directory_uri() . '/assets/js/scripts.js',
	array( 'jquery' ),
	'1.0',
	true
);


// Localization
wp_localize_script( 'couponseek_fw-theme-script', 'couponseek', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce('ajax-nonce'),
		'expired' => esc_html__('Expired!', 'couponseek'),
		'day' => esc_html__('day', 'couponseek'),
		'days' => esc_html__('days', 'couponseek'),
		'hour' => esc_html__('hour', 'couponseek'),
		'hours' => esc_html__('hours', 'couponseek'),
		'minute' => esc_html__('minute', 'couponseek'),
		'minutes' => esc_html__('minutes', 'couponseek'),
	)
);