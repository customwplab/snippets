  $pos = 2;
	$insert = ['tip_number' => __ ('Tip #')];
	$main_array = array_merge(array_slice($main_array, 0, $pos), $insert, array_slice($main_array, $pos));
