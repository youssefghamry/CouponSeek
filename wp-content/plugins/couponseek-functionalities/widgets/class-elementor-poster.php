<?php
namespace Elementor;
/**
 * Elementor Subsolar Designs Poster Widget.
 *
 * Elementor widget that inserts a poster with image and text.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Poster_Widget extends Widget_Base {

	public function get_name() {
		return 'ssd_poster';
	}

	public function get_title() {
		return __( 'Poster', 'couponseek' );
	}

	public function get_icon() {
		return 'eicon-image-box';
	}

	public function get_categories() {
		return [ 'couponseek' ];
	}

	public function get_script_depends() {
		return [ 'couponseek_elementor-widgets-scripts' ];
	}

	// Image Tab
	protected function register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'Image', 'couponseek' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => __( 'Skin', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'classic' => __( 'Classic', 'couponseek' ),
					'cover' => __( 'Cover', 'couponseek' ),
				],
				'render_type' => 'template',
				'default' => 'classic',
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'couponseek' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'couponseek' ),
						'icon'  => 'eicon-h-align-left',
					],
					'above' => [
						'title' => __( 'Above', 'couponseek' ),
						'icon'  => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'couponseek' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'condition' => [
					'skin!' => 'cover',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_background' );

		$this->start_controls_tab(
			'tab_background_normal',
			[
				'label' => __( 'Normal', 'couponseek' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'frontend_available' => true,
						'default' => 'classic',
					],
					'image' => [
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					'video_link' => [
						'frontend_available' => true,
					],
					'video_start' => [
						'frontend_available' => true,
					],
					'video_end' => [
						'frontend_available' => true,
					],
				],
				'selector' => '{{WRAPPER}} .Poster .poster-image',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'background_css_filters',
				'selector' => '{{WRAPPER}} .Poster .poster-image',
				'condition' => [
					'background_background' => [ 'classic' ],
				],
			]
		);

		$this->add_control(
			'background_blend_mode',
			[
				'label' => __( 'Blend Mode', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'couponseek' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-image' => 'mix-blend-mode: {{VALUE}}',
				],
				'condition' => [
					'background_background' => [ 'classic' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_background_hover',
			[
				'label' => __( 'Hover', 'couponseek' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_hover',
				'selector' => '{{WRAPPER}} .Poster .poster-image:before',
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label' => __( 'Transition Duration', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'render_type' => 'ui',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-image:before' => 'transition: opacity {{SIZE}}s;',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'background_hover_css_filters',
				'selector' => '{{WRAPPER}} .Poster .poster-image:before',
				'condition' => [
					'background_background' => [ 'classic' ],
				],
			]
		);

		$this->add_control(
			'background_hover_blend_mode',
			[
				'label' => __( 'Blend Mode', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'couponseek' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-image:before' => 'mix-blend-mode: {{VALUE}}',
				],
				'condition' => [
					'background_background' => [ 'classic' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Image Overlay
		$this->start_controls_section(
			'section_background_overlay',
			[
				'label' => __( 'Image Overlay', 'couponseek' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'background_background' => [ 'classic', 'gradient', 'video' ],
				],
			]
		);

		$this->start_controls_tabs( 'tabs_background_overlay' );

		$this->start_controls_tab(
			'tab_background_overlay_normal',
			[
				'label' => __( 'Normal', 'couponseek' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_overlay',
				'selector' => '{{WRAPPER}} .Poster .overlay-image',
			]
		);

		$this->add_control(
			'background_overlay_opacity',
			[
				'label' => __( 'Opacity', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .Poster .overlay-image' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'overlay_css_filters',
				'selector' => '{{WRAPPER}} .Poster .overlay-image',
				'condition' => [
					'background_overlay_background' => [ 'classic' ],
				],
			]
		);

		$this->add_control(
			'overlay_blend_mode',
			[
				'label' => __( 'Blend Mode', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'couponseek' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .Poster .overlay-image' => 'mix-blend-mode: {{VALUE}}',
				],
				'condition' => [
					'background_overlay_background' => [ 'classic' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_background_overlay_hover',
			[
				'label' => __( 'Hover', 'couponseek' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_overlay_hover',
				'selector' => '{{WRAPPER}} .Poster .overlay-image:before',
			]
		);

		/*
		 *
		 * Add class 'overlay-hover' to widget when assigned overlay image hover
		 *
		 */
		$this->add_control(
			'overlay_hover_class',
			[
				'label' => 'Overlay Hover',
				'type' => Controls_Manager::HIDDEN,
				'default' => 'hover',
				'prefix_class' => 'overlay-',
				'condition' => [
					'background_overlay_hover_background' => [ 'classic', 'gradient' ],
				],
			]
		);

		$this->add_control(
			'background_overlay_hover_opacity',
			[
				'label' => __( 'Opacity', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .Poster:hover .overlay-image:before' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'background_overlay_hover_background' => [ 'classic', 'gradient' ],
				],
			]
		);

		$this->add_control(
			'background_overlay_hover_transition',
			[
				'label' => __( 'Transition Duration', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'render_type' => 'ui',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .Poster .overlay-image:before' => 'transition: opacity {{SIZE}}s;',
			]
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'overlay_hover_css_filters',
				'selector' => '{{WRAPPER}} .Poster .overlay-image:before',
				'condition' => [
					'background_overlay_background' => [ 'classic' ],
				],
			]
		);

		$this->add_control(
			'overlay_hover_blend_mode',
			[
				'label' => __( 'Blend Mode', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'couponseek' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .Poster .overlay-image:before' => 'mix-blend-mode: {{VALUE}}',
				],
				'condition' => [
					'background_overlay_background' => [ 'classic' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Content Tab
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'couponseek' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title & Description', 'couponseek' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'This is the heading', 'couponseek' ),
				'placeholder' => __( 'Enter your title', 'couponseek' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'couponseek' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'couponseek' ),
				'placeholder' => __( 'Enter your description', 'couponseek' ),
				'separator' => 'none',
				'rows' => 5,
				'show_label' => false,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Title HTML Tag', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
				],
				'default' => 'h2',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'button',
			[
				'label' => __( 'Button Text', 'couponseek' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'couponseek' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'couponseek' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'couponseek' ),

			]
		);

		$this->add_control(
			'apply_link',
			[
				'label' => __( 'Apply Link On', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'box' => __( 'Whole Box', 'couponseek' ),
					'button' => __( 'Button Only', 'couponseek' ),
				],
				'default' => 'button',
				'separator' => 'none',
				'condition' => [
					'link[url]!' => '',
				],
			]
		);

		$this->end_controls_section();

		// Image Style Tab
		$this->start_controls_section(
			'image_style_section',
			[
				'label' => __( 'Image Style', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_width',
			[
				'label' => __( 'Image Width', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 350,
				],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1000,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-wrapper-left .poster-image-wrapper, {{WRAPPER}} .Poster .poster-wrapper-right .poster-image-wrapper' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .Poster .poster-wrapper-left .poster-content-wrapper' => 'width: calc(100% - {{SIZE}}{{UNIT}});left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .Poster .poster-wrapper-right .poster-content-wrapper' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'skin!' => 'cover',
					'layout!' => 'above',
				],
			]
		);

		$this->add_control(
			'custom_height',
			[
				'label' => __( 'Min. Height', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 280,
				],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1000,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-image-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'skin!' => 'cover',
					'layout' => 'above',
				],
			]
		);

		$this->add_control(
			'image_style_hover',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Hover Effects', 'couponseek' ),
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'image_animation',
			[
				'label' => __( 'Hover Animation', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => 'None',
					'zoom-in' => 'Zoom In',
					'zoom-out' => 'Zoom Out',
					'zoom-rotate' => 'Zoom and Rotate',
					'move-left' => 'Move Left',
					'move-right' => 'Move Right',
					'move-up' => 'Move Up',
					'move-down' => 'Move Down',
				],
				'default' => 'none',
			]
		);

		$this->add_control(
			'image_animation_duration',
			[
				'label' => __( 'Animation Duration', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'render_type' => 'template',
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-image' => 'transition-duration: {{SIZE}}s'
				],
				'condition' => [
					'image_animation!' => 'none',
				],
			]
		);

		$this->end_controls_section();

		// Box Style Tab
		$this->start_controls_section(
			'box_style_section',
			[
				'label' => __( 'Box Style', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_alignment',
			[
				'label' => __( 'Text Alignment', 'couponseek' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'couponseek' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'couponseek' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'couponseek' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' => __( 'Padding', 'couponseek' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'content_style_border',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Content Border', 'couponseek' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'selector' => '{{WRAPPER}} .Poster .poster-content-wrapper:before',
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label' => __( 'Border Radius', 'couponseek' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-content-wrapper:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(

			'border_offset',
			[
				'label' => __( 'Border Offset', 'couponseek' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-content-wrapper:before' => 'top: {{TOP}}{{UNIT}};right: {{RIGHT}}{{UNIT}};bottom: {{BOTTOM}}{{UNIT}};left: {{LEFT}}{{UNIT}};',
				],
				'desktop_default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
			]
		);

		$this->end_controls_section();

		// Content Style Tab
		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content Style', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_style_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Title', 'couponseek' ),
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .Poster .poster-title',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Spacing', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'title!' => '',
				],
				'desktop_default' => [
					'size' => 30,
				],
				'tablet_default' => [
					'size' => 20,
				],
				'mobile_default' => [
					'size' => 15,
				],
			]
		);

		$this->add_control(
			'content_style_description',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Description', 'couponseek' ),
				'separator' => 'before',
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .Poster .poster-description',
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label' => __( 'Spacing', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'description!' => '',
				],
				'desktop_default' => [
					'size' => 30,
				],
				'tablet_default' => [
					'size' => 20,
				],
				'mobile_default' => [
					'size' => 10,
				],
			]
		);

		$this->add_control(
			'heading_content_colors',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Colors', 'couponseek' ),
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'color_tabs' );

		$this->start_controls_tab( 'colors_normal',
			[
				'label' => __( 'Normal', 'couponseek' ),
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-content-wrapper' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
				'default' => '#fff',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-description' => 'color: {{VALUE}}',
				],
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Button Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'button!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'colors_hover',
			[
				'label' => __( 'Hover', 'couponseek' ),
			]
		);

		$this->add_control(
			'content_bg_color_hover',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster:hover .poster-content-wrapper' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Title Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster:hover .poster-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'description_color_hover',
			[
				'label' => __( 'Description Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster:hover .poster-description' => 'color: {{VALUE}}',
				],
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'label' => __( 'Button Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster:hover .poster-button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'button!' => '',
				],
			]
		);

		$this->add_control(
			'content_bg_hover_transition',
			[
				'label' => __( 'Transition Duration', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-content-wrapper' => 'transition: {{SIZE}}s;',
					'{{WRAPPER}} .Poster .poster-content-wrapper *' => 'transition: {{SIZE}}s;',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'content_style_hover',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Hover Effects', 'couponseek' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_animation',
			[
				'label' => __( 'Hover Animation', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => 'None',
					'zoom-in' => 'Zoom In',
					'zoom-out' => 'Zoom Out',
					'move-left' => 'Move Left',
					'move-right' => 'Move Right',
					'move-up' => 'Move Up',
					'move-down' => 'Move Down',
				],
				'default' => 'none', 
			]
		);

		$this->add_control(
			'content_animation_duration',
			[
				'label' => __( 'Animation Duration', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'render_type' => 'template',
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-content' => 'transition-duration: {{SIZE}}s'
				],
				'condition' => [
					'content_animation!' => 'none',
				],
			]
		);

		$this->end_controls_section();

		// Buton Style Tab
		$this->start_controls_section(
			'button_style',
			[
				'label' => __( 'Button', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button!' => '',
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => __( 'Size', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => [
					'xs' => __( 'Extra Small', 'couponseek' ),
					'sm' => __( 'Small', 'couponseek' ),
					'md' => __( 'Medium', 'couponseek' ),
					'lg' => __( 'Large', 'couponseek' ),
					'xl' => __( 'Extra Large', 'couponseek' ),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'Typography', 'couponseek' ),
				'selector' => '{{WRAPPER}} .Poster .poster-button',
			]
		);

		$this->start_controls_tabs( 'button_tabs' );

		$this->start_controls_tab( 'button_normal',
			[
				'label' => __( 'Normal', 'couponseek' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Border Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button-hover',
			[
				'label' => __( 'Hover', 'couponseek' ),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => __( 'Text Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_border_width',
			[
				'label' => __( 'Border Width', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-button' => 'border-width: {{SIZE}}{{UNIT}};border-style: solid;',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .Poster .poster-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$wrapper_tag = 'div';
		$button_tag = 'a';
		$title_tag = $settings['title_tag'];
		$link_url = empty( $settings['link']['url'] ) ? false : $settings['link']['url'];
		$image_animation = $settings['image_animation'];
		$content_animation = $settings['content_animation'];
		$text_alignment = $settings['text_alignment'] ? 'text-' . $settings['text_alignment'] : 'text-left';

		if ( $settings['skin'] == 'cover' ) {		
			$this->add_render_attribute( 'poster-wrapper', 'class', [
				'poster-wrapper-cover'
			] );
		} else {
			$layout = $settings['layout'] ? 'poster-wrapper-' . $settings['layout'] : 'poster-wrapper-left';
			$this->add_render_attribute( 'poster-wrapper', 'class', [
				$layout
			] );
		}

		$this->add_render_attribute( 'poster-image', 'class', [
			'poster-image'
		] );

		if ( ! empty( $image_animation ) ) {
			$this->add_render_attribute( 'poster-image', 'class', 'ssd-image-transform ssd-element-transform-' . $image_animation );
		}

		$this->add_render_attribute( 'content-wrapper', 'class', [
			'poster-content-wrapper',
			$text_alignment
		] );

		if ( ! empty( $content_animation ) ) {
			$this->add_render_attribute( 'poster-content', 'class', 'poster-content ssd-text-transform ssd-element-transform-' . $content_animation );
		}

		$this->add_render_attribute( 'button', 'class', [
			'poster-button',
			'elementor-button',
			'btn btn-color',
			'elementor-size-' . $settings['button_size'],
		] );

		if ( ! empty( $link_url ) ) {

			if ( 'box' === $settings['apply_link'] ) {
				$wrapper_tag = 'a';
				$button_tag  = 'button';
				$this->add_render_attribute( 'wrapper', 'href', $link_url );
				if ( $settings['link']['is_external'] ) {
					$this->add_render_attribute( 'wrapper', 'target', '_blank' );
				}
			} else {
				$this->add_render_attribute( 'button', 'href', $link_url );
				if ( $settings['link']['is_external'] ) {
					$this->add_render_attribute( 'button', 'target', '_blank' );
				}
			}
		}

		$this->add_inline_editing_attributes( 'title' );
		$this->add_inline_editing_attributes( 'description' );
		$this->add_inline_editing_attributes( 'button' );

		?>
	
		<div class="Poster ssd-anim-element pos-r">
			<<?php echo $wrapper_tag . ' ' . $this->get_render_attribute_string( 'wrapper' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'poster-wrapper' ); ?>>
				<div class="poster-image-wrapper">
					<div <?php echo $this->get_render_attribute_string( 'poster-image' ); ?>>
						<div class="poster-background-video-container elementor-hidden-phone">
							<div class="poster-background-video-embed"></div>
							<video class="poster-background-video-hosted poster-html5-video" autoplay loop muted></video>
						</div>
						<div class="overlay-image"></div>
					</div>
				</div>
				<div <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
					<div <?php echo $this->get_render_attribute_string( 'poster-content' ); ?>>
						<?php if ( $settings['title'] ) : ?>
							<div class="PosterHeading pos-r">
								<?php if ( !empty( $settings['title'] ) ) : ?>
									<<?php echo $title_tag ?> class="poster-title">
									<?php echo $settings['title']; ?>
									</<?php echo $title_tag; ?>>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if ( !empty( $settings['description'] ) ) : ?>
							<div class="poster-description"><?php echo wp_kses_post($settings['description']); ?></div>
						<?php endif; ?>
						<?php if ( !empty( $settings['button'] ) ) : ?>
							<div class="poster-button-wrapper">
								<<?php echo $button_tag . ' ' . $this->get_render_attribute_string( 'button' ); ?>>
								<?php echo $settings['button']; ?>
								</<?php echo $button_tag; ?>>
							</div>
						<?php endif; ?>
					</div> <!-- end poster-content -->
				</div> <!-- end poster-content-wrapper -->
			</div>
			</<?php echo $wrapper_tag; ?>>
		</div> <!-- end Poster -->

	<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Poster_Widget() );
