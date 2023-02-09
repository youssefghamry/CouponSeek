<?php if ( ! defined( 'ABSPATH' ) ) { die( ); }


/**
 * Filters and Actions
 */

add_action( 'init', '_action_couponseek_theme_setup');

if ( ! function_exists( '_action_couponseek_theme_setup' ) ) {
	function _action_couponseek_theme_setup() {

		/*
		 * Make Theme available for translation.
		 */
		load_theme_textdomain( 'couponseek', get_template_directory() . '/language' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-background', array(
			'default-color' 	 => '#f7f7fa',
		) );
		add_theme_support( 'custom-logo', array(
			'height'      => 60,
			'width'       => 200,
			'flex-width' => true,
		) );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );

		add_image_size( 'couponseek_landscape_medium', 1000, 600, true );
		add_image_size( 'couponseek_landscape_large', 2000, 1100, true );
		add_image_size( 'couponseek_medium', 800, 800, true );
		add_image_size( 'couponseek_medium_soft', 800, 800, false );

		set_post_thumbnail_size( 50, 50, true );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
			) );

	}
}


/**
*  Declare theme supports. These are used by the Subsolar Designs Extras plugin to
*  register the needed custom post types and widgets for the theme. If the plugin is activated
* on non-Subsolar Designs theme, it will activate everything.
*/

if(!( function_exists('_action_couponseek_declare_theme_support') )){

	add_action('after_setup_theme', '_action_couponseek_declare_theme_support', 10);

	function _action_couponseek_declare_theme_support() {
		add_theme_support('subsolar-theme');
	}
}

/**
 * Register widget areas.
 */
if(!( function_exists('_action_couponseek_theme_widgets_init') )){
	function _action_couponseek_theme_widgets_init() {
		// Sidebars
		register_sidebar(
			array(
				'id' => 'main-sidebar',
				'name' => esc_html__( 'Main Sidebar', 'couponseek' ),
				'description' => esc_html__( 'Add a sidebar for the blog and blog posts.', 'couponseek' ),
				'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		register_sidebar(
			array(
				'id' => 'shop-sidebar',
				'name' => esc_html__( 'Shop Sidebar', 'couponseek' ),
				'description' => esc_html__( 'Add a sidebar for the WooCommerce Shop Page.', 'couponseek' ),
				'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Footer Columns
		register_sidebar(
			array(
				'id' => 'footer1',
				'name' => esc_html__( 'Footer Column 1', 'couponseek' ),
				'description' => esc_html__( 'If this is set, your footer will be 1 column', 'couponseek' ),
				'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
				)
			);
		register_sidebar(
			array(
				'id' => 'footer2',
				'name' => esc_html__( 'Footer Column 2', 'couponseek' ),
				'description' => esc_html__( 'If this and Footer Column 1 are set, your footer will be 2 columns.', 'couponseek' ),
				'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
				)
			);	
		register_sidebar(
			array(
				'id' => 'footer3',
				'name' => esc_html__( 'Footer Column 3', 'couponseek' ),
				'description' => esc_html__( 'If this Footer Column 1 and Footer Column 2 are set, your footer will be 3 columns.', 'couponseek' ),
				'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
				)
			);
	}
}

add_action( 'widgets_init', '_action_couponseek_theme_widgets_init' );

/**
*  Load Default Fonts
*/

add_action( 'wp_enqueue_scripts', '_action_couponseek_load_default_fonts', 90 );

if ( !function_exists('_action_couponseek_load_default_fonts') ) {

	function _action_couponseek_load_default_fonts() {
		
		if( !function_exists('acfgfs_google_font_enqueue') ){
			wp_enqueue_style( 'couponseek_default_fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900|Muli:200,300,400,500,600,700,800,900|Oswald:400,500', array(), null );

			$body_font = 'font-family: "Muli",Helvetica,Arial,sans-serif;';
			$heading_font = 'font-family: "Montserrat",Helvetica,Arial,sans-serif;';
			$navigation_font = 'font-family: "Oswald",Helvetica,Arial,sans-serif;';

			ob_start(); ?>
			/* Typography */
			body {
				<?php echo wp_kses_post($body_font) ?>;
			}

			h1,
			h2,
			h3,
			h4,
			h5,
			h6,
			.fw-table .heading-row,
			.fw-package .fw-heading-row,
			.font-heading,
			.btn, .elementor-button, .button, button[type='submit'], button[type='submit'], input[type='submit'], input[type='submit'],
			label {
				<?php echo wp_kses_post($heading_font) ?>;
			}

			.main-navigation-menu, .ubermenu {
				<?php echo wp_kses_post($navigation_font) ?>;
			}

			<?php
			$output_css = ob_get_clean();
			wp_add_inline_style( 'couponseek_custom-css', $output_css );
		}
	}
}

/**
*  Header
*/

add_action( 'wp_body_open', '_action_couponseek_load_svg_file' );

if ( !function_exists('_action_couponseek_load_svg_file') ) {
	function _action_couponseek_load_svg_file() {
		?>
		<div class="hidden" hidden>
			<?php get_template_part( 'assets/svg/icons.svg' ) ?>
		</div>
		<?php
		// Product Popup
		if ( is_singular('product') ) {
			get_template_part( 'partials/content-deal', 'modal' );
		}
	}
}


/**
*  Gutenberg Support
*/

add_action( 'enqueue_block_editor_assets', '_action_couponseek_enqueue_gutenberg_styles', 90 );

if ( !function_exists('_action_couponseek_enqueue_gutenberg_styles') ) {

	function _action_couponseek_enqueue_gutenberg_styles() {

		wp_enqueue_style( 'couponseek_gutenberg-style', get_template_directory_uri() . '/assets/css/gutenberg-style.css' );


		if ( function_exists('acfgfs_google_font_enqueue') ) {
			acfgfs_google_font_enqueue();

			$body_font = couponseek_get_field('body_font', 'option');
			$heading_font = couponseek_get_field('heading_font', 'option');

			$color_main = couponseek_get_field('color_main', 'option');
			$color_secondary = couponseek_get_field('color_secondary', 'option');
			$color_accent = couponseek_get_field('color_accent', 'option');

			ob_start();
			?>
			.wp-block-heading h1, .wp-block-heading h2, .wp-block-heading h3, .wp-block-heading h4,
			.wp-block-heading h5, .wp-block-heading h6 {
				<?php echo couponseek_typography_css($heading_font); ?>;
			}
			.edit-post-visual-editor, .edit-post-visual-editor p {
				<?php echo couponseek_typography_css($body_font); ?>;
			}
			.editor-post-title__block .editor-post-title__input {
				<?php echo couponseek_typography_css($heading_font); ?>;
			}
			.wp-block-separator {
			    border-bottom: 2px solid <?php echo esc_attr($color_secondary); ?>;
			}
			.wp-block-quote:not(.is-large):not(.is-style-large) {
				border-left: 5px solid <?php echo esc_attr($color_secondary); ?>;
			}
			.wp-block-quote.is-large, .wp-block-quote.is-style-large {
				border-left: 5px solid <?php echo esc_attr($color_secondary); ?>;
			}
			.wp-block-pullquote {
				border-top: 4px solid <?php echo esc_attr($color_secondary); ?>;
				border-bottom: 4px solid <?php echo esc_attr($color_secondary); ?>;
			}
			<?php

			$output_css = ob_get_clean();

			wp_add_inline_style( 'couponseek_gutenberg-style', $output_css );

		}

	}
}

/**
* ----------------------------------------------------------------------------------------
*    WooCommerce
* ----------------------------------------------------------------------------------------
*/

add_action( 'after_setup_theme', '_action_couponseek_woocommerce_support' );

if( !function_exists('_action_couponseek_woocommerce_support')) {
	function _action_couponseek_woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}
}

/**
*  WooCommerce BreadCrumbs
*/

add_filter('woocommerce_breadcrumb_defaults', '_filter_couponseek_breadcrumb_args');

if( !function_exists('_filter_couponseek_breadcrumb_args')) {
	function _filter_couponseek_breadcrumb_args($args) {
		$args['delimiter'] = '-';
		$args['wrap_before'] = '<nav class="woocommerce-breadcrumb">';

		return $args;
	}
}

add_filter( 'woocommerce_get_breadcrumb', 'change_breadcrumb' );
function change_breadcrumb( $terms ) {
	if ( is_search() ) {
		foreach($terms as $key => $array) {
			$current_url = remove_query_arg( 'paged' );
			if ( $array[1] == $current_url ) {
				$terms[$key][0] = esc_html__('Search Results', 'couponseek');
			}
		}
	}
	return $terms;
}

/**
*  WooCommerce Default Image Sizes
*/

add_action( 'after_switch_theme', '_action_couponseek_wc_image_dimensions', 1 );

if( !function_exists('_action_couponseek_wc_image_dimensions')) {
	function _action_couponseek_wc_image_dimensions() {
		global $pagenow;

		if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
			return;
		}

		// Image sizes
		update_option( 'woocommerce_thumbnail_image_width', '600', '', 'yes' );
		update_option( 'woocommerce_thumbnail_cropping', 'custom' );
	}
}

add_filter( 'woocommerce_get_image_size_single', '_filter_couponseek_wc_single_image_dimensions' );
add_filter( 'woocommerce_get_image_size_shop_single', '_filter_couponseek_wc_single_image_dimensions' );
add_filter( 'woocommerce_get_image_size_woocommerce_single', '_filter_couponseek_wc_single_image_dimensions' );
if( !function_exists('_filter_couponseek_wc_single_image_dimensions')) {
	function _filter_couponseek_wc_single_image_dimensions() {

		$size = array(
			'width' => 1200,
			'height' => 800,
			'crop' => 1,
		);
		return $size;
	}
}

/**
*  WooCommerce Loop
*/

add_filter('loop_shop_columns', '_filter_couponseek_loop_shop_columns');

if ( !function_exists('_filter_couponseek_loop_shop_columns') ) {
	function _filter_couponseek_loop_shop_columns($columns) {
		// Cross Sells
		if ( is_cart() ) {
			return 2;
		}
		if ( is_woocommerce() || ( class_exists('WCV_Vendors') && WCV_Vendors::is_vendor_page() ) ) {
			if ( is_product() ) {
				return 4;
			}
			if ( is_active_sidebar( 'shop-sidebar' ) || ( class_exists('WCV_Vendors') && WCV_Vendors::is_vendor_page() ) ) {
				return 3;
			} else {
				return 4;
			}
			return 1;
		}

		return $columns;
	}
}

add_filter( 'loop_shop_per_page', '_filter_couponseek_loop_shop_products', 20 );

if ( !function_exists('_filter_couponseek_loop_shop_products') ) {
	function _filter_couponseek_loop_shop_products( $cols ) {
		if ( couponseek_get_field('number_products', 'option') ) {
			$cols = couponseek_get_field('number_products', 'option');
		}
		return $cols;
	}
}


add_filter( 'woocommerce_output_related_products_args', '_filter_couponseek_wc_related_products', 20 );
if ( !function_exists('_filter_couponseek_wc_related_products') ) {
	function _filter_couponseek_wc_related_products( $args ) {
		$args['posts_per_page'] = 4;

		return $args;
	}
}

/**
*  WooCommerce Shop Page
*/
// Main Content - Before

add_action( 'woocommerce_before_main_content', '_action_couponseek_wc_before_wrap', 10 );
if( !function_exists('_action_couponseek_wc_before_wrap')) {
	function _action_couponseek_wc_before_wrap() { ?>

		<?php if ( is_shop() || is_product_category() ) : ?>

			<div class="container mt-80 mb-80">
			<div class="row">

			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

				<div class="ContentHeader col-sm-12 mb-40">
					<div class="SpecialHeading">
						<?php if ( is_search() ) : ?>
						<h4 class="special-title woocommerce-products-header__title search-title page-title"><?php woocommerce_page_title(); ?></h4>
						<?php else : ?>
						<h1 class="special-title woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
						<?php endif; ?>
					</div>
					<?php woocommerce_breadcrumb(); ?>
				</div> <!-- end ContentHeader -->	
			<?php endif; ?>

			<?php if ( !( class_exists('WC_Vendors') && WCV_Vendors::is_vendor_page() ) ) : ?>
				<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
				<div class="col-sm-12 col-md-8 col-lg-9 mb-40">
				<?php else : ?>
				<div class="col-sm-12 mb-40">
				<?php endif; ?>
			<?php endif; ?>
		
		<?php elseif ( !is_cart() ) : ?>

		<div class="container mt-40 mb-80">
		<div class="row">
		<div class="col-sm-12 mb-40">
		<?php woocommerce_breadcrumb(); ?>

		<?php endif; ?>

		<?php
	};
}

/**
*  Always display the WC Vendors Main Header on Vendors Page
*/
if ( class_exists('WCV_Vendor_Shop') ) {
	add_action( 'woocommerce_before_main_content', array('WCV_Vendor_Shop', 'vendor_main_header'), 20 );
}

// Main Content - After

add_action( 'woocommerce_after_main_content', '_action_couponseek_woocommerce_after_wrap', 10 ); 

if( !function_exists('_action_couponseek_woocommerce_after_wrap')) {
	function _action_couponseek_woocommerce_after_wrap() { 
		?>

		</div> <!-- end col-sm-12 -->

		<?php if ( !is_product() ) : 
			
		if ( class_exists('WCV_Vendors') && WCV_Vendors::is_vendor_page() ) : 

			$vendor_shop = urldecode( get_query_var( 'vendor_shop' ) );
			$vendor_id = WCV_Vendors::get_vendor_id( $vendor_shop ); 
			$shop_name 	=  get_user_meta( $vendor_id, 'pv_shop_name', true );
			$logo_id = couponseek_get_vendor_logo( $vendor_id);
			$shop_description = get_user_meta( $vendor_id, 'pv_shop_description', true );

			if ( wp_get_attachment_url($logo_id) || $shop_description ) :
			?>
			<div class="col-sm-12 col-md-4 col-lg-3 hidden-xs hidden-sm mb-80">
				<div class="product-company-summary">
					<?php
					if ( $logo_id && wp_get_attachment_url($logo_id) ) : ?>
						<div class="product-company-logo">
							<?php echo wp_get_attachment_image($logo_id, 'couponseek_medium_soft');  ?>
						</div>
					<?php endif ?>
					<div class="product-company-meta">
						<div class="product-company-title">
							<h6><?php echo wp_kses_post($shop_name); ?></h6>
						</div>
						<div class="product-company-description mb-20">
							<?php 
							echo do_shortcode( $shop_description );
							?>
						</div>
						<?php  
						$user_info = get_userdata($vendor_id);
						if ( $user_info->user_url ) :
						?>
						<a href="<?php echo esc_url($user_info->user_url); ?>" class="product-company-website"><?php echo esc_html__('Visit Website', 'couponseek'); ?></a>
						<?php endif; ?>
					</div>
				</div> <!-- product-company-summary -->
			</div>
			<?php endif;
		endif;

		if ( !is_cart() && !is_checkout() ) {
			get_sidebar('shop');
		}

		endif; ?>

		</div> <!-- end row -->
		</div> <!-- end container -->
		<?php
	}
}

// Cart - Before
add_action( 'woocommerce_before_cart', '_action_couponseek_wc_before_wrap', 10 );

// Cart - After
add_action( 'woocommerce_after_cart', '_action_couponseek_woocommerce_after_wrap', 10 );

// Checkout - Before
add_action( 'woocommerce_before_checkout_form', '_action_couponseek_wc_before_wrap', 10 );

// Checkout - After
add_action( 'woocommerce_after_checkout_form', '_action_couponseek_woocommerce_after_wrap', 10 );

// Shop Loop - Add Sale before title

add_action('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 11);

// Shop Loop - Add modal popup

add_action( 'woocommerce_before_shop_loop_item', '_action_couponseek_wc_add_modal_popup', 10 );

if ( !function_exists('_action_couponseek_wc_add_modal_popup') ) {
	function _action_couponseek_wc_add_modal_popup() {

		$discount_code = (couponseek_get_field('discount_code')) ? couponseek_get_field('discount_code') : '';

		if ( $discount_code != '' ) {
			get_template_part( 'partials/content-deal', 'modal' );
		}
	}
}

// Shop Loop - Close Link Before Title; Add Link To Product Title

add_action( 'elementor_woocommerce_hooks', '_action_couponseek_wc_remove_hooks' );

if ( !did_action( 'elementor_woocommerce_hooks') ) {
	add_action( 'init', '_action_couponseek_wc_remove_hooks' );
}

if ( !function_exists('_action_couponseek_wc_remove_hooks') ) {
	function _action_couponseek_wc_remove_hooks() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 ); 
	}
}

add_action( 'woocommerce_shop_loop_item_title', '_action_couponseek_wc_loop_product_title', 10 );

if ( !function_exists('_action_couponseek_wc_loop_product_title') ) {
	function _action_couponseek_wc_loop_product_title() {

		global $post;

		// Product Title
		$external_url = couponseek_is_product_external_popup();

		if ( $external_url ) {
			$discount_code = (couponseek_get_field('discount_code')) ? couponseek_get_field('discount_code') : '';
			if ( $discount_code != '' ) {
				echo '<a href="' . esc_url( $external_url ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link is-show-coupon-code" data-target="#external-product-modal-' . get_the_ID() . '" data-clipboard-text="' . esc_attr($discount_code) . '"><h2 class="woocommerce-loop-product__title">' . wp_kses_post(get_the_title()) . '</h2></a>';
			} else {
				echo '<a href="' . esc_url( $external_url ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link" target="_blank"><h2 class="woocommerce-loop-product__title">' . wp_kses_post(get_the_title()) . '</h2></a>';
			}
		} else {
			echo '<a href="' . esc_url( get_the_permalink() ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><h2 class="woocommerce-loop-product__title">' . wp_kses_post(get_the_title()) . '</h2></a>';
		}
		?>
		<div class="clearfix"></div>
		<?php
	}
}

// Shop Loop - Product Expiration Date and Product Category

add_action( 'woocommerce_after_shop_loop_item_title', '_action_couponseek_shop_loop_product_expiration_date', 11);

if ( !function_exists('_action_couponseek_shop_loop_product_expiration_date') ) {
	function _action_couponseek_shop_loop_product_expiration_date() {


		// Product Expiration
		if ( couponseek_get_field('expiring_date') ) : ?>

			<?php
			$expiring_date = DateTime::createFromFormat('Ymd', couponseek_get_field('expiring_date'));
			$expiring_date_formatted = $expiring_date->format('m/d/Y');
			?>
			<div class="woocommerce-product-expiration">
				<div class="product-expiration-meta"><?php echo esc_html__('Expires In', 'couponseek'); ?></div>
				<div class="is-jscountdown font-heading" data-time="<?php echo esc_attr($expiring_date_formatted) ?>"></div>
			</div><!-- end single-product-expiration -->

		<?php endif;

	}
}

// Shop Sorting - Change Sorting/Orderby Names

add_filter( 'woocommerce_catalog_orderby', '_filter_couponseek_wc_orderby_names' );
add_filter( 'woocommerce_default_catalog_orderby_options', '_filter_couponseek_wc_orderby_names' );
if ( !function_exists('_filter_couponseek_wc_orderby_names') ) {
	function _filter_couponseek_wc_orderby_names( $catalog_orderby_options ) {
		$catalog_orderby_options = array(
			'menu_order' => __( 'Default', 'couponseek' ),
			'popularity' => __( 'Popular', 'couponseek' ),
			'rating'     => __( 'Rating', 'couponseek' ),
			'date'       => __( 'Newest', 'couponseek' ),
			'expiring'      => __( 'Expiring Soon', 'couponseek' ),
		);
		return $catalog_orderby_options;
	}
}

add_action( 'woocommerce_product_query', '_action_couponseek_wc_orderby_expiring_date' );

if ( !function_exists('_action_couponseek_wc_orderby_expiring_date') ) {
	function _action_couponseek_wc_orderby_expiring_date( $query ) {

		if ( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'expiring' ) {


			if( !is_admin() ) { 

				$meta_query = array(
					'relation' => 'OR',		
					'expiring_products' => array(
						'key' => 'expiring_date',
						'value' => date('Ymd'),
						'compare' => '>',
						'type' => 'DATE'
					),
					'non_expiring_products' => array(
						'key' => 'expiring_product',
						'compare' => 'NOT EXISTS',
					),
				);

				$query->set( 'meta_query', $meta_query );

				$query->set('orderby', array( 
					'non_expiring_products' => 'DESC',
					'expiring_products' => 'ASC',
				));

			}
		}
		return $query;
	}
}


// Product Shortcode Expiring Sorting

add_filter( 'woocommerce_shortcode_products_query', '_filter_couponseek_wc_shortcode_products_query' );

if ( !function_exists('_filter_couponseek_wc_shortcode_products_query') ) {
	function _filter_couponseek_wc_shortcode_products_query( $query_args ) {

		// Set Expiring Products Clause

		$expiring_products_clause = array(
			'key' => 'expiring_date',
			'value' => date('Ymd'),
			'compare' => '>',
		);

		if ( get_option('ssd_elementor_all_products_settings' ) ) {

			$elementor_settings = get_option('ssd_elementor_all_products_settings' );

			if ( $elementor_settings['show_expired'] == 'yes' ) {
				$expiring_products_clause = array(
					'key' => 'expiring_date',
					'compare' => 'EXISTS',
				);
			}

		}

		// Set WooCommerce Meta Query

		$meta_query = array(
			'relation' => 'OR',		
			'expiring_products' => $expiring_products_clause,
			'non_expiring_products' => array(
				'key' => 'expiring_product',
				'compare' => 'NOT EXISTS',
			),
		);
		$query_args['meta_query'] = $meta_query;

		if ( $query_args['orderby'] == 'expiring' ) {

			$query_args['orderby'] = array( 
				'non_expiring_products' => 'DESC',
				'expiring_products' => $query_args['order'],
			);
		}
		
		return $query_args;
	}
}

// Add WC Vendors meta to product

add_action( 'woocommerce_process_product_meta',  '_action_couponseek_wc_vendors_product_meta' );
if ( !function_exists('_action_couponseek_wc_vendors_product_meta') ) {
	function _action_couponseek_wc_vendors_product_meta($post_id) {
		if ( class_exists('WCV_Vendors') ) {
			$vendor_id = WCV_Vendors::get_vendor_from_product($post_id);
			$shop_name =  get_user_meta( $vendor_id, 'pv_shop_name', true );
			if ( $shop_name ) {
				$shop_name = sanitize_title($shop_name);
				update_post_meta($post_id, 'wc_product_vendor', $shop_name);
			}
		}
	}
}

/**
*  WooCommerce Single Product
*/

// Remove WooCommerce Sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Reorder Upsells and Related Products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );

// Reorder Rating
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );

// Change Price HTML
add_filter('woocommerce_format_sale_price', '_filter_couponseek_wc_format_sale_price', 20, 3);

if ( !function_exists('_filter_couponseek_wc_format_sale_price') ) {
	function _filter_couponseek_wc_format_sale_price( $price, $regular_price, $sale_price ) {

		ob_start();
		$sale_price_html = is_numeric( $sale_price ) ? wc_price( $sale_price ) : $sale_price;
		$regular_price_html = is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price;
		?>
		<div class="price-text-meta-item font-heading">
			<div class="price-text-meta-item-name"><?php esc_html_e('Price', 'couponseek'); ?></div>
			<?php echo wp_kses_post($sale_price_html); ?>
		</div>
		<?php if ( $regular_price && $sale_price ) : ?>
		<div class="price-text-meta-item price-text-regular font-heading">
			<div class="price-text-meta-item-name"><?php esc_html_e('Value', 'couponseek'); ?></div>
			<?php echo wp_kses_post($regular_price_html); ?>
		</div>
		
		<?php endif; ?>
		<?php
		$price = ob_get_clean();

		return $price;
	}
}

add_filter('woocommerce_format_price_range', '_filter_couponseek_wc_format_sale_range', 20, 3);

if ( !function_exists('_filter_couponseek_wc_format_sale_range') ) {
	function _filter_couponseek_wc_format_sale_range( $price, $from, $to ) {

		ob_start();
		$price_from = is_numeric( $from ) ? wc_price( $from ) : $from;
		$price_to = is_numeric( $to ) ? wc_price( $to ) : $to;
		?>
		<div class="price-text-meta-item price-text-meta-item-full font-heading">
			<div class="price-text-meta-item-name"><?php esc_html_e('Price', 'couponseek'); ?></div>
			<?php echo wp_kses_post($price_from) . ' - ' . wp_kses_post($price_to); ?>
		</div>
		<?php
		$price = ob_get_clean();

		return $price;
	}
}

add_filter('woocommerce_get_price_html', '_filter_couponseek_wc_price', 20, 2);

if ( !function_exists('_filter_couponseek_wc_price') ) {
	function _filter_couponseek_wc_price( $price, $product ) {
		if ( $product->get_regular_price() && !$product->get_sale_price() ){
			$regular_price_html = is_numeric( $product->get_regular_price() ) ? wc_price( $product->get_regular_price() ) : $product->get_regular_price();
			ob_start(); ?>
			<div class="price-text-meta-item price-text-meta-item-full font-heading">
				<div class="price-text-meta-item-name"><?php esc_html_e('Price', 'couponseek'); ?></div>
				<?php echo wp_kses_post($regular_price_html); ?>
			</div>
			<?php
			$price = ob_get_clean();
		}
		if ( !$product->get_price() ) {
			ob_start(); ?>
			<div class="price-text-meta-item price-text-meta-item-free price-text-meta-item-full font-heading">
				<?php echo esc_html__('Free', 'couponseek'); ?>
			</div>
			<?php
			$price = ob_get_clean();
		}
		return $price;
	}
}

/**
*  Remove Add to Cart button if the Product has expired
*/

add_action( 'woocommerce_single_product_summary', '_action_couponseek_display_expiry_product' );

if( !( function_exists('_action_couponseek_display_expiry_product')) ){

	function _action_couponseek_display_expiry_product(){
		global $product;

		if ( couponseek_has_product_expired($product) ) {
			remove_action( 'woocommerce_single_product_summary', '_action_couponseek_single_add_to_cart', 30 );
		}
	}
	
}

// Remove action if product has expired
add_action( 'woocommerce_after_shop_loop_item', '_action_couponseek_display_expiry_loop_product', 1);

if( !( function_exists('_action_couponseek_display_expiry_loop_product')) ){

	function _action_couponseek_display_expiry_loop_product(){

		global $product;

		if ( couponseek_has_product_expired($product) ) {
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		}
	}
	
}

// Add action after that so that the next products in the loop have the action
add_action( 'woocommerce_after_shop_loop_item', '_action_couponseek_display_expiry_loop_product_after', 99);

if( !( function_exists('_action_couponseek_display_expiry_loop_product_after')) ){

	function _action_couponseek_display_expiry_loop_product_after(){

		global $product;

		if ( couponseek_has_product_expired($product) ) {
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		}
	}
	
}

/**
*  Remove the WC Vendors Mini Header on single products
*/
if ( class_exists('WCV_Vendor_Shop') ) {
	remove_action( 'woocommerce_before_single_product', array('WCV_Vendor_Shop', 'vendor_mini_header')); 
}
/**
*  Remove the WC Vendors "Sold by"
*/
/* Remove sold by in product loops */
remove_action( 'woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9, 2);
/* Remove sold by in cart view */
remove_filter( 'woocommerce_get_item_data', array( 'WCV_Vendor_Cart', 'sold_by' ), 10, 2 );
/* Remove sold by on single product pages */
remove_action( 'woocommerce_product_meta_start', array( 'WCV_Vendor_Cart', 'sold_by_meta' ), 10, 2 );
/* Remove sold by in emails */
remove_filter( 'woocommerce_order_product_title', array( 'WCV_Emails', 'show_vendor_in_email' ), 10, 2 );
/* Remove the entire seller info tab */
remove_filter( 'woocommerce_product_tabs', array( 'WCV_Vendor_Shop', 'seller_info_tab' ) );
/* Remove from order item meta (required to remove if removing from emails too) */
remove_action( 'woocommerce_add_order_item_meta', array('WCV_Vendor_Shop', 'add_vendor_to_order_item_meta'), 10, 2 );

/**
*  Return only the Product Availability number without ';'in stock'
*/

add_filter( 'woocommerce_get_availability_text', '_filter_couponseek_wc_get_availability_text', 10, 2 ); 

if ( !function_exists('_filter_couponseek_wc_get_availability_text') ) {

	function _filter_couponseek_wc_get_availability_text( $availability, $instance ) { 

		return $instance->get_stock_quantity(); 
	}; 

}


/**
*  Cart Icon In Menu
*/

add_filter( 'woocommerce_add_to_cart_fragments', '_filter_couponseek_header_add_to_cart_fragment' );

if( !( function_exists('_filter_couponseek_header_add_to_cart_fragment')) ){
	function _filter_couponseek_header_add_to_cart_fragment( $fragments ) {

		if ( couponseek_woocommerce() && !couponseek_get_field('hide_nav_cart', 'option') ) {
			ob_start();
			$count = WC()->cart->cart_contents_count;
			
			if ( !function_exists( 'ubermenu' ) ) {
				$a_classes = '';
				$submenu_classes = 'sub-menu';
				$span_classes = '';
			} else {
				$a_classes = 'ubermenu-target';
				$span_classes = 'ubermenu-target-title ubermenu-target-text';
			}
			?>
			<a class="cart-contents <?php echo esc_attr($a_classes) ?>" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'couponseek' ); ?>">
				<div class="nav-icon">
					<svg viewBox="0 0 100 100" class="icon-svg">
						<use xlink:href="#icon-svg-shopping-cart"></use>
					</svg>
				</div><span class="widget-label"><?php echo esc_html__('Cart - ', 'couponseek') ?></span><span class="cart-contents-text aaa"><?php echo wp_kses_post($count); ?></span>
			</a>
			<?php
			$fragments['a.cart-contents'] = ob_get_contents();
			ob_end_clean();
		}

	    return $fragments;
	}
}


add_filter('wp_nav_menu_items', 'update_cart_count_function', 15, 2);

if( !( function_exists('update_cart_count_function')) ){
	function update_cart_count_function( $nav, $args ) {

		if ( couponseek_woocommerce() && !couponseek_get_field('hide_nav_cart', 'option') ) {
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

				ob_start();

				$count = WC()->cart->cart_contents_count;

				if ( !function_exists( 'ubermenu' ) ) {
					$a_classes = '';
					$li_classes = 'menu-item-has-children menu-item-login-register';
					$submenu_classes = 'sub-menu';
					$span_classes = '';
				} else {
					$a_classes = 'ubermenu-target';
					$li_classes = 'ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-level-0';
					$span_classes = 'ubermenu-target-title ubermenu-target-text';
				}
				?>
				<li class="<?php echo esc_attr($li_classes); ?>">
					<a class="cart-contents <?php echo esc_attr($a_classes) ?>" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'couponseek' ); ?>">
						<div class="nav-icon">
							<svg viewBox="0 0 100 100" class="icon-svg">
								<use xlink:href="#icon-svg-shopping-cart"></use>
							</svg>
						</div><span class="widget-label"><?php echo esc_html__('Cart - ', 'couponseek') ?></span><span class="cart-contents-text"><?php echo wp_kses_post($count); ?></span>
					</a>
				</li>
				<?php 
				$ob_content = ob_get_contents();
				ob_end_clean();

				return $nav . $ob_content;
			}

		}

	    return $nav;
	}
}

/**
*  Woocommerce Login/Register in Navigation Menu
*/

add_filter( 'wp_nav_menu_items', '_filter_couponseek_wc_add_login_logout_register_menu', 10, 2 );

if ( !function_exists('_filter_couponseek_wc_add_login_logout_register_menu') ) {
	function _filter_couponseek_wc_add_login_logout_register_menu( $nav, $args ) {

		if ( couponseek_woocommerce() && !couponseek_get_field('hide_nav_menu_profile', 'option') ) {

			$url_user = get_option('woocommerce_myaccount_page_id') ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : '';
			$url_login = get_permalink( get_option('woocommerce_myaccount_page_id') ) ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : '';
			$url_logout = wc_get_page_id( 'myaccount' ) ? wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) : '';

			if ( !function_exists( 'ubermenu' ) ) {
				$a_classes = '';
				$li_classes = 'menu-item-has-children menu-item-login-register';
				$submenu_classes = 'sub-menu';
				$span_classes = '';
			} else {
				$a_classes = 'ubermenu-target';
				$li_classes = 'ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-has-children ubermenu-item-level-0 ubermenu-has-submenu-drop';
				$submenu_classes = 'ubermenu-submenu ubermenu-submenu-type-auto ubermenu-submenu-drop';
				$span_classes = 'ubermenu-target-title ubermenu-target-text';
			}

			ob_start(); ?>

			<li class="<?php echo esc_attr($li_classes); ?>">
				<?php if ( is_user_logged_in() ) : ?>
					<?php 
					$current_user = wp_get_current_user();
					?>
					<a href="<?php echo esc_url($url_user); ?>" class="<?php echo esc_attr($a_classes); ?>">
						<div class="nav-icon">
							<svg viewBox="0 0 100 100" class="icon-svg">
								<use xlink:href="#icon-svg-user"></use>
							</svg>
						</div><span class="visible-xs-inline"><?php esc_html_e('Profile', 'couponseek') ?></span><span class="<?php echo esc_attr($span_classes); ?>"><?php echo wp_kses_post($current_user->user_login); ?></span></a>
				<?php else: ?>
					<a href="<?php echo esc_url(add_query_arg('redirect-to', get_the_permalink(), $url_login)); ?>" class="not-logged-in <?php echo esc_attr($a_classes); ?>">
						<div class="nav-icon">
							<svg viewBox="0 0 100 100" class="icon-svg">
								<use xlink:href="#icon-svg-user"></use>
							</svg>
						</div>
					</a>
				<?php endif; ?>
				<ul class="<?php echo esc_attr($submenu_classes); ?>">	
					<?php if ( is_user_logged_in() ) : ?>
						<?php 
						if ( class_exists('WC_Vendors') ) {
							$user_info = get_userdata(get_current_user_id());
							$dashboard_page = get_permalink( get_option( 'wcvendors_vendor_dashboard_page_id' ) ) ? get_permalink( get_option( 'wcvendors_vendor_dashboard_page_id' ) ) : '';
							if ( in_array('vendor', $user_info->roles) ) : ?>
								<li><a href="<?php echo esc_url($dashboard_page); ?>" class="<?php echo esc_attr($a_classes); ?>"><?php esc_html_e('Vendor Dashboard', 'couponseek') ?></a></li>
							<?php endif;
						}
						?>
						<li><a href="<?php echo esc_url($url_user); ?>" class="<?php echo esc_attr($a_classes); ?>"><?php esc_html_e('User Profile', 'couponseek') ?></a></li>
						<li><a href="<?php echo esc_url(add_query_arg('redirect-to', get_the_permalink(), $url_logout)); ?>" class="<?php echo esc_attr($a_classes); ?>" class="<?php echo esc_attr($a_classes); ?>"><?php esc_html_e('Log Out', 'couponseek') ?></a></li>
					<?php elseif ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
						<li><a href="<?php echo esc_url(add_query_arg('redirect-to', get_the_permalink(), $url_login)); ?>" class="<?php echo esc_attr($a_classes); ?>"><?php esc_html_e('Log In / Signup', 'couponseek') ?></a></li>
					<?php else : ?>
						<li><a href="<?php echo esc_url(add_query_arg('redirect-to', get_the_permalink(), $url_login)); ?>" class="<?php echo esc_attr($a_classes); ?>"><?php esc_html_e('Log In', 'couponseek') ?></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php
			$ob_content = ob_get_contents();
			ob_end_clean();
			$nav .= $ob_content;
		}

		return $nav;
	}
}


/**
*  Ubermenu Skin
*/

add_action( 'init' , '_action_couponseek_register_ubermenu_skins' , 9 );

if( !( function_exists('_action_couponseek_register_ubermenu_skins')) ){
	function _action_couponseek_register_ubermenu_skins(){
		if( function_exists( 'ubermenu_register_skin' ) ){
	    	$skin_slug = 'couponseek-ubermenuskin';
	    	$skin_name = esc_html__('CouponSeek Skin', 'couponseek'); 
	    	$skin_path = get_theme_file_uri('/assets/css/ubermenu.css');
	    	ubermenu_register_skin( $skin_slug , $skin_name , $skin_path );
		}
	}
}


add_filter( 'ubermenu_settings_defaults' , '_action_couponseek_filter_settings_defaults' );

if( !( function_exists('_action_couponseek_filter_settings_defaults')) ){
	function _action_couponseek_filter_settings_defaults( $defaults ){
		$defaults['ubermenu_main']['skin'] = 'couponseek-ubermenuskin';
		return $defaults;
	}
}


add_filter( 'document_title_parts', '_filter_couponseek_wc_search_document_title' );
if ( !function_exists('_filter_couponseek_wc_search_document_title') ) {
	function _filter_couponseek_wc_search_document_title( $page_title ) {
		if ( is_search() ) {
			$page_title['title'] = esc_html__( 'Search Results', 'couponseek' );
		}
		return $page_title;
	} 
}

/**
*  Reorder WooCommerce Single Product Tabs
*/

add_filter( 'woocommerce_product_tabs', '_filter_couponseek_wc_reorder_tabs', 98 );

if ( !function_exists('_filter_couponseek_wc_reorder_tabs') ) {
	function _filter_couponseek_wc_reorder_tabs( $tabs ) {

		if (isset( $tabs['description']) ) {
			$tabs['description']['priority'] = 5;	// First
		}
		if (isset( $tabs['additional_information']) ) {
			$tabs['additional_information']['priority'] = 10;	// Second
		}
		if (isset( $tabs['location']) ) {
			$tabs['location']['priority'] = 15;	// Third
		}
		if (isset( $tabs['reviews']) ) {
			$tabs['reviews']['priority'] = 20;	// Fourth
		}
		
		return $tabs;
	}
}

/**
*  Woocommerce WC Vendors Message
*/

add_filter( 'woocommerce_account_dashboard', '_filter_couponseek_wc_add_vendors_message', 20 );

if ( !function_exists('_filter_couponseek_wc_add_vendors_message') ) {
	function _filter_couponseek_wc_add_vendors_message() {
		if ( class_exists('WC_Vendors') ) {
			$user_id = get_current_user_id();
			$user_info = get_userdata($user_id);
			if ( in_array('vendor', $user_info->roles) ) {
				$shop_name_set = WCV_Vendors::get_vendor_shop_name( $user_id );
				$vendor_login = get_userdata($user_id);
				$settings_page = get_permalink( get_option( 'wcvendors_shop_settings_page_id' ) ) ? get_permalink( get_option( 'wcvendors_shop_settings_page_id' ) ) : '';
				$dashboard_page = get_permalink( get_option( 'wcvendors_vendor_dashboard_page_id' ) ) ? get_permalink( get_option( 'wcvendors_vendor_dashboard_page_id' ) ) : '';
				if ( !isset($shop_name_set) ) {
					echo '<div class="wc-vendors-config-alert">';
					echo '<legend>' . esc_html__("You haven't configured your vendor settings!", "couponseek") . '</legend><p>' . esc_html__("You can configure your Shop Settings ", "couponseek") . '<a href="'. esc_url($settings_page) .'">' . esc_html__("here", "couponseek") . '</a>.</p>';
					echo '</div>';
				}
				echo '<a href="'. esc_url($dashboard_page) .'" class="btn btn-color mt-40">' . esc_html__("Vendor Dashboard", "couponseek") . '</a>';
			}
		}
	}
}

/**
*  WC Vendors Gutenberg Metabox fixes
*/
add_action( 'add_meta_boxes', '_action_couponseek_wc_author_meta_box_rename', 30 );

if( !function_exists( '_action_couponseek_wc_author_meta_box_rename' ) ) {
	function _action_couponseek_wc_author_meta_box_rename() {
		global $wp_meta_boxes;
		if ( isset($wp_meta_boxes[ 'product' ][ 'normal' ][ 'core' ][ 'authordiv' ][ 'title' ]) ) {
			if ( !array_key_exists('callback', $wp_meta_boxes[ 'product' ][ 'normal' ][ 'core' ][ 'authordiv' ]) ) {
				$wp_meta_boxes[ 'product' ][ 'normal' ][ 'core' ][ 'authordiv' ][ 'callback' ] =  array();
				$wp_meta_boxes[ 'product' ][ 'normal' ][ 'core' ][ 'authordiv' ]['args'] = array();
			}
		}
	}
}

/**
*  Remove Vendor Description from bottom of Single Product
*/
if ( class_exists('WCV_Vendors') ) {
	remove_filter( 'woocommerce_product_tabs', array( 'WCV_Vendor_Shop', 'seller_info_tab' ) );
}

/**
*  Remove Import Capabilities from Vendor role
*/

// add_action( 'wcvendors_installed',  '_action_couponseek_remove_vendor_import_capability') ;
// add_action( 'wcvendors_update_options_display',  '_action_couponseek_remove_vendor_import_capability') ;
// add_action( 'wcvendors_flush_rewrite_rules',  '_action_couponseek_remove_vendor_import_capability') ;
// add_action( 'init',  '_action_couponseek_remove_vendor_import_capability') ;

// if( !function_exists( '_action_couponseek_remove_vendor_import_capability' ) ) {
// 	function _action_couponseek_remove_vendor_import_capability() {
// 		log_it('import');
// 		$role = get_role( 'vendor' );
// 		$role->add_cap( 'import' );
// 	}
// }
/**
*  Add Membership Plans to Vendor Profile
*/

add_action( 'wc_memberships_before_my_memberships', '_action_couponseek_vendor_membership_plans') ;

if( !function_exists( '_action_couponseek_vendor_membership_plans' ) ) {
	function _action_couponseek_vendor_membership_plans() {

		$membership_plans = wc_memberships_get_membership_plans();

		if ( empty($membership_plans) ) {
			return;
		}

		$membership_plans_ids = array();

		foreach ($membership_plans as $membership_plan) {
			foreach ( $membership_plan->get_product_ids() as $product_id ) {
				$membership_plans_ids[] = $product_id;
			}
		}

		if ( empty($membership_plans_ids) ) {
			return;
		}

		$args = array(
			'post_type' => 'product',
			'post__in' => $membership_plans_ids,
			'posts_per_page' => -1
		);

		$products = new WP_Query($args);

		if ( $products->have_posts() ) : while ($products->have_posts()) : $products->the_post();

			$product = wc_get_product(get_the_ID());
			?>
			<div class="woocommerce-account-membership-plan">
				<div class="bg-image" data-bg-image="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'couponseek_medium') ?>"></div>
				<div class="woocommerce-account-membership-plan-content">
					<h4><?php the_title(); ?></h4>
					<p><?php the_content(); ?></p>
					<?php do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart'  ); ?>
				</div><!-- end woocommerce-account-membership-plan-content -->
			</div><!-- end woocommerce-account-membership-plan -->

		
			<?php

		endwhile; endif;

		wp_reset_postdata();
		
	}
}

/**
 *  Custom Excerpt More
 */

add_filter('excerpt_more', '_filter_couponseek_excerpt_more');

if ( !function_exists('_filter_couponseek_excerpt_more') ) {
	function _filter_couponseek_excerpt_more( $more ) {
		return '...';
	}
}

/**
 * Restrict blog search to blog posts
 */

add_filter('pre_get_posts', '_filter_couponseek_restrict_search');

if ( !function_exists('_filter_couponseek_restrict_search') ) {
	function _filter_couponseek_restrict_search($query) {
		if ( $query->is_search && !isset($query->query['post_type']) ) {
			$query->set('post_type', 'post');
		}
		return $query;
	}
}

/**
*  Custom Embed Style
*/

add_filter( 'embed_oembed_html', '_filter_couponseek_media_embed_html', 99, 4 );
if ( !function_exists('_filter_couponseek_media_embed_html') ) {
	function _filter_couponseek_media_embed_html( $cache, $url, $attr, $post_ID ) { 

		$type_video = false;

		if ( strpos( $cache, 'vimeo' ) || strpos( $cache, 'youtube' ) || strpos( $cache, 'videopress' ) ) {
			$type_video = true;
		}

		if ( $type_video ) {
			return '<div class="media-embedded">' . $cache . '</div>'; 
		} else {
			return $cache; 
		}
	}
}

/**
*  Custom Password Form
*/

add_filter( 'the_password_form', '_filter_couponseek_password_form' );

if ( !function_exists( '_filter_couponseek_password_form' ) ) {
	function _filter_couponseek_password_form() {  

		global $post;  
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );  
		$output = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
		' . '<p>' . esc_html__( 'This post is password protected. To view it please enter your password below:', 'couponseek' ) . '</p>' . ' 
			<div class="protected-post-field">
				<label class="pass-label" for="' . $label . '">' . esc_html__( 'Password', 'couponseek' ) . ' </label><input name="post_password" id="' . $label . '" type="text" size="20" /><input class="btn btn-color" type="submit" name="Submit" class="button" value="' . esc_attr__( 'Enter', 'couponseek' ) . '" />
			</div>
		</form>  
		';  
		return $output;  
	} 
}

/**
*  Comment Avatar Class
*/

add_filter('get_avatar','_filter_couponseek_avatar_css');

if ( !function_exists('_filter_couponseek_avatar_css') ) {
	function _filter_couponseek_avatar_css($class) {
		$class = str_replace("class='avatar", "class='avatar media-object", $class) ;
		return $class;
	}
}

/**
*  Navigation Menu Items Icons
*/

add_filter( 'wp_nav_menu_objects', '_filter_couponseek_menu_items_icons', 10, 2 );

if ( !function_exists('_filter_couponseek_menu_items_icons') ) {
	function _filter_couponseek_menu_items_icons($items, $args) {
		foreach( $items as $item ) {
			$item_title = $item->title;
			$icon = couponseek_get_field('menu_item_icon', $item);
			if ( $icon ) {	
				$item->title = '<svg viewBox="0 0 100 100" class="icon-svg">
									<use xlink:href="#' . esc_attr($icon) . '"></use>
								</svg><span>'. $item_title .'</span>';
			}
		}

		return $items;
	}
}

/**
*  Show Documentation Notice
*/

add_action( 'admin_notices', '_action_couponseek_show_documentation_notice' );

if( !( function_exists('_action_couponseek_show_documentation_notice')) ){
	function _action_couponseek_show_documentation_notice() {

		global $current_user;

		if ( !get_user_meta($current_user->ID, 'couponseek_show_documentation_notice_ignore', true) ) :
		?>
		<div class="notice">
		    <h2><?php esc_html_e('Welcome to CouponSeek!', 'couponseek') ?></h2>
			<p><?php esc_html_e('Thank you for installing CouponSeek. To get to know the theme better, you can find its documentation in the zip package that you downloaded and also online - ', 'couponseek') ?><a href="http://subsolardesigns.com/documentation/couponseek/index.html" target="_blank"><?php esc_html_e('Read Documentation' , 'couponseek') ?></a></p>
			<p><a href="?couponseek_show_documentation_notice_ignore"><?php esc_html_e('Dismiss', 'couponseek') ?></a></p>
		</div>
		<?php
		endif;
	}
}


add_action( 'admin_init', '_action_couponseek_show_documentation_notice_ignore' );

if( !( function_exists('_action_couponseek_show_documentation_notice_ignore')) ){
	function _action_couponseek_show_documentation_notice_ignore() {
	
		global $current_user;
		
		if (isset($_GET['couponseek_show_documentation_notice_ignore'])) {
			
			update_user_meta($current_user->ID, 'couponseek_show_documentation_notice_ignore', true);
			
		}
		
	}
}


/**
*  Show Google API Error Notice
*/
add_action( 'admin_notices', '_action_couponseek_show_google_api_error_notice' );

if( !( function_exists('_action_couponseek_show_google_api_error_notice')) ){
	function _action_couponseek_show_google_api_error_notice() {

		$apikey = false;
		if ( couponseek_get_field('google_api_restricted', 'option') ) {
			$apikey = couponseek_get_field('google_api_ip', 'option');
		} else {
			$apikey = couponseek_get_field('google_api', 'option');
		}

		if ( $apikey && get_option('show_google_maps_api_error') ) {

			$request = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=0,0&key=' . $apikey; 
			$file_contents = wp_remote_fopen(trim($request));
			$json_decode = json_decode($file_contents);

			if ( isset($json_decode->error_message) ) {
			?>
				<div class="error notice">
				    <h2><?php esc_html_e('Google API Key Error!', 'couponseek') ?></h2>
					<p><?php echo wp_kses_post($json_decode->error_message); ?></p>
					<p><?php esc_html_e('Please see here for more information - ' , 'couponseek') ?><a href="https://developers.google.com/maps/faq"><?php esc_html_e('Google API FAQ' , 'couponseek') ?></a>
					<p>
				</div>
				<?php 
				update_option('show_google_maps_api_error', false);
			}

		}
		
	}
}


/**
*  Remove WooCommerce Notice
*/

add_filter('woocommerce_show_admin_notice', '_filter_woocommerce_show_outdated_templates_notice', 20, 2);

if( !( function_exists('_filter_woocommerce_show_outdated_templates_notice')) ){
	function _filter_woocommerce_show_outdated_templates_notice($show, $notice) {
		if ( $notice == 'template_files') {
			if ( defined('WP_DEBUG') && true === WP_DEBUG ) {
				return true;
			} else {
				return false;
			}
		}

		return $show;
	}
}


/**
*  WC Vendors PRO ACF
*/

add_action( 'wcv_after_product_details', '_action_couponseek_add_acf_frontend' );

if( !( function_exists('_action_couponseek_add_acf_frontend')) ){
	function _action_couponseek_add_acf_frontend($object_id) {

		if ( !function_exists('acf_form') ) {
			return false;
		}
		acf_form_head();

		$options = array(
			'post_id'       => $object_id ? $object_id : 'new_post',
			'new_post'      => array(
				'post_type'     => 'product',
			),
            'form' => false,
            'return' => false
			);

		acf_form($options);

	}
}


add_action( 'wcv_save_product', '_action_couponseek_wcv_save_product_acf_fields' );

if( !( function_exists('_action_couponseek_wcv_save_product_acf_fields')) ){
	function _action_couponseek_wcv_save_product_acf_fields($product_id) {

		if ( !class_exists('ACF') ) {
			return false;
		}

		if ( isset($_POST['acf']) ) {
			foreach( $_POST['acf'] as $field => $value ) {
				update_field($field, $value, $product_id);
			}
		}

	}
}


/**
*  Remove Expired Products from Upsells and Related Products
*/

add_filter( 'woocommerce_related_products', '_filter_couponseek_related_products_hide_expired', 10, 3 );

if( !( function_exists('_filter_couponseek_related_products_hide_expired')) ){
	function _filter_couponseek_related_products_hide_expired($related_posts, $product_id, $args) {

		foreach ( $related_posts as $key => $related_post_id ) {
			$related_product = wc_get_product($related_post_id);
			if ( couponseek_has_product_expired($related_product) ) {
				unset($related_posts[$key]);
			}
		}
		return $related_posts;

	}
}

add_filter( 'woocommerce_product_get_upsell_ids', '_filter_couponseek_upsell_hide_expired', 10, 3 );

if( !( function_exists('_filter_couponseek_upsell_hide_expired')) ){
	function _filter_couponseek_upsell_hide_expired($upsell_ids, $arg) {

		foreach ( $upsell_ids as $key => $upsell_product_id ) {
			$related_product = wc_get_product($upsell_product_id);
			if ( couponseek_has_product_expired($related_product) ) {
				unset($upsell_ids[$key]);
			}
		}
		return $upsell_ids;

	}
}