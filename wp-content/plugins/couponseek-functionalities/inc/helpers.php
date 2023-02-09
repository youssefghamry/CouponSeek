<?php if ( ! defined( 'ABSPATH' ) ) { die(); }
/**
 * Helper functions and classes with static methods for usage in theme
 */

/**
* ----------------------------------------------------------------------------------------
*    ACF
* ----------------------------------------------------------------------------------------
*/

/**
 * Return a custom field stored by the Advanced Custom Fields plugin 
 */

if ( !function_exists( 'couponseek_get_field' ) ) {
	function couponseek_get_field( $key, $id=false, $default='' ) {
		global $post;
		$key = trim( filter_var( $key, FILTER_SANITIZE_STRING ) );
		$result = '';

		if ( function_exists( 'get_field' ) ) {

			if ( isset( $post->ID ) && !$id )
				$field_object = get_field_object($key) ;
			else
				$field_object = get_field_object($key, $id );

			if ( isset( $post->ID ) && !$id )
				$result = get_field( $key );
			else
				$result = get_field( $key, $id );

			if ( $result == '' ) // If ACF enabled but key is undefined, return default
				$result = $default;

		} else {
			$result = $default;
		}
		return $result;
	}
}

if ( !function_exists( 'couponseek_the_field' ) ) {
	function couponseek_the_field( $key, $id=false, $default='' ) {

		$value = couponseek_get_field($key, $id, $default);

		if( is_array($value) ) {

			$value = @implode( ', ', $value );

		}

		echo $value;
	}
}

if ( !function_exists( 'couponseek_get_sub_field' ) ) {
	function couponseek_get_sub_field( $key, $default='' ) {
		if ( function_exists( 'get_sub_field' ) &&  get_sub_field( $key ) )  
			return get_sub_field( $key );
		else 
			return $default;
	}
}

if ( !function_exists( 'couponseek_the_sub_field' ) ) {
	function couponseek_the_sub_field( $key, $default='' ) {
		$value = couponseek_get_sub_field( $key, $default );
		echo $value;
	}
}

if ( !function_exists( 'couponseek_has_sub_field' ) ) {
	function couponseek_has_sub_field( $key, $id=false ) {
		if ( function_exists('has_sub_field') )
			return has_sub_field( $key, $id );
		else
			return false;
	}
}

if ( !function_exists( 'couponseek_have_rows' ) ) {
	function couponseek_have_rows( $key, $id=false ) {
		if ( function_exists('have_rows') )
			return have_rows( $key, $id );
		else
			return false;
	}
}


/**
 *  Populate an array with IDs and Titles of posts
 */

if ( !function_exists( 'couponseek_get_post_names' ) ) {
	function couponseek_get_post_names($post_type = null) {

		global $post;

		$original_post = $post;

		$array = array();

		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => -1
			);

		if ( post_type_exists($post_type) ) {

			$the_query = new WP_Query($args);

			if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

			$array[get_the_ID()] = get_the_title();

			endwhile; endif;

			wp_reset_postdata();

			$post = $original_post;
			unset($original_post);

		} else {
			$array['no-such-post-type'] = sprintf('There is no %s post type detected.', $post_type);
		}

		return $array;
	}	
}


/**
 *  Populate an array with IDs and Titles of taxonomies
 */

if ( !function_exists( 'couponseek_get_term_names' ) ) {
	function couponseek_get_term_names($taxonomy = null, $select_none = false) {

		$array = array();

		if ( $select_none ) {
			$array[0] = esc_html__('None', 'couponseek');
		}

		$args = array(
			'hide_empty' => false
			);

		$terms = get_terms( $taxonomy, $args );

		if ( !empty( $terms ) && ! is_wp_error( $terms ) ){

			foreach ($terms as $term) {
				$array[$term->term_id] = $term->name;
			}

		} else if ( empty( $terms ) ) {
			$array['no-such-taxonomy'] = sprintf(esc_html__('No items in %s taxonomy.', 'couponseek'), $taxonomy);
		} else {
			$array['no-such-taxonomy'] = sprintf(esc_html__('There is no %s taxonomy detected. Please install the corresponding plugin.', 'couponseek'), $taxonomy);
		}

		return $array;
	}
}


/**
 *  Populate an array with WC Vendors
*/

if ( !function_exists( 'couponseek_get_wc_vendors' ) ) {
	function couponseek_get_wc_vendors() {

		if ( class_exists('WC_Vendors') ) {

			$array = array();
			$vendors = get_users( [ 'role' => [ 'vendor'] ] );

			if ( !empty( $vendors ) ){
				foreach ($vendors as $vendor) {
					$vendor_id = $vendor->data->ID;
					$shop_name =  get_user_meta( $vendor_id, 'pv_shop_name', true );
					if ( $shop_name ) {
						$array[$vendor_id] = $shop_name;
					}
				}
			} else {
				$array['no-such-taxonomy'] = sprintf(esc_html__('No vendors found.', 'couponseek'));
			}

		} else {
			$array['no-wc-vendors'] = sprintf(esc_html__('No Vendors detected. Please install the WC Vendors plugin.', 'couponseek'));
		}

		return $array;
	}
}


/**
 *  Get Vendor Logo
*/
if( !function_exists( 'couponseek_get_vendor_logo' ) ) {
	function couponseek_get_vendor_logo($vendor_id){
		$logo_id = false;
		if ( defined('WCV_PRO_VERSION') ) {
			$logo_id = get_user_meta( $vendor_id, '_wcv_store_icon_id', true );
		}
		if ( !$logo_id ) {
			$logo_id = get_user_meta( $vendor_id, 'pv_shop_logo_id', true );
		}

		return $logo_id;
	}
}

/**
 *  Print typography CSS
 */

if ( !function_exists( 'couponseek_typography_css' ) ) {
	function couponseek_typography_css($field) {

		$output = '';
		$pattern = '/(\d+)|(regular|italic)/i';


		if ( isset($field['family']) ) {
			$output .= 'font-family: ' . $field['family'] . ';';
			$output .= "\r\n";
		}

		return $output;

	}
}

/**
*  WooCommerce Single Product Location Tab
*/

if ( !function_exists('couponseek_product_location_tab_content') ) {
	function couponseek_product_location_tab_content() {

		// The new tab content
		if ( couponseek_get_field('show_location') != 'hide' && couponseek_get_field('location') ) : ?>
			<?php 
				$location = couponseek_get_field('location');
				$marker_atts = '';
				$marker_image_url = '';
				if ( couponseek_get_field('deal_location_marker', 'option') ) {
					$marker_image = couponseek_get_field('deal_location_marker', 'option');
					$marker_image_url = $marker_image['url'];
					$marker_atts = 'data-image="' . esc_url($marker_image['url']) .'"';
				}
			?>
			<h2><?php esc_html_e('Location','couponseek'); ?></h2>
			<?php 

			$google_api = false;
			if ( couponseek_get_field('google_api_restricted', 'option') ) {
				$google_api = couponseek_get_field('google_api_http', 'option');
			} else {
				$google_api = couponseek_get_field('google_api', 'option');
			}

			if ( $google_api ) : ?>
				<p><?php echo wp_kses_post($location['address']); ?></p>
				<div class="is-google-map" data-gmap-zoom="<?php echo esc_attr(couponseek_get_field('map_zoom')); ?>" data-gmap-lat="<?php echo esc_attr($location['lat']); ?>" data-gmap-lng="<?php echo esc_attr($location['lng']); ?>" data-gmap-marker="<?php echo esc_attr($marker_image_url); ?>">
			<?php endif; ?>
			</div>
		<?php endif;
		
	}
}

/**
*  Save Geolocation Field
*/

if( !function_exists( 'couponseek_save_post_geolocation' ) ) {
	function couponseek_save_post_geolocation($post_id) {
		$show_location = couponseek_get_field('show_location', $post_id);
		$location = couponseek_get_field('location', $post_id);

		if ( $location && $show_location == 'show' ) {
			
			$geolocation = $location['lat'] . ',' . $location['lng'];

			$apikey = '';
			if ( couponseek_get_field('google_api_restricted', 'option') ) {
				$apikey = couponseek_get_field('google_api_ip', 'option');
			} else {
				$apikey = couponseek_get_field('google_api', 'option');
			}

			$request = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $geolocation.'&key=' . $apikey; 
			$file_contents = wp_remote_fopen(trim($request));
			$json_decode = json_decode($file_contents);

			if ( isset($json_decode->error_message) ) {
				update_option('show_google_maps_api_error', true);
			}

			if(isset($json_decode->results[0])) {
				$response = array();
				foreach($json_decode->results[0]->address_components as $addressComponet) {
					if( in_array('political', $addressComponet->types, true) && 
						in_array('locality', $addressComponet->types, true) && 
						!in_array('sublocality', $addressComponet->types, true) && 
						!in_array('ward', $addressComponet->types, true) && 
						!in_array('neighborhood', $addressComponet->types, true) ) {
						$response[] = $addressComponet->long_name; 
					} elseif ( in_array('political', $addressComponet->types) && 
						!in_array('sublocality', $addressComponet->types, true) ) {
						$response[] = $addressComponet->long_name; 
					}
				}

				foreach( $json_decode->results as $result ) {
					if ( in_array('political', $result->types, true) && 
						in_array('sublocality', $result->types, true) ) {
						foreach ($result->address_components as $address_component) {
							if ( in_array('locality', $address_component->types, true) &&
							in_array('political', $address_component->types, true) ) {
								$locality = $address_component->long_name;
							}
						}
					} else if ( in_array('postal_code', $result->types, true) ) {
						foreach ($result->address_components as $address_component) {
							if ( in_array('locality', $address_component->types, true) &&
							in_array('political', $address_component->types, true) ) {
								$postal_code = $address_component->long_name;
							}
						}
					}  else if ( in_array('political', $result->types, true) && 
						in_array('locality', $result->types, true) && 
						!in_array('sublocality', $result->types, true) && 
						!in_array('ward', $result->types, true) && 
						!in_array('neighborhood', $result->types, true) ) {

						foreach ($result->address_components as $address_component) {
							if ( in_array('administrative_area_level_1', $address_component->types, true) ) {
								$administrative_area_level_1 = $address_component->long_name;
							}
							if ( in_array('administrative_area_level_2', $address_component->types, true) ) {
								$administrative_area_level_2 = $address_component->long_name;
							}
							if ( in_array('administrative_area_level_3', $address_component->types, true) ) {
								$administrative_area_level_3 = $address_component->long_name;
							}
							if ( in_array('postal_town', $address_component->types, true) ) {
								$postal_town = $address_component->long_name;
							}
						}
					}
				}

				$geo_meta['city'] = '';
				if ( isset($locality) ) {
					$geo_meta['city'] = $locality;
				} else if ( isset($postal_town) ) {
					$geo_meta['city'] = $postal_town;
				} else if ( isset($postal_code) ) {
					$geo_meta['city'] = $postal_code;
				} else if ( isset($administrative_area_level_3 ) ) {
					$geo_meta['city'] = $administrative_area_level_3;
				} else if ( isset($administrative_area_level_2 ) ) {
					$geo_meta['city'] = $administrative_area_level_2;
				} else if ( isset($administrative_area_level_1 ) ) {
					$geo_meta['city'] = $administrative_area_level_1;
				}

				if(isset($response[0])){ $first  =  $response[0];  } else { $first  = 'null'; }
				if(isset($response[1])){ $second =  $response[1];  } else { $second = 'null'; } 
				if(isset($response[2])){ $third  =  $response[2];  } else { $third  = 'null'; }
				if(isset($response[3])){ $fourth =  $response[3];  } else { $fourth = 'null'; }
				if(isset($response[4])){ $fifth  =  $response[4];  } else { $fifth  = 'null'; }
				if(isset($response[5])){ $sixth  =  $response[5];  } else { $sixth  = 'null'; }

				if( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null' && $sixth != 'null' ) {
					$geo_meta['country'] = $sixth;
				}
				else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null'  && $sixth == 'null') {
					$geo_meta['country'] = $fifth;
				}
				else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth == 'null'  && $sixth == 'null') {
					$geo_meta['country'] = $fourth;
				}
				else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth == 'null' && $fifth == 'null' && $sixth == 'null') {
					$geo_meta['country'] = $third;
				}
				else if ( $first != 'null' && $second != 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  && $sixth == 'null') {
					$geo_meta['country'] = $second;
				}
				else if ( $first != 'null' && $second == 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  && $sixth == 'null') {
					$geo_meta['country'] = $first;
				} else {
					$geo_meta['country'] = $fifth;
				}
			}

			if ( isset($geo_meta) ) {
				update_post_meta($post_id, 'geo_city', wp_kses_post($geo_meta['city']));
				update_post_meta($post_id, 'geo_city_slug', sanitize_title($geo_meta['city']));
				update_post_meta($post_id, 'geo_country', wp_kses_post($geo_meta['country']));
				update_post_meta($post_id, 'geo_country_slug', sanitize_title($geo_meta['country']));
			}
			
		} else { 
			update_post_meta($post_id, 'geo_city', '');
			update_post_meta($post_id, 'geo_city_slug', '');
			update_post_meta($post_id, 'geo_country', '');
			update_post_meta($post_id, 'geo_country_slug', '');
		} 

		// if ( isset($geo_meta) ){ 
			// log_it($geo_meta);
			// log_it($json_decode->results);
		// }
		
	}	
}


/**
*  Get All Countries
*/

if( !function_exists( 'couponseek_get_all_countries' ) ) {
	function couponseek_get_all_countries(){

		$all_countries = array();

		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1
			);

		$deals_query = new WP_Query($args);

		if ($deals_query->have_posts()) : while ($deals_query->have_posts()) : $deals_query->the_post();

			$post_country_slug = get_post_meta(get_the_ID(), 'geo_country_slug');

			if ($post_country_slug ) {
				$post_country_slug = $post_country_slug[0];
			}
			$post_country = get_post_meta(get_the_ID(), 'geo_country');
			if ($post_country ) {
				$post_country = $post_country[0];
			}

			if (  $post_country_slug && !in_array($post_country_slug, $all_countries)  ) {
				$all_countries[$post_country_slug]['name'] = $post_country;
				$all_countries[$post_country_slug]['slug'] = $post_country_slug;
			}
		
		endwhile;
		wp_reset_postdata();
		endif;

		return $all_countries;
	}
}

/**
*  Get All Locations
*/
if( !function_exists( 'couponseek_get_all_locations' ) ) {
	function couponseek_get_all_locations(){

		$all_locations = array();
		$all_countries = couponseek_get_all_countries();

		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1
			);

		$deals_query = new WP_Query($args);

		if ($deals_query->have_posts()) : while ($deals_query->have_posts()) : $deals_query->the_post();

		$post_country_slug = get_post_meta(get_the_ID(), 'geo_country_slug');
		if ($post_country_slug ) {
			$post_country_slug = $post_country_slug[0];
		}

		$post_city_slug = get_post_meta(get_the_ID(), 'geo_city_slug');


		if ( !empty($post_city_slug) ) {
			$post_city_slug = $post_city_slug[0];
		} else {
			$post_city_slug = '';
		}

		$post_city = get_post_meta(get_the_ID(), 'geo_city');
		if ($post_city ) {
			$post_city = $post_city[0];
		}

		$current_city = array(
			'name' => $post_city,
			'slug' => $post_city_slug,
			);

		if ( $post_country_slug && !isset($all_locations[$post_country_slug]) ) {
			$all_locations[$post_country_slug] = array();
		}

		if (  $post_country_slug && !array_key_exists($post_city_slug, $all_locations[$post_country_slug])  ) {

			$all_locations[$post_country_slug][$post_city_slug] = $current_city;

		}

		if ( !isset($all_locations['all_cities']) ) {
			$all_locations['all_cities'] = array();
		}
		
		if ( $post_city_slug && !array_key_exists($post_city_slug, $all_locations['all_cities'])  ) {

			$all_locations['all_cities'][$post_city_slug] = $current_city;

		}

		endwhile;
		wp_reset_postdata();
		endif;

		return $all_locations;
	}
}


/**
*  Custom Exceprt Size
*/
if( !function_exists( 'couponseek_custom_excerpt_size' ) ) {
	function couponseek_custom_excerpt_size($limit) {
		return wp_trim_words(get_the_excerpt(), $limit, '...');
	}
}

/**
*  Upload Front End Image
*/
if( !function_exists( 'couponseek_upload_user_file' ) ) {
    function couponseek_upload_user_file( $file = array() ) {
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        if ( !empty($_FILES) ) {
            foreach ($_FILES as $key => $value) {
                $file_id = $key;
                $attachment_id = media_handle_upload($file_id, 0);
            }
            if ( is_int( $attachment_id ) ) {
                return $attachment_id;
            }
        }
        return false;
    }
}
