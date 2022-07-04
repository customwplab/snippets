// Event Tab -> Performance Event
	$(document).on('click','.event-term-filter label:not(.non-filter)', function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		var activeClass = $(this).find('input').val(); 
		console.log(activeClass);
		if(activeClass == 'all'){
			$(this).closest('.tab-content').find('article').show();
		} else {
			$(this).closest('.tab-content').find('article:not(.'+activeClass+')').hide();
			$(this).closest('.tab-content').find('article.'+activeClass).show();
		}
	});
