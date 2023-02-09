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
	var isMobile = false;
	
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		isMobile = true;
	}

	/**
	* ----------------------------------------------------------------------------------------
	*    Google Maps Error
	* ----------------------------------------------------------------------------------------
	*/

	var gmapsIntervalTries = 0;

	var gmapsInterval = setInterval(function() {
		if ( $('.gm-err-content').length ) {
			$('.gm-err-message').html(couponseek_admin.gooleapi_error);
			$('.acf-google-map .canvas').css('height', '300px');
			clearInterval(gmapsInterval);
		}
		gmapsIntervalTries++;
		if ( gmapsIntervalTries >= 60 ) {
			clearInterval(gmapsInterval);
		}
	}, 100);

	/**
	* ----------------------------------------------------------------------------------------
	*    ACF Show Hide based on Product Type selected
	* ----------------------------------------------------------------------------------------
	*/

	var $productTypeDropdown = $('#product-type');

	function toggleProductExternalACF(){
		var productType = $productTypeDropdown.val();
		if ( productType == 'external' ){
			$('#acf-group_5a55f640136cb').show(); // ACF Product-External
		} else {
			$('#acf-group_5a55f640136cb').hide(); // ACF Product-External
		}
	}

	$productTypeDropdown.change(function(){
		 toggleProductExternalACF();
	})

	 toggleProductExternalACF();

	/**
	 * ----------------------------------------------------------------------------------------
	 *    WC Vendors Form Edit
	 * ----------------------------------------------------------------------------------------
	 */

	$('.wrap table.form-table form').attr( "enctype", "multipart/form-data" )
	$('#profile-page #your-profile').attr( "enctype", "multipart/form-data" )
})
