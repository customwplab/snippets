<?phpadd_shortcode('downloads', 'backstage_downloads_sc');
<?php 
  function backstage_downloads_sc(){
	
	$platforms = get_terms([
		'taxonomy' => 'download_platform',
		'hide_empty' => false,
	]);
	
	$products = get_terms([
		'taxonomy' => 'download_product',
		'hide_empty' => false,
	]);
	
	ob_start();
	
	?>
	<div id="backstage_downloads">
		<form class="filters columns is-multiline auto-submit api-query" data-endpoint="backstage_downloads/v1/get_downloads" data-action="get_downloads">
			<fieldset class="custom-select column is-12 is-paddingless">
				<select id="download_platform" name="download_platform" class="dl-dd-field">
					<option value=""><?php echo __('\\\ what’s your platform?', 'backstage');?></option>
					<?php 
					foreach($platforms as $platform){
						echo '<option value="'.$platform->name.'" data-term-id="'.$platform->term_id.'">'. $platform->name.'</option>';
					}
					?>
				</select>
			</fieldset>
			<fieldset class="custom-select column is-12 is-paddingless">
				<select id="download_product" name="download_product" class="dl-dd-field custom-select">
					<option value=""><?php echo __('\\\ what’s your product?', 'backstage');?></option>
					<?php 
					foreach($products as $product){
						echo '<option value="'.$product->name.'"	 data-term-id="'.$product->term_id.'">'. $product->name.'</option>';
					}
					?>
				</select>
			</fieldset>
		</form>
		<div id="results"></div>
	</div>
	<?php
	return ob_get_clean();
}
