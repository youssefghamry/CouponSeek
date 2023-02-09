jQuery(document).ready(function($){

	"use strict";

	/**
	 * ----------------------------------------------------------------------------------------
	 *    GLOBALS
	 * ----------------------------------------------------------------------------------------
	 */

	 var $window = $(window);
	 var $document = $(document);
	 var $html = $('html');
	 var $body = $('body');
	 var $footer = $('.FOOTER');
	 var isMobile = false;

	 var $mainContent = $( '.MAIN-CONTENT' );
	 var $mainNavigation = $( '.MAIN-NAVIGATION' );


	 var initBgSegmentsFunction = false;

	 if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	 	isMobile = true;
	 }

	/**
	* ----------------------------------------------------------------------------------------
	*    Functions
	* ----------------------------------------------------------------------------------------
	*/
	// Get URL Parameter
	function getUrlParameter(url, name) {
		return (RegExp(name + '=' + '(.*?)(&|$)').exec(url)||['',''])[1];
	}

	// Get Page Index
	function getPageIndex(url) {
		return (RegExp(/(?:(page\/)|(paged=))(\d+)\/*/).exec(url)||['','']);
	}
	
	/**
	* ----------------------------------------------------------------------------------------
	*    JS Checker
	* ----------------------------------------------------------------------------------------
	*/

	document.documentElement.className = document.documentElement.className.replace("no-js","js");

	/**
	* ----------------------------------------------------------------------------------------
	*    Fixes Bug on iOS that stops hovered elements from hiding when tapped outside
	* ----------------------------------------------------------------------------------------
	*/

	if ( isMobile ) {
		$body.css('cursor', 'pointer');
	}

	/**
	* ----------------------------------------------------------------------------------------
	*    GLOBAL Functions
	* ----------------------------------------------------------------------------------------
	*/

	/**
	* Returns a random integer between min (inclusive) and max (inclusive)
	* Using Math.round() will give you a non-uniform distribution!
	*/
	function getRandomInt(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}

	/**
	*  Shade Color
	*/
	function shadeColor(color, percent) {   
		var f=parseInt(color.slice(1),16),t=percent<0?0:255,p=percent<0?percent*-1:percent,R=f>>16,G=f>>8&0x00FF,B=f&0x0000FF;
		return "#"+(0x1000000+(Math.round((t-R)*p)+R)*0x10000+(Math.round((t-G)*p)+G)*0x100+(Math.round((t-B)*p)+B)).toString(16).slice(1);
	}

	/**
	*  Converts rgba(xxx, xxx, xxx, x) to hex
	*/
	function hexc(colorval) {
		var parts = colorval.match(/^rgba*\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(?:\d+)*.*(?:\d+)*)*\)$/);
		if (!parts) {
			return;
		}
		delete(parts[0]);
		for (var i = 1; i <= 3; ++i) {
			parts[i] = parseInt(parts[i]).toString(16);
			if (parts[i].length == 1) parts[i] = '0' + parts[i];
		}
		return '#' + parts.join('');
	}

	/**
	*  Checks of color is dark
	*/
	function isColorDark(hexColor){
		var c = hexColor.substring(1);      // strip #
		var rgb = parseInt(c, 16);   // convert rrggbb to decimal
		var r = (rgb >> 16) & 0xff;  // extract red
		var g = (rgb >>  8) & 0xff;  // extract green
		var b = (rgb >>  0) & 0xff;  // extract blue

		var luma = 0.2126 * r + 0.7152 * g + 0.0722 * b; // per ITU-R BT.709

		if (luma < 40) {
			return true;
		}
		return false;
	}


	/**
	*  Scroll in View
	*/
	$.fn.inView = function() {
		var $this = this;
		var docViewTop = $window.scrollTop();
		var docViewBottom = docViewTop + $window.height();
		var elemTop = $this.offset().top;
		var elemBottom = elemTop + $this.height() + 160;
		if ( ((docViewTop <= elemBottom) && (docViewBottom >= elemTop)) || (isMobile == true) ) {
			return true;
		}
		else {
			return false;
		}
	}


	/**
	*  Get Parent Background
	*/
	$.fn.getParentBG = function() {

		var $this = this;

		if ( $this.children('.bg-color').length ) {
			return $this.children('.bg-color').css("background-color");
		}
		
		// Is current element's background color set?
		var color = $this.css("background-color");
		if ( color == 'transparent' ) {
			color = 'rgba(0, 0, 0, 0)';
		}
		if ( color !== 'rgba(0, 0, 0, 0)' ) {
			// if so then return that color
			return color;
		}

		// are you at the body element?
		if ($this.is("body")) {
			// return known 'false' value
			return false;
		} else {
			// call getParentBG with parent item
			return $this.parent().getParentBG();
		}

	}
	

	/**
	* ----------------------------------------------------------------------------------------
	*    Activate and Reset anim- Animations
	* ----------------------------------------------------------------------------------------
	*/

	$.fn.activateAnimations = function() {

		var self = this;

		self.find('*').filter(function(){

			if (typeof this.className == 'string') {
				var classes = this.className.split(' ');
				var found = false;

				if ( classes ) {
					for (var i = 0, len = classes.length; i < len; i++) {
						if (/^anim-/.test(classes[i])) found = true;
						if (/^anim-onload/.test(classes[i])) return false;
					}
					if (found == true) {
						return true;
					}
				}
			}
			
			return false; 
		}).each(function(){
			$(this).addClass('anim-activated');
		})

	};



	$.fn.resetAnimations = function() {

		var self = this;

		self.find('*').filter(function(){

			if (typeof this.className == 'string') {
				var classes = this.className.split(' ');
				var found = false;

				if ( classes ) {
					for (var i = 0, len = classes.length; i < len; i++) {
						if (/^anim-/.test(classes[i])) found = true;
						if (/^anim-onload/.test(classes[i])) return false;
					}
					if (found == true) {
						return true;
					}
				}
			}
			
			return false;
		}).each(function(){
			$(this).removeClass('anim-activated');
		})

	};


	/**
	* ----------------------------------------------------------------------------------------
	*   Set Background Image or Color
	* ----------------------------------------------------------------------------------------
	*/

	function setBgImage(){
		var $bgimage = $('.bg-image');
		$bgimage.each(function(){
			var $this = $(this);
			var bgimage = $this.data('bg-image')
			if ( $this.css('background-image') != 'url("' + bgimage + '")' ) {
				$this.css('background-image', 'url("' + bgimage + '")' );
			}
			
		})

		var $bgColor = $('.bg-color');
		$bgColor.each(function(){
			var $this = $(this);
			var bgColor = $this.data('bg-color');
			if ( $this.css('background-color') != bgColor ) {
				$this.css('background-color', bgColor);
			}
			var opacity = $this.data('opacity');
			if ( typeof $this.data('opacity') != 'undefined' && $this.css('opacity') != opacity ) {
				$this.css('opacity', opacity);
			}
		})
	}

	setBgImage();

	$window.on('refreshisotope', function(e){
		setBgImage();
	});


	/**
	* ----------------------------------------------------------------------------------------
	*   Set SVG Icon Bg Color
	* ----------------------------------------------------------------------------------------
	*/

	function setSVGColor(){
		var $svgIcon = $('.icon-svg');
		$svgIcon.each(function(){
			var $this = $(this);
			var svgColor = $this.data('bg-color');
			if ( svgColor != undefined && $this.parent().css('background-color') != svgColor ) {
				$this.parent().css('background-color', svgColor );
			}
		})
	}

	setSVGColor();


	/**
	* ----------------------------------------------------------------------------------------
	*    Remove Empty Paragraphs
	* ----------------------------------------------------------------------------------------
	*/

	$('p').filter(function(){
		return !$.trim($(this).html());
	}).remove();


	/**
	 * ----------------------------------------------------------------------------------------
	 *    Show Content from External Elementor Container
	 * ----------------------------------------------------------------------------------------
	 */
	 
	$('.is-elementor-container').fadeTo(0, 1);


	/**
	 * ----------------------------------------------------------------------------------------
	 *    Select 2 on dropdowns
	 * ----------------------------------------------------------------------------------------
	 */

	$('select').each(function(){
		var $this = $(this);
		if ( !$this.hasClass('select2-hidden-accessible') ) {
			$this.select2({
				width: '100%'
			});
		}
	})


	/**
	 * ----------------------------------------------------------------------------------------
	 *    Inline input submit buttons
	 * ----------------------------------------------------------------------------------------
	 */

	$document.on('focus', '.widget .select2-selection--multiple',  function(e){
		var $this = $(e.target);
		if ( $this.closest('.select2-container').siblings('button[type="submit"] I').length == 1 && $this.siblings('input:not([type="hidden"])').length == 0 ) {
			$this.css('padding-right', $this.closest('.select2-container').siblings('button[type="submit"]').outerWidth() + 5);
		}
	});	

	$document.on('focus', '.widget input[type="search"], .widget input[type="email"], .widget input[type="text"], .group-input input',  function(e){
			var $this = $(e.target);
			if ( $this.siblings('button[type="submit"] I').length == 1 && $this.siblings('input:not([type="hidden"])').length == 0 ) {
					$this.css('padding-right', $this.siblings('button[type="submit"]').outerWidth() + 5);
		}
	});


	/**
	* ----------------------------------------------------------------------------------------
	*    Admin Bar
	* ----------------------------------------------------------------------------------------
	*/

	// Makes the bar have better visibility on desktop and mobile

	$('#wpadminbar').css('z-index', '99999999');

	function positionAdminBar(){
		var windowWidth = window.innerWidth;

		if ( windowWidth <= 600 ) {
			$('#wpadminbar').css('position', 'fixed');
		}
	}

	$window.on('resize',function(){
		positionAdminBar();
	});



	/**
	* ----------------------------------------------------------------------------------------
	*    Isotope
	* ----------------------------------------------------------------------------------------
	*/

	var isotopeCols = 0;
	var itemGutter = 0;
	var isotopeType = null

	var startIsotopemethods = {
		init : function(options) {


			var $this = (this);

			$this.startIsotope('setOptions');

			isotopeType = $this.data('isotope-type');

			if ( isotopeType == null ) {
				isotopeType = 'masonry';
			}

			if(typeof $this.data('isotope-gutter') != 'undefined') {
				itemGutter = $this.data('isotope-gutter');
			} else {
				itemGutter = 0;
			}


			// Fires Layout when all images are loaded
			$this.imagesLoaded( function() {
				$this.show();

				// Isotope Init
				$this.isotope({
					transitionDuration: '.2s',
					layoutMode: isotopeType,
					masonry: {
						gutter: itemGutter
					},
				});

				if ( $this.hasClass('is-lightbox-gallery') ) {
					$this.isotope( 'on', 'layoutComplete', function() {
						setTimeout(function(){
							initSimpleLightbox();
						}, 0)
					});
				}

				$window.trigger('refreshisotope');
			});


			// Set the items width on resize
				$window.on('refreshisotope', function (){
					$this.startIsotope('refresh');
				});


			},
			setOptions : function(){

				var $this = $(this);

				$this.imagesLoaded(function(){

				// SET ISOTOPE GUTTER AND SPACINGS
				$this.width($this.parent().width() + 1);

				if(typeof $this.data('isotope-gutter') != 'undefined') {
					itemGutter = $this.data('isotope-gutter');
				} else {
					itemGutter = 0;
				}

				if( itemGutter != 0 ) {

					$this.css({
						'margin-right' : - itemGutter + 'px',
					})

					$this.children().css({
						'margin-bottom' : itemGutter + 'px',
						'overflow' : 'hidden'
					})

					if ( isotopeType == 'masonryHorizontal' || isotopeType == 'fitColumns' ) {
						$this.children().css({
							'margin-right' : itemGutter + 'px',
						})
					}

				}

		 		// SET ISOTOPE COLUMNS

		 		var windowWidth = window.innerWidth;

		 		if ( windowWidth <= 478 ) {
		 			if(typeof $this.data('isotope-cols-xs') != 'undefined') {
		 				isotopeCols = $this.data('isotope-cols-xs');
		 			} else {
		 				isotopeCols = 1;
		 			}
		 		}
		 		else if ( windowWidth <= 767 ) {
		 			if(typeof $this.data('isotope-cols-xs') != 'undefined') {
		 				isotopeCols = $this.data('isotope-cols-xs');
		 			} else if(typeof $this.data('isotope-cols-sm') != 'undefined') {
		 				isotopeCols = $this.data('isotope-cols-sm');
		 			} else if ( $this.data('isotope-cols') == 1){
		 				isotopeCols = 1;
		 			} else {
		 				isotopeCols = 2;
		 			}
		 		} else if ( windowWidth < 992 ) {
		 			if(typeof $this.data('isotope-cols-sm') != 'undefined') {
		 				isotopeCols = $this.data('isotope-cols-sm');
		 			} else if ( $this.data('isotope-cols') > 2 ) {
		 				isotopeCols = $this.data('isotope-cols') - 1;
		 			} else {
		 				isotopeCols = $this.data('isotope-cols');
		 			}

		 		} else {
		 			if ( typeof $this.data('isotope-cols') == 'undefined' ) {
		 				isotopeCols = 3;
		 			} else {
		 				isotopeCols = $this.data('isotope-cols');
		 			}

		 		}

		 		if ( isotopeCols >= 2 ) {
		 			$this.children().not('.isotope-item-width-2').css('width', Math.floor(($this.width() - (itemGutter * (isotopeCols - 1))) / isotopeCols) + 'px' );
		 			$this.children('.isotope-item-width-2').css('width', Math.floor(($this.width() / isotopeCols) * 2 - 2) + 'px' );
		 		} else {
		 			$this.children().css('width', $this.width() / isotopeCols - 1 + 'px' );
		 		}

		 		if( $this.data('isotope-square') == true ) {
		 			var itemsHeight = $this.children().not('.isotope-item-width-2').width();
		 			$this.children().css('height', itemsHeight + 'px' );
		 		}

		 		if ( $this.find('.is-aspectratio').length > 0 ) {

		 			var elWidth = $this.find('.is-aspectratio').width();

		 			$this.find('.is-aspectratio').each(function(){
		 				var $el = $(this);
		 				var height = 0;
		 				var landscapeHeight = 0;

		 				if ( $el.hasClass('ar_4_3') ) {
		 					height = elWidth / 1.333 ;
		 				}
		 				if ( $el.hasClass('ar_1_1') ) {
		 					height = elWidth;
		 				}
		 				if ( $el.hasClass('ar_3_2') ) {
		 					height = elWidth / 1.5;
		 				}
		 				if ( $el.hasClass('ar_16_9') ) {
		 					height = elWidth / 1.777;
		 				}
		 				if ( $el.hasClass('ar_3_1') ) {
		 					height = elWidth / 3 ;
		 				}

		 				if ( $el.hasClass('ar_3_4') ) {
		 					height = elWidth / 0.75;
		 				}
		 				if ( $el.hasClass('ar_2_3') ) {
		 					height = elWidth / 0.666;
		 				}
		 				if ( $el.hasClass('ar_9_16') ) {
		 					height = elWidth / 0.5625;
		 				}
		 				if ( $el.hasClass('ar_1_3') ) {
		 					height = elWidth / 0.333;
		 				}

			 			// searches if there are landcape items
			 			landscapeHeight = $this.find('.is-autox-landscape').height();

			 			// checks if the current item is portrait
			 			if ( $el.hasClass('is-autox-portrait') ) {
			 				// if landscapeHeight is greater than 0, it means that there is at least one landscape image
			 				if ( landscapeHeight > 0 ) {
			 					$el.height(Math.floor(landscapeHeight*2 + $this.data('isotope-gutter')));	
			 				} else {
			 					$el.height(Math.floor(height));	
			 				}

			 			} else {
			 				$el.height(Math.floor(height));
			 			}

			 		})
		 		}

			}) //imagesLoaded

		},
		refresh : function(){
			var $this = $(this);
			var windowWidth = window.innerWidth;

			$this.startIsotope('setOptions');

			setTimeout(function(){
				$this.isotope('layout');
				if ( $this.hasClass('is-isotope-match-height') ) {
					if ( windowWidth <= 478 ) {
						$this.find('.is-matchheight').matchHeight({
							remove: true,
						});
					} else {
						$this.find('.is-matchheight').matchHeight({
							byRow: false,
						});
					}
				}
			}, 100)

		}
	};


	$.fn.startIsotope = function(methodOrOptions) {
		if ( startIsotopemethods[methodOrOptions] ) {
			return startIsotopemethods[ methodOrOptions ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof methodOrOptions === 'object' || ! methodOrOptions ) {
	        // Default to "init"
	        return startIsotopemethods.init.apply( this, arguments );
	    } else {
	    	$.error( 'Method ' +  methodOrOptions + ' does not exist on jQuery.startIsotope' );
	    }    
	};


	var $isotopeContainer = $('.is-isotope');

	var triggerRefreshIsotope;

	function initResizeSensorIsotope($selector){
		$selector.wrap( "<div class='is-resize-sensor'></div>" );
		$selector.startIsotope();
		$selector.addClass('isotope-loaded');

		new ResizeSensor($selector.closest('.is-resize-sensor'), function(){
			clearTimeout(triggerRefreshIsotope);
			triggerRefreshIsotope = setTimeout(ResizeSensorTriggerRefreshIsotope, 300);
		});
	}

	function ResizeSensorTriggerRefreshIsotope(){
		$window.trigger('refreshisotope');
	}


	$isotopeContainer.each(function(){
		var $this = $(this);
		if ( !$this.parents(':hidden').length ){
			initResizeSensorIsotope($this);
		}
		
	})

	$window.on('throttledresize', function(){
		$('.is-isotope').each(function(){
			var $this = $(this);

			if ( !$this.parents(':hidden').length && !$this.hasClass('isotope-loaded') ){
				initResizeSensorIsotope($this);
			}
		})
	})


	/**
	* ----------------------------------------------------------------------------------------
	*    Isotope Filter
	* ----------------------------------------------------------------------------------------
	*/

	$document.on('click', '.is-isotope-filter a', function(e){
		e.preventDefault();
		var $this = $(this);
		var data_target = $this.parents('.is-isotope-filter').data('target');
		var $target = $(data_target);
		var selector = $this.attr('data-filter');
		$this.parents('.is-isotope-filter').find('.selected').removeClass('selected');
		$this.parent('li').addClass('selected');

		$target.isotope({ filter: selector });

		return false;

	});

	if ( $('.is-isotope-filter').data('hide-show-all') == '1' ) {
		$('.is-isotope-filter li:first-child a').trigger('click');
	}


	/**
	* ----------------------------------------------------------------------------------------
	*    Nav Menu
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-slicknav').each(function(){
		var $this = $(this);
		$this.find('.main-navigation-menu > ul').slicknav({
			label: '',
			init: function(){
				var $brandLogo = $this.find('.main-navigation-logo .main-navigation-logo-mobile').clone();
				var homeUrl = $this.find('.main-navigation-logo a').attr('href');
				$('.slicknav_menu').prepend($brandLogo);
				$brandLogo.wrap('<div class="slicknav_menu_logo"><a href="' + homeUrl + '"></a></div>');
			}
		})
	})

	// Nav Offset
	var $navigation = $('.slicknav_menu');
	var $navOffset = $('.is-nav-offset');
	var navHeight = $navigation.innerHeight();

	function navOffset() {
		if ( $('.slicknav_menu').is(':visible') ) {
			$navOffset.css('padding-top', $('.slicknav_menu_logo').innerHeight());
		} else if ( !$mainNavigation.hasClass('is-main-nav-transparent') ) {
			$navOffset.css('padding-top', $mainNavigation.height());
		} else {
			$navOffset.css('padding-top', '0');
		}
	}

	navOffset();

	$window.on('resize',function(){
		navOffset();
	});



	// Add dropdown arrow
	$('.is-navmenu').find('.menu-item-has-children a').each(function(){

		var $this = $(this);

		if ( $this.next().hasClass('sub-menu') ) {
			if ( $this.closest('.sub-menu').length > 0 ) {
				$this.append('<i class="fas fa-angle-right"></i>');
			} else {
				$this.append('<i class="fas fa-angle-down"></i>');
			}
		}

	})

	/**
	 * ----------------------------------------------------------------------------------------
	 *    Header on Scroll
	 * ----------------------------------------------------------------------------------------
	 */

	 var $navigationTransparent = $('.is-main-nav-transparent');
	 var navHeight = $navigationTransparent.height();

	 function removeNavTransparency() {

	 	navHeight = $navigationTransparent.height();

	 	if ( $('.is-slicknav').css('display') != 'none' ) {
	 		if ( $window.scrollTop() > navHeight ){
	 			$navigationTransparent.removeClass('main-nav-transparent');

			} else if ( $window.scrollTop() == 0 ){
				$navigationTransparent.addClass('main-nav-transparent');
			}

		}
		
		

	}

	removeNavTransparency();

	$window.scroll(function(){
		removeNavTransparency();
	});

	$window.on('resize',function(){
		removeNavTransparency();
	});


	/**
	* ----------------------------------------------------------------------------------------
	*    Countdown Init
	* ----------------------------------------------------------------------------------------
	*/
	
	var $dealCountdown = $('.is-jscountdown');
	var expiredText = couponseek.expired;
	var dayText = couponseek.day;
	var daysPluralText = couponseek.days;
	var hourText = couponseek.hour;
	var hoursPluralText = couponseek.hours;
	var minuteText = couponseek.minute;
	var minutesPluralText = couponseek.minutes;

	function initCountdown(el){
		var $this = el;
		var finalDate = $this.data('time');

		if ( $this.data('started') != "true" ) {
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

					$this.html(event.strftime(format));

				} else if(event.offset.totalDays > 0) {
					var daysFormat = '%-D';

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
					$this.html('<span class="jscountdown-time">' + event.strftime(format) + '</span>');
				}

			})
			.on('finish.countdown', function(event) {
				$this.html(expiredText)
				.parent().addClass('disabled')

			})
		}
	}

	$dealCountdown.each(function(){

		initCountdown($(this));

	})
	

	/**
	* ----------------------------------------------------------------------------------------
	*    Perfect Scrollbar
	* ----------------------------------------------------------------------------------------
	*/


	var perfectScrollbars = null;

	function initPerfectScrollbar(){

		if ( perfectScrollbars ) {
			perfectScrollbars.destroy();
			perfectScrollbars = null;
		}


		perfectScrollbars = new PerfectScrollbar('.is-perfect-scrollbar', {
			scrollYMarginOffset: 0,
			suppressScrollX: true,
			wheelPropagation: false
		});

	}

	if ( $('.is-perfect-scrollbar').length > 0 ) {
		initPerfectScrollbar();
	}


	$window.on('throttledresize',function(){
		if ( perfectScrollbars ) {
			perfectScrollbars.update();
		}
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Single Deal Carousel
	* ----------------------------------------------------------------------------------------
	*/

	var $singleDealSlider = $('.woocommerce-product-gallery__thumbnails_wrapper.owl-carousel');


	$singleDealSlider.each(function(){
		var $this = $(this);
		var itemsNumber = $this.find('.woocommerce-product-gallery__image').length;
		if (itemsNumber == 0) return false;
		if ( itemsNumber < 5 ) {
			var slidesNumber = itemsNumber;
		} else {
			var slidesNumber = 5;
		}
		$this.owlCarousel({
			// autoHeight: false,
			// loop: true,
			nav: true,
			dots: false,
			// autoWidth: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 2,
				},
				560:{
					items: 3,
				},
				1500:{
					items: slidesNumber,
				}
			},
			navText: [
			"<i class='fas fa-angle-left'></i>",
			"<i class='fas fa-angle-right'></i>"
			]
		})

	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Parallax
	* ----------------------------------------------------------------------------------------
	*/

	function parallaxScroll(){
		var windowWidth = window.innerWidth;

		if ( windowWidth < 992 || isMobile ) {
			$('.is-parallax').each(function(){
				var $this = $(this);
				$this.css('background-position', '');
				$this.css('background-size', 'cover');
			});
			$('.is-floating').each(function(){
				var $this = $(this);
				$this.css({
					'-webkit-transform' : '',
					'-ms-transform' : '',
					'transform' : ''
				});
			});
			return;
		}

		var docViewTop = $window.scrollTop();
		var docViewBottom = docViewTop + $window.height();

		$('.is-parallax').each(function(){
			var $this = $(this);

			var top = 0;
			top = docViewBottom - $this.offset().top;

			if ( $this.offset().top <= $window.scrollTop() + $window.height() + 200 ) {
				$this.css('background-position', 'left 50% ' + 'top ' + ( 110 - top * 0.08) + '%');
			} else {
				$this.css('background-position', 'left 50% top 100%');
			}		

		})

		$('.is-floating').each(function(){
			var $this = $(this);
			var top = 0;
			if ( $this.inView() ) {
				top = docViewBottom - $this.offset().top;
				var translateY = 100 - (top * 0.18);
				$this.css({
					'-webkit-transform' : 'translateY(' + translateY + 'px)',
					'-ms-transform' : 'translateY(' + translateY + 'px)',
					'transform' : 'translateY(' + translateY + 'px)'
				});
			}
		})
	}

	parallaxScroll();

	$window.on('scroll throttledresize', function(e){
		parallaxScroll();
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Post Share Buttons
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-shareable .facebook').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('http://www.facebook.com/sharer.php?u=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	$('.is-shareable .twitter').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('https://twitter.com/share?url=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	$('.is-shareable .google-plus').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('https://plus.google.com/share?url=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	$('.is-shareable .pinterest').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		var img = $('.SinglePostHeader .bg-image').data('bg-image');
		window.open('http://pinterest.com/pin/create/button/?url=' + postUrl + '&media=' + img,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	/**
	* ----------------------------------------------------------------------------------------
	*    Match Height
	* ----------------------------------------------------------------------------------------
	*/
	
	// Section Shortcode
	function triggerMatchHeight() {
		var windowWidth = window.innerWidth;
		if ( windowWidth <= 767 ) {
			$('.is-matchheight').matchHeight({
				remove: true,
			});
			$('.is-matchheight-group').each(function(){
				var $this = $(this);
				$this.children().matchHeight({
					remove: true,
				});
			})
			$('.is-matchheight-container .row, .is-matchheight-container .fw-row').each(function(){
				var $this = $(this);

				if (!$this.parents('.fullscreen-wrapper').length) {
					$this.find('[class^="fw-col-"], [class^="col-"]').matchHeight({
						remove: true
					});
				}
				
			})
		} else {
			$('.is-matchheight').matchHeight({
				byRow: false
			});
			$('.is-matchheight-group').each(function(){
				var $this = $(this);
				$this.children().matchHeight({
					byRow: true
				});
			})
			$('.is-matchheight-container .row, .is-matchheight-container .fw-row').each(function(){
				var $this = $(this);

				if (!$this.parents('.fullscreen-wrapper').length) {
					$this.find('[class^="fw-col-"], [class^="col-"]').matchHeight({
						byRow: false
					});
				}
				
			})
		}
	}

	triggerMatchHeight();
	
	$window.on('throttledresize',function(){
		setTimeout(function(){
			triggerMatchHeight();
			$window.trigger('googlemapsresize');
		}, 400)
	});


	/**
	* ----------------------------------------------------------------------------------------
	*    Simple Lightbox
	* ----------------------------------------------------------------------------------------
	*/

	var $lightboxes = '';

	var lightbox = [];
	var $lightboxImages = '';

	function initSimpleLightbox(){

		var arrayLength = lightbox.length;
		for (var i = 0; i < arrayLength; i++) {
			lightbox[i].destroy();
		}

		$('.is-lightbox-gallery').each(function(){
			var $this = $(this);
			$lightboxImages = $this.find('*:visible a, a:visible');

			lightbox.push(new $.SimpleLightbox({
				$items: $lightboxImages,
				nextBtnClass: ' arrow-right',
				prevBtnClass: ' arrow-left',
				prevBtnCaption: '',
				nextBtnCaption: '',
				videoRegex: new RegExp(/youtube.com|vimeo.com/),
			}));

		});

	}
	
	setTimeout(function(){
		initSimpleLightbox();
	}, 100)


	/**
	* ----------------------------------------------------------------------------------------
	*    Dropdown Don't Hide Menu on Click Inside
	* ----------------------------------------------------------------------------------------
	*/

	$(document).on('click', '.DealSearch .dropdown-menu', function (e) {
		var targetClass = $(e.target).attr('class');
		if ( targetClass == 'ps__thumb-y' || targetClass == 'ps__thumb-x' || targetClass == 'ps__rail-y' || targetClass == 'ps__rail-x' ) {
			e.stopPropagation();
		}
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Toggle Dropdown Close Button and Overlay
	* ----------------------------------------------------------------------------------------
	*/

	$('.dropdown').on('show.bs.dropdown', function () {
		var $this = $(this);

		var $closeButton = $this.find('.dropdown-menu-close-button');
		var $overlay = $this.find('.dropdown-menu-overlay');

		$closeButton.fadeIn(100);
		$overlay.fadeIn(100);
	})

	$('.dropdown').on('hide.bs.dropdown', function () {
		var $this = $(this);

		var $closeButton = $this.find('.dropdown-menu-close-button');
		var $overlay = $this.find('.dropdown-menu-overlay');

		$closeButton.fadeOut(100);
		$overlay.fadeOut(100);
	})


	/**
	* ----------------------------------------------------------------------------------------
	*    Update PerfectScrollbar on Dropdown Show
	* ----------------------------------------------------------------------------------------
	*/
	$('.dropdown').on('shown.bs.dropdown', function () {
		if ( perfectScrollbars ) {
			perfectScrollbars.update();
		}
	})


	/**
	* ----------------------------------------------------------------------------------------
	*    Dropdown Select Save Input In Hidden Field
	* ----------------------------------------------------------------------------------------
	*/


	$(document).on('click', '.dropdown .dropdown-menu li a', function(e){

		var $this = $(this);

		var el = $this.parents('ul').data('name');

		if( el ){
			e.preventDefault();

			var $dropdownButton = $this.parents('.dropdown' ).find('.dropdown-content');

			if ( !$this.parents('.dropdown' ).data('dropdown-icon') ) {
				var dropdownIcon = $dropdownButton.find('use').attr('xlink:href');
				$this.parents('.dropdown' ).data('dropdown-icon', dropdownIcon);
			}

			var $dropdownSVG = $dropdownButton.find('.is-dropdown-svg');
			$dropdownButton.empty();
			$dropdownButton.append($dropdownSVG);
			$dropdownButton.find('.is-dropdown-svg').addClass('hidden');

			if ( $this.find('svg').length > 0 ) {
				$dropdownButton.append( $this.find('.category-icon').html() );
				$dropdownButton.append( $this.find('span').html() );
			} else {
				$dropdownButton.find('.is-dropdown-svg').removeClass('hidden');
				$dropdownButton.append($this.html());
			}


			$this.closest('form').find('input[name="'+el+'"]').val( $this.data('value') );
		}

	});

	$('.dropdown').each(function(){

		var $this = $(this);

		var $dropdownButtonContent = $this.find('.dropdown-content');
		var $currentItem = $this.find( '.dropdown-menu li a[data-current="true"]' );

		if ( $currentItem.length > 0 ) {
			var $dropdownSVG = $dropdownButtonContent.find('.is-dropdown-svg');
			$dropdownButtonContent.empty();
			$dropdownButtonContent.append($dropdownSVG);
			$dropdownButtonContent.find('.is-dropdown-svg').addClass('hidden');
			if ( $currentItem.find('svg').length > 0 ) {
				$dropdownButtonContent.append( $currentItem.find('.category-icon').html() );
				$dropdownButtonContent.append( $currentItem.find('span').html() );
			} else {
				$dropdownButtonContent.find('.is-dropdown-svg').removeClass('hidden');
				$dropdownButtonContent.append($currentItem.html());
			}
		};

	})

	/**
	* ----------------------------------------------------------------------------------------
	*    Show Cities on Country Dropdown Click
	* ----------------------------------------------------------------------------------------
	*/

	$('.dropdown .dropdown-menu[data-name="product_country"] li a').on('click', function(e){

		var $this = $(this);
		var country = $this.data('value');
		var $citiesButton = $this.closest('.dropdown').siblings().find('.is-city-product-dropdown');
		var $citiesButtonContent = $citiesButton.find('.dropdown-content');
		var citiesButtonIcon = $citiesButtonContent.find('svg').clone();

		$citiesButton.prop('disabled', true);
		$citiesButtonContent.empty().html('<i class="svg-icon-rotating fas fa-circle-notch fa-spin"></i>');

		$.ajax({
			type: 'post',
			url: couponseek.ajaxurl,
			dataType: 'json',
			data: "action=_action_couponseek_show_cities&nonce="+couponseek.nonce+"&country="+country,
			success: function(response){
				var $citiesDropdown = $this.closest('.dropdown').siblings().find('ul[aria-labelledby="cities-product-dropdown"], ul[aria-labelledby="cities-widget-dropdown"]');
				
				$citiesDropdown.html(response.html);

				$citiesButtonContent.empty().append(citiesButtonIcon);
				$citiesButtonContent.append($citiesDropdown.find('li:first-child a').html());

				var $citiesInput = $this.closest('.dropdown').find('input[name="product_city"]');
				$citiesInput.val('');
				$citiesButton.prop('disabled', false)
			}
		});

	});

	/**
	* ----------------------------------------------------------------------------------------
	*   Autofill cities and select current City if $_GET['product_city'] exists
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-city-product-dropdown').siblings('.dropdown-menu').each(function(){
		var $this = $(this);

		var sPageURL = decodeURIComponent(window.location.search);
		var country = getUrlParameter(sPageURL, 'product_country');
		var city = getUrlParameter(sPageURL, 'product_city');

		var $citiesButton = $this.siblings('.is-city-product-dropdown');
		var $citiesButtonContent = $citiesButton.find('.dropdown-content');
		var citiesButtonIcon = $citiesButtonContent.find('svg').clone();

		var buttonText = $citiesButton.find('span').text();

		if ( country && city ) {
			$citiesButton.prop('disabled', true);
			$citiesButtonContent.empty().append('<i class="svg-icon-rotating fas fa-circle-notch fa-spin"></i>');	
		}

		var hasCountries = 'no';
		if ( $this.parents('.dropdown-cities').siblings('.dropdown-countries').length > 0 ) {
			hasCountries = 'yes';
		}

		$.ajax({
			type: 'post',
			url: couponseek.ajaxurl,
			dataType: 'json',
			data: "action=_action_couponseek_show_cities&nonce="+couponseek.nonce+"&country="+country+"&city="+city+"&has_countries="+hasCountries,
			success: function(response){

				$this.append(response.html);

				if ( response.cities_found) {

					var currentItem = $this.find('li a[data-current="true"]');

					if ( currentItem.length > 0 ) {
						$citiesButtonContent.empty();
						$citiesButtonContent.empty().append(citiesButtonIcon);
						$citiesButtonContent.append( currentItem.html() );
						$citiesButton.prop('disabled', false);
					};
				} else {
					
				}
				
			}
		});
	})


	$(document).on('click', '.is-select-country-first', function(e){ 
        	e.stopPropagation();
	        var $countriesDropdown = $this.closest('.dropdown').siblings('.dropdown-countries').find('.dropdown-button');
	        $countriesDropdown.dropdown('toggle');
    });

	/**
	* ----------------------------------------------------------------------------------------
	*    Section Centered Content
	* ----------------------------------------------------------------------------------------
	*/

	function triggerCenterContent() {

		$('.is-centered-content').each(function(){
			var $this = $(this);
			var $contentContainer = $this.find('.fw-container, .fw-container-full');
			var windowHeight = $window.height();
			if ( $this.outerHeight() <= windowHeight ) {
				$contentContainer.addClass('el-centered');
			}
		})

	}

	triggerCenterContent()

	$window.on('throttledresize',function(){
		triggerCenterContent();
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Section Scroll Down
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-scroll-down').each(function(){

		var $this = $(this);

		$this.on('click', function(e){
			e.preventDefault();
			var elemTop = $this.parent().offset().top;
			var height = $this.parent().outerHeight();
			var scrollBottom = height + elemTop;
			$('body,html').animate({
				scrollTop: scrollBottom,
			}, 600
			);

		})

	})

	/**
	* ----------------------------------------------------------------------------------------
	*    ClipboardJS
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-clipboard-error').hide();
	$('.is-clipboard-success').hide();

	var clipboard = new Clipboard('.is-show-coupon-code');


	$('.is-show-coupon-code').on('click', function(e){

		var $this = $(this);

		if( !$this.data('redirect') ) {
			e.preventDefault();
		}

		$($this.data('target')).modal('show');

	})

	clipboard.on('success', function(e) {
		e.clearSelection();
		$('.is-clipboard-success').show();
	});

	clipboard.on('error', function(e) {
		e.clearSelection();
		$('.is-clipboard-error').show();
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Image Upload Field
	* ----------------------------------------------------------------------------------------
	*/

	var mediaUploader;

	$(document).on('click', '.is-ssd-upload-image-button',function(e) {
		e.preventDefault();

		var $uploadButton = $(this);
		var $widgetContainer = $uploadButton.closest('.widget-inside');
		var uploadButtonName = $uploadButton.data('name');

	    // If the uploader object has already been created, reopen the dialog
	    if (mediaUploader) {
	    	mediaUploader.open();
	    	return;
	    }
	    // Extend the wp.media object
	    var mediaUploader = wp.media.frames.file_frame = wp.media({
	    	title: 'Select Image',
	    	button: {
	    		text: 'Select'
	    	},
	    	multiple: false
	    });

	    // When a file is selected, grab the URL and set it as the text field's value
	    mediaUploader.on('select', function() {
	    	var attachment = mediaUploader.state().get('selection').first().toJSON();
	    	$uploadButton.siblings('.is-ssd-upload-image-thumbnail').empty().append('<img src="' + attachment.sizes.couponseek_landscape_small.url + '" class="attachment-couponseek_landscape_small size-couponseek_landscape_small">');
	    	$('input[type="hidden"][name="' + uploadButtonName + '"]').val(attachment.id );
	    });
	    // Open the uploader dialog
	    mediaUploader.open();
	});

	$(document).on('click', '.is-ssd-upload-remove-image',function(e) {
		e.preventDefault();

		var $removeImageButton = $(this);
		var removeImageButtonName = $removeImageButton.data('image-remove');

		$removeImageButton.siblings('.is-ssd-upload-image-thumbnail').empty();
	    $('input[type="hidden"][name="' + removeImageButtonName + '"]').val('');
		
	});

	$(document).on('click', '.is-ssd-input-upload-remove-image',function(e) {
		e.preventDefault();

		var $removeImageButton = $(this);
		var removeImageButtonName = $removeImageButton.data('image-remove');

		$removeImageButton.siblings('.is-ssd-upload-image-thumbnail').empty();
	    $('input[name="' + removeImageButtonName + '"]').val('');
		
	});

})