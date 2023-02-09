<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     5.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>

	<div class="row">

		<div class="col-sm-12 col-md-4 col-lg-4 col-md-push-8 hidden-sm hidden-xs">
			
			<div class="single-product-summary">

				<?php
					/**
					 * woocommerce_single_product_summary hook.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>

			<?php if ( function_exists( 'couponseek_social_share_buttons' ) ) : ?>
			<div class="SingleProductShare mt-40 mb-20">
				<div class="single-product-share-container">
					<?php 
					couponseek_social_share_buttons();
					?>
				</div>
			</div><!-- end single-deal-share -->
			<?php endif; ?>

			</div><!-- .summary -->
			<?php 
			if ( class_exists('WCV_Vendors') ) : 

				$vendor_id = WCV_Vendors::get_vendor_from_product(get_the_ID());
				$vendor = (get_userdata($vendor_id));
				$shop_name =  get_user_meta( $vendor_id, 'pv_shop_name', true );

				if ( $shop_name ) :
				?>
				<div class="single-product-company-summary">

						<?php
						$logo_id = couponseek_get_vendor_logo( $vendor_id);
						if ( $logo_id && wp_get_attachment_url($logo_id) ) : ?>
							<div class="single-product-company-logo">
								<a href="<?php echo WCV_Vendors::get_vendor_shop_page( $vendor_id ); ?>"><?php echo wp_get_attachment_image($logo_id, 'couponseek_medium_soft');  ?></a>
							</div>
						<?php endif ?>
						<div class="single-product-company-title">
							<h5><a href="<?php echo WCV_Vendors::get_vendor_shop_page( $vendor_id ); ?>"><?php echo wp_kses_post($shop_name); ?></a></h5>
						</div>
						<div class="single-product-company-description">
							<?php 
							$seller_info = get_user_meta( $vendor_id, 'pv_seller_info', true );
							echo do_shortcode( $seller_info );
							?>
						</div>
						
				</div><!-- .single-product-company-summary -->
				<?php endif; ?>
			<?php endif; ?>
		</div> <!-- end col-sm-12 col-md-5 col-lg-4 -->
		<div class="col-sm-12 col-md-8 col-lg-8 col-md-pull-4">
			<div class="SingleProductHeader mb-60">
			<?php
				/**
				 * woocommerce_before_single_product_summary hook.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
				<?php if ( couponseek_get_field('expiring_date') ) : 

				$expiring_date = couponseek_get_field('expiring_date');

				$expiring_date_obj = new DateTime($expiring_date);

				if ( $expiring_date_obj < new DateTime('now') ) {
					$product_expired = true;
				} else {
					$product_expired = false;
				}

				$expiring_date = DateTime::createFromFormat('Ymd', couponseek_get_field('expiring_date'));
				$expiring_date_formatted = $expiring_date->format('m/d/Y');
				?>

				<div class="single-product-expiration <?php echo esc_attr($product_expired ? 'single-product-expiration-expired' : '') ?>">
					<div class="expiration-meta"><?php esc_html_e('Expires In:', 'couponseek'); ?></div>
					<div class="is-jscountdown" data-time="<?php echo esc_attr($expiring_date_formatted ) ?>"></div>
				</div><!-- end single-product-expiration -->

				<?php endif; ?>
			</div><!-- end SingleProductHeader -->
		</div> <!-- end col-sm-12 col-md-8 col-lg-8 -->
		<div class="col-sm-12 col-md-4 col-lg-4 hidden-md hidden-lg">
			
			<div class="single-product-summary">

				<?php
					/**
					 * woocommerce_single_product_summary hook.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>

			<?php if ( function_exists( 'couponseek_social_share_buttons' ) ) : ?>
			<div class="SingleProductShare mt-40 mb-20">
				<div class="single-product-share-container">
					<?php 
					couponseek_social_share_buttons();
					?>
				</div>
			</div><!-- end single-deal-share -->
			<?php endif; ?>

			</div><!-- .summary -->
			<?php 
			if ( class_exists('WCV_Vendors') ) : 

				$vendor_id = WCV_Vendors::get_vendor_from_product(get_the_ID());
				$vendor = (get_userdata($vendor_id));
				$shop_name =  get_user_meta( $vendor_id, 'pv_shop_name', true );

				if ( $shop_name ) :
				?>
				<div class="single-product-company-summary">

						<?php
						$logo_id = couponseek_get_vendor_logo( $vendor_id);
						if ( $logo_id && wp_get_attachment_url($logo_id) ) : ?>
							<div class="single-product-company-logo">
								<a href="<?php echo WCV_Vendors::get_vendor_shop_page( $vendor_id ); ?>"><?php echo wp_get_attachment_image($logo_id, 'couponseek_medium_soft');  ?></a>
							</div>
						<?php endif ?>
						<div class="single-product-company-title">
							<h5><a href="<?php echo WCV_Vendors::get_vendor_shop_page( $vendor_id ); ?>"><?php echo wp_kses_post($shop_name); ?></a></h5>
						</div>
						<div class="single-product-company-description">
							<?php 
							$seller_info = get_user_meta( $vendor_id, 'pv_seller_info', true );
							echo do_shortcode( $seller_info );
							?>
						</div>
						
				</div><!-- .single-product-company-summary -->
				<?php endif; ?>
			<?php endif; ?>
		</div> <!-- end col-sm-12 col-md-5 col-lg-4 -->
		<div class="col-sm-12 col-md-8 col-lg-8 col-md-pull-4 float-r">

		<?php
			/**
			 * woocommerce_after_single_product_summary hook.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>

		</div><!-- end col-sm-12 col-md-7 col-lg-8 -->

		<div class="col-sm-12">
			<?php do_action( 'woocommerce_after_single_product' ); ?>
		</div>
	</div><!-- end row -->

</div><!-- #product-<?php the_ID(); ?> -->

