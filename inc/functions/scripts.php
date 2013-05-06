<?php
// Use WordPress plugin to minify the scripts
add_action('wp_enqueue_scripts', 'register_tsu_scripts');
function register_tsu_scripts() {
	// register plugins below

	// register scripts
	wp_register_script( 'scripts', THEME_JS . '/scripts.js', false, NULL, true );

	// fire up the scripts
	wp_enqueue_script( 'scripts');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}