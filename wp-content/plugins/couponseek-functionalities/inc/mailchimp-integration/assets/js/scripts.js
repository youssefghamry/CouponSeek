jQuery(document).ready(function($){

	"use strict";
	
	/**
	* ----------------------------------------------------------------------------------------
	*    Mailchimp Newsletter
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-mailchimp-shortcode-subscribe').each(function(){
		var $this = $(this);
		$this.on('submit', function(e) {
			e.preventDefault();
			subscribeSubmit($this);
		})
	});

	function subscribeSubmit($selector) {
		var widgetId = $selector.parents('.widget_mailchimp_newsletter').attr('id');
		var $mailchimpEmail = $selector.parents('.MailchimpNewsletter').find(".is-mailchimp-shortcode-subscribe .mailchimp-email");
		var $mailchimpMessage = $selector.parents('.MailchimpNewsletter').find(".mailchimp-shortcode-message");
		if ( !$mailchimpEmail.val() ) {
			$mailchimpMessage.hide().html('<div class="alert alert-danger">' + subsolar_mailchimp.subs_email_empty + '</div>').fadeIn();
		}
		else if ( !check_email_address($mailchimpEmail.val()) ) {
			$mailchimpMessage.hide().html('<div class="alert alert-danger">' + subsolar_mailchimp.subs_email_error + '</div>').fadeIn();
		}
		else {
			$mailchimpMessage.html('<div class="alert alert-info">' + subsolar_mailchimp.subs_email_add + '</div>').fadeIn();
			$.ajax({
				url: subsolar_mailchimp.ajaxurl,
				data: {
					action : '_action_couponseek_mailchimp_widget_subscribe',
					email : $mailchimpEmail.val(),
					widget_id : widgetId,
				},
				type: 'POST',
				success: function(response) {
					$mailchimpEmail.val('');
					$mailchimpMessage.hide().html(response).fadeIn();
				}
			});
		}

		return false;
	}

	function check_email_address(email)
	{
		var pattern = new RegExp(/[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]+/i);
		return pattern.test(email);
	}


})
