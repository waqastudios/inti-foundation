<?php
/**
 * Styles
 * WordPress will add these style sheets to the theme header
 *
 * @package Inti
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/wp_register_style
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 * @see wp_register_style
 * @see wp_enqueue_style
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

add_action('wp_enqueue_scripts', 'inti_register_styles', 1);
add_action('wp_enqueue_scripts', 'inti_enqueue_styles', 5);
 
function inti_register_styles() {
	// register styles
	wp_register_style('inti', get_template_directory_uri() . '/library/css/inti-min.css', array(), filemtime(get_template_directory() . '/library/css/inti-min.css'), 'all');
	wp_register_style('fontawesome', get_template_directory_uri() . '/library/css/font-awesome-min.css', array(), filemtime(get_template_directory() . '/library/css/font-awesome-min.css'), 'all');
	wp_register_style('style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css'), 'all');
}

function inti_enqueue_styles() {
	if ( !is_admin() ) { 
		// enqueue styles
		wp_enqueue_style('inti'); 
		wp_enqueue_style('fontawesome');
		
		// add style.css with child themes
		if ( is_child_theme() ) {
			wp_enqueue_style('style');
		}
	}
}