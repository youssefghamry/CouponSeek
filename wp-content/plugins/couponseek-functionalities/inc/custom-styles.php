<?php 
function _action_couponseek_custom_styles(){
	$color_main = esc_attr(couponseek_get_field('color_main', 'option'));
	$color_secondary = esc_attr(couponseek_get_field('color_secondary', 'option'));
	$color_accent = esc_attr(couponseek_get_field('color_accent', 'option'));
	?>

	<?php
	$body_font = couponseek_get_field('body_font', 'option');
	$heading_font = couponseek_get_field('heading_font', 'option');
	$navigation_font = couponseek_get_field('navigation_font', 'option');

	ob_start();
	?>
	
	/* Main Color */

	a, a:focus {
		color: <?php echo esc_attr($color_main); ?>;
	}

	a.link-border {
		border-bottom: 2px solid <?php echo esc_attr($color_main); ?>;
	}

	::-moz-selection {
		background: <?php echo esc_attr($color_main); ?>;
	}

	::selection {
		background: <?php echo esc_attr($color_main); ?>;
	}

	.select2-container.select2-container--default .selection .select2-results__option--highlighted[aria-selected],
	.select2-container.select2-container--default .selection .select2-results__option--highlighted[data-selected] {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[data-selected] {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.MAIN-NAVIGATION .main-navigation-menu > ul > li > a:hover {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.MAIN-NAVIGATION .main-navigation-menu .current-menu-item > a {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.MAIN-NAVIGATION .main-navigation-menu .cart-contents .cart-contents-text {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.MAIN-NAVIGATION .sub-menu {
		border-top: 2px solid <?php echo esc_attr($color_main); ?>;
	}

	.MAIN-NAVIGATION .sub-menu a:hover, .MAIN-NAVIGATION .sub-menu a:active {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.MAIN-NAVIGATION .sub-menu .current-menu-item > a {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.MAIN-NAVIGATION.main-nav-transparent .main-navigation-menu > ul > li > a:hover {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.MAIN-NAVIGATION.main-nav-transparent .main-navigation-logo h1:hover {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.menu-item-has-children > a > i {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.MAIN-NAVIGATION.main-nav-transparent .ubermenu.ubermenu-skin-couponseek-ubermenuskin .ubermenu-item-has-children > a > i {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.MAIN-NAVIGATION.main-nav-transparent .ubermenu.ubermenu-skin-couponseek-ubermenuskin > ul > li > a.ubermenu-target:hover {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.ubermenu.ubermenu-skin-couponseek-ubermenuskin .ubermenu-current-menu-item > a.ubermenu-target {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.ubermenu.ubermenu-skin-couponseek-ubermenuskin a.ubermenu-target:hover,
	    .ubermenu.ubermenu-skin-couponseek-ubermenuskin .ubermenu-submenu .ubermenu-item-header > .ubermenu-target:hover {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.ubermenu.ubermenu-skin-couponseek-ubermenuskin a.ubermenu-target .ubermenu-current_page_item,
	    .ubermenu.ubermenu-skin-couponseek-ubermenuskin .ubermenu-submenu .ubermenu-item-header > .ubermenu-target .ubermenu-current_page_item {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.has-ubermenu .ubermenu.ubermenu-skin-couponseek-ubermenuskin .ubermenu-submenu .ubermenu-highlight {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.has-ubermenu .ubermenu.ubermenu-skin-couponseek-ubermenuskin .ubermenu-item.ubermenu-item-level-0 > .ubermenu-highlight {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.slicknav_nav a i[class^="icon-"] {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.slicknav_nav a:hover {
		background: <?php echo esc_attr($color_main); ?>;
	}

	.ProductsHeader .SpecialHeading span {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.Excerpt .ExcerptContentWrapper .excerpt-meta-categories a:hover {
		border-color: <?php echo esc_attr($color_main); ?>;
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.page-links a {
		border-bottom: 1px solid <?php echo esc_attr($color_main); ?>;
	}

	.commentslist-container .comment-reply-title small {
		border-bottom: 1px solid <?php echo esc_attr($color_main); ?>;
	}

	.elementor-element.elementor-button-color .elementor-button {
		background: <?php echo esc_attr($color_main); ?>;
	}

	.btn:hover, .elementor-element .elementor-button:hover, .woocommerce #respond input#submit:hover,
	.woocommerce a.button:hover, .woocommerce button.button:hover,
	.woocommerce input.button:hover, .btn:active, .elementor-element .elementor-button:active, .woocommerce #respond input#submit:active,
	.woocommerce a.button:active, .woocommerce button.button:active,
	.woocommerce input.button:active, .btn:active:focus, .elementor-element .elementor-button:active:focus, .woocommerce #respond input#submit:active:focus,
	.woocommerce a.button:active:focus, .woocommerce button.button:active:focus,
	.woocommerce input.button:active:focus, button[type='submit']:hover, button[type='submit']:active, button[type='submit']:active:focus, input[type='submit']:hover, input[type='submit']:active, input[type='submit']:active:focus {
		background: <?php echo esc_attr($color_main); ?>;
		border: 1px solid <?php echo esc_attr($color_main); ?>;
	}

	.btn.btn-color, .elementor-element .btn-color.elementor-button, .elementor-element .section-light .widget .MailchimpNewsletter .elementor-button#signup-button, .section-light .widget .MailchimpNewsletter .elementor-element .elementor-button#signup-button, .elementor-element .woocommerce form .form-row input.elementor-button[type="submit"], .woocommerce form .form-row .elementor-element input.elementor-button[type="submit"], .elementor-element .woocommerce .woocommerce-account-membership-plan form.cart button.elementor-button, .woocommerce .woocommerce-account-membership-plan form.cart .elementor-element button.elementor-button, .section-light .widget .MailchimpNewsletter .btn#signup-button, .section-light .widget .MailchimpNewsletter
	.woocommerce a#signup-button.button,
	.woocommerce .section-light .widget .MailchimpNewsletter a#signup-button.button, .section-light .widget .MailchimpNewsletter .woocommerce button#signup-button.button, .woocommerce .section-light .widget .MailchimpNewsletter button#signup-button.button, .section-light .widget .MailchimpNewsletter
	.woocommerce input#signup-button.button,
	.woocommerce .section-light .widget .MailchimpNewsletter input#signup-button.button, .woocommerce #respond input.btn-color#submit, .woocommerce #respond form .form-row input#submit[type="submit"], .woocommerce form .form-row #respond input#submit[type="submit"],
	.woocommerce a.btn-color.button, .woocommerce button.btn-color.button, .woocommerce .woocommerce-account-membership-plan form.cart button.button,
	.woocommerce input.btn-color.button, .woocommerce form .form-row input.button[type="submit"], .woocommerce form .form-row input.btn[type="submit"], .woocommerce .woocommerce-account-membership-plan form.cart button.btn, button[type='submit'].btn.btn-color, .elementor-element button[type='submit'].btn-color.elementor-button, .elementor-element .section-light .widget .MailchimpNewsletter button[type='submit'].elementor-button#signup-button, .section-light .widget .MailchimpNewsletter .elementor-element button[type='submit'].elementor-button#signup-button, .elementor-element .woocommerce .woocommerce-account-membership-plan form.cart button[type='submit'].elementor-button, .woocommerce .woocommerce-account-membership-plan form.cart .elementor-element button[type='submit'].elementor-button, .section-light .widget .MailchimpNewsletter button[type='submit'].btn#signup-button, .section-light .widget .MailchimpNewsletter .woocommerce button[type='submit']#signup-button.button, .woocommerce .section-light .widget .MailchimpNewsletter button[type='submit']#signup-button.button, .woocommerce button[type='submit'].btn-color.button, .woocommerce .woocommerce-account-membership-plan form.cart button[type='submit'].button, .woocommerce .woocommerce-account-membership-plan form.cart button[type='submit'].btn, input[type='submit'].btn.btn-color, .elementor-element input[type='submit'].btn-color.elementor-button, .elementor-element .section-light .widget .MailchimpNewsletter input[type='submit'].elementor-button#signup-button, .section-light .widget .MailchimpNewsletter .elementor-element input[type='submit'].elementor-button#signup-button, .elementor-element .woocommerce form .form-row input[type='submit'].elementor-button[type="submit"], .woocommerce form .form-row .elementor-element input[type='submit'].elementor-button[type="submit"], .section-light .widget .MailchimpNewsletter input[type='submit'].btn#signup-button, .section-light .widget .MailchimpNewsletter
	.woocommerce input[type='submit']#signup-button.button,
	.woocommerce .section-light .widget .MailchimpNewsletter input[type='submit']#signup-button.button, .woocommerce #respond input[type='submit'].btn-color#submit, .woocommerce #respond form .form-row input[type='submit']#submit[type="submit"], .woocommerce form .form-row #respond input[type='submit']#submit[type="submit"],
	.woocommerce input[type='submit'].btn-color.button, .woocommerce form .form-row input[type='submit'].button[type="submit"], .woocommerce form .form-row input[type='submit'].btn[type="submit"] {
		background: <?php echo esc_attr($color_main); ?>;
	}

	.btn.btn-border, .elementor-element .btn-border.elementor-button, .woocommerce #respond input.btn-border#submit,
	.woocommerce a.btn-border.button, .woocommerce button.btn-border.button,
	.woocommerce input.btn-border.button {
		border: 1px solid <?php echo esc_attr($color_main); ?>;
	}

	.btn.btn-border:hover, .elementor-element .btn-border.elementor-button:hover, .woocommerce #respond input.btn-border#submit:hover,
	  .woocommerce a.btn-border.button:hover, .woocommerce button.btn-border.button:hover,
	  .woocommerce input.btn-border.button:hover, .btn.btn-border:active, .elementor-element .btn-border.elementor-button:active, .woocommerce #respond input.btn-border#submit:active,
	  .woocommerce a.btn-border.button:active, .woocommerce button.btn-border.button:active,
	  .woocommerce input.btn-border.button:active, .btn.btn-border:active:focus, .elementor-element .btn-border.elementor-button:active:focus, .woocommerce #respond input.btn-border#submit:active:focus,
	  .woocommerce a.btn-border.button:active:focus, .woocommerce button.btn-border.button:active:focus,
	  .woocommerce input.btn-border.button:active:focus {
		background: <?php echo esc_attr($color_main); ?>;
		border: 1px solid <?php echo esc_attr($color_main); ?>;
	}

	.btn.btn-white, .elementor-element .btn-white.elementor-button, .woocommerce #respond input.btn-white#submit,
	.woocommerce a.btn-white.button, .woocommerce button.btn-white.button,
	.woocommerce input.btn-white.button, button[type='submit'].btn.btn-white, .elementor-element button[type='submit'].btn-white.elementor-button, .woocommerce button[type='submit'].btn-white.button, input[type='submit'].btn.btn-white, .elementor-element input[type='submit'].btn-white.elementor-button, .woocommerce #respond input[type='submit'].btn-white#submit,
	.woocommerce input[type='submit'].btn-white.button {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.btn.btn-light:hover, .elementor-element .btn-light.elementor-button:hover, .woocommerce #respond input.btn-light#submit:hover,
	  .woocommerce a.btn-light.button:hover, .woocommerce button.btn-light.button:hover,
	  .woocommerce input.btn-light.button:hover, .btn.btn-light:active, .elementor-element .btn-light.elementor-button:active, .woocommerce #respond input.btn-light#submit:active,
	  .woocommerce a.btn-light.button:active, .woocommerce button.btn-light.button:active,
	  .woocommerce input.btn-light.button:active, .btn.btn-light:active:focus, .elementor-element .btn-light.elementor-button:active:focus, .woocommerce #respond input.btn-light#submit:active:focus,
	  .woocommerce a.btn-light.button:active:focus, .woocommerce button.btn-light.button:active:focus,
	  .woocommerce input.btn-light.button:active:focus {
		background: <?php echo esc_attr($color_main); ?>;
		border: 1px solid <?php echo esc_attr($color_main); ?>;
	}

	.Blog .blog-read-more {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.ProductCategories .number-counter {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.SSDItemsGrid .ssd-item .category-title {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.Poster .poster-button {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.highlight {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.section-light .btn-normal:hover, .section-light .btn-normal:active, .section-light .btn-normal:active:focus {
		border: 1px solid <?php echo esc_attr($color_main); ?>;
	}

	.overlay-color {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.close-icon-color {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.close-icon-color:before, .close-icon-color:after {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.widget .widget-title:before {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.widget .menu .menu-item .nav-icon, .widget .menu .menu-item-has-children .nav-icon {
		color: <?php echo esc_attr($color_main); ?>;
	}

	#wp-calendar caption {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	#wp-calendar #today {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.widget_tag_cloud .tagcloud a, .widget_product_tag_cloud .tagcloud a {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.widget.widget_twitter li a.tweet-time {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.widget .featured-product-widget-wrapper .featured-product-category {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.widget .product-meta-list-widget .number-counter {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.wc-vendors-navigation a {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.woocommerce #respond input#submit.alt:hover,
	.woocommerce a.button.alt:hover,
	.woocommerce button.button.alt:hover,
	.woocommerce input.button.alt:hover {
		background: <?php echo esc_attr($color_main); ?>;
	}

	.woocommerce table.cart a.remove {
		color: <?php echo esc_attr($color_main); ?> !important;
	}

	.woocommerce table.cart a.remove:hover {
		background-color: <?php echo esc_attr($color_main); ?> !important;
	}

	.woocommerce-account .woocommerce .woocommerce-MyAccount-navigation-link a {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.woocommerce .woocommerce-notice:before, .woocommerce .woocommerce-info:before, .woocommerce .woocommerce-message:before {
		color: <?php echo esc_attr($color_main); ?>;
	}

	.woocommerce .woocommerce-account-membership-plan {
		border-left: 4px solid <?php echo esc_attr($color_main); ?>;
	}

	.woocommerce .product-company-summary .product-company-website {
		border-bottom: 1px solid <?php echo esc_attr($color_main); ?>;
	}

	.woocommerce .single-product-expiration {
		background-color: <?php echo esc_attr($color_main); ?>;
	}

	.woocommerce .product-quantity-meta .product-quantity-meta-item svg {
		fill: <?php echo esc_attr($color_main); ?>;
	}

	.woocommerce ul.products li.product .woocommerce-product-meta, .woocommerce-page ul.products li.product .woocommerce-product-meta {
		-webkit-box-shadow: 0px 8px 30px -24px <?php echo esc_attr($color_main); ?>;
		box-shadow: 0px 8px 30px -24px <?php echo esc_attr($color_main); ?>;
	}

	.woocommerce ul.products li.product .wcvendors_sold_by_in_loop, .woocommerce-page ul.products li.product .wcvendors_sold_by_in_loop {
		color: <?php echo esc_attr($color_main); ?>;
	}

	/* Color Secondary */

	a:hover, a:active {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	a:hover .special-subtitle-type-2:before, a:active .special-subtitle-type-2:before {
		background-color: <?php echo esc_attr($color_secondary); ?>;
	}

	hr {
		border-color: <?php echo esc_attr($color_secondary); ?>;
	}

	del {
		-webkit-text-decoration-color: <?php echo esc_attr($color_secondary); ?>;
		text-decoration-color: <?php echo esc_attr($color_secondary); ?>;
	}

	blockquote {
		border-left: 5px solid <?php echo esc_attr($color_secondary); ?>;
	}

	.wp-block-pullquote {
		border-top: 4px solid <?php echo esc_attr($color_secondary); ?>;
		border-bottom: 4px solid <?php echo esc_attr($color_secondary); ?>;
	}

	table td a:hover, .woocommerce table.shop_attributes td a:hover, .woocommerce .cart-collaterals .cart_totals table td a:hover,
	      .woocommerce table.shop_table td a:hover,
	      table tr td a:hover, .woocommerce table.shop_attributes tr td a:hover, .woocommerce .cart-collaterals .cart_totals table tr td a:hover,
	      .woocommerce table.shop_table tr td a:hover,
	      table td.label a:hover, .woocommerce .cart-collaterals .cart_totals table td.label a:hover,
	      table > tbody > tr > td a:hover, .woocommerce table.shop_attributes > tbody > tr > td a:hover, .woocommerce .cart-collaterals .cart_totals table > tbody > tr > td a:hover,
	      .woocommerce table.shop_table > tbody > tr > td a:hover,
	      table > tfoot > tr > td a:hover, .woocommerce table.shop_attributes > tfoot > tr > td a:hover, .woocommerce .cart-collaterals .cart_totals table > tfoot > tr > td a:hover,
	      .woocommerce table.shop_table > tfoot > tr > td a:hover,
	      table > thead > tr > td a:hover, .woocommerce table.shop_attributes > thead > tr > td a:hover, .woocommerce .cart-collaterals .cart_totals table > thead > tr > td a:hover,
	      .woocommerce table.shop_table > thead > tr > td a:hover,
	      .table td a:hover,
	      .table tr td a:hover,
	      .table td.label a:hover,
	      .table > tbody > tr > td a:hover,
	      .table > tfoot > tr > td a:hover,
	      .table > thead > tr > td a:hover,
	      table.table td a:hover, .woocommerce .cart-collaterals .cart_totals table.table td a:hover,
	      table.table tr td a:hover, .woocommerce .cart-collaterals .cart_totals table.table tr td a:hover,
	      table.table td.label a:hover,
	      table.table > tbody > tr > td a:hover, .woocommerce table.table.shop_attributes > tbody > tr > td a:hover, .woocommerce .cart-collaterals .cart_totals table.table > tbody > tr > td a:hover,
	      .woocommerce table.table.shop_table > tbody > tr > td a:hover,
	      table.table > tfoot > tr > td a:hover, .woocommerce table.table.shop_attributes > tfoot > tr > td a:hover, .woocommerce .cart-collaterals .cart_totals table.table > tfoot > tr > td a:hover,
	      .woocommerce table.table.shop_table > tfoot > tr > td a:hover,
	      table.table > thead > tr > td a:hover, .woocommerce table.table.shop_attributes > thead > tr > td a:hover, .woocommerce .cart-collaterals .cart_totals table.table > thead > tr > td a:hover,
	      .woocommerce table.table.shop_table > thead > tr > td a:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	mark {
		border-bottom: 1px dashed <?php echo esc_attr($color_secondary); ?>;
	}

	.select2-container--default .selection .select2-selection .select2-selection__rendered li.select2-selection__choice {
		background-color: <?php echo esc_attr($color_secondary); ?>;
	}

	.Excerpt.sticky .ExcerptContentWrapper {
		border-bottom: 5px solid <?php echo esc_attr($color_secondary); ?>;
	}

	.PostNav .post-nav-next a:hover, .PostNav .post-nav-prev a:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.SinglePostHeader .single-post-meta-categories a:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.AdjacentPosts .adjacent-post-wrapper:hover .adjacent-post-title {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.SinglePostFooter .single-post-footer-tags a:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.ProductSearch .dropdown-menu > li > a:focus, .ProductSearch .dropdown-menu > li > a:hover {
		background-color: <?php echo esc_attr($color_secondary); ?>;
	}

	.CategoryCard:before {
		background-image: linear-gradient(135deg, <?php echo esc_attr($color_secondary); ?> 25%, transparent 25%, transparent 50%, <?php echo esc_attr($color_secondary); ?> 50%, <?php echo esc_attr($color_secondary); ?> 75%, transparent 75%, transparent 100%);
	}

	.btn.btn-white:hover, .elementor-element .btn-white.elementor-button:hover, .woocommerce #respond input.btn-white#submit:hover,
	  .woocommerce a.btn-white.button:hover, .woocommerce button.btn-white.button:hover,
	  .woocommerce input.btn-white.button:hover, .btn.btn-white:active, .elementor-element .btn-white.elementor-button:active, .woocommerce #respond input.btn-white#submit:active,
	  .woocommerce a.btn-white.button:active, .woocommerce button.btn-white.button:active,
	  .woocommerce input.btn-white.button:active, .btn.btn-white:active:focus, .elementor-element .btn-white.elementor-button:active:focus, .woocommerce #respond input.btn-white#submit:active:focus,
	  .woocommerce a.btn-white.button:active:focus, .woocommerce button.btn-white.button:active:focus,
	  .woocommerce input.btn-white.button:active:focus, button[type='submit'].btn.btn-white:hover, .elementor-element button[type='submit'].btn-white.elementor-button:hover, .woocommerce button[type='submit'].btn-white.button:hover, button[type='submit'].btn.btn-white:active, .elementor-element button[type='submit'].btn-white.elementor-button:active, .woocommerce button[type='submit'].btn-white.button:active, button[type='submit'].btn.btn-white:active:focus, .elementor-element button[type='submit'].btn-white.elementor-button:active:focus, .woocommerce button[type='submit'].btn-white.button:active:focus, input[type='submit'].btn.btn-white:hover, .elementor-element input[type='submit'].btn-white.elementor-button:hover, .woocommerce #respond input[type='submit'].btn-white#submit:hover,
	  .woocommerce input[type='submit'].btn-white.button:hover, input[type='submit'].btn.btn-white:active, .elementor-element input[type='submit'].btn-white.elementor-button:active, .woocommerce #respond input[type='submit'].btn-white#submit:active,
	  .woocommerce input[type='submit'].btn-white.button:active, input[type='submit'].btn.btn-white:active:focus, .elementor-element input[type='submit'].btn-white.elementor-button:active:focus, .woocommerce #respond input[type='submit'].btn-white#submit:active:focus,
	  .woocommerce input[type='submit'].btn-white.button:active:focus {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.Blog .blog-post-title:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.ProductSliderWrapper .onsale {
		background-color: <?php echo esc_attr($color_secondary); ?>;
	}

	.ProductSliderWrapper .onsale:before {
		-webkit-box-shadow: 0px 8px 15px 2px <?php echo esc_attr($color_secondary); ?>;
		box-shadow: 0px 8px 15px 2px <?php echo esc_attr($color_secondary); ?>;
	}

	.ProductSliderWrapper .product-slider-expiration .is-jscountdown {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.ProductCategories .product-category a:hover .product-category-title {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.overlay-color-2 {
		background-color: <?php echo esc_attr($color_secondary); ?>;
	}

	.close-icon-color:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.close-icon-color:hover:before, .close-icon-color:hover:after {
		background-color: <?php echo esc_attr($color_secondary); ?>;
	}

	.owl-carousel .owl-dot.active span, .owl-carousel .owl-dot:hover span {
		background-color: <?php echo esc_attr($color_secondary); ?>;
	}

	.modal-body {
		border-bottom: 4px dashed <?php echo esc_attr($color_secondary); ?>;
	}

	.widget a:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.section-light .widget.widget_popular_posts .popular-posts-title:hover, .section-light .widget.woocommerce .product-title:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.widget_tag_cloud .tagcloud a:hover, .widget_product_tag_cloud .tagcloud a:hover {
		background-color: <?php echo esc_attr($color_secondary); ?>;
	}

	.widget_popular_posts a:hover .popular-posts-title {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.widget.widget_twitter li a:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.widget .featured-product-widget-wrapper .featured-product-title:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.widget .featured-product-widget-wrapper .featured-product-expiration .is-jscountdown {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.product-meta-widget-wrapper.section-light a:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.widget .product-meta-list-widget .product-meta a:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.wp-block-separator {
		border-bottom: 2px solid <?php echo esc_attr($color_secondary); ?>;
	}

	.wc-vendors-navigation a:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.woocommerce .woocommerce-product-rating .star-rating {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.woocommerce span.onsale:before, .woocommerce span.out-of-stock:before {
		-webkit-box-shadow: 0px 6px 15px 2px <?php echo esc_attr($color_secondary); ?>;
		box-shadow: 0px 6px 15px 2px <?php echo esc_attr($color_secondary); ?>;
	}

	.woocommerce span.onsale {
		background-color: <?php echo esc_attr($color_secondary); ?>;
	}

	.woocommerce-account .woocommerce .woocommerce-MyAccount-navigation-link a:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.woocommerce-account .woocommerce .woocommerce-MyAccount-navigation-link.is-active a {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.woocommerce .single-product-price .woocommerce-Price-currencySymbol, .woocommerce .woocommerce-variation-price .woocommerce-Price-currencySymbol, .woocommerce .woocommerce-grouped-product-list-item__price .woocommerce-Price-currencySymbol {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.woocommerce .wcvendors_cart_sold_by_meta:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.woocommerce .product-quantity-meta .product-quantity-meta-item .quantity-meta-value {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.woocommerce .single-product-company-title a:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.woocommerce div.product form.cart .group_table .woocommerce-grouped-product-list-item__label:hover, .woocommerce div.product form.cart .group_table .woocommerce-loop-product__link h2:hover {
		color: <?php echo esc_attr($color_secondary); ?>;
	}

	.woocommerce ul.products li.product .onsale:before, .woocommerce ul.products li.product .out-of-stock:before, .woocommerce-page ul.products li.product .onsale:before, .woocommerce-page ul.products li.product .out-of-stock:before {
		-webkit-box-shadow: 0px 8px 15px 2px <?php echo esc_attr($color_secondary); ?>;
		box-shadow: 0px 8px 15px 2px <?php echo esc_attr($color_secondary); ?>;
	}

	/* Color Accent */

	.CategoryCard .category-card-count {
		background-color: <?php echo esc_attr($color_accent); ?>;
	}

	/* Typography */
	body {
		<?php echo couponseek_typography_css($body_font) ?>;
	}

	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.fw-table .heading-row,
	.fw-package .fw-heading-row,
	.font-heading,
	.btn, .elementor-button, .button, button[type='submit'], button[type='submit'], input[type='submit'], input[type='submit'],
	label {
		<?php echo couponseek_typography_css($heading_font) ?>;
	}

	.main-navigation-menu, .ubermenu {
		<?php echo couponseek_typography_css($navigation_font) ?>;
	}


	/* Footer */

	.FOOTER .overlay-color {
		opacity: <?php echo esc_attr(couponseek_get_field('footer_color_opacity', 'option') ? (couponseek_get_field('footer_color_opacity', 'option') / 100) : '0'); ?>;
		background-color: <?php echo esc_attr(couponseek_get_field('footer_color', 'option') ? couponseek_get_field('footer_color', 'option') : 'transparent'); ?>;
	}

	<?php

	$output_css = ob_get_clean();
	
	wp_add_inline_style( 'couponseek_functionalities_custom-css', $output_css );

}

add_action( 'wp_enqueue_scripts', '_action_couponseek_custom_styles', 100 );
?>
