<?php

/*
Plugin Name: Subsolar Designs Twitter Widget
Plugin URI: http://www.subsolardesigns.com
Description: Adds a Twitter Widget by Subsolar Designs.
Version: 1.0
Author: Subsolar Designs
Author URI: http://www.subsolardesigns.com
*/	

/**
 * Require Twitter Wrapper and Twitter Widget.
 */
require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'TwitterAPIExchange.php' );

require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'twitter-widget/class-widget-twitter.php' );

/**
*  Twitter Feed
*/

if ( !function_exists( 'ssd_twitter_feed' ) ) {
	function ssd_twitter_feed($count = 3, $user = '', $api_keys = array()) { 

		$twitter_key = $api_keys['twitter_key'];
		$twitter_secret = $api_keys['twitter_secret'];
		$twitter_token = $api_keys['twitter_token'];
		$twitter_token_secret = $api_keys['twitter_token_secret'];

		$i = 0;
		$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$getfield = '?screen_name=' . '' . '&count=' . $count;
		$requestMethod = 'GET';
		$return = array();

		if ( empty($twitter_key) || empty($twitter_secret) || empty($twitter_token) || empty($twitter_token_secret) ) {
			$settings = array(
				'consumer_key' 				=> '',
				'consumer_secret' 			=> '',
				'oauth_access_token'		=> '',
				'oauth_access_token_secret'	=> ''
			);
		}
		else {
			$settings = array(
				'consumer_key' 				=> $api_keys['twitter_key'],
				'consumer_secret' 			=> $api_keys['twitter_secret'],
				'oauth_access_token'		=> $api_keys['twitter_token'],
				'oauth_access_token_secret'	=> $api_keys['twitter_token_secret']
			);
		}

		if ( $url === '' || $getfield === '' || $requestMethod === '' ) {
			return;
		}

		$exchanger = new TwitterAPIExchange( $settings );

		if ( is_wp_error( $exchanger ) ) {
			return '';
		}
		
		$tweets = $exchanger->setGetfield( $getfield )
					 ->buildOauth( $url, $requestMethod )
					 ->performRequest(); 
		$tweets = json_decode( $tweets, true );

		if ( empty( $tweets ) ) {
			return $return;
		}

		if (!empty($tweets['errors'])) {
			if ( current_user_can( 'edit_theme_options' ) ) {
				$return = array(
					'error' => esc_html__('Make sure Twitter Consumer Key and Access Token are set.', 'subsolar_widget'));
			}
			return $return;
		}

		foreach( $tweets as $tweet ){
			if ( isset($tweet['user']['screen_name']) ) {
				$tweet_author = 'https://twitter.com/' . $tweet['user']['screen_name'];
			} else {
				$tweet_author = '';
			}
			$tweet_text = !empty( $tweet['text'] ) ? $tweet['text'] : '';
			$tweet_date = !empty( $tweet['created_at'] ) ? ssd_twitter_relative_time( $tweet['created_at'] ) : '';
			
			/*
			 * Replace URLs to working Links
			 */
			$tweet_text = preg_replace( '/\b(?:(http(s?):\/\/)|(?=www\.))(\S+)/is', '<a href="http$2://$3" target="_blank">$1$3</a>', $tweet_text ); 
			/*
			 * match name@address
			 */
			$tweet_text = preg_replace( "/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $tweet_text );
			
			/*
			 * Replace username start by @ to working link
			 */
			$tweet_text = preg_replace( '/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $tweet_text );
			
			/*
			 * Replace hash (#) to search link
			 */
			$tweet_text = preg_replace( '/\s#(\w+)/', ' <a href="//twitter.com/search?q=$1">#$1</a>', $tweet_text );
			
			$return[$i]['tweet'] = $tweet_text;
			$return[$i]['time'] = $tweet_date;
			$return[$i]['author'] = $tweet_author;
			
			$i++;
		}

		return ( array ) $return;

	}
}


/**
*  Twitter Relative Time
*/

if( !function_exists( 'ssd_twitter_relative_time' ) ) {
	function ssd_twitter_relative_time( $time ) {
		//get current timestamp
		$b = strtotime( "now" ); 
		//get timestamp when tweet created 
		$c = strtotime( $time ); 
		//get difference 
		$d = $b - $c; 
		//calculate different time values 
		$minute = 60; 
		$hour = $minute * 60; 
		$day = $hour * 24; 
		$week = $day * 7; 
		if(is_numeric($d) && $d > 0) { 
			//if less then 3 seconds 
			if( $d < 3 ) return esc_html__( 'right now', 'subsolar_widget' ); 
			//if less then minute 
			if( $d < $minute ) return floor( $d ) . esc_html__( ' seconds ago', 'subsolar_widget' ); 
			//if less then 2 minutes 
			if( $d < $minute * 2 ) return esc_html__( 'about a minute ago', 'subsolar_widget' ); 
			//if less then hour 
			if( $d < $hour ) return floor( $d / $minute ) . esc_html__(' minutes ago', 'subsolar_widget' );
			//if less then 2 hours 
			if( $d < $hour * 2 ) return esc_html__('about an hour ago', 'subsolar_widget' ); 
			//if less then day 
			if( $d < $day ) return floor( $d / $hour ) . esc_html__( ' hours ago','subsolar_widget' ); 
			//if more then day, but less then 2 days 
			if( $d > $day && $d < $day * 2 ) return esc_html__( 'yesterday','subsolar_widget' ); 
			//if less then year 
			if( $d < $day * 365 ) return floor( $d / $day ) . esc_html__( ' days ago', 'subsolar_widget' ); 
			// else return more than a year return "over a year ago"; 
		}
	}
}