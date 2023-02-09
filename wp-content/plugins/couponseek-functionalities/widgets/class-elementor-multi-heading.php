<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor multi heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Multi_Heading_Widget extends Widget_Base {

	const HEADING_COUNT = 3;

	/**
	 * Get widget name.
	 *
	 * Retrieve heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ssd_multi_heading';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Multi Heading', 'couponseek' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve heading widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-type-tool';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the heading widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'couponseek' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'heading', 'title', 'text' ];
	}

	/**
	 * Register heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		for ( $i = 1; $i <= self::HEADING_COUNT; $i++ ) { 
			
			$this->start_controls_section(
				'heading_' . $i . 'section_title',
				[
					'label' => __( 'Heading ' . $i . ' Title', 'couponseek' ),
				]
			);

			$this->add_control(
				'heading_' . $i . '_rotator',
				[
					'label' => __( 'Text Rotator', 'couponseek' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'couponseek' ),
					'label_off' => __( 'No', 'couponseek' ),
					'return_value' => 'yes',
					'default' => '',
				]
			);

			$this->add_control(
				'heading_' . $i . '_title',
				[
					'label' => __( 'Title', 'couponseek' ),
					'type' => Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your title', 'couponseek' ),
					'default' => __( 'Add Your Heading Text Here', 'couponseek' ),
					'condition' => [
						'heading_' . $i . '_rotator!' => 'yes',
					],
				]
			);

			$repeater = new Repeater();

			$repeater->add_control(
				'heading_' . $i . '_rotator_text',
				[
					'type' => Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Text', 'couponseek' ),
					'default' => '',
				]
			);

			$this->add_control(
				'heading_' . $i . '_rotator_content_repeater',
				[
					'label' => __( 'Content', 'couponseek' ),
					'type' => Controls_Manager::REPEATER,
					'label_block' => true,
					'fields' => array_values( $repeater->get_controls() ),
					'default' => [],
					'title_field' => '{{{ heading_' . $i . '_rotator_text }}}',
					'condition' => [
						'heading_' . $i . '_rotator' => 'yes',
					],
				]
			);

			$this->add_control(
				'heading_' . $i . '_rotator_effect',
				[
					'label' => __( 'Rotate Effect', 'couponseek' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'fade',
					'options' => [
						'none' => __( 'None', 'couponseek' ),
						'fade' => __( 'Fade', 'couponseek' ),
						'dissolve' => __( 'Dissolve', 'couponseek' ),
						'flip' => __( 'Flip', 'couponseek' ),
						'flipUp' => __( 'Flip Up', 'couponseek' ),
						'flipCube' => __( 'Flip Cube', 'couponseek' ),
						'flipCubeUp' => __( 'Flip Cube Up', 'couponseek' ),
						'spin' => __( 'Spin', 'couponseek' ),
					],
					'condition' => [
						'heading_' . $i . '_rotator' => 'yes',
					],

				]
			);

			$this->add_control(
			'heading_' . $i . '_rotator_speed',
				[
					'label' => __( 'Rotate Speed', 'couponseek' ),
					'type' => Controls_Manager::NUMBER,
					'min' => '1',
					'max' => '100000',
					'default' => '2000',
					'condition' => [
						'heading_' . $i . '_rotator' => 'yes',
					],
				]
			);

			$this->add_control(
				'heading_' . $i . '_link',
				[
					'label' => __( 'Link', 'couponseek' ),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'https://your-link.com', 'couponseek' ),
					'default' => [
						'url' => '',
					],
					'separator' => 'before',
				]
			);

			$this->add_control(
				'heading_' . $i . '_size',
				[
					'label' => __( 'Size', 'couponseek' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default' => __( 'Default', 'couponseek' ),
						'small' => __( 'Small', 'couponseek' ),
						'medium' => __( 'Medium', 'couponseek' ),
						'large' => __( 'Large', 'couponseek' ),
						'xl' => __( 'XL', 'couponseek' ),
						'xxl' => __( 'XXL', 'couponseek' ),
					],
				]
			);

			$this->add_control(
				'heading_' . $i . '_header_size',
				[
					'label' => __( 'HTML Tag', 'couponseek' ),
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
						'p' => 'p',
					],
					'default' => 'h2',
				]
			);

			$this->add_responsive_control(
				'heading_' . $i . '_align',
				[
					'label' => __( 'Alignment', 'couponseek' ),
					'type' => Controls_Manager::CHOOSE,
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
						'justify' => [
							'title' => __( 'Justified', 'couponseek' ),
							'icon' => 'fa fa-align-justify',
						],
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}.elementor-widget-ssd_multi_heading .elementor-multi-heading-title_' . $i => 'text-align: {{VALUE}};',
					],
				]
			);


			$this->add_control(
				'heading_' . $i . '_display',
				[
					'label' => __( 'Display', 'couponseek' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'block',
					'options' => [
						'block' => __( 'Block', 'couponseek' ),
						'inline-block' => __( 'Inline Block', 'couponseek' ),
						'inline' => __( 'Inline', 'couponseek' ),
					],
					'selectors' => [
						'{{WRAPPER}}.elementor-widget-ssd_multi_heading .elementor-multi-heading-title_' . $i => 'display: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'heading_' . $i . '_view',
				[
					'label' => __( 'View', 'couponseek' ),
					'type' => Controls_Manager::HIDDEN,
					'default' => 'traditional',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'heading_' . $i . '_section_title_style',
				[
					'label' => __( 'Heading ' . $i . ' Title', 'couponseek' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'heading_' . $i . '_title_color',
				[
					'label' => __( 'Text Color', 'couponseek' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						// Stronger selector to avoid section style from overwriting
						'{{WRAPPER}}.elementor-widget-ssd_multi_heading .elementor-multi-heading-title_' . $i => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'heading_' . $i . '_typography',
					'selector' => '{{WRAPPER}} .elementor-multi-heading-title_' . $i,
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'heading_' . $i . '_text_shadow',
					'selector' => '{{WRAPPER}} .elementor-multi-heading-title_' . $i,
				]
			);

			$this->add_control(
				'heading_' . $i . '_blend_mode',
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
						'difference' => 'Difference',
						'exclusion' => 'Exclusion',
						'hue' => 'Hue',
						'luminosity' => 'Luminosity',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-multi-heading-title_' . $i => 'mix-blend-mode: {{VALUE}}',
					],
					'separator' => 'none',
				]
			);

			$this->add_control(
			'heading_' . $i . '_spacing',
			[
				'label' => __( 'Heading Spacing', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-multi-heading-title_' . $i => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

			$this->end_controls_section();

		}

	}

	/**
	 * Render multi heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		for ( $i = 1; $i <= self::HEADING_COUNT; $i++ ) { 

			if ( empty( $settings['heading_' . $i . '_title'] ) && $settings['heading_' . $i . '_rotator'] == '' ) {
				continue;
			}

			$this->add_render_attribute( 'heading_' . $i . '_title', 'class', 'elementor-multi-heading-title_' . $i );

			if ( ! empty( $settings['heading_' . $i . '_size'] ) ) {
				$this->add_render_attribute( 'heading_' . $i . '_title', 'class', 'elementor-size-' . $settings['heading_' . $i . '_size'] );
			}


			if ( $settings['heading_' . $i . '_rotator'] == 'yes' ) {
				$title = '';
				$rotator_text = array();
				foreach ( $settings['heading_' . $i . '_rotator_content_repeater'] as $index => $item ) {
					$rotator_text[] = $item['heading_' . $i . '_rotator_text'];
				}
				if ( $rotator_text ) {
					$title = '<span class="is-text-rotator" data-effect="' . $settings['heading_' . $i . '_rotator_effect'] . '" data-speed="' . $settings['heading_' . $i . '_rotator_speed'] . '">' . implode('||', $rotator_text) . '</span>';
				}				
				
			} else {
				$this->add_inline_editing_attributes( 'heading_' . $i . '_title' );
				$title = $settings['heading_' . $i . '_title'];
			}


			if ( ! empty( $settings['heading_' . $i . '_link']['url'] ) ) {
				$this->add_render_attribute( 'url', 'href', $settings['heading_' . $i . '_link']['url'] );

				if ( $settings['heading_' . $i . '_link']['is_external'] ) {
					$this->add_render_attribute( 'url', 'target', '_blank' );
				}

				if ( ! empty( $settings['heading_' . $i . '_link']['nofollow'] ) ) {
					$this->add_render_attribute( 'url', 'rel', 'nofollow' );
				}

				$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
			}

			$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['heading_' . $i . '_header_size'], $this->get_render_attribute_string( 'heading_' . $i . '_title' ), $title );

			echo $title_html;

		}

		
	}

	/**
	 * Render multi heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		for ( $i = 1; $i <= self::HEADING_COUNT; $i++ ) :
			?>
			<#

			if ( settings.heading_<?php echo $i; ?>_rotator == 'yes' ) {
				var title_<?php echo $i; ?> = '';
				var rotator_text = [];

				_.each( settings.heading_<?php echo $i; ?>_rotator_content_repeater, function( item ) {
					rotator_text.push(item.heading_<?php echo $i; ?>_rotator_text)
				});

				if ( rotator_text.length > 0 ) {
					title_<?php echo $i; ?> = '<span class="is-text-rotator" data-effect="' + settings.heading_<?php echo $i; ?>_rotator_effect + '" data-speed="' + settings.heading_<?php echo $i; ?>_rotator_speed + '">' + rotator_text.join('||') + '</span>';
				}				
				
			} else {
				view.addInlineEditingAttributes( 'heading_<?php echo $i; ?>_title' );
				var title_<?php echo $i; ?> = settings.heading_<?php echo $i; ?>_title;
			}


			if ( '' !== settings.heading_<?php echo $i; ?>_link.url ) {
				title_<?php echo $i; ?> = '<a href="' + settings.heading_<?php echo $i; ?>_link.url + '">' + title_<?php echo $i; ?> + '</a>';
			}

			view.addRenderAttribute( 'heading_<?php echo $i; ?>_title', 'class', [ 'elementor-multi-heading-title_<?php echo $i; ?>', 'elementor-size-' + settings.heading_<?php echo $i; ?>_size ] );

			

			var title_html_<?php echo $i; ?> = '<' + settings.heading_<?php echo $i; ?>_header_size  + ' ' + view.getRenderAttributeString( 'heading_<?php echo $i; ?>_title' ) + '>' + title_<?php echo $i; ?> + '</' + settings.heading_<?php echo $i; ?>_header_size + '>';

			print( title_html_<?php echo $i; ?> );
			#>
		<?php
		endfor;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Multi_Heading_Widget() );