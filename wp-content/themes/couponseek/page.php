<?php
get_header();
?>
<?php
$vendor_dashboard = '';
if ( class_exists('WCV_Vendors') && get_option( 'wcvendors_vendor_dashboard_page_id' ) ) {
	$vendor_dashboard = get_permalink( get_option( 'wcvendors_vendor_dashboard_page_id' ) );
}

$vendor_settings = '';
if ( class_exists('WCV_Vendors') && get_option( 'wcvendors_shop_settings_page_id' ) ) {
	$vendor_settings = get_permalink( get_option( 'wcvendors_shop_settings_page_id' ) );
}

$current_page = get_permalink(get_the_ID());

$page_classes = '';
if ( $vendor_dashboard == $current_page || $vendor_settings == $current_page ) {
	$page_classes = 'wc-vendors-dashboard';
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class($page_classes); ?>>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php if ( !couponseek_get_field('full_width', get_the_ID(), false) ) : ?>
			<div class="container">
				<?php 
				the_content(); 
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title font-heading">' . esc_html__( 'Pages:', 'couponseek' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
				?>
			</div>
		<?php else : ?>
			<?php 
			the_content(); 
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title font-heading">' . esc_html__( 'Pages:', 'couponseek' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>
		<?php endif; ?>
			
		<?php if ( comments_open() ) : ?>
			<div class="SinglePostComments container mt-40">
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