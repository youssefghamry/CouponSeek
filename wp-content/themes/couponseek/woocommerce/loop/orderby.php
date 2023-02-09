<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
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
 * @version     5.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form class="woocommerce-ordering" method="get">
	<div name="orderby" class="orderby">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<?php 
			$selected = selected( $orderby, $id, 0 );
			if ( $selected ) : ?>
			<a href="<?php echo add_query_arg( 'orderby', esc_attr( $id ), couponseek_get_current_page_url() ); ?>" class="btn btn-color"><?php echo esc_html( $name ); ?></a>
			<?php else : ?>
			<a class="btn btn-normal" href="<?php echo add_query_arg( 'orderby', esc_attr( $id ), couponseek_get_current_page_url() ); ?>"><?php echo esc_html( $name ); ?></a>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</form>
