//Clear Filters
	$(document).on('click','#clear-filters', function(){
		$('#artists_filter')[0].reset();
		$('#artists_filter select').removeClass('active');
		do_ajax(0, function(){
			$('#ajax-loading').remove();
		});
	});	

	//Active Filters
	$(document).on('change','#artists_filter select', function(){
		if($(this).val().length > 0){
			$(this).addClass('active');
		} else {
			$(this).removeClass('active');
		}
	});	
		
	$("#artists_filter").submit(function(event){
		event.preventDefault(); //prevent default action 
		var post_url = $(this).attr("action"); //get form action url
		var form_data = $(this).serialize(); //Encode form elements for submission
		var form_data = form_data.replace(/&?[^=&]+=(&|$)/g,''); //remove empty
		var ajaxURL = post_url+'?'+form_data
		do_ajax(ajaxURL);
	});
	
	function do_ajax(ajaxURL){
		// console.log(ajaxURL);
		// Do ajax
		$.ajax({
		   url:ajaxURL,
		   type:'GET',
		   beforeSend : function ( xhr ) {
			   //Load Results
				$('#results-loop, #artists_filter .btn-container').addClass('loading');
				$('#results-loop article').css('opacity','0');
				
			},
		   success: function(data){
				 
			  //Main Loop
			   $('#results-loop').html($(data).find('#results-loop').html());
			   console.log('ajx '+ajaxURL);
			   
				$('#results-loop , #artists_filter .btn-container').removeClass('loading');
				$('#results-loop	 article').css('opacity','1');
		   }
		});
	}
