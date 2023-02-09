<?php 
/**
* ----------------------------------------------------------------------------------------
*    Mailchimp Widget
* ----------------------------------------------------------------------------------------
*/
Class CouponSeek_Mailchimp_Widget_Mailchimp extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => esc_html__('Subscription form with Mailchimp integration.', 'couponseek') );
		parent::__construct( 'mailchimp_newsletter', esc_html__('[Subsolar Designs] Mailchimp Newsletter', 'couponseek'), $widget_ops );


		add_action('widgets_init', [ $this, 'register_widget' ]);
	}


	public function widget( $args, $instance ) {

		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);

		echo $before_widget;

		echo '<div class="MailchimpNewsletter mailchimp-widget-wrapper">';
		
		if ( $title ) { echo $before_title . $title . $after_title; }

		?>
		<div class="MailchimpNewsletterForm">
			<?php if ( $instance['sub_text'] ) : ?>
			<div class="mailchimp-newsletter-content mb-20"><?php echo wp_kses_post($instance['sub_text']); ?></div>
			<?php endif; ?>
			<form method="post" class="is-mailchimp-shortcode-subscribe">
				<fieldset>
					<input type="email" class="mailchimp-email" name="email" placeholder="<?php esc_attr_e('Your e-mail address', 'couponseek'); ?>" value="">
					<button class="btn" type="submit"><span><?php echo wp_kses_post($instance['button_text']); ?></span></button>
				</fieldset>
			</form>
			<div class="mailchimp-shortcode-message"></div>
		</div>
		<?php
		echo '</div><!-- end mailchimp-widget-wrapper -->';

		echo $after_widget;

	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['sub_text'] = strip_tags($new_instance['sub_text']);
		$instance['button_text'] = strip_tags($new_instance['button_text']);
		$instance['api_key'] = strip_tags($new_instance['api_key']);
		$instance['list_id'] = strip_tags($new_instance['list_id']);

		return $instance;

	}

	public function form( $instance ) {

		$defaults = array(
			'title' => esc_html__('Newsletter', 'couponseek'),
			'sub_text' => esc_html__("Make sure you don't miss anything!", 'couponseek'),
			'button_text' => esc_html__('Subscribe', 'couponseek'),
			'api_key' => '',
			'list_id' => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>	
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'couponseek') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('button_text')); ?>"><?php esc_html_e('Button Text', 'couponseek') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('button_text')); ?>" name="<?php echo esc_attr($this->get_field_name('button_text')); ?>" type="text" value="<?php echo esc_attr($instance['button_text']); ?>" />
			
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('sub_text')) ?>"><?php esc_html_e('Subscription Text', 'couponseek') ?></label>
			<textarea cols="45" rows="4" id="<?php echo esc_attr($this->get_field_id('sub_text')) ?>" name="<?php echo esc_attr($this->get_field_name('sub_text')) ?>" class="widefat"><?php echo esc_attr($instance['sub_text']); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('api_key')); ?>"><?php esc_html_e('API Key', 'couponseek') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('api_key')); ?>" name="<?php echo esc_attr($this->get_field_name('api_key')); ?>" type="text" value="<?php echo esc_attr($instance['api_key']); ?>" />
			
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('list_id')); ?>"><?php esc_html_e('List ID', 'couponseek') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('list_id')); ?>" name="<?php echo esc_attr($this->get_field_name('list_id')); ?>" type="text" value="<?php echo esc_attr($instance['list_id']); ?>" />
			
		</p>

	<?php
	}

	public function register_widget() {
		register_widget('CouponSeek_Mailchimp_Widget_Mailchimp');
	}

}

new CouponSeek_Mailchimp_Widget_Mailchimp();
?>