<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if( !function_exists('log_it') ) {
	function log_it( $message ) {
		if( WP_DEBUG === true ){
			if( is_array( $message ) || is_object( $message ) ){
				error_log( print_r( $message, true ) );
			} else {
				error_log( $message );
			}
		}
	}
}

final class CouponSeek_Elementor_Widgets {

	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '5.4';

	private static $_instance = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {
		load_plugin_textdomain( 'couponseek', false, basename( dirname( __FILE__ ) ) . '/language' );

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Include plugin files
		$this->add_actions();

		// Include widget_extensions
		$this->include_widget_extensions();

	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'couponseek' ),
			'<strong>' . esc_html__( 'CouponSeek Functionalities', 'couponseek' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'couponseek' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'couponseek' ),
			'<strong>' . esc_html__( 'CouponSeek Functionalities', 'couponseek' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'couponseek' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}


	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'couponseek' ),
			'<strong>' . esc_html__( 'CouponSeek Functionalities', 'couponseek' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'couponseek' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	private function add_actions() {	
		// Scripts and Styles
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'include_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'include_controls' ] );
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'include_frontend_scripts' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'include_frontend_styles' ] );
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'include_editor_scripts' ] );
		// Custom Categories
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );
		// WooCommerce Hooks
		add_action( 'admin_action_elementor', [ $this, 'register_wc_hooks' ], 9 );
		// Enable Elementor for Custom Post Types
		add_action( 'elementor/init', [ $this, 'enable_elementor_custom_post_types' ] );
	}

	public function include_frontend_scripts() {
		wp_enqueue_script( 'jquery-simple-text-rotator', plugins_url( 'widgets/assets/js/jquery.simple-text-rotator.min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_script( 'jquery-ssd-jarallax', plugins_url( 'widgets/assets/js/jarallax.js', __FILE__ ), [], false, true );
		wp_enqueue_script( 'jquery-ssd-resizesensor', plugins_url( 'widgets/assets/js/ResizeSensor.js', __FILE__ ), [], false, true );
		wp_enqueue_script( 'couponseek_elementor-widgets-scripts', plugins_url( 'widgets/assets/js/scripts.js', __FILE__ ), [ 'jquery' ], false, true );

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

		// Localization
		wp_localize_script( 'couponseek_elementor-widgets-scripts', 'subsolar_mailchimp', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'subs_email_empty' => esc_html__('You have not entered an email address.', 'couponseek'),
			'subs_email_error' => esc_html__('You have entered an invalid email address.', 'couponseek'),
			'subs_email_add' => esc_html__('Adding your email address...', 'couponseek'),
			)
		);
	}
	
	public function include_frontend_styles() {
		wp_enqueue_style( 'couponseek_elementor-widgets-styles', plugins_url( 'widgets/assets/css/styles.css', __FILE__ ), array(), '1.0' );
		wp_enqueue_style( 'simple-text-rotator', plugins_url( 'widgets/assets/css/simpletextrotator.css', __FILE__ ), array(), '1.0' );
	}

	public function include_editor_scripts() {
		wp_enqueue_style( 'couponseek_elementor-controls-style', plugins_url( 'controls/assets/css/style.css', __FILE__ ), ['elementor-editor'], false, false );
	}

	public function enable_elementor_custom_post_types( ) {
		$cpt_support = get_option( 'elementor_cpt_support' );

		if( ! $cpt_support ) {
			$cpt_support = [ 'page', 'post', 'ssd-page-header' ];
			update_option( 'elementor_cpt_support', $cpt_support );
		}

		else if( ! in_array( 'ssd-page-header', $cpt_support ) ) {
			$cpt_support[] = 'ssd-page-header';
			update_option( 'elementor_cpt_support', $cpt_support );
		}

	}

	public function add_elementor_widget_categories( $elements_manager) {
		$elements_manager->add_category(
			'couponseek',
			[
				'title' => __( 'CouponSeek', 'couponseek' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	public function register_wc_hooks() {
		if ( class_exists( 'WooCommerce' ) ) {
			wc()->frontend_includes();
			do_action('elementor_woocommerce_hooks');
		}
	}

	public function include_widgets() {

		$widget_files = array_diff(scandir( __DIR__ . '/widgets'), array('..', '.'));

		foreach ($widget_files as $widget_file) {
			if ( preg_match('/^.*\.php$/i', $widget_file) ){
				require_once(  __DIR__ . '/widgets/' . $widget_file );
			}
		}

	}

	public function include_controls() {

		$control_files = array_diff(scandir( __DIR__ . '/controls'), array('..', '.'));
		foreach ($control_files as $control_file) {
			if (preg_match('/^.*\.php$/i', $control_file)){
				require_once(  __DIR__ . '/controls/' . $control_file );
			}
		}

	}

	public function include_widget_extensions() {

		$extension_files = array_diff(scandir( __DIR__ . '/widget-extensions'), array('..', '.'));
		foreach ($extension_files as $extension_file) {
			if (preg_match('/^.*\.php$/i', $extension_file)){
				require_once(  __DIR__ . '/widget-extensions/' . $extension_file );
			}
		}

	}


}
CouponSeek_Elementor_Widgets::instance();
