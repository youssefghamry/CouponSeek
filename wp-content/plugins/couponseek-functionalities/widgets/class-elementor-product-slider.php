<?php
/**
 * Elementor Product Slider Widget.
 *
 * Elementor widget that inserts a WooCommerce Products slider.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Product_Slider_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'ssd_product_slider';
	}

	public function get_title() {
		return __( 'Product Slider', 'couponseek' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_script_depends() {
		return [ 'swiper', 'couponseek_elementor-widgets-scripts' ];
	}

	public function get_categories() {
		return [ 'couponseek' ];
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
			'selected_products',
			[
				'label' => __( 'Select Products', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => couponseek_get_post_names('product'),
			]
		);

		$this->add_control(
			'show_product_button',
			[
				'label' => __( 'Show Product Buy Button', 'couponseek' ),
				'description' => __( 'Display the Products Buy Button under the image', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'couponseek' ),
				'label_off' => __( 'No', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'couponseek' ),
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'dots',
				'options' => [
					'both' => __( 'Arrows and Dots', 'couponseek' ),
					'arrows' => __( 'Arrows', 'couponseek' ),
					'dots' => __( 'Dots', 'couponseek' ),
					'none' => __( 'None', 'couponseek' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause on Hover', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'couponseek' ),
					'no' => __( 'No', 'couponseek' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'couponseek' ),
					'no' => __( 'No', 'couponseek' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 5000,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __( 'Infinite Loop', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'couponseek' ),
					'no' => __( 'No', 'couponseek' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => __( 'Animation Speed', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 500,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'direction',
			[
				'label' => __( 'Direction', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => [
					'ltr' => __( 'Left', 'couponseek' ),
					'rtl' => __( 'Right', 'couponseek' ),
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_style_section',
			[
				'label' => __( 'Content Style', 'couponseek' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_heading',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => __( 'Image', 'couponseek' ),
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Image Width', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'unit' => '%',
					'size' => 45,
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => 45,
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSliderWrapper .product-slider-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_offset',
			[
				'label' => __( 'Image Bottom Offset', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'desktop_default' => [
					'size' => 70,
				],
				'tablet_default' => [
					'size' => 50,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSliderWrapper .product-slider-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_heading',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => __( 'Content', 'couponseek' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'content_width',
			[
				'label' => __( 'Content Width', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'unit' => '%',
					'size' => 60,
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => 75,
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => 85,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSliderWrapper .product-slider-meta-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_offset',
			[
				'label' => __( 'Content Top Offset', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'desktop_default' => [
					'size' => 130,
				],
				'tablet_default' => [
					'size' => 130,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSliderWrapper .product-slider-meta-wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' => __( 'Padding', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'desktop_default' => [
					'top' => 60,
					'right' => 130,
					'bottom' => 65,
					'left' => 75,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSliderWrapper .product-slider-meta-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'selector' => '{{WRAPPER}} .ProductSliderWrapper .product-slider-meta-wrapper',
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label' => __( 'Border Radius', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 12,
					'right' => 12,
					'bottom' => 12,
					'left' => 12,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSliderWrapper .product-slider-meta-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'product_title',
				'label' => __( 'Product Title', 'couponseek' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .ProductSliderWrapper .product-slider-title',
			]
		);

		$this->add_control(
			'product_title_color',
			[
				'label' => __( 'Product Title Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .ProductSliderWrapper .product-slider-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'product_price',
				'label' => __( 'Product Price', 'couponseek' ),
				'selector' => '{{WRAPPER}} .ProductSliderWrapper .product-slider-price .price-text-meta-item',
			]
		);

		$this->add_control(
			'product_price_color',
			[
				'label' => __( 'Product Price Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#9c9b9b',
				'selectors' => [
					'{{WRAPPER}} .ProductSliderWrapper .product-slider-price .price-text-meta-item' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'product_meta_font',
				'label' => __( 'Product Meta Font', 'couponseek' ),
				'selector' => '{{WRAPPER}} .ProductSliderWrapper .product-slider-meta-wrapper .product-expiration-meta',
			]
		);

		$this->add_control(
			'product_meta_color',
			[
				'label' => __( 'Product Meta Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#484848',
				'selectors' => [
					'{{WRAPPER}} .ProductSliderWrapper .product-slider-meta-wrapper .product-expiration-meta' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'expiration_time_font',
				'label' => __( 'Expiration Time Font', 'couponseek' ),
				'selector' => '{{WRAPPER}} .ProductSliderWrapper .product-slider-expiration .is-jscountdown',
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ProductSliderWrapper .product-slider-meta-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_style_section',
			[
				'label' => __( 'Image Style', 'couponseek' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .ProductSliderWrapper .product-slider-image',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 12,
					'right' => 12,
					'bottom' => 12,
					'left' => 12,
				],
				'selectors' => [
					'{{WRAPPER}} .ProductSliderWrapper .product-slider-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_shadow',
				'label' => __( 'Image Shadow', 'couponseek' ),
				'fields_options' => [
					'box_shadow' => [
						'default' => [
							'horizontal' => 0,
							'vertical' => 20,
							'blur' => 25,
							'spread' => -18,
							'color' => 'rgba(0, 0, 0, 0.3)',
						]
					]
				],
				'selector' => '{{WRAPPER}} .ProductSliderWrapper .product-slider-image',
			]
		);
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
            'carousel-wrapper' => [
                'class' => 'ProductSliderWrapper swiper-container swiper-carousel is-product-slider',
                'dir' => $settings['direction'],
            ],
            'carousel' => [
                'class' => 'elementor-image-carousel swiper-wrapper',
            ],
        ] );

		$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
        $show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
	?>
	
		<div <?php echo $this->get_render_attribute_string( 'carousel-wrapper' ); ?>>
			<?php 
				$products_ids = array();

				foreach ($settings['selected_products'] as $array) {
					array_push($products_ids, $array);
				}
			?>
			<?php if ( count($products_ids) > 0 ) : ?>

				<?php foreach ($products_ids as $product_id) : ?>

					<?php if ( couponseek_get_field('discount_code', $product_id) ) : ?>
					<div class="modal fade" id="external-product-modal-<?php echo $product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-<?php echo $product_id; ?>" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel-<?php echo $product_id; ?>"><?php get_the_title( $product_id ); ?></h5>
									<?php 
									if ( get_the_post_thumbnail($product_id) ) :
										$featured_image_src = wp_get_attachment_image_src(get_post_thumbnail_id( $product_id ), 'couponseek_landscape_medium');
										$featured_image_url = $featured_image_src[0];
										?>
										<div class="bg-image modal-deal-image" data-bg-image="<?php echo esc_url($featured_image_url); ?>"></div>
									<?php
									endif;
									?>
								</div>
								<div class="modal-body">
									<div class="modal-deal-code">
										<?php 
										if ( couponseek_get_field('discount_code', $product_id) ) {
											echo wp_kses_post(couponseek_get_field('discount_code', $product_id));
										}
										?>
									</div>
								</div>
								<div class="modal-footer is-clipboard-success">
									<p><?php esc_html_e('Code is copied', 'couponseek') ?></p>

									<?php 
									if ( couponseek_woocommerce() ) :
										$product = wc_get_product($product_id);
										if($product instanceof WC_Product_External) {
											if ( $product->get_product_url() ) {
												$external_url = $product->get_product_url();
												$button_text = $product->get_button_text() ? $product->get_button_text() : esc_html__('Buy Product', 'couponseek');
											}
										 		
											if ( isset($external_url) ) : ?>
											<a href="<?php echo esc_url($external_url); ?>" target="_blank" class="btn btn-color"><?php echo esc_html( $button_text ); ?></a>
											<?php endif;
										}
										
									endif; ?>
								</div>
								<div class="modal-footer is-clipboard-error">
									<p><?php esc_html_e('Please copy the following code.', 'couponseek') ?></p>
									<?php if ( couponseek_woocommerce() && isset($external_url) ) : ?>
									<a href="<?php echo esc_url($external_url); ?>" target="_blank" class="btn btn-color"><?php echo esc_html( $button_text ); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div><!-- end modal -->
					<?php endif; ?>

				<?php endforeach; ?>

				<div <?php echo $this->get_render_attribute_string( 'carousel' ); ?>>

				<?php foreach ($products_ids as $product_id) : ?>

					<?php
					$this->add_render_attribute( 'slider_item' . $product_id , 'class', [
						'swiper-slide product-slider-item pos-r',
					]);
					?>

					<div <?php echo $this->get_render_attribute_string( 'slider_item' . $product_id ); ?>>
						<?php 
						$product = wc_get_product($product_id);
						if ( !$product ) continue;
						$post_object = get_post($product_id);
						setup_postdata($GLOBALS['post'] =& $post_object);
						do_action( 'woocommerce_before_elementor_slider_product' );
						?>
						
						<div class="product-slider-image bg-image" data-bg-image="<?php echo esc_url(get_the_post_thumbnail_url( $product_id, 'couponseek_medium_soft' )); ?>"></div>
						<div class="product-slider-meta-wrapper">
							<div class="product-slider-item-meta">
								 
								<?php if ( couponseek_get_field('expiring_date', $product_id) ) : ?>
								<?php
								$expiring_date = DateTime::createFromFormat('Ymd', couponseek_get_field('expiring_date', $product_id));
								$expiring_date_formatted = $expiring_date->format('m/d/Y');
								?>
								<div class="product-slider-expiration">
									<span class="product-expiration-meta"><?php echo esc_html__('Expires In', 'couponseek'); ?></span>
									<span class="is-jscountdown font-heading" data-time="<?php echo esc_attr($expiring_date_formatted) ?>" data-short="true"></span>
								</div>
								<?php endif; ?> <!-- end slider-expiration -->

								<div class="product-slider-title-wrapper">
									<?php 
									$external_url = false;
									if( $product instanceof WC_Product_External ) {
										if ( $product->get_product_url() ) {
											$external_url = $product->get_product_url();
										}
									}
									if ( $external_url && couponseek_get_field('show_deal_popups', 'option') ) {
										$discount_code = (couponseek_get_field('discount_code', $product_id)) ? couponseek_get_field('discount_code', $product_id) : '';
										if ( $discount_code != '' ) {
											echo '<a href="javascript:void(0)" class="is-show-coupon-code" data-target="#external-product-modal-' . $product_id . '" data-clipboard-text="' . esc_attr($discount_code) . '"><h3 class="product-slider-title">' . get_the_title($product_id) . '</h3></a>';
										} else {
											echo '<a href="' . esc_url( $external_url ) . '" target="_blank"><h3 class="product-slider-title">' . get_the_title($product_id) . '</h3></a>';
										}
									} else {
										echo '<a href="' . esc_url( get_the_permalink($product_id) ) . '"><h3 class="product-slider-title">' . get_the_title($product_id) . '</h3></a>';
									} 
									?>
								</div> <!-- end title-wrapper -->
								<div class="product-slider-price font-heading">
									<?php 
									echo wp_kses_post($product->get_price_html()); 
									?>
								</div> <!-- end slider-price -->

							</div> <!-- product-slider-item-meta -->
						</div> <!-- product-slider-meta-wrapper -->
						<?php  
							if ( $settings['show_product_button'] ) {
								do_action( 'woocommerce_after_shop_loop_item' );
							}
						?>
					</div>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
				</div> <!-- end swiper-wrapper -->

				<?php if ( $show_dots ) : ?>
					<div class="swiper-pagination"></div>
				<?php endif; ?>
				<?php if ( $show_arrows ) : ?>
					<div class="elementor-swiper-button swiper-arrow swiper-content-prev">
						<i class="eicon-chevron-left" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php _e( 'Previous', 'elementor' ); ?></span>
					</div>
					<div class="elementor-swiper-button swiper-arrow swiper-content-next">
						<i class="eicon-chevron-right" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php _e( 'Next', 'elementor' ); ?></span>
					</div>
				<?php endif; ?>

			<?php endif; ?>
				
		</div> <!-- end ContentSlider -->

	<?php
	}

}

if ( class_exists( 'WooCommerce' ) ) {
 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Product_Slider_Widget() );
}