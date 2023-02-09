<?php 
/**
* ----------------------------------------------------------------------------------------
*    Mailchimp Integration
* ----------------------------------------------------------------------------------------
*/
Class CouponSeek_Mailchimp_Integration {

	public function __construct() {
		// Styles and Scripts
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		// Register Widget
		add_action('widgets_init', [ $this,'register_mailchimp_widget' ] );
		// Register Elementor Hooks
		add_action('wp_ajax__action_couponseek_mailchimp_elementor_subscribe', [ $this, 'mailchimp_elementor_subscribe' ]);
		add_action('wp_ajax_nopriv__action_couponseek_mailchimp_elementor_subscribe', [ $this, 'mailchimp_elementor_subscribe' ]);
		// Register Widget Hooks
		add_action('wp_ajax__action_couponseek_mailchimp_widget_subscribe', [ $this, 'mailchimp_widget_subscribe' ]);
		add_action('wp_ajax_nopriv__action_couponseek_mailchimp_widget_subscribe', [ $this, 'mailchimp_widget_subscribe' ]);
	}
	
	public function enqueue_scripts() {
		wp_enqueue_script( 'couponseek-mailchimp-js', plugin_dir_url( __FILE__ ) . 'assets/js/scripts.js', [ 'jquery' ] );

		// Localization
		wp_localize_script( 'couponseek-mailchimp-js', 'subsolar_mailchimp', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'subs_email_empty' => esc_html__('You have not entered an email address.', 'couponseek'),
			'subs_email_error' => esc_html__('You have entered an invalid email address.', 'couponseek'),
			'subs_email_add' => esc_html__('Adding your email address...', 'couponseek'),
			)
		);
	}

	public function mailchimp_elementor_subscribe() {

		$api_key = couponseek_get_field('mailchimp_api_key', 'option');
		$list_id = couponseek_get_field('mailchimp_list_id', 'option');

		if ( !$api_key || !$list_id ) {
			if ( current_user_can( 'edit_theme_options' ) ) {
				$error_msg = esc_html__('Mailchimp API Key or List ID are not set.', 'couponseek');
			} else { 
				$error_msg = esc_html__( "Something went wrong. We couldn't sign you up.", 'couponseek');
			}
			echo '<div class="alert alert-danger">' . $error_msg .'</div>';
		}
		else {
			$email = strtolower($_POST['email']);
			$result = CouponSeek_Mailchimp_Integration::mailchimp_api_call($api_key,$list_id,$email);
			if ( !empty($result) ) {
				if ( $result['type'] == 'success' ) {
					echo '<div class="alert alert-success">' . $result['value'] . '</div>';
				} else {
					echo '<div class="alert alert-danger">' . $result['value'] .'</div>';
				}
			} else {
				echo '<div class="alert alert-danger">' . esc_html__( "Something went wrong. We couldn't sign you up.", 'couponseek') .'</div>';
			}
		}
		die();
	}


	public function mailchimp_widget_subscribe() {

		global $wp_widget_factory;
		$mailchimp_widget = false;

		foreach( $wp_widget_factory->widgets as $widget ) {
			if ( $widget->id == $_POST['widget_id'] ) {
				$mailchimp_widget = $widget;
				break;
			}
		}

		if ( !$mailchimp_widget ) die();

		$widget_options_all = get_option($widget->option_name);
		$options = $widget_options_all[ $widget->number ];

		$api_key = $options['api_key'] ? $options['api_key'] : false;
		$list_id = $options['list_id'] ? $options['list_id'] : false;

		if ( !$api_key || !$list_id ) {
			if ( current_user_can( 'edit_theme_options' ) ) {
				$error_msg = esc_html__('Mailchimp API Key or List ID are not set.', 'couponseek');
			} else { 
				$error_msg = esc_html__( "Something went wrong. We couldn't sign you up.", 'couponseek');
			}
			echo '<div class="alert alert-danger">' . $error_msg .'</div>';
		}
		else {
			$email = strtolower($_POST['email']);
			$result = CouponSeek_Mailchimp_Integration::mailchimp_api_call($api_key,$list_id,$email);
			if ( !empty($result) ) {
				if ( $result['type'] == 'success' ) {
					echo '<div class="alert alert-success">' . $result['value'] . '</div>';
				} else {
					echo '<div class="alert alert-danger">' . $result['value'] .'</div>';
				}
			} else {
				echo '<div class="alert alert-danger">' . esc_html__( "Something went wrong. We couldn't sign you up.", 'couponseek') .'</div>';
			}
		}
		die();
	}


	public function mailchimp_api_call( $key, $id, $user_email ) {
		$api_key = $key;
		$email = $user_email;
		$status = 'subscribed'; // subscribed, cleaned, pending
		$list_id = $id;
		$return_msg = array();
		$dc = substr($api_key,strpos($api_key,'-')+1); // us5, us8 etc

		// Check if email exists in list
		$args = array(
			'headers' => array(
				'Authorization' => 'Basic ' . base64_encode( 'user:'. $api_key )
			)
		);
		$response_get = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members/', $args );
		$body = json_decode( wp_remote_retrieve_body( $response_get ) );
		$emails = array();

		if ( wp_remote_retrieve_response_code( $response_get ) == 200 ) {
			foreach ( $body->members as $member ) {
				if( $member->status != 'subscribed' )
					continue;
				$emails[] = $member->email_address;
			}
		}

		if ( !empty($emails) && in_array($email, $emails) ) {
			$return_msg['type'] = 'error';
			$return_msg['value'] = esc_html__('Oops! This email address is already subscribed!', 'couponseek');
			
		} else {

			// Subscribe user
			$args = array(
				'method' => 'PUT',
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode( 'user:'. $api_key )
					),
				'body' => json_encode(array(
					'email_address' => $email,
					'status'        => $status
					))
				);
			$response = wp_remote_post( 'https://' . $dc . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($email)), $args );

			$return_msg['value'] = '';

			if ( $response->errors ) {
				$return_msg['type'] = 'error';
				foreach ($response->errors as $error => $value) {
					$return_msg['value'] .= $value[0] . '.';
				}
			} else {
				$return_msg['type'] = 'success';
				$return_msg['value'] = esc_html__( 'Success! You are signed up.', 'couponseek' );
			}
		}

		return $return_msg;
	}

	public function register_mailchimp_widget() {
		if ( !class_exists('CouponSeek_Mailchimp_Widget_Mailchimp') ) {
			require_once(  dirname( __FILE__ ) . '/class-widget-mailchimp.php' );
		}
		register_widget('CouponSeek_Mailchimp_Widget_Mailchimp');
	}



}

new CouponSeek_Mailchimp_Integration();