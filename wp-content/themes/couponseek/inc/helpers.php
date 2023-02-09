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

if ( !function_exists( 'couponseek_get_sub_field' ) ) {
	function couponseek_get_sub_field( $key, $default='' ) {
		if ( function_exists( 'get_sub_field' ) &&  get_sub_field( $key ) )  
			return get_sub_field( $key );
		else 
			return $default;
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
* ----------------------------------------------------------------------------------------
*    DEBUG FUNCTIONS
* ----------------------------------------------------------------------------------------
*/

if(!function_exists('log_it')){
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


/**
* ----------------------------------------------------------------------------------------
*    Theme
* ----------------------------------------------------------------------------------------
*/

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
*  Generating Isotope Category Names
*/

if ( !function_exists( 'couponseek_isotope_categories' ) ) {
	function couponseek_isotope_categories($value){
		return 'isotope-category-' . $value;
	}
}


/**
*  Prev / Next Pagination
*/

if ( ! function_exists( 'couponseek_paging_nav' ) ) : 
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */ 
{
	function couponseek_paging_nav( $wp_query = null ) {

		if ( ! $wp_query ) {
			$wp_query = $GLOBALS['wp_query'];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link,
			'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%',
			'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( '&larr; Previous', 'couponseek' ),
			'next_text' => esc_html__( 'Next &rarr;', 'couponseek' ),
			) );

		if ( $links ) :

			?>
		<nav class="navigation paging-navigation" role="navigation">
			<div class="posts-pagination loop-pagination">
				<?php echo esc_html($links); ?>
			</div>
			<!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	}
}
endif;

/**
*  Get Parent Blog
*/

if( !function_exists( 'couponseek_parent_blog_id' ) ) {
	function couponseek_parent_blog_id() {

		$args = array(
			'post_type' => 'page',
			'posts_per_page' => -1,
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'template-blog.php'
		);


		$blog_query = new WP_Query($args);

		$found = false;

		if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post();

			$found = true;
			$blog_id = get_the_ID();

		endwhile; endif;

		wp_reset_postdata();

		if ( isset($blog_id) ) {
			return $blog_id;
		} else {
			return false;
		}

	}
}


/**
*  Get Parent Events
*/

if( !function_exists( 'couponseek_parent_events_id' ) ) {
	function couponseek_parent_events_id() {

		$args = array(
			'post_type' => 'page',
			'posts_per_page' => -1,
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'template-events.php'
		);


		$events_query = new WP_Query($args);

		$found = false;

		if ($events_query->have_posts()) {

			foreach ($events_query->get_posts() as $p) {

				$found = true;
				$events_id = $p->ID;
			}

		}

		wp_reset_postdata();

		if ( isset($events_id) ) {
			return $events_id;
		} else {
			return false;
		}

	}
}

/**
*  Single Event Navigation
*/

if( !function_exists( 'couponseek_single_event_nav' ) ) {

	function couponseek_single_event_nav($parent_events_id){
		?>
		<div class="single-event-nav">
			<div class="spn-offset"></div>
			<a href="<?php echo get_permalink($parent_events_id) ;?>" class="back-to-portfolio"><i class="fa fa-th-large"></i></a>
		</div>
	<?php
	}
}


/**
*  Comments
*/

if ( !function_exists( 'couponseek_comments' ) ) {
	function couponseek_comments($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<article class="comment-content">
				<div class="">
					<div class="comment-left">
						<figure class="comment-avatar">
							<?php
							$avatar_size = 50;
							echo get_avatar($comment, $avatar_size); ?>
						</figure>

					</div><!-- end media-left -->
					<div class="comment-body">
						<header class="comment-header">

							<h5 class="comment-author"><?php comment_author_link(); ?></h5>
							<span class="comment-meta"><?php comment_date(); ?> - <?php comment_time(); ?><?php edit_comment_link(esc_html__('[Edit]', 'couponseek'),'  ','') ?><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
						</header>
						<div class="comment-main-content">
							<?php if ( $comment->comment_approved == 0 ) : ?>

								<p class="awaiting-moderation alert"><?php esc_html_e('Your comment is awaiting moderation', 'couponseek'); ?></p>

							<?php endif; ?>

							<?php comment_text(); ?>
						</div>

					</div><!-- end media-body -->
				</div><!-- end media -->
				
			</article>

		<?php

	}
}


/**
*  Popular Blog Posts
*/

if ( !function_exists( 'couponseek_count_post_views' ) ) {
	function couponseek_count_post_views($postID) {
		$count_key = 'couponseek_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if ( $count=='' ) {
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		} else {
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
}


/**
*  Callbacks
*/

if ( !function_exists( 'couponseek_list_pings' ) ) {
	function couponseek_list_pings($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class('pingback'); ?> id="comment-<?php comment_ID() ?>">
			<article class="comment-content">
				<header class="ping-header">
					<span class="comment-author"><?php _e('Pingback:', 'couponseek'); ?></h5>
				</header>
				<span class="comment-meta"><?php edit_comment_link(__('[Edit]', 'couponseek'),'  ','') ?></span>
				<?php comment_author_link(); ?>
			</article>
		</li>
		<?php
	}
}

/**
 * Checks if the required plugin is active in network or single site.
 *
 * @param $plugin
 *
 * @return bool
 */

if( !function_exists( 'couponseek_queryloop_is_active' ) ) {
	function couponseek_queryloop_is_active( $plugin ) {
		$network_active = false;
		if ( is_multisite() ) {
			$plugins = get_site_option( 'active_sitewide_plugins' );
			if ( isset( $plugins[$plugin] ) ) {
				$network_active = true;
			}
		}
		return in_array( $plugin, get_option( 'active_plugins' ) ) || $network_active;
	}
}

/**
 * Check if WooCommerce is activated
 */

if( !function_exists( 'couponseek_woocommerce' ) ) {
	function couponseek_woocommerce() {

		if ( !defined( 'WC_ABSPATH' ) ) {
			return false;
		}

		if ( couponseek_queryloop_is_active( 'woocommerce/woocommerce.php' ) || class_exists( 'WooCommerce' ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
*  Get Current Page URL
*/
if ( ! function_exists( 'couponseek_get_current_page_url' ) ) {
	function couponseek_get_current_page_url() {
		global $wp;
		// return add_query_arg( filter_input(INPUT_SERVER, 'QUERY_STRING', FILTER_SANITIZE_STRING), '', home_url( $wp->request ) );
		return add_query_arg( $wp->query_vars, home_url( $wp->request ));
	}
}

/**
 * Run Show "Only One Event Page Template" Error Notice Action
 */

if( !function_exists( 'couponseek_activate_events_template_error_action' ) ) {
	function couponseek_activate_events_template_error_action(){
		add_action( 'admin_notices', '_action_couponseek_show_events_template_error_notice' );
    }
}

/**
*  Check if WooCommerce Product External Popup Shown
*/
if( !function_exists( 'couponseek_is_product_external_popup' ) ) {
	function couponseek_is_product_external_popup() {
		if ( couponseek_woocommerce() && couponseek_get_field('show_deal_popups', 'option') ) {
			global $post;
			$product = wc_get_product($post->ID);

			if( $product instanceof WC_Product_External ) {
				if ( $product->get_product_url() ) {
					$external_url = $product->get_product_url();
					return $external_url;
				}
			}
		}
		return false;
	}
}

/**
*  Check if WooCommerce has Expired
*/
if( !function_exists( 'couponseek_has_product_expired' ) ) {
	function couponseek_has_product_expired($product) {

		$expiring_date = couponseek_get_field('expiring_date', $product->get_ID());

		if ( !$expiring_date ) {
			return;
		}

		$expiring_date_obj = new DateTime($expiring_date);

		if ( $expiring_date_obj < new DateTime('now') ) {
			return true;
		} else {
			return false;
		}
	}
}