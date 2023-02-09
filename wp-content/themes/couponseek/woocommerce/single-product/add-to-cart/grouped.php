<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     5.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $post;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart grouped_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
	<div class="woocommerce-grouped-product-list group_table">
			<?php
			$quantites_required      = false;
			$previous_post           = $post;
			$grouped_product_columns = apply_filters( 'woocommerce_grouped_product_columns', array(
				'label',
				'price',
				'quantity',
			), $product );

			foreach ( $grouped_products as $grouped_product ) {
				$post_object        = get_post( $grouped_product->get_id() );
				$quantites_required = $quantites_required || ( $grouped_product->is_purchasable() && ! $grouped_product->has_options() );
				$post               = $post_object; // WPCS: override ok.
				setup_postdata( $post );

				echo '<div id="product-' . esc_attr( get_the_ID() ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', get_post_class() ) ) . '">';

				// Output columns for each product.
				foreach ( $grouped_product_columns as $column_id ) {
					do_action( 'woocommerce_grouped_product_list_before_' . $column_id, $grouped_product );

					switch ( $column_id ) {
						case 'quantity':
							ob_start();

							if ( ! $grouped_product->is_purchasable() || $grouped_product->has_options() || ! $grouped_product->is_in_stock() ) {
								woocommerce_template_loop_add_to_cart();
							} elseif ( $grouped_product->is_sold_individually() ) {
								echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
							} else {
								$expiring_date = couponseek_get_field('expiring_date', $grouped_product->get_id());
								if ( $expiring_date ) {
									$expiring_date_obj = new DateTime($expiring_date);

									if ( $expiring_date_obj < new DateTime('now') ) {
										$product_expired = true;
									} else {
										$product_expired = false;
									}
								} else {
									$product_expired = false;
								}

								if ($product_expired) {
									echo '<span class="expired-product">' . esc_html__('Expired!', 'couponseek') . '</span>';
								} else {

									do_action( 'woocommerce_before_add_to_cart_quantity' );

									woocommerce_quantity_input( array(
										'input_name'  => 'quantity[' . $grouped_product->get_id() . ']',
										'input_value' => isset( $_POST['quantity'][ $grouped_product->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $grouped_product->get_id() ] ) ) ) : 0, // WPCS: CSRF ok, input var okay, sanitization ok.
										'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product ),
										'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product->get_max_purchase_quantity(), $grouped_product ),
									) );

									do_action( 'woocommerce_after_add_to_cart_quantity' );

								}
							}

							$value = ob_get_clean();
							break;
						case 'label':
							if ( $grouped_product->is_visible() ) {
								$value = '';
								do_action('woocommerce_shop_loop_item_title');
							} else {
								$value  = '<label for="product-' . esc_attr( $grouped_product->get_id() ) . '">';
								$value .= $grouped_product->get_name();
								$value .= '</label>';
							}
							break;
						case 'price':
							$value = '<div class="price">'. $grouped_product->get_price_html() . '</div>' . wc_get_stock_html( $grouped_product );
							break;
						default:
							$value = '';
							break;
					}

					echo '<div class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( 'woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product ) . '</div>'; // WPCS: XSS ok.

					do_action( 'woocommerce_grouped_product_list_after_' . $column_id, $grouped_product );
				}

				echo '</div>';
			}
			$post = $previous_post; // WPCS: override ok.
			setup_postdata( $post );
			?>
	</div>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

	<?php if ( $quantites_required ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
