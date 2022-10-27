jQuery(function($) {
  
  //API Query Forms
	if($('form.api-query').length){
		$(document).on('submit', 'form.api-query', function(e){
			e.preventDefault();
			var siteURL = window.location.protocol + "//" + window.location.host + "/";
			var endpoint = $(this).data('endpoint');
			var action = $(this).data('action');
			var formData = getFormData($(this));
			console.log(endpoint);
			console.log(formData);
			jQuery.post(
				siteURL+'wp-json/'+endpoint,
				{ 
					'action': action, 
					'form_data': formData, 
				}
			).done( function(data) { 
				console.log(data);
				$('#results').html(data);
			});
		});
	}
  
  	});
