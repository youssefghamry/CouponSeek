<?php
namespace Elementor;

/**
 * Elementor Button Group Widget.
 *
 * Elementor widget that inserts button group.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Button_Group_Widget extends Widget_Base {

	public function get_name() {
		return 'ssd_button_group';
	}

	public function get_title() {
		return __( 'Button Group', 'couponseek' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'couponseek' ];
	}

	public static function get_button_sizes() {
		return [
			'xs' => __( 'Extra Small', 'couponseek' ),
			'sm' => __( 'Small', 'couponseek' ),
			'md' => __( 'Medium', 'couponseek' ),
			'lg' => __( 'Large', 'couponseek' ),
			'xl' => __( 'Extra Large', 'couponseek' ),
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'buttons_section',
			[
				'label' => __( 'Buttons', 'couponseek' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'buttons_repeater' );

		$repeater->start_controls_tab( 'tab_content',
			[ 
				'label' => __( 'Content', 'couponseek' )
			]
		);

			$repeater->add_control(
				'button_type',
				[
					'label' => __( 'Type', 'couponseek' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'' => __( 'Default', 'couponseek' ),
						'color' => __( 'Colored', 'couponseek' ),
						'info' => __( 'Info', 'couponseek' ),
						'success' => __( 'Success', 'couponseek' ),
						'warning' => __( 'Warning', 'couponseek' ),
						'danger' => __( 'Danger', 'couponseek' ),
					],
					'prefix_class' => 'elementor-button-',
				]
			);

			$repeater->add_control(
				'text',
				[
					'label' => __( 'Text', 'couponseek' ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'default' => __( 'Click here', 'couponseek' ),
					'placeholder' => __( 'Click here', 'couponseek' ),
				]
			);

			$repeater->add_control(
				'link',
				[
					'label' => __( 'Link', 'couponseek' ),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'https://your-link.com', 'couponseek' ),
					'default' => [
						'url' => '#',
					],
				]
			);

			$repeater->add_responsive_control(
				'align',
				[
					'label' => __( 'Alignment', 'couponseek' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left'    => [
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
						'justify' => [
							'title' => __( 'Justified', 'couponseek' ),
							'icon' => 'fa fa-align-justify',
						],
					],
					'prefix_class' => 'elementor%s-align-',
					'default' => '',
				]
			);

			$repeater->add_control(
				'size',
				[
					'label' => __( 'Size', 'couponseek' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'sm',
					'options' => self::get_button_sizes(),
					'style_transfer' => true,
				]
			);

			$repeater->add_control(
				'icon',
				[
					'label' => __( 'Icon', 'couponseek' ),
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => '',
				]
			);

			$repeater->add_control(
				'icon_align',
				[
					'label' => __( 'Icon Position', 'couponseek' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'left',
					'options' => [
						'left' => __( 'Before', 'couponseek' ),
						'right' => __( 'After', 'couponseek' ),
					],
					'condition' => [
						'icon!' => '',
					],
				]
			);

			$repeater->add_control(
				'icon_indent',
				[
					'label' => __( 'Icon Spacing', 'couponseek' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'condition' => [
						'icon!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$repeater->add_control(
				'view',
				[
					'label' => __( 'View', 'couponseek' ),
					'type' => Controls_Manager::HIDDEN,
					'default' => 'traditional',
				]
			);

			$repeater->add_control(
				'button_css_id',
				[
					'label' => __( 'Button ID', 'couponseek' ),
					'type' => Controls_Manager::TEXT,
					'default' => '',
					'title' => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'couponseek' ),
					'label_block' => false,
					'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'couponseek' ),
					'separator' => 'before',

				]
			);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'style_content',
			[
				'label' => __( 'Style', 'couponseek' )
			]
		);

			$repeater->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography',
					'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} a.elementor-button, {{WRAPPER}} {{CURRENT_ITEM}} .elementor-button',
				]
			);

			$repeater->add_control(
				'button_text_color',
				[
					'label' => __( 'Text Color', 'couponseek' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} a.elementor-button, {{WRAPPER}} {{CURRENT_ITEM}} .elementor-button' => 'color: {{VALUE}};',
					],
				]
			);

			$repeater->add_control(
				'background_color',
				[
					'label' => __( 'Background Color', 'couponseek' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} a.elementor-button, {{WRAPPER}} {{CURRENT_ITEM}} .elementor-button' => 'background-color: {{VALUE}};',
					],
				]
			);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'couponseek' ),
			]
		);

			$repeater->add_control(
				'hover_color',
				[
					'label' => __( 'Text Color', 'couponseek' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} a.elementor-button:hover, {{WRAPPER}} {{CURRENT_ITEM}} .elementor-button:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$repeater->add_control(
				'button_background_hover_color',
				[
					'label' => __( 'Background Color', 'couponseek' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} a.elementor-button:hover, {{WRAPPER}} {{CURRENT_ITEM}} .elementor-button:hover' => 'background-color: {{VALUE}};',
					],
				]
			);

			$repeater->add_control(
				'button_hover_border_color',
				[
					'label' => __( 'Border Color', 'couponseek' ),
					'type' => Controls_Manager::COLOR,
					'condition' => [
						'border_border!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} a.elementor-button:hover, {{WRAPPER}} {{CURRENT_ITEM}} .elementor-button:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

			$repeater->add_control(
				'hover_animation',
				[
					'label' => __( 'Hover Animation', 'couponseek' ),
					'type' => Controls_Manager::HOVER_ANIMATION,
				]
			);

			$repeater->end_controls_tab();

			$repeater->end_controls_tabs();

			$repeater->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'border',
					'placeholder' => '1px',
					'default' => '1px',
					'selector' => '{{WRAPPER}} .elementor-button',
					'separator' => 'before',
				]
			);

			$repeater->add_control(
				'border_radius',
				[
					'label' => __( 'Border Radius', 'couponseek' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} a.elementor-button, {{WRAPPER}} {{CURRENT_ITEM}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$repeater->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'button_box_shadow',
					'selector' => '{{WRAPPER}} .elementor-button',
				]
			);

			$repeater->add_responsive_control(
				'text_padding',
				[
					'label' => __( 'Padding', 'couponseek' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} a.elementor-button, {{WRAPPER}} {{CURRENT_ITEM}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'repeater_buttons',
			[
				'label' => __( 'Buttons', 'couponseek' ),
				'type' => Controls_Manager::REPEATER,
				'label_block' => true,
				'fields' => array_values( $repeater->get_controls() ),
				'default' => [],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'layout_section',
			[
				'label' => __( 'Layout', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'direction',
			[
				'label' => __( 'Direction', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => __( 'Horizontal', 'couponseek' ),
					'vertical' => __( 'Vertical', 'couponseek' ),
				],
				'prefix_class'		=> 'ssd-button-group-direction-'
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' 		=> __( 'Alignment', 'couponseek' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'default' 		=> '',
				'options' 		=> [
					'left'    		=> [
						'title' 	=> __( 'Left', 'couponseek' ),
						'icon' 		=> 'eicon-h-align-left',
					],
					'center' 		=> [
						'title' 	=> __( 'Center', 'couponseek' ),
						'icon' 		=> 'eicon-h-align-center',
					],
					'right' 		=> [
						'title' 	=> __( 'Right', 'couponseek' ),
						'icon' 		=> 'eicon-h-align-right',
					],
					'justify' 		=> [
						'title' 	=> __( 'Stretch', 'couponseek' ),
						'icon' 		=> 'eicon-h-align-stretch',
					],
				],
				'prefix_class'		=> 'ssd-button-group-align-'
			]
		);

		$this->add_responsive_control(
			'spacing',
			[
				'label' => __( 'Spacing', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'couponseek' ),
					'small' => __( 'Small', 'couponseek' ),
					'medium' => __( 'Medium', 'couponseek' ),
					'big' => __( 'Big', 'couponseek' ),
					'custom' => __( 'Custom', 'couponseek' ),
				],
				'prefix_class'		=> 'ssd-button-group-spacing-'
			]
		);

		$this->add_responsive_control(
			'custom_spacing',
			[
				'label' => __( 'Spacing', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'condition' => [
					'spacing' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}}.ssd-button-group-direction-horizontal .elementor-button-group-flex-container' => 'margin-left: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.ssd-button-group-direction-horizontal .elementor-button-wrapper' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.ssd-button-group-direction-vertical .elementor-button-wrapper:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Button Group', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'couponseek' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'couponseek' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'couponseek' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .elementor-button',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'couponseek' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-button',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => __( 'Padding', 'couponseek' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	protected function render_text($item) {

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'elementor-button-content-wrapper',
			],
			'icon-align' => [
				'class' => [
					'elementor-button-icon',
					'elementor-align-icon-' . $item['icon_align'],
				],
			],
			'text' => [
				'class' => 'elementor-button-text',
			],
		] );

		$this->add_inline_editing_attributes( 'text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $item['icon'] ) ) : ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
			</span>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $item['text']; ?></span>
		</span>
		<?php
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( count($settings['repeater_buttons']) > 0 ) {

			$this->add_render_attribute( 'flex_wrapper', 'class', 'elementor-button-group-flex-container' );
			?>
			<div <?php echo $this->get_render_attribute_string( 'flex_wrapper' ); ?>>
			<?php	
			foreach ($settings['repeater_buttons'] as $item) {
				
				$this->add_render_attribute( 'wrapper_' . $item['_id'], 'class', [
					'elementor-button-wrapper',
					'elementor-element',
					'elementor-button-' . $item['button_type'],
					'elementor-repeater-item-' . $item['_id']
				]);

				if ( ! empty( $item['link']['url'] ) ) {
					$this->add_render_attribute( 'button_' . $item['_id'], 'href', $item['link']['url'] );
					$this->add_render_attribute( 'button_' . $item['_id'], 'class', 'elementor-button-link' );

					if ( $item['link']['is_external'] ) {
						$this->add_render_attribute( 'button_' . $item['_id'], 'target', '_blank' );
					}

					if ( $item['link']['nofollow'] ) {
						$this->add_render_attribute( 'button_' . $item['_id'], 'rel', 'nofollow' );
					}
				}

				$this->add_render_attribute( 'button_' . $item['_id'], 'class', 'elementor-button' );
				$this->add_render_attribute( 'button_' . $item['_id'], 'role', 'button' );

				if ( ! empty( $item['button_css_id'] ) ) {
					$this->add_render_attribute( 'button_' . $item['_id'], 'id', $item['button_css_id'] );
				}

				if ( ! empty( $item['size'] ) ) {
					$this->add_render_attribute( 'button_' . $item['_id'], 'class', 'elementor-size-' . $item['size'] );
				}

				if ( $settings['hover_animation'] ) {
					$this->add_render_attribute( 'button_' . $item['_id'], 'class', 'elementor-animation-' . $settings['hover_animation'] );
				}

				?>
				<div <?php echo $this->get_render_attribute_string( 'wrapper_' . $item['_id'] ); ?>>
					<a <?php echo $this->get_render_attribute_string( 'button_' . $item['_id'] ); ?>>
						<?php $this->render_text($item); ?>
					</a>
				</div>
				<?php

			} // foreach repeater_buttons
			?>
			</div>
			<?php

		} // count repeater_buttons

	}

	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'text', 'class', 'elementor-button-text' );

		view.addInlineEditingAttributes( 'text', 'none' );

		if ( settings.repeater_buttons ) {
		#>
			<div class="elementor-button-group-flex-container">
		<#
			_.each( settings.repeater_buttons, function( item, index ) {
		#>
			<div class="elementor-button-wrapper elementor-element elementor-button-{{ item.button_type }} elementor-repeater-item-{{{ item._id }}}">
				<a id="{{ item.button_css_id }}" class="elementor-button elementor-size-{{ item.size }} elementor-animation-{{ item.hover_animation }}" href="{{ item.link.url }}" role="button">
					<span class="elementor-button-content-wrapper">
						<# if ( item.icon ) { #>
						<span class="elementor-button-icon elementor-align-icon-{{ item.icon_align }}">
							<i class="{{ item.icon }}" aria-hidden="true"></i>
						</span>
						<# } #>
						<span {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ item.text }}}</span>
					</span>
				</a>
			</div>
			<#
			})
			#>
			</div><!-- end elementor-button-group-flex-container -->
		<#
		}
		#>
		<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Button_Group_Widget() );