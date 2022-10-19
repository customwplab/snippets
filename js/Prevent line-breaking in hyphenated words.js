	//Prevent line-breaking in hyphenated words
	$('#main h1, #main h2, #main h3, #main h4').each(function(){
			var content = $(this).text();
			$(this).html(content.replace(/(((\w+-)+\w+)(?![^<]*\>))/m, '<span style="white-space:nowrap">$1</span>'));
	});
