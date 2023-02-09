<?php 
/**
* ----------------------------------------------------------------------------------------
*    Product Vendors Widget
* ----------------------------------------------------------------------------------------
*/
Class CouponSeek_Widget_Product_Vendors extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => esc_html__('This widget adds product vendors to your site.','couponseek') );
		parent::__construct( false, esc_html__('[CouponSeek] Product Vendors', 'couponseek'), $widget_ops );
	}

	public function widget( $args, $instance ) {

		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);

		echo $before_widget;

		if ( class_exists('WCV_Vendors') ) : 

			$hidden_vendors = !empty($instance['hide_vendors']) ? $instance['hide_vendors'] : '';
			$hidden_vendors = explode(',', $hidden_vendors);
			$all_vendors = get_users( [ 'role' => [ 'vendor'] ] );
			$vendors_ids = array();
			foreach ($all_vendors as $vendor) : 
				$vendor_id = $vendor->data->ID;
				array_push($vendors_ids, $vendor_id);
			endforeach;
			$widget_vendors = array_diff($vendors_ids, $hidden_vendors); ?>

			<div class="product-meta-widget-wrapper">

			<?php
			
			if ( $title ) { echo $before_title . $title . $after_title; } ?>

			<ul class="product-meta-list-widget font-heading">

			<?php foreach ( $widget_vendors as $vendor_id ) :
				if ( !empty($vendor_id) ) : ?>
					<?php 
					$logo_id = couponseek_get_vendor_logo( $vendor_id);
					$shop_name =  get_user_meta( $vendor_id, 'pv_shop_name', true ); 
					$product_count = count_user_posts( $vendor_id, 'product' );
					if ( $shop_name ) :
					?>
					<li class="product-meta">
						<a href="<?php echo WCV_Vendors::get_vendor_shop_page( $vendor_id ); ?>" class="pos-r">
							<div class="product-meta-title font-heading pos-r">
								<span><?php echo wp_kses_post($shop_name); ?></span>
								<span class="number-counter"> - (<?php echo wp_kses_post($product_count); ?>)</span>
							</div>
						</a>
					</li>
					<?php endif; ?>
				<?php endif;
			endforeach; ?>
			
			</ul>

			</div> <!-- end product-categories-widget-wrapper -->

		<?php else : 
			if ( $title ) { 
				echo $before_title . $title . $after_title; 
			}
		endif; ?>

		<?php echo $after_widget;

	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['hide_vendors'] = strip_tags($new_instance['hide_vendors']);

		return $instance;
	}

	public function form( $instance ) {
		
		$defaults = array(
			'title' => esc_html__('Companies', 'couponseek'),
			'hide_vendors' => '',
		);

		$instance = wp_parse_args((array) $instance, $defaults);
		?>

		<!-- WC Vendors Info -->
		<p>
			<?php 
			printf( wp_kses_post(__('<strong>Important</strong> Vendors are added from the <a href="https://www.wcvendors.com/" target="_blank">WC Vendors plugin</a>.','couponseek')));
			
			?>
		</p>

		<!-- The Title -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'couponseek') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<!-- The Hide Product Vendors -->
		<p>
			<?php if ( class_exists('CouponSeek_Widget_Fields') ) {
				$args = array(
					'id' =>  $this->get_field_id('hide_vendors'),
					'name' => $this->get_field_name('hide_vendors'),
					'value' => $instance['hide_vendors'],
					'type' => 'multi-select',
					'label' =>  esc_html__( 'Hide Vendors', 'couponseek' ),
					'choices' => couponseek_get_wc_vendors()
				);
				CouponSeek_Widget_Fields::field($args);
			} ?>
		</p>
		
	<?php
	}

	
}
?>