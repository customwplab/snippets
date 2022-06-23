jQuery(document).ready(function( $ ) {

	//Scroll to anchor
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();
 
	    var target = this.hash;
	    var $target = $(target);
 
	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	        window.location.hash = target;
	    });
	});
	
	//Header wrap scroll class
	$(document).on("scroll",function(){
		if($(document).scrollTop()>120 ){
			$('.elementor-location-header').addClass('scroll-style');
		} else {
			$('.elementor-location-header').removeClass('scroll-style');
		}
	});

});
   
