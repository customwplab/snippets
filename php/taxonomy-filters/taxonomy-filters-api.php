
<?php //API for Ajax
add_action( 'rest_api_init', function () { 
	//Get Downloads
	register_rest_route( 'backstage_downloads/v1', '/get_downloads/', array(
		'methods' => 'POST', 
		'callback' => 'backstage_get_downloads', 
		'permission_callback' => '__return_true',
	) );
} );


function backstage_get_downloads(\WP_REST_Request $request ) {

    if( !isset( $request['action'] ) || $request['action'] != 'get_downloads') {
       return 'action not permitted';
    }
	
	$data = $request['form_data'];
	
	//Tax Query
	$tax_query = [];
	
	if(!empty($data['download_platform'])){
		$tax_query[] = [
			'taxonomy'  => 'download_platform',
			'field'     => 'slug',
			'terms'     => [$data['download_platform']],
		];
	}
	if(!empty($data['download_product'])){
		$tax_query[] = [
			'taxonomy'  => 'download_product',
			'field'     => 'slug',
			'terms'     => [$data['download_product']],
		];
	}
	
	//Query Args
	$args = [
		'post_type' => 'download',
		'tax_query' => [
			'relation' => 'AND',
			$tax_query
		]
	];
	
	$downloads = get_posts($args);
	
	//Output
	ob_start();
	?>
	<div class="columns is-multiline is-marginless">
	<?php
		if($downloads){
			foreach ($downloads as $download){
				$post_id = $download->ID;
				$downloadPost = new downloadPost($post_id);
				$downloadPost->render_item();
			}
		} else {
			echo __('Not a dam thing!', 'backstage');
		}
	?>
	</div>
	<?php 
	return ob_get_clean();
	
}
