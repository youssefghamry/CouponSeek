<?php if ( has_post_thumbnail() ) : ?>

<div class="SinglePostHeader header-with-image mb-100">

	<?php
	$thumb_id = get_post_thumbnail_id($post->ID);
	$image_src = wp_get_attachment_url($thumb_id);
	?>
	<div class="bg-image" data-bg-image="<?php echo esc_url($image_src); ?>"></div>
	<div class="container">
		<div class="single-post-header-content row">
			<div class="single-post-title col-sm-12">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="single-post-meta-wrapper col-sm-12 col-md-8 col-lg-9">
				<div class="single-post-meta">
					<div class="single-post-meta-categories font-heading"><?php the_category(' / '); ?></div>
					<span class="single-post-meta-date"><?php echo esc_html(get_the_date(get_option('date_format')));?></span>
				</div>
			</div>
		</div> <!-- single-post-header-content -->
	</div>

</div> <!-- end SinglePostHeader -->

<?php else : ?>

<div class="SinglePostHeader header-no-image mb-40">

	<div class="container">
		<div class="single-post-header-content row">
			<div class="single-post-title col-sm-12">
				<h1><?php the_title(); ?></h1>
			</div>
		</div> <!-- single-post-header-content -->
	</div>

</div> <!-- end SinglePostHeader -->

<?php endif; ?>