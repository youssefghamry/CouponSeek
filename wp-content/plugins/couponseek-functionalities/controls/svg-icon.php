<?php
/**
 * Elementor svg-icon control.
 *
 * A base control for creating an icon control. Displays a font icon select box
 * field. The control accepts `include` or `exclude` arguments to set a partial
 * list of icons.
 *
 * @since 1.0.0
 */
class SVG_Icon extends \Elementor\Base_Data_Control {

	/**
	 * Get icon control type.
	 *
	 * Retrieve the control type, in this case `svg-icon`.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'svg_icon';
	}

	public function enqueue() {
		// Scripts
		wp_enqueue_style( 'svg-icon-styles', plugins_url( 'assets/css/svg-icon-styles.css', __FILE__ ), array(), '1.0' );
		wp_enqueue_script( 'svg-icon-scripts',  plugins_url( 'assets/js/svg-icon-scripts.js', __FILE__ ), [ 'jquery' ], '1.0.0' );
	}

	/**
	 * Get icons.
	 *
	 * Retrieve all the available icons.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return array Available icons.
	 */
	public static function get_icons() {
		global $wp_filesystem;
		$out = array();
        if (empty($wp_filesystem)) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        $file_path =  ( __DIR__ . '/assets/svg/icons.svg' );
        if ( $wp_filesystem->exists($file_path) ) {

            $contents = $wp_filesystem->get_contents( $file_path );
            preg_match_all( '#id="(\S+)"#', $contents, $svg );
            array_shift( $svg );
            foreach ( $svg[0] as $id ) {
                $out[] = array(
                    'id'       => $id,
                    'text'     => self::get_nice_display_text( $id ),
                    'disabled' => false
                );
            }

            if(!$contents) {
                return new WP_Error('reading_error', esc_html__('Error when reading file', 'couponseek')); 
            }
        }
		$svg_icons = $out;
		return $svg_icons;
	}

	public static function get_nice_display_text( $id ) {
        // Split up the string based on the '-' carac
        $ex = explode( '-', $id );
        if ( empty( $ex ) ) {
            return $id;
        }

        // Delete the repeating value, as it has no real value for the icon name.
        if ( $ex[0] = 'icon' ) {    
            unset( $ex[0] );
        }
        if ( $ex[1] = 'svg' ) { 
            unset( $ex[1] );
        }

        // Remix values into one with spaces
        $text = implode( ' ', $ex );

        // Add uppercase to the first word
        return Ucfirst( $text );
    }

	/**
	 * Get icons control default settings.
	 *
	 * Retrieve the default settings of the icons control. Used to return the default
	 * settings while initializing the icons control.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'options' => self::get_icons(),
			'include' => '',
			'exclude' => '',
		];
	}

	/**
	 * Render icons control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="hidden" hidden>
			<?php include_once( __DIR__ . '/assets/svg/icons.svg' ); ?>
		</div>
		<div class="elementor-control-field">
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<select id="<?php echo $control_uid; ?>" class="elementor-control-svg-icon" data-setting="{{ data.name }}" data-placeholder="<?php echo __( 'Select Icon', 'couponseek' ); ?>">
					<option value=""><?php echo __( 'Select Icon', 'couponseek' ); ?></option>
					<# _.each( data.options, function( option_title ) { #>
					<option value="{{ _.result(option_title, 'id') }}">{{{ _.result(option_title, 'text') }}}</option>
					<# } ); #>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{ data.description }}</div>
		<# } #>
		<?php
	}
}

\Elementor\Plugin::instance()->controls_manager->register_control( 'svg_icon', new SVG_Icon() );