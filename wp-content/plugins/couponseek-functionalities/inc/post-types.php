<?php if ( ! defined( 'ABSPATH' ) ) { die( ); }

/**
*  Page Header Post Type
*/
add_action( 'init', '_action_couponseek_register_page_header_post_type' );

if( !( function_exists('_action_couponseek_register_page_header_post_type')) ){	
	function _action_couponseek_register_page_header_post_type($post_id) {

	
		$labels = array(
			'name' => __( 'Page Header', 'couponseek' ),
			'singular_name' => __( 'Page Header', 'couponseek' ),
			'all_items' => __( 'All Page Headers', 'couponseek' ),
			'add_new' => __( 'Add New', 'couponseek' ),
			'add_new_item' => __( 'Add New Page Header', 'couponseek' ),
			'edit_item' => __( 'Edit Page Header', 'couponseek' ),
			'new_item' => __( 'New Page Header', 'couponseek' ),
			'view_item' => __( 'View Page Header', 'couponseek' ),
			'search_items' => __( 'Search Page Headers', 'couponseek' ),
			'not_found' => __( 'No Page Headers found', 'couponseek' ),
			'not_found_in_trash' => __( 'No Page Headers found in Trash', 'couponseek' ),
			'parent_item_colon' => __( 'Parent Page Header:', 'couponseek' ),
			'menu_name' => __( 'Page Headers', 'couponseek' ),
			);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'exclude_from_search' => true,
			'show_in_nav_menus'   => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'hierarchical'        => false,
			'menu_position'       => null,
			'supports'            => array('title','editor', 'page-attributes'),
			'has_archive'         => false,
			'rewrite'            => array( 'slug' => 'page_header' ),
			);

		register_post_type( 'ssd-page-header', $args );

	}
}