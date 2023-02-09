<?php
class SSD_Elementor_Button_Extension {

	public function __construct() {
		add_action( 'elementor/element/button/section_style/before_section_end', [ $this, 'button_style_controls' ], 10, 2);
	}

	public function button_style_controls($widget, $args){

		$widget->update_control( 'typography_font_family', array(
			'scheme' => '',
		));

		$widget->update_control( 'typography_font_weight', array(
			'scheme' => '',
		));

		$widget->update_control( 'background_color', array(
			'scheme' => '',
		));


		$widget->update_control(
			'button_type',
			[
				'options' => [
					'' => __( 'Default', 'couponseek' ),
					'color' => __( 'Colored', 'couponseek' ),
					'info' => __( 'Info', 'couponseek' ),
					'success' => __( 'Success', 'couponseek' ),
					'warning' => __( 'Warning', 'couponseek' ),
					'danger' => __( 'Danger', 'couponseek' ),
				],
			]
		);

	}
}

new SSD_Elementor_Button_Extension();