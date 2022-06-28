//Modal
	if ( $( ".modal" ).length ) {
		
		//Move modal element
		$('.modal').each(function(i) {
			$(this).appendTo('body');
		});
		
		// Trigger
		var triggerEl = $( '.modal-trigger');

		$(triggerEl).click(function(e) {
			e.preventDefault;
			openModal( $(this) );
		});
		
		$(document).on('click','.modal .modal-close, .modal-background' ,function(){
			closeModal();
		});
		
		//Open
		function openModal( triggerBtn ){
			var modalID = triggerBtn.data('modal-id');
			console.log(modalID);
			$('.modal[data-modal-id="'+ modalID +'"] ').addClass('is-active');
			$('body').addClass('modal-open');
		}
		
		//Close
		function closeModal(){
			$('.modal.is-active').removeClass('is-active');
			$('body').removeClass('modal-open');
		}
	}
