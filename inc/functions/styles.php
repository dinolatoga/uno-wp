<?php
function theme_styles(){
	wp_register_style( 'main', THEME_CSS . '/main.css', array(), NULL, 'all' );
	// fire styles
	wp_enqueue_style( 'main' );
}
add_action('wp_enqueue_scripts', 'theme_styles');

// Custom Dashboard CSS
function custom_admin_styles() {
	wp_enqueue_style( 'custom_admin_styles', get_bloginfo( 'stylesheet_directory' ) . '/css/custom-admin.css', false, '1.0', 'all');
}
add_action( 'admin_init', 'custom_admin_styles' );