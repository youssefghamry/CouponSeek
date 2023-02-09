<?php
namespace Elementor;

/**
 * Elementor Selected Products Widget.
 *
 * Elementor widget that inserts selected products.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Selected_Products_Widget extends Widget_Base {

	private $thumbnail_size = 'woocommerce_thumbnail';

	public function get_name() {
		return 'ssd_selected_products';
	}

	public function get_title() {
		return __( 'Selected Products', 'couponseek' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	public function get_categories() {
		return [ 'couponseek' ];
	}

	// public function get_script_depends() {
	// 	return [ 'couponseek_elementor-widgets-scripts' ];
	// }

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Query', 'couponseek' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'repeater_product',
			[
				'name' => 'repeater_product',
				'label' => __( 'Product', 'couponseek' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => false,
				'options' => $this->get_all_products(),
			]
		);

		$this->add_control(
			'repeater_selected_products',
			[
				'label' => __( 'Selected Products', 'couponseek' ),
				'type' => Controls_Manager::REPEATER,
				'label_block' => true,
				'fields' => array_values( $repeater->get_controls() ),
				'default' => [],
			]
		);



		$this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'couponseek' ),
				'type' => Controls_Manager::NUMBER,
				'min' => '1',
				'max' => '5',
				'default' => '4'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'label'		=> __( 'Thumbnail Size', 'couponseek' ),
				'default' => 'woocommerce_thumbnail',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'card_title',
				'label' => __( 'Card Title', 'couponseek' ),
				'selector' => '{{WRAPPER}} .AllProducts .woocommerce  ul.products li.product .woocommerce-loop-product__title, {{WRAPPER}} .AllProducts .woocommerce-page ul.products li.product .woocommerce-loop-product__title',
			]
		);

		$this->add_control(
			'card_title_color',
			[
				'label' => __( 'Card Title Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .AllProducts .woocommerce  ul.products li.product .woocommerce-loop-product__title, {{WRAPPER}} .AllProducts .woocommerce-page ul.products li.product .woocommerce-loop-product__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'card_price',
				'label' => __( 'Card Price', 'couponseek' ),
				'selector' => '{{WRAPPER}} .AllProducts .woocommerce  ul.products li.product .price .price-text-meta-item, {{WRAPPER}} .AllProducts .woocommerce-page ul.products li.product .price .price-text-meta-item',
			]
		);

		$this->add_control(
			'card_price_color',
			[
				'label' => __( 'Card Price Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#9c9b9b',
				'selectors' => [
					'{{WRAPPER}} .AllProducts .woocommerce  ul.products li.product .price .price-text-meta-item, {{WRAPPER}} .AllProducts .woocommerce-page ul.products li.product .price .price-text-meta-item' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'card_meta_title',
				'label' => __( 'Card Meta Title', 'couponseek' ),
				'selector' => '{{WRAPPER}} .AllProducts .woocommerce ul.products li.product .price-text-meta-item-name, {{WRAPPER}} .AllProducts .woocommerce ul.products li.product .product-expiration-meta, {{WRAPPER}} .AllProducts .woocommerce-page ul.products li.product .price-text-meta-item-name, {{WRAPPER}} .AllProducts .woocommerce-page ul.products li.product .product-expiration-meta',
			]
		);

		$this->add_control(
			'card_meta_title_color',
			[
				'label' => __( 'Card Meta Title Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#9c9b9b',
				'selectors' => [
					'{{WRAPPER}} .AllProducts .woocommerce ul.products li.product .price-text-meta-item-name, {{WRAPPER}} .AllProducts .woocommerce ul.products li.product .product-expiration-meta, {{WRAPPER}} .AllProducts .woocommerce-page ul.products li.product .price-text-meta-item-name, {{WRAPPER}} .AllProducts .woocommerce-page ul.products li.product .product-expiration-meta' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'expiration_time',
				'label' => __( 'Expiration Time', 'couponseek' ),
				'selector' => '{{WRAPPER}} .AllProducts .woocommerce ul.products li.product .woocommerce-product-expiration .is-jscountdown, {{WRAPPER}} .AllProducts .woocommerce-page ul.products li.product .woocommerce-product-expiration .is-jscountdown',
			]
		);

		$this->add_control(
			'expiration_time_color',
			[
				'label' => __( 'Expiration Time Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#484848',
				'selectors' => [
					'{{WRAPPER}} .AllProducts .woocommerce ul.products li.product .woocommerce-product-expiration .is-jscountdown, {{WRAPPER}} .AllProducts .woocommerce-page ul.products li.product .woocommerce-product-expiration .is-jscountdown' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_shadow',
				'label' => __( 'Card Shadow', 'couponseek' ),
				'fields_options' => [
					'box_shadow' => [
						'default' => [
							'horizontal' => 0,
							'vertical' => 20,
							'blur' => 30,
							'spread' => -18,
							'color' => 'rgba(212, 56, 222, 0.258824)',
						]
					]
				],
				'selector' => '{{WRAPPER}} .AllProducts .woocommerce  ul.products li.product .woocommerce-product-meta, {{WRAPPER}} .AllProducts .woocommerce-page ul.products li.product .woocommerce-product-meta',
			]
		);

		$this->end_controls_section();
	}

	private function get_all_products() {
		$products = wc_get_products(array(
			'limit' => -1
		));
		$products_array = array();

		foreach ($products as $product) {
			$products_array[$product->get_ID()] = $product->get_name();
		}

		return $products_array;
	}

	private function get_vendor ( $slug ) {

		$vendor_id = get_user_by('slug', $slug);

		if (!empty($vendor_id)) {
			$author = $vendor_id->ID;
		} else $author = '';

		return $author;

	}

	public function get_thumbnail_size() {
		if ( is_array($this->thumbnail_size) ) {
			return array($this->thumbnail_size['width'], $this->thumbnail_size['height']);
		} else {
			return $this->thumbnail_size;
		}
	}

	protected function render() {
		if( !class_exists('WC_Product_Query') ) {
			return;
		}

		$settings = $this->get_settings_for_display();
	?>

	<div class="AllProducts">

			<?php
			if ( count($settings['repeater_selected_products']) > 0 ) {
				
			$product_ids = '';
				
				foreach ($settings['repeater_selected_products'] as $item) {
					$product_ids = $product_ids . ', ' . $item['repeater_product'];
				}

				$this->add_render_attribute(
					'products',
					[
						'ids' => $product_ids,
						'columns' => $settings['columns'],
						'orderby' => 'post__in',
						'order' => 'ASC',
					]
				);

				$thumbnail_size = $settings['thumbnail_size'];
				if ( $thumbnail_size == 'custom' ) {
					$thumbnail_size = $settings['thumbnail_custom_dimension'];
				}

			$this->thumbnail_size = $thumbnail_size;

				add_filter('single_product_archive_thumbnail_size', [ $this, 'get_thumbnail_size' ] );

				echo do_shortcode('[products ' . $this->get_render_attribute_string( 'products' ) . ']');

				remove_filter('single_product_archive_thumbnail_size', [ $this, 'get_thumbnail_size' ] );
			}
			?>
		
	</div><!-- end AllProducts -->
	<?php
	}

}

if ( class_exists( 'WooCommerce' ) ) {
	Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Selected_Products_Widget() );
}