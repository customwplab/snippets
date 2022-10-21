<?php 
//Validate PostPass
add_filter('frm_validate_field_entry', 'custom_postpass_validation', 10, 3);
function custom_postpass_validation($errors, $posted_field, $posted_value){
	
	global $post;

	//PostPass Field
	if($posted_field->id == 11){ 
		//Hidden field - Post ID
		$post_ID = $_POST['item_meta'][15];
		$the_post = get_post($post_ID  );
		$pass = $the_post->post_password;

		if($posted_value != $pass){ 
			$errors['field'. $posted_field->id] = 'Access code is incorrect. Please try again. (POST ID: '.$post_ID  .')';
		} 
	}
	return $errors;
}



add_filter('frm_redirect_url', 'custom_postpass_return_page', 9, 3);
function custom_postpass_return_page($url, $form, $params){
  if($form->id == 2){
	 
		$pass = $_POST['item_meta'][11]; //post pass field
		$post_ID = $_POST['item_meta'][15]; //page id hidden field
		$url = get_the_permalink($post_ID);
	
		require_once ABSPATH . WPINC . '/class-phpass.php';
		$hasher = new PasswordHash( 8, true );

		$expire  = apply_filters( 'post_password_expires', time() + 864000 );
		$referer = wp_get_referer();

		if ( $referer ) {
			$secure = ( 'https' === parse_url( $referer, PHP_URL_SCHEME ) );
		} else {
			$secure = false;
		}

		setcookie( 'wp-postpass_' . COOKIEHASH, $hasher->HashPassword( wp_unslash($pass) ), $expire, COOKIEPATH, COOKIE_DOMAIN, $secure );
		
  }
  return $url;
}
