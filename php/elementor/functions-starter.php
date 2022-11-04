<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
 add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style('hello-elementor-child-style',get_stylesheet_directory_uri() . '/style.css',['hello-elementor-theme-style',],'1.0.0');
	// Main
	wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css', ['hello-elementor-theme-style'], filemtime( get_stylesheet_directory() . '/css/main.css'));
	//Main JS
	wp_enqueue_script('main', get_stylesheet_directory_uri() . '/js/main.js', array(), filemtime( get_stylesheet_directory() . '/js/main.js'), true );
}


add_action('wp_head', 'custom_wp_head');
function custom_wp_head(){
	?>

	<?php 
}

add_action('elementor/page_templates/header-footer/before_content', 'custom_page_wrapper__open');
function custom_page_wrapper__open(){
	echo '<div id="page" class="page-wrap">';
}
add_action('elementor/page_templates/header-footer/after_content', 'custom_page_wrapper__close');
function custom_page_wrapper__close(){
	echo '</div>';
} 

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'custom-theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}

//Includes
foreach (glob(get_stylesheet_directory() . '/inc/*.php') as $filename) {
	include $filename;
}
foreach (glob(get_stylesheet_directory() . '/inc/shortcodes/*.php') as $filename) {
	include $filename;
}
foreach (glob(get_stylesheet_directory() . '/inc/post-types/*.php') as $filename) {
	include $filename;
}
//  YOAST settings panel in editor to bottom 
add_filter( 'wpseo_metabox_prio', function() { return 'low'; } );
