<?php

// Showing multiple post types in Posts Widget
add_action('elementor/query/cpt_posts_press', function ($query) {
 
	//exclude old posts from related posts section
	if(is_singular(['post', 'press'])){
		$date_query = [
			[
				'column' => 'post_date_gmt',
				'after' => '3 months ago',
			]
		];
		
		$query->set('date_query', $date_query);
	}
	
	$query->set('post_type', ['post', 'press']);
});
