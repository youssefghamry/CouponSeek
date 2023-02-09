<?php  
/**
* ----------------------------------------------------------------------------------------
*    Popular Posts Widget
* ----------------------------------------------------------------------------------------
*/
Class CouponSeek_Widget_Popular_Posts extends WP_Widget {
	
	public function __construct() {
		$widget_ops = array( 'description' => esc_html__("Your site's most popular Posts.",'couponseek') );
		parent::__construct( 'popular_posts', esc_html__('[CouponSeek] Popular Posts', 'couponseek'), $widget_ops );
	}

	public function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget-title', $instance['title']);

		echo $before_widget;

		if( $title ) {
			echo $before_title . $title . $after_title;
		}

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $instance['posts_number'],
			'meta_key' => 'couponseek_post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
			'post_status' => 'publish'
		);

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) : ?>
			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post(); ?>
				<article <?php post_class(); ?>>
					<a href="<?php echo esc_url(get_permalink()); ?>">
						<div class="WidgetPostContent">

							<?php if ( has_post_thumbnail() ) : 

							$thumb_id = get_post_thumbnail_id(get_the_ID());
							$image_src = wp_get_attachment_image_src($thumb_id, 'couponseek_landscape_medium');
							$image_url = esc_url($image_src[0]);
							?>
							<div class="popular-posts-image">
								<div class="bg-image" data-bg-image="<?php echo esc_url($image_url); ?>"></div>
							</div>
							<div class="popular-posts-meta with-image">

							<?php else : ?>

							<div class="popular-posts-meta">

							<?php endif; // has_post_thumbnail?>

								<h4 class="popular-posts-title"><?php the_title(); ?></h4>
								<p class="popular-posts-meta-extra"><?php echo get_the_date(get_option('date_format')); ?></p>
							</div>

						</div> <!-- end WidgetPostContent -->
					</a>

				</article>

			<?php
			endwhile; //the_query ?>
		<?php
		endif; //the_query

		wp_reset_postdata();

		echo $after_widget;
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['posts_number'] = strip_tags($new_instance['posts_number']);

		return $instance;
	}

	public function form($instance) {
		$defaults = array(
			'title' => esc_html__('Popular Posts', 'couponseek'),
			'posts_number' => 3
		);

		$instance = wp_parse_args((array) $instance, $defaults);
		?>
		
		<p>
			<label for="<?php echo esc_url($this->get_field_id('title')) ?>"><?php esc_html_e('Title', 'couponseek') ?></label>
			<input type="text" id="<?php echo esc_url($this->get_field_id('title')) ?>" name="<?php echo esc_attr($this->get_field_name('title')) ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?> ">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('posts_number')) ?>"><?php esc_html_e('Number of Posts', 'couponseek') ?></label>
			<input type="text" id="<?php echo esc_attr($this->get_field_id('posts_number')) ?>" name="<?php echo esc_attr($this->get_field_name('posts_number')) ?>" class="widefat" value="<?php echo esc_attr($instance['posts_number']); ?> ">
		</p>

		<?php
	}

}
?>