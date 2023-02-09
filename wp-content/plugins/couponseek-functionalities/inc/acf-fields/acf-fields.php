<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5b963b70c3e74',
	'title' => __('Page Header', 'couponseek'),
	'fields' => array(
		array(
			'key' => 'field_5b96577033eaf',
			'label' => __('Full Width', 'couponseek'),
			'name' => 'full_width',
			'type' => 'true_false',
			'instructions' => __('Remove the spacing added on the left and right of the page content.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5b96487406f9e',
			'label' => __('Archive Page', 'couponseek'),
			'name' => 'archive_page',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '20',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => __('Show', 'couponseek'),
			'ui_off_text' => __('Hide', 'couponseek'),
		),
		array(
			'key' => 'field_5b96496f4c996',
			'label' => __('404 Page', 'couponseek'),
			'name' => '404_page',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '20',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => __('Show', 'couponseek'),
			'ui_off_text' => __('Hide', 'couponseek'),
		),
		array(
			'key' => 'field_5b9649774c997',
			'label' => __('Search Page', 'couponseek'),
			'name' => 'search_page',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '20',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => __('Show', 'couponseek'),
			'ui_off_text' => __('Hide', 'couponseek'),
		),
		array(
			'key' => 'field_5b9649a14c998',
			'label' => __('[WooCommerce] Single Product Page', 'couponseek'),
			'name' => 'woocommerce_single_product_page',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '20',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => __('Show', 'couponseek'),
			'ui_off_text' => __('Hide', 'couponseek'),
		),
		array(
			'key' => 'field_5b9649bf4c999',
			'label' => __('[WooCommerce] Shop Page', 'couponseek'),
			'name' => 'woocommerce_shop_page',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '20',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => __('Show', 'couponseek'),
			'ui_off_text' => __('Hide', 'couponseek'),
		),
		array(
			'key' => 'field_5b963ecd2c087',
			'label' => __('Show in Pages', 'couponseek'),
			'name' => 'show_in_pages',
			'type' => 'relationship',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'page',
			),
			'taxonomy' => array(
			),
			'filters' => array(
				0 => 'search',
			),
			'elements' => '',
			'min' => '',
			'max' => '',
			'return_format' => 'object',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'ssd-page-header',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5b583df85359f',
	'title' => __('Theme General Settings', 'couponseek'),
	'fields' => array(
		array(
			'key' => 'field_5b583e1b948af',
			'label' => __('Google API Key*', 'couponseek'),
			'name' => 'google_api',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5ef1d2e1cc6a5',
						'operator' => '!=',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5ef1d469cc6a8',
			'label' => __('Restricted Google Maps API Keys', 'couponseek'),
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5ef1d2e1cc6a5',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'message' => __('If you want to enable restrictions for your API key, you will need 2 keys. One with HTTP restriction for the location select field for each deal and one with IP restrictions that will deal with the server-side of saving the deal locations in the city/countries dropdown.

<a href="https://cloud.google.com/blog/products/maps-platform/google-maps-platform-best-practices-restricting-api-keys">Read More</a>', 'couponseek'),
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		),
		array(
			'key' => 'field_5ef1d2e1cc6a5',
			'label' => __('Is the Google API Key Restricted?', 'couponseek'),
			'name' => 'google_api_restricted',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5ef1d431cc6a6',
			'label' => __('Google API Key Web (HTTP Restricted)', 'couponseek'),
			'name' => 'google_api_http',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5ef1d2e1cc6a5',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5ef1d458cc6a7',
			'label' => __('Google API Key Web (IP Restricted)', 'couponseek'),
			'name' => 'google_api_ip',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5ef1d2e1cc6a5',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5bb35df9a82b1',
			'label' => __('Mailchimp API Key', 'couponseek'),
			'name' => 'mailchimp_api_key',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5bb35f0e1f313',
			'label' => __('Mailchimp List ID', 'couponseek'),
			'name' => 'mailchimp_list_id',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b586496ab272',
			'label' => __('Logo Name', 'couponseek'),
			'name' => 'logo_name',
			'type' => 'text',
			'instructions' => __('Write your website logo name. If no logo image is presented, the name will be used instead.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b5864aeab273',
			'label' => __('Logo Image (Light)', 'couponseek'),
			'name' => 'logo_image_light',
			'type' => 'image',
			'instructions' => __('Upload the logo image that will be used for the transparent navigation bar.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5b5864f2ab274',
			'label' => __('Logo Image (Dark)', 'couponseek'),
			'name' => 'logo_image_dark',
			'type' => 'image',
			'instructions' => __('Upload the logo image.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5b58650aab275',
			'label' => __('Logo Image (Mobile)', 'couponseek'),
			'name' => 'logo_image_mobile',
			'type' => 'image',
			'instructions' => __('Upload the logo image on mobile. It will fallback to the dark and then to the light logo.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5b92530a302e7',
			'label' => __('Footer Text Type', 'couponseek'),
			'name' => 'footer_text_type',
			'type' => 'radio',
			'instructions' => __('Choose the color of the footer text.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'light' => __('Light Text', 'couponseek'),
				'dark' => __('Dark Text', 'couponseek'),
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'default_value' => 'dark',
			'layout' => 'vertical',
			'return_format' => 'value',
			'save_other_choice' => 0,
		),
		array(
			'key' => 'field_5b925405302e9',
			'label' => __('Footer Background Image', 'couponseek'),
			'name' => 'footer_background_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '25',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5b925ef9302ea',
			'label' => __('Footer Color', 'couponseek'),
			'name' => 'footer_color',
			'type' => 'color_picker',
			'instructions' => __('Used as a filter over the image. If there isn\'t any image, it will be used as a background color.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '25',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
		),
		array(
			'key' => 'field_5b925fa9302eb',
			'label' => __('Footer Color Opacity', 'couponseek'),
			'name' => 'footer_color_opacity',
			'type' => 'range',
			'instructions' => __('0 for a fully transparent Footer Color and 100 for a solid color.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '25',
				'class' => '',
				'id' => '',
			),
			'default_value' => 0,
			'min' => 0,
			'max' => 100,
			'step' => 1,
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_5b926035302ec',
			'label' => __('Footer Background Repeat', 'couponseek'),
			'name' => 'footer_background_repeat',
			'type' => 'true_false',
			'instructions' => __('Repeat the background image. For example enable the option to repeat an image in a pattern.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5b925405302e9',
						'operator' => '!=empty',
					),
				),
			),
			'wrapper' => array(
				'width' => '25',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => __('Yes', 'couponseek'),
			'ui_off_text' => __('No', 'couponseek'),
		),
		array(
			'key' => 'field_5b926231a52f1',
			'label' => __('Footer Text', 'couponseek'),
			'name' => 'footer_text',
			'type' => 'wysiwyg',
			'instructions' => __('Write your website footer text.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-general-settings',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_592d55d80a318',
	'title' => __('Template Blog', 'couponseek'),
	'fields' => array(
		array(
			'key' => 'field_5a8d7c39f4de2',
			'label' => __('Search Header', 'couponseek'),
			'name' => 'search_header',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'show' => __('Show', 'couponseek'),
				'hide' => __('Hide', 'couponseek'),
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'hide',
			'layout' => 'vertical',
			'return_format' => 'value',
		),
		array(
			'key' => 'field_5a8d7bb8f4de1',
			'label' => __('Hide Title', 'couponseek'),
			'name' => 'hide_title',
			'type' => 'true_false',
			'instructions' => __('Hide the Page Title', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'message' => __('Hide Title', 'couponseek'),
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_592d5d695108f',
			'label' => __('Show Search Field', 'couponseek'),
			'name' => 'show_search',
			'type' => 'true_false',
			'instructions' => __('Show the Search Field in the header.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'message' => __('Show', 'couponseek'),
			'default_value' => 1,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'template-blog.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
	'modified' => 1519221864,
));

acf_add_local_field_group(array(
	'key' => 'group_5aa8f60f5e6e3',
	'title' => __('Template Contact', 'couponseek'),
	'fields' => array(
		array(
			'key' => 'field_5aa8f674dc748',
			'label' => __('Contact Form 7 Shortcode', 'couponseek'),
			'name' => 'contact_form_7_shortcode',
			'type' => 'text',
			'instructions' => 'Insert your Contact Form 7 shortcode. You can create one in <a href="http://localhost/couponseek/wp-admin/admin.php?page=wpcf7">Contact &gt; Contact Forms</a>',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '[contact-form-7 id="XX" title="XXXX"]',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5aa8f7e6dc749',
			'label' => __('Location', 'couponseek'),
			'name' => 'location',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '',
			'center_lng' => '',
			'zoom' => '',
			'height' => '',
		),
		array(
			'key' => 'field_5aa8f7fbdc74a',
			'label' => __('Map Zoom', 'couponseek'),
			'name' => 'map_zoom',
			'type' => 'number',
			'instructions' => __('Enter map zoom level from 1 to 20.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 15,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 1,
			'max' => 20,
			'step' => '',
		),
		array(
			'key' => 'field_5aa8f817dc74b',
			'label' => __('Marker', 'couponseek'),
			'name' => 'marker',
			'type' => 'image',
			'instructions' => __('Upload custom marker image.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'template-contact.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
	'modified' => 1521023023,
));

acf_add_local_field_group(array(
	'key' => 'group_5a55f640136cb',
	'title' => __('Product - External', 'couponseek'),
	'fields' => array(
		array(
			'key' => 'field_5a55f651ff5af',
			'label' => __('Discount Code', 'couponseek'),
			'name' => 'discount_code',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'product',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
	'modified' => 1515585253,
));

acf_add_local_field_group(array(
	'key' => 'group_5a325d356338a',
	'title' => __('Product Category', 'couponseek'),
	'fields' => array(
		array(
			'key' => 'field_5a325d53e789d',
			'label' => __('Category Icon', 'couponseek'),
			'name' => 'category_icon',
			'type' => 'svg_icon',
			'instructions' => __('Add a Category Icon.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'allow_clear' => 1,
		),
		array(
			'key' => 'field_5b2ced723a0ba',
			'label' => __('Icon Background Color', 'couponseek'),
			'name' => 'icon_bg_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'product_cat',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
	'modified' => 1536681529,
));

acf_add_local_field_group(array(
	'key' => 'group_59119c43b31c4',
	'title' => __('Page', 'couponseek'),
	'fields' => array(
		array(
			'key' => 'field_59119c4bf9881',
			'label' => __('Full Width', 'couponseek'),
			'name' => 'full_width',
			'type' => 'true_false',
			'instructions' => __('Remove the spacing added on the left and right of the page content.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'message' => __('Enable', 'couponseek'),
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_59b063ec2156a',
			'label' => __('Hide Title', 'couponseek'),
			'name' => 'hide_title',
			'type' => 'true_false',
			'instructions' => __('Hide the Page Title', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'message' => __('Hide Title', 'couponseek'),
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5ae04830c0574',
			'label' => __('Transparent Navigation', 'couponseek'),
			'name' => 'transparent_navigation',
			'type' => 'true_false',
			'instructions' => __('Transparent menu when scrolled to the top.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'message' => __('Enable', 'couponseek'),
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'default',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
	'modified' => 1538991420,
));

acf_add_local_field_group(array(
	'key' => 'group_5a328310d0f7e',
	'title' => __('Product', 'couponseek'),
	'fields' => array(
		array(
			'key' => 'field_5a3283180d2f3',
			'label' => __('Ribbon', 'couponseek'),
			'name' => 'ribbon',
			'type' => 'radio',
			'instructions' => __('Choose what to be written on the ribbon of the product.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'none' => __('None', 'couponseek'),
				'discount' => __('Show Discount', 'couponseek'),
				'text' => __('Show Text', 'couponseek'),
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'discount',
			'layout' => 'vertical',
			'return_format' => 'value',
		),
		array(
			'key' => 'field_5a3283510d2f4',
			'label' => __('Ribbon Text', 'couponseek'),
			'name' => 'ribbon_text',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5a3283180d2f3',
						'operator' => '==',
						'value' => 'text',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5a607c5f0bd4e',
			'label' => __('Expiring Date', 'couponseek'),
			'name' => 'expiring_date',
			'type' => 'date_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'd/m/Y',
			'return_format' => 'Ymd',
			'first_day' => 1,
		),
		array(
			'key' => 'field_5a6207e8a41d3',
			'label' => __('Show Location', 'couponseek'),
			'name' => 'show_location',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'show' => __('Show', 'couponseek'),
				'hide' => __('Hide', 'couponseek'),
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'show',
			'layout' => 'vertical',
			'return_format' => 'value',
		),
		array(
			'key' => 'field_5a620803a41d4',
			'label' => __('Map Zoom', 'couponseek'),
			'name' => 'map_zoom',
			'type' => 'number',
			'instructions' => __('Enter map zoom level from 1 to 20.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5a6207e8a41d3',
						'operator' => '==',
						'value' => 'show',
					),
				),
			),
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => 16,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 1,
			'max' => 20,
			'step' => '',
		),
		array(
			'key' => 'field_5a61d315e9620',
			'label' => __('Location', 'couponseek'),
			'name' => 'location',
			'type' => 'google_map',
			'instructions' => __('Receiving map error? Google have changed their Google Maps policies and now an API Key has to be present for Google Maps to work. Please go to Appearance > Theme Settings > General and fill the "Google API Key" field.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5a6207e8a41d3',
						'operator' => '==',
						'value' => 'show',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '40.773175',
			'center_lng' => '-73.964440',
			'zoom' => '',
			'height' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'product',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5b5866c879e13',
	'title' => __('Theme Layout Settings', 'couponseek'),
	'fields' => array(
		array(
			'key' => 'field_5b5866ce9f11a',
			'label' => __('Main Color', 'couponseek'),
			'name' => 'color_main',
			'type' => 'color_picker',
			'instructions' => __('Default: #FF52E5', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'default_value' => '#FF52E5',
		),
		array(
			'key' => 'field_5b58918b47b05',
			'label' => __('Secondary Color', 'couponseek'),
			'name' => 'color_secondary',
			'type' => 'color_picker',
			'instructions' => __('Default: #FFC25D', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'default_value' => '#FFC25D',
		),
		array(
			'key' => 'field_5b58918a47b04',
			'label' => __('Accent Color', 'couponseek'),
			'name' => 'color_accent',
			'type' => 'color_picker',
			'instructions' => __('Default: #62DCED', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'default_value' => '#62DCED',
		),
		array(
			'key' => 'field_5b59b80ede7c7',
			'label' => __('Element Titles Font', 'couponseek'),
			'name' => 'heading_font',
			'type' => 'google_font_selector',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'include_web_safe_fonts' => 1,
			'enqueue_font' => 1,
			'default_font' => 'Montserrat',
		),
		array(
			'key' => 'field_5b59d44a72456',
			'label' => __('Body Font', 'couponseek'),
			'name' => 'body_font',
			'type' => 'google_font_selector',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'include_web_safe_fonts' => 1,
			'enqueue_font' => 1,
			'default_font' => 'Muli',
		),
		array(
			'key' => 'field_5b59d46872457',
			'label' => __('Navigation Menu Font', 'couponseek'),
			'name' => 'navigation_font',
			'type' => 'google_font_selector',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'include_web_safe_fonts' => 1,
			'enqueue_font' => 1,
			'default_font' => 'Oswald',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-general-settings',
			),
		),
	),
	'menu_order' => 1,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5b5984fe251e1',
	'title' => __('Theme WooCommerce Settings', 'couponseek'),
	'fields' => array(
		array(
			'key' => 'field_5b59851f96fb8',
			'label' => __('Hide Navigation Menu Profile Item', 'couponseek'),
			'name' => 'hide_nav_menu_profile',
			'type' => 'true_false',
			'instructions' => __('Hides the Profile/Login/Register item from the navigation menu.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'message' => __('Hide', 'couponseek'),
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5b59856e96fb9',
			'label' => __('Hide Navigation Menu Cart', 'couponseek'),
			'name' => 'hide_nav_cart',
			'type' => 'true_false',
			'instructions' => __('Hides the Cart item from the navigation menu.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'message' => __('Hide', 'couponseek'),
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5b59863596fba',
			'label' => __('Number of Products to Display', 'couponseek'),
			'name' => 'number_products',
			'type' => 'range',
			'instructions' => __('Select 0 for unlimited.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 0,
			'min' => 0,
			'max' => 100,
			'step' => 1,
			'prepend' => '',
			'append' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-general-settings',
			),
		),
	),
	'menu_order' => 2,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
	'modified' => 1536572177,
));

acf_add_local_field_group(array(
	'key' => 'group_5b59870bae982',
	'title' => __('Theme Deals Settings', 'couponseek'),
	'fields' => array(
		array(
			'key' => 'field_5b59875b75026',
			'label' => __('Show External Products Only As Pop Up', 'couponseek'),
			'name' => 'show_deal_popups',
			'type' => 'true_false',
			'instructions' => __('External products show only popup and redirect when clicked. Do not show single deal pages.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => __('Yes', 'couponseek'),
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5b59877d75027',
			'label' => __('Make Expired Products Draft', 'couponseek'),
			'name' => 'draft_expired_products_switch',
			'type' => 'true_false',
			'instructions' => __('Every 24 hours a check will be made and all products with expired (not empty) date will be made draft.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => __('Yes', 'couponseek'),
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5b59879e75028',
			'label' => __('Deal Location Marker', 'couponseek'),
			'name' => 'deal_location_marker',
			'type' => 'image',
			'instructions' => __('The image that will be used as a marker for products location.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5b59880875029',
			'label' => __('Center Deal Location Field - Latitude', 'couponseek'),
			'name' => 'default_location_lat',
			'type' => 'text',
			'instructions' => __('For example. Melbourne is Lat: -37.77, Lng: 144.96.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b59882b7502a',
			'label' => __('Center Deal Location Field - Longitude', 'couponseek'),
			'name' => 'default_location_lng',
			'type' => 'text',
			'instructions' => __('For example. Melbourne is Lat: -37.77, Lng: 144.96.', 'couponseek'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.333',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-general-settings',
			),
		),
	),
	'menu_order' => 3,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
	'modified' => 1532594321,
));

endif;