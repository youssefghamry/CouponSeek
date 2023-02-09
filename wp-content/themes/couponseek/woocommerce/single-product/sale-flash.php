<?php
/**
 * Single Product Sale Flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;
$regular_price = get_post_meta( $product->get_id(), '_regular_price', true);
$sale_price = get_post_meta( $product->get_id(), '_sale_price', true);
?>
<?php if ( couponseek_get_field('ribbon') == 'text' && couponseek_get_field('ribbon_text') ) :
	echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . wp_kses_post(couponseek_get_field('ribbon_text')) . '</span>', $post, $product );

elseif ( (!couponseek_get_field('ribbon') || couponseek_get_field('ribbon') == 'discount') && $regular_price && $sale_price ) :
	echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">-' . ceil(100 * ($regular_price - $sale_price) / $regular_price) . '%' . '</span>', $post, $product );
endif;

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
