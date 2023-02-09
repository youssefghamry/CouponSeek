<?php if ( ! defined( 'ABSPATH' ) ) { die( ); }

/**
 * Filters and Actions
 */

add_action( 'after_setup_theme', '_action_couponseek_add_image_sizes');

if ( ! function_exists( '_action_couponseek_add_image_sizes' ) ) {
	function _action_couponseek_add_image_sizes() {

		add_image_size( 'couponseek_landscape_small', 450, 311, true );
		add_image_size( 'couponseek_medium_soft', 800, 800, false );
		add_image_size( 'couponseek_medium_landscape_soft', 1600, 800, false );
		add_image_size( 'couponseek_medium_portrait_soft', 800, 1600, false );
		add_image_size( 'couponseek_large_soft', 1300, 1300, false );
		set_post_thumbnail_size( 50, 50, true );

	}
}

/**
*  ACF Save JSON
*/

add_filter('acf/settings/save_json', '_filter_couponseek_acf_json_save_point');

if( !( function_exists('_filter_couponseek_acf_json_save_point')) ){
	function _filter_couponseek_acf_json_save_point( $path ) {

		$path = plugin_dir_path( __DIR__ ) . 'acf-json';
		return $path;

	}
}


/**
*  ACF Load JSON
*/

add_filter('acf/settings/load_json', '_filter_couponseek_acf_json_load_point');

if( !( function_exists('_filter_couponseek_acf_json_load_point')) ){
	function _filter_couponseek_acf_json_load_point( $paths ) {

		unset($paths[0]);
		$paths[] = plugin_dir_path( __DIR__ ) . 'acf-json';
		return $paths;

	}
}


/**
*  ACF Show in Admin
*/

// add_filter('acf/settings/show_admin', '__return_false');

/**
*  ACF Show Updates
*/

add_filter('acf/settings/show_updates', '__return_false');


/**
*  ACF Localization
*/

add_filter('acf/settings/l10n_textdomain', '_filter_couponseek_acf_localization');

if( !function_exists('_filter_couponseek_acf_localization') ) {

	function _filter_couponseek_acf_localization() {
		return 'couponseek';
	}
}

add_filter('acf/settings/l10n_field', '_filter_couponseek_acf_localization_fields');

if( !function_exists('_filter_couponseek_acf_localization_fields') ) {

	function _filter_couponseek_acf_localization_fields() {
		return array('label', 'instructions', 'choices', 'message');
	}
}


/**
*  ACF Geolocation Default
*/

add_filter('acf/load_field/name=location', '_filter_couponseek_geolocation_default');

if( !( function_exists('_filter_couponseek_geolocation_default')) ){	
	function _filter_couponseek_geolocation_default($field) {

		if ( is_numeric(couponseek_get_field('default_location_lat', 'option')) ) {
			$field['center_lat'] = couponseek_get_field('default_location_lat', 'option');
		}
		if ( is_numeric(couponseek_get_field('default_location_lng', 'option')) ) {
			$field['center_lng'] = couponseek_get_field('default_location_lng', 'option');
		}
		
		return $field;
	}
}


/**
*  ACF Geolocation Saving
*/

add_action('acf/save_post', '_action_couponseek_save_geolocation_meta', 20);
if( !( function_exists('_action_couponseek_save_geolocation_meta')) ){	
	function _action_couponseek_save_geolocation_meta($post_id) {

		couponseek_save_post_geolocation($post_id);

		$all_countries = couponseek_get_all_countries();
		set_transient('ssd_all_countries', $all_countries, 0);

		$all_locations = couponseek_get_all_locations();
		set_transient('ssd_all_locations', $all_locations, 0);
	}
}

// add_action('wp_head','run_update_everything');

function run_update_everything(){

    $args = array(
    	'post_type' => 'product',
    	'posts_per_page' => -1
    );

    $products_query = new WP_Query($args);

    if ($products_query->have_posts()) : while ($products_query->have_posts()) : $products_query->the_post();

    	// log_it(get_the_permalink());
    	couponseek_save_post_geolocation(get_the_ID());

		$all_countries = couponseek_get_all_countries();
		set_transient('ssd_all_countries', $all_countries, 0);

		$all_locations = couponseek_get_all_locations();
		set_transient('ssd_all_locations', $all_locations, 0);

    endwhile;
    wp_reset_postdata();
	endif;

}


/**
*  ACF Geolocation Save All Posts
*/

add_action('woocommerce_init ', '_action_couponseek_all_posts_save_geolocation_meta', 20);
if( !( function_exists('_action_couponseek_all_posts_save_geolocation_meta')) ){	
	function _action_couponseek_all_posts_save_geolocation_meta() {

		if ( get_option('all_posts_geo_saved') != 'yes' ) {

			$args = array(
				'post_type' => 'product',
				'posts_per_page' => -1
				);

			$products_query = new WP_Query($args);

			if ($products_query->have_posts()) : while ($products_query->have_posts()) : $products_query->the_post();

			couponseek_save_post_geolocation(get_the_ID());

			endwhile;
			wp_reset_postdata();
			endif;

			$all_countries = couponseek_get_all_countries();
			set_transient('ssd_all_countries', $all_countries, 0);

			$all_locations = couponseek_get_all_locations();
			set_transient('ssd_all_locations', $all_locations, 0);

			update_option( 'all_posts_geo_saved', 'yes' );
		}

	}
}


/**
*  ACF Dynamic Fields
*/

add_filter('acf/load_field/name=contact_form_7_shortcode', '_action_couponseek_acf_load_field');

if( !( function_exists('_action_couponseek_acf_load_field')) ){
	function _action_couponseek_acf_load_field($field) {

		if ( class_exists('WPCF7_ContactForm') ) {
			$field['instructions'] = wp_kses_post(__( 'Insert your Contact Form 7 shortcode. You can create one in ', 'couponseek' ) . '<a href="'. admin_url('admin.php?page=wpcf7') . '">Contact > Contact Forms</a>');
		} else {
			$field['instructions'] = wp_kses_post(__( '<strong>It seems Contact Form 7 plugin is not installed!</strong> Please install and activate it to use this field.', 'couponseek'));
		}

		return $field;
	}
}

/**
*  ACF CSS Styles
*/

// add_action( 'wp_enqueue_scripts', '_action_couponseek_acf_css', 21 );

if( !function_exists('_action_couponseek_acf_css') ) {

	function _action_couponseek_acf_css() {

		$style = '';

		// Footer Color Filter
		if( couponseek_get_field('footer_background_image', 'option') && couponseek_get_field('footer_color_opacity', 'option') > 0 ) :

			if ( couponseek_get_field('footer_filter_color', 'option') && couponseek_get_field('footer_color_opacity', 'option') > 0 ) {
				$filter_color = couponseek_get_field('footer_filter_color', 'option');
				$opacity = couponseek_get_field('footer_color_opacity', 'option') / 100;
				$style =  '.FOOTER .overlay-color {' .
				'opacity:' . esc_attr($opacity) . ';' .
				'background-color:' . esc_attr($filter_color) . ';' .
				' } ';
			}
		endif;

		$couponseek_inline_css[] = $style;
		
		wp_add_inline_style( 'couponseek_functionalities_custom-css', implode("\n\n", $couponseek_inline_css) );
	}
}

/**
*  ACF Sanitization
*/

add_filter('acf/update_value/type=wysiwyg', '_filter_couponseek_acf_update_value', 10, 3);

if( !function_exists('_filter_couponseek_acf_update_value') ) {

	function _filter_couponseek_acf_update_value( $value, $post_id, $field  )
	{
		return wp_kses_post($value);
	}

}


/**
*  Show One Field on ACF Flexible Content Collapse
*/

add_filter('acf/fields/flexible_content/layout_title/name=menu', '_filter_couponseek_acf_flexible_content_menu_titles', 10, 4);

if( !function_exists('_filter_couponseek_acf_flexible_content_menu_titles') ) {
	function _filter_couponseek_acf_flexible_content_menu_titles( $title, $field, $layout, $i ) {

		$title = '<span class="acf-fc-layout-title">' . $title;

		switch ( get_row_layout() ) {
			case 'menu_category':
				if( $category_name = couponseek_get_sub_field('category_name') ) {		
					$title .= ' &rArr; <i>' . $category_name . '</i>';
				}
				break;
			case 'image':
				if( $image = couponseek_get_sub_field('image') ) {		
					$title .= ' &rArr; ' . '<img src="' . $image['sizes']['thumbnail'] . '" height="32px" />';
				}
				break;
			default:
				break;
		}	

		$title .= '</span>';

		return $title;
		
	}

}

/**
*  ACF Page Header Saving
*/

add_action('acf/save_post', '_action_couponseek_save_page_header_posts', 20);
if( !( function_exists('_action_couponseek_save_page_header_posts')) ){	
	function _action_couponseek_save_page_header_posts($post_id) {

		if ( get_post_type($post_id) == 'ssd-page-header' ) {

				$page_headers = array();

				$args = array( 'post_type' => 'ssd-page-header');

				$page_header_query = new WP_Query( $args );
				while ( $page_header_query->have_posts() ) : $page_header_query->the_post();
					$page_headers[] = get_the_id();
				endwhile;

				update_option('ssd_page_header_ids', $page_headers);
		}

	}
}

/**
*  Add expiring date to product
*/

add_action('acf/save_post', '_action_couponseek_fill_empty_expiration_date_on_save', 99);
if ( !function_exists('_action_couponseek_fill_empty_expiration_date_on_save') ) {
	function _action_couponseek_fill_empty_expiration_date_on_save($post_id) {

		if ( get_post_type($post_id) != 'product' ) {
			return;
		}

		$expiring_date = trim(get_post_meta( $post_id, 'expiring_date', true ));

		if ( $expiring_date && $expiring_date != ''){
			update_post_meta($post_id, 'expiring_product', 'yes');
		} else {
			delete_post_meta($post_id, 'expiring_product');
		}
	}
}


add_action('after_switch_theme', '_action_couponseek_fill_empty_expiration_date_on_init', 99);
if( !( function_exists('_action_couponseek_fill_empty_expiration_date_on_init')) ){
	function _action_couponseek_fill_empty_expiration_date_on_init() {

		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1
		);

		$products = new WP_Query($args);

		if ($products->have_posts()) : while ($products->have_posts()) : $products->the_post();

			$expiring_date = get_post_meta( get_the_ID(), 'expiring_date', true );

			if ( $expiring_date && $expiring_date != ''){
				update_post_meta(get_the_ID(), 'expiring_product', 'yes');
			} else {
				delete_post_meta(get_the_ID(), 'expiring_product');
			}

		endwhile; endif;

		wp_reset_postdata();
		
	}
}


/**
*  Save Deals Availability on Theme Init
*/

if( !( function_exists('_action_couponseek_update_products_expire_date')) ){
	function _action_couponseek_update_products_expire_date() {

		if ( get_option('couponseek_update_products_expire_date_v2') != 'yes' ) {

			$args = array(
				'post_type' => 'product',
				'posts_per_page' => -1
			);

			$products = new WP_Query($args);

			if ($products->have_posts()) : 
				while ($products->have_posts()) : $products->the_post();

					$expiring_date = get_post_meta( get_the_ID(), 'expiring_date', true );

					if ( $expiring_date && $expiring_date != '' && strpos($expiring_date, '/')){
						$expiring_date_old = DateTime::createFromFormat('m/d/Y', $expiring_date);
						$expiring_date_new = $expiring_date_old->format('Ymd');
						update_post_meta(get_the_ID(), 'expiring_date', $expiring_date_new);
						update_field('field_5a607c5f0bd4e', $expiring_date_new, get_the_ID());
						do_action( 'acf/save_post', get_the_ID() );
					} else {
						update_field('field_5a607c5f0bd4e', $expiring_date, get_the_ID());
						$product_id = get_the_ID();
					}

				endwhile; 

					if ( isset($product_id) ) {
						do_action( 'acf/save_post',$product_id );
					}

			endif;

			wp_reset_postdata();

			update_option( 'couponseek_update_products_expire_date_v2', 'yes' );
		}
		
	}
}

add_action('init', '_action_couponseek_update_products_expire_date', 99);

/**
*  WooCommerce Single Product Location Tab
*/

add_action('woocommerce_before_elementor_slider_product', 'woocommerce_show_product_loop_sale_flash');

/**
*  WooCommerce Single Product Location Tab
*/

add_filter( 'woocommerce_product_tabs', '_filter_couponseek_wc_add_product_location_tab' );

if ( !function_exists('_filter_couponseek_wc_add_product_location_tab') ) {
	function _filter_couponseek_wc_add_product_location_tab( $tabs ) {

		if ( couponseek_get_field('show_location') != 'hide' && couponseek_get_field('location') ) {	
			$tabs['location'] = array(
				'title' 	=> __( 'Location', 'couponseek' ),
				'priority' 	=> 50,
				'callback' 	=> 'couponseek_product_location_tab_content'
			);
		}

		return $tabs;

	}
}


/**
*  WooCommerce Category Search
*/

add_filter('pre_get_posts', '_filter_couponseek_wc_category_search');

if ( !function_exists('_filter_couponseek_wc_category_search') ) {
	function _filter_couponseek_wc_category_search($query) {

		if ( $query->is_search() && isset($_GET['post_type']) && $_GET['post_type'] == 'product' ) {
			if (isset($_GET['product_category']) && !empty($_GET['product_category'])) {
				$query->set('tax_query', array(array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms' => array($_GET['product_category']) )
				));
			}
			$meta_query = array();
			if (isset($_GET['product_country']) && !empty($_GET['product_country'])) {
				$country_slug = sanitize_title($_GET['product_country']);
				$country_meta_query = array(
					array(
						'key' => 'geo_country_slug',
						'value'    => $country_slug,
						'compare' => '='
					),
				);
				array_push($meta_query, $country_meta_query);
				
			}
			if (isset($_GET['product_city']) && !empty($_GET['product_city'])) {
				$city_slug = sanitize_title($_GET['product_city']);
				$city_meta_query = array(
					'relation' => 'AND',
					array(
						'key' => 'geo_city_slug',
						'value'    => $city_slug,
						'compare' => '='
					),
				);

				array_push($meta_query, $city_meta_query);
			}
			if (isset($_GET['product_vendor']) && !empty($_GET['product_vendor'])) {
				$vendor_slug = sanitize_title($_GET['product_vendor']);
				$city_meta_query = array(
					'relation' => 'AND',
					array(
						'key' => 'wc_product_vendor',
						'value'    => $vendor_slug,
						'compare' => '='
					),
				);

				array_push($meta_query, $city_meta_query);
			}
			if ( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'expiring' ) {

				if( !is_admin() ) { 

					$expiring_meta_query = array(
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

					array_push($meta_query, $expiring_meta_query);

					$query->set('orderby', array( 
						'non_expiring_products' => 'DESC',
						'expiring_products' => 'ASC',
					));

				}
			}
			$query->set( 'meta_query', $meta_query );
		}
		return $query;
	}
}

/**
*  WooCommerce Search Results Title
*/

add_filter( 'woocommerce_page_title', '_filter_couponseek_wc_search_title' );

if ( !function_exists('_filter_couponseek_wc_search_title') ) {
	function _filter_couponseek_wc_search_title( $page_title ) {
		if ( is_search() ) {

			$all_countries = couponseek_get_all_countries();
			$all_locations = couponseek_get_all_locations();

			$page_title = wp_kses_post(__( 'Search Results ', 'couponseek' ));

			if ( !empty(get_search_query()) ) {
				/* translators: %s: search query */
				$page_title .= sprintf( wp_kses_post(__( 'For: <span>%s</span> ', 'couponseek' )), get_search_query() );
			}
			if ( isset($_GET['product_category']) && !empty($_GET['product_category']) ) {
				$product_category = get_term_by( 'slug', $_GET['product_category'], 'product_cat' );
				/* translators: %s: product category */
				$page_title .= sprintf( wp_kses_post(__( 'in <span>%s</span> ', 'couponseek' )), wp_kses_post($product_category->name) );
			}
			if ( isset($_GET['product_country']) && !empty($_GET['product_country']) ) {
				if ( isset($_GET['product_city']) && !empty($_GET['product_city']) ) {
					/* translators: %s: product city */
					$page_title .= sprintf( wp_kses_post(__( 'in <span>%s</span>', 'couponseek' )), wp_kses_post(stripslashes($all_locations[$_GET['product_country']][$_GET['product_city']]['name'])) );
					/* translators: %s: product country */
					$page_title .= sprintf( wp_kses_post(__( ', <span>%s</span> ', 'couponseek' )), wp_kses_post(stripslashes($all_countries[$_GET['product_country']]['name'])) );
				} else {
					$page_title .= sprintf( wp_kses_post(__( 'in <span>%s</span> ', 'couponseek' )), wp_kses_post(stripslashes($all_countries[$_GET['product_country']]['name'])) );
				}
			} else if ( isset($_GET['product_city']) && !empty($_GET['product_city']) ) {
				/* translators: %s: product city */
				$page_title .= sprintf( wp_kses_post(__( 'in <span>%s</span> ', 'couponseek' )), wp_kses_post(stripslashes($all_locations['all_cities'][$_GET['product_city']]['name'])) );
			}
			if ( isset($_GET['product_vendor']) && !empty($_GET['product_vendor']) ) {
				/* translators: %s: product vendor */
				$page_title .= sprintf( wp_kses_post(__( 'from <span>%s</span>', 'couponseek' )), wp_kses_post(stripslashes($_GET['product_vendor'])) );
			}

			if ( get_query_var( 'paged' ) ) {
				/* translators: %s: page number */
				$page_title .= sprintf( wp_kses_post(__( '&nbsp;&ndash; Page %s', 'couponseek')), get_query_var( 'paged' ) );
			}
		}
		return $page_title;
	}
}

/**
*  WC Vendors Shop Logo Custom Field
*/

add_action('wcvendors_settings_after_paypal', '_action_couponseek_wc_vendors_custom_fields');
if ( !function_exists('_action_couponseek_wc_vendors_custom_fields') ) {
	function _action_couponseek_wc_vendors_custom_fields() {
		$user = wp_get_current_user();
		$logo_id = couponseek_get_vendor_logo( $user->ID );
		if ( is_admin() ) : ?>
		<tr class="pv_shop_logo_wrapper">
			<th><label for="pv_shop_logo_id"><?php _e( 'Shop Logo', 'couponseek' ); ?></label></th>
			<td>
				<div class="is-ssd-upload-image-thumbnail">
					<?php echo wp_get_attachment_image($logo_id, 'couponseek_landscape_small');  ?>
				</div>
				<input name="pv_shop_logo_id" id="pv_shop_logo_id" type="file" accept="image/*" multiple="false">
				<a href="#" class="is-ssd-input-upload-remove-image" data-image-remove="pv_shop_logo_id"><?php esc_html_e('Remove Image', 'couponseek') ?></a>
			</td>
		</tr>
		<?php else : ?>
		<div class="pv_shop_logo_container">
			<p><b><?php _e( 'Shop Logo', 'couponseek' ); ?></b><br/>
				<div class="is-ssd-upload-image-thumbnail">
					<?php echo wp_get_attachment_image($logo_id, 'couponseek_landscape_small');  ?>
				</div>
				<input name="pv_shop_logo_id" id="pv_shop_logo_id" type="file" accept="image/*" multiple="false">
				<a href="#" class="is-ssd-input-upload-remove-image" data-image-remove="pv_shop_logo_id"><?php esc_html_e('Remove Image', 'couponseek') ?></a>
			</p>
		</div>
		<?php endif; ?>
		<?php
	}
}

add_action( 'wcvendors_admin_after_commission_due', '_action_couponseek_wc_vendors_admin_user_info' );
if ( !function_exists('_action_couponseek_wc_vendors_admin_user_info') ) {
	function _action_couponseek_wc_vendors_admin_user_info( $user ) {
		$logo_id = couponseek_get_vendor_logo( $user->ID );
		?>
		<tr class="pv_shop_logo_wrapper">
			<th><label for="pv_shop_logo_id"><?php _e( 'Shop Logo', 'couponseek' ); ?></label></th>
			<td>
				<div class="is-ssd-upload-image-thumbnail">
				<?php echo wp_get_attachment_image($logo_id, 'couponseek_landscape_small');  ?>
				</div>
				<input class="button is-ssd-upload-image-button" type="button" value="Upload Image" data-name="pv_shop_logo_id" />
				<a href="#" class="is-ssd-upload-remove-image" data-image-remove="pv_shop_logo_id"><?php esc_html_e('Remove Image', 'couponseek') ?></a>
				<input type="hidden" name="pv_shop_logo_id" value="<?php echo esc_attr( $logo_id ); ?>">
			</td>
		</tr>
		<?php
	}
}

add_action( 'wcvendors_shop_settings_saved', '_action_couponseek_wc_vendors_save_shop_logo' );
add_action( 'wcvendors_update_admin_user', '_action_couponseek_wc_vendors_save_shop_logo' );
add_action( 'wcvendors_shop_settings_admin_saved', '_action_couponseek_wc_vendors_save_shop_logo' );
if ( !function_exists('_action_couponseek_wc_vendors_save_shop_logo') ) {
	function _action_couponseek_wc_vendors_save_shop_logo( $user_id ) {
		if( ! empty( $_FILES ) ) {
			foreach( $_FILES as $file ) {
				if( is_array( $file ) ) {
					$shop_logo_id = couponseek_upload_user_file( $file );
					if ( $shop_logo_id ) {
						update_user_meta( $user_id, 'pv_shop_logo_id', $shop_logo_id );
						update_user_meta( $user_id, '_wcv_store_icon_id', $shop_logo_id );
					} else {
						update_user_meta( $user_id, 'pv_shop_logo_id', '' );
						update_user_meta( $user_id, '_wcv_store_icon_id', '' );
					}
				}
			}
		} else if ( ! empty( $_POST['pv_shop_logo_id'] ) ) {
			update_user_meta( $user_id, 'pv_shop_logo_id', $_POST['pv_shop_logo_id'] );
			update_user_meta( $user_id, '_wcv_store_icon_id', $_POST['pv_shop_logo_id'] );
		} else {
			update_user_meta( $user_id, 'pv_shop_logo_id', '' );
			update_user_meta( $user_id, '_wcv_store_icon_id', '' );
		}
	}
}


/**
*  Fix WC Vendors get_option('wcvendors_capability_product_type_options') warning
*/

add_filter( 'option_wcvendors_capability_product_type_options', '_filter_couponseek_wcvendors_capability_product_type_options' );
if ( !function_exists('_filter_couponseek_wcvendors_capability_product_type_options') ) {
	function _filter_couponseek_wcvendors_capability_product_type_options( $product_types ) {
        if ( is_string($product_types) ) {
        	$product_types = [$product_types];
        }
		return $product_types;
	}
}

/**
*  Fix WC Vendors get_option('wcvendors_capability_product_data_tabs') warning
*/

add_filter( 'option_wcvendors_capability_product_data_tabs', '_filter_couponseek_wcvendors_capability_product_data_tabs' );
if ( !function_exists('_filter_couponseek_wcvendors_capability_product_data_tabs') ) {
	function _filter_couponseek_wcvendors_capability_product_data_tabs( $product_panel ) {
        if ( is_string($product_panel) ) {
        	$product_panel = [$product_panel];
        }
		return $product_panel;
	}
}

/**
*  Make expired products Draft
*/

add_action( 'wp', '_action_couponseek_draft_expired_products_activation') ;

if( !function_exists( '_action_couponseek_draft_expired_products_activation' ) ) {
	function _action_couponseek_draft_expired_products_activation() {
		if ( couponseek_get_field('draft_expired_products_switch', 'option') ) {
			if ( !wp_next_scheduled( 'couponseek_draft_expired_products_event' ) ) {
				wp_schedule_event( time(), 'daily', 'couponseek_draft_expired_products_event' );
			}
		} else {
			wp_clear_scheduled_hook('couponseek_draft_expired_products_event');
		}
		
	}
}

add_action( 'couponseek_draft_expired_products_event', '_action_couponseek_draft_expired_products' );

if( !function_exists( '_action_couponseek_draft_expired_products' ) ) {
	function _action_couponseek_draft_expired_products() {

		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1,
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'expiring_date',
					'value' => date('Ymd'),
					'compare' => '<=',
					'type' => 'DATE'
				),
				array(
					'key' => 'expiring_product',
					'compare' => 'EXISTS'
				)
			)
		);


		$products_query = new WP_Query($args);


		if ($products_query->have_posts()) : while ($products_query->have_posts()) : $products_query->the_post();

			$current_post = array(
				'ID'           => get_the_ID(),
				'post_status'   => 'draft',
				);

			wp_update_post( $current_post );


		endwhile; endif;

		wp_reset_postdata();

	}
}



/**
*  AJAX show cities on Country Dropdown select
*/

add_action( 'wp_ajax_nopriv__action_couponseek_show_cities', '_action_couponseek_show_cities' );
add_action( 'wp_ajax__action_couponseek_show_cities', '_action_couponseek_show_cities' );

if( !( function_exists('_action_couponseek_show_cities')) ){
	function _action_couponseek_show_cities() {
		$hide_filters = (couponseek_get_field('hide_search_filters', 'option')) ? couponseek_get_field('hide_search_filters', 'option') : array();
		$product_country_slug = $_POST['country'] ?  sanitize_title($_POST['country']) : '';
		$product_city_slug = (isset($_POST['city'])) ?  sanitize_title($_POST['city']) : '';

		$cities = array();
		
		if( ( $all_locations = get_transient('ssd_all_locations') ) === false ) {	
			$all_locations = couponseek_get_all_locations();
			set_transient('ssd_all_locations', $all_locations, 0);
		}

		$html ='';

		// If cities are found create cities dropdown list
		if ( isset($_POST['has_countries']) && $_POST['has_countries'] == 'no' ) {
			$cities = $all_locations['all_cities'];
		} else if (isset($all_locations[$product_country_slug])) {
			$cities = $all_locations[$product_country_slug];
		}

		ksort($cities);

		if ( !empty($cities) ) {

			$cities_found = true;

			$html .= '<li><a href="javascript:void(0)" data-value="" data-current=""><span>' . esc_html__('All', 'couponseek') . '</span></a></li>';

			foreach ( $cities as $city ) {
				if ( $city['slug'] != '' && $city['slug'] ==  $product_city_slug ) {
					$current = 'true';
				} else {
					$current = 'false';
				}

				$html .= '<li><a href="javascript:void(0)" data-value="' . $city['slug'] . '" data-current="' . $current . '"><span>' . $city['name'] . '</span></a></li>';
			}

		} else {
			$cities_found = false;

			$html .= '<li><a href="javascript:void(0)" data-value="" data-current="true"><span>' . esc_html__('All', 'couponseek') . '</span></a></li>';
			$html .= '<a>' . esc_html__('Please select a country', 'couponseek') . '</a>';
		}

		$response = array(
			'html' => $html,
			'cities_found' => $cities_found
		);

		echo json_encode($response);


		die();
	}
}


/**
*  Widgets Init
*/

add_action('widgets_init', '_action_couponseek_widgets_init');

if ( ! function_exists( '_action_couponseek_widgets_init' ) ) {
	function _action_couponseek_widgets_init()  {
		
		$path = plugin_dir_path( __FILE__ ) . 'widgets';

		$included_widgets = array();

		$dirs = glob($path .'/*', GLOB_ONLYDIR);

		if (!$dirs) {
			return false;
		}

		foreach ($dirs as $dir) {
			$dirname = basename($dir);

			if (isset($included_widgets[$dirname])) {
				// this happens when a widget in child theme wants to overwrite the widget from parent theme
				continue;
			} else {
				$included_widgets[$dirname] = true;
			}

			require_once(plugin_dir_path( __FILE__ ) . 'widgets/' . $dirname . '/class-widget-'. $dirname .'.php');

			$class_name = explode('-', $dirname);
			$class_name = array_map('ucfirst', $class_name);
			$class_name = implode('_', $class_name);

			$widget_class = 'CouponSeek_Widget_' . $class_name;
			
			if ( class_exists( $widget_class ) ) {
				register_widget( $widget_class );
			}

		}
	}
}