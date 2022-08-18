//trigger slides on scroll
		$(window).scroll(function(){
			
			$('.slide-scroll').each(function(){
				
				var slide =  parseInt($(this).attr('slide'));
				var sectionTopPos = $(this).position().top;
				
				var scrollTop     = $(window).scrollTop();
				var elementOffset = $(this).offset().top;
				var distance      = (elementOffset - scrollTop);
				
				var slideIndex = parseInt(slide) - 1;
				
				console.log('slide '+slide + ' distance from top: ' + distance);
				//console.log('scrolled distance: ' + scrollTop);
				
			  if (distance < ($(window).height() * 0.3) && distance >  ($(window).height() * 0.15)) {
				//console.log('slide index: ' + slideIndex);
				console.log('clicked ' +slide);
				$('#scroll-slides .swiper-pagination-bullets > span:nth-child('+slide+')').trigger('click');
			  }
			});
	
		
		});
