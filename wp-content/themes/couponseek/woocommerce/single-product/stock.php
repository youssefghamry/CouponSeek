<?php
/**
 * Single Product stock.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/stock.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product-quantity-meta">
	<div class="product-quantity-meta-item quantity-meta-stock">
		<div class="product-quantity-meta-icon">
			<svg viewBox="0 0 100 100" class="icon-svg">
				<use xlink:href="#icon-svg-box"></use>
			</svg>
		</div>
		<div class="quantity-meta-wrapper">
			<div class="quantity-meta-text"><?php esc_html_e('Available', 'couponseek'); ?></div>
			<span class="quantity-meta-value"><?php echo wp_kses_post( $availability ); ?></span>
		</div>
	</div>
	<?php if ( $product->get_total_sales() ) : ?>
		<div class="product-quantity-meta-item quantity-meta-sales">
			<div class="product-quantity-meta-icon">
				<svg viewBox="0 0 100 100" class="icon-svg">
					<use xlink:href="#icon-svg-wallet"></use>
				</svg>
			</div>
			<div class="quantity-meta-wrapper">
				<div class="quantity-meta-text"><?php esc_html_e('Purchased', 'couponseek'); ?></div>
				<span class="quantity-meta-value"><?php echo wp_kses_post($product->get_total_sales()); ?></span>
			</div>
		</div>
	<?php endif; ?>
</div><!-- end single-product-quantity-counters -->
