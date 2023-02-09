( function( $ ) {

	"use strict";

	/**
	* ----------------------------------------------------------------------------------------
	*    Elementor Functions
	* ----------------------------------------------------------------------------------------
	*/

	var isAdminBar		= false,
		isEditMode		= false;

	var getGlobalSettings = function( section ) {
		
		if ( section in elementorFrontendConfig.settings ) {
			return elementorFrontendConfig.settings[section];
		}

		return false;
	}

	var getElementSettings = function( $element ) {
		var elementSettings = {},
			modelCID 		= $element.data( 'model-cid' );

		if ( isEditMode && modelCID ) {
			var settings = elementorFrontend.config.elements.data[modelCID],
			    type = settings.attributes.widgetType || settings.attributes.elType;

			var settingsKeys = elementorFrontend.config.elements.keys[type];

			if (!settingsKeys) {
				settingsKeys = elementorFrontend.config.elements.keys[type] = [];

				jQuery.each(settings.controls, function (name, control) {
					if (control.frontend_available) {
						settingsKeys.push(name);
					}
				});
			}

			jQuery.each(settings.getActiveControls(), function (controlKey) {
				if (-1 !== settingsKeys.indexOf(controlKey)) {
					elementSettings[controlKey] = settings.attributes[controlKey];
				}
			});
		} else {
			elementSettings = $element.data('settings') || {};
		}

		return elementSettings;
	};

	/**
	* ----------------------------------------------------------------------------------------
	*   Set Background Image
	* ----------------------------------------------------------------------------------------
	*/

	var BGImageElement = function( $scope ) {

		var $bgImage = $scope.find('.bg-image');

		$bgImage.each(function(){
			var $this = $(this);
			var imageUrl = $this.data('bg-image');

			if ( $this.css('background-image') != 'url("' + imageUrl + '")' ) {
				$this.css('background-image', 'url("' + imageUrl + '")' );
			}

		})
	}


	/**
	* ----------------------------------------------------------------------------------------
	*   Set Background Color
	* ----------------------------------------------------------------------------------------
	*/

	var BGColorElement = function( $scope ) {

		var $bgColor = $scope.find('.bg-color');

		$bgColor.each(function(){
			var $this = $(this);

			var color = $this.data('bg-color');
			if ( $this.css('background-color') != color ) {
				$this.css('background-color', color);
			}

			var opacity = $this.data('opacity');
			if ( typeof $this.data('opacity') != 'undefined' && $this.css('opacity') != opacity ) {
				$this.css('opacity', opacity);
			}
		})

	}
	

	/**
	* ----------------------------------------------------------------------------------------
	*   Set SVG Icon Bg Color
	* ----------------------------------------------------------------------------------------
	*/

	var SVGIcon = function( $scope ){

		var $svgIcon = $scope.find('.icon-svg');

		$svgIcon.each(function(){
			var $this = $(this);

			var svgColor = $this.data('bg-color');
			if ( svgColor != undefined && $this.parent().css('background-color') != svgColor ) {
				$this.parent().css('background-color', svgColor );
			}
		})
	}

	/**
	* ----------------------------------------------------------------------------------------
	*    Countdown Init
	* ----------------------------------------------------------------------------------------
	*/

	var countdownElement = function( $scope ) {

		var $countdown = $scope.find('.is-jscountdown');

		var expiredText = couponseek.expired;
		var dayText = couponseek.day;
		var daysPluralText = couponseek.days;
		var hourText = couponseek.hour;
		var hoursPluralText = couponseek.hours;
		var minuteText = couponseek.minute;
		var minutesPluralText = couponseek.minutes;

		$countdown.each(function(){
			var $this = $(this);
			var finalDate = $this.data('time');

			$this.countdown(finalDate)
			.on('update.countdown', function(event) {

				var format = '%H:%M:%S';

				if ( $this.data('short') ) {

					if( event.offset.totalDays > 0 ) {
						format = '%-D %!D:' + dayText + ' ,' + daysPluralText + ' ;';
					} else if ( event.offset.hours > 0 ) {
						format = '%-H %!H:' + hourText + ' ,' + hoursPluralText + ' ;';
					} else {
						format = '%-M %!M:' + minuteText + ' ,' + minutesPluralText  + ' ;';
					}

					$this.data('started', 'true');
					$this.html(event.strftime(format));

				} else if(event.offset.totalDays > 0) {
					var daysFormat = '%-D';

					$this.data('started', 'true');
					$this.html('<span class="jscountdown-days">' + 
						event.strftime(daysFormat) +
						'</span>' + 
						'<span class="jscountdown-days-text">' + 
						event.strftime('%!D:' + dayText + ' ,' + daysPluralText + ' ;') + 
						'</span>' +
						'<span class="jscountdown-time">' +
						event.strftime(format) + 
						'</span>');
					
				} else {
					$this.data('started', 'true');
					$this.html('<span class="jscountdown-time">' + event.strftime(format) + '</span>');
				}

			})
			.on('finish.countdown', function(event) {
				$this.html(expiredText)
				.parent().addClass('disabled')

			})

		})
	}


	/**
	* ----------------------------------------------------------------------------------------
	*    Product Slider
	* ----------------------------------------------------------------------------------------
	*/

	var ProductSlider = function( $scope ) {

		var $productSlider = $scope.find('.is-product-slider'),
			elementSettings = getElementSettings( $scope ),
			slidesToShow = +elementSettings.slides_to_show || 1,
			isSingleSlide = 1 === slidesToShow,
			breakpointsMd = elementorFrontend.config.breakpoints.md,
			breakpointsLg = elementorFrontend.config.breakpoints.lg;

		var centerPadding = elementSettings.center_padding == null ? 20 : elementSettings.center_padding.size;
		var centerMode = elementSettings.center_slide == 'yes' ? true : false;

		var swiperOptions = {
			centeredSlides: centerMode,
			spaceBetween: centerPadding,
			slidesPerView: slidesToShow,
			threshold: 10,
			autoplay: 'yes' === elementSettings.autoplay ? {
			   delay: elementSettings.autoplay_speed,
			 } : false,
			loop: 'yes' === elementSettings.infinite,
			pauseOnMouseEnter: 'yes' ===  elementSettings.pause_on_hover,
			speed: elementSettings.speed,
			navigation: [ 'arrows', 'both' ].includes( elementSettings.navigation ) ? {
				nextEl: '.swiper-content-next',
				prevEl: '.swiper-content-prev',
				clickable: true,
			} : false,
			pagination: [ 'dots', 'both' ].includes( elementSettings.navigation ) ? {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true,
			} : false,
			reverseDirection: 'rtl' === elementSettings.direction,
		};

		swiperOptions.breakpoints = {
			// when window width is < 767px
			1: {
				slidesPerView: +elementSettings.slides_to_show_mobile || 1,
				spaceBetween: elementSettings.center_padding_mobile == null ? 0 : elementSettings.center_padding_mobile.size,
			}
		};
		// when window width is < 1023px
		swiperOptions.breakpoints[breakpointsMd] = {
			slidesPerView: +elementSettings.slides_to_show_tablet || ( isSingleSlide ? 1 : 2 ),
			spaceBetween: elementSettings.center_padding_tablet == null ? 0 : elementSettings.center_padding_tablet.size,
		};
		// when window width is >= 1024px
		swiperOptions.breakpoints[breakpointsLg] = {
			slidesPerView: slidesToShow,
			spaceBetween: centerPadding,
		};

		if ( isSingleSlide ) {

			swiperOptions.effect = 'fade' === elementSettings.effect;
		}

		new Swiper($productSlider, swiperOptions);

	}


	/**
	* ----------------------------------------------------------------------------------------
	*    Poster
	* ----------------------------------------------------------------------------------------
	*/

	var SSDPoster = function( $scope ) {
		var player                     = null,
			isYTVideo                  = null,
			$backgroundVideoContainer  = $scope.find('.poster-background-video-container'),
			$backgroundVideoEmbed      = $backgroundVideoContainer.children('.poster-background-video-embed'),
			$backgroundVideoHosted     = $backgroundVideoContainer.children('.poster-background-video-hosted'),
			elementSettings            = getElementSettings($scope);

		var calcVideosSize = function() {
			var containerWidth = $backgroundVideoContainer.outerWidth(),
			containerHeight = $backgroundVideoContainer.outerHeight(),
			aspectRatioSetting = '16:9', //TEMP
			aspectRatioArray = aspectRatioSetting.split( ':' ),
			aspectRatio = aspectRatioArray[ 0 ] / aspectRatioArray[ 1 ],
			ratioWidth = containerWidth / aspectRatio,
			ratioHeight = containerHeight * aspectRatio,
			isWidthFixed = containerWidth / containerHeight > aspectRatio;

			return {
				width: isWidthFixed ? containerWidth : ratioHeight,
				height: isWidthFixed ? ratioWidth : containerHeight
			};
		};

		var changeVideoSize = function() {
			var $video = isYTVideo ? jQuery( player.getIframe() ) : $backgroundVideoHosted,
			size = calcVideosSize();

			$video.width( size.width ).height( size.height );
		};

		var startVideoLoop = function() {

			// If the section has been removed
			if ( ! player.getIframe().contentWindow ) {
				return;
			}

			var startPoint = elementSettings.background_video_start || 0,
				endPoint = elementSettings.background_video_end;

			player.seekTo( startPoint );

			if ( endPoint ) {
				var durationToEnd = endPoint - startPoint + 1;

				setTimeout( function() {
					startVideoLoop();
				}, durationToEnd * 1000 );
			}
		};
		
		var prepareYTVideo = function( YT, videoID ) {
			var startStateCode = YT.PlayerState.PLAYING;

			// Since version 67, Chrome doesn't fire the `PLAYING` state at start time
			if ( window.chrome ) {
				startStateCode = YT.PlayerState.UNSTARTED;
			}

			$backgroundVideoContainer.addClass( 'elementor-loading elementor-invisible' );

			player = new YT.Player( $backgroundVideoEmbed[ 0 ], {
				videoId: videoID,
				events: {
					onReady: function() {
						player.mute();

						changeVideoSize();

						startVideoLoop();

						player.playVideo();
					},
					onStateChange: function( event ) {
						switch ( event.data ) {
							case startStateCode:
							$backgroundVideoContainer.removeClass( 'elementor-invisible elementor-loading' );

							break;
							case YT.PlayerState.ENDED:
							player.seekTo( elementSettings.background_video_start || 0 );
						}
					}
				},
				playerVars: {
					controls: 0,
					showinfo: 0,
					rel: 0
				}
			} );

			elementorFrontend.getElements( '$window' ).on( 'resize', changeVideoSize );
		};

		var activate = function() {
			var videoLink = elementSettings.background_video_link,
			videoID = elementorFrontend.utils.youtube.getYoutubeIDFromURL( videoLink );

			isYTVideo = !! videoID;

			if ( videoID ) {
				elementorFrontend.utils.youtube.onYoutubeApiReady( function( YT ) {
					setTimeout( function() {
						prepareYTVideo( YT, videoID );
					}, 1 );
				} );
			} else {
				$backgroundVideoHosted.attr( 'src', videoLink ).one( 'canplay', changeVideoSize );
			}
		};

		var deactivate = function() {
			if ( isYTVideo && player.getIframe() ) {
				player.destroy();
			} else {
				$backgroundVideoHosted.removeAttr( 'src' );
			}
		};

		var run = function() {
			if ( 'video' === elementSettings.background_background && elementSettings.background_video_link ) {
				activate();
			} else {
				deactivate();
			}
		};

		run();
	}

	/**
	* ----------------------------------------------------------------------------------------
	*   Text Rotator
	* ----------------------------------------------------------------------------------------
	*/

	var textRotator = function( $scope ){
		
		var $textRotator = $scope.find('.is-text-rotator');
		var svgColor = $textRotator.data('fill');

		$textRotator.css('width', '');

		$textRotator.css({
			'visibility': 'visible'
  		});

		$textRotator.textrotator({
			animation: $textRotator.data('effect'),
			separator: "||",
			speed: $textRotator.data('speed')
		});
	}

	/**
	* ----------------------------------------------------------------------------------------
	*   Background Parallax
	* ----------------------------------------------------------------------------------------
	*/

	var bgParallax = function( $scope ){

		if ( 'section' !== $scope.data('element_type') )
			return;

		var $element = $scope,
			elementSettings = getElementSettings( $scope );

		if ( $element.data('ssd-jarallax-enabled') == true ) {
			$element.data('ssd-jarallax-enabled', false);
			$element.jarallax('destroy');
		}
		if ( elementSettings.parallax_enable == 'yes' ) {

			var parallaxOptions = {}

			if ( elementSettings.background_image ) {
				parallaxOptions.parallaxBgImage = elementSettings.background_image['url'];
			}
			if ( elementSettings.parallax_position ) {
				parallaxOptions.imgPosition = elementSettings.parallax_position;
			}
			if ( elementSettings.parallax_repeat ) {
				parallaxOptions.imgRepeat = elementSettings.parallax_repeat;
			}
			if ( elementSettings.parallax_size ) {
				parallaxOptions.imgSize = elementSettings.parallax_size;
			}
			if ( elementSettings.parallax_speed ) {
				parallaxOptions.speed = elementSettings.parallax_speed;
			}

			setTimeout( function(){
				$element.data('ssd-jarallax-enabled', true);
				$element.jarallax(parallaxOptions);
			}, 1)

			new ResizeSensor($element, function(){
				$element.jarallax('onResize');
			});
		}
	}

	/**
	* ----------------------------------------------------------------------------------------
	*   Mailchimp Form
	* ----------------------------------------------------------------------------------------
	*/

	var MailchimpForm = function( $scope ){

		var $element = $scope,
			elementSettings = getElementSettings( $scope );

		var $mailchimpForm = $scope.find('.is-mailchimp-shortcode-subscribe');

		$mailchimpForm.on('submit', function(e) {
			e.preventDefault();
			
			var $mailchimpEmail = $mailchimpForm.find('.mailchimp-email');
			var $mailchimpMessage = $mailchimpForm.siblings('.mailchimp-shortcode-message');

			var emailPattern = new RegExp(/[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]+/i);

			if ( !$mailchimpEmail.val() ) {
				$mailchimpMessage.hide().html('<div class="alert alert-danger">' + subsolar_mailchimp.subs_email_empty + '</div>').fadeIn();
			}
			else if ( !emailPattern.test($mailchimpEmail.val()) ) {
				$mailchimpMessage.hide().html('<div class="alert alert-danger">' + subsolar_mailchimp.subs_email_error + '</div>').fadeIn();
			}
			else {
				$mailchimpMessage.html('<div class="alert alert-info">' + subsolar_mailchimp.subs_email_add + '</div>').fadeIn();
				$.ajax({
					url: subsolar_mailchimp.ajaxurl,
					data: {
						action : '_action_couponseek_mailchimp_elementor_subscribe',
						email : $mailchimpEmail.val()
					},
					type: 'POST',
					success: function(response) {
						$mailchimpEmail.val('');
						$mailchimpMessage.hide().html(response).fadeIn();
					}
				});
			}

		})
		
	}


	/**
	* ----------------------------------------------------------------------------------------
	*   Google Maps
	* ----------------------------------------------------------------------------------------
	*/

	var GoogleMaps = function( $scope ) {

		var $googleMap = $scope.find('.is-elementor-google-map'),
			elementSettings = getElementSettings( $scope );

		var render_map = function( $el ) {

			var args = {
				zoom				: elementSettings.zoom.size ? elementSettings.zoom.size : 15,
				center				: new google.maps.LatLng(0, 0),
				disableDefaultUI	: elementSettings.disable_default_ui == 'yes' ? true : false,
				scrollwheel 		: elementSettings.disable_scroll == 'yes' ? false : true,
				mapTypeId			: google.maps.MapTypeId.ROADMAP,
				styles: elementSettings.json_style ? JSON.parse(elementSettings.json_style) : [{"featureType": "all","elementType": "labels.text","stylers": [{"visibility": "off"}]},{"featureType": "administrative","elementType": "labels","stylers": [{"visibility": "on"}]},{"featureType": "landscape","elementType": "all","stylers": [{"visibility": "off"},{"color": "#ff0000"}]},{"featureType": "landscape.man_made","elementType": "geometry.fill","stylers": [{"color": "#e9e9e9"},{"visibility": "simplified"}]},{"featureType": "landscape.natural","elementType": "geometry.fill","stylers": [{"color": "#f5f5f2"},{"visibility": "on"}]},{"featureType": "poi","elementType": "all","stylers": [{"visibility": "on"}]},{"featureType": "poi","elementType": "labels.text","stylers": [{"visibility": "on"}]},{"featureType": "poi","elementType": "labels.icon","stylers": [{"visibility": "off"}]},{"featureType": "poi.attraction","elementType": "all","stylers": [{"visibility": "on"}]},{"featureType": "poi.attraction","elementType": "labels.icon","stylers": [{"visibility": "on"}]},{"featureType": "poi.business","elementType": "all","stylers": [{"visibility": "on"}]},{"featureType": "poi.business","elementType": "labels","stylers": [{"visibility": "on"},{"saturation": "-69"},{"lightness": "0"}]},{"featureType": "poi.government","elementType": "all","stylers": [{"visibility": "on"}]},{"featureType": "poi.government","elementType": "geometry","stylers": [{"visibility": "off"}]},{"featureType": "poi.medical","elementType": "all","stylers": [{"visibility": "on"}]},{"featureType": "poi.medical","elementType": "labels","stylers": [{"visibility": "on"},{"saturation": "-12"}]},{"featureType": "poi.park","elementType": "all","stylers": [{"color": "#a4b65d"},{"gamma": "1.51"},{"saturation": "0"},{"lightness": "15"}]},{"featureType": "poi.park","elementType": "labels.text","stylers": [{"visibility": "on"}]},{"featureType": "poi.park","elementType": "labels.text.fill","stylers": [{"visibility": "on"},{"color": "#528441"}]},{"featureType": "poi.park","elementType": "labels.text.stroke","stylers": [{"visibility": "on"},{"lightness": "20"}]},{"featureType": "poi.park","elementType": "labels.icon","stylers": [{"visibility": "off"}]},{"featureType": "poi.place_of_worship","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "poi.school","elementType": "all","stylers": [{"visibility": "on"}]},{"featureType": "poi.sports_complex","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "poi.sports_complex","elementType": "geometry","stylers": [{"color": "#c7c7c7"},{"visibility": "off"}]},{"featureType": "road.highway","elementType": "geometry","stylers": [{"visibility": "simplified"},{"color": "#fffae8"}]},{"featureType": "road.highway","elementType": "labels.text","stylers": [{"visibility": "simplified"},{"color": "#696969"}]},{"featureType": "road.highway","elementType": "labels.icon","stylers": [{"visibility": "off"}]},{"featureType": "road.arterial","elementType": "all","stylers": [{"visibility": "simplified"}]},{"featureType": "road.arterial","elementType": "geometry","stylers": [{"visibility": "simplified"}]},{"featureType": "road.local","elementType": "all","stylers": [{"color": "#fdfdfd"}]},{"featureType": "road.local","elementType": "geometry","stylers": [{"visibility": "on"}]},{"featureType": "road.local","elementType": "labels","stylers": [{"visibility": "simplified"},{"color": "#9b9b9b"}]},{"featureType": "transit","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "water","elementType": "all","stylers": [{"color": "#a0d3d3"}]},{"featureType": "water","elementType": "labels","stylers": [{"visibility": "simplified"},{"color": "#7b7b7b"}]}]
			};


			// Create map	        	
			var map = new google.maps.Map( $el[0], args);

			// Disable Scroll
			google.maps.event.addListener(map, 'click', function(event){
				this.setOptions({scrollwheel:true});
			});

			google.maps.event.addListener(map, 'drag', function(event){
				this.setOptions({scrollwheel:true});
			});

			// Set lat ang lng
			var geocoder = new google.maps.Geocoder();
			var location;
			geocoder.geocode( { 'address': elementSettings.address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					location = results[0].geometry.location;

					map.markers = [];

					add_marker( $el, map, location );
					center_map( map );		

					$window.on('resize', function(){
						center_map(map);
					})

				} else {
					alert("Geocode was not successful for the following reason: " + status);
				}
			});

		}


		var add_marker = function( $el, map, location ) {
			var marker = new google.maps.Marker({
				position	: location,
				map			: map,
				icon		: elementSettings.marker.url
			});

			map.markers.push( marker );
		}


		var center_map = function( map ) {
			var bounds = new google.maps.LatLngBounds();

			$.each( map.markers, function( i, marker ){
				var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
				bounds.extend( latlng );
			});

			if( map.markers.length == 1 )
			{
				map.setCenter( bounds.getCenter() );
			}
			else
			{
				map.fitBounds( bounds );
			}
		}


		$googleMap.each(function(){
			render_map( $(this) );
		});

	}


	/**
	* ----------------------------------------------------------------------------------------
	*   Hooks
	* ----------------------------------------------------------------------------------------
	*/

	var $window = $(window);

	$(window).on( 'elementor/frontend/init', function() {

		if ( elementorFrontend.isEditMode() ) {
			isEditMode = true;
		}

		if ( $('body').is('.admin-bar') ) {
			isAdminBar = true;
		}

		elementorFrontend.hooks.addAction( 'frontend/element_ready/global',                         BGImageElement );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/global',                         BGColorElement );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/global',                         SVGIcon );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/global',                         countdownElement );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/global',                         bgParallax );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ssd_multi_heading.default',      textRotator );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ssd_product_slider.default',     ProductSlider );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ssd_poster.default',             SSDPoster );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ssd_mailchimp_form.default',     MailchimpForm );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ssd_google_maps.default',        GoogleMaps );


	});

})(jQuery);
