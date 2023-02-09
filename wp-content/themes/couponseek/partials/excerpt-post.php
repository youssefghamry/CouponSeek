<article <?php post_class(esc_attr('Excerpt mb-100')); ?> id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>

	<?php $thumb_id = get_post_thumbnail_id(get_the_ID()); ?>
	<div class="excerpt-image">
		<?php echo wp_get_attachment_image( $thumb_id, 'couponseek_landscape_medium' ); ?>
	</div> <!-- end excerpt-image -->
	
	<div class="ExcerptContentWrapper pos-r">
	<?php else : ?>
	<div class="ExcerptContentWrapper no-image pos-r">
	<?php endif; ?>

		<div class="excerpt-header text-center">
			<div class="excerpt-title">
				<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
			</div>
			<div class="excerpt-meta">
				<?php if ( has_category() ) : ?>
				<span class="excerpt-meta-categories"><?php the_category(' '); ?></span>
				<?php endif; ?>
			</div> <!-- end excerpt-meta -->
		</div> <!-- end except-header -->

		<div class="excerpt-content">
			<?php the_excerpt(); ?>
		</div>
		<div class="excerpt-footer pos-r">
			<a href="<?php the_permalink(); ?>" class="btn btn-color"><?php echo esc_html__('Read More', 'couponseek'); ?></a>
			<span class="excerpt-date"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></span>
		</div>

	</div>

</article> <!-- end article -->