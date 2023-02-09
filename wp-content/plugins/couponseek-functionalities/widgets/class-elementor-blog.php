<?php
/**
 * Elementor Blog Widget.
 *
 * Elementor widget that inserts a card displaying Blog Posts.
 *
 * @since 1.0.0
 */
class SSD_Elementor_Blog_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'ssd_blog';
	}

	public function get_title() {
		return __( 'Blog', 'couponseek' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
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
				'label' => __( 'Query', 'couponseek' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'couponseek' ),
						'icon'  => 'eicon-h-align-left',
					],
					'above' => [
						'title' => __( 'Above', 'couponseek' ),
						'icon'  => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'couponseek' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'above',
			]
		);

		$this->add_control(
			'excerpt',
			[
				'label' => __( 'Post Exerpt', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'couponseek' ),
				'label_off' => __( 'Hide', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_size',
			[
				'label' => __( 'Excerpt Words Number', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => '10',
				'max' => '100',
				'default' => '25',
				'condition' => [
					'excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'button',
			[
				'label' => __( 'Display Button', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'couponseek' ),
				'label_off' => __( 'Hide', 'couponseek' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'categories',
			[
				'label' => __( 'Blog Posts Categories', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'default' => false,
				'separator' => 'before',
				'options' => $this->get_posts_categories(),
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

		$this->add_control(
			'limit',
			[
				'label' => __( 'Blog Posts Count', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '3'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'couponseek' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_height',
			[
				'label' => __( 'Image Height', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 280,
				],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1000,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .Blog .blog-post-image' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'above',
				],
			]
		);

		$this->add_control(
			'minimum_height',
			[
				'label' => __( 'Minimum Height', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 700,
					],
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .Blog .item-wrapper-inner' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				// 'condition' => [
				// 	'layout' => 'above',
				// ],
			]
		);

		$this->add_control(
			'image_width',
			[
				'label' => __( 'Image Width', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 140,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 500,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .Blog.blog-wrapper-left .blog-post-image, {{WRAPPER}} .Blog.blog-wrapper-right .blog-post-image' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .Blog.blog-wrapper-left .blog-post-content' => 'width: calc(100% - {{SIZE}}{{UNIT}});left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .Blog.blog-wrapper-right .blog-post-content' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'layout!' => 'above',
				],
			]
		);

		$this->add_responsive_control(
			'column_spacing',
			[
				'label' => __( 'Column Spacing', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
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
					'{{WRAPPER}} .SSDItemsGrid .item-wrapper' => 'padding: 0 calc({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'row_spacing',
			[
				'label' => __( 'Row Spacing', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .Blog .item-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_style',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => __( 'Content', 'couponseek' ),
			]
		);

		$this->add_control(
			'text_alignment',
			[
				'label' => __( 'Text Alignment', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
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
				'default' => 'center',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' => __( 'Padding', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .Blog .blog-post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'content_style_date',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => __( 'Post Date', 'couponseek' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'selector' => '{{WRAPPER}} .Blog .blog-post-date',
			]
		);

		$this->add_responsive_control(
			'date_spacing',
			[
				'label' => __( 'Spacing', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .Blog .blog-post-date' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'desktop_default' => [
					'size' => 10,
				],
				'tablet_default' => [
					'size' => 10,
				],
				'mobile_default' => [
					'size' => 10,
				],
			]
		);

		$this->add_control(
			'content_style_title',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => __( 'Title', 'couponseek' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'couponseek' ),
				'selector' => '{{WRAPPER}} .Blog .blog-post-title',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Spacing', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .Blog .blog-post-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'desktop_default' => [
					'size' => 20,
				],
				'tablet_default' => [
					'size' => 20,
				],
				'mobile_default' => [
					'size' => 10,
				],
			]
		);

		$this->add_control(
			'content_style_excerpt',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => __( 'Post Excerpt', 'couponseek' ),
				'separator' => 'before',
				'condition' => [
					'excerpt' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .Blog .blog-post-excerpt',
				'condition' => [
					'excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'content_colors',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
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
			'content_bg_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blog .item-wrapper-inner' => 'background-color: {{VALUE}}',
				],
				'default' => '#fff',
			]
		);

		$this->add_control(
			'date_color',
			[
				'label' => __( 'Date Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blog .blog-post-date' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blog .blog-post-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Excerpt Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blog .blog-post-excerpt' => 'color: {{VALUE}}',
				],
				'condition' => [
					'excerpt' => 'yes',
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
			'content_bg_hover_color',
			[
				'label' => __( 'Background Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blog .item-wrapper-inner:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'date_hover_color',
			[
				'label' => __( 'Date Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blog .item-wrapper-inner:hover .blog-post-date' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Title Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blog .item-wrapper-inner:hover .blog-post-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'excerpt_hover_color',
			[
				'label' => __( 'Excerpt Color', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Blog .item-wrapper-inner:hover .blog-post-excerpt' => 'color: {{VALUE}}',
				],
				'condition' => [
					'excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'content_hover_transition',
			[
				'label' => __( 'Transition Duration', 'couponseek' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .Blog .blog-post-content' => 'transition: {{SIZE}}s;',
					'{{WRAPPER}} .Blog .blog-post-date' => 'transition: {{SIZE}}s;',
					'{{WRAPPER}} .Blog .blog-post-title' => 'transition: {{SIZE}}s;',
					'{{WRAPPER}} .Blog .blog-post-excerpt' => 'transition: {{SIZE}}s;',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function get_posts_categories() {
		$posts_cats = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC'
		) );

		$posts_cats_list = array();

		if ( !empty($posts_cats) && !is_wp_error($posts_cats) ) {
			foreach ($posts_cats as $cat_obj) {
				$term_slug = $cat_obj->slug;
				$term_name = $cat_obj->name;
				$posts_cats_list[$term_slug] = $term_name;
			}
		}

		return $posts_cats_list;
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$text_alignment = $settings['text_alignment'] ? 'text-' . $settings['text_alignment'] : 'text-left';
		$layout = $settings['layout'] ? 'blog-wrapper-' . $settings['layout'] : 'blog-wrapper-left';

		$this->add_render_attribute( 'blog-wrapper', 'class', [
			'Blog',
			'SSDItemsGrid',
			$layout
		] );

		$this->add_render_attribute( 'post-content', 'class', [
			'blog-post-content pos-r',
			$text_alignment
		] );
		?>

		<div <?php echo $this->get_render_attribute_string( 'blog-wrapper' ); ?>>
			<div class="items-row items-columns-<?php echo esc_attr($settings['columns']); ?>">
				<?php 
				$args = array(
					'post_type' => 'post',
					'max_num_pages' => 1,
					'posts_per_page' => $settings['limit'],
					'category_name' => $settings['categories'] ? implode (", ", $settings['categories']) : '',
					'post_status' => 'publish'
				);

				$posts_query = new WP_Query($args);

				?>
				<?php if ($posts_query->have_posts()) : while ($posts_query->have_posts()) : $posts_query->the_post(); ?>

					<div class="item-wrapper">

						<div class="item-wrapper-inner pos-r">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php 
								$thumb_id = get_post_thumbnail_id($posts_query->ID);
								$image_url = wp_get_attachment_image_src($thumb_id, 'couponseek_large_soft');
								?>
								<div class="blog-post-image">
									<div class="bg-image" data-bg-image="<?php echo esc_url($image_url[0]); ?>"></div>
								</div>
							<?php endif; ?>
								<div <?php echo $this->get_render_attribute_string( 'post-content' ); ?>>
									<div class="blog-post-meta">
										<div class="blog-post-date font-heading"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></div>
										<a href="<?php echo esc_url(get_permalink($posts_query->ID)); ?>">
											<h3 class="blog-post-title"><?php echo get_the_title($posts_query->ID) ?></h3>
										</a>
									</div>
									<?php if ( $settings['excerpt'] == 'yes' ) : ?>
										<?php $excerpt_size = $settings['excerpt_size'] ? $settings['excerpt_size'] : '25';  ?>
										<div class="blog-post-excerpt">
											<?php echo couponseek_custom_excerpt_size($excerpt_size); ?>
										</div>
									<?php endif; ?>
									<?php if ( $settings['button'] == 'yes' ) : ?>
									<a class="blog-read-more" href="<?php echo esc_url(get_permalink($posts_query->ID)); ?>">
										<i class="eicon-plus" aria-hidden="true"></i>
									</a>
								<?php endif; ?>
							</div>
						</div><!-- end item-wrapper-inner -->
						
					</div> <!-- end item-wrapper -->

				<?php endwhile; ?>

				<?php
				wp_reset_postdata();
				endif; 
				?>
			</div>
		</div> <!-- end Blog -->
	<?php 
	} 
 
} 

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new SSD_Elementor_Blog_Widget() );