<?php
namespace Elementor;

/**
 * Elementor All Products Widget.
 *
 * Elementor widget that inserts a list with WooCommerce Products.
 *
 * @since 1.0.0
 */
class SSD_Elementor_All_products_Widget extends Widget_Base {

	private $thumbnail_size = 'woocommerce_thumbnail';

	public function get_name() {
		return 'ssd_all_products';
	}

	public function get_title() {
		return __( 'All Products', 'couponseek' );
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

		$this->add_control(
			'categories',
			[
				'label' => __( 'Product Categories', 'couponseek' ),
				'description' => __( 'Leave empty to display products from all categories.', 'couponseek' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'default' => false,
				'options' => $this->get_product_categories(),
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

		$this->add_control(
			'limit',
			[
				'label' => __( 'Products Count', 'couponseek' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '8'
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'title',
				'options' => [
					'title' => __( 'Default', 'couponseek' ),
					'popularity' => __( 'Popular', 'couponseek' ),
					'rating'     => __( 'Rating', 'couponseek' ),
					'date'       => __( 'Newest', 'couponseek' ),
					'expiring'      => __( 'Expiring Soon', 'couponseek' ),
					'id'      => __( 'ID', 'couponseek' ),
					'menu_order'      => __( 'Menu Order', 'couponseek' ),
					'rand'      => __( 'Random', 'couponseek' ),
				]
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC' => __( 'Ascending', 'couponseek' ),
					'DESC' => __( 'Descending', 'couponseek' )
				]
			]
		);

		$this->add_control(
			'visibility',
			[
				'label' => __( 'Products Visibility', 'couponseek' ),
				'description' => __( 'Display products based on the selected visibility.', 'couponseek' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'visible',
				'options' => [
					'visible' => __( 'Visible', 'couponseek' ),
					'catalog' => __( 'Shop Only', 'couponseek' ),
					'search'     => __( 'Search Only', 'couponseek' ),
					'hidden'       => __( 'Hidden', 'couponseek' ),
					'featured'      => __( 'Featured', 'couponseek' ),
				]
			]
		);

		$this->add_control(
			'show_expired',
			[
				'label' => __( 'Show Expired', 'couponseek' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'couponseek' ),
				'label_off' => __( 'Hide', 'couponseek' ),
				'return_value' => 'yes',
				'default' => '',
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

	private function get_product_categories() {
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

	private function get_vendor($slug) {

		$vendor_id = get_user_by('slug', $slug);

		if (!empty($vendor_id)) {
			$author = $vendor_id->ID;
		} else $author = '';

		return $author;

	}

	public function set_thumbnail_size($thumbnail_size) {
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

			$this->add_render_attribute(
				'products',
				[
					'limit' => $settings['limit'] ? $settings['limit'] : -1,
					'columns' => $settings['columns'],
					'category' => $settings['categories'] ? implode (", ", $settings['categories']) : '',
					'orderby' => $settings['orderby'],
					'order' => $settings['order'],
					'visibility' => $settings['visibility'],
				]
			);

			$thumbnail_size = $settings['thumbnail_size'];
			if ( $thumbnail_size == 'custom' ) {
				$thumbnail_size = $settings['thumbnail_custom_dimension'];
			}

			$this->thumbnail_size = $thumbnail_size;

			add_filter('single_product_archive_thumbnail_size', [ $this, 'set_thumbnail_size' ] );

			update_option('ssd_elementor_all_products_settings', $settings);

			echo do_shortcode('[products ' . $this->get_render_attribute_string( 'products' ) . ']'); 

			delete_option('ssd_elementor_all_products_settings');

			remove_filter('single_product_archive_thumbnail_size', [ $this, 'set_thumbnail_size' ] );

			?>
		
	</div><!-- end AllProducts -->


	<?php
	}

}

if ( class_exists( 'WooCommerce' ) ) {
	Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_All_Products_Widget() );
}