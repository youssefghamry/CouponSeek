jQuery(document).ready(function($){


	"use strict";


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
	    mediaUploader.on('select', function(event) {
	    	let attachment = mediaUploader.state().get('selection').first().toJSON();
	    	let attachment_size = null;

	    	if ( attachment.sizes.thumbnail == null ) {
	    		attachment_size = attachment.sizes['post-thumbnail'];
	    	} else {
	    		attachment_size = attachment.sizes.thumbnail;

	    	}

	    	$uploadButton.siblings('.is-ssd-upload-image-thumbnail').empty().append('<img src="' + attachment_size.url + '" class="attachment-thumbnail size-thumbnail">');
	    	$('input[type="hidden"][name="' + uploadButtonName + '"]').val(attachment.id );
	    	$(this).off(event);
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


})