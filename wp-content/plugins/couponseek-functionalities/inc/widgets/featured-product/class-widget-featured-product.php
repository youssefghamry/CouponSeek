<?php 
/**
* ----------------------------------------------------------------------------------------
*    Featured Product Widget
* ----------------------------------------------------------------------------------------
*/
Class CouponSeek_Widget_Featured_Product extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => esc_html__('This widget adds a featured product to your site.','couponseek') );
		parent::__construct( false, esc_html__('[CouponSeek] Featured Product', 'couponseek'), $widget_ops );
	}

	public function widget( $args, $instance ) {

		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);

		echo $before_widget;

		if ( isset($instance['featured_product']) && class_exists( 'WooCommerce' ) ) {

			$product_id = $instance['featured_product'];
			$product = wc_get_product($product_id);
			$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'shop_single' ); 
			$image_url = get_the_post_thumbnail_url( $product_id, $image_size );
			if ( $product ) :
			?>
			<div class="featured-product-widget-wrapper">
				<?php if ( $title ) { echo $before_title . $title . $after_title; } 
				if ( $image_url ) : ?>
				<div class="featured-product-content-wrapper widget-with-image">
					<div class="bg-image" data-bg-image="<?php echo esc_url($image_url); ?>"></div>
				<?php endif; ?>
				<div class="featured-product-content">
					<div class="featured-product-title-wrapper">
						<?php 
						$terms = get_the_terms( $product->get_id(), 'product_cat' );
						if ( !empty( $terms ) ) {
							$product_cat = $terms[0]; ?>
							<a class="featured-product-category" href="<?php echo esc_url(get_term_link($product_cat)); ?>">
								<span><?php echo wp_kses_post($product_cat->name); ?></span>	
							</a>
						<?php 
						}
						$external_url = false;
						if( $product instanceof WC_Product_External ) {
							if ( $product->get_product_url() ) {
								$external_url = $product->get_product_url();
							}
						}
						if ( $external_url ) {
							$discount_code = (couponseek_get_field('discount_code', $product_id)) ? couponseek_get_field('discount_code', $product_id) : '';
							if ( $discount_code != '' ) {
								echo '<a href="javascript:void(0)" class="is-show-coupon-code" data-target="#external-product-modal-' . $product_id . '" data-clipboard-text="' . esc_attr($discount_code) . '"><h3 class="featured-product-title">' . get_the_title($product_id) . '</h3></a>';
							} else {
								echo '<a href="' . esc_url( $external_url ) . '" target="_blank"><h3 class="featured-product-title">' . get_the_title($product_id) . '</h3></a>';
							}
						} else {
							echo '<a href="' . esc_url( get_the_permalink($product_id) ) . '"><h3 class="featured-product-title">' . get_the_title($product_id) . '</h3></a>';
						} 
						?>
					</div> <!-- end title-wrapper -->
					<?php if ( couponseek_get_field('expiring_date', $product_id) ) : ?>
					<?php
					$expiring_date = DateTime::createFromFormat('Ymd', couponseek_get_field('expiring_date', $product_id));
					$expiring_date_formatted = $expiring_date->format('m/d/Y');
					?>
					<div class="featured-product-expiration">
						<span class="product-expiration-meta"><?php echo esc_html__('Expires In', 'couponseek'); ?></span>
						<span class="is-jscountdown font-heading" data-time="<?php echo esc_attr($expiring_date_formatted) ?>" data-short="true"></span>
					</div>
					<?php endif; ?> <!-- end featured-product-expiration -->
				</div> <!-- endfeatured-product-content -->

				<?php if ( $image_url ) : ?>
				</div> <!-- end featured-product-content-wrapper -->
				<?php endif; ?>
				
			</div> <!-- end featured-product-widget-wrapper -->
			<?php endif; ?>
		<?php 
		} else {
			if ( $title ) { 
				echo $before_title . $title . $after_title; 
			}
		}
		

		echo $after_widget;

	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['featured_product'] = strip_tags($new_instance['featured_product']);

		return $instance;
	}

	public function form( $instance ) {
		
		$defaults = array(
			'title' => esc_html__('Featured Product', 'couponseek'),
			'featured_product' => '',
		);

		$instance = wp_parse_args((array) $instance, $defaults);

		?>

		<!-- The Title -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Featured Product', 'couponseek') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<!-- The Featured Product -->
		<p>
			<?php if ( class_exists('CouponSeek_Widget_Fields') ) {
				$args = array(
					'id' =>  $this->get_field_id('featured_product'),
					'name' => $this->get_field_name('featured_product'),
					'value' => $instance['featured_product'],
					'type' => 'select',
					'label' =>  esc_html__( 'Featured Product', 'couponseek' ),
					'choices' => couponseek_get_post_names('product'),
				);
				CouponSeek_Widget_Fields::field($args);
			} ?>
		</p>
		
	<?php
	}

	
}
?>