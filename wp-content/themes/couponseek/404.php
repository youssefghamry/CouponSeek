<?php
get_header();
?>

<div class="ErrorPage text-center">

	<div class="error-404-wrapper">
		<div class="SpecialHeading text-center mb-60">
			<h1 class="special-title"><?php esc_html_e('Error 404', 'couponseek'); ?></h1>
			<div class="special-subtitle mt-40">
				<?php esc_html_e('Whatever You Were Looking For Was Not Found.', 'couponseek'); ?>
			</div>
		</div>
		<a class="btn btn-normal" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back To Home', 'couponseek'); ?></a>
	</div> <!-- end error-404-wrapper -->
	
</div> <!-- end ErrorPage -->

<?php get_footer(); ?>