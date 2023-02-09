<?php 
/**
* ----------------------------------------------------------------------------------------
*    Product Search Widget
* ----------------------------------------------------------------------------------------
*/
Class CouponSeek_Widget_Product_Search extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => esc_html__('This widget adds a product search to your site.','couponseek') );
		parent::__construct( false, esc_html__('[CouponSeek] Product Search', 'couponseek'), $widget_ops );
	}

	public function widget( $args, $instance ) {

		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);

		echo $before_widget;

		if ( $title ) { echo $before_title . $title . $after_title; }

		$search_placeholder = !empty($instance['search_placeholder']) ? $instance['search_placeholder'] : '';
		$hidden_filters = !empty($instance['hide_filters']) ? explode(',', $instance['hide_filters']) : array();
		?>
		<div class="ProductSearch">
			<div class="search-form-wrapper">
				<form action="<?php echo esc_url( home_url( "/" ) ); ?>" method="get">
					<div class="search-form-filters">
						<div class="search-form-filters-inner">
							<?php 
							if ( !in_array('category', $hidden_filters) ) :
								$term_args = array( 
									'hide_empty' => 1
								);
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
													<use xlink:href="#icon-svg-box"></use>
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
															<use xlink:href="#icon-svg-box"></use>
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
							if ( !in_array('country', $hidden_filters) ) :
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
												<use xlink:href="#icon-svg-map-3"></use>
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
							endif; // if !array_key_exists('country', $hidden_filters);
							?>
							<?php
							if ( !in_array('city', $hidden_filters) ) :

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
												<use xlink:href="#icon-svg-landmark-4"></use>
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
							endif; // if !array_key_exists('city', $hidden_filters);
							?>

							<?php if ( !in_array('vendor', $hidden_filters) && class_exists('WC_Vendors') ) : ?>
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
												<use xlink:href="#icon-svg-shopping-bag-2"></use>
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

							<?php endif;  // if !array_key_exists('vendor', $hidden_filters)
							?>

						</div><!-- end search-form-filters-inner -->
					</div> <!-- end search-form-filters -->
					<fieldset class="group-input">
						<input class="search-form-input" type="search" name="s" placeholder="<?php echo wp_kses_post($search_placeholder); ?>">
						<button type="submit" id="searchsubmit"><?php echo esc_html__('Search', 'couponseek'); ?></button>
					</fieldset>
					<input type="hidden" name="post_type" value="product" />
				</form>
			</div>
		</div> <!-- end ProductSearch -->
		<?php
		echo $after_widget;

	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['search_placeholder'] = strip_tags($new_instance['search_placeholder']);
		$instance['hide_filters'] = strip_tags($new_instance['hide_filters']);

		return $instance;
	}

	public function form( $instance ) {
		
		$defaults = array(
			'title' => esc_html__('Search', 'couponseek'),
			'search_placeholder' => esc_html__('I\'m searching for...', 'couponseek'),
			'hide_filters' => '',
		);

		$instance = wp_parse_args((array) $instance, $defaults);

		?>

		<!-- The Title -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'couponseek') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<!-- The Search Placeholder -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('search_placeholder')); ?>"><?php esc_html_e('Search Placeholder', 'couponseek') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('search_placeholder')); ?>" name="<?php echo esc_attr($this->get_field_name('search_placeholder')); ?>" type="text" value="<?php echo esc_attr($instance['search_placeholder']); ?>" />
		</p>

		<!-- The Hide Filters -->
		<p>
			<?php if ( class_exists('CouponSeek_Widget_Fields') ) {
				$args = array(
					'id' =>  $this->get_field_id('hide_filters'),
					'name' => $this->get_field_name('hide_filters'),
					'value' => $instance['hide_filters'],
					'type' => 'multi-select',
					'label' =>  esc_html__( 'Hide Filters', 'couponseek' ),
					'choices' => array(
						'category' => esc_html__( 'Category', 'couponseek' ),
						'country' => esc_html__( 'Country', 'couponseek' ),
						'city' => esc_html__( 'City', 'couponseek' ),
						'vendor' => esc_html__( 'Vendor', 'couponseek' ),
					)
				);
				CouponSeek_Widget_Fields::field($args);
			} ?>
		</p>
		
	<?php
	}

	
}
?>
