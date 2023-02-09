</div><!-- end MAIN-CONTENT -->
<?php 
$has_widgets = false;

if( is_active_sidebar('footer1') || is_active_sidebar('footer2') || is_active_sidebar('footer3') ){
	$has_widgets = true;
}
?>
<?php if( is_active_sidebar('footer1')  || couponseek_get_field('footer_text', 'option') ) : ?>
<div class="footer-offset"></div>
<footer class="FOOTER <?php echo esc_attr(couponseek_get_field('footer_text_type', 'option') == 'light' ? 'section-light' : '') ?> <?php echo esc_attr($has_widgets ? 'has-widgets' : '')  ?>">

	<?php if ( couponseek_get_field('footer_background_image', 'option') ) : 

		$footer_image = couponseek_get_field('footer_background_image', 'option');

		if ( couponseek_get_field('footer_background_repeat', 'option') ) : ?>
		<div class="bg-image bg-image-repeat" data-bg-image="<?php echo esc_url($footer_image['url']); ?>"></div>
		<?php else : ?>
		<div class="bg-image" data-bg-image="<?php echo esc_url($footer_image['url']); ?>"></div>
		<?php endif;
	endif; ?>
	
	<?php if ( couponseek_get_field('footer_color', 'option') && couponseek_get_field('footer_color_opacity', 'option') > 0 ) : ?>
	<div class="overlay-color"></div>
	<?php endif; ?>

	<div class="container">
		<div class="row">
			<?php get_template_part('partials/content','footer-widgets'); ?>

			<div class="col-sm-12">
				<?php if ( couponseek_get_field('footer_text', 'option') ) : ?>
				<div class="copyright">
					<?php echo wp_kses_post( couponseek_get_field('footer_text', 'option') ); ?>
				</div>
			<?php endif; ?>
			</div><!-- end col-sm-12 -->
		</div><!-- end row -->
	</div><!-- end container -->
	

</footer>
<?php endif; ?>

<?php wp_footer() ;?>
</body>
</html>