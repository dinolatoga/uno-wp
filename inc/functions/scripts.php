<?php
// Load jQuery from Google CDN
function load_jquery_cdn() {
	wp_deregister_script( 'jquery' );
	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js', false, NULL, true);
	wp_enqueue_script('jquery');
}
// Load jQuery from Theme Folder
function load_jquery() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_bloginfo('template_url').'/js/libs/jquery-1.9.1.min.js', false, NULL, true);
	wp_enqueue_script('jquery');
}

add_action('wp_enqueue_scripts', 'load_jquery_cdn');
//add_action('wp_enqueue_scripts', 'load_jquery');

// register scripts
add_action('wp_enqueue_scripts', 'register_tsu_scripts');
function register_tsu_scripts() {
	// jquery plugins
	wp_register_script( 'cycle', THEME_JS . '/plugins/jquery.cycle.all.min.js', false, NULL, true );
	wp_register_script( 'maximage', THEME_JS . '/plugins/jquery.maximage.min.js', false, NULL, true );

	// config script
	wp_register_script( 'scripts', THEME_JS . '/scripts.js', false, NULL, true );

	// fire up the scripts
	wp_enqueue_script( 'cycle');
	wp_enqueue_script( 'maximage');
	wp_enqueue_script( 'scripts');
}