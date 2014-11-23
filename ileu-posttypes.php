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

add_action("template_redirect", 'template_redirects');

// Template selection
function template_redirects()
{
	global $wp;
	global $wp_query;
	if ($wp->query_vars["post_type"] == "organisation")
	{
		if (have_posts() )
		{
			add_filter( 'post_class', 'add_one_third' );
			add_filter( 'the_content', 'add_image' );
		}
		else
		{
			$wp_query->is_404 = true;
		}
	}
}
function add_one_third( $classes ) {
	global $wp_query;
	if( ! $wp_query->is_main_query() )
		return $classes;

	if( is_singular() )
		return $classes;
		
	$classes[] = 'one-third';
	if( 0 == $wp_query->current_post || 0 == $wp_query->current_post % 3 )
		$classes[] = 'first';
	return $classes;
}

function add_image( $content ){
	if( has_post_thumbnail() ){
		if ( is_archive() ){
			return the_post_thumbnail();
		}
		else{
			return the_post_thumbnail().$content;
		}

	}
}
