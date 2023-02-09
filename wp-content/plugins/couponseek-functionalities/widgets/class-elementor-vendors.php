<?php
namespace Elementor;

/**
 * Elementor Vendors Widget.
 *
 * Elementor widget that shows vendors from the WC Vendors plugin in a grid.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Vendors_Widget extends Widget_Base {

	private $selected_vendors = array();

	public function get_name() {
		return 'ssd_vendors';
	}

	public function get_title() {
		return __( 'Vendors', 'couponseek' );
	}

	public function get_icon() {
		return 'eicon-bag-medium';
	}

	public function get_categories() {
		return [ 'couponseek' ];
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
			'group_alphabetically',
			[
				'label' => __( 'Group Alphabetically', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'couponseek' ),
				'label_off' => __( 'No', 'couponseek' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'show_logo',
			[
				'label' => __( 'Show Logo', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'couponseek' ),
				'label_off' => __( 'Hide', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show Title', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'couponseek' ),
				'label_off' => __( 'Hide', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
			'row_title_style_section',
			[
				'label' => __( 'Row Style', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'group_alphabetically' => 'yes',
				],
			]
		);

		$this->add_control(
			'row_title_color',
			[
				'label' => __( 'Row Title Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#9c9b9b',
				'condition' => [
					'group_alphabetically' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .SSDItemsGrid .items-row-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_style_section',
			[
				'label' => __( 'Logo Style', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'label'		=> __( 'Thumbnail Size', 'couponseek' ),
				'default' => 'couponseek_landscape_small',
			]
		);

		$this->add_control(
			'logo_border_radius',
			[
				'label' => __( 'Border Radius', 'couponseek' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .SSDItemsGrid .ssd-item .item-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'logo_shadow',
				'label' => __( 'Box Shadow', 'couponseek' ),
				'fields_options' => [
					'box_shadow' => [
						'default' => [
							'horizontal' => 0,
							'vertical' => 44,
							'blur' => 24,
							'spread'  => -34,
							'color' => 'rgba(224,224,224,0.5)',
						],
					],
				],
				'selector' => '{{WRAPPER}} .SSDItemsGrid .ssd-item .item-image',
			]
		);

		$this->add_control(
			'logo_hover_animation',
			[
				'label' => __( 'Hover Animation', 'couponseek' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_responsive_control(
			'vendor_spacing',
			[
				'label' => __( 'Vendor Spacing', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					]
				],
				'desktop_default' => [
					'size' => 30,
				],
				'tablet_default' => [
					'size' => 30,
				],
				'mobile_default' => [
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .SSDItemsGrid .item-wrapper' => 'padding: 0 calc({{SIZE}}{{UNIT}}/2); margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style_section',
			[
				'label' => __( 'Title Style', 'couponseek' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'vendor_title',
				'label' => __( 'Vendor Title', 'couponseek' ),
				'selector' => '{{WRAPPER}} .SSDItemsGrid .ssd-item .item-title',
			]
		);

		$this->add_responsive_control(
			'vendor_title_alignment',
			[
				'label' => __( 'Title Alignment', 'couponseek' ),
				'type' => Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .SSDItemsGrid .ssd-item .item-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'vendor_title_color',
			[
				'label' => __( 'Vendor Title Color', 'couponseek' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#9c9b9b',
				'selectors' => [
					'{{WRAPPER}} .SSDItemsGrid .ssd-item .item-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'vendor_title_spacing',
			[
				'label' => __( 'Vendor Title Spacing', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .SSDItemsGrid .ssd-item .item-title' => 'margin-top: {{SIZE}}{{UNIT}};'
				],
				'desktop_default' => [
					'size' => 20,
				],
				'tablet_default' => [
					'size' => 20,
				],
				'mobile_default' => [
					'size' => 20,
				],
			]
		);

		$this->end_controls_section();
	}


	private function get_vendor ( $slug ) {

		$vendor_id = get_user_by('slug', $slug);

		if (!empty($vendor_id)) {
			$author = $vendor_id->ID;
		} else $author = '';

		return $author;

	}


	private function get_wc_vendors () {

		$array = array();
		$vendors = get_users( [ 'role' => [ 'vendor'] ] );


		if ( !empty( $vendors ) ){
			foreach ($vendors as $vendor) {
				$vendor_id = $vendor->data->ID;
				$shop_name =  get_user_meta( $vendor_id, 'pv_shop_name', true );
				if ( $shop_name ) {
					$array[$vendor_id] = $shop_name;
				}
			}
		} else {
			$array['no-such-taxonomy'] = sprintf(esc_html__('No vendors found.', 'couponseek'));
		}

		return $array;

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		
		$vendors = get_users( [ 'role' => [ 'vendor'] ] );
	?>

	<div class="SSDItemsGrid">

		<?php
		if ( !empty( $vendors ) ) : ?>
		<div class="items-columns-<?php echo esc_attr($settings['columns']); ?>">
			<?php
			$last_letter = '';
			$count = 0;
			if ( $settings['group_alphabetically'] != 'yes' ) { ?>
				<div class="items-row">
			<?php }
			foreach ($vendors as $vendor) : 
				$vendor_id = $vendor->data->ID;
				$shop_name =  get_user_meta( $vendor_id, 'pv_shop_name', true );

				if ( !$shop_name ) continue;
					
				$first_letter = strtoupper(substr($shop_name, 0, 1));
				if ( $settings['group_alphabetically'] == 'yes' ) {

					if ( $first_letter != $last_letter ) : 
						if ( $count != 0 ) : ?>
						</div> <!-- end item-row -->
						<?php endif; 
						$count++;
						?>
						<h2 class="items-row-title"><?php echo wp_kses_post($first_letter); ?></h2>
						<div class="items-row">
					<?php
					endif;
				}
				?>

				<div class="item-wrapper">
				<?php if ( !empty($vendor_id) ) :
					$logo_id = couponseek_get_vendor_logo($vendor_id);
					$shop_name =  get_user_meta( $vendor_id, 'pv_shop_name', true );
					?>
					<a href="<?php echo \WCV_Vendors::get_vendor_shop_page( $vendor_id ); ?>" class="ssd-item">
						<?php
						if ( !empty($logo_id) && $settings['show_logo'] == 'yes' ) :
							$this->add_render_attribute( 'logo_wrap', 'class', [ 'item-image', 'elementor-animation-' . $settings['logo_hover_animation'] ] );
							?>
							<div <?php echo $this->get_render_attribute_string( 'logo_wrap' ); ?>>
								<?php echo wp_get_attachment_image($logo_id, $settings['thumbnail_size']);  ?>
							</div>
						<?php endif; ?>
						<?php if ( $shop_name && $settings['show_title'] == 'yes' ) : ?>
						<h6 class="item-title"><?php echo wp_kses_post($shop_name); ?></h6>
						<?php endif; ?>
					</a>
					<?php $last_letter = $first_letter; ?>
				<?php endif; //!empty($vendor_id) ?>
				</div><!-- end item-wrapper -->

			<?php 
			endforeach;
			?>

			</div> <!-- end item-row -->
		
		</div> <!-- end vendors-columns -->
		<?php
		endif; // !empty( $vendors )
		?>

	</div><!-- end SSDItemsGrid -->
	<?php
	}

}

if ( class_exists('WC_Vendors') ) {
	Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Vendors_Widget() );
}