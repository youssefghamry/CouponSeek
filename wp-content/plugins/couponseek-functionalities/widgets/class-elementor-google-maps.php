<?php
namespace Elementor;
use Elementor\Modules\DynamicTags\Module as TagsModule;
/**
 * Elementor Google Maps Widget.
 *
 * Elementor widget that inserts a Google Map.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Google_Maps extends \Elementor\Widget_Base {

	public function get_name() {
		return 'ssd_google_maps';
	}

	public function get_title() {
		return __( 'Google Maps', 'couponseek' );
	}

	public function get_icon() {
		return 'eicon-google-maps ';
	}

	public function get_categories() {
		return [ 'couponseek' ];
	}

	public function get_keywords() {
		return [ 'google', 'map', 'embed' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_map',
			[
				'label' => __( 'Map', 'couponseek' ),
			]
		);

		$this->add_control(
			'important_note',
			[
				'label' => __( 'Important Note', 'couponseek' ),
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'Make sure that you have entered your Google API Key Appearance > Theme Settings.', 'couponseek' ),
			]
		);

		$default_address = __( 'London Eye, London, United Kingdom', 'couponseek' );
		$this->add_control(
			'address',
			[
				'label' => __( 'Address', 'couponseek' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
					],
				],
				'placeholder' => $default_address,
				'default' => $default_address,
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'zoom',
			[
				'label' => __( 'Zoom', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'separator' => 'before',
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Height', 'couponseek' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 1440,
					],
				],
				'default' => [
					'size' => 400,
				],
				'selectors' => [
					'{{WRAPPER}} .is-elementor-google-map' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'disable_scroll',
			[
				'label' => __( 'Disable Scroll', 'couponseek' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'disable_default_ui',
			[
				'label' => __( 'Disable Default UI', 'couponseek' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'dynamic' => [
					'active' => true,
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'marker',
			[
				'label' => __( 'Marker', 'couponseek' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [],
				'frontend_available' => true,
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_map_style',
			[
				'label' => __( 'Style', 'couponseek' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'json_style',
			[
				'label' => __( 'JSON Style', 'couponseek' ),
				'type' => Controls_Manager::TEXTAREA,
				'description' => 'For more information, check the "Style Reference" in the online Google Maps API Documentation.',
				'default' => '',
				'frontend_available' => true,
			]
		);


		$this->end_controls_tabs();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['address'] ) ) {
			return;
		}

		if ( 0 === absint( $settings['zoom']['size'] ) ) {
			$settings['zoom']['size'] = 15;
		}

		$marker_url = !empty($settings['marker']) ? esc_attr( $settings['marker']['url'] ) : '';

		printf(
			'<div class="is-elementor-google-map" data-gmap-zoom="%s" data-gmap-address="%s" data-gmap-marker="%s" data-gmap-disable-scroll="%s" data-gmap-json-style="%s" data-gmap-disable-default-ui="%s"></div>',
			absint( $settings['zoom']['size'] ),
			esc_attr( $settings['address'] ),
			$marker_url,
			esc_attr( $settings['disable_scroll'] ),
			esc_attr( $settings['json_style'] ),
			esc_attr( $settings['disable_default_ui'] )
		);

	}
 
} 

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Google_Maps() );