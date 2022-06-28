//Tabs 
	if($('.tabs').length){
		
		$('.tabs ul li:first-child').addClass('is-active');
		$('.tab-panel:first-child').addClass('is-active');
		
		$(document).on('click','.tabs ul li', function(){
			var tab = $(this).data('tab');
			$(this).addClass('is-active').siblings().removeClass('is-active');
			$('.tab-panels div[data-tab="'+tab+'"]').addClass('is-active').siblings().removeClass('is-active');
		});
		//Keybard Nav Tabs
			//tabs
			$('.tabs ul li').on('blur', function(){
				$(this).addClass('is-active').siblings().removeClass('is-active');
			});
			//panels
			$('.tab-panels > div').on('blur', function(){
				var tab = $(this).data('tab');
				$(this).addClass('is-active').siblings().removeClass('is-active');
				$('.tabs ul li[data-tab="'+tab+'"]').addClass('is-active').siblings().removeClass('is-active');
			});
			
			//Enter press
			$(".tab").keydown(function(e){
				console.log('clicked');
				if(e.which === 13){
					$(this).click();
				}
			});
	}
