<?php
/**
* Theme functions
* @package WordPress
* @subpackage Uno
*/

// include metabox plugin
define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/inc/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( STYLESHEETPATH . '/inc/meta-box' ) );
require_once RWMB_DIR . 'meta-box.php';
include get_template_directory().'/inc/config/meta-box.php';

//define constants
define( 'HOME_URI', home_url() );
define( 'THEME_URI', get_stylesheet_directory_uri() );
define( 'THEME_IMAGES', THEME_URI . '/images' );
define( 'THEME_CSS', THEME_URI . '/css' );
define( 'THEME_JS', THEME_URI . '/js' );

// dashboard customizations
require_once('inc/functions/styles.php');
require_once('inc/functions/scripts.php');
require_once('inc/functions/post-types.php');
require_once('inc/functions/helpers.php');
require_once('inc/functions/dashboard.php');