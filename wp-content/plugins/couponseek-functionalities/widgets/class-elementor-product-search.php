<?php
/**
 * Elementor Product Search Widget.
 *
 * Elementor widget that inserts a WooCommerce search box.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Product_Search extends \Elementor\Widget_Base {

	public function get_name() {
		return 'ssd_product_search';
	}

	public function get_title() {
		return __( 'Product Search', 'couponseek' );
	}

	public function get_icon() {
		return 'eicon-search';
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
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'widget_position',
			[
				'label' => __( 'Widget Position', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'couponseek' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'couponseek' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'couponseek' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .ProductSearch .search-form-filters' => 'text-align: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'search_placeholder',
			[
				'label' => __( 'Search Placeholder', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'default' => __( "I'm searching for...", 'couponseek' ),
				'placeholder' => __( "I'm searching for...", 'couponseek' ),
			]
		);

		$this->add_control(
			'search_options',
			[
				'label' => __( 'Search Options', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __( 'Category', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'couponseek' ),
				'label_off' => __( 'Hide', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'category_icon',
			[
				'label' => __( 'Category Icon', 'couponseek' ),
				'type' => 'svg_icon',
				'default' => 'icon-svg-box',
				'condition' => [
					'category' => 'yes',
				],
			]
		);

		$this->add_control(
			'country',
			[
				'label' => __( 'Country', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'couponseek' ),
				'label_off' => __( 'Hide', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'country_icon',
			[
				'label' => __( 'Country Icon', 'couponseek' ),
				'type' => 'svg_icon',
				'default' => 'icon-svg-map-3',
				'condition' => [
					'country' => 'yes',
				],
			]
		);

		$this->add_control(
			'city',
			[
				'label' => __( 'City', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'couponseek' ),
				'label_off' => __( 'Hide', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'city_icon',
			[
				'label' => __( 'City Icon', 'couponseek' ),
				'type' => 'svg_icon',
				'default' => 'icon-svg-landmark-4',
				'condition' => [
					'city' => 'yes',
				],
			]
		);

		$this->add_control(
			'vendor',
			[
				'label' => __( 'Vendor', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'couponseek' ),
				'label_off' => __( 'Hide', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'vendor_icon',
			[
				'label' => __( 'Company Icon', 'couponseek' ),
				'type' => 'svg_icon',
				'default' => 'icon-svg-shopping-bag-2',
				'condition' => [
					'vendor' => 'yes',
				],
			]
		);

		$this->add_control(
			'display_options',
			[
				'label' => __( 'Display Options', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_parents_only',
			[
				'label' => __( 'Show Parent Categories Only', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'couponseek' ),
				'label_off' => __( 'No', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'search_style_section',
			[
				'label' => __( 'Search Input', 'couponseek' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'search_border_type',
			[
				'label' => __( 'Border Type', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => __( 'None', 'couponseek' ),
					'solid' => __( 'Solid', 'couponseek' ),
					'double' => __( 'Double', 'couponseek' ),
					'dotted' => __( 'Dotted', 'couponseek' ),
					'dashed' => __( 'Dashed', 'couponseek' ),
				],
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}} .ProductSearch .search-form-input' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'search_border_width',
			[
				'label' => __( 'Width', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 1,
					'right' => 1,
					'bottom' => 1,
					'left' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSearch .search-form-input' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'search_border_type!' => '',
				],
			]
		);

		$this->add_control(
			'search_border_color',
			[
				'label' => __( 'Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#efefef',
				'selectors' => [
					'{{WRAPPER}} .ProductSearch .search-form-input' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'search_border_type!' => '',
				],
			]
		);

		$this->add_control(
			'button_position',
			[
				'label' => __( 'Button Position', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'couponseek' ),
						'icon'  => 'eicon-arrow-left',
					],
					'below' => [
						'title' => __( 'Below', 'couponseek' ),
						'icon'  => 'eicon-arrow-down',
					],
					'right' => [
						'title' => __( 'Right', 'couponseek' ),
						'icon'  => 'eicon-arrow-right',
					],
				],
				'default' => 'below',
			]
		);

		$this->add_responsive_control(
			'search_custom_width',
			[
				'label' => __( 'Custom Width', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'couponseek' ),
				'label_off' => __( 'No', 'couponseek' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_responsive_control(
			'search_width',
			[
				'label' => __( 'Search Width', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 150,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSearch input.search-form-input' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'search_custom_width' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'search_spacing',
			[
				'label' => __( 'Search Spacing', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSearch input.search-form-input' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'dropdowns_style_section',
			[
				'label' => __( 'Dropdowns', 'couponseek' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'dropdown_width',
			[
				'label' => __( 'Button Width', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 60,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 120,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSearch .dropdown' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'dropdown_border',
				'label' => __( 'Border', 'couponseek' ),
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
						],
					],
					'color' => [
						'default' => '#efefef',
					],
				],
				'selector' => '{{WRAPPER}} .ProductSearch .dropdown',
			]
		);

		$this->add_control(
			'dropdown_border_radius',
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
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSearch .dropdown' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_style',
			[
				'label' => __( 'Content', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'font_size',
			[
				'label' => __( 'Font Size', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 8,
						'max' => 30,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSearch .dropdown' => 'font-size: {{SIZE}}{{UNIT}};',
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
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 55,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSearch .dropdown-content svg, {{WRAPPER}} .ProductSearch .dropdown-content .svg-placeholder' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$button_position = $settings['button_position'] ? 'button-' . $settings['button_position'] : 'button-below';
			$this->add_render_attribute( 'form-wrapper', 'class', [
				'search-form-wrapper',
				$button_position
			] );
		?>

		<div class="ProductSearch">
			<div <?php echo $this->get_render_attribute_string( 'form-wrapper' ); ?>>
				<form action="<?php echo esc_url( home_url( "/" ) ); ?>" method="get">
					<div class="search-form-filters">
						<div class="search-form-filters-inner">
							<?php 
							if ( $settings['category'] == 'yes' ) :
								$term_args = array();
								if ( $settings['show_parents_only'] == 'yes' ) {
									$term_args['parent'] = 0;
								}
								$product_cats = get_terms('product_cat', $term_args );
								if ( !empty($product_cats) && !is_wp_error($product_cats) ) : 
									if ( !empty($_GET['product_category']) ) {
										$product_cat_current = $_GET['product_category'];
									} else {
										$product_cat_current = '';
									}
									?>

									<div class="dropdown">

										<div id="categories-product-dropdown" class="dropdown-button" data-toggle="dropdown" >
											<div class="dropdown-content">
												<svg viewBox="0 0 100 100" class="icon-svg is-dropdown-svg">
													<use xlink:href="#<?php echo esc_attr($settings['category_icon']); ?>"></use>
												</svg>
												<span><?php echo esc_html__('Category', 'couponseek'); ?></span>
											</div><!-- end dropdown-content -->
										</div>

										<ul class="dropdown-menu is-perfect-scrollbar" aria-labelledby="categories-product-dropdown" data-name="product_category">
											<?php if ( !isset($current_cat) ) $current_cat = false; ?>
											<li>
												<a href="#" data-value="" data-current="<?php echo esc_attr($current_cat); ?>">
													<div class="category-icon">
														<svg viewBox="0 0 100 100" class="icon-svg">
															<use xlink:href="#<?php echo esc_attr($settings['category_icon']); ?>"></use>
														</svg>
													</div>
													<span><?php echo esc_html__('All', 'couponseek'); ?></span>
												</a>
											</li>
											<?php foreach ( $product_cats as $product_cat ) :

												if ( $product_cat->slug == $product_cat_current ) {
													$current_cat = 'true';
												} else {
													$current_cat = 'false';
												} ?>

												<li>
													<?php if ( couponseek_get_field('category_icon', "{$product_cat->taxonomy}_{$product_cat->term_id}") ) :
													$icon_class = couponseek_get_field('category_icon', "{$product_cat->taxonomy}_{$product_cat->term_id}");
													?>
													<a href="<?php echo esc_url(get_term_link($product_cat)); ?>" data-value="<?php echo esc_attr($product_cat->slug); ?>" data-current="<?php echo esc_attr($current_cat); ?>">
														<div class="category-icon">
															<svg viewBox="0 0 100 100" class="icon-svg" data-bg-color="<?php echo esc_attr(couponseek_get_field('icon_bg_color', "{$product_cat->taxonomy}_{$product_cat->term_id}")) ?>">
																<use xlink:href="#<?php echo esc_attr($icon_class); ?>"></use>
															</svg>
														</div>
														<span><?php echo wp_kses_post($product_cat->name); ?></span>
													</a>
													<?php 
													else : ?>
														<a href="<?php echo esc_url(get_term_link($product_cat)); ?>" data-value="<?php echo esc_attr($product_cat->slug); ?>" data-current="<?php echo esc_attr($current_cat); ?>"><span><?php echo wp_kses_post($product_cat->name); ?></span></a>
														<?php 
													endif; 
													?>
												</li>
											
											<?php endforeach; ?>
										</ul>
										<div class="dropdown-menu-overlay" data-name="product_category"></div>
									</div>
									<input type="hidden" value="<?php echo esc_attr($product_cat_current); ?>" name="product_category" />
								<?php endif; // endif product_cats
							endif; // end if $settings['category'] == 'yes' ?>
							<?php
							if ( $settings['country'] == 'yes' ) :
								$all_countries = array();
								if( ( $all_countries = get_transient('ssd_all_countries') ) === false ) {
									$all_countries = couponseek_get_all_countries();
								} else {
									$all_countries = get_transient('ssd_all_countries');
								}

								if ( !empty($_GET['product_country']) ) {
									$product_country_current = sanitize_title($_GET['product_country']);
								} else {
									$product_country_current = '';
								} ?>

								<!-- Countries Dropdown -->
								<div class="dropdown dropdown-countries">
									<div id="countries-product-dropdown" class="dropdown-button" data-toggle="dropdown">
										<div class="dropdown-content">
											<svg viewBox="0 0 100 100" class="icon-svg is-dropdown-svg">
												<use xlink:href="#<?php echo esc_attr($settings['country_icon']); ?>"></use>
											</svg>
											<span><?php echo esc_html__('Countries', 'couponseek'); ?></span>
										</div><!-- end dropdown-content -->
									</div>
									<ul class="dropdown-menu is-perfect-scrollbar" aria-labelledby="countries-product-dropdown" data-name="product_country">
										<?php if ( !isset($current_country) ) $current_country = false; ?>
										<li>
											<a href="javascript:void(0)" data-value="" data-current="<?php echo esc_attr($current_country); ?>"><span><?php echo esc_html__('All', 'couponseek'); ?></span></a>
										</li>
										<?php foreach ( $all_countries as $product_country ) :
											if ( $product_country['slug'] == $product_country_current ) {
												$current_country = 'true';
											} else {
												$current_country = 'false';
											} ?>
											<li>
												<a href="javascript:void(0)" data-value="<?php echo esc_attr($product_country['slug']); ?>" data-current="<?php echo esc_attr($current_country); ?>"><span><?php echo wp_kses_post($product_country['name']); ?></span></a>
											</li>
										<?php endforeach; ?>
									</ul>
									<div class="dropdown-menu-overlay" data-name="product_category"></div>
								</div>

								<input type="hidden" value="<?php echo esc_attr($product_country_current); ?>" name="product_country">

								<?php 
							endif; // if $settings['country'] == 'yes'
							?>
							<?php
							if ( $settings['city'] == 'yes' ) :

								if ( !empty($_GET['product_city']) ) {
									$product_city_current = $_GET['product_city'];
								} else {
									$product_city_current = '';
								} ?>

								<!-- Cities Dropdown -->
								<div class="dropdown dropdown-cities">
									<div id="cities-product-dropdown" class="dropdown-button is-city-product-dropdown" data-toggle="dropdown">
										<div class="dropdown-content">
											<svg viewBox="0 0 100 100" class="icon-svg is-dropdown-svg">
												<use xlink:href="#<?php echo esc_attr($settings['city_icon']); ?>"></use>
											</svg>
											<span><?php echo esc_html__('Cities', 'couponseek'); ?></span>
										</div><!-- end dropdown-content -->
									</div>

									<ul class="dropdown-menu is-perfect-scrollbar" aria-labelledby="cities-product-dropdown" data-name="product_city">

									</ul>
									<div class="dropdown-menu-overlay" data-name="product_category"></div>
								</div>

								<input type="hidden" value="<?php echo esc_attr($product_city_current); ?>" name="product_city">

							<?php 
							endif; // if $settings['city'] == 'yes'
							?>

							<?php if ( $settings['vendor'] == 'yes' && class_exists('WC_Vendors') ) : ?>
								<?php 
								$vendors = couponseek_get_wc_vendors();
								$vendors_ids = array_keys($vendors);

								if ( !empty($_GET['product_company']) ) {
									$product_company_current = $_GET['product_company'];
								} else {
									$product_company_current = '';
								}

								if ( !isset($vendors['no-such-taxonomy']) && !isset($vendors['no-wc-vendors']) ) :
								?>
								<!-- Companies Dropdown -->
								<div class="dropdown">

									<div id="vendors-product-dropdown" class="dropdown-button" data-toggle="dropdown" >
										<div class="dropdown-content">
											<svg viewBox="0 0 100 100" class="icon-svg is-dropdown-svg">
												<use xlink:href="#<?php echo esc_attr($settings['vendor_icon']); ?>"></use>
											</svg>
											<span><?php echo esc_html__('Company', 'couponseek'); ?></span>
										</div><!-- end dropdown-content -->
									</div>

									<ul class="dropdown-menu is-perfect-scrollbar" aria-labelledby="vendors-product-dropdown" data-name="product_vendor">
										<?php if ( !isset($current_vendor) ) $current_vendor = false; ?>
										<li>
											<a href="#" data-value="" data-current="<?php echo esc_attr($current_vendor); ?>"><span><?php echo esc_html__('All', 'couponseek'); ?></span></a>
										</li>
										
										<?php foreach ( $vendors_ids as $vendor_id ) :
											$shop_name =  get_user_meta( $vendor_id, 'pv_shop_name', true );
											if ( $shop_name == $product_company_current ) {
												$current_vendor = 'true';
											} else {
												$current_vendor = 'false';
											} ?>

											<li>
												<a href="<?php echo WCV_Vendors::get_vendor_shop_page( $vendor_id ); ?>" data-value="<?php echo esc_attr($shop_name); ?>" data-current="<?php echo esc_attr($current_vendor); ?>"><span><?php echo wp_kses_post($shop_name); ?></span></a>
											</li>

										<?php endforeach; ?>

									</ul>
									<div class="dropdown-menu-overlay" data-name="product_category"></div>
								</div>
								<?php endif; // if !isset($vendors['no-such-taxonomy']) ?>

							<input type="hidden" value="<?php echo esc_attr($product_company_current); ?>" name="product_vendor">

							<?php endif;  // if $settings['vendor'] == 'yes'
							?>

							<input class="search-form-input" type="search" name="s" placeholder="<?php echo wp_kses_post( $settings['search_placeholder'] ); ?>">				
							
							<button type="submit" id="searchsubmit" class="search-button btn btn-color"><?php echo esc_html__('Search', 'couponseek'); ?></button>

						</div><!-- end search-form-filters-inner -->
					</div> <!-- end search-form-filters -->

					<input type="hidden" name="post_type" value="product" />
				</form>
			</div>
		</div> <!-- end ProductSearch -->

		<?php
	}

	protected function _content_template() { ?>
		<#
		view.addRenderAttribute( 'form-wrapper', 'class', 'search-form-wrapper button-' + settings.button_position );
		#>
		<div class="ProductSearch">
			<div {{{ view.getRenderAttributeString( 'form-wrapper' ) }}}>
				<form>
					<div class="search-form-filters">
						<div class="search-form-filters-inner">
							<# if ( settings.category == 'yes' ) { #>
							<div class="dropdown">
								<div id="categories-product-dropdown" class="dropdown-button">
									<div class="dropdown-content">
										<svg viewBox="0 0 100 100" class="icon-svg is-dropdown-svg">
											<use xlink:href="#{{{ settings.category_icon }}}"></use>
										</svg>
										<span><?php echo esc_html__('Category', 'couponseek'); ?></span>
									</div><!-- end dropdown-content -->
								</div>
							</div>
							<# } 

							if ( settings.country == 'yes' ) { #>
							<!-- Countries Dropdown -->
							<div class="dropdown dropdown-countries">
								<div id="countries-product-dropdown" class="dropdown-button">
									<div class="dropdown-content">
										<svg viewBox="0 0 100 100" class="icon-svg is-dropdown-svg">
											<use xlink:href="#{{{ settings.country_icon }}}"></use>
										</svg>
										<span><?php echo esc_html__('Countries', 'couponseek'); ?></span>
									</div><!-- end dropdown-content -->
								</div>
							</div>
							<# } 
							
							if ( settings.city == 'yes' ) { #>
							<!-- Cities Dropdown -->
							<div class="dropdown dropdown-cities">
								<div id="cities-product-dropdown" class="dropdown-button is-city-product-dropdown">
									<div class="dropdown-content">
										<svg viewBox="0 0 100 100" class="icon-svg is-dropdown-svg">
											<use xlink:href="#{{{ settings.city_icon }}}"></use>
										</svg>
										<span><?php echo esc_html__('Cities', 'couponseek'); ?></span>
									</div><!-- end dropdown-content -->
								</div>
							</div>
							<# } #>

							<?php if ( class_exists('WC_Vendors') ) : ?>
								<# 
								if ( settings.vendor == 'yes' ) {
								#>
								<!-- Companies Dropdown -->
								<div class="dropdown">

									<div id="vendors-product-dropdown" class="dropdown-button">
										<div class="dropdown-content">
											<svg viewBox="0 0 100 100" class="icon-svg is-dropdown-svg">
												<use xlink:href="#{{{ settings.vendor_icon }}}"></use>
											</svg>
											<span><?php echo esc_html__('Company', 'couponseek'); ?></span>
										</div><!-- end dropdown-content -->
									</div>
								</div>
								<# } #>
							<?php endif; ?>
							
							<input class="search-form-input" type="search" name="s" placeholder="{{{ settings.search_placeholder }}}">
							<button type="reset" class="search-button btn btn-color"><?php echo esc_html__('Search', 'couponseek'); ?></button>

						</div><!-- end search-form-filters-inner -->
					</div> <!-- end search-form-filters -->
					

				</form>
			</div>
		</div><!-- end ProductSearch -->
	<?php }

}

if ( class_exists( 'WooCommerce' ) ) {
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Product_Search() );
}
