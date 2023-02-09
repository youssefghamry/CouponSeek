<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
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
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="single-product-price">
	<?php if ( $product->get_price() ) : ?>
		<div class="price-text"><?php echo wp_kses_post($product->get_price_html()); ?></div>
	<?php else : ?>
		<div class="price-text price-text-free">
			<div class="price-text-meta-item font-heading">
				<div class="price-text-meta-item-name "><?php echo esc_html__('Price', 'couponseek'); ?></div>
				<?php echo esc_html__('Free', 'couponseek'); ?>
			</div>
		</div>
	<?php endif; ?>
</div>
