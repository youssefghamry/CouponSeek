<?php
get_header();

if ( is_active_sidebar('main-sidebar') ) {
	$excerpt_col_count = 'col-sm-12 col-md-8 col-lg-9';
	
} else {
	$excerpt_col_count = 'col-sm-10 col-sm-offset-1';
}

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	
	<div class="container mt-80 mb-80">
		<div class="row">
			<div class="<?php echo esc_attr($excerpt_col_count); ?>">

				<div class="ContentHeader">
					<div class="SpecialHeading mb-40">
						<h2 class="special-title"><?php esc_html_e('Search Results for: ', 'couponseek'); ?><?php the_search_query(); ?></h2>
					</div>
					<div class="page-header-search">
						<?php get_search_form(); ?>
					</div>
				</div> <!-- end ContentHeader -->

			<?php 
			if ( couponseek_woocommerce() ) {
				woocommerce_breadcrumb(); 
			}
			?>
		
			<?php if ( have_posts() ) : while (have_posts()) : the_post(); 

				get_template_part( 'partials/excerpt', 'post' );
				
				endwhile; ?>

			<?php if ( get_next_posts_link('', $wp_query->get_max_num_pages) || get_previous_posts_link() ) : ?>
				<div class="PostNav mb-60">
					<div class="post-nav-wrapper font-heading">
						<div class="post-nav post-nav-prev"><?php previous_posts_link('<i class="fas fa-caret-left"></i> ' . esc_html__('Previous Page', 'couponseek') ); ?></div>
						<div class="post-nav post-nav-next"><?php next_posts_link(esc_html__( 'Next Page', 'couponseek')  . ' <i class="fas fa-caret-right"></i>', $wp_query->max_num_pages ); ?></div>
					</div>
				</div> <!-- end PostNav -->
			<?php endif; ?>

			</div> <!-- end $excerpt_col_count -->

			<?php get_sidebar('main'); ?>

			<?php
			wp_reset_postdata();
			?>

			<?php else : ?>
			
			<div class="ErrorHeading mt-80 mb-80">
				<div class="error-text"><?php esc_html_e('Sorry, no posts were found!', 'couponseek') ?></div>
				<a class="btn btn-normal" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back To Home', 'couponseek'); ?></a>
			</div>

			</div> <!-- end $excerpt_col_count -->

			<?php get_sidebar('main'); ?>

			<?php endif; ?>

		</div> <!-- end row -->
	</div> <!-- end container -->
</div> <!-- end post -->

<?php get_footer(); ?>