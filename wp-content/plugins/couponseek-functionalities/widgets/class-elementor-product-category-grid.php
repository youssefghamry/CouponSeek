<?php
namespace Elementor;
/**
 * Elementor Product Category Grid Widget.
 *
 * Elementor widget that inserts a grid displaying WooCommerce Categories.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Product_Category_Grid_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'ssd_product_category_grid';
	}

	public function get_title() {
		return __( 'Product Categories Grid', 'couponseek' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
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
			'grid_title',
			[
				'label' => __( 'Grid Title', 'couponseek' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Categories', 'couponseek' ),
			]
		);

		$this->add_control(
			'title_alignment',
			[
				'label' => __( 'Title Alignment', 'couponseek' ),
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
				'default' => 'left',
			]
		);

		$this->add_control(
			'hide_categories',
			[
				'label' => __( 'Hide Categories', 'couponseek' ),
				'description' => __( 'Selected categories will not be displayed in the categories list.', 'couponseek' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'default' => false,
				'options' => $this->get_product_categories(),
				'separator' => 'before'
			]
		);

		$this->add_control(
			'show_parents_only',
			[
				'label' => __( 'Show Parent Categories Only', 'couponseek' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'couponseek' ),
				'label_off' => __( 'No', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_icons',
			[
				'label' => __( 'Show Categories Icons', 'couponseek' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'couponseek' ),
				'label_off' => __( 'No', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
			'show_empty_categories',
			[
				'label' => __( 'Show Empty Categories', 'couponseek' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'couponseek' ),
				'label_off' => __( 'No', 'couponseek' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => '1',
				'max' => '4',
				'default' => '3'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section_title',
			[
				'label' => __( 'Grid Title', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'grid_title!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'grid_title_padding',
			[
				'label' => __( 'Padding', 'couponseek' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-categories-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'grid_title_typography',
				'label' => __( 'Typography', 'couponseek' ),
				'selector' => '{{WRAPPER}} .ProductCategories .product-categories-title h4',
			]
		);

		$this->add_control(
			'grid_title_color',
			[
				'label' => __( 'Title Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-categories-title h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'grid_title_background_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-categories-title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Categories Grid', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'grid_padding',
			[
				'label' => __( 'Padding', 'couponseek' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-categories-grid' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'grid_background_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-categories-grid' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Category Item', 'couponseek' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'item_gap',
			[
				'label' => __( 'Item Gap', 'couponseek' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'desktop_default' => [
					'top' => 0,
					'right' => 15,
					'bottom' => 20,
					'left' => 15,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-category' => 'padding-left: {{LEFT}}{{UNIT}};padding-right: {{RIGHT}}{{UNIT}};margin-top: {{TOP}}{{UNIT}};margin-bottom: {{BOTTOM}}{{UNIT}};',
					'{{WRAPPER}} .ProductCategories' => 'margin: 0 -{{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label' => __( 'Item Padding', 'couponseek' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-category > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'label' => __( 'Box Shadow', 'couponseek' ),
				'fields_options' => [
					'box_shadow' => [
						'default' => [
							'horizontal' => 0,
							'vertical' => 4,
							'blur' => 15,
							'spread' => -10,
							'color' => 'rgba(0,0,0,0.35)',
						]
					]
				],
				'selector' => '{{WRAPPER}} .ProductCategories .product-category > a',
			]
		);

		$this->start_controls_tabs( 'color_item_tabs' );

		$this->start_controls_tab( 
			'colors_item_normal',
			[
				'label' => __( 'Normal', 'couponseek' ),
			]
		);

		$this->add_control(
			'category_item_bg_color',
			[
				'label' => __( 'Category Item Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-category > a' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'colors_item_hover',
			[
				'label' => __( 'Hover', 'couponseek' ),
			]
		);

		$this->add_control(
			'category_item_bg_hover_color',
			[
				'label' => __( 'Category Item Background Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-category > a:hover' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'item_hover_transition',
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
					'{{WRAPPER}} .ProductCategories .product-category > a' => 'transition: {{SIZE}}s;',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'icon_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Category Icon', 'couponseek' ),
				'condition' => [
					'show_icons!' => '',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'icon_width',
			[
				'label' => __( 'Icon Width', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 150,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 65,
				],
				'condition' => [
					'show_icons!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-category .category-icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 150,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'condition' => [
					'show_icons!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-category .category-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_gap',
			[
				'label' => __( 'Icon Gap', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'condition' => [
					'show_icons!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-category .category-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Show Icons Background Color', 'couponseek' ),
				'description' => __( 'Background Color is set for each icon in the Admin Dashboard > Products > Categories.', 'couponseek' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'couponseek' ),
				'label_off' => __( 'No', 'couponseek' ),
				'return_value' => 'yes',
				'condition' => [
					'show_icons!' => '',
				],
				'default' => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .ProductCategories .product-category .category-icon',
				'condition' => [
					'show_icons!' => '',
				],
				'separator' => 'before',
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
						'max' => 150,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'show_icons!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-category .category-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Category Title', 'couponseek' ),
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'couponseek' ),
				'selector' => '{{WRAPPER}} .ProductCategories .product-category .product-category-title',
			]
		);

		$this->start_controls_tabs( 'color_title_tabs' );

		$this->start_controls_tab(
			'colors_title_normal',
			[
				'label' => __( 'Normal', 'couponseek' ),
			]
		);

		$this->add_control(
			'category_title_color',
			[
				'label' => __( 'Title Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-category .product-category-title' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'category_number_color',
			[
				'label' => __( 'Number Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'show_number!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-category .number-counter' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'colors_title_hover',
			[
				'label' => __( 'Hover', 'couponseek' ),
			]
		);

		$this->add_control(
			'category_title_hover_color',
			[
				'label' => __( 'Title Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-category > a:hover .product-category-title' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'category_number_hover_color',
			[
				'label' => __( 'Number Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'show_number!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ProductCategories .product-category > a:hover .number-counter' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'title_hover_transition',
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
					'{{WRAPPER}} .ProductCategories .product-category .product-category-title' => 'transition: {{SIZE}}s;',
					'{{WRAPPER}} .ProductCategories .product-category .number-counter' => 'transition: {{SIZE}}s;',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function get_product_categories() {
		$product_cats = get_terms(array( 
			'taxonomy' => 'product_cat',
			'hide_empty' => false,
			'parent' => 0
		));
		$product_cats_list = array();

		if ( !is_wp_error($product_cats) ) {
			foreach ($product_cats as $cat_obj) {
				$term_id = $cat_obj->term_id;
				$term_name = $cat_obj->name;
				$product_cats_list[$term_id] = $term_name;
				$product_cats_children = get_terms('product_cat', array( 
					'hide_empty' => false,
					'parent' => $term_id
				));
				if ($product_cats_children) {
					foreach ($product_cats_children as $cat_obj_child) {
						$term_id_child = $cat_obj_child->term_id;
						$term_name_child = $cat_obj_child->name;
						$product_cats_list[$term_id_child] = $term_name_child;
					}
				}
			}
		}

		return $product_cats_list;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$title_alignment = $settings['title_alignment'] ? 'text-' . $settings['title_alignment'] : 'text-left';
		$hidden_cats = $settings['hide_categories'] ? $settings['hide_categories'] : array();

		?>

		<div class="ProductCategories SSDItemsGrid">

			<?php if ( $settings['grid_title'] ) : ?>
			<div class="product-categories-title <?php echo esc_attr($title_alignment); ?>">
				<h4><?php echo wp_kses_post($settings['grid_title']); ?></h4>
			</div>
			<?php endif; ?>

			<?php 

			$term_args = array( 
				'taxonomy' => 'product_cat',
				'hide_empty' => $settings['show_empty_categories'] ? false : true,
				'parent' => 0
			);

			if ( $hidden_cats ){
				$term_args['exclude_tree'] = $hidden_cats;
			}

			$product_cats = get_terms($term_args );

			if ( ! empty( $product_cats ) && ! is_wp_error( $product_cats ) ) : ?>

				<div class="product-categories-grid items-row items-columns-<?php echo esc_attr($settings['columns']); ?> font-heading">

					<?php foreach ( $product_cats as $product_cat ) :
						$thumbnail_id = get_term_meta( $product_cat->term_id, 'thumbnail_id', true );
						$image = wp_get_attachment_url( $thumbnail_id );
						?>
						<div class="item-wrapper product-category pos-r">
							<a href="<?php echo esc_url(get_term_link($product_cat)); ?>" class="pos-r">
								<?php if ( couponseek_get_field('category_icon', "{$product_cat->taxonomy}_{$product_cat->term_id}") && $settings['show_icons'] ) :
									$icon_class = couponseek_get_field('category_icon', "{$product_cat->taxonomy}_{$product_cat->term_id}"); ?>
									<div class="category-icon">
										<?php if ( $settings['icon_bg_color'] ) : ?>
										<svg viewBox="0 0 100 100" class="icon-svg" data-bg-color="<?php echo esc_attr(couponseek_get_field('icon_bg_color', "{$product_cat->taxonomy}_{$product_cat->term_id}")) ?>">
											<use xlink:href="#<?php echo esc_attr($icon_class); ?>"></use>
										</svg>
										<?php else : ?>
										<svg viewBox="0 0 100 100" class="icon-svg">
											<use xlink:href="#<?php echo esc_attr($icon_class); ?>"></use>
										</svg>
										<?php endif; ?>
									</div>
								<?php elseif ( $image && $settings['show_icons'] ) : ?>
								<div class="category-icon">
									<div class="bg-image" data-bg-image="<?php echo esc_url($image); ?>"></div>
								</div>	
								<?php endif; ?>
								<div class="product-category-meta pos-r">
									<div class="product-category-title">
										<?php echo wp_kses_post($product_cat->name); ?>
										<?php if ( $settings['show_number'] ) : ?>
										<span class="number-counter"> - (<?php echo wp_kses_post($product_cat->count); ?>)</span>
										<?php endif; ?>
									</div>
								</div>
							</a>
						</div>
						<?php 
						if ( empty( $settings['show_parents_only'] ) ) :
							$product_id = $product_cat->term_id;
							$child_term_args = array( 
								'hide_empty' => $settings['show_empty_categories'] ? false : true,
								'parent' => $product_id
							);
							if ( $hidden_cats ){
								$child_term_args['exclude_tree'] = $hidden_cats;
							}
							// $product_cats_children = get_term_children( $product_id, 'product_cat' );
							$product_cats_children = get_terms('product_cat', $child_term_args );
							if ( $product_cats_children ) : ?>
								<?php foreach ( $product_cats_children as $product_cats_child ) :
									$child_cat = get_term($product_cats_child);
									$child_thumbnail_id = get_term_meta( $child_cat->term_id, 'thumbnail_id', true );
									$child_image = wp_get_attachment_url( $child_thumbnail_id );
									?>
									<div class="item-wrapper product-category pos-r">
										<a href="<?php echo esc_url(get_term_link($product_cats_child)); ?>" class="pos-r">
											<?php if ( couponseek_get_field('category_icon', "{$child_cat->taxonomy}_{$child_cat->term_id}") && $settings['show_icons'] ) :
												$icon_class = couponseek_get_field('category_icon', "{$child_cat->taxonomy}_{$child_cat->term_id}"); ?>
												<div class="category-icon">
													<?php if ( $settings['icon_bg_color'] ) : ?>
													<svg viewBox="0 0 100 100" class="icon-svg" data-bg-color="<?php echo esc_attr(couponseek_get_field('icon_bg_color', "{$child_cat->taxonomy}_{$child_cat->term_id}")) ?>">
														<use xlink:href="#<?php echo esc_attr($icon_class); ?>"></use>
													</svg>
													<?php else : ?>
													<svg viewBox="0 0 100 100" class="icon-svg">
														<use xlink:href="#<?php echo esc_attr($icon_class); ?>"></use>
													</svg>
													<?php endif; ?>
												</div>
											<?php elseif ( $child_image && $settings['show_icons'] ) : ?>
												<div class="category-icon">
													<div class="bg-image" data-bg-image="<?php echo esc_url($child_image); ?>"></div>
												</div>	
											<?php endif; ?>
											<div class="product-category-meta pos-r">
												<div class="product-category-title">
													<?php echo wp_kses_post($child_cat->name); ?>
													<?php if ( $settings['show_number'] ) : ?>
													<span class="number-counter"> - (<?php echo wp_kses_post($child_cat->count); ?>)</span>
													<?php endif; ?>
												</div>
											</div>
										</a>
									</div>
								<?php endforeach; ?>
							<?php endif;
							?>
						<?php endif; ?> 
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div> <!-- end ProductCategories -->

	<?php
	}

}

if ( class_exists( 'WooCommerce' ) ) {
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Product_Category_Grid_Widget() );
}