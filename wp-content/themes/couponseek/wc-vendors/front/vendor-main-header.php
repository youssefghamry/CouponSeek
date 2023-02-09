<?php
/**
 * Vendor Main Header Template
 *
 * THIS FILE WILL LOAD ON VENDORS STORE URLs (such as yourdomain.com/vendors/bobs-store/)
 *
 * This template can be overridden by copying it to yourtheme/wc-vendors/front/vendor-main-header.php
 *
 * @author		Jamie Madden, WC Vendors
 * @package 	WCVendors/Templates/Emails/HTML
 * @version 	2.0.0
 *
 *
 * Template Variables available
 * $vendor : 			For pulling additional user details from vendor account.  This is an array.
 * $vendor_id  : 		current vendor user id number
 * $shop_name : 		Store/Shop Name (From Vendor Dashboard Shop Settings)
 * $shop_description : Shop Description (completely sanitized) (From Vendor Dashboard Shop Settings)
 * $seller_info : 		Seller Info(From Vendor Dashboard Shop Settings)
 * $vendor_email :		Vendors email address
 * $vendor_login : 	Vendors user_login name
 * $vendor_shop_link : URL to the vendors store
 */

 if ( ! defined( 'ABSPATH' ) ) {
 	exit;
 }
?>

<?php
$logo_id = couponseek_get_vendor_logo( $vendor_id);
$shop_description = get_user_meta( $vendor_id, 'pv_shop_description', true );

if ( !is_product() ) :

	if ( wp_get_attachment_url($logo_id) || $shop_description ) : ?>

		<div class="col-sm-12 col-md-8 col-lg-9 mb-40">
			<div class="ContentHeader mb-40">
				<div class="SpecialHeading">
					<h1 class="special-title"><?php echo wp_kses_post($shop_name); ?></h1>
				</div>
				<?php 
				if ( couponseek_woocommerce() ) {
					woocommerce_breadcrumb(); 
				} ?>
			</div>
			<div class="hidden-md hidden-lg mb-40">
				<div class="product-company-summary">
					<?php
					if ( $logo_id && wp_get_attachment_url($logo_id) ) : ?>
					<div class="product-company-logo">
						<?php echo wp_get_attachment_image($logo_id, 'couponseek_medium_soft');  ?>
					</div>
					<?php endif ?>
					<div class="product-company-meta">
						<div class="product-company-description mb-20">
							<?php 
							echo do_shortcode( $shop_description );
							?>
						</div>
						<?php  
						$user_info = get_userdata($vendor_id);
						if ( $user_info->user_url ) :
							?>
							<a href="<?php echo esc_url($user_info->user_url); ?>" class="product-company-website"><?php echo esc_html__('Visit Website', 'couponseek'); ?></a>
						<?php endif; ?>
					</div>
				</div> <!-- product-company-summary -->
			</div>

	<?php else : ?>

		<div class="ContentHeader col-sm-12 mb-40">
			<div class="SpecialHeading">
				<h1 class="special-title"><?php echo wp_kses_post($shop_name); ?></h1>
			</div>
			<?php 
			if ( couponseek_woocommerce() ) {
				woocommerce_breadcrumb(); 
			} ?>
		</div>

		<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
			<div class="col-sm-12 col-md-8 col-lg-9 mb-40">
		<?php else : ?>
			<div class="col-sm-12 mb-40"></div>
		<?php endif; ?>

	<?php endif; ?>
<?php endif; ?>