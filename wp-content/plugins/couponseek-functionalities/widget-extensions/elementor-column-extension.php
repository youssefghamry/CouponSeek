<?php
class SSD_Elementor_Column_Extension {

	public function __construct() {
		add_action( 'elementor/element/column/section_style/before_section_end', [ $this, 'background_controls' ], 10, 2);
		add_action( 'elementor/element/column/section_background_overlay/before_section_end', [ $this, 'section_background_overlay_controls' ], 10, 2);
	}

	public function background_controls($widget, $args){

		$widget->add_control(
			'custom_background_position',
			[
				'label' => __( 'Custom Position and Size', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'couponseek' ),
				'label_off' => __( 'No', 'couponseek' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'background_background' => [ 'classic' ]
				],
				'frontend_available' => true,
			]
		);

		$widget->add_responsive_control(
			'custom_background_size',
			[
				'label' => __( 'Custom Size', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-element-populated' => 'background-size: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'background_background' => [ 'classic' ],
					'custom_background_position' => 'yes',
				],
			]
		);

		$widget->add_responsive_control(
			'custom_background_position_horizontal',
			[
				'label' => __( 'Custom Position Horizontal', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-element-populated' => 'background-position-x: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'background_background' => [ 'classic' ],
					'custom_background_position' => 'yes',
				],
			]
		);

		$widget->add_responsive_control(
			'custom_background_position_vertical',
			[
				'label' => __( 'Custom Position Vertical', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-element-populated' => 'background-position-y: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'background_background' => [ 'classic' ],
					'custom_background_position' => 'yes',
				],
			]
		);

	}

	public function section_background_overlay_controls($widget, $args){

		$widget->add_control(
			'custom_background_overlay_position',
			[
				'label' => __( 'Custom Position and Size', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'couponseek' ),
				'label_off' => __( 'No', 'couponseek' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'background_overlay_background' => [ 'classic' ]
				],
				'frontend_available' => true,
			]
		);

		$widget->add_responsive_control(
			'custom_background_overlay_size',
			[
				'label' => __( 'Custom Size', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-element-populated >  .elementor-background-overlay' => 'background-size: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'background_overlay_background' => [ 'classic' ],
					'custom_background_position' => 'yes',
				],
			]
		);

		$widget->add_responsive_control(
			'custom_background_overlay_position_horizontal',
			[
				'label' => __( 'Custom Position Horizontal', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-element-populated >  .elementor-background-overlay' => 'background-position-x: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'background_overlay_background' => [ 'classic' ],
					'custom_background_overlay_position' => 'yes',
				],
			]
		);

		$widget->add_responsive_control(
			'custom_background_overlay_position_vertical',
			[
				'label' => __( 'Custom Position Vertical', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-element-populated >  .elementor-background-overlay' => 'background-position-y: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'background_overlay_background' => [ 'classic' ],
					'custom_background_overlay_position' => 'yes',
				],
			]
		);

	}


}

new SSD_Elementor_Column_Extension();