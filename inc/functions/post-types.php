<?php
/**
* Post Types and Taxonomies
* @package WordPress
* @subpackage Uno
*/

// Register Post Types
add_action( 'init', 'register_taxonomies' );
add_action( 'init', 'register_pt' );

// Post Type
function register_pt() {
	$labels = array(
		'name' => __('Post Type'),
		'singular_name' => __('Item'),
		'add_new' => __('Add New'),
		'add_new_item' => __('Add New Item'),
		'edit_item' => __('Edit Item'),
		'new_item' => __('New Item'),
		'view_item' => __('View Item'),
		'search_items' => __('Search Items'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'post-type','with_front' => true),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','revisions'),
		'has_archive' => true,
		'exclude_from_search' => false
	);
	register_post_type( 'post-type' , $args );
}

function register_taxonomies() {
	register_taxonomy(
		'my_taxonomy',
		array( 'post-type' ),
		array(
			'hierarchical' => true,
			'rewrite' => array(
				'slug' => 'post-type/category',
				'with_front' => false,
				'hierarchical' => true
			),
			'public' => true,
			'labels' => array(
				'name' => __( 'Categories' ),
				'singular_name' => __( 'Category' ),
				'menu_name' => __( 'Categories' )
			),
		)
	);
}

//add_action('init', 'custom_taxonomy_flush_rewrite');
function custom_taxonomy_flush_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
?>