<?php 
/**
* ----------------------------------------------------------------------------------------
*    Product Categories Widget
* ----------------------------------------------------------------------------------------
*/
Class CouponSeek_Widget_Product_Categories extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => esc_html__('This widget adds product categories to your site.','couponseek') );
		parent::__construct( false, esc_html__('[CouponSeek] Product Categories', 'couponseek'), $widget_ops );
	}

	public function widget( $args, $instance ) {

		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$show_parents_only = isset( $instance['show_parents_only'] ) ? $instance['show_parents_only'] : false;
		$show_empty = isset( $instance['show_empty'] ) ? $instance['show_empty'] : false;
		$show_category_icons = isset( $instance['show_category_icons'] ) ? $instance['show_category_icons'] : false;
		$show_category_icons_bg = isset( $instance['show_category_icons_bg'] ) ? $instance['show_category_icons_bg'] : false;

		echo $before_widget;

		$hidden_cats = !empty($instance['hide_categories']) ? $instance['hide_categories'] : array();

		if ( !empty( $instance['show_empty'] ) ) {
			$hide_empty = 0;
		} else {
			$hide_empty = 1;
		}

		$term_args = array( 
			'hide_empty' => $hide_empty,
			'parent' => 0
		);

		if ( $hidden_cats ){
			$term_args['exclude_tree'] = $hidden_cats;
		}

		$product_cats = get_terms('product_cat', $term_args );

		if ( !empty( $product_cats ) && ! is_wp_error( $product_cats ) ) : ?>


			<div class="product-meta-widget-wrapper">
				
			<?php

			if ( $title ) { echo $before_title . $title . $after_title; } ?>

			<?php if ( !empty($instance['show_category_icons']) ) : ?>
			<ul class="product-meta-list-widget product-categories-list-widget font-heading">
			<?php else : ?>
			<ul class="product-meta-list-widget product-meta-list-widget font-heading">
			<?php endif; ?>

			<?php foreach ( $product_cats as $product_cat ) : ?>
				<li class="product-meta">
					<a href="<?php echo esc_url(get_term_link($product_cat)); ?>" class="pos-r">
						<?php if ( !empty($instance['show_category_icons']) ) : ?>
							<?php 
								$thumbnail_id = get_term_meta( $product_cat->term_id, 'thumbnail_id', true );
								$image = wp_get_attachment_url( $thumbnail_id ); 
							?>
							<?php if ( couponseek_get_field('category_icon', "{$product_cat->taxonomy}_{$product_cat->term_id}") ) :
								$icon_class = couponseek_get_field('category_icon', "{$product_cat->taxonomy}_{$product_cat->term_id}");
								?>
								<div class="meta-icon">
									<?php if ( !empty($instance['show_category_icons_bg']) ) : ?>
									<svg viewBox="0 0 100 100" class="icon-svg" data-bg-color="<?php echo esc_attr(couponseek_get_field('icon_bg_color', "{$product_cat->taxonomy}_{$product_cat->term_id}")) ?>">
										<use xlink:href="#<?php echo esc_attr($icon_class); ?>"></use>
									</svg>
									<?php else : ?>
									<svg viewBox="0 0 100 100" class="icon-svg">
										<use xlink:href="#<?php echo esc_attr($icon_class); ?>"></use>
									</svg>
									<?php endif; ?>
								</div>
							<?php elseif ( $image ) : ?>
							<div class="meta-icon">
								<div class="bg-image" data-bg-image="<?php echo esc_url($image); ?>"></div>
							</div>	
							<?php endif; ?>
						<?php endif; ?>
						<div class="product-meta-title font-heading pos-r">
							<span><?php echo wp_kses_post($product_cat->name); ?></span>
							<?php
							$count = (int)$product_cat->count;
							$taxonomy = 'product_cat';
							$args = array(
								'child_of' => $product_cat->term_id,
							);
							$tax_terms = get_terms($taxonomy, $args);
							foreach ($tax_terms as $tax_term) {
								$count += $tax_term->count;
							}
							?>
							<span class="number-counter"> - (<?php echo wp_kses_post($count); ?>)</span>
						</div>
					</a>
					<?php 
					if ( empty($instance['show_parents_only']) ) :
						$product_id = $product_cat->term_id;
						$product_cats_children = get_term_children( $product_id, 'product_cat' );
						if ( $product_cats_children ) : ?>
						<ul class="product-child-categories pos-r">
							<?php foreach ( $product_cats_children as $product_cats_child ) :
								$child_cat = get_term($product_cats_child);
								$child_thumbnail_id = get_term_meta( $child_cat->term_id, 'thumbnail_id', true );
								$child_image = wp_get_attachment_url( $child_thumbnail_id );
								?>
								<li class="product-meta pos-r">
									<a href="<?php echo esc_url(get_term_link($product_cats_child)); ?>" class="pos-r">
										<?php if ( !empty($instance['show_category_icons']) ) : ?>
											<?php if ( couponseek_get_field('category_icon', "{$child_cat->taxonomy}_{$child_cat->term_id}") ) :
												$icon_class = couponseek_get_field('category_icon', "{$child_cat->taxonomy}_{$child_cat->term_id}"); ?>
												<div class="meta-icon">
													<?php if ( !empty($instance['show_category_icons_bg']) ) : ?>
													<svg viewBox="0 0 100 100" class="icon-svg" data-bg-color="<?php echo esc_attr(couponseek_get_field('icon_bg_color', "{$child_cat->taxonomy}_{$child_cat->term_id}")) ?>">
														<use xlink:href="#<?php echo esc_attr($icon_class); ?>"></use>
													</svg>
													<?php else : ?>
													<svg viewBox="0 0 100 100" class="icon-svg">
														<use xlink:href="#<?php echo esc_attr($icon_class); ?>"></use>
													</svg>
													<?php endif; ?>
												</div>
											<?php elseif ( $child_image ) : ?>
												<div class="meta-icon">
													<div class="bg-image" data-bg-image="<?php echo esc_url($child_image); ?>"></div>
												</div>	
											<?php endif; ?>
										<?php endif; ?>
										<div class="product-meta-title pos-r">
											<span><?php echo wp_kses_post($child_cat->name); ?></span>
											<span class="number-counter"> - (<?php echo wp_kses_post($child_cat->count); ?>)</span>
										</div>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php endif;
						?>
					<?php endif; ?> 
				</li>
			<?php endforeach; ?>
			
			</ul>

			</div> <!-- end product-meta-widget-wrapper -->

		<?php else : 
			if ( $title ) { 
				echo $before_title . $title . $after_title; 
			}
		endif; ?>


		<?php echo $after_widget;

	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['hide_categories'] = strip_tags($new_instance['hide_categories']);
		$instance['show_parents_only'] = isset( $new_instance['show_parents_only'] ) ? (bool) $new_instance['show_parents_only'] : false;
		$instance['show_empty'] = isset( $new_instance['show_empty'] ) ? (bool) $new_instance['show_empty'] : false;
		$instance['show_category_icons'] = isset( $new_instance['show_category_icons'] ) ? (bool) $new_instance['show_category_icons'] : false;
		$instance['show_category_icons_bg'] = isset( $new_instance['show_category_icons_bg'] ) ? (bool) $new_instance['show_category_icons_bg'] : false;

		return $instance;
	}

	public function form( $instance ) {
		
		$defaults = array(
			'title' => esc_html__('Categories', 'couponseek'),
			'hide_categories' => '',
		);

		$instance = wp_parse_args((array) $instance, $defaults);

		$show_parents_only = isset( $instance['show_parents_only'] ) ? (bool) $instance['show_parents_only'] : false;
		$show_empty = isset( $instance['show_empty'] ) ? (bool) $instance['show_empty'] : false;
		$show_category_icons = isset( $instance['show_category_icons'] ) ? (bool) $instance['show_category_icons'] : false;
		$show_category_icons_bg = isset( $instance['show_category_icons_bg'] ) ? (bool) $instance['show_category_icons_bg'] : false;

		?>

		<!-- The Title -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'couponseek') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<!-- The Show Empty -->
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_empty ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_empty' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_empty' )); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('show_empty')); ?>"><?php esc_html_e('Show Empty', 'couponseek') ?></label>
		</p>

		<!-- The Show Parent Categories Only -->
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_parents_only ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_parents_only' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_parents_only' )); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('show_parents_only')); ?>"><?php esc_html_e('Show Parent Categories Only', 'couponseek') ?></label>
		</p>

		<!-- The Show Category Icons -->
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_category_icons ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_category_icons' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_category_icons' )); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('show_category_icons')); ?>"><?php esc_html_e('Show Category Icons', 'couponseek') ?></label>
		</p>

		<!-- The Show Icons Background -->
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_category_icons_bg ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_category_icons_bg' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_category_icons_bg' )); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('show_category_icons_bg')); ?>"><?php esc_html_e('Show Icons Background', 'couponseek') ?></label>
			<br>
			<small><?php esc_html_e('Note: Background Color is set for each icon in the Admin Dashboard > Products > Categories.', 'couponseek' ) ?></small>
		</p>

		<!-- The Hide Product Categories -->
		<p>
			<?php if ( class_exists('CouponSeek_Widget_Fields') ) {
				$args = array(
					'id' =>  $this->get_field_id('hide_categories'),
					'name' => $this->get_field_name('hide_categories'),
					'value' => $instance['hide_categories'],
					'type' => 'multi-select',
					'label' =>  esc_html__( 'Hide Categories', 'couponseek' ),
					'choices' => couponseek_get_term_names('product_cat', true)
				);
				CouponSeek_Widget_Fields::field($args);
			} ?>
		</p>
		
	<?php
	}

	
}
?>