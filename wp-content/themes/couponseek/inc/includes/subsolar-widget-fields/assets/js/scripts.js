jQuery(document).ready(function($){


	"use strict";


	/**
	* ----------------------------------------------------------------------------------------
	*    Image Upload Field
	* ----------------------------------------------------------------------------------------
	*/

	var mediaUploader;

	$(document).on('click', '.ssd-upload-image-button',function(e) {
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
	    	$('input.ssd-widget-image-url-field[name="' + uploadButtonName + '"]').val(attachment.id );
	    	$('input[type="hidden"][name="' + uploadButtonName + '"]').val(attachment.id );
	    	$widgetContainer.find('.widget-control-save').trigger('click');
	    });
	    // Open the uploader dialog
	    mediaUploader.open();
	});

	$(document).on('click', '.ssd-widget-remove-image',function(e) {
		e.preventDefault();

		var $removeImageButton = $(this);
		var removeImageButtonName = $removeImageButton.data('image-remove');
		var $widgetContainer = $removeImageButton.closest('.widget-inside');

		$('input.ssd-widget-image-url-field[name="' + removeImageButtonName + '"]').val('');
	    $('input[type="hidden"][name="' + removeImageButtonName + '"]').val('');
	    $widgetContainer.find('.widget-control-save').trigger('click');
		
	});


	

	/**
	* ----------------------------------------------------------------------------------------
	*    Select Field
	* ----------------------------------------------------------------------------------------
	*/

	function initSelect( widget_el ) {
        widget_el.find( '.is-ssdwf-select:not(.selectized)' ).selectize({
        	create: false,
        	sortField: {
        		field: 'text',
        		direction: 'asc'
        	},
        	dropdownParent: 'body'
        });

    }

	function onFormUpdateSelectField( e, widget_el ) {

        if (  widget_el.find( '.is-ssdwf-select' ) ) {
            initSelect( widget_el, 'widget-added' === e.type );
        }
    }

	$(document).on( 'widget-added widget-updated', onFormUpdateSelectField );

	$( '#widgets-right .widget:has(.is-ssdwf-select)' ).each( function () {
		initSelect( $(this) );
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Multi Select Field
	* ----------------------------------------------------------------------------------------
	*/
	function initMultiSelect( widget_el ) {
		var multiSelectSelectize = widget_el.find( '.is-ssdwf-multi-select:not(.selectized)' ).selectize({
			plugins: [
			'drag_drop',
			'remove_button'
			],
			maxItems: null,
			create: false,
			onInitialize : function(){
				var field = this;
				field.setValue(null, true);

				var fieldName = this.$input.data('name');
				var $fieldHidden = $('input[type="hidden"][name="' + fieldName + '"]');
				var fieldHiddenValuesArr = $fieldHidden.val().split(',');

				$.each(fieldHiddenValuesArr, function(index, value){
		        	field.addItem(value, true);
		        });

				
			}
		});
    }

	function onFormUpdateMultiSelectField( e, widget_el ) {

        if (  widget_el.find( '.is-ssdwf-multi-select' ) ) {
            initMultiSelect( widget_el, 'widget-added' === e.type );
        }
    }

	$(document).on( 'widget-added widget-updated', onFormUpdateMultiSelectField );

	$( '#widgets-right .widget:has(.is-ssdwf-multi-select)' ).each( function () {
		initMultiSelect( $(this) );
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Write current input values
	* ----------------------------------------------------------------------------------------
	*/

	$(document).on('change', 'select.selectized, input.selectized', function(e) { 
		var $input = $(this);
		var fieldName = $input.data('name');
		var $fieldHidden = $('input[type="hidden"][name="' + fieldName + '"]');

		if ( $fieldHidden.length > 0 ) {
			var field_value = $input.val();
			$fieldHidden.val(field_value); 
		}
	});
	


})