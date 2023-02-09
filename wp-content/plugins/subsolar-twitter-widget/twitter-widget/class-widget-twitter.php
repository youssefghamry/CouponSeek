<?php 
/**
* ----------------------------------------------------------------------------------------
*    Daily Deal Widget
* ----------------------------------------------------------------------------------------
*/
Class SSD_Widget_Twitter extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => esc_html__('Display your latest tweets.','subsolar_widget') );
		parent::__construct( 'twitter', esc_html__('[Subsolar Designs] Twitter', 'subsolar_widget'), $widget_ops );

		add_action('widgets_init', [ $this, 'register_widget' ]);
	}

	
	public function widget( $args, $instance ) {

		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);

		echo $before_widget;

		echo '<div class="twitter-widget-wrapper">';

		if ( $title ) { echo $before_title . $title . $after_title; }

		$output = '';
		
		if( function_exists( 'ssd_twitter_feed' ) ){

			$api_keys = array(
				'twitter_key' => $instance['consumer_key'],
				'twitter_secret' => $instance['consumer_secret'],
				'twitter_token' => $instance['access_token'],
				'twitter_token_secret' => $instance['access_token_secret']
			);

			$tweets = ssd_twitter_feed( $instance['tweet_count'], '', $api_keys );
			if( !is_wp_error( $tweets ) && !empty( $tweets ) ) :
				$output = '';
				$output .= '<ul class="list-unstyled">';
					if ( !empty($tweets['error']) ) {
						$output .= '<li><div class="tweet-content">'. $tweets['error'] .'</div></li>';
					}
					else {
						foreach($tweets as $tweet){
							if( !empty($tweet['tweet']) )
								if ( !empty($tweet['author']) ) {
									$output .= '<li><div class="tweet-content">'. $tweet['tweet'] .'</div> <a href='. $tweet['author'] .' class="tweet-time">'. $tweet['time'] .'</a></li>';
								} else {
									$output .= '<li><div class="tweet-content">'. $tweet['tweet'] .'</div> <span class="tweet-time">'. $tweet['time'] .'</span></li>';
								}
						}
					}
				$output .= '</ul>';
			endif;
			
		}

		echo wp_kses_post($output);

		echo '</div><!-- end twitter-widget-wrapper -->';

		echo $after_widget;

	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['tweet_count'] = (int) $new_instance['tweet_count'];
		$instance['consumer_key'] = trim($new_instance['consumer_key']);
		$instance['consumer_secret'] = trim($new_instance['consumer_secret']);
		$instance['access_token'] = trim($new_instance['access_token']);
		$instance['access_token_secret'] = trim($new_instance['access_token_secret']);

		return $instance;

	}

	public function form( $instance ) {

		$defaults = array(
			'title' => esc_html__('Twitter', 'subsolar_widget'),
			'tweet_count' => '3',
			'consumer_key' => '',
			'consumer_secret' => '',
			'access_token' => '',
			'access_token_secret' => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<!-- API Key check -->
		<?php
		if( function_exists( 'ssd_twitter_feed' ) ) :
		?>
		<p>
			<?php 
			if ( empty($instance['consumer_key']) || empty($instance['consumer_secret']) || empty($instance['access_token']) || empty($instance['access_token_secret']) ) {
				printf( esc_html__('You can generate your API keys in the Twitter Applications Management - https://apps.twitter.com/','subsolar_widget'));
			}
			?>
		</p>
		<?php endif; ?>

		<!-- The Title -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'subsolar_widget') ?></label>
			<input type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>">
		</p>
		
		<!-- Consumer Key -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('consumer_key')); ?>"><?php esc_html_e('Consumer Key:','subsolar_widget')?></label>
			<input id="<?php echo esc_attr($this->get_field_id('consumer_key')); ?>" class='widefat' name="<?php echo esc_attr($this->get_field_name('consumer_key')); ?>" type="text" value="<?php echo esc_attr($instance['consumer_key']); ?>" />
			<br>
			<small><?php esc_html_e('Note: You can find the Consumer Key in the Application -> Keys and Access Tokens -> Application Settings.', 'subsolar_widget' ) ?></small>
		</p>
		
		<!-- Consumer Secret -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('consumer_secret')); ?>"><?php esc_html_e('Consumer Secret:','subsolar_widget')?></label>
			<input id="<?php echo esc_attr($this->get_field_id('consumer_secret')); ?>" class='widefat' name="<?php echo esc_attr($this->get_field_name('consumer_secret')); ?>" type="text" value="<?php echo esc_attr($instance['consumer_secret']); ?>" />
			<br>
			<small><?php esc_html_e('Note: You can find the Consumer Secret in the Application -> Keys and Access Tokens -> Application Settings', 'subsolar_widget' ) ?></small>
		</p>
		
		<!-- Access Token -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('access_token')); ?>"><?php esc_html_e('Access Token:','subsolar_widget')?></label>
			<input id="<?php echo esc_attr($this->get_field_id('access_token')); ?>" class='widefat' name="<?php echo esc_attr($this->get_field_name('access_token')); ?>" type="text" value="<?php echo esc_attr($instance['access_token']); ?>" />
			<br>
			<small><?php esc_html_e('Note: You can find the Access Token in the Application -> Keys and Access Tokens -> Your Access Token.', 'subsolar_widget' ) ?></small>
		</p>
		
		<!-- Access Token Secret -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('access_token_secret')); ?>"><?php esc_html_e('Access Token Secret:','subsolar_widget')?></label>
			<input id="<?php echo esc_attr($this->get_field_id('access_token_secret')); ?>" class='widefat' name="<?php echo esc_attr($this->get_field_name('access_token_secret')); ?>" type="text" value="<?php echo esc_attr($instance['access_token_secret']); ?>" />
			<br>
			<small><?php esc_html_e('', 'subsolar_widget' ) ?></small>
		</p>
		
		<!-- Number of tweets -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('tweet_count')); ?>"><?php esc_html_e('Number of Tweets to Show:','subsolar_widget')?></label>
			<input id="<?php echo esc_attr($this->get_field_id('tweet_count')); ?>" class='widefat' name="<?php echo esc_attr($this->get_field_name('tweet_count')); ?>" type="number" value="<?php echo esc_attr((int) $instance['tweet_count']); ?>" />
			<br>
			<small><?php esc_html_e('Note: You can find the Access Token Secret in the Application -> Keys and Access Tokens -> Your Access Token.', 'subsolar_widget' ) ?></small>
		</p>
		
	<?php
	}

	public function register_widget() {
		register_widget('SSD_Widget_Twitter');
	}
	
}

new SSD_Widget_Twitter();

?>