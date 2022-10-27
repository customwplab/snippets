// Form slidedown select
	$('.custom-select select').each(function (index, element) {
		// Get Placeholder
		var placeholder = $(this).children('option').eq(0).text().trim();
		var optionList = [];
		// Get options
		$(this).children('option').each(function (i) {
			var value = $(this).text().trim();
			// First option should be active
			var activeClass = i == 0 ? ' active' : '';
			var optionHTML =  '<li class="option' + activeClass + '">' + value + '</li>';
			optionList.push(optionHTML);
		});
		// Store option HTML for later use
		var getOptionListHTML = optionList.map(function (option) {
			return option;
		}).join('');
		// Dropdown HTML
		var html =
		  '<div class="select-slide-down">' +
			'<div class="placeholder">' + placeholder + '</div>' +
			'<ul class="options">' + getOptionListHTML + '</ul>' +
		  '</div>';
    
		$(this).after(html);
		var $selectSlidedown = $(this).next('.select-slide-down');
		var $placeHolderElem = $selectSlidedown.find('.placeholder');
		var $optionsElem = $selectSlidedown.find('.options');
		var $optionElem = $selectSlidedown.find('.option');
		// Main Select
		var $mainSelectElem = $(this);
		var $mainOptionElem = $(this).find('option');
		// Add events
		$placeHolderElem.on('click', function (e) {
		  e.preventDefault();
		  $optionsElem.slideToggle(500);
		});
		$optionElem.on('click', function (e) {
			e.preventDefault();
			var $placeholder = $(this).closest('.select-slide-down').children('.placeholder');
			$placeholder.text($(this).text()); // update placeholder
			// Make current option active
			$optionElem.removeClass('active');
			$(this).addClass('active');
			// Trigger main SELECT options
			var index = $(this).index();
			var selectVal = $mainOptionElem.eq(index).val();
			$mainSelectElem.val(selectVal).change();
			// Hide Options
			$optionsElem.slideUp(500);
		});
	});
 
