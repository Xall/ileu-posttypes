<?php
/*
Plugin Name: ILEU Post Types
Plugin URI:
Description: Creates some custom post types and defines templates for them
Version: 1.0
Author: Simon Volpert
Author URI: http://svolpert.eu
License: MIT
*/

function add_posttype() {
	$labels = array(
		'name' => 'Organisations',
		'singular_name' => 'Organisation',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Organisation',
		'edit_item' => 'Edit Organisation',
		'new_item' => 'New Organisation',
		'view_item' => 'View Organisation',
		'search_items' => 'Search Organisations',
		'not_found' =>  'No organisations found',
		'not_found_in_trash' => 'No organisations found in trash',
		'parent_item_colon' => '',
		'menu_name' => 'Organisations'
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
                '_builtin' => false,
		'supports' => array('title','thumbnail','editor')
	); 

	register_post_type( 'organisation', $args );
}
add_action( 'init', 'add_posttype' );	
