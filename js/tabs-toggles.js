jQuery(document).ready(function( $ ) {

	
	//Tabs
	$('[data-tab]').on('click',function (e) {
		var tabId = $(this).data('tab');
		$(this).closest('.tabs-container').find('.tab-panel, .tab').removeClass('active');
		$(this).closest('.tabs-container').find('.tab-panel[data-tab="'+tabId+'"], .tab[data-tab="'+tabId+'"]').addClass('active');
	});
	

	//Toggle
	$('[toggle]').on('click',function (e) {
		
		var toggleContent = $(this).attr('toggle');
		var toggleIcon = $(this).find('i').toggleClass('fa-plus fa-minus');
		$('[toggle-content="'+toggleContent+'"]').slideToggle();
	});
		
});
