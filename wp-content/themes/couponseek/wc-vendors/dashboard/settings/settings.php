<?php 
$dashboard_page = get_permalink( get_option( 'wcvendors_vendor_dashboard_page_id' ) ) ? get_permalink( get_option( 'wcvendors_vendor_dashboard_page_id' ) ) : '';
if ($dashboard_page) :
?>
<div>
	<p>
		<?php echo esc_html__("You can adjust your Shop Settings here - Shop Name, Shop Logo, Description and more.", "couponseek"); ?>
	</p>
</div>
<a href="<?php echo esc_url($dashboard_page); ?>" class="btn btn-white"><?php echo esc_html__("Back To Dashboard", "couponseek"); ?></a>
<?php endif; ?>
<h2><?php _e( 'Settings', 'couponseek' ); ?></h2>

<?php if ( function_exists( 'wc_print_notices' ) ) { wc_print_notices(); } ?>

<form method="post" class="wc-vendors-settings mb-80" enctype="multipart/form-data">
	<?php

	do_action( 'wcvendors_settings_before_paypal' );

	if ( $paypal_address !== 'false' ) {
		wc_get_template( 'paypal-email-form.php', array(
			'user_id' => $user_id,
		), 'wc-vendors/dashboard/settings/', wcv_plugin_dir . 'templates/dashboard/settings/' );
	}

	do_action( 'wcvendors_settings_after_paypal' );

	wc_get_template( 'shop-name.php', array(
		'user_id' => $user_id,
	), 'wc-vendors/dashboard/settings/', wcv_plugin_dir . 'templates/dashboard/settings/' );

	do_action( 'wcvendors_settings_after_shop_name' );

	wc_get_template( 'seller-info.php', array(
		'global_html' => $global_html,
		'has_html'    => $has_html,
		'seller_info' => $seller_info,
	), 'wc-vendors/dashboard/settings/', wcv_plugin_dir . 'templates/dashboard/settings/' );

	do_action( 'wcvendors_settings_after_seller_info' );

	if ( $shop_description !== 'false' ) {
		wc_get_template( 'shop-description.php', array(
			'description' => $description,
			'global_html' => $global_html,
			'has_html'    => $has_html,
			'shop_page'   => $shop_page,
			'user_id'     => $user_id,
		), 'wc-vendors/dashboard/settings/', wcv_plugin_dir . 'templates/dashboard/settings/' );

		do_action( 'wcvendors_settings_after_shop_description' );
	}
	?>

	<?php wp_nonce_field( 'save-shop-settings', 'wc-product-vendor-nonce' ); ?>
	<input type="submit" class="btn btn-color" style="float:none;" name="vendor_application_submit"
	   value="<?php _e( 'Save', 'couponseek' ); ?>"/>
	<a href="<?php echo esc_url($dashboard_page); ?>" class="btn btn-normal"><?php echo esc_html__("Back To Dashboard", "couponseek"); ?></a>
</form>
