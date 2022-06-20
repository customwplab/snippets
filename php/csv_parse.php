<?php 
add_shortcode('wish_stars', 'kw_stars_shortcode');
function kw_stars_shortcode(){
	
	ob_start();
		//Get stars csv file
	$csv_file = get_field('wish_stars_file', 'option');
	
	if($csv_file){		
	
	
		$items_per_load = 50;
		//value to check (first row column title value)
		$title_row = 'firstname';
		//Get total rows in CSV
		$rows = file($csv_file);
	
		$rows_count = count($rows);	
		//Get total pages
		$total_pages = round($rows_count / $items_per_load);
		//Shuffle pages
		$all_pages = range(1,$total_pages);
		shuffle($all_pages );
		
		//Get next offset value
		$row_offset = (isset($_GET['row_offset'])) ? $all_pages[$_GET['row_offset']] : $all_pages[0];
		$i = $row_offset;
		
		echo '<div id=wish-stars-container" class="wish-stars-container" data-action="'.get_the_permalink().'" data-page="1">';

		//Loop through rows
		if ($rows_count > 0) {
			foreach($rows as $key => $row) {
				//Skip offset rows & title row
				if($key < $row_offset || $row[0] == $title_row) { continue; }
				//Set of rows loaded. Stop loop. 
				if($key == ($row_offset + $items_per_load)) {break;}
				$i++;
				//Output star
				echo '<div class="star-item">';
				echo '<img src="'.get_template_directory_uri().'/img/kw-star.svg"/>';
				//Parse row values
				$row_values = explode(',', $row);
				$name = $row_values[0].'<br>'.$row_values[1];
				echo '<h4>'.$name.'</h4>';
				echo '</div>';
			}
		}
		echo '</div>';
		//Value to be passed to ajax
		
		$newPage = isset($_GET['row_offset']) ? intval($_GET['row_offset']) + 1 : 1;
		if($newPage < $total_pages){
			echo '<div id="more-posts-container"><div id="more_posts" data-page="'.$newPage.'"></div></div>';
		}
	}
	return ob_get_clean();
}
?>
