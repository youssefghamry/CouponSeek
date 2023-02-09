<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

Class CouponSeek_Widget_Social extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => esc_html__( 'Add social links to your site.', 'couponseek' ) );

		parent::__construct( false, esc_html__( '[CouponSeek] Social', 'couponseek' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);

		echo $before_widget;

		echo '<div class="social-widget-wrapper">';

		if ( $title ) { echo $before_title . $title . $after_title; }
		?>
			<div class="SocialLinks">

				<?php 
				unset($instance['title']);

				foreach ( $instance as $key => $value ) :
					if ( empty( $value ) ) {
						continue;
					}
					?>
					<a href="<?php echo esc_url($value); ?>" class="<?php echo esc_attr($key); ?>" target="_blank"><i class="fab fa-<?php echo esc_attr($key);?>"></i></a>
				<?php endforeach; ?>
			</div><!-- end SocialLinks -->
		<?php
		echo '</div>';

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = wp_parse_args( (array) $new_instance, $old_instance );
		return $instance;
	}

	function form( $instance ) {

		$defaults = array(
			'title' => esc_html__('Follow Us', 'couponseek')
		);

		$titles = array(
			'500px px500'    => esc_html__( '500px URL', 'couponseek' ),
			'behance'    => esc_html__( 'Behance URL', 'couponseek' ),
			'dribbble'    => esc_html__( 'Dribbble URL', 'couponseek' ),
			'facebook'    => esc_html__( 'Facebook URL', 'couponseek' ),
			'flickr'    => esc_html__( 'Flickr URL', 'couponseek' ),
			'instagram'    => esc_html__( 'Instagram URL', 'couponseek' ),
			'linkedin'    => esc_html__( 'LinkedIn URL', 'couponseek' ),
			'medium'    => esc_html__( 'Medium URL', 'couponseek' ),
			'pinterest'    => esc_html__( 'Pinterest URL', 'couponseek' ),
			'tumblr'    => esc_html__( 'Tumblr URL', 'couponseek' ),
			'twitter'    => esc_html__( 'Twitter URL', 'couponseek' ),
			'vimeo-square'    => esc_html__( 'Vimeo URL', 'couponseek' ),
			'youtube'    => esc_html__( 'Youtube URL', 'couponseek' )
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'couponseek') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			
		</p>
		<?php
		foreach ( $titles as $key => $value ) {
		?>
			<p>
			<?php $field_value = isset($instance[$key]) ? $instance[$key] : '' ; ?>
				<label for="<?php echo esc_attr($this->get_field_id($key)); ?>"><?php echo wp_kses_post($value); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id($key)); ?>" name="<?php echo esc_attr($this->get_field_name($key)); ?>" type="text" value="<?php echo esc_attr($field_value); ?>" />
				
			</p>
		<?php
		}
		
	}
}
