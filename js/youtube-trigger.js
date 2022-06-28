//YT Video Trigger
	$(document).on('click','.video-trigger, .video-trigger > *' ,function(){
		//If Youtube video is child, play
		var iframeID = $(this).closest('.video-player-container').find('.youtube-video').data('id');
		
		$('#youtube_player_'+iframeID)[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');
		
		$(this).fadeOut(1000, function(){
			$(this).addClass('playing');
		});

	});
