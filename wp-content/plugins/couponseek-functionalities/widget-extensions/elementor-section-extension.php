<?php
class SSD_Elementor_Section_Extension {

	public function __construct() {
		add_action( 'elementor/element/section/section_background/before_section_end', [ $this, 'section_background_controls' ], 10, 2);
		add_action( 'elementor/element/section/section_background_overlay/before_section_end', [ $this, 'section_background_overlay_controls' ], 10, 2);
	}

	public function section_background_controls($widget, $args){

		$widget->update_control( 'background_image', array(
			'selectors' => [
				'{{WRAPPER}} .jarallax-container > div' => 'background-image: url("{{URL}}");',
				'{{WRAPPER}}' => 'background-image: url("{{URL}}");',
			],
			'frontend_available' => true,
		));

		$widget->update_control(
			'background_position',
			[
				'condition' => [
					'background_background' => [ 'classic' ],
					'parallax_enable' => '',
				],
			]
		);

		$widget->update_control(
			'background_attachment',
			[
				'condition' => [
					'background_background' => [ 'classic' ],
					'parallax_enable' => '',
				],
			]
		);

		$widget->update_control(
			'background_repeat',
			[
				'condition' => [
					'background_background' => [ 'classic' ],
					'parallax_enable' => '',
				],
			]
		);

		$widget->update_control(
			'background_size',
			[
				'condition' => [
					'background_background' => [ 'classic' ],
					'parallax_enable' => '',
				],
			]
		);

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
					'{{WRAPPER}}' => 'background-size: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}}' => 'background-position-x: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}}' => 'background-position-y: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'background_background' => [ 'classic' ],
					'custom_background_position' => 'yes',
				],
			]
		);

		$widget->add_control(
			'parallax_enable',
			[
				'label' => __( 'Enable Parallax', 'couponseek' ),
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

		$widget->add_control(
			'parallax_position',
			[
				'label' => __( 'Parallax Position', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '50% 50%',
				'options' => [
					'0% 0%' => __( 'Top Left', 'couponseek' ),
					'100% 0%' => __( 'Top Right', 'couponseek' ),
					'50% 0%' => __( 'Top Center', 'couponseek' ),
					'0% 50%' => __( 'Left Center', 'couponseek' ),
					'50% 50%' => __( 'Center Center', 'couponseek' ),
					'100% 50%' => __( 'Right Center', 'couponseek' ),
					'0% 100%' => __( 'Bottom Left', 'couponseek' ),
					'50% 100%' => __( 'Bottom Center', 'couponseek' ),
					'100% 100%' => __( 'Bottom Right', 'couponseek' ),
				],
				'frontend_available' => true,
				'condition' => [
					'parallax_enable' => 'yes',
				],
			]
		);

		$widget->add_control(
			'parallax_repeat',
			[
				'label' => __( 'Parallax Repeat', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'no-repeat',
				'options' => [
					'no-repeat' => __( 'No-repeat', 'couponseek' ),
					'repeat' => __( 'Repeat', 'couponseek' ),
					'repeat-x' => __( 'Repeat-x', 'couponseek' ),
					'repeat-y' => __( 'Repeat-y', 'couponseek' ),
				],
				'frontend_available' => true,
				'condition' => [
					'parallax_enable' => 'yes',
				],
			]
		);

		$widget->add_control(
			'parallax_size',
			[
				'label' => __( 'Parallax Size', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => __( 'Cover', 'couponseek' ),
					'auto' => __( 'Auto', 'couponseek' ),
					'contain' => __( 'Contain', 'couponseek' ),
				],
				'frontend_available' => true,
				'condition' => [
					'parallax_enable' => 'yes',
				],
			]
		);

		$widget->add_control(
			'parallax_speed',
			[
				'label' => __( 'Parallax Speed', 'couponseek' ),
				'description' => __( 'Scrolling speed from -1 to 2.', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -1,
				'max' => 2,
				'step' => 0.01,
				'default' => 0.5,
				'frontend_available' => true,
				'condition' => [
					'parallax_enable' => 'yes',
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
					'{{WRAPPER}} > .elementor-background-overlay' => 'background-size: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'background_overlay_background' => [ 'classic' ],
					'custom_background_overlay_position' => 'yes',
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
					'{{WRAPPER}} > .elementor-background-overlay' => 'background-position-x: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} > .elementor-background-overlay' => 'background-position-y: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'background_overlay_background' => [ 'classic' ],
					'custom_background_overlay_position' => 'yes',
				],
			]
		);

	}


}

new SSD_Elementor_Section_Extension();