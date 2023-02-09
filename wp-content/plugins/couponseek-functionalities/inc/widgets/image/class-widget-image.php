<?php 
/**
* ----------------------------------------------------------------------------------------
*    Image Widget
* ----------------------------------------------------------------------------------------
*/
Class CouponSeek_Widget_Image extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => esc_html__('This widget adds an image your site.','couponseek') );
		parent::__construct( false, esc_html__('[CouponSeek] Image', 'couponseek'), $widget_ops );
	}

	public function widget( $args, $instance ) {

		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$link = apply_filters('widget_link', empty($instance['image_link']) ? '' : $instance['image_link']);

		echo $before_widget;

		echo '<div class="image-widget-wrapper">';
		
		if ( $title ) { 

		
		echo $before_title . $title . $after_title; 

		}

		if ( $instance['image'] ) : ?>

			<?php if ( $link ) : ?>
			<a href="<?php echo esc_url($link) ?>" target="_blank">
				<?php echo wp_get_attachment_image( $instance['image'], 'couponseek_medium_soft' ); ?>
			</a>
			<?php else : 
			echo wp_get_attachment_image( $instance['image'], 'couponseek_medium_soft' );
			endif; ?>

		<?php endif;

		echo '</div><!-- end image-widget-wrapper -->';

		echo $after_widget;

	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['image_link'] = strip_tags($new_instance['image_link']);

		return $instance;
	}

	public function form( $instance ) {
		
		$defaults = array(
			'title' => esc_html__('Image', 'couponseek'),
			'image' => '',
			'image_link' => '',
		);

		$instance = wp_parse_args((array) $instance, $defaults);

		?>

		<!-- The Title -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'couponseek') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<!-- The Image -->
		<p>
			<?php if ( class_exists('CouponSeek_Widget_Fields') ) {
				$args = array(
					'id' =>  $this->get_field_id('image'),
					'name' => $this->get_field_name('image'),
					'value' => $instance['image'],
					'type' => 'image',
					'label' =>  esc_html__( 'Image', 'couponseek' ),
				);
				CouponSeek_Widget_Fields::field($args);
			} ?>
		</p>

		<!-- The Image Link -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image_link')); ?>"><?php esc_html_e('Image Link', 'couponseek') ?></label>
			<input type="url" id="<?php echo esc_attr($this->get_field_id('image_link')); ?>" name="<?php echo esc_attr($this->get_field_name('image_link')); ?>" class="widefat" value="<?php echo esc_attr($instance['image_link']); ?>">
		</p>
		
	<?php
	}

	
}
?>