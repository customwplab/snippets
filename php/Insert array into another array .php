  $pos = 2;
	$insert = ['some_key' => __ ('Add me into position 2 pls')];
	$main_array = array_merge(array_slice($main_array, 0, $pos), $insert, array_slice($main_array, $pos));
