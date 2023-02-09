<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

class CouponSeek_Demo_Import {

	public $users_file;

	public function __construct()
	{
		@ini_set('mysql.connect_timeout', '5000');
		@ini_set('memory_limit', '5000M');
		@ini_set("max_execution_time", '5000');
		@ini_set("max_input_time", '5000');
		@ini_set('default_socket_timeout', '5000');
		@set_time_limit(0);

		$this->users_file = plugin_dir_path( __FILE__ ) . '/demo1/demo_vendors.csv';

		add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
		add_filter( 'pt-ocdi/plugin_page_setup', [ $this, 'plugin_page_setup' ]  );
		add_filter( 'pt-ocdi/import_files', [ $this, 'import_files' ] );
		add_action( 'pt-ocdi/after_import', [ $this, 'import_vendors' ] );
		add_action( 'pt-ocdi/after_import', [ $this, 'import_vendors' ] );
		add_action( 'pt-ocdi/plugin_page_footer', [ $this, 'plugin_page_footer' ] );

		add_filter( 'wxr_importer.pre_process.post_meta', [$this, 'post_meta_filter'], 1, 2 );
		add_filter( 'pt-ocdi/time_for_one_ajax_call', [$this, 'ocdi_change_time_of_single_ajax_call'] );

		// add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
		/*
		If the import is complete and you used the above function uncommented, please install this plugin: https://wordpress.org/plugins/regenerate-thumbnails/ and run it in Tools -> Regen. Thumbnails. This will then create the smaller versions of images, that we skipped in the import.
		*/

	}

	 public function plugin_page_setup($args) {
	 	$args['capability'] = 'edit_theme_options';
		return  $args;
	 }

	 public function post_meta_filter( $meta_item, $post_id ) {
        if ( '_elementor_data' != $meta_item['key'] ) {
            return $meta_item;
        }

        try{
            $data = json_decode( $meta_item['value'] );
        } catch( Exception $e ) {}

        if ( ! $data ) {
            return $meta_item;
        }

        foreach ( $data as &$settings ) {
            $this->parse_data( $settings );
        }

        $meta_item['value'] = json_encode( $data );

        return $meta_item;
    }

    protected function parse_data( &$data, $return_status = false ) {
        if ( isset( $data->settings ) ) {
	        if ( isset( $data->settings->background_image ) ) {
	        	$data->settings->background_image->url = preg_replace('/((http|https):\/\/subsolardesigns\.com\/couponseek)/', get_site_url(), $data->settings->background_image->url);
	        }
	        if ( isset( $data->settings->background_hover_image ) ) {
	        	$data->settings->background_hover_image->url = preg_replace('/((http|https):\/\/subsolardesigns\.com\/couponseek)/', get_site_url(), $data->settings->background_hover_image->url);
	        }
	        if ( isset( $data->settings->Overlay_image ) ) {
	        	$data->settings->Overlay_image->url = preg_replace('/((http|https):\/\/subsolardesigns\.com\/couponseek)/', get_site_url(), $data->settings->Overlay_image->url);
	        }
	        if ( isset( $data->settings->background_overlay_image ) ) {
	        	$data->settings->background_overlay_image->url = preg_replace('/((http|https):\/\/subsolardesigns\.com\/couponseek)/', get_site_url(), $data->settings->background_overlay_image->url);
	        }
	    }
	    if ( isset( $data->elements ) && is_array( $data->elements ) ) {
            foreach( $data->elements as &$element ) {
                $return_status = $this->parse_data( $element, $return_status );
            }
        }

        $return_status = true;

        return $return_status;
    }

	public function import_files() {
		return array(
			array(
				'import_file_name'           => 'Main Demo',
				'local_import_file'          => plugin_dir_path( __FILE__ ) . '/demo1/main_demo.xml',
				'local_import_widget_file'   => plugin_dir_path( __FILE__ ) . '/demo1/main_demo_widgets.wie',
                'import_preview_image_url'   => plugin_dir_url( __FILE__ ) . 'demo1/main_demo.png',
                'import_notice'              => __( '<strong>Important!</strong> After you import this demo, you will have to manually go to <strong>Appearance > Theme Settings</strong> and press <strong>Update</strong>.', 'couponseek' ),
                'preview_url'                => 'https://subsolardesigns.com/couponseek/',
			),
			array(
				'import_file_name'           => 'Main Demo (No Images)',
				'local_import_file'          => plugin_dir_path( __FILE__ ) . '/demo2/main_demo_no_images.xml',
				'local_import_widget_file'   => plugin_dir_path( __FILE__ ) . '/demo2/main_demo_no_images_widgets.wie',
                'import_preview_image_url'   => plugin_dir_url( __FILE__ ) . 'demo2/main_demo_no_images.png',
                'import_notice'              => __( '<strong>Important!</strong> After you import this demo, you will have to manually go to <strong>Appearance > Theme Settings</strong> and press <strong>Update</strong>.', 'couponseek' ),
                'preview_url'                => 'https://subsolardesigns.com/couponseek/',
			),
		);
	}

	public function after_import() {
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Menu 1', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
				'main-navigation' => $main_menu->term_id,
			)
		);

		// Assign front page and posts page (blog page).
		$front_page_id = get_page_by_title( 'Homepage' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );

		flush_rewrite_rules();
	}

	public function plugin_page_footer() {
		?>
		<div class="ocdi__intro-text about-wrap">
			<p class="about-description">
				<h4><?php esc_html_e( 'Demo Import taking too long?', 'couponseek' ); ?></h4>
			<ul>
				<li>
				<?php
				printf(
				    esc_html__( 'If the demo import is freezing, your server is probably not configured properly and cannot download all the images from the demo - %1$s.', 'couponseek' ),
				    sprintf(
				        '<a href="%s">%s</a>',
				        'https://github.com/awesomemotive/one-click-demo-import/blob/master/docs/import-problems.md',
				        esc_html__( 'read more in this article', 'couponseek' )
				        )
			    );
				?>	
				</li>
				<li>
				<?php
				esc_html_e( 'If the server keeps freezing, you can try installing the No Images demo.', 'couponseek' );
				?>	
				</li>
			</ul>
			</p>
		</div>
		<?php
	}

	public function import_vendors() {
		$errors = $user_ids = array();
		$upload_dir = wp_upload_dir();
		$log_dir_path = trailingslashit( $upload_dir['basedir'] );

		// User data fields list used to differentiate with user meta
		$userdata_fields       = array(
			'ID', 'user_login', 'user_pass',
			'user_email', 'user_url', 'user_nicename',
			'display_name', 'user_registered', 'first_name',
			'last_name', 'nickname', 'description',
			'rich_editing', 'comment_shortcuts', 'admin_color',
			'use_ssl', 'show_admin_bar_front', 'show_admin_bar_admin',
			'role'
		);

		if ( !class_exists('ReadCSV') ) {
			include( plugin_dir_path( __FILE__ ) . '/class-readcsv.php');
		}

		// Loop through the file lines
		$file_handle = fopen( $this->users_file, 'r' );
		$csv_reader = new ReadCSV( $file_handle, ',', "\xEF\xBB\xBF" ); // Skip any UTF-8 byte order mark.

		$first = true;
		$rkey = 0;
		while ( ( $line = $csv_reader->get_row() ) !== NULL ) {

			// If the first line is empty, abort
			// If another line is empty, just skip it
			if ( empty( $line ) ) {
				if ( $first )
					break;
				else
					continue;
			}

			// If we are on the first line, the columns are the headers
			if ( $first ) {
				$headers = $line;
				$first = false;
				continue;
			}

			// Separate user data from meta
			$userdata = $usermeta = array();
			foreach ( $line as $ckey => $column ) {
				$column_name = $headers[$ckey];
				$column = trim( $column );

				if ( in_array( $column_name, $userdata_fields ) ) {
					$userdata[$column_name] = $column;
				} else {
					$usermeta[$column_name] = $column;
				}
			}

			// A plugin may need to filter the data and meta
			$userdata = apply_filters( 'is_iu_import_userdata', $userdata, $usermeta );
			$usermeta = apply_filters( 'is_iu_import_usermeta', $usermeta, $userdata );

			// If no user data, bailout!
			if ( empty( $userdata ) )
				continue;

			// Something to be done before importing one user?
			do_action( 'is_iu_pre_user_import', $userdata, $usermeta );

			$user = $user_id = false;

			if ( isset( $userdata['ID'] ) )
				$user = get_user_by( 'ID', $userdata['ID'] );

			$update = false;
			if ( $user ) {
				$userdata['ID'] = $user->ID;
				$update = true;
			}

			// If creating a new user and no password was set, let auto-generate one!
			if ( ! $update && empty( $userdata['user_pass'] ) )
				$userdata['user_pass'] = wp_generate_password( 12, false );

			if ( $update )
				$user_id = wp_update_user( $userdata );
			else
				$user_id = wp_insert_user( $userdata );

			// Is there an error o_O?
			if ( is_wp_error( $user_id ) ) {
				$errors[$rkey] = $user_id;
			} else {
				// If no error, let's update the user meta too!
				if ( $usermeta ) {
					foreach ( $usermeta as $metakey => $metavalue ) {
						$metavalue = maybe_unserialize( $metavalue );
						update_user_meta( $user_id, $metakey, $metavalue );
					}
				}

				// Add Vendor role
				if ( get_role('vendor') ) {
					wp_update_user( array( 'ID' => $user_id, 'role' => 'vendor' ) );
				}

				// Some plugins may need to do things after one user has been imported. Who know?
				do_action( 'is_iu_post_user_import', $user_id );

				$user_ids[] = $user_id;
			}

			$rkey++;
		}
		fclose( $file_handle );

		// One more thing to do after all imports?
		do_action( 'is_iu_post_users_import', $user_ids, $errors );

		// Let's log the errors
		if ( !empty($errors) ) {
			$log = @fopen( $log_dir_path . 'is_iu_errors.log', 'a' );
			@fwrite( $log, sprintf( __( 'BEGIN %s' , 'import-users-from-csv'), date( 'Y-m-d H:i:s', time() ) ) . "\n" );

			foreach ( $errors as $key => $error ) {
				$line = $key + 1;
				$message = $error->get_error_message();
				@fwrite( $log, sprintf( __( '[Line %1$s] %2$s' , 'import-users-from-csv'), $line, $message ) . "\n" );
			}

			@fclose( $log );
		}
	}

	public function ocdi_change_time_of_single_ajax_call($time) {
		return 10; // change to 180 if server error 500
	}

}

new CouponSeek_Demo_Import;