<?php
/**
 * Post Types
 * Custom post types should be added to child themes, this parent theme 
 * has no custom post types by default, but if it did they would go here
 *
 * @package Inti
 * @author Stuart Starrs
 * @since 1.0.1
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/*

if(!function_exists('slide_post_type_init')){
	function slide_post_type_init() {
		$labels = array(
			'name' => _x('Slides', 'post type general name', inti),
			'singular_name' => _x('Slide', 'post type singular name', inti),
			'add_new' => __('Add New', 'Slide', inti),
			'add_new_item' => __('Add New Slide', inti),
			'edit_item' => __('Edit Slide', inti),
			'new_item' => __('New Slide', inti),
			'view_item' => __('View Slide', inti),
			'search_items' => __('Search Slides', inti),
			'not_found' =>  __('No Slide found', inti),
			'not_found_in_trash' => __('No Slide found in Trash', inti), 
			'parent_item_colon' => '',
			'menu_name' => _x('Slides', '', inti)
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'rewrite'   => true,
		'has_archive' => false,
		'query_var' => true,
		'capability_type' => 'page',
		'hierarchical' => true,
		'show_in_nav_menus' => false,
		'menu_position' => 35,
		'menu_icon' => 'dashicons-images-alt2', 
		'supports' => array(
			'title',
			'thumbnail',
			'editor',
			'page-attributes'   
			)
		);
		register_post_type('slide',$args);
	}
}
add_action('init', 'slide_post_type_init');

*/