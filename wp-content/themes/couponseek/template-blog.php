<?php
/* Template Name: Blog */
get_header();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	
	<div class="container mt-80 mb-80">

		<?php 
		if ( is_active_sidebar('main-sidebar') ) {
			$excerpt_col_count = 'col-sm-12 col-md-8 col-lg-9';

		} else {
			$excerpt_col_count = 'col-sm-10 col-sm-offset-1';
		}

		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'paged' => get_query_var( 'paged' )
		);
		$posts_query = new WP_Query($args);

		?>

		<div class="row">
			<?php if ( single_post_title('', false) || couponseek_get_field('show_search') ) : ?>
			<div class="ContentHeader col-sm-12 mb-40">
				<div class="row">
					<div class="col-sm-6 col-md-7">
						<?php if ( (!couponseek_get_field('hide_title') || !class_exists('acf')) && single_post_title('', false) ) : ?>
							<div class="SpecialHeading">
								<h1 class="special-title"><?php single_post_title(); ?></h1>
							</div>
						<?php endif; ?>
						<?php 
						if ( couponseek_woocommerce() ) {
							woocommerce_breadcrumb(); 
						}
						?>
					</div>
					<?php if ( couponseek_get_field('show_search') ) : ?>
						<div class="page-header-search col-sm-6 col-md-5">
							<?php get_search_form(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div> <!-- end ContentHeader -->
			<?php endif; ?>
			<div class="<?php echo esc_attr($excerpt_col_count); ?>">


				<?php
				if ( $posts_query->have_posts() ) : while ($posts_query->have_posts()) : $posts_query->the_post(); 

					get_template_part( 'partials/excerpt', 'post' ); 

					endwhile; ?>
					<?php if ( get_next_posts_link('', $posts_query->max_num_pages) || get_previous_posts_link() ) : ?>
						<div class="PostNav mb-60">
							<div class="post-nav-wrapper font-heading">
								<?php if ( get_previous_posts_link() ) : ?>
								<div class="post-nav post-nav-prev"><?php previous_posts_link('<i class="fas fa-caret-left"></i> ' . esc_html__('Previous Page', 'couponseek') ); ?></div>
								<?php endif; ?>
								<?php if ( get_next_posts_link('', $posts_query->max_num_pages) ) : ?>
								<div class="post-nav post-nav-next"><?php next_posts_link(esc_html__( 'Next Page', 'couponseek')  . ' <i class="fas fa-caret-right"></i>', $posts_query->max_num_pages ); ?></div>
								<?php endif; ?>
							</div>
						</div> <!-- end PostNav -->
					<?php endif; ?>

				</div> <!-- end $excerpt_col_count -->

				<?php get_sidebar('main'); ?>

				<?php
				wp_reset_postdata();
				?>
			<?php endif; ?>

		</div> <!-- end row -->

	</div> <!-- end container -->
	
</div>

<?php get_footer(); ?>