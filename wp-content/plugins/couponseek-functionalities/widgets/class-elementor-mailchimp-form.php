<?php
namespace Elementor;

/**
 * Elementor Mailchimp Form.
 *
 * Elementor widget that inserts Mailchimp form.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Mailchimp_Form_Widget extends Widget_Base {

	public function get_name() {
		return 'ssd_mailchimp_form';
	}

	public function get_title() {
		return __( 'Mailchimp Form', 'couponseek' );
	}

	public function get_icon() {
		return 'eicon-mailchimp';
	}

	public function get_categories() {
		return [ 'couponseek' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Mailchimp Options', 'couponseek' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'important_note',
			[
				'label' => __( 'Important Note', 'couponseek' ),
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'Make sure that you have entered your Mailchimp API Key and List ID in Appearance > Theme Settings.', 'couponseek' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'couponseek' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Subscribe', 'couponseek')
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	?>

	<div class="MailchimpNewsletterForm">
		<form method="post" class="is-mailchimp-shortcode-subscribe">
			<fieldset class="group-input">
				<input type="email" class="mailchimp-email" name="email" placeholder="<?php esc_attr_e('Your e-mail address', 'couponseek'); ?>" value="">
				<button class="btn" type="submit"><span><?php echo wp_kses_post($settings['button_text']); ?></span></button>
			</fieldset>
		</form>
		<div class="mailchimp-shortcode-message"></div>
	</div>
	<?php
	}

}

if ( class_exists( 'CouponSeek_Mailchimp_Integration' ) ) {	
	Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Mailchimp_Form_Widget() );
}
