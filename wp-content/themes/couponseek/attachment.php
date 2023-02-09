<?php
get_header();

if ( is_active_sidebar('main-sidebar') ) {
	$post_col_count = 'col-sm-12 col-md-8 col-lg-9';
	
} else {
	$post_col_count = 'col-sm-10 col-sm-offset-1';
}
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article <?php post_class('SinglePost'); ?> id="post-<?php the_ID(); ?>">
		<div class="container mt-80 mb-80">

			<div class="SinglePostContent row mb-40">

				<div class="<?php echo esc_attr($post_col_count); ?>">

					<div class="single-post-content-inner">
						<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
	                        <div class="attachment mb-60">
	                        	<a href="<?php echo esc_url(wp_get_attachment_url($post->id)); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
	                        		<img src="<?php echo esc_url($att_image[0]);?>" width="<?php echo esc_attr($att_image[1]);?>" height="<?php echo esc_attr($att_image[2]);?>"  class="attachment-medium">
	                        	</a>
	                        </div>
						<?php else : ?>
	                        <a href="<?php echo esc_url(wp_get_attachment_url($post->ID)); ?>" title="<?php echo esc_attr(get_the_title($post->ID)) ?>" rel="attachment"></a>
						<?php endif; ?>
						
					</div><!-- end single-post-content-inner -->

					<?php if ( comments_open() || get_comments_number() ) : ?>
						<div class="SinglePostComments mb-60">
							<div class="CommentsArea" id="comments">

								<?php comments_template('', true); ?>

							</div> <!-- end CommentsArea -->
						</div> <!-- end SinglePostComments -->
					<?php endif; ?>

				</div> <!-- end $post_col_count -->

				<?php get_sidebar('main'); ?>
				
			</div> <!-- end SinglePostContent -->
		</div> <!-- end container -->
	</article> <!-- end article -->

<?php endwhile; else : ?>
	
	<div class="container mt-80 mb-80">
		<div class="row">
			<div class="<?php echo esc_attr($post_col_count); ?>">
				<div class="ErrorHeading mt-80 mb-80">
					<div class="error-text"><?php esc_html_e('Sorry, no posts were found!', 'couponseek') ?></div>
					<?php get_search_form(); ?>
					<a class="btn btn-normal" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back To Home', 'couponseek'); ?></a>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php get_footer(); ?>