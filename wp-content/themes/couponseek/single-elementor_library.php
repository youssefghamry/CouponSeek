<?php
get_header();
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php the_content(); ?>
			
		<?php if ( comments_open() ) : ?>
			<div class="SinglePostComments container">
				<div class="row">
					<div class="CommentsArea col-sm-12" id="comments">
								
						<?php comments_template('', true); ?>

					</div> <!-- end CommentsArea -->
				</div>
			</div> <!-- end SinglePostComments -->
		<?php endif; ?>


	<?php endwhile; else : ?>
		
		<div class="container mt-80 mb-80">
			<div class="ErrorHeading mt-80 mb-80">
				<div class="error-text"><?php esc_html_e('Sorry, no posts were found!', 'couponseek') ?></div>
				<?php get_search_form(); ?>
				<a class="btn btn-normal" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back To Home', 'couponseek'); ?></a>
			</div>
		</div>
		
	<?php endif; ?>
			
</div><!-- end post -->

<?php get_footer(); ?>