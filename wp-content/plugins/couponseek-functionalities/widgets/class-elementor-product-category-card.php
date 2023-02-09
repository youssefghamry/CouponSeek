<?php
namespace Elementor;
/**
 * Elementor Product Category Card Widget.
 *
 * Elementor widget that inserts a card displaying a WooCommerce Category.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Product_Category_Card_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'ssd_product_category_card';
	}

	public function get_title() {
		return __( 'Product Category Card', 'couponseek' );
	}

	public function get_icon() {
		return 'eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'couponseek' ];
	}

	public function get_script_depends() {
		return [ 'couponseek_elementor-widgets-scripts' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'couponseek' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'product_category',
			[
				'label' => __( 'Product Category', 'couponseek' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => 'category',
				'options' => $this->get_product_categories(),
			]
		);

		$this->add_control(
			'show_number',
			[
				'label' => __( 'Show Number of Products', 'couponseek' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'couponseek' ),
				'label_off' => __( 'No', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'background_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Custom Background', 'couponseek' ),
				'separator' => 'before',
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
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'couponseek' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .CategoryCard .overlay-image',
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
				'selector' => '{{WRAPPER}} .CategoryCard .overlay-image:before',
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
					'{{WRAPPER}} .CategoryCard .overlay-image:before' => 'transition: opacity {{SIZE}}s;',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Image Overlay
		$this->start_controls_section(
			'image_overlay_section',
			[
				'label' => __( 'Image Overlay', 'couponseek' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->start_controls_tabs( 'tabs_background_overlay' );

		$this->start_controls_tab(
			'tab_overlay_normal',
			[
				'label' => __( 'Normal', 'couponseek' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .CategoryCard .overlay-mask',
			]
		);

		$this->add_control(
			'overlay_opacity',
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
					'{{WRAPPER}} .CategoryCard .overlay-mask' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_overlay_hover',
			[
				'label' => __( 'Hover', 'couponseek' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_hover',
				'selector' => '{{WRAPPER}} .CategoryCard .overlay-mask:before',
			]
		);

		/*
		 *
		 * Add class 'overlay-hover' to widget when assigned content animation
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
					'overlay_hover_background' => [ 'classic', 'gradient' ],
				],
			]
		);

		$this->add_control(
			'overlay_hover_opacity',
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
				'condition' => [
					'overlay_hover_background' => [ 'classic', 'gradient' ],
				],
				'selectors' => [
					'{{WRAPPER}} .CategoryCard:hover .overlay-mask:before' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'overlay_hover_transition',
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
					'{{WRAPPER}} .CategoryCard .overlay-mask:before' => 'transition: opacity {{SIZE}}s;',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'custom_height',
			[
				'label' => __( 'Height', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 280,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1440,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .CategoryCard' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label' => __( 'Title Spacing', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .CategoryCard .category-card-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Icon', 'couponseek' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 45,
				],
				'selectors' => [
					'{{WRAPPER}} .CategoryCard .category-card-icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_offset',
			[
				'label' => __( 'Icon Size', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .CategoryCard .category-card-icon' => 'top: {{SIZE}}{{UNIT}};left: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Show Icon Background Color', 'couponseek' ),
				'description' => __( 'Background Color is set for each icon in the Admin Dashboard > Products > Categories.', 'couponseek' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'couponseek' ),
				'label_off' => __( 'No', 'couponseek' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label' => __( 'Icon Padding', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 25,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 10,
				],
				'condition' => [
					'icon_bg_color!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .CategoryCard .category-card-icon' => 'padding: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'icon_bg_color!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .CategoryCard .category-card-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'number_label_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Number Label', 'couponseek' ),
				'condition' => [
					'show_number' => 'yes',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .CategoryCard .category-card-count',
				'condition' => [
					'show_number' => 'yes',
				],
			]
		);

		$this->add_control(
			'number_label_color',
			[
				'label' => __( 'Label Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .CategoryCard .category-card-count' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'number_background_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .CategoryCard .category-card-count' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'number_padding',
			[
				'label' => __( 'Padding', 'couponseek' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 5,
					'right' => 30,
					'bottom' => 5,
					'left' => 30,
				],
				'condition' => [
					'show_number' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .CategoryCard .category-card-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'content_colors',
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
			'category_text_color',
			[
				'label' => __( 'Category Text Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .CategoryCard .category-card-title' => 'color: {{VALUE}};',
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
			'category_text_hover_color',
			[
				'label' => __( 'Category Text Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .CategoryCard:hover .category-card-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_hover_transition',
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
					'{{WRAPPER}} .CategoryCard .category-card-icon svg' => 'transition: {{SIZE}}s;',
					'{{WRAPPER}} .CategoryCard .category-card-title' => 'transition: {{SIZE}}s;',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function get_product_categories() {
		$product_cats = get_terms('product_cat');
		$product_cats_list = array();

		if ( !empty($product_cats) && !is_wp_error($product_cats) ) {
			foreach ($product_cats as $cat_obj) {
				$term_slug = $cat_obj->slug;
				$term_name = $cat_obj->name;
				$product_cats_list[$term_slug] = $term_name;
			}
		}

		return $product_cats_list;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$product_category = get_term_by('slug', $settings['product_category'], 'product_cat');

		if ( !empty( $product_category ) && ! is_wp_error( $product_category ) ) :
		?>

		<a href="<?php echo esc_url(get_term_link($product_category)); ?>" class="CategoryCard">
			<?php 
			$image_id = get_term_meta( $product_category->term_id, 'thumbnail_id', true );
			$image_url = wp_get_attachment_image_src($image_id, 'couponseek_large_soft');
			?>
			<?php if ( $image_url[0] ) : ?>
			<div class="bg-image" data-bg-image="<?php echo esc_url($image_url[0]); ?>"></div>
			<?php endif; ?>
			<div class="overlay-image">
				<div class="overlay-mask"></div>
			</div>
			<?php if ( couponseek_get_field('category_icon', "{$product_category->taxonomy}_{$product_category->term_id}") ) :
			$icon_class = couponseek_get_field('category_icon', "{$product_category->taxonomy}_{$product_category->term_id}"); ?>
			<div class="category-card-icon">
				<?php if ( $settings['icon_bg_color'] ) : ?>
				<svg viewBox="0 0 100 100" class="icon-svg" data-bg-color="<?php echo esc_attr(couponseek_get_field('icon_bg_color', "{$product_category->taxonomy}_{$product_category->term_id}")) ?>">
					<use xlink:href="#<?php echo esc_attr($icon_class); ?>"></use>
				</svg>
				<?php else : ?>
				<svg viewBox="0 0 100 100" class="icon-svg">
					<use xlink:href="#<?php echo esc_attr($icon_class); ?>"></use>
				</svg>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<div class="category-card-inner">
				<h2 class="category-card-title"><?php echo wp_kses_post($product_category->name) ?></h2>
				<div class="category-card-count"><?php echo sprintf( _n( '%s Deal', '%s Deals', $product_category->count, 'couponseek' ), $product_category->count ) ?></div>	
			</div>

		</a><!-- end CategoryCard -->

	<?php
		endif; // !empty( $product_category )
	}

}

if ( class_exists( 'WooCommerce' ) ) {
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Product_Category_Card_Widget() );
}