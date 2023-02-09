<?php
get_header();

if ( is_active_sidebar('main-sidebar') ) {
	$post_col_count = 'col-sm-12 col-md-8 col-lg-9';
	
} else {
	$post_col_count = 'col-sm-10 col-sm-offset-1';
}
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php couponseek_count_post_views(get_the_ID()); ?>

	<article <?php post_class('SinglePost'); ?> id="post-<?php the_ID(); ?>">
		<div class="container mt-80 mb-80">

			<div class="SinglePostContent row mb-40">

				<div class="<?php echo esc_attr($post_col_count); ?>">

					<?php if ( !has_post_thumbnail() ) : ?>
					
					<div class="single-post-meta-wrapper">
						<div class="single-post-meta">
							<div class="single-post-meta-categories font-heading"><?php the_category(' / '); ?></div>
							<span class="single-post-meta-date"><?php echo esc_html(get_the_date(get_option('date_format')));?></span>
						</div>
					</div>

					<?php endif; ?>
					
					<div class="single-post-content-inner mb-60">
						
						<?php 
						the_content(); 

						wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title font-heading">' . esc_html__( 'Pages:', 'couponseek' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) );
						?>
					</div> <!-- end single-post-content-inner -->

					<div class="SinglePostFooter mb-60">
						<?php 
						if ( function_exists( 'couponseek_social_share_buttons' ) ) : ?>
							<div class="single-post-footer-container single-post-footer-share">
								<?php couponseek_social_share_buttons(); ?>
							</div> <!-- end single-post-share -->
						<?php 
						endif;
						?>
						<?php if ( has_tag() ) : ?>
							<div class="single-post-footer-container single-post-footer-tags">
								<div class="ElementHeading">
									<div class="element-title font-heading"><?php esc_html_e('Tags:', 'couponseek'); ?></div>
								</div>
								<div class="single-post-footer-content">
									<span><?php the_tags('', ' / '); ?></span>
								</div>
							</div> <!-- end footer-tags -->
						<?php endif; ?>
					</div> <!-- end SinglePostFooter -->

					<div class="AdjacentPosts pos-r mb-100">
						<?php 
						$next_post = get_adjacent_post(false, '', false);
						$prev_post = get_adjacent_post();
						$additional_classes = (!$prev_post) ? ' only-post' : '';
						$additional_classes .= (!has_post_thumbnail($next_post)) ? ' no-image' : '';
						if ($next_post) : ?>
						<div class="adjacent-post-wrapper next-post<?php echo esc_attr($additional_classes) ?>">
							<a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
							<?php if ( has_post_thumbnail($next_post) ) : ?>
								<?php 
								$thumb_id = get_post_thumbnail_id($next_post->ID); 
								$image_src = wp_get_attachment_image_src($thumb_id, 'couponseek_landscape_large');
								?>
								<div class="bg-image" data-bg-image="<?php echo esc_url($image_src[0]); ?>"></div>
							<?php else : ?>
							<?php endif; ?>
								<div class="adjacent-title-wrapper text-left">
									<h5 class="adjacent-post-title"><?php echo get_the_title($next_post->ID) ?></h5>
									<div class="adjacent-meta"><i class="fas fa-angle-left"></i><?php echo esc_html__('Next Post', 'couponseek'); ?></div>
								</div>
							</a>
						</div><!-- end next-post -->
						<?php endif; 

						if ($prev_post) : ?>
						<?php 
						$additional_classes = (!$next_post) ? ' only-post' : '';
						$additional_classes .= (!has_post_thumbnail($prev_post)) ? ' no-image' : ''; ?>
						<div class="adjacent-post-wrapper prev-post<?php echo esc_attr($additional_classes) ?>">
							<a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
							<?php if ( has_post_thumbnail($prev_post) ) : ?>
								<?php 
								$thumb_id = get_post_thumbnail_id($prev_post->ID); 
								$image_src = wp_get_attachment_image_src($thumb_id, 'couponseek_landscape_large');
								?>
								<div class="bg-image" data-bg-image="<?php echo esc_url($image_src[0]); ?>"></div>
							<?php endif; ?>
								<div class="adjacent-title-wrapper text-right">
									<h5 class="adjacent-post-title"><?php echo get_the_title($prev_post->ID) ?></h5>
									<div class="adjacent-meta"><?php echo esc_html__('Previous Post', 'couponseek'); ?><i class="fas fa-angle-right"></i></div>
								</div>
							</a>
						</div><!-- end prev-post -->
						<?php endif; ?>

					</div> <!-- end SimplifiedPosts -->

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