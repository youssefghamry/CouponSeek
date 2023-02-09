<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 5.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php post_class(); ?>>
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<?php 
		$additional_classes = '';
		$additional_classes .= (couponseek_get_field('expiring_date')) ? ' product-has-expiration' : '';
		$image_id = $product->get_image_id();
		$additional_classes .= (!$image_id) ? ' product-no-image' : '';
	?>

		<?php 
		$link_class = 'woocommerce-product-image';

		if ( !$image_id ) {
			$link_class .= ' woocommerce-no-image';
		}

		$external_url = couponseek_is_product_external_popup();

		if ( $external_url ) :
			$discount_code = (couponseek_get_field('discount_code')) ? couponseek_get_field('discount_code') : '';
			if ( $discount_code != '' ) : ?>
				<a href="<?php echo esc_url($external_url) ?>" class="<?php echo esc_attr($link_class); ?> is-show-coupon-code" data-target="#external-product-modal-<?php echo get_the_ID() ?>" data-clipboard-text="<?php echo esc_attr($discount_code); ?>">
			<?php else : ?>
				<a href="<?php echo esc_url($external_url) ?>" class="<?php echo esc_attr($link_class); ?>">
			<?php endif; ?>
		<?php else : ?>
			<a href="<?php echo esc_url(get_the_permalink()) ?>" class="<?php echo esc_attr($link_class); ?>">
		<?php endif; ?>

		<?php
		/**
		 * woocommerce_before_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );

		
	?>

	</a><!-- end woocommerce-product-image -->

		
	<div class="woocommerce-product-meta<?php echo esc_attr($additional_classes); ?>">

		<?php
		/**
		 * woocommerce_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );

		/**
		 * woocommerce_after_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */

		do_action( 'woocommerce_after_shop_loop_item_title' ); ?>


	</div><!-- end woocommerce-product-meta -->

	<?php	

	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' ); 
	?>
</li>
