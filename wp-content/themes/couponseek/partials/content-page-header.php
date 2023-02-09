<?php if ( !couponseek_get_field('hide_title') || !class_exists('acf') ) : ?>
	<?php if ( !couponseek_get_field('full_width', get_the_ID(), false) ) : ?>
	<div class="PageHeader container text-left">
	<?php else : ?>
	<div class="PageHeader text-left">
	<?php endif ?>
		<div class="SpecialHeading">
			<h1 class="special-title"><?php the_title(); ?></h1>
		</div>
	</div>
<?php endif; ?>