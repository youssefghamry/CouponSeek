<?php if ( ! defined( 'ABSPATH' ) ) { die(); }
/**
 * Register menus
 */

register_nav_menus( array(
	'main-navigation'   => esc_html__( 'Main Menu', 'couponseek' ),
) );