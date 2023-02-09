<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<?php wp_head(); ?>
</head>
<body <?php body_class();?>>
	<?php wp_body_open(); ?>

	<?php 
	$nav_classes = '';

	if( function_exists( 'ubermenu' ) ) {
		$nav_classes .= 'has-ubermenu ';
	}

	if ( couponseek_get_field('transparent_navigation') ) {
		$nav_classes .= 'is-main-nav-transparent main-nav-transparent ';
	}
	?>

	<div class="MAIN-NAVIGATION is-slicknav <?php echo esc_attr($nav_classes); ?>">
		<div class="container">
				<div class="pull-left">
					<div class="main-navigation-logo">
						<a href="<?php echo esc_url(home_url('/')); ?>">
							<?php
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$logo_image_light = couponseek_get_field('logo_image_light', 'option');
							if ( has_custom_logo() ) {
								$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
								$logo_image_dark = $image;
								$logo_image_dark['url'] = $image[0];
							} else {
								$logo_image_dark = couponseek_get_field('logo_image_dark', 'option');
							}
							$logo_image_mobile = couponseek_get_field('logo_image_mobile', 'option');
							$logo_name = couponseek_get_field('logo_name', 'option') ? couponseek_get_field('logo_name', 'option') : get_bloginfo( 'name', 'display' );
							?>
							<?php if( empty( $logo_image_light) && !empty($logo_image_dark) ) : ?>
								<?php 
								$logo_image = $logo_image_dark;
								?>
								<img src="<?php echo esc_url( $logo_image_dark['url'] ); ?>" alt="<?php echo esc_attr( $logo_name ); ?>">
							<?php elseif( !empty( $logo_image_light) && empty($logo_image_dark) ) : ?>
								<?php 
								$logo_image = $logo_image_light;
								?>
								<img src="<?php echo esc_url( $logo_image_light['url'] ); ?>" alt="<?php echo esc_attr( $logo_name ); ?>">
							<?php elseif( !empty( $logo_image_light) && !empty($logo_image_dark) ) : ?>
								<img src="<?php echo esc_url($logo_image_light['url']); ?>" class="main-navigation-logo-light" alt="<?php echo esc_attr( $logo_name ); ?>">
								<img src="<?php echo esc_url($logo_image_dark['url']); ?>" class="main-navigation-logo-dark" alt="<?php echo esc_attr( $logo_name ); ?>">
							<?php endif; ?>
							<?php if( empty( $logo_image_light ) && empty( $logo_image_dark ) && !empty( $logo_name ) ) : ?>
								<h1><?php echo wp_kses_post( $logo_name ); ?></h1>
								<h1 class="main-navigation-logo-mobile" ><?php echo wp_kses_post( $logo_name ); ?></h1>
							<?php endif; ?>
							<?php if ( !empty( $logo_image_mobile ) ) : ?>
								<img src="<?php echo esc_url($logo_image_mobile['url']); ?>" class="main-navigation-logo-mobile" alt="<?php echo esc_attr( $logo_name ); ?>">
							<?php elseif( !empty( $logo_image_dark ) ) : ?>
								<img src="<?php echo esc_url($logo_image_dark['url']); ?>" class="main-navigation-logo-mobile" alt="<?php echo esc_attr( $logo_name ); ?>">
							<?php elseif( !empty( $logo_image_light ) ): ?>
								<img src="<?php echo esc_url($logo_image_light['url']); ?>" class="main-navigation-logo-mobile" alt="<?php echo esc_attr( $logo_name ); ?>">
							<?php endif; ?>
						</a>
					</div>
				</div><!-- end pull-left -->
				<div class="pull-right">
					<?php
					if ( has_nav_menu('main-navigation') ) : ?>
						<?php if( function_exists( 'ubermenu' ) ): ?>
							<?php ubermenu( 'main' , array( 'theme_location' => 'main-navigation' ) ); ?>
						<?php else: ?>
							<nav class="main-navigation-menu text-right is-navmenu">
								<?php
								wp_nav_menu( array(
									'theme_location'  => 'main-navigation',
									'container' => false,
									'menu_class'      => 'is-slicknav',
								));
								?>
							</nav>
						<?php endif; ?>
					<?php endif; ?>
				</div><!-- end pull-right -->
		</div><!-- end container -->

	</div><!-- end MAIN-NAVIGATION -->

	<div class="is-nav-offset"></div>

	<div class="MAIN-CONTENT">

	<?php 	
	// Custom Page Header

	if ( get_option('ssd_page_header_ids') ) {

		if ( is_404() ) {
			$field = '404_page';
		} else if ( is_search() ) {
			$field = 'search_page';
		} else if ( function_exists('is_product') && is_product() ) {
			$field = 'woocommerce_single_product_page';
		} else if ( function_exists('is_shop') && is_shop() ) {
			$field = 'woocommerce_shop_page';
		} else if ( is_archive() ) {
			$field = 'archive_page';
		} else {
			$field = 'page';
		}
		$page_header_ids = get_option('ssd_page_header_ids');
		$page_header_id = false;

		foreach ($page_header_ids as $post_id) {
			$content = false;
			$elementor_content = false;
			if ( $field == 'page') {
				$show_in_pages = couponseek_get_field('show_in_pages', $post_id);
				if ( $show_in_pages ) {
					foreach ($show_in_pages as $page) {
						if ( get_the_ID() == $page->ID ) {
							$page_header_id = $post_id;
						} else {
							$page_header_id = false;
						}
					}
				}

			} else if ( $field && couponseek_get_field($field, $post_id) ) {
				$page_header_id = $post_id;
			}

			if ( $page_header_id ) {
				$post_content = get_post($page_header_id);
				$content = $post_content->post_content;
				if ( class_exists('Elementor\\Plugin') ) {
					$elementor_content = Elementor\Plugin::instance()->frontend->get_builder_content_for_display($post_id, false);
				}
			}
			
			?>
			<?php if ( $content || $elementor_content ) : ?>
				<div class="PageHeaderCustom is-elementor-container <?php echo !couponseek_get_field('full_width', $post_id, false) ? 'container' : ''; ?>">
				<?php
				if ( $elementor_content ) {
					echo $elementor_content;
				} else {
					echo do_shortcode($content);
				}
				?>
				</div>
			<?php endif; // $content ?>
			<?php
		}
	}
	
	// Header
	$account_login_page = true;
	if ( class_exists( 'WooCommerce' ) ) {
		if ( is_account_page() && !is_user_logged_in() )
		$account_login_page = false;
	}
	if ( is_singular('page') && !is_page_template('template-blog.php') && $account_login_page ) {
		get_template_part( 'partials/content-page', 'header' );

	} else if ( is_singular('post') ) {
		get_template_part( 'partials/content-post', 'header' );
	}