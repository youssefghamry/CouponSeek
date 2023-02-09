<?php
namespace Elementor;
/**
 * Elementor Subsolar Designs Poster Widget.
 *
 * Elementor widget that inserts a blockquote.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Blockquote_Widget extends Widget_Base {

	public function get_name() {
		return 'ssd_blockquote';
	}

	public function get_title() {
		return __( 'Blockquote', 'couponseek' );
	}

	public function get_icon() {
		return 'eicon-blockquote';
	}

	public function get_categories() {
		return [ 'couponseek' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_blockquote',
			[
				'label' => __( 'Blockquote', 'couponseek' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'quote',
			[
				'label' => __( 'Quote', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'couponseek' ),
				'label_off' => __( 'Hide', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'quote_style',
			[
				'label' => __( 'Quote Style', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'single' => 'Single',
					'double' => 'Double',
				],
				'default' => 'single', 
				'condition' => [
					'quote' => 'yes',
				],
			]
		);

		$this->add_control(
			'content',
			[
				'label' => __( 'Content', 'couponseek' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'couponseek' ),
				'placeholder' => __( 'Enter your description', 'couponseek' ),
				'separator' => 'none',
				'rows' => 5,
				'label_block' => true,
			]
		);

		$this->add_control(
			'author',
			[
				'label' => __( 'Author', 'couponseek' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Author', 'couponseek' ),
			]
		);

		$this->add_control(
			'author_meta',
			[
				'label' => __( 'Author Meta', 'couponseek' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'author_meta_link',
			[
				'label' => __( 'Author Meta Link', 'couponseek' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'couponseek' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'box_style_section',
			[
				'label' => __( 'Box Style', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
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
					'{{WRAPPER}} .Blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'selector' => '{{WRAPPER}} .Blockquote:before',
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label' => __( 'Border Radius', 'couponseek' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .Blockquote:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .Blockquote' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .Blockquote:before' => 'top: {{TOP}}{{UNIT}};right: {{RIGHT}}{{UNIT}};bottom: {{BOTTOM}}{{UNIT}};left: {{LEFT}}{{UNIT}};',
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

		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content Style', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_style_quote',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Quote', 'couponseek' ),
				'condition' => [
					'quote' => 'yes',
				],
			]
		);

		$this->add_control(
			'quote_font_size',
			[
				'label' => __( 'Quote Size', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 300,
						'step' => 2,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'condition' => [
					'quote' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .Blockquote .blockquote-content-wrapper:before, {{WRAPPER}} .Blockquote .blockquote-content-wrapper:after' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .Blockquote .quote-double' => 'margin: calc({{SIZE}}{{UNIT}}/3.4) 0;',
					'{{WRAPPER}} .Blockquote .quote-single' => 'margin-top: calc({{SIZE}}{{UNIT}}/3.4);',
				],
			]
		);

		$this->add_responsive_control(
			'content_quote_spacing',
			[
				'label' => __( 'Spacing', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .Blockquote .quote-single .blockquote-content, {{WRAPPER}} .Blockquote .quote-double .blockquote-content' => 'padding-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .Blockquote .quote-double .author-wrapper' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'quote' => 'yes',
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
			'content_style_content',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Content', 'couponseek' ),
				'condition' => [
					'content!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .Blockquote .blockquote-content',
				'condition' => [
					'content!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label' => __( 'Spacing', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .Blockquote .blockquote-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'content!' => '',
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
			'content_style_author',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Author', 'couponseek' ),
				'separator' => 'before',
				'condition' => [
					'author!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'author_typography',
				'selector' => '{{WRAPPER}} .Blockquote .author-wrapper .author',
				'condition' => [
					'author!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'content_author_spacing',
			[
				'label' => __( 'Spacing', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .Blockquote .author-wrapper .author' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'content!' => '',
				],
				'desktop_default' => [
					'size' => 5,
				],
				'tablet_default' => [
					'size' => 5,
				],
				'mobile_default' => [
					'size' => 5,
				],
			]
		);

		$this->add_control(
			'content_style_author_meta',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Author Meta', 'couponseek' ),
				'separator' => 'before',
				'condition' => [
					'author_meta!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'author_meta_typography',
				'selector' => '{{WRAPPER}} .Blockquote .author-wrapper .author-meta',
				'condition' => [
					'author_meta!' => '',
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
			'quote_color',
			[
				'label' => __( 'Quote Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blockquote .blockquote-content-wrapper:before, {{WRAPPER}} .Blockquote .blockquote-content-wrapper:after' => 'color: {{VALUE}}',
				],
				'condition' => [
					'quote' => 'yes',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Content Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blockquote .blockquote-content' => 'color: {{VALUE}}',
				],
				'condition' => [
					'content!' => '',
				],
			]
		);

		$this->add_control(
			'author_color',
			[
				'label' => __( 'Author Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blockquote .author-wrapper .author' => 'color: {{VALUE}}',
				],
				'condition' => [
					'author!' => '',
				],
			]
		);

		$this->add_control(
			'author_meta_color',
			[
				'label' => __( 'Author Meta Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blockquote .author-wrapper .author-meta' => 'color: {{VALUE}}',
				],
				'condition' => [
					'author_meta!' => '',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blockquote' => 'background-color: {{VALUE}}',
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
			'quote_hover_color',
			[
				'label' => __( 'Quote Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blockquote:hover .blockquote-content-wrapper:before, {{WRAPPER}} .Blockquote:hover .blockquote-content-wrapper:after' => 'color: {{VALUE}}',
				],
				'condition' => [
					'quote' => 'yes',
				],
			]
		);

		$this->add_control(
			'content_hover_color',
			[
				'label' => __( 'Content Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blockquote:hover .blockquote-content' => 'color: {{VALUE}}',
				],
				'condition' => [
					'content!' => '',
				],
			]
		);

		$this->add_control(
			'author_hover_color',
			[
				'label' => __( 'Author Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blockquote:hover .author-wrapper .author' => 'color: {{VALUE}}',
				],
				'condition' => [
					'author!' => '',
				],
			]
		);

		$this->add_control(
			'author_meta_hover_color',
			[
				'label' => __( 'Author Meta Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blockquote:hover .author-wrapper .author-meta' => 'color: {{VALUE}}',
				],
				'condition' => [
					'author_meta!' => '',
				],
			]
		);

		$this->add_control(
			'background_hover_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blockquote:hover' => 'background-color: {{VALUE}}',
				],
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
				'selectors' => [
					'{{WRAPPER}} .Blockquote' => 'transition: {{SIZE}}s;',
					'{{WRAPPER}} .Blockquote .blockquote-content-wrapper:before, {{WRAPPER}} .Blockquote .blockquote-content-wrapper:after' => 'transition: {{SIZE}}s;',
					'{{WRAPPER}} .Blockquote .blockquote-content' => 'transition: {{SIZE}}s;',
					'{{WRAPPER}} .Blockquote .author' => 'transition: {{SIZE}}s;',
					'{{WRAPPER}} .Blockquote .author-meta' => 'transition: {{SIZE}}s;',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$wrapper_tag = "span";
		$link_url = empty( $settings['author_meta_link']['url'] ) ? false : $settings['author_meta_link']['url'];
		$text_alignment = $settings['text_alignment'] ? 'text-' . $settings['text_alignment'] : 'text-left';

		$this->add_render_attribute( 'blockquote-content', 'class', [
			'blockquote-content-wrapper',
			$text_alignment
		] );

		$this->add_render_attribute( 'meta-wrapper', 'class', 'author-meta' );

		if ( ! empty( $link_url ) ) {
			$wrapper_tag = "a";
			$this->add_render_attribute( 'meta-wrapper', 'href', $link_url );
			if ( $settings['author_meta_link']['is_external'] ) {
				$this->add_render_attribute( 'meta-wrapper', 'target', '_blank' );
			}
		}

		if (  $settings['quote'] == "yes" ) {
			$this->add_render_attribute( 'blockquote-content', 'class', 'quote-' .  $settings['quote_style'] );
		}

		$this->add_inline_editing_attributes( 'content' );
		$this->add_inline_editing_attributes( 'author' );
		$this->add_inline_editing_attributes( 'author_meta' );

		?>
	
		<div class="Blockquote">
			<div <?php echo $this->get_render_attribute_string( 'blockquote-content' ); ?>>
				<?php if ( $settings['content'] ) : ?>
				<div class="blockquote-content">
					<?php echo wp_kses_post($settings['content']) ?>
				</div>
				<?php endif; ?>
				<?php if ( $settings['author'] ) : ?>
					<div class="author-wrapper">
						<span class="author font-heading"><?php echo wp_kses_post($settings['author']) ?></span>
						<?php if ( $settings['author_meta'] ) : ?>
							<<?php echo $wrapper_tag . ' ' . $this->get_render_attribute_string( 'meta-wrapper' ); ?>>
							<?php echo wp_kses_post($settings['author_meta']) ?>
							</<?php echo $wrapper_tag; ?>>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

	<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Blockquote_Widget() );
