<?php
/**
 * Links Template
 *
 * This template can be overridden by copying it to yourtheme/wc-vendors/dashboard/links.php
 *
 * @author		Jamie Madden, WC Vendors
 * @package 	WCVendors/Templates/dashboard
 * @version 	2.0.0

 */

 if ( ! defined( 'ABSPATH' ) ) {
 	exit;
 }
?>

<?php wc_print_notices(); ?>

<div class="wc-vendors-navigation">
	<a href="<?php echo esc_url($shop_page); ?>"><?php echo _e( 'View Your Shop', 'couponseek' ); ?></a>
	<a href="<?php echo esc_url($settings_page); ?>"><?php echo _e( 'Shop Settings', 'couponseek' ); ?></a>

	<?php if ( $can_submit ) : ?>
		<a target="_TOP" href="<?php echo esc_url($submit_link); ?>"><?php echo _e( 'Add New Product', 'couponseek' ); ?></a>
		<a target="_TOP" href="<?php echo esc_url($edit_link); ?>"><?php echo _e( 'Edit Products', 'couponseek' ); ?></a>
	<?php endif; ?>
	
	<?php $url_user = get_option('woocommerce_myaccount_page_id') ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : ''; ?>
	<a href="<?php echo esc_url($url_user); ?>"><?php esc_html_e('User Profile', 'couponseek') ?></a>

	<?php do_action( 'wcvendors_after_links' );
	?>
</div>
