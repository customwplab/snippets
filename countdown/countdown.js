	
/********* Countdown  ***************/
	//Countdown Timer
	// Set the date we're counting down to
	init_countdown();
	function init_countdown(){
		if($('#countdown-timer').length){
			var el =  $('#countdown-timer');
			var start = el.data('end');
			var currentDate = el.data('start');
			
			var countDownDate = new Date(start).getTime();
			//var countDownDate = Date.parse(start);
			var ajaxURL = el.data('url');
				//console.log(countDownDate);

			var daysLabel = el.data('label-days');
			var hoursLabel = el.data('label-hours');
			var minutesLabel = el.data('label-minutes');
			var secondsLabel = el.data('label-seconds');
			
			var hoursLabelSm = el.data('label-hours-sm');
			var minutesLabelSm = el.data('label-minutes-sm');
			var secondsLabelSm = el.data('label-seconds-sm');
			
			// Update the count down every 1 second
			var x = setInterval(function() {

			// Get today's date and time
			var now = new Date().getTime();
			//var offset = new Date().getTimezoneOffset();
			
			var now = Math.floor(Date.now());
			  // Find the difference between now and the count down date
			  var difference = countDownDate - now;
			  // Time calculations for days, hours, minutes and seconds
			  var days = Math.floor(difference / (1000 * 60 * 60 * 24));
			  var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			  var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
			  var seconds = Math.floor((difference % (1000 * 60)) / 1000);

			  // Display the result in the element
			  document.getElementById("countdown-timer").innerHTML = '<div>'+ days + '<span class="d">'+daysLabel+'</span></div><div>' + hours + '<span class="h rg">'+hoursLabel+'</span><span class="h sm">'+hoursLabelSm+'</span></div><div>'
			  + minutes + '<span class="m rg">'+minutesLabel+'</span><span class="m sm">'+minutesLabelSm+'</span></div><div>' + seconds + '<span class="s rg">'+secondsLabel+'</span><span class="s sm">'+secondsLabelSm+'</span></div>';

			  // If the count down is finished, reload the page content
				if (difference < 1) {
					clearInterval(x);
					el.empty();
					console.log(ajaxURL);
					var containerID = 'cb-countdown';
					setTimeout(function(){ 
						$.ajax({
						   url:ajaxURL,
						   type:'GET',
						   beforeSend : function ( xhr ) {
								$('#'+containerID).addClass('loading').css('opacity','0');
							},
						   success: function(data){
							$('#'+containerID).html($(data).find('#'+containerID).html());	 
						   }, 
						   complete: function(){
							   init_countdown();
							   $('#'+containerID).removeClass('loading').css('opacity','1');
						   }
						});
					}, 3000);
						
				}
			}, 1000);
		}
		
	}
